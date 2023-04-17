<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\People;

class PeoplesCommentsController extends Controller
{
    public function store(Request $request, $id)
    {
        $people = People::findOrFail($id);

        $request->validate([
            'comment' => 'required',
        ]);

        $comment = $people->comments()->create([
            'user_id' => auth()->id(),
            'comment' => $request->input('comment'),
        ]);

        return back()->with('success', 'Your note was posted successfully');
    }
}
