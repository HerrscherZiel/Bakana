<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PMcontroller extends Controller
{
    //
    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['Unassigned', 'Project Manager']);
        if (Auth::user()->hasRole('Project Manager')) {
            return view('project.index');
        }
        elseif (Auth::user()->hasRole('Unassigned')) {
            return view('team.index');
        }
    }
}
