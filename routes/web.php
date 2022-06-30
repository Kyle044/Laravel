<?php

use App\Http\Controllers\FileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;




//Login System
Route::get('/', [FileController::class,'index']);
Route::post('/', [FileController::class,'checkUser']);
Route::get('/register',  [FileController::class,'registerweb']);
Route::post('/register',  [FileController::class,'registerUser']);



//Table
Route::get('/table',  [FileController::class,'tableweb']);
Route::get('/table/download{file}',  [FileController::class,'downloadfile']);
Route::get('/tableLogOut',  [FileController::class,'userLogOut']);



//Upload
Route::get('/fileupload',  [FileController::class,'fileuploadweb']);
Route::post('/fileupload',  [FileController::class,'fileupload']);

















// Route::get('/posts/{id}',function($id){
//     //debugging tools
//     //dd($id); or ddd($id);
//     return response('Post '. $id);
// })
//    //constraints or validation
// ->where('id','[0-9]+');
// Route::get('/search',function(Request $request){
// return $request->name;
// });