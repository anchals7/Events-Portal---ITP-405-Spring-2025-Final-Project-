<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    // Store a new comment
    public function store(Request $request, Event $event)
    {
        $request->validate([
            'comment' => 'required|string|max:255',
        ]);
    
        $comment = new Comment();
        $comment->user_id = Auth::id();
        $comment->event_id = $event->id;
        $comment->comment = $request->comment;  // Use 'comment' here
        $comment->save();
    
        return back()->with('success', 'Comment added successfully!');
    }

    public function update(Request $request, Comment $comment)
    {
        

        if ($comment->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }
    
        $validated = $request->validate([
            'comment' => 'required|string|max:255',
        ]);
    
        $comment->update($validated);
    
        return back()->with('success', 'Comment updated successfully!');
    }

    // Destroy a comment
    public function destroy(Comment $comment)
    {
        if ($comment->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        if ($comment->user_id != Auth::id()) {
            return redirect()->back()->withErrors('You can only delete your own comments.');
        }

        $comment->delete();
        return back()->with('success', 'Comment deleted successfully!');
    }
}
