<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Task Manager') }}
        </h2>
    </x-slot>

    <div class="container py-4">
        <button class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#taskModal">➕ Add Task</button>

        <ul id="task-list" class="list-group"></ul>
    </div>

    @include('tasks.modal')

    @push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        const fetchTasks = () => {
        $.get('/tasks/list', function(tasks) {
            console.log("Fetching tasks...");

            $('#task-list').empty();
            tasks.forEach(task => {
                $('#task-list').append(`
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        ${task.title} (${task.is_done ? '✅' : '⏳'})
                        <div>
                            <button class="btn btn-sm btn-success toggle" data-id="${task.id}">Toggle</button>
                            <button class="btn btn-sm btn-warning edit" data-id="${task.id}" data-title="${task.title}">Edit</button>
                            <button class="btn btn-sm btn-danger delete" data-id="${task.id}">Delete</button>
                        </div>
                    </li>
                `);
            });
        });
    };

    $(document).ready(function() {
        fetchTasks(); // <---- this is very important
        // Handle Edit Task button click
$(document).on('click', '.edit', function () {
    const taskId = $(this).data('id');
    const taskTitle = $(this).data('title');

    // Fill modal fields
    $('#taskModalLabel').text('Edit Task');
    $('#title').val(taskTitle);
    $('#task-form').attr('action', '/tasks/' + taskId);

    // Add _method input if not already added
    if (!$('#task-form input[name="_method"]').length) {
        $('#task-form').append('<input type="hidden" name="_method" value="PUT">');
    }

    // Show Bootstrap modal (this was missing!)
    const modal = new bootstrap.Modal(document.getElementById('taskModal'));
    modal.show();
});

$(document).on('click', '.delete', function () {
    const id = $(this).data('id');
    $.ajax({
        url: '/tasks/' + id,
        type: 'DELETE',
        data: {
            _token: '{{ csrf_token() }}'
        },
        success: function () {
            fetchTasks();
        },
        error: function (xhr) {
            console.error(xhr.responseText);
        }
    });
});

$(document).on('click', '.toggle', function() {
    $.ajax({
        url: '/tasks/' + $(this).data('id') + '/toggle',
        type: 'PATCH',
        data: {
            _token: '{{ csrf_token() }}'
        },
        success: fetchTasks
    });
});


$(document).on('submit', '#task-form', function(e) {
    e.preventDefault();

    const method = $(this).find('input[name="_method"]').val() || 'POST';
    const url = $(this).attr('action') || '/tasks';

    $.ajax({
        url: url,
        type: method,
        data: $(this).serialize(),
        success: function(response) {
            console.log("✅ Task saved:", response);
            $('#taskModal').modal('hide');
            fetchTasks();

            // Reset form
            $('#task-form')[0].reset();
            $('#task-form').removeAttr('action').find('input[name="_method"]').remove();
            $('#taskModalLabel').text('Add Task');
        },
        error: function(xhr) {
            console.error("❌ Error saving task:", xhr.responseText);
        }
    });
});

    });
    </script>
    @endpush
</x-app-layout>
