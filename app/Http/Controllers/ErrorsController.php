<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ErrorsController extends Controller
{
    //
    public function index()
    {
        //
        return view('errors.403');
    }

    public function err404()
    {
        //
        return view('errors.404');
    }

    public function err400()
    {
        //
        return view('errors.400');
    }

    public function err419()
    {
        //
        return view('errors.419');
    }

    public function err500()
    {
        //
        return view('errors.500');
    }
}
