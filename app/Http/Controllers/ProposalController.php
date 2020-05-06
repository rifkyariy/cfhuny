<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Proposal;
use App\User;
use App\Team;
use Auth;
use Illuminate\Support\Facades\Storage;

class ProposalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($teamId)
    {
        $proposals = Proposal::all()->where('team_id', $teamId);
        $team = Team::findOrFail($teamId);

        if(Auth::user()->role == "Admin") {
            return view('proposals.index', ['proposals' => $proposals])->with('teamId', $teamId);
        }

        foreach($team->users as $user) {
            if($user->id == Auth::user()->id && $user->pivot->status == "Disetujui") {
                $nextTahap = 0;

                // cek apakah tahap 1 dst. sudah disetujui
                foreach($proposals as $proposal) {
                    if($proposal->tahap == 5 && $proposal->status == "Disetujui") {
                        $nextTahap = 6;
                    }
                    elseif($proposal->tahap == 4 && $proposal->status == "Disetujui") {
                        $nextTahap = 5;
                    } elseif($proposal->tahap == 3 && $proposal->status == "Disetujui") {
                        $nextTahap = 4;
                    } elseif($proposal->tahap == 2 && $proposal->status == "Disetujui") {
                        $nextTahap = 3;
                    } elseif($proposal->tahap == 1 && $proposal->status == "Disetujui") {
                        $nextTahap = 2;
                    } elseif($proposal->tahap == 1 && $proposal->status != "Disetujui") {
                        $nextTahap = 1;
                    }
                }

                return view('proposals.index', ['proposals' => $proposals])->with('teamId', $teamId)->with('nextTahap', $nextTahap);
            }
        }
        return redirect()->back()->with('error','Anda bukan anggota tim!');        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($teamId, Request $request)
    {
        $validation = \Validator::make($request->all(), [
            "judul" => "required",
            "tahap" => "required",
            "proposal" => "required|mimes:pdf|max:4096"
        ])->validate();

        $team = Team::findOrFail($teamId);

        foreach($team->proposals as $proposal) {
            if($proposal->status == "Menunggu Review") {
                return redirect()->back()->with('error', 'Proposal sedang dalam proses review, mohon tunggu keputusan reviewer!');
            }
        }
        foreach($team->users as $user) {
            if($user->id == Auth::user()->id && $user->pivot->status == "Disetujui" && $user->role == "Mahasiswa") {
                $anggotaTim = 0;
                $dosenTim = 0;

                foreach($team->users as $user) {
                    // cek anggota tim dengan primary $teamId yang status mahasiswa disetujui
                    if($user->pivot->status == "Disetujui" && $user->role == "Mahasiswa") {
                        $anggotaTim += 1;
                    }
                    // cek anggota tim dengan primary $teamId yang status dosen disetujui
                    if($user->pivot->status == "Disetujui" && $user->role == "Dosen") {
                        $dosenTim += 1;
                    }
                }

                if($anggotaTim < 2 ) {
                    return redirect()->back()->with('error','Anggota tim belum lengkap! Minimal 2 anggota terdaftar (termasuk ketua)');
                }
        
                if($dosenTim < 1 ) {
                    return redirect()->back()->with('error','Dosen pembimbing tim belum ada!');
                }

                $proposal = new Proposal;
                $proposal->judul = $request->judul;
                $proposal->tahap = $request->tahap;
                $proposal->team_id = $teamId;
                $proposal->link_file = $request->file('proposal')->store('proposals','public');
                $proposal->save();

                return redirect()->route('proposals.index', ['teamId' => $teamId])
                                 ->with(['team' => $team])
                                 ->with('message', 'Proposal berhasil diupload');
            }

            return redirect()->back()->with('error', 'Anda bukan ketua tim!');
        }

        return redirect()->back()->with('error', 'Anda bukan ketua tim!');
    }

    public function download($teamId, $proposalId)
    {
        $team = Team::findOrFail($teamId);
        $proposal = Proposal::findOrFail($proposalId);

        if(Auth::user()->role == "Admin") {
            return Storage::download('public/'.$proposal->link_file, $proposal->judul . " - " . $proposal->team->name);
        }

        foreach($team->users as $user) {
            if(Auth::user()->id == $user->id && $user->pivot->status == "Disetujui") {
                return Storage::download('public/'.$proposal->link_file, $proposal->judul . " - " . $proposal->team->name);
            }
        }

        return redirect()->back()->with('error', 'Anda bukan anggota tim!');
    }

}
