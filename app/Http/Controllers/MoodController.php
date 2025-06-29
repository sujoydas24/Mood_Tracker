<?php

namespace App\Http\Controllers;

use App\Models\Mood;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MoodController extends Controller
{

    public function index()
{
    $moods = Mood::where('user_id', auth()->id())
        ->latest('date')
        ->get();

    return view('dashboard', compact('moods'));
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'mood' => 'required|in:Happy,Sad,Angry,Excited',
            'note' => 'nullable|string',
        ]);

        $userId = Auth::id();

        // duplicate mood chek
        $existing = Mood::where('user_id', $userId)
            ->where('date', $request->date)
            ->first();

        if ($existing) {
            return redirect()->back()->with('error', 'already submitted');
        }

        Mood::create([
            'user_id' => $userId,
            'date' => $request->date,
            'mood' => $request->mood,
            'note' => $request->note,
        ]);

        return back()->with('success', 'Mood logged!');
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mood $mood)
    {
            $request->validate([
        'note' => 'nullable|string',
    ]);

    if ($mood->user_id !== auth()->id()) {
        abort(403);
    }

    $mood->update([
        'note' => $request->note,
    ]);

    return back()->with('success', 'Note updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mood $mood)
    {
        if ($mood->user_id !== auth()->id()) {
        abort(403);
    }

    $mood->update(['note' => null]);

    return back()->with('success', 'Note deleted.');

    }
}