<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Task;

class FrontendTaskController extends Controller
{
    public function index()
    {

        return view('task-list');
    }

    public function create()
    {
        return view('task-form');
    }
    public function edit($id)
    {
        $task = Task::findOrFail($id);
        return view('task-edit', compact('task'));
    }
}
