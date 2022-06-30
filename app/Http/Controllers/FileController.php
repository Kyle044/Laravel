<?php

namespace App\Http\Controllers;

use App\Models\FileUser;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
class FileController extends Controller
{
    
//Web Routes
public function index(){
        //Select all
        $user = FileUser::all();
       return view('index',["users"=>$user]);
}

public function registerweb(){
        return view('register');
}

public function tableweb(){
     $file = File::all();
     $user = FileUser::all();
     return view('table',['files'=>$file,'users'=>$user]);
}


public function fileuploadweb(){
        return view('fileupload');
}


//User Controller

public function registerUser(){
        // insert
         //check username
        $userDB = FileUser::where('username', request("username"))->first();
        if(!$userDB){
        $user = new FileUser();
        $user->firstname = request("fname");
        $user->lastname = request("lname");
        $user->username = request("username");
        $user->company = request("company");
        $user->password = Hash::make(request("password"));
        $user->save();
        return response()->json(['data'=>'Data is successfully added','boolean'=>true]);
        }else{
        return response()->json(['data'=>'Username is already in the Database.','boolean'=>false]);
        }


}


public function checkUser(Request $request){
        //check username
          $user = FileUser::where('username', $request->username)->first();
        if(!$user){
                   return response()->json(['data'=>false , 'msg'=>"The username is not recognized."]);
        }else{
            //check password
            if(Hash::check($request->password, $user->password)){
                //session
                $request->session()->put('user_id', $user->id);
                $request->session()->put('username', $user->username);
                $request->session()->put('firstname',$user->firstname);
                $request->session()->put('lastname',$user->lastname);
           
                return response()->json(['data'=>true , 'msg'=>"Login Successfully" ,"user"=>$user]);
            }else{
                   return response()->json(['data'=>false , 'msg'=>"The password is incorrect"]);
            }
        }
}
public function userLogOut(Request $request){
        
        $request->session()->flush();
        if ($request->session()->has('firstname')) {
                return response()->json(['data'=>"Something Went Wrong Try Again.",'boolean'=>false]);
        }
         else{
                  return response()->json(['data'=>"Successfully Logged Out.",'boolean'=>true]);
         }

}



//File Controller


public function fileupload(Request $request){

$ext = $request->file('file')->getClientOriginalName();
$fileExt = explode('.', $ext);
$fileActualExt = strtolower(end($fileExt));
$request->file('file')->storeAs("public/upload",$request->filename.".".$fileActualExt);

$file = new File();
$file->filename = $request->filename;
$file->dataflow = $request->company;
$file->	fileDIR = $request->filename.".".$fileActualExt;
$file->user_ID_FK = session()->get('user_id');
$file->save();
   return response()->json(['data'=>"Successfully Uploaded." ,"raw"=>$request]);
}



public function downloadfile(Request $request,$file){



return response()->download(public_path('storage\\upload\\'.$file));


}
















}