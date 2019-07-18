<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Util\Utils;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function index()
    {
        Session::put('title', 'Dashboard User');
        //
        if (Auth::user()->hasRole('Project Manager')) {
            $users = User::join('role', 'role.id_role', '=', 'users.role_id')
                ->select('users.*', 'role.nama_role')
                ->getQuery()
                ->get();

            /*$user =  User::orderBy('id', 'asc')->paginate(10);*/

            $user = $users;
            /*dd($user);*/

            return view('user.index')->with('user', $user);
        }

        else{
            //Tambah warning
            return view('home')->with(abort(403, 'Unauthorized action.'));
        }


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        if (Auth::user()->hasRole('Project Manager')) {
            $role = Role::all();

            return view('user.create')->with('role', $role);
        }
        else{
            //Tambah warning
            return view('home')->with(abort(403, 'Unauthorized action.'));
        }

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

        //$request->user()->authorizeRoles(['Project Manager']);
        //if (Auth::user()->hasRole('Project Manager')) {
            $request->validate([
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


       // }

//        else{
//        //Tambah warning
//            abort(403, 'Unauthorized action.');
//            return view('home');
//        }

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
        Session::put('title', 'Edit User');
        //
        if (Auth::user()->hasRole('Project Manager')) {
            $role = Role::all();

            $user = User::find($id);
            return view('user.edit', compact('user', 'role'));
        }
        else{
            //Tambah warning
            return view('home')->with(abort(403, 'Unauthorized action.'));
        }

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
        if (Auth::user()->hasRole('Project Manager')) {
            $user = User::find($id);
            $user->delete();
            return redirect('/users')->with('success', 'Post Removed');
        }

        else{
            //Tambah warning
            return view('home')->with(abort(403, 'Unauthorized action.'));
        }
    }
}
