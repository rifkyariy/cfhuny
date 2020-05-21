<?php

namespace App\Http\Controllers;

use Auth;
use App\CabangLomba;
use App\Member;
use App\PerguruanTinggi;
use App\Proposal;
use App\Submission;
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
        $this->middleware('auth');
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

            if($memberKetua==null){
                return view('teams.index', ['teams' => []]);
            }else{
                foreach($memberKetua->teams as $team) {
                    $teamActives[] = $team;
                }
    
                foreach ($teamActives as $key => $team) {
                    $cabanglomba = CabangLomba::find($team->cabang_lomba);
                    $subs = Submission::where('team_id',"=",$team->id)->first();
                    
                    $team->cabang_lomba_detail = $cabanglomba;
                    $team->subs_detail = $subs;
                }
                return view('teams.index', ['teams' => $teamActives]);
            }


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
        // avoid timeout
        set_time_limit(300);

        $users = User::all();
        $teams = Team::all();
        $members = Member::all();

        // jumlah anggota
        $memberCount = $request->jumlah_anggota;

        // create jika anggota 6 orang (total 7)
        if($request->jumlah_anggota <=6){
            $validateData = $request->validate([
                'name' => 'required|max:50',
                'cabang_lomba' => 'required',
                'anggota_name.*' => 'required',
                'anggota_email.*' => 'required|email',
                'anggota_university_id.*' => 'required',
                'anggota_prodi.*' => 'required',
                'anggota_ktm.*' => 'required'
            ]);

            // check if nim already exist but differet credentials
            if($memberCount!=0){
                foreach ($members as $member) {
                    foreach ($request->anggota_nim as $key => $anggotanim) {
                        if($member->nim == $anggotanim){
                            if($member->university_id != $request->anggota_university_id[$key]){
                                return redirect()->back()->with('error', 'Nim telah terdaftar !');
                            }
                        }
                    }
                }

                // check if same 
                for ($i=0; $i < $memberCount; $i++) { 
                    if($request->anggota_nim[$i] == Auth::user()->nim) {
                        return redirect()->back()->with('error', 'Ketua atau Anggota tidak boleh sama!');
                    }
    
                    if($i != $memberCount-1 ){
                        if($request->anggota_nim[$i] == $request->anggota_nim[$i+1]) {
                            return redirect()->back()->with('error', 'Ketua atau Anggota tidak boleh sama!');
                        }
                    }
                    
                }
            }


            // create Team
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
        }else{
            // validate file upload
            $validateData = $request->validate([
                'anggota_excel' => 'required|mimes:xlsx|max:8192',
                'anggota_ktm' => 'required|mimes:zip|max:22768'
            ]);
                
            // create Team
            $team = new Team;
            $team->name = $request->name;
            $team->cabang_lomba = $request->cabang_lomba;
            $team->member_count = $memberCount;
            $team->save();

            // save ktm into cloud
            if($request->file('anggota_excel')) {
                $newFilename = 'excel_'.Auth::user()->university_id.'_'.$team->id.'_'.str_replace(" ","",$team->name).'.'.$request->file('anggota_excel')->getClientOriginalExtension();
                $this->saveIntoCloud('DATA_ANGGOTA',$newFilename,$request->file('anggota_excel'));
                $team->excel_member = $newFilename;
            }

            // save ktm into cloud
            if($request->file('anggota_ktm')) {
                $newFilename = Auth::user()->university_id.'_'.$team->id.'_'.str_replace(" ","",$team->name).'.'.$request->file('anggota_ktm')->getClientOriginalExtension();
                $this->saveIntoCloud('KTM_ZIP',$newFilename,$request->file('anggota_ktm'));
                $team->archive_member = $newFilename;
            }

            
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
        }

        

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
                    $cabanglomba = CabangLomba::where('id','=',$team->cabang_lomba)->first();
                    $subs = Submission::where('team_id',"=",$teamId)->first();
                    
                    return view(
                        'teams.detail', 
                        [
                            'team' => $team ,
                            'cabanglomba' => $cabanglomba,
                            'pt' => $pt,
                            'subs' => $subs
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
        $cabangLomba = CabangLomba::where('id','=',$team->cabang_lomba)->first();
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

        if($team->member_count != null){
            $memberCount = $team->member_count;
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
        if($request->anggota_id){
            $oldmembercount = count($request->anggota_id);
        }
        $memberCount = $request->jumlah_anggota;
        $team = Team::findOrFail($teamId);
        $members = Member::all();
        $cabangLomba = CabangLomba::where('id','=',$request->cabang_lomba)->first();
        $maxAnggota = $cabangLomba->anggota - 1;
        $univId = Auth::user()->university_id;
        $request->anggota_ganti_ktm = explode (",", $request->anggota_ganti_ktm); 

        if($memberCount <= 6){
            $validateData = $request->validate([
                'name' => 'required|max:50',
                'cabang_lomba' => 'required',
                'anggota_name.*' => 'required',
                'anggota_nim.*' => 'required',
                'anggota_email.*' => 'required|email',
                'anggota_university_id.*' => 'required',
                'anggota_prodi.*' => 'required',
                'anggota_ktm.*' => 'required'
            ]);

            if($memberCount!=0){
                foreach ($members as $member) {
                    foreach ($request->anggota_nim as $key => $anggotanim) {
                        if($member->nim == $anggotanim){
                            if($member->university_id != $univId){
                                return redirect()->back()->with('error', 'Nim telah terdaftar !');
                            }
                        }
                    }
                }

                // check if same 
                for ($i=0; $i < $memberCount; $i++) { 
                    if($request->anggota_nim[$i] == Auth::user()->nim) {
                        return redirect()->back()->with('error', 'Ketua atau Anggota tidak boleh sama!');
                    }
    
                    if($i != $memberCount-1 ){
                        if($request->anggota_nim[$i] == $request->anggota_nim[$i+1]) {
                            return redirect()->back()->with('error', 'Ketua atau Anggota tidak boleh sama!');
                        }
                    }
                    
                }
            }

            $team->name = $request->name;
            $team->cabang_lomba = $request->cabang_lomba;
            $team->save();

            $ktm_index = 0;
            for ($i=0; $i < $memberCount; $i++) { 
                if($i < $oldmembercount){
                    $member = Member::where('id','=',$request->anggota_id[$i])->first();
                    $member->name = $request->anggota_name[$i];
                    $member->nim = $request->anggota_nim[$i];
                    $member->phone = $request->anggota_phone[$i];
                    $member->email = $request->anggota_email[$i];
                    $member->university_id = $univId;
                    $member->prodi = $request->anggota_prodi[$i];

                    if($request->anggota_ganti_ktm[$i] == 1){
                        if($request->file('anggota_ktm')[$ktm_index]) {
                            $newFilename = $univId.'_'.$request->anggota_nim[$i].'.'.$request->file('anggota_ktm')[$ktm_index]->getClientOriginalExtension();
                            $this->saveIntoCloud('KTM',$newFilename,$request->file('anggota_ktm')[$ktm_index]);
                            $member->ktm = $newFilename;
                            $ktm_index++;
                        }
                    }
    
                    $member->save();
                }else{
                    $member = new Member;
                    $member->name = $request->anggota_name[$i];
                    $member->nim = $request->anggota_nim[$i];
                    $member->phone = $request->anggota_phone[$i];
                    $member->email = $request->anggota_email[$i];
                    $member->university_id = $univId;
                    $member->prodi = $request->anggota_prodi[$i];

                    if($request->anggota_ganti_ktm[$i] == 1){
                        if($request->file('anggota_ktm')[$ktm_index]) {
                            $newFilename = $univId.'_'.$request->anggota_nim[$i].'.'.$request->file('anggota_ktm')[$ktm_index]->getClientOriginalExtension();
                            $this->saveIntoCloud('KTM',$newFilename,$request->file('anggota_ktm')[$ktm_index]);
                            $member->ktm = $newFilename;
                            $ktm_index++;
                        }
                    }
    
                    $member->save();
                    
                    $memberId = $member->id;

                    $role = 'Anggota';
                    $team->members()->attach($memberId,[ 'role' => $role]);
                }
                
            }
        }else{
            // validate file upload
            $validateData = $request->validate([
                'anggota_excel' => 'required|mimes:xlsx|max:8192',
                'anggota_ktm' => 'required|mimes:zip|max:22768'
            ]);
                
            // get Team
            $team->name = $request->name;
            $team->cabang_lomba = $request->cabang_lomba;

            // save ktm into cloud
            if($request->file('anggota_excel')) {
                $newFilename = 'excel_'.Auth::user()->university_id.'_'.$teamId.'_'.str_replace(" ","",$team->name).'.'.$request->file('anggota_excel')->getClientOriginalExtension();
                $this->saveIntoCloud('DATA_ANGGOTA',$newFilename,$request->file('anggota_excel'));
                $team->excel_member = $newFilename;
            }

            // save ktm into cloud
            if($request->file('anggota_ktm')) {
                $newFilename = Auth::user()->university_id.'_'.$teamId.'_'.str_replace(" ","",$team->name).'.'.$request->file('anggota_ktm')->getClientOriginalExtension();
                $this->saveIntoCloud('KTM_ZIP',$newFilename,$request->file('anggota_ktm'));
                $team->archive_member = $newFilename;
            }

            $team->save();
        }

        

        

        return redirect()->route('teams.show', ['team' => $teamId])->with('message', 'Tim berhasil di edit');

    }

    public function destroy($teamId)
    {
        $team = Team::findOrFail($teamId);

    //    return ($team->members);
        foreach($team->members as $member) {
            if($member->pivot->role == 'Ketua'){
                $memberKetua = $member->pivot->member_id;
            }
        }

        // mengambil user id dari ketua
        $memberKetua = Member::where('id','=',$memberKetua)->first();        
        
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
        $memberKetua = Member::where('id','=',$memberKetua)->first();        
        
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

        if ($file == null){
            $upfile->storeAs($dir["path"],$filename,'google');
        }else {
            Storage::cloud()->delete($file['path']);
            $upfile->storeAs($dir["path"],$filename,'google');
        }
        
        return 'File was created in the sub directory in Google Drive';
    }
}
