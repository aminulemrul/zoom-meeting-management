<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Sunday = DB::table('zoom_link')
            ->where('meeting_day','Sunday')
            ->where('user_id', Auth::user()->id)
            ->get();
        $Monday= DB::table('zoom_link')
            ->where('meeting_day','Monday')
            ->where('user_id', Auth::user()->id)
            ->get();
        $Tuesday = DB::table('zoom_link')
            ->where('meeting_day','Tuesday')
            ->where('user_id', Auth::user()->id)
            ->get();
        $Wednesday = DB::table('zoom_link')
            ->where('meeting_day','Wednesday')
            ->where('user_id', Auth::user()->id)
            ->get();
        $Thursday = DB::table('zoom_link')
            ->where('meeting_day','Thursday')
            ->where('user_id', Auth::user()->id)
            ->get();
        $Friday = DB::table('zoom_link')
            ->where('meeting_day','Friday')
            ->where('user_id', Auth::user()->id)
            ->get();
        $Saturday = DB::table('zoom_link')
            ->where('meeting_day','Saturday')
            ->where('user_id', Auth::user()->id)
            ->get();
        return view('home',compact('Saturday','Sunday','Monday','Wednesday','Thursday', 'Friday','Tuesday'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $title = $request->title;
        $link = $request->link;
        $day = $request->meeting_day;
        $time = $request->time;
        $info = $request->info;
        if (isset($info)){
            $info = serialize($info);
        }
        if (isset($title) && isset($link)){
            $insert = DB::table('zoom_link')
                ->insertGetId([
                    'title' => $title,
                    'link' => $link,
                    'meeting_day'=>$day,
                    'meeting_time'=>$time,
                    'info'=>$info,
                    'user_id'=>Auth::user()->id
                ]);
            if ($insert){
                return redirect('/')->with('success','Successfully Store Info.');
            }else{
                return redirect()->back()->with('error','Fail to Insert. Try Again!');
            }
        }else{
            return redirect()->back()->with('error','All Fields Required!');
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
    public function edit($id)
    {
        $edit = DB::table('zoom_link')->where('id',$id)->where('user_id', Auth::user()->id)->first();
        $Sunday = DB::table('zoom_link')
            ->where('meeting_day','Sunday')
            ->where('user_id', Auth::user()->id)
            ->where('id','!=', $id)
            ->get();
        $Monday= DB::table('zoom_link')
            ->where('meeting_day','Monday')
            ->where('user_id', Auth::user()->id)
            ->where('id','!=', $id)
            ->get();
        $Tuesday = DB::table('zoom_link')
            ->where('meeting_day','Tuesday')
            ->where('user_id', Auth::user()->id)
            ->where('id','!=', $id)
            ->get();
        $Wednesday = DB::table('zoom_link')
            ->where('meeting_day','Wednesday')
            ->where('user_id', Auth::user()->id)
            ->where('id','!=', $id)
            ->get();
        $Thursday = DB::table('zoom_link')
            ->where('meeting_day','Thursday')
            ->where('user_id', Auth::user()->id)
            ->where('id','!=', $id)
            ->get();
        $Friday = DB::table('zoom_link')
            ->where('meeting_day','Friday')
            ->where('user_id', Auth::user()->id)
            ->where('id','!=', $id)
            ->get();
        $Saturday = DB::table('zoom_link')
            ->where('meeting_day','Saturday')
            ->where('user_id', Auth::user()->id)
            ->where('id','!=', $id)
            ->get();

        return view('home',compact('Saturday','Sunday','Monday','Wednesday','Thursday', 'Friday','Tuesday','edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $title = $request->title;
        $link = $request->link;
        $day = $request->meeting_day;
        $time = $request->time;
        $info = $request->info;
        if (isset($info)){
            $info = serialize($info);
        }
        if (isset($title) && isset($link)){
            $up = DB::table('zoom_link')
                ->where('id', $id)
                ->update([
                    'title' => $title,
                    'link' => $link,
                    'meeting_day'=>$day,
                    'meeting_time'=>$time,
                    'info'=>$info,
                    'created_at'=>now(),
                    'user_id'=>Auth::user()->id,
                ]);
            if ($up){
                return redirect('/')->with('success','Successfully Updated Info.');
            }else{
                return redirect()->back()->with('error','Fail to Updated. Try Again!');
            }
        }else{
            return redirect()->back()->with('error','All Fields Required!');
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
        $d = DB::table('zoom_link')->where('id',$id)->where('user_id', Auth::user()->id)->delete();
        if ($d){
            return redirect('/')->with('success','Successfully Delete Info.');
        }else{
            return redirect()->back()->with('error','Fail to Delete!');
        }
    }

    public function login()
    {
        return view('login');
    }
    public function getLogin(Request $request)
    {
        $check_input = $request->only('email','password');
        if (Auth::attempt($check_input)) {
            return redirect()->intended('/');
        } else {
            return redirect('login')->with('error','Invalid User Email or Password !');
        }
    }
    public function logout()
    {
        Auth::logout();
        Session::flush();
        return redirect('login')->with('success','Successfully Logout ! ');
    }
    public function register()
    {
        return view('register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeRegister(Request $request)
    {
        $user = $request->user_name;
        $password = $request->password;
        if (isset($user) && isset($password)){
            $check = DB::table('users')->where('email',$user)->first();
            if (empty($check)){
                $insert = DB::table('users')
                    ->insert([
                        'email' => $user,
                        'password' => Hash::make($password),
                        'created_at' => now(),
                    ]);
                if ($insert){
                    return redirect('/')->with('success','Successfully Registered.');
                }else{
                    return redirect()->back()->with('error','Fail to Registered!');
                }
            }else{
                dd($check);
                return redirect()->back()->with('error','Fail to Registered! This User Name is Already Exist.');
            }
        }else{
            return redirect()->back()->with('error','Fail to Registered! All field are Required.');
        }
    }
}
