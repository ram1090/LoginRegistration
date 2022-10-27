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
        ajax: "/todo-list",
        columns: [
            {
                data: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }, name: 'id'
            },
            { data: 'task', name: 'task' },
            {
                data: function (row) {
                    return row.status === "done" ? `<span class='badge text-bg-success'>${row.status}</span>` :
                     `<span class='badge text-bg-danger'>${row.status}</span>`;
                },
                name: 'status'
            },
            { data: 'created_at', name: 'created_at' },
            { data: 'action', name: 'action' }
        ],
        columnDefs: [{
            targets: [3, 4], // column index (start from 0)
            orderable: false, // set orderable false for selected columns
            searchable: false,
        }]
    });

    $("#NewTaskForm").on("submit", function (event) {
        event.preventDefault();
        let url = "/api/todo/add";
        let form = $(this);
        $.ajax({
            type: "POST",
            url: url,
            data: $(this).serialize(),
            beforeSend: function () {
                $("#createTaskButton").html(` <i class="fa-solid fa-circle-notch fa-spin"></i> Processing...`);
                $("#createTaskButton").removeClass("btn-primary");
                $("#createTaskButton").addClass("btn-info");
            },
            complete: function () {
                $("#createTaskButton").html(`Create Task`);
                $("#createTaskButton").addClass("btn-primary");
                $("#createTaskButton").removeClass("btn-info");
            },
            success: function (response) {
                table.ajax.reload();
                bootstrap.Modal.getInstance($("#addTaskModel")).hide();
                Toast.fire({
                    icon: 'success',
                    title: response.message
                });
                $(form).trigger('reset');
            },
            error: function (xhr, status, error) {
                Toast.fire({
                    icon: 'error',
                    title: xhr.responseJSON.message
                });
            }
        });
    });
    // updateing task status
    $(document).on("click", ".edit_task", function () {
        let task = $(this).data('task');
        let url = "/api/todo/update/" + task.id;
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
            beforeSend: function () {
                $("#updateFormButton").html(` <i class="fa-solid fa-circle-notch fa-spin"></i> Processing...`);
                $("#updateFormButton").removeClass("btn-primary");
                $("#updateFormButton").addClass("btn-info");
            },
            complete: function () {
                $("#updateFormButton").html(`Save changes`);
                $("#updateFormButton").addClass("btn-primary");
                $("#updateFormButton").removeClass("btn-info");
            },
            success: function (response) {
                table.ajax.reload();
                bootstrap.Modal.getInstance($("#updateTaskModel")).hide();
                Toast.fire({
                    icon: 'success',
                    title: response.message
                });
            },
            error: function (xhr, status, error) {
                Toast.fire({
                    icon: 'error',
                    title: xhr.responseJSON.message
                });
            }
        })
    });



    $(document).on("click", ".change_status", function () {
        let task = $(this).data('task');
        let status = task.status === "done" ? 'pending' : 'done';
        let url = "/api/todo/status";
        let button = $(this);
        $.ajax({
            type: "POST",
            url: url,
            data: { task_id: task.id, status: status },
            beforeSend: function () {
                $(button).html(` <i class="fa-solid fa-circle-notch fa-spin"></i> Processing...`);
                $(button).removeClass("btn-outline-success btn-outline-warning");
                $(button).addClass("btn-outline-info");
            },
            success: function (response) {
                table.ajax.reload();
                Toast.fire({
                    icon: 'success',
                    title: response.message
                });
            },
            error: function (xhr, status, error) {
                Toast.fire({
                    icon: 'error',
                    title: xhr.responseJSON.message
                });
            }
        })

    });


    $(document).on("click", ".delete_task", function () {
        if (confirm("Are you sure to delete this task?")) {
            let id = $(this).data('id');
            let url = "/api/todo/delete/" + id;
            let button = $(this);
            $.ajax({
                type: "DELETE",
                url: url,
                beforeSend: function () {
                    $(button).html(`<i class="fa-solid fa-circle-notch fa-spin"></i> Processing...`);
                },
                success: function (response) {
                    table.ajax.reload();
                    Toast.fire({
                        icon: 'success',
                        title: response.message
                    });
                },
                error: function (xhr, status, error) {
                    Toast.fire({
                        icon: 'error',
                        title: xhr.responseJSON.message
                    });
                }
            })
        }
        else {
            return false;
        }
    });
});