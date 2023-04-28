<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\People;
use Illuminate\Database\Eloquent\Model;
use Yoeunes\Toastr\Toastr;

class PeoplesCommentsController extends Controller
{
    protected $activityLogsController;

    public function __construct(ActivityLogsController $activityLogsController)
    {
        $this->activityLogsController = $activityLogsController;
    }

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

        // log info
        $this->activityLogsController->log('Peoples', 'StoreComment');

        if($people instanceof Model) {
            toastr()->success('Your note was posted successfully', 'Success');

            return back();
        }

        toastr()->error('Oops, something went wrong', 'Error');

        return back();

    }
}
