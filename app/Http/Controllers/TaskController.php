<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Enums\TaskStatus;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Datatables;
class TaskController extends Controller
{

    private $response = [];
    private $status_code = 200;
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of(Task::where("user_id",$request->user()->id)->latest())
            ->editColumn('created_at', function(Task $task) {
                return $task->created_at->diffForHumans();
            })
            ->addColumn("action",function(Task $task){
                return "<button class='btn btn-sm rounded-0 change_status ".( $task->status === "done" ? "btn-outline-success" : "btn-outline-warning" )."'  data-task='".json_encode($task)."'>".( $task->status === "done" ? "Marked as done" : "Mark as done" )."</button> 
                <button class='btn btn-sm rounded-0  btn-outline-primary edit_task' data-task='".json_encode($task)."'>edit</button>
                <button class='btn btn-sm rounded-0  btn-outline-danger delete_task' data-id='".$task->id."'>delete</button>";
            })
            ->toJson();
        }
        return view('user.task');
    }



    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'task' => 'required',
        ]);

        if ($validator->fails()) {
            // return error if form validation will fail.
            return response()->json(['errors'=>$validator->errors()],422);
        }

        $data = $validator->validated();
        $data['user_id'] = $request->user()->id;
        $result = Task::create($data);
        if(!is_null($result)){
            $this->response['task'] = $result;
            $this->response['status'] = 'success';
            $this->response['message'] = 'Successfully created a task';
            $this->status_code = 201;
            
        }
        else{
            $this->response['status'] = 'error';
            $this->response['message'] = 'Unable to create new task.';
            $this->status_code = 500;
        }

        return response()->json($this->response,$this->status_code);
    }


    public function status(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'task_id' => 'required',
            'status' => ['required',new Enum(TaskStatus::class)],
        ]);


        if ($validator->fails()) {
            // return error if form validation will fail.
            return response()->json(['errors'=>$validator->errors()],422);
        }

        $data = $validator->validated();
        
        $task = Task::find($data['task_id']);
        if(!is_null($task)){

            $task->status = $data['status'];

            if($task->save()){
                $this->response['task'] = $task;
                $this->response['status'] = 'success';
                $this->response['message'] = 'Task status is changed successfully.';
            }
            else{
                $this->response['status'] = 'error';
                $this->response['message'] = 'Unable to change task status.';
                $this->status_code = 500;
            }
        }
        else{
            $this->response['status'] = 'error';
            $this->response['message'] = 'Requested task not found.';
            $this->status_code = 404;
        }
        return response()->json($this->response,$this->status_code);
    }


    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'task' => 'required',
        ]);

        if ($validator->fails()) {
            // return error if form validation will fail.
            return response()->json(['errors'=>$validator->errors()],422);
        }

        $task = Task::find($id);
        if(!is_null($task)){
            $task->task = $request->task;
            if($task->save()){
                $this->response['task'] = $task;
                $this->response['status'] = 'success';
                $this->response['message'] = 'Task updated successfully.';
            }
            else{
                $this->response['status'] = 'error';
                $this->response['message'] = 'Unable to change task status.';
                $this->status_code = 500;
            }
        }
        else{
            $this->response['status'] = 'error';
            $this->response['message'] = 'Requested task not found.';
            $this->status_code = 404;
        }
        return response()->json($this->response,$this->status_code);
    }


    public function delete($id)
    {
        $task = Task::find($id);
        if(!is_null($task)){
            if($task->delete()){
                $this->response['task'] = $task;
                $this->response['status'] = 'success';
                $this->response['message'] = 'Task deleted successfully.';
            }
            else{
                $this->response['status'] = 'error';
                $this->response['message'] = 'Unable to delete this task.';
                $this->status_code = 500;
            }
        }
        else{
            $this->response['status'] = 'error';
            $this->response['message'] = 'Requested task not found.';
            $this->status_code = 404; 
        }
        return response()->json($this->response,$this->status_code);
    }

}


