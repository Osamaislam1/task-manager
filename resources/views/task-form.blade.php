@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add Task</h1>
    <form id="taskForm">
    <div class="row">

        <div class="col-md-6">
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="due_date">Due Date:</label>
                <input type="date" name="due_date" id="due_date" class="form-control">
            </div>
        </div>
    </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea name="description" id="description" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Add Task</button>
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a> <!-- Back button -->

    </form>
</div>

<script>
    document.getElementById('taskForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent default form submission

        const formData = new FormData(this); // Get form data
        const formDataJson = Object.fromEntries(formData.entries()); // Convert form data to JSON

        // Send POST request to the API endpoint
        fetch('http://localhost:8000/api/tasks', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // Include CSRF token in the headers
                },
                body: JSON.stringify(formDataJson) // Convert JSON data to string
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Failed to add task');
                }
                return response.json();
            })
            .then(data => {
                alert('Task added successfully');
                window.location.href = '{{ url()->previous() }}'; // Redirect to the previous page
            })
            .catch(error => {
                console.error('Error adding task:', error);
                alert('Failed to add task. Please try again.');
            });
    });
</script>
@endsection