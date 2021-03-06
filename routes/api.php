<?php

use Illuminate\Http\Request;
use App\PerguruanTinggi;
use App\CabangLomba;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// select2 Dropdown
Route::get('/sel2/perguruantinggi', function(Request $request){
    if($request->input('search')!=null){
        $search = $request->input('search');
        $result = PerguruanTinggi::select('id','name as text')->where('name','like','%'.$search.'%')->orderBy('id')->get();
    }else{
        $result = PerguruanTinggi::select('id','name as text')->orderBy('id')->get();
    }
    
    return response()->json($result, 200) ;
});

Route::get('/sel2/cabanglomba', function(Request $request){
    if($request->input('search')!=null){
        $search = $request->input('search');
        $result = CabangLomba::select('id','name as text')->where('name','like','%'.$search.'%')->orderBy('id')->get();
    }else{
        $result = CabangLomba::select('id','name as text')->orderBy('id')->get();
    }
    
    return response()->json($result, 200) ;
});

//File download : ktm
Route::get('/file/ktm', function(Request $request){
    $filename = $request->input('filename');
    $dir = '/';
    $recursive = true; // Get subdirectories also?
    $contents = collect(Storage::cloud()->listContents($dir, $recursive));

    $file = $contents
        ->where('type', '=', 'file')
        ->where('filename', '=', pathinfo($filename, PATHINFO_FILENAME))
        ->where('extension', '=', pathinfo($filename, PATHINFO_EXTENSION))
        ->first(); // there can be duplicate file names!

    //return $file; // array with file info

    $rawData = Storage::cloud()->get($file['path']);

    // return $rawData;
    return response($rawData, 200)
        ->header('ContentType', $file['mimetype'])
        ->header('Content-Disposition', "attachment; filename=$filename");
});

//File download : all
Route::get('/file/data', function(Request $request){
    $filename = $request->input('filename');
    $dir = '/';
    $recursive = true; // Get subdirectories also?
    $contents = collect(Storage::cloud()->listContents($dir, $recursive));

    $file = $contents
        ->where('type', '=', 'file')
        ->where('filename', '=', pathinfo($filename, PATHINFO_FILENAME))
        ->where('extension', '=', pathinfo($filename, PATHINFO_EXTENSION))
        ->first(); // there can be duplicate file names!


        // dd($filename,$file);
    //return $file; // array with file info

    $rawData = Storage::cloud()->get($file['path']);

    // return $rawData;
    return response($rawData, 200)
        ->header('ContentType', $file['mimetype'])
        ->header('Content-Disposition', "attachment; filename=$filename");
});




//File download : template
Route::get('/file/template', function(Request $request){
    // return $rawData;
    return Storage::download($request->input('filename'));
});


// API GET
Route::get('/data/member', function(Request $request){
    if($request->input('search')!=null){
        $search = $request->input('search');
        $result = Member::where('nim','like','%'.$search.'%')->orderBy('id')->get();
        return response()->json($result, 200) ;
    }else{
        return response()->json('Error Not Found', 404) ;
    }
});



Route::get('/data/cabanglomba', function(Request $request){
    if($request->input('id')!=null){
        $id = $request->input('id');
        $result = CabangLomba::where('id','=',$id)->first();
    }else if($request->input('search')!=null){
        $search = $request->input('search');
        $result = CabangLomba::where('name','like','%'.$search.'%')->orderBy('id')->get();
    }else{
        $result = CabangLomba::orderBy('id')->get();
    }
    
    return response()->json($result, 200) ;
});




