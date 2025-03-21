<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $messages = Message::with(['user'])->get();
        $userId = auth()->user()->id;

        $formattedMessages = $messages->map(function ($message) use ($userId) {
            return [
                ...$message->toArray(),
                'user_name' => $message->user->name,
                'user' => $message->user_id === $userId ? 'self' : 'other'
            ];
        });

        return Inertia::render('Dashboard', ['messages' => $formattedMessages]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'message' => ['required','string'],
        ]);

        Message::create([
            'message'=> $validated['message'],
            'user_id'=> auth()->user()->id,
        ]);

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message)
    {
        //
    }
}
