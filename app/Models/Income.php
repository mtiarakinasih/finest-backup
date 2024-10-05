<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'amount',
        'date',
        'category',
        'user_id',
        'primary_allocation',
        'secondary_allocation',
        'investment_allocation',
        'debt_allocation',
    ];

    // Method to calculate allocation based on income and debt
    public function calculateAllocation($debtAmount = 0)
    {
        $allocation = [
            'primary' => 0,
            'secondary' => 0,
            'investment' => 0,
            'debt' => 0,
        ];

        // Calculate primary, secondary, investment, and debt allocations
        $remainingAmount = $this->amount;

        // Example allocation logic (customize as needed)
        if ($debtAmount > 0) {
            $allocation['debt'] = min($debtAmount, $remainingAmount);
            $remainingAmount -= $allocation['debt'];
        }

        // Example distribution: Customize these percentages as necessary
        $allocation['primary'] = $remainingAmount * 0.50; // 50% to primary
        $remainingAmount -= $allocation['primary'];

        $allocation['secondary'] = $remainingAmount * 0.30; // 30% to secondary
        $remainingAmount -= $allocation['secondary'];

        $allocation['investment'] = $remainingAmount; // Remaining amount to investment

        return $allocation;
    }
}
