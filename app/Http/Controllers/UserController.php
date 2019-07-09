<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $userView = User::join('role', 'role.id_role', '=', 'users.role_id')
            ->select('users.*', 'role.nama_role')
            ->getQuery()
            ->get();

        return view('user.index')->with('user', $userView);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $role = Role::all();

        return view('user.create')->with('role', $role);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate( [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role_id' => 'required']);


        $user = new User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = $request->input('password');
        $user->role_id = $request->input('role_id');
        $user->save();
        return redirect('/users')->with('success', 'User Ditambahkan');

//        // $this->user_id = auth()->user()->id;
//        $role = new Role([
//            'nama_role' => $request->get('nama_role'),
//            'keterangan'=> $request->get('keterangan')
//        ]);
//        $role->save();
//
//        return redirect('/roles')->with('success', 'New support ticket has been created! Wait sometime to get resolved');
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
        $role = Role::all();

        $user = User::find($id);
        return view('user.edit', compact('user','role'));
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
        //
        $request->validate( [
            'name' => 'required',
            'email' => 'required',
            'role_id' => 'required'
        ]);

        $user = User::find($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->role_id = $request->input('role_id');
        $user->save();
        return redirect('/users')->with('success', 'User Diedit');

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
        $user = User::find($id);
        $user->delete();
        return redirect('/user')->with('success', 'Post Removed');
    }
}
