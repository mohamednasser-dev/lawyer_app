<?php

namespace App\Http\Controllers;

use App\Suggestion;

class SuggestionsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $data = Suggestion::orderBy('created_at', 'desc')->get();
        return view('manager.suggestion', compact('data'));
    }
}
