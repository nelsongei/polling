<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class PollController extends Controller
{
    //
    public function index()
    {
        return Inertia::render('Polls/Index');
    }
    public function create(){
        return Inertia::render('Polls/Create');
    }
}
