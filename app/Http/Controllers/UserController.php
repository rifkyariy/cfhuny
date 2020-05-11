<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Team;
use App\PerguruanTinggi;
use Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function profile()
    {
        $userLoginId = Auth::user()->id;
        $user = User::findOrFail($userLoginId);
        
        $pt = PerguruanTinggi::find($user->university_id);
        if(!$pt){
            $pt = '';
        }

        return view(
            'users.profile', 
            [
                'user' => $user,
                'pt' => $pt
            ]);

    }

    public function update(Request $request, $userId)
    {
        $user = User::findOrFail($userId);

        if($user->role == "Mahasiswa") {
            $this->validate($request, [
                'ktm' => 'required|mimes:jpeg,png|max:4096',
                'name' => 'required|max:100',
                'nim' => 'required|digits_between:10,15',
                'prodi' => 'required',
                'phone' => 'required|digits_between:10,20',
                'university_id' => 'required',
            ]);
        } else {
            $this->validate($request, [
                'name' => 'required|max:100',
                'phone' => 'required|unique:users|digits_between:10,20',
            ]);
        }
        // dd($request->file('ktm'));
        
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->university_id = $request->university_id;
        if($request->nim) {
            $user->nim = $request->nim;
        }
        if($request->prodi) {
            $user->prodi = $request->prodi;
        }
        if($request->file('ktm')) {
            $newFilename = $request->university_id.'_'.$request->nim.'.'.$request->file('ktm')->getClientOriginalExtension();
            $this->saveIntoCloud('KTM',$newFilename,$request->file('ktm'));
            $user->ktm = $newFilename;
        }

        $user->save();

        return redirect()->back()->with('message','Profil berhasil diupdate');
    }

    public function index()
    {
        if(Auth::user()->role != "Admin") {
            return redirect()->back()->with('error', 'Anda tidak punya akses!');
        }

        $users = User::paginate(10);
        $no = 1;
        return view('admins.users', ['users' => $users])->with('no', $no);
    }

    public function edit($userId)
    {
        if(Auth::user()->role != "Admin") {
            return redirect()->back()->with('error', 'Anda tidak punya akses!');
        }

        $user = User::findOrFail($userId);
        return view('users.edit', ['user' => $user]);
    }

    public function downloadKtm($userId)
    {
        if(Auth::user()->role != "Admin") {
            return redirect()->back()->with('error', 'Anda tidak punya akses!');
        }

        $user = User::findOrFail($userId);
        return Storage::download('public/' . $user->ktm, "KTM " . $user->name);
    }

    public function destroy($userId)
    {
        if(Auth::user()->role != "Admin") {
            return redirect()->back()->with('error', 'Anda tidak punya akses!');
        }

        $user = User::findOrFail($userId);
        $teamId = [];

        foreach($user->teams as $team) {
            $teamId[] = $team->id;
        }

        $user->teams()->detach($teamId);

        $user->delete();

        return redirect()->back()->with('message', 'User berhasil dihapus');
    }

    public function saveIntoCloud($directory,$filename,$upfile){
        $dir = '/';
        $recursive = true; // Get subdirectories also?
        $contents = collect(Storage::cloud()->listContents($dir, $recursive));

        // find directory
        $dir = $contents
            ->where('type', '=', 'dir')
            ->where('filename', '=', $directory)
            ->first(); // There could be duplicate directory names!
        
        // check file already exists
        $file = $contents
            ->where('type', '=', 'file')
            ->where('filename', '=', pathinfo($filename, PATHINFO_FILENAME))
            ->first(); // there can be duplicate file names!

        if (!$dir) {
            return 'Directory does not exist!';
        }

        if (!$file){
            $upfile->storeAs($dir["path"],$filename,'google');
        }else {
            Storage::cloud()->delete($file['path']);
            $upfile->storeAs($dir["path"],$filename,'google');
        }
        
        return 'File was created in the sub directory in Google Drive';
    }



}
