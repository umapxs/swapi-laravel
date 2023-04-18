<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Starship;

class StarshipsCommentsController extends Controller
{
    protected $activityLogsController;

    public function __construct(ActivityLogsController $activityLogsController)
    {
        $this->activityLogsController = $activityLogsController;
    }

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

        // log info
        $this->activityLogsController->log('starships', 'storeComment');

        return back()->with('success', 'Your note was posted successfully');
    }
}
