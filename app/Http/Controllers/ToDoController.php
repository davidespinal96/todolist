<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use Illuminate\Support\Facades\Auth;

class ToDoController extends Controller{
    public function index(Request $request){
        if($request->input('task')){
            $tasks = Task::where('user_id',Auth::user()->id)->paginate(4);
            $tasks->withPath('');
        }
        else{
            $search = $request->input('search');
            $tasks = Task::where('content','LIKE','%'.$search.'%')->paginate(4);
            $tasks->withPath('?search='.$search);
        }

        return view('index',compact('tasks'));
    }

    // public function renderSearch(Request $request){
    //     $search = $request->input('search');
    //     $tasks = Task::where('content','LIKE','%'.$search.'%')->paginate(4);
    //     return view('index',compact('tasks'));
    // }

    public function store(Request $request){
        if($request->input('task')){
            $task = new Task;
            $task->content = $request->input('task');
            Auth::user()->tasks()->save($task);
        }

        return redirect()->back();
    }

    public function edit($id){
        $task = Task::find($id);
        return view('edit',['task'=>$task]);
    }

    public function update(Request $request, $id){
        if($request->input('task')){
            $task = Task::find($id);
            $task->content = $request->input('task');
            $task->save();
        }
        return redirect('/');
    }

    public function delete($id){
        $task = Task::find($id);
        $task->delete();
        return redirect()->back();
    }

    public function updateStatus($id){
        $task = Task::find($id);
        $task->status = ! $task->status;
        $task->save();
        return redirect()->back();
    }

    public function search(){
        $data = Task::all();
        return response()->json($data);
    }
}
