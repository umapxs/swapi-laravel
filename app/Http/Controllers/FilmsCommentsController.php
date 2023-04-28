<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Film;
use Illuminate\Database\Eloquent\Model;
use Yoeunes\Toastr\Toastr;

class FilmsCommentsController extends Controller
{
    protected $activityLogsController;

    public function __construct(ActivityLogsController $activityLogsController)
    {
        $this->activityLogsController = $activityLogsController;
    }

    public function store(Request $request, $id)
    {
        $film = Film::findOrFail($id);

        $request->validate([
            'comment' => 'required',
        ]);

        $comment = $film->comments()->create([
            'user_id' => auth()->id(),
            'comment' => $request->input('comment'),
        ]);

        // log info
        $this->activityLogsController->log('Films', 'StoreComment');

        if($film instanceof Model) {
            toastr()->success('Your note was posted successfully', 'Success');

            return back();
        }

        toastr()->error('Oops, something went wrong', 'Error');

        return back();

    }
}
