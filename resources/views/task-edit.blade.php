@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Task</h1>
    <form id="taskForm">
        <div class="row">

            <div class="col-md-6">
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ $task->title }}" required>
                </div>
            </div>
            <div class="col-md-6">

                <div class="form-group">
                    <label for="due_date">Due Date:</label>
                    <input type="date" name="due_date" id="due_date" class="form-control" value="{{ date('Y-m-d', strtotime($task->due_date)) }}">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea name="description" id="description" class="form-control">{{ $task->description }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update Task</button>
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a> <!-- Back button -->
    </form>
</div>

<script>
    document.getElementById('taskForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent default form submission

        const formData = new FormData(this); // Get form data
        const formDataJson = Object.fromEntries(formData.entries()); // Convert form data to JSON

        // Send PUT request to the API endpoint
        fetch('http://localhost:8000/api/tasks/{{ $task->id }}', {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // Include CSRF token in the headers
                },
                body: JSON.stringify(formDataJson) // Convert JSON data to string
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Failed to update task');
                }
                return response.json();
            })
            .then(data => {
                alert('Task updated successfully');
                window.location.href = '/'; // Redirect to the home page
            })
            .catch(error => {
                console.error('Error updating task:', error);
                alert('Failed to update task. Please try again.');
            });
    });
</script>
@endsection