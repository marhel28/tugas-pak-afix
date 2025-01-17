<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chirp;
use App\Models\Report;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $timeframe = $request->get('timeframe', 'daily');

        $stats = [
            'active_users' => User::where('is_active', true)->count(),
            'total_chirps' => $this->getChirpsCount($timeframe),
            'total_reports' => $this->getReportsCount($timeframe),
        ];

        return view('admin.dashboard', compact('stats'));
    }

    private function getChirpsCount($timeframe)
    {
        return Chirp::when($timeframe === 'daily', function ($query) {
                return $query->whereDate('created_at', today());
            })
            ->when($timeframe === 'weekly', function ($query) {
                return $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
            })
            ->when($timeframe === 'monthly', function ($query) {
                return $query->whereMonth('created_at', now()->month);
            })
            ->count();
    }

    private function getReportsCount($timeframe)
    {
        return Report::when($timeframe === 'daily', function ($query) {
                return $query->whereDate('created_at', today());
            })
            ->when($timeframe === 'weekly', function ($query) {
                return $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
            })
            ->when($timeframe === 'monthly', function ($query) {
                return $query->whereMonth('created_at', now()->month);
            })
            ->count();
    }
}
