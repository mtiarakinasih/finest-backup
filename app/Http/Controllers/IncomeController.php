<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Income;
use Auth; // Pastikan untuk mengimpor Auth

class IncomeController extends Controller
{
    // Mendapatkan alokasi berdasarkan pengguna yang terautentikasi
    public function getTotal()
{
    $totalIncome = Income::where('user_id', auth()->id())->sum('amount');
    return response()->json(['totalIncome' => $totalIncome]);
}

    public function getAllocation()
    {
        $user = Auth::user();
        $totalIncome = Income::where('user_id', $user->id)->sum('amount');

        $allocation = [
            'totalIncome' => $totalIncome,
            'primary' => Income::where('user_id', $user->id)->where('category', 'primary')->sum('amount'),
            'secondary' => Income::where('user_id', $user->id)->where('category', 'secondary')->sum('amount'),
            'investment' => Income::where('user_id', $user->id)->where('category', 'investment')->sum('amount'),
            'debt' => Income::where('user_id', $user->id)->where('category', 'debt')->sum('amount'),
        ];

        return response()->json($allocation);
    }

    // Menyimpan income baru
    public function store(Request $request)
{
    \Log::info('Income store method called', $request->all());

    try {
        // Validasi data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'date' => 'required|date',
            'category' => 'required|string|max:255',
            'debt' => 'nullable|numeric|min:0', // Debt bisa optional
        ]);

        \Log::info('Validated data', $validatedData);

        // Simpan income
        $income = new Income($validatedData);
        $income->user_id = auth()->id();
        $income->save();

        // Hitung total income
        $totalIncome = Income::where('user_id', auth()->id())->sum('amount');

        // Kembalikan response JSON untuk AJAX
        return response()->json([
            'success' => true,
            'message' => 'Income saved successfully!',
            'totalIncome' => $totalIncome
        ]);
    } catch (\Exception $e) {
        \Log::error('Error saving income: ' . $e->getMessage());
        return response()->json([
            'success' => false,
            'message' => 'Failed to save income. Please try again.'
        ], 500);
    }
}

}
