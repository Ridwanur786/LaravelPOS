<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(5);
        return view('users.index', ['users'=>$users]);
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
        $users = new User;
        $users->name = $request->name;
        $users->email = $request->email;
        $users->password = md5($request->password);
       // $users->confirm_pasword = md5($request->confirm_password);
        $users->address = $request->address;
        $users->city = $request->city;
        $users->phone_number = $request->phone_number;
        $users->isAdmin = $request->isAdmin;
        $users->save();
        if($users)
        {
            return redirect()->back()->with('User Created Successfully');
           
        }
         return redirect()->back()->with('Failure To Create User On the System');
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
        //
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
        $users = User::find($id);
        if(!$users)
        {
            return back()->with('Error', 'User Not Found');
        }
        $users->update($request->all());
        return back()->with('success', 'user updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
          $users = User::find($id);
        if(!$users)
        {
            return back()->with('Error', 'User Not Found');
        }
        $users->delete();
        return back()->with('success', 'user deleted successfully');
    }
}
