<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    public function index() {
        /**
         * @var project Project
         * */
        $project = Project::find(763);
        $tasks = $project->tasks();
        return view('tasks', compact('tasks'));
    }

    public function create (Request $request) {
        $tasks = new Task;
        $tasks->priority = 1;
        $tasks->save();
        return back();

    }

    public function resort(Request $request) {
        if($request->has('items')) {
            $ids = explode(',', $request->get('items'));
            $i = 0;
            foreach($ids as $id)
            {
                $i ++;
                $item = Task::find($id);
                $item->priority = $i;
                $item->save();
            }
            return response()->json(array('success' => true));
        }
        else
        {
            return response()->json(array('success' => false));
        }
    }
}
