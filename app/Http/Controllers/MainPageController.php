<?php

namespace App\Http\Controllers;

use App\Models\Poll;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MainPageController extends Controller
{
    //
    public function index(){
        return Poll::with('questions.options.vote')->get();
    }
    public function getResults($id){
        $poll = Poll::with('questions.options.votes')->findOrFail($id);
        return Inertia::render('Polls/Results',[
            'poll'=>$poll
        ]);
    }
    public function getPolls($id){
        return  Poll::with('questions.options.votes')->findOrFail($id);
    }
}
