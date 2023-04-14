<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Starship;

class StarshipsCommentsController extends Controller
{
    public function store(Request $request, $id)
    {
        $starship = Starship::findOrFail($id);

        $request->validate([
            'comment' => 'required',
        ]);

        $comment = $starship->comments()->create([
            'user_id' => auth()->id(),
            'comment' => $request->input('comment'),
        ]);

        return back();
    }
}
