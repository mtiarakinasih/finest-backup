<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Income;

class HomeController extends Controller
{
    public function index()
    {
        $totalIncome = Income::where('user_id', auth()->id())->sum('amount');
        return view('home', compact('totalIncome'));
    }
}