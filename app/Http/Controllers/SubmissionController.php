<?php

namespace App\Http\Controllers;

use Auth;
use App\CabangLomba;
use App\ConfigApps;
use App\Member;
use App\PerguruanTinggi;
use App\Proposal;
use App\Team;
use App\User;
use App\Submission;
use App\Mail\SendEmailInvitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class SubmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($teamId)
    {   
        $team = Team::findOrFail($teamId);
        $members = Member::all();
        $memberLogin = Member::where('user_id','=',Auth::user()->id)->first();
        $pt = PerguruanTinggi::where('id','=',Auth::user()->university_id)->first();
        $cabangLomba = CabangLomba::where('id','=',$team->cabang_lomba)->first();
        
        return view(
            'submissions.index', 
            [
                'team' => $team,
                'teamId' => $teamId,
                'cabangLomba' => $cabangLomba,
                'pt' => $pt
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($teamId)
    {
        $team = Team::findOrFail($teamId);
        $members = Member::all();
        $memberLogin = Member::where('user_id','=',Auth::user()->id)->first();
        $pt = PerguruanTinggi::where('id','=',Auth::user()->university_id)->first();
        $cabangLomba = CabangLomba::where('id','=',$team->cabang_lomba)->first();
        
        return view(
            'submissions.create', 
            [
                'team' => $team,
                'teamId' => $teamId,
                'cabangLomba' => $cabangLomba,
                'pt' => $pt
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($teamId,Request $request)
    {
        // dd($request);
        // avoid timeout
        set_time_limit(300);

        $config = ConfigApps::All()->first();
        if($config->is_upload_proposal == 1){
            // validate file upload
            $validateData = $request->validate([
                'judul_karya' => 'required',
                'lembar_orisinalitas' => 'required|mimes:doc,docx,pdf|max:8192'
            ]);

            $team = Team::findOrFail($teamId);
            $cabangLomba = CabangLomba::where('id','=',$team->cabang_lomba)->first();

            if($cabangLomba->proposal_submission == 1){
                $validateData = $request->validate([
                    'proposal' => 'required|mimes:pdf|max:8192'
                ]);
            }

            if($cabangLomba->link_submission == 1){
                $validateData = $request->validate([
                    'link_subs' => 'required'
                ]);
            }
            
            $submission = new Submission;
            $submission->team_id = $teamId;
            $submission->judul = $request->judul_karya;
            $submission->status = "1";

            if($request->file('lembar_orisinalitas')){
                $newFilename = 'orisinalitas_'.Auth::user()->university_id.'_'.$teamId.'_'.str_replace(" ","",$team->name).'.'.$request->file('lembar_orisinalitas')->getClientOriginalExtension();
                $this->saveIntoCloud('ORISINALITAS',$newFilename,$request->file('lembar_orisinalitas'));
                $submission->orisinalitas = $newFilename;
            }

            if($request->link_subs){
                $submission->link = $request->link_subs;
            }
            
            if($request->file('proposal')){
                $newFilename = 'proposal_'.$cabangLomba->nickname.'_'.Auth::user()->university_id.'_'.$teamId.'_'.str_replace(" ","",$team->name).'.'.$request->file('proposal')->getClientOriginalExtension();
                $this->saveIntoCloud('PROPOSAL',$newFilename,$request->file('proposal'));
                $submission->file = $newFilename;
            }

            $submission->save();
            return redirect()->route('teams.show', ['team' => $teamId])->with('message', 'Submission Berhasil Diunggah');

        
        }else{
            return redirect()->back()->with('error', 'Anda tidak bisa mengubah karena telah melewati batas waktu yang ditentukan!');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($subsId,$teamId)
    {
        $subs = Submission::findOrFail($subsId);
        $team = Team::find($teamId);
        $members = Member::all();
        $memberLogin = Member::where('user_id','=',Auth::user()->id)->first();
        $pt = PerguruanTinggi::where('id','=',Auth::user()->university_id)->first();
        $cabangLomba = CabangLomba::where('id','=',$team->cabang_lomba)->first();
        
        return view(
            'submissions.edit', 
            [
                'subs' => $subs,
                'team' => $team,
                'teamId' => $teamId,
                'cabangLomba' => $cabangLomba,
                'pt' => $pt
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $subsId,$teamId)
    {
        // dd($request);
        // avoid timeout
        set_time_limit(300);

        $config = ConfigApps::All()->first();
        if($config->is_upload_proposal == 1){
            // validate file upload
            $validateData = $request->validate([
                'judul_karya' => 'required'
            ]);

            $team = Team::findOrFail($teamId);
            $cabangLomba = CabangLomba::where('id','=',$team->cabang_lomba)->first();

            if($cabangLomba->proposal_submission == 1){
                $validateData = $request->validate([
                    'proposal' => 'mimes:pdf|max:8192',
                    'lembar_orisinalitas' => 'mimes:doc,docx,pdf|max:8192'
                ]);
            }

            if($cabangLomba->link_submission == 1){
                $validateData = $request->validate([
                    'link_subs' => 'required'
                ]);
            }
            
            $submission = Submission::find($subsId);
            $submission->team_id = $teamId;
            $submission->judul = $request->judul_karya;
            $submission->status = "1";

            if($request->file('lembar_orisinalitas')){
                $newFilename = 'orisinalitas_'.Auth::user()->university_id.'_'.$teamId.'_'.str_replace(" ","",$team->name).'.'.$request->file('lembar_orisinalitas')->getClientOriginalExtension();
                $this->saveIntoCloud('ORISINALITAS',$newFilename,$request->file('lembar_orisinalitas'));
                $submission->orisinalitas = $newFilename;
            }

            if($request->link_subs){
                $submission->link = $request->link_subs;
            }
            
            if($request->file('proposal')){
                $newFilename = 'proposal_'.$cabangLomba->nickname.'_'.Auth::user()->university_id.'_'.$teamId.'_'.str_replace(" ","",$team->name).'.'.$request->file('proposal')->getClientOriginalExtension();
                $this->saveIntoCloud('PROPOSAL',$newFilename,$request->file('proposal'));
                $submission->file = $newFilename;
            }

            $submission->save();
            return redirect()->route('teams.show', ['team' => $teamId])->with('message', 'Submission Berhasil Diperbarui');

        
        }else{
            return redirect()->back()->with('error', 'Anda tidak bisa mengubah karena telah melewati batas waktu yang ditentukan!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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
