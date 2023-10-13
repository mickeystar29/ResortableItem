<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    public function index() {
        $projects = Project::all();
        $tasks = Task::all();
        return view('tasks.index', compact('tasks', 'projects'));
    }

    public function listByProject($id)
    {
        if ($id > 0) {
            $project = Project::find($id);
            $tasks = $project->tasks();
        } else {
            $tasks = Task::all();
        }
        return response()->json(array('success' => true, 'tasks' => $tasks));
    }

    /**
     *
     * @return View
     */
    public function create()
    {
        $projects = Project::all();
        return view('tasks.add', compact('projects'));
    }

    public function store (Request $request) {
        $this->validate($request, [
            'title' => 'required',
            'project_id' => 'required'
        ]);

        Task::create(['title' => $request->title, 'priority' => 1, 'project_id' => $request->project_id]);
        // $this->resortItems(Project::find($request->project_id)->tasks());
        return redirect('/tasks');

    }

    /**
     *
     * @return View
     */
    public function edit($id)
    {
        $projects = Project::all();
        $task = Task::find($id);
        return view('tasks.edit', compact('task', 'projects'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'project_id' => 'required'
        ]);

        $task = Task::find($id);
        $task->title = $request->title;
        $task->project_id = $request->project_id;
        $task->save();

        return redirect('/tasks');
    }

    public function resort(Request $request) {
        if($request->has('items')) {
            $ids = explode(',', $request->get('items'));
            // $tasks = Task::whereIn('id', $ids)->get();
            // $this->resortItems($tasks);
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

    public function destroy($id)
    {
        Task::find($id)->delete();
        return response()->json(array('success' => true));
    }

    private function resortItems($items)
    {
        $i = 0;
        foreach($items as $item)
        {
            $i ++;
            $item->priority = $i;
            $item->save();
        }
    }
}
