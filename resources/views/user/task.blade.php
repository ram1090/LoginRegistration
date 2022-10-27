@extends("layouts.app")
@section("title","Todo List")
<!-- page title-->

@section("customStyle")
<!-- custom style section start  -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet"
    href="{{ asset('assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
<!-- custom style section end  -->
@endsection

@section('customScript')
<!-- custom script section start  -->
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('assets/js/todo.js?temp='.time()) }}"></script>
<!-- custom script section end  -->
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card rounded-0 border-0 shadow-sm">
            <div class="card-header d-flex justify-content-between">
                <h4 class="card-title">Todo List</h4>
                <button data-bs-toggle="modal" data-bs-target="#addTaskModel"
                    class="btn btn-sm btn-primary rounded-0"><i class="fas fa-plus-circle"></i> Add New Task</button>
            </div>
            <div class="card-body">
                <table class="table display responsive" width="100%" id="todo_table">
                    <thead>
                        <tr>
                            <th>Sr. No</th>
                            <th>Task</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>


{{-- new task model --}}
<div class="modal fade" id="addTaskModel">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-0">
            <div class="modal-header">
                <h5 class="modal-title">Add New Task</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="NewTaskForm">
                <div class="modal-body">
                    <input type="text" required name="task" class="form-control rounded-0"
                        placeholder="Enter task title..." />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary rounded-0" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary rounded-0" id="createTaskButton">Create Task</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- update task model --}}
<div class="modal fade" id="updateTaskModel">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-0">
            <div class="modal-header">
                <h5 class="modal-title">Update Task</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="UpdateTaskForm">
                <div class="modal-body">
                    <input type="text" required name="task" id="task_title" class="form-control rounded-0"
                        placeholder="Enter task title..." />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary rounded-0" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary rounded-0" id="updateFormButton">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
