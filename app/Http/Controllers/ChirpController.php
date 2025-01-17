<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chirp;
use Illuminate\Http\Request;

class ChirpController extends Controller
{
    public function index()
    {
        $chirps = Chirp::with('user')
            ->latest()
            ->paginate(15);
        return view('admin.chirps.index', compact('chirps'));
    }

    public function destroy(Chirp $chirp)
    {
        $chirp->delete();
        return back()->with('success', 'Chirp deleted successfully');
    }

    public function toggleReview(Chirp $chirp)
    {
        $chirp->update(['needs_review' => !$chirp->needs_review]);
        return back()->with('success', 'Chirp marked for review');
    }
}
