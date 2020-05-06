<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmailInvitation;
use App\Team;
use App\User;
use App\Proposal;
use Auth;

class TeamController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $userLogin = Auth::user();
        $users = User::all();
        $teamUser = [];

        if(Auth::user()->role == "Reviewer") {
            return back()->with('error','Anda tidak punya akses');
        } else if(Auth::user()->role == "Admin") {
            $teams = Team::paginate(10);
            return view('teams.index', ['teams' => $teams]);
        } else {
            foreach($users as $user) {
                foreach($user->teams as $team) {
                    if($team->pivot->user_id == $userLogin->id) {
                        $teamUser[] = $team;
                    }
                }
            }
            return view('teams.index', ['teams' => $teamUser]);
        }
    }

    public function create()
    {   
        $teams = Team::all();
        $users = User::all();

        if(Auth::user()->role != "Mahasiswa") {
            return redirect()->back()->with('error','Anda tidak bisa membuat team karena anda bukan mahasiswa');
        }
        if(Auth::user()->ktm == null || Auth::user()->phone == null || Auth::user()->prodi == null || Auth::user()->nim == null || Auth::user()->name == null) {
            return redirect()->back()->with('error', 'Anda harus melengkapi profil terlebih dahulu pada halaman profil');
        }

        $userTeam = 0;
        foreach($teams as $tim) {
            foreach($tim->users as $user) {
                if(Auth::user()->id == $user->id && $user->pivot->status == "Disetujui") {
                    $userTeam += 1;
                }
            }
        }
        
        if($userTeam >= 3) {
            return redirect()->back()->with('error','Anda sudah berada di 3 tim!');
        }
         
        foreach($users as $user) {
            if($user->id == Auth::user()->id) {
                foreach($user->teams as $team) {
                    if($team->pivot->role == "Ketua") {
                        return redirect()->back()->with('error','Tidak bisa membuat tim karena anda adalah ketua di tim lain!');
                    }
                }
            }
        }

        $userLogin = Auth::user()->id;
        $usersExcept = User::all()->except($userLogin);
        return view('teams.create', ['users' => $usersExcept]);
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|max:50',
            'cabang_lomba' => 'required',
            'anggota1' => 'required',
            'dosbing' => 'required'
        ]);

        $users = User::all();
        $teams = Team::all();
        $dosbings = User::where('role','Dosen');

        if($request->anggota1 == $request->anggota2) {
            return redirect()->back()->with('error', 'Anggota 1 dan anggota 2 tidak boleh sama!');
        }

        $team = new Team;
        $team->name = $request->name;
        $role = "Ketua";
        $status = "Disetujui";
        $team->cabang_lomba = $request->cabang_lomba;
        $team->save();
        $team->users()->attach(Auth::user()->id, ['role' => $role, 'status' => $status]);
        $team->users()->attach($request->dosbing, ['role' => 'Dosen Pembimbing']);

        if($request->anggota1) {
            $userTeam = 0;
            foreach($teams as $tim) {
                foreach($tim->users as $user) {
                    if($request->anggota1 == $user->id && $user->pivot->status == "Disetujui") {
                        $userTeam += 1;
                    }
                }
            }
            if($userTeam >= 3) {
                $teamsCreated = $teams->where('name',$request->name);
                foreach($teamsCreated as $tim) {
                    $team->users()->detach(Auth::user()->id, ['role' => $role, 'status' => $status]);
                    $tim->delete();
                }
                return redirect()->back()->with('error','Anggota 1 sudah berada di 3 tim!');
            }
            $team->users()->attach($request->anggota1);
        }

        if($request->anggota2) {
            $userTeam = 0;
            foreach($teams as $tim) {
                foreach($tim->users as $user) {
                    if($request->anggota2 == $user->id && $user->pivot->status == "Disetujui") {
                        $userTeam += 1;
                    }
                }
            }
            if($userTeam >= 3) {
                $teamsCreated = $teams->where('name',$request->name);
                foreach($teamsCreated as $tim) {
                    $team->users()->detach(Auth::user()->id, ['role' => $role, 'status' => $status]);
                    $tim->delete();
                }
                return redirect()->back()->with('error','Anggota 2 sudah berada di 3 tim!');
            }
            $team->users()->attach($request->anggota2);
        }
        
        // send email
        $emailTeam = [];
        foreach($team->users as $user) {
            if($user->id != Auth::user()->id) {
                $emailTeam[] = $user->email;
            }
        }

        foreach($emailTeam as $emailUser) {
            Mail::to($emailUser)->send(new SendEmailInvitation($team));
        }

        return redirect()->route('teams.show', ['team' => $team->id])->with('message', 'Tim berhasil dibuat');
    }

    public function approve($teamId)
    {
        $teams = Team::all();
        $userLogin = Auth::user();
        $userTeam = 0;
        $teamMember = 0;
        $teamDosen = 0;

        if($userLogin->role == "Mahasiswa") {
            if(Auth::user()->ktm == null || Auth::user()->phone == null || Auth::user()->prodi == null || Auth::user()->nim == null || Auth::user()->name == null) {
                return redirect()->back()->with('error', 'Anda harus melengkapi profil terlebih dahulu pada halaman profil');
            }
        }

        foreach($teams as $team) {
            foreach($team->users as $user) {
                if($user->pivot->user_id == $userLogin->id && $user->pivot->status == "Disetujui") {
                    $userTeam += 1;
                } 
            }
        }

        foreach($teams as $team) {
            foreach($team->users as $user) {
                if($user->pivot->team_id == $teamId && $user->pivot->status == "Disetujui" && $user->role == "Mahasiswa") {
                    $teamMember += 1;
                }
            }
        }

        foreach($teams as $team) {
            foreach($team->users as $user) {
                if($user->pivot->team_id == $teamId && $user->pivot->status == "Disetujui" && $user->role == "Dosen") {
                    $teamDosen += 1;
                }
            }
        }

        if($userLogin->role == "Mahasiswa") {
            if($teamMember >= 3) {
                return redirect()->back()->with('error','Tim sudah penuh!');
            }
            if($userTeam >= 3) {
                return redirect()->back()->with('error','Anda sudah terdaftar di 3 tim!');
            }
        }
        
        if($userLogin->role == "Mahasiswa") {
            foreach($teams as $team) {
                foreach($team->users as $user) {
                    if($user->pivot->team_id == $teamId && $user->pivot->user_id == $userLogin->id) {
                        $team->users()->detach($userLogin->id, ['role' => 'Anggota', 'status' => 'Menunggu']);
                        $team->users()->attach($userLogin->id, ['role' => 'Anggota', 'status' => 'Disetujui']);
                        return redirect()->route('teams.index')->with('message', 'Tim berhasil disetujui');
                    }
                }
            }
        } elseif($userLogin->role == "Dosen") {
            foreach($teams as $team) {
                foreach($team->users as $user) {
                    if($user->pivot->team_id == $teamId && $user->pivot->user_id == $userLogin->id) {
                        $team->users()->detach($userLogin->id, ['role' => 'Dosen Pembimbing', 'status' => 'Menunggu']);
                        $team->users()->attach($userLogin->id, ['role' => 'Dosen Pembimbing', 'status' => 'Disetujui']);
                        return redirect()->route('teams.index')->with('message', 'Tim berhasil disetujui');;
                    }
                }
            }            
        }

    }

    public function reject($teamId)
    {
        $team = Team::findOrFail($teamId);
        if(Auth::user()->role == "Mahasiswa") {
            foreach($team->users as $user) {
                if($user->id == Auth::user()->id) {
                    $team->users()->detach(Auth::user()->id, ['role' => 'Anggota', 'status' => 'Menunggu']);
                    $team->users()->attach(Auth::user()->id, ['role' => 'Anggota', 'status' => 'Ditolak']);
                    return redirect()->route('teams.index')->with('message', 'Tim berhasil ditolak');
                }
            }
        } else {
            foreach($team->users as $user) {
                if($user->id == Auth::user()->id) {
                    $team->users()->detach(Auth::user()->id, ['role' => 'Dosen Pembimbing', 'status' => 'Menunggu']);
                    $team->users()->attach(Auth::user()->id, ['role' => 'Dosen Pembimbing', 'status' => 'Ditolak']);
                    return redirect()->route('teams.index')->with('message', 'Tim berhasil ditolak');
                }
            }
        }

    }

    public function show($teamId)
    {
        $users = User::all();
        $userLogin = Auth::user();

        if(Auth::user()->role == "Admin") {
            $team = Team::findOrFail($teamId);
            return view('teams.detail', ['team' => $team]);
        }

        foreach($users as $user) {
            foreach($user->teams as $team) {
                if($team->id == $teamId && $team->pivot->user_id == $userLogin->id) {
                    $team = Team::findOrFail($teamId);
                    return view('teams.detail', ['team' => $team]);
                }
            }
        }

        return redirect()->back()->with('error','Anda bukan anggota tim ini');
    }

    public function edit($teamId)
    {
        $team = Team::findOrFail($teamId);
        $userLogin = Auth::user()->id;
        $users = User::all()->except($userLogin);

        if(Auth::user()->role == "Admin") {
            return view('teams.edit', ['team' => $team])->with(['users' => $users]);
        }

        foreach($team->users as $user) {
            if($user->id == $userLogin && $user->pivot->status == "Disetujui" && $user->role != "Dosen" && $user->pivot->role == "Ketua") {
                return view('teams.edit', ['team' => $team])->with(['users' => $users]);
            }
        }
        return redirect()->back()->with('error', 'Anda bukan ketua tim ini!');
    }

    public function update(Request $request, $teamId)
    {
        $users = User::all();
        $teams = Team::all();
        $dosbings = User::where('role','Dosen');
        $team = Team::findOrFail($teamId);

        if($request->dosbing) {
            foreach($team->users as $user) {
                if($user->pivot->role == "Dosen Pembimbing" && $user->pivot->status == "Disetujui") {
                    return redirect()->back()->with('error','Anda sudah mempunyai dosen pembimbing!');
                }
                if($user->id == $request->dosbing && $user->pivot->role == "Dosen Pembimbing") {
                    return redirect()->back()->with('error','Dosen pembimbing yang anda pilih sudah di tim anda!');                    
                }
            }
        }

        if($request->anggota1) {
            $userTeam = 0;
            foreach($teams as $tim) {
                foreach($tim->users as $user) {
                    if($user->id == $request->anggota1) {
                        return redirect()->back()->with('error','Anggota 1 yang anda piliih sudah di tim anda!');
                    }

                    if($request->anggota1 == $user->id && $user->pivot->status == "Disetujui") {
                        $userTeam += 1;
                    }
                }
            }
            if($userTeam >= 3) {
                return redirect()->back()->with('error','Anggota 1 sudah berada di 3 tim!');
            }
        }

        if($request->anggota2) {
            $userTeam = 0;
            foreach($teams as $tim) {
                foreach($tim->users as $user) {
                    if($user->id == $request->anggota2) {
                        return redirect()->back()->with('error','Anggota 2 yang anda pilih sudah di tim anda!');
                    }

                    if($request->anggota2 == $user->id && $user->pivot->status == "Disetujui") {
                        $userTeam += 1;
                    }
                }
            }
            if($userTeam >= 3) {
                return redirect()->back()->with('error','Anggota 2 sudah berada di 3 tim!');
            }
        }
        
        $team->name = $request->name;
        $team->cabang_lomba = $request->cabang_lomba;
        $team->save();

        if($request->anggota1) {
            $team->users()->attach($request->anggota1);
        }
        if($request->anggota2) {
            $team->users()->attach($request->anggota2);
        }
        if($request->dosbing) {
            $team->users()->attach($request->dosbing, ['role' => 'Dosen Pembimbing']);
        }

        // send email
        $emailTeam = [];
        foreach($team->users as $user) {
            if($user->id != Auth::user()->id) {
                if($request->anggota1 == $user->id) {
                    $emailTeam[] = $user->email;
                }
                if($request->anggota2 == $user->id) {
                    $emailTeam[] = $user->email;
                }
                if($request->dosbing == $user->id) {
                    $emailTeam[] = $user->email;
                }
            }
            
        }

        foreach($emailTeam as $emailUser) {
            Mail::to($emailUser)->send(new SendEmailInvitation($team));
        }

        return redirect()->route('teams.show', ['team' => $teamId])->with('message', 'Tim berhasil di edit');
    }

    public function destroy($teamId)
    {
        if(Auth::user()->role != "Admin") {
            return redirect()->back()->with('error', 'Anda tidak punya akses!');
        }

        $usersId = [];
        $team = Team::findOrFail($teamId);
        $proposalTeams = Proposal::all()->where('team_id', $teamId);

        // hapus proposal yang dimiliki tim
        foreach($proposalTeams as $proposal) {
            $proposal->delete();
        }

        foreach($team->users as $user) {
            $usersId[] = $user->pivot->user_id;
        }

        // hapus user yang berelasi dengan tim di table user_team
        $team->users()->detach($usersId);

        $team->delete();

        return redirect()->back()->with('message', 'Tim berhasil dihapus');
    }
}
