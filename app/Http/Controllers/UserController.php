<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Support\Facades\Session;
use App\Mail\WelcomeMail;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        if($user->role == 'user'){
            // $users = User::paginate(5);
            return view('auth/profile',compact('user'));
        }

        if($user->role == 'admin'){
            $users = User::paginate(5);
            return view('users',compact('users'));
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user,$id)
    {
        $user = User::find($id);
        return view('profile-edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user,$id)
    {
        $request->validate([
            'name' =>  ['required', 'string', 'max:255',"unique:users,name,$id"],
            'email' =>  ['required', 'string', 'max:255',"unique:users,email,$id"],
            'phone' =>  ['required', 'string', 'max:255',"unique:users,phone,$id"],
        ]);
        $data = $request->toArray();
        unset($data['_token']);   
        unset($data['_method']); 
        unset($data['password_confirmation']);

        $ret = User::where('id',$id)->update($data);
        // return $ret;
        if($ret){
            Session::flash('pmessage', 'User Profile updated Successfully'); 
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user,$id)
    {

        $ret = User::where('id',$id)->delete();
        if($ret){
            Session::flash('pmessage', 'User Deleted Successfully, User Id '.$id); 
        }
        return redirect()->back();
    }

    public function status_change(Request $request, $id)
    {
        $user = User::find($id);
        if(@$user->status){
            $ret = User::where('id',$id)->update(['status'=>'0']);
        }else{
            $ret = User::where('id',$id)->update(['status'=>'1']);
        }
        if($ret){
            return response()->json(['status'=>"success","id"=>$id,"return"=>$ret,'active'=>!$user->status]);
        }else{
            return response()->json(['status'=>"failed","id"=>$id,'msg'=>"Invalid User Id"]);
        }
    }

    public function remove_user(Request $request, $id)
    {
        $ret = User::destroy($id);
        if($ret){
            return response()->json(['status'=>"success","id"=>$id,"return"=>$ret]);
        }else{
            return response()->json(['status'=>"failed","id"=>$id,'msg'=>"Invalid User Id"]);
        }

    }

    public function send_mail(Request $request, $id)
    {

        $user = User::find($id);

        $mailData = [
            "email" => $user->email,
            "name" => $user->name
        ];
        try {
            \Mail::to($user->email)->send(new WelcomeMail($mailData));
            // return true;
            return "send success";
            }
            catch(\Exception $e) {    
                return $e->getMessage();
        }


    }
}
