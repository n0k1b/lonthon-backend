<?php

namespace App\Http\Controllers;

use App\Models\creatorTransactionDetail;

class WithdrawController extends Controller
{
    //
    public function withdrawDashboard()
    {
        $user = auth('api')->user();
        $hasRecords = creatorTransactionDetail::where('creator_id', $user->id)->exists();

        if (!$hasRecords) {
            return $this->successJsonResponse('User Balance', [
                'balance' => 0,
                'last_transactions' => [],
            ]);
        }

        $totalCredit = creatorTransactionDetail::where('creator_id', $user->id)
            ->where('transaction_type', 'credit')
            ->sum('price');

        $totalDebit = creatorTransactionDetail::where('creator_id', $user->id)
            ->where('transaction_type', 'debit')
            ->sum('price');

        $balance = $totalCredit - $totalDebit;

        // Fetch last 5 transaction details with their statuses
        $lastTransactions = creatorTransactionDetail::where('creator_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get(['price', 'transaction_type', 'status', 'created_at']);

        return $this->successJsonResponse('User Balance', [
            'balance' => $balance,
            'last_transactions' => $lastTransactions,
        ]);
    }

}
