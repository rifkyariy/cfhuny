<?php

namespace App\Http\Controllers;

use Auth;
use App\CabangLomba;
use App\Member;
use App\PerguruanTinggi;
use App\Proposal;
use App\Team;
use App\User;
use App\Mail\SendEmailInvitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class TeamsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index()
    {
        $userLogin = Auth::user();
        $users = User::all();
        $teamActives = [];

        if(Auth::user()->role == "Admin") {
            $teams = Team::paginate(10);
            return view('teams.index', ['teams' => $teams]);
        } else {
            $memberKetua = Member::where('user_id','=',Auth::user()->id)->first();

            foreach($memberKetua->teams as $team) {
                $teamActives[] = $team;
            }

            foreach ($teamActives as $key => $team) {
                $cabanglomba = CabangLomba::find($team->cabang_lomba);
                $team->cabang_lomba_detail = $cabanglomba;
            }


            return view('teams.index', ['teams' => $teamActives]);
        }
    }

    public function create()
    {   
        $teams = Team::all();
        $users = User::all();
        
        $pt = PerguruanTinggi::find(Auth::user()->university_id);
        if(!$pt){
            $pt = '';
        }
        
        if(Auth::user()->role != "Mahasiswa") {
            return redirect()->back()->with('error','Anda tidak bisa membuat team karena anda bukan mahasiswa');
        }
        
        if(Auth::user()->ktm == null || Auth::user()->phone == null || Auth::user()->prodi == null || Auth::user()->nim == null || Auth::user()->name == null) {
            return redirect()->back()->with('error', 'Anda harus melengkapi profil terlebih dahulu pada halaman profil');
        }

        $userLogin = Auth::user()->id;
        $usersExcept = User::all()->except($userLogin);

        return view(
            'teams.create', 
            [
                'users' => $usersExcept,
                'pt' => $pt
            ]);
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|max:50',
            'cabang_lomba' => 'required',
            'anggota_name.*' => 'required',
            'anggota_email.*' => 'required|email',
            'anggota_university_id.*' => 'required',
            'anggota_prodi.*' => 'required',
            'anggota_ktm.*' => 'required'
        ]);

        
        $users = User::all();
        $teams = Team::all();

        // jumlah anggota
        $memberCount = $request->jumlah_anggota;
        if($memberCount==1){
            if($request->anggota_nim[0] == Auth::user()->nim) {
                return redirect()->back()->with('error', 'Ketua atau Anggota tidak boleh sama!');
            }
        }

        if ($memberCount > 1) {
            if($request->anggota_nim[0] == $request->anggota_nim[1]) {
                return redirect()->back()->with('error', 'Ketua atau Anggota tidak boleh sama!');
            }
            
            if($request->anggota_nim[1] == Auth::user()->nim) {
                return redirect()->back()->with('error', 'Ketua atau Anggota tidak boleh sama!');
            }
        }
        

        $team = new Team;
        $team->name = $request->name;
        $team->cabang_lomba = $request->cabang_lomba;
        $team->save();
        
        // Ketua tim id
        $memberId = Member::where('user_id','=',Auth::user()->id)->first();
        if($memberId == null){
            $member = new Member;
            $member->name = Auth::user()->name;
            $member->nim = Auth::user()->nim;
            $member->phone = Auth::user()->phone;
            $member->email = Auth::user()->email;
            $member->university_id = Auth::user()->university_id;
            $member->prodi = Auth::user()->prodi;
            $member->ktm = Auth::user()->ktm;
            $member->user_id = Auth::user()->id;
            $member->save();
            
            $memberId = $member->id;
        }
        
        $role = "Ketua";
        // memasukkan ketua ke rel member_team
        $team->members()->attach($memberId,[ 'role' => $role]);

        // looping memasukkan anggota 
        for ($i=0; $i < $memberCount; $i++) { 
            $memberId = Member::where('nim','=',$request->anggota_nim[$i])->first();
            if($memberId == null){
                $member = new Member;
                $member->name = $request->anggota_name[$i];
                $member->nim = $request->anggota_nim[$i];
                $member->phone = $request->anggota_phone[$i];
                $member->email = $request->anggota_email[$i];
                $member->university_id = $request->anggota_university_id[$i];
                $member->prodi = $request->anggota_prodi[$i];

                // save ktm into cloud
                if($request->file('anggota_ktm')[$i]) {
                    $newFilename = $request->anggota_university_id[$i].'_'.$request->anggota_nim[$i].'.'.$request->file('anggota_ktm')[$i]->getClientOriginalExtension();
                    $this->saveIntoCloud('KTM',$newFilename,$request->file('anggota_ktm')[$i]);
                    $member->ktm = $newFilename;
                }
                $member->save();

                $memberId = $member->id;
            }


            $role = 'Anggota';
            $team->members()->attach($memberId,[ 'role' => $role]);
        }

        // if($request->anggota1) {
        //     $userTeam = 0;
        //     foreach($teams as $tim) {
        //         foreach($tim->users as $user) {
        //             if($request->anggota1 == $user->id && $user->pivot->status == "Disetujui") {
        //                 $userTeam += 1;
        //             }
        //         }
        //     }
        //     if($userTeam >= 3) {
        //         $teamsCreated = $teams->where('name',$request->name);
        //         foreach($teamsCreated as $tim) {
        //             $team->users()->detach(Auth::user()->id, ['role' => $role, 'status' => $status]);
        //             $tim->delete();
        //         }
        //     }
        //     $team->users()->attach($request->anggota1);
        // }

        // if($request->anggota2) {
        //     $userTeam = 0;
        //     foreach($teams as $tim) {
        //         foreach($tim->users as $user) {
        //             if($request->anggota2 == $user->id && $user->pivot->status == "Disetujui") {
        //                 $userTeam += 1;
        //             }
        //         }
        //     }
        //     if($userTeam >= 3) {
        //         $teamsCreated = $teams->where('name',$request->name);
        //         foreach($teamsCreated as $tim) {
        //             $team->users()->detach(Auth::user()->id, ['role' => $role, 'status' => $status]);
        //             $tim->delete();
        //         }
        //         return redirect()->back()->with('error','Anggota 2 sudah berada di 3 tim!');
        //     }
        //     $team->users()->attach($request->anggota2);
        // }
        
        // // send email
        // $emailTeam = [];
        // foreach($team->users as $user) {
        //     if($user->id != Auth::user()->id) {
        //         $emailTeam[] = $user->email;
        //     }
        // }

        // foreach($emailTeam as $emailUser) {
        //     Mail::to($emailUser)->send(new SendEmailInvitation($team));
        // }

        return redirect()->route('teams.show', ['team' => $team->id])->with('message', 'Tim berhasil dibuat');
    }

    public function approve($teamId)
    {
        

    }

    public function reject($teamId)
    {
        

    }

    public function show($teamId)
    {
        
        $members = Member::all();
        $memberLogin = Member::where('user_id','=',Auth::user()->id)->first();
        $pt = PerguruanTinggi::where('id','=',Auth::user()->university_id)->first();
        
        if(Team::find($teamId)==null){
            return redirect(url('/teams'))->with('error','Tim Tidak Ditemukan');
        }
        

        if(Auth::user()->role == "Admin") {
            $team = Team::findOrFail($teamId);
            return view('teams.detail', ['team' => $team]);
        }

        foreach($members as $member) {
            foreach($member->teams as $team) {
                if($team->id == $teamId && $team->pivot->member_id == $memberLogin->id) {
                    $team = Team::findOrFail($teamId);
                    $cabanglomba = CabangLomba::find($team->cabang_lomba)->first();
                    return view(
                        'teams.detail', 
                        [
                            'team' => $team ,
                            'cabanglomba' => $cabanglomba,
                            'pt' => $pt
                        ]
                    );
                }
            }
        }

        return redirect()->back()->with('error','Anda bukan anggota tim ini');
    }

    public function edit($teamId)
    {
        $team = Team::findOrFail($teamId);
        $pt = PerguruanTinggi::find(Auth::user()->university_id);
        $cabangLomba = CabangLomba::find($team->cabang_lomba)->first();
        if(!$pt){
            $pt = '';
        }

        $memberCount = 0;
        foreach($team->members as $member) {
            if($member->pivot->role == 'Anggota'){
                $memberCount++;
            }
        }

        $members = [];
        foreach($team->members as $member) {
            array_push($members,$member);
        }

        // dd($members);

        // $userLogin = Auth::user()->id;
        // $users = User::all()->except($userLogin);

        // if(Auth::user()->role == "Admin") {
        //     return view('teams.edit', ['team' => $team])->with(['users' => $users]);
        // }

        // foreach($team->users as $user) {
        //     if($user->id == $userLogin && $user->pivot->status == "Disetujui" && $user->role != "Dosen" && $user->pivot->role == "Ketua") {
        //         return view('teams.edit', ['team' => $team])->with(['users' => $users]);
        //     }
        // }
        // return redirect()->back()->with('error', 'Anda bukan ketua tim ini!');
        
        return view(
            'teams.edit',
            [
                'team' => $team,
                'members' => $members,
                'pt' => $pt,
                'memberCount' => $memberCount,
                'cabangLomba' => $cabangLomba
            ]);
    }


    public function update(Request $request, $teamId)
    {
        $validateData = $request->validate([
            'name' => 'required|max:50',
            'cabang_lomba' => 'required',
            'anggota_name.*' => 'required',
            'anggota_email.*' => 'required|email',
            'anggota_university_id.*' => 'required',
            'anggota_prodi.*' => 'required',
            'anggota_ktm.*' => 'required'
        ]);
        
        $team = Team::findOrFail($teamId);
        
        // jumlah anggota
        $memberCount = $request->jumlah_anggota;
        if($memberCount == 1){
            if($request->anggota_nim[0] == Auth::user()->nim) {
                return redirect()->back()->with('error', 'Ketua atau Anggota tidak boleh sama!');
            }
        }

        if ($memberCount > 1) {
            if($request->anggota_nim[0] == $request->anggota_nim[1]) {
                return redirect()->back()->with('error', 'Ketua atau Anggota tidak boleh sama!');
            }
            
            if($request->anggota_nim[1] == Auth::user()->nim) {
                return redirect()->back()->with('error', 'Ketua atau Anggota tidak boleh sama!');
            }
        }

        $team->name = $request->name;
        $team->cabang_lomba = $request->cabang_lomba;
        $team->save();

        for ($i=0; $i < $memberCount; $i++) { 
            $member = Member::where('id','=',$request->anggota_id[$i])->first();
            $jumlahFile = count($request->file());
            
            if($member == null){
                $member = new Member;
                $member->name = $request->anggota_name[$i];
                $member->nim = $request->anggota_nim[$i];
                $member->phone = $request->anggota_phone[$i];
                $member->email = $request->anggota_email[$i];
                $member->university_id = $request->anggota_university_id[$i];
                $member->prodi = $request->anggota_prodi[$i];
        
                if($jumlahFile == 1){
                    if($request->anggota_ganti_ktm == 1 && $i == 0){
                        // save ktm into cloud
                        if($request->file('anggota_ktm')[0]) {
                            $newFilename = $request->anggota_university_id[$i].'_'.$request->anggota_nim[$i].'.'.$request->file('anggota_ktm')[0]->getClientOriginalExtension();
                            $this->saveIntoCloud('KTM',$newFilename,$request->file('anggota_ktm')[0]);
                            $member->ktm = $newFilename;
                        }
                    }
                    if($request->anggota_ganti_ktm == 2 && $i == 1){
                        // save ktm into cloud
                        if($request->file('anggota_ktm')[0]) {
                            $newFilename = $request->anggota_university_id[$i].'_'.$request->anggota_nim[$i].'.'.$request->file('anggota_ktm')[0]->getClientOriginalExtension();
                            $this->saveIntoCloud('KTM',$newFilename,$request->file('anggota_ktm')[0]);
                            $member->ktm = $newFilename;
                        }
                    }
                }else{
                    // save ktm into cloud
                    if($request->file('anggota_ktm')[$i]) {
                        $newFilename = $request->anggota_university_id[$i].'_'.$request->anggota_nim[$i].'.'.$request->file('anggota_ktm')[$i]->getClientOriginalExtension();
                        $this->saveIntoCloud('KTM',$newFilename,$request->file('anggota_ktm')[$i]);
                        $member->ktm = $newFilename;
                    }
                }

                $member->save();

                $memberId = $member->id;
                $role = 'Anggota';
                $team->members()->attach($memberId,[ 'role' => $role]);
            }else{
                $member->name = $request->anggota_name[$i];
                $member->nim = $request->anggota_nim[$i];
                $member->phone = $request->anggota_phone[$i];
                $member->email = $request->anggota_email[$i];
                $member->university_id = $request->anggota_university_id[$i];
                $member->prodi = $request->anggota_prodi[$i];

                if($jumlahFile == 1){
                    if($request->anggota_ganti_ktm == 1 && $i == 0){
                        // save ktm into cloud
                        if($request->file('anggota_ktm')[0]) {
                            $newFilename = $request->anggota_university_id[$i].'_'.$request->anggota_nim[$i].'.'.$request->file('anggota_ktm')[0]->getClientOriginalExtension();
                            $this->saveIntoCloud('KTM',$newFilename,$request->file('anggota_ktm')[0]);
                            $member->ktm = $newFilename;
                        }
                    }
                    if($request->anggota_ganti_ktm == 2 && $i == 1){
                        // save ktm into cloud
                        if($request->file('anggota_ktm')[0]) {
                            $newFilename = $request->anggota_university_id[$i].'_'.$request->anggota_nim[$i].'.'.$request->file('anggota_ktm')[0]->getClientOriginalExtension();
                            $this->saveIntoCloud('KTM',$newFilename,$request->file('anggota_ktm')[0]);
                            $member->ktm = $newFilename;
                        }
                    }
                }else{
                    // save ktm into cloud
                    if($request->file('anggota_ktm')[$i]) {
                        $newFilename = $request->anggota_university_id[$i].'_'.$request->anggota_nim[$i].'.'.$request->file('anggota_ktm')[$i]->getClientOriginalExtension();
                        $this->saveIntoCloud('KTM',$newFilename,$request->file('anggota_ktm')[$i]);
                        $member->ktm = $newFilename;
                    }
                }

                $member->save();
            }
        }

        return redirect()->route('teams.show', ['team' => $teamId])->with('message', 'Tim berhasil di edit');

    }

    public function destroy($teamId)
    {
        $team = Team::findOrFail($teamId);
        foreach($team->members as $member) {
            if($member->pivot->role == 'Ketua'){
                $memberKetua = $member->pivot->member_id;
            }
        }

        // mengambil user id dari ketua
        $memberKetua = Member::find($memberKetua)->first();        
        
        // Cek apabila ketua atau admin yang menghapus
        if((Auth::user()->id == $memberKetua->user_id) || (Auth::user()->role == "Admin")) {
            $membersId = [];
            $team = Team::findOrFail($teamId);

            // proposal things
            // $proposalTeams = Proposal::all()->where('team_id', $teamId);

            // hapus proposal yang dimiliki tim
            // foreach($proposalTeams as $proposal) {
            //     $proposal->delete();
            // }

            // mengambil seluruh member from relation team member
            foreach($team->members as $member) {
                $membersId[] = $member->pivot->member_id;
            }
            
            // hapus member yang berelasi dengan tim di table user_team
            $team->members()->detach($membersId);

            // hapus tim
            $team->delete();
            
            
            return response()->json(
                [
                    'status' => '200',
                    'message' => ' Tim berhasil dihapus !',
                ]);
            // return redirect()->back()->with('message', 'Tim berhasil dihapus');
        }

        return redirect()->back()->with('error', 'Anda tidak punya akses!');

        
    }

    public function removeMember($teamId,$memberId){
        $team = Team::findOrFail($teamId);
        foreach($team->members as $member) {
            if($member->pivot->role == 'Ketua'){
                $memberKetua = $member->pivot->member_id;
            }
        }

        if($memberKetua == $memberId){
            return redirect()->back()->with('error', 'Anda tidak bisa menghapus ketua!');
        }
        
        // mengambil user id dari ketua
        $memberKetua = Member::find($memberKetua)->first();
        
        // Cek apabila ketua atau admin yang menghapus
        if((Auth::user()->id == $memberKetua->user_id) || (Auth::user()->role == "Admin")) {
            $team->members()->detach($memberId);
            return redirect()->back()->with('message', 'Anggota Tim berhasil dihapus');
        }

        return redirect()->back()->with('error', 'Anda tidak punya akses!');
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
