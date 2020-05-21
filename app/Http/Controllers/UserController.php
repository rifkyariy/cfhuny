<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Team;
use App\Member;
use App\PerguruanTinggi;
use Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
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
                'name' => 'required|max:100',
                'nim' => 'digits_between:10,15',
                'prodi' => 'required',
                'phone' => 'digits_between:10,20',
                'university_id' => 'required',
            ]);

            if($user->ktm == null){
                $this->validate($request, [
                    'ktm' => 'required|mimes:jpeg,png|max:4096'
                ]);
            }
        } else {
            $this->validate($request, [
                'name' => 'required|max:100',
                'phone' => 'required|unique:users|digits_between:10,20',
            ]);
        }

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

        $memberId = Member::where('user_id','=',Auth::user()->id)->first();
        if($memberId != null){
            $member = $memberId;
            $member->name = $request->name;
            $member->phone = $request->phone;
            $member->email = $request->email;
            $member->university_id = $request->university_id;
            if($request->nim) {
                $member->nim = $request->nim;
            }
            if($request->prodi) {
                $member->prodi = $request->prodi;
            }
            if($request->file('ktm')) {
                $member->ktm = $user->ktm;
            }

            $member->user_id = $user->id;
            $member->save();

            $this->updateMemberUnivId($member->id,$request->university_id);
        }

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

        if ($file == null){
            $upfile->storeAs($dir["path"],$filename,'google');
        }else {
            Storage::cloud()->delete($file['path']);
            $upfile->storeAs($dir["path"],$filename,'google');
        }
        
        return 'File was created in the sub directory in Google Drive';
    }

    public function updateMemberUnivId($ketuaMemberId,$newUnivId){
        $ketuaMember = Member::findOrFail($ketuaMemberId);
        
        $editedMember = [];
        foreach($ketuaMember->teams as $team) {
            $team = Team::where('id','=',$team->pivot->team_id)->first();
            foreach ($team->members as $member) {
                if($member->pivot->role == "Anggota"){
                    $member->university_id = $newUnivId;
                    $member->save();
                }
            }
        }

    }



}
