<?php

namespace App\Http\Controllers;

use App\Models\FileUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
     return view('table',["username"=>session("username")]);
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


// error_log($request->filename);
// error_log($request->company);
// error_log($request->file->file);

// if ($request->hasFile('file')) {
//         error_log("has file");
// }else{
//           error_log("does not have a file");
// }

$ext = $request->file('file')->getClientOriginalName();
$fileExt = explode('.', $ext);
$fileActualExt = strtolower(end($fileExt));
$request->file('file')->storeAs("upload",$request->filename.".".$fileActualExt);
   return response()->json(['data'=>"Successfully Uploaded." ,"raw"=>$request]);
        
}
















}