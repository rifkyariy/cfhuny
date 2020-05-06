<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Proposal;
use App\User;
use Auth;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $userLogin = Auth::user();

        if($userLogin->role == "Mahasiswa") {
            return redirect()->back()->with('error','Anda tidak punya akses');
        } else if($userLogin->role == "Dosen") {
            $teamProposal = [];
            $proposalUser = [];

            $totalProposals = 0;
            $totalApproved = 0;
            $totalRejected = 0;
            $totalWaiting = 0;

            // mendapatkan data teams dari user yang login
            foreach($userLogin->teams as $team) {
                if($team->pivot->user_id == $userLogin->id && $team->pivot->status == "Disetujui") {
                    $teamProposal[] = $team;
                }
            }

            // mendapatkan data proposals dari teams user yang login
            foreach($teamProposal as $team) {
                foreach($team->proposals as $proposal) {
                    $proposalUser[] = $proposal;
                }
            }

            foreach($proposalUser as $proposal) {
                $totalProposals += 1;
                if($proposal->status == "Disetujui") {
                    $totalApproved += 1;
                } elseif($proposal->status == "Ditolak") {
                    $totalRejected += 1;
                } else {
                    $totalWaiting += 1;
                }
            }

        // Get current page form url e.x. &page=1
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
 
        // Create a new Laravel collection from the array data
        $proposalCollection = collect($proposalUser);
 
        // Define how many products we want to be visible in each page
        $perPage = 10;
 
        // Slice the collection to get the products to display in current page
        $currentPageproposals = $proposalCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
 
        // Create our paginator and pass it to the view
        $paginatedproposals= new LengthAwarePaginator($currentPageproposals , count($proposalCollection), $perPage);
 
        // set url path for generted links
        $paginatedproposals->setPath($request->url());
            
            return view('admins.index')
            ->with(['proposals' => $paginatedproposals])
            ->with(['totalProposals' => $totalProposals])
            ->with(['totalApproved' => $totalApproved])
            ->with(['totalRejected' => $totalRejected])
            ->with(['totalWaiting' => $totalWaiting]);
        } else {
            // role admin dan reviewer
            $proposals = Proposal::paginate(10);
            $totalProposals = Proposal::all()->count('id');
            $totalApproved = Proposal::where('status','Disetujui')->count('id');
            $totalRejected = Proposal::all()->where('status','Ditolak')->count('id');
            $totalWaiting = Proposal::all()->where('status','Menunggu Review')->count('id');

            return view('admins.index')
                ->with(['proposals' => $proposals])
                ->with(['totalProposals' => $totalProposals])
                ->with(['totalApproved' => $totalApproved])
                ->with(['totalRejected' => $totalRejected])
                ->with(['totalWaiting' => $totalWaiting]);
        }
    }

    public function approve(Request $request, $id)
    {
        $proposal = Proposal::findOrFail($id);
        $proposal->status = "Disetujui";
        $proposal->ulasan = $request->ulasan;
        $proposal->save();
        return redirect()->route('admin.index')->with('message', 'Usulan Disetujui');
    }

    public function reject(Request $request, $id)
    {
        $proposal = Proposal::findOrFail($id);
        $proposal->status = "Ditolak";
        $proposal->ulasan = $request->ulasan;
        $proposal->save();
        return redirect()->route('admin.index')->with('message', 'Usulan Ditolak');
    }

    public function download($id)
    {
        if(Auth::user()->role == 'Mahasiswa') {
            return redirect()->back()->with('error','Anda tidak punya akses');
        }

        $proposal = Proposal::findOrFail($id);

        return Storage::download('public/'.$proposal->link_file, $proposal->judul . " - " . $proposal->team->name);
    }
}
