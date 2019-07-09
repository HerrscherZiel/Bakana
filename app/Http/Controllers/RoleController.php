<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
//        $tickets = Ticket::where('user_id', auth()->user()->id)->get();
        $role =  Role::orderBy('id_role', 'asc')->paginate(10);
        return view('role.index')->with('role', $role);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('role.create');
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

        return redirect('/roles')->with('success', 'New support ticket has been created! Wait sometime to get resolved');
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
        /*$ticket = Ticket::where('user_id', auth()->user()->id)
            ->where('id', $id)
            ->first();*/

        $role = Role::find($id);
        return view('role.edit')->with('role', $role);

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

        return redirect('/roles')->with('success', 'New support ticket has been updated!!');
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
        $role = Role::find($id);
        $role->delete();

        return redirect('/roles')->with('success', 'Stock has been deleted Successfully');
    }
}
