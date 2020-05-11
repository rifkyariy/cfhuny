<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Auth;
use App\User;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // $formatStudent = "student.uny.ac.id";
        // $formatDosen = "uny.ac.id";
        $reviewers = [];

        $email = Auth::user()->email;
        $id = Auth::user()->id;

        // $validEmailStudent = strpos($email,$formatStudent);
        // $validEmailDosen = strpos($email,$formatDosen);

        // admin
        if($email == "kemahasiswaan@uny.ac.id") {
            $admin = User::findOrFail($id);
            $admin->role = "Admin";
            $admin->save();

            return redirect()->route('admin.index');
        }

        // reviewer
        if(in_array($email,$reviewers)) {
            $reviewer = User::findOrFail($id);
            $reviewer->role = "Reviewer";
            $reviewer->save();

            return redirect()->route('admin.index');
        }

        // if($validEmailStudent == false and $validEmailDosen == true) {
        //     // dosen
        //     $dosen = User::findOrFail($id);
        //     $dosen->role = "Dosen";
        //     $dosen->save();
        //     return redirect()->route('admin.index');
        // } else if($validEmailStudent == true) {
        //     // mahasiswa            
        //     return redirect('teams.index');
        // } else if(Auth::user()->role == "Reviewer" || Auth::user()->role == "Admin") {
        //     // reviewer atau admin
        //     return redirect()->route('admin.index');
        // } else {
            //     // email asing
            //     Auth::logout();
            //     User::findOrFail($id)->delete();
            //     return redirect('/')->with('error','Akun yang digunakan untuk login harus akun UNY! Silahkan login kembali');
        // }
        
        return redirect()->route('users.profile');
    }
}