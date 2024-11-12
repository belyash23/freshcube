<?php

namespace App\Http\Controllers;

use App\Models\ActionsHistory;
use Illuminate\Http\Request;

class ActionsHistoriesController extends Controller
{
    public function list(Request $request)
    {
        /** @var ActionsHistory[] $history */
        $history = ActionsHistory::query()
            ->orderBy('created_at', 'desc')
            ->select(['action', 'success', 'created_at'])
            ->get();

        $formattedHistory = [];

        foreach ($history as $item) {
            $formattedHistory [] = [
                'action' => $item->action,
                'success' => $item->success,
                'created_at' => $item->created_at->getTimestamp(),
            ];
        }

        return response(
            [
                'data' => $formattedHistory,
            ],
        );
    }
}
