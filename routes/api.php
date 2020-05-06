<?php

use Illuminate\Http\Request;
use App\PerguruanTinggi;

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

Route::get('/sel2/perguruantinggi', function(Request $request){
    if($request!=null){
        $search = $request->input('search');
        $result = PerguruanTinggi::select('id','name as text')->where('name','like','%'.$search.'%')->orderBy('id')->get();
    }else{
        $result = PerguruanTinggi::select('id','name as text')->orderBy('id')->get();
    }
    
    return response()->json($result, 200) ;
});

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

