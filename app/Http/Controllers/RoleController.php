<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\Util\Utils;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Session::put('title', 'Dashboard Role');
        //
//        $tickets = Ticket::where('user_id', auth()->user()->id)->get();
        if (Auth::user()->hasRole('Project Manager')) {
            $role = Role::orderBy('id_role', 'asc')->paginate(10);
            return view('role.index')->with('role', $role);
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
        Session::put('title', 'Create Role');
        //
        if (Auth::user()->hasRole('Project Manager')) {
            return view('role.create');
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
        $request->validate( [
            'nama_role'=>'required',
            'ket' => 'nullable'
        ]);

        // $this->user_id = auth()->user()->id;
        $role = new Role([
            'nama_role' => $request->get('nama_role'),
            'keterangan'=> $request->get('keterangan')
        ]);
        $role->save();

        return redirect('roles')->with('success', 'Role Berhasil Dibuat');
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
        Session::put('title', 'Edit Role');
        //
        /*$ticket = Ticket::where('user_id', auth()->user()->id)
            ->where('id', $id)
            ->first();*/
        if (Auth::user()->hasRole('Project Manager')) {
            $role = Role::findOrFail($id);
            return view('role.edit')->with('role', $role);
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

        $role = new Role();
        $request->validate( [
            'nama_role' => 'required',
            'keterangan' => 'nullable']);

        $role = Role::find($id);
        //$ticket->user_id = auth()->user()->id;
        $role->nama_role = $request->get('nama_role');
        $role->keterangan = $request->get('keterangan');
        $role->save();

        return redirect('roles')->with('success', 'Role Berhasil Diubah');

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
            $role = Role::find($id);
            $role->delete();

            return redirect()->back();

        }

        else{
            //Tambah warning
            return view('home')->with(abort(403, 'Unauthorized action.'));
        }
    }
}
