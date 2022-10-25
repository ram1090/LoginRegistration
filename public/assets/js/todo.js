$(document).ready(function () {
    // toast initializtion 
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });

    // creating new task
    const table = $('#todo_table').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: $('body').data('url') + "/todo-list",
        columns: [
            { data: 'id', name: 'id' },
            { data: 'task', name: 'task' },
            { data: 'status', name: 'status' },
            { data: 'created_at', name: 'created_at' },
            { data: 'action', name: 'action' }
        ]
    });

    $("#NewTaskForm").on("submit", function (event) {
        event.preventDefault();
        let url = $('body').data('url') + "/api/todo/add";
        $.ajax({
            type: "POST",
            url: url,
            data: $(this).serialize(),
            success: function (response) {
                table.ajax.reload();
                bootstrap.Modal.getInstance($("#addTaskModel")).hide();
                Toast.fire({
                    icon: 'success',
                    title: response.message
                });
            }
        });
    });
    // updateing task status
    $(document).on("click", ".edit_task", function () {
        let task = $(this).data('task');
        let url = $('body').data('url') + "/api/todo/update/" + task.id;
        $("#task_title").val(task.task);
        $("#UpdateTaskForm").attr("action", url);
        var myModal = new bootstrap.Modal(document.getElementById('updateTaskModel'));
        myModal.show();
    });

    $(document).on("submit", "#UpdateTaskForm", function (event) {
        event.preventDefault();
        let url = $(this).attr('action');
        $.ajax({
            type: "PUT",
            url: url,
            data: $(this).serialize(),
            success: function (response) {
                table.ajax.reload();
                bootstrap.Modal.getInstance($("#updateTaskModel")).hide();
                Toast.fire({
                    icon: 'success',
                    title: response.message
                });
            }
        })
    });



    $(document).on("click", ".change_status", function () {
        let task = $(this).data('task');
        let status = task.status === "done" ? 'pending' : 'done';
        let url = $('body').data('url') + "/api/todo/status";
        $.ajax({
            type: "POST",
            url: url,
            data: { task_id: task.id, status: status },
            success: function (response) {
                table.ajax.reload();
                Toast.fire({
                    icon: 'success',
                    title: response.message
                });
            }
        })

    });


    $(document).on("click", ".delete_task", function () {
        if (confirm("Are you sure to delete this task?")) {
            let id = $(this).data('id');
            let url = $('body').data('url') + "/api/todo/delete/" + id;
            $.ajax({
                type: "DELETE",
                url: url,
                success: function (response) {
                    table.ajax.reload();
                    Toast.fire({
                        icon: 'success',
                        title: response.message
                    });
                }
            })
        }
        else {
            return false;
        }
    });
});