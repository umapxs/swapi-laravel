<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Starship;
use Illuminate\Database\Eloquent\Model;
use Yoeunes\Toastr\Toastr;

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
        $this->activityLogsController->log('Starships', 'StoreComment');

        if($starship instanceof Model) {
            toastr()->success('Your note was posted successfully', 'Success');

            return back();
        }

        toastr()->error('Oops, something went wrong', 'Error');

        return back();

    }
}
