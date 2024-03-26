@extends('layouts.app')

@section('content')

<div class="container">
    <h1 class="mb-4">Task List</h1>
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('tasks.create') }}" class="btn btn-primary">  <i class="fa fa-plus"></i> Add Task</a>
    </div>
    <table id="task-table" class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">Due Date</th>
                <th scope="col">Status</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
<script>
    window.onload = function() {
        fetchTasks();
    };

    function fetchTasks() {
        fetch('http://localhost:8000/api/tasks')
            .then(response => response.json())
            .then(data => {
                const tableBody = document.querySelector('#task-table tbody');
                tableBody.innerHTML = '';

                data.forEach(task => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${task.title}</td>
                        <td>${task.description}</td>
                        <td>${task.due_date ? formatDate(task.due_date) : 'N/A'}</td>
                        <td>
                            <select class="form-control" onchange="updateStatus(${task.id}, this.value)">
                                <option value="0" ${task.status == 0 ? 'selected' : ''}>Incomplete</option>
                                <option value="1" ${task.status == 1 ? 'selected' : ''}>Completed</option>
                            </select>
                        </td>
                        <td>
                            <a href="/tasks/${task.id}/edit" class="btn btn-primary btn-sm"> <i class="fa fa-pencil"></i></a>
                            <button onclick="deleteTask(${task.id})" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i></button>
                        </td>
                    `;
                    tableBody.appendChild(row);
                });
            })
            .catch(error => console.error('Error fetching tasks:', error));
    }

    function formatDate(dateString) {
        const options = {
            day: '2-digit',
            month: 'short',
            year: 'numeric'
        };
        const date = new Date(dateString);
        return date.toLocaleDateString('en-US', options);
    }

    function updateStatus(taskId, status) {
        fetch(`http://localhost:8000/api/tasks/${taskId}`, {
                method: 'post',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    status: status
                })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Failed to update status');
                }
                return response.json();
            })
            .then(data => {
                alert('Status updated successfully');
                fetchTasks(); // Refresh task list
            })
            .catch(error => console.error('Error updating status:', error));
    }

    function deleteTask(taskId) {
        fetch(`http://localhost:8000/api/tasks/${taskId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Failed to delete task');
                }
                return response.json();
            })
            .then(data => {
                alert('Task deleted successfully');
                fetchTasks(); // Refresh task list
            })
            .catch(error => console.error('Error deleting task:', error));
    }
</script>
@endsection