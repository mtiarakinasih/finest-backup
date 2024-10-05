<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Income;
use Illuminate\Support\Facades\Auth;

class FinancialController extends Controller
{
    public function getFinancialAllocation()
    {
        $user = Auth::user();
        $primary = Income::where('user_id', $user->id)->where('category', 'primary')->sum('amount');
        $secondary = Income::where('user_id', $user->id)->where('category', 'secondary')->sum('amount');
        $investment = Income::where('user_id', $user->id)->where('category', 'investment')->sum('amount');
        $debt = Income::where('user_id', $user->id)->where('category', 'debt')->sum('amount');

        $total = $primary + $secondary + $investment + $debt;

        $allocation = [
            'primary' => [
                'amount' => $primary,
                'percentage' => $total > 0 ? round(($primary / $total) * 100, 2) : 0
            ],
            'secondary' => [
                'amount' => $secondary,
                'percentage' => $total > 0 ? round(($secondary / $total) * 100, 2) : 0
            ],
            'investment' => [
                'amount' => $investment,
                'percentage' => $total > 0 ? round(($investment / $total) * 100, 2) : 0
            ],
            'debt' => [
                'amount' => $debt,
                'percentage' => $total > 0 ? round(($debt / $total) * 100, 2) : 0
            ],
            'total' => $total
        ];

        return response()->json($allocation);
    }
}