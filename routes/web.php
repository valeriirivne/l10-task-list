<?php

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/', function () {
    return redirect()->route('tasks.index');
});

Route::get('/tasks', function () {
    return view('index', [
        'tasks' => Task::latest()->paginate(10)
    ]);
})->name('tasks.index');

Route::view('/tasks/create', 'create')
    ->name('tasks.create');

Route::get('/tasks/{task}/edit', function (Task $task) {
    return view('edit', [
        'task' => $task
    ]);
})->name('tasks.edit');
///////////

Route::get('/tasks/{task}', function (Task $task) {

    // return view('show', ['task' => Task::findOrFail($task)]);
    return view('show', ['task' => $task]);
})->name('tasks.show');


Route::post('/tasks', function (TaskRequest $request) {
    // $data = $request->validated();

    // $task = new Task;
    // $task->title = $data['title'];
    // $task->description = $data['description'];
    // $task->long_description = $data['long_description'];
    // $task->save();
    // dd($task);

    $task = Task::create($request->validated());

    return redirect()->route('tasks.show', ['task' => $task->id])
        ->with('success', 'Task created successfully!');
})->name('tasks.store');


Route::put('/tasks/{task}', function (Task $task, TaskRequest $request) {
    // $data = $request->validated();

    // $data = $request->validate([
    //     'title' => 'required|max:255',
    //     'description' => 'required',
    //     'long_description' => 'required'
    // ]);

    // $task = Task::findOrFail($id);

    // $task = $task;
    // $task->title = $data['title'];
    // $task->description = $data['description'];
    // $task->long_description = $data['long_description'];
    // $task->save();

    $task->update($request->validated());

    return redirect()->route('tasks.show', ['task' => $task->id])
        ->with('success', 'Task updated successfully!');
})->name('tasks.update');

Route::delete('/tasks/{task}', function (Task $task) {
    $task->delete();

    return redirect()->route('tasks.index')
        ->with('success', 'Task deleted successfully!');
})->name('tasks.destroy');

Route::put('tasks/{task}/toggle-complete', function (Task $task) {
    $task->toggleComplete();

    return redirect()->back()->with('success', 'Task updated successfully!');
})->name('tasks.toggle-complete');




























// so we have view blade which has form with action="{{ route('tasks.update', ['task' => $task->id]) }}"> and route:

//     Copy code
    
//     Route::get('/tasks/{task}/edit', function (Task $task) {
//         return view('edit', [
//             'task' => $task
//         ]);
//     })->name('tasks.edit');
//     i don't understand what we pass from and to? I mean the task we want to edit , where we get it and where we pass it?
//     VU
//     Here is what is happening between the edit view and route:
    
//     The /tasks/{task}/edit route receives the task ID in the {task} parameter.
//     It uses that ID to fetch the Task model:
//     php
    
//     Copy code
    
//     function (Task $task) {
//       // $task is fetched by ID from database  
//     }
//     The route passes this Task model to the view:
//     php
    
//     Copy code
    
//     return view('edit', ['task' => $task]);
//     In the view, we display the $task details, and set the form action to submit to tasks.update and pass back the $task->id:
//     Copy code
    
//     action="{{ route('tasks.update', ['task' => $task->id]) }}"
//     Now on POST, the /tasks/{task} route will receive the task ID from the form.
//     It can use this ID to fetch the Task, update it, and save:
//     php
    
//     Copy code
    
//     function (Task $task) {
//       // Fetch $task by ID
      
//       // Update $task
      
//       $task->save();
//     }
//     So in summary:
    
//     Edit route fetches task by ID and passes to view
//     View displays task and sends its ID in the form
//     Update route gets ID from form and fetches task to update
//     This allows the same task to flow from the GET edit route to the POST update route.
    

// so we have view blade which has form with action="{{ route('tasks.update', ['task' => $task->id]) }}"> and route:

//     Copy code
    
//     Route::get('/tasks/{task}/edit', function (Task $task) {
//         return view('edit', [
//             'task' => $task
//         ]);
//     })->name('tasks.edit');
//     i don't understand what we pass from and to? I mean the task we want to edit , where we get it and where we pass it?
//     VU
//     Here is what is happening between the edit view and route:
    
//     The /tasks/{task}/edit route receives the task ID in the {task} parameter.
//     It uses that ID to fetch the Task model:
//     php
    
//     Copy code
    
//     function (Task $task) {
//       // $task is fetched by ID from database  
//     }
//     The route passes this Task model to the view:
//     php
    
//     Copy code
    
//     return view('edit', ['task' => $task]);
//     In the view, we display the $task details, and set the form action to submit to tasks.update and pass back the $task->id:
//     Copy code
    
//     action="{{ route('tasks.update', ['task' => $task->id]) }}"
//     Now on POST, the /tasks/{task} route will receive the task ID from the form.
//     It can use this ID to fetch the Task, update it, and save:
//     php

// so we have view blade which has form with action="{{ route('tasks.update', ['task' => $task->id]) }}"> and route:

//     Copy code
    
//     Route::get('/tasks/{task}/edit', function (Task $task) {
//         return view('edit', [
//             'task' => $task
//         ]);
//     })->name('tasks.edit');
//     i don't understand what we pass from and to? I mean the task we want to edit , where we get it and where we pass it?
//     VU
//     Here is what is happening between the edit view and route:
    
//     The /tasks/{task}/edit route receives the task ID in the {task} parameter.
//     It uses that ID to fetch the Task model:
//     php
    
//     Copy code
    
//     function (Task $task) {
//       // $task is fetched by ID from database  
//     }
//     The route passes this Task model to the view:
//     php
    
//     Copy code
    
//     return view('edit', ['task' => $task]);
//     In the view, we display the $task details, and set the form action to submit to tasks.update and pass back the $task->id:
//     Copy code
    
//     action="{{ route('tasks.update', ['task' => $task->id]) }}"
//     Now on POST, the /tasks/{task} route will receive the task ID from the form.
//     It can use this ID to fetch the Task, update it, and save:
//     php
    
//     Copy code
    
//     function (Task $task) {
//       // Fetch $task by ID
      
//       // Update $task
      
//       $task->save();
//     }
//     So in summary:
    
//     Edit route fetches task by ID and passes to view
//     View displays task and sends its ID in the form
//     Update route gets ID from form and fetches task to update
//     This allows the same task to flow from the GET edit route to the POST update route.
    
//     Let me know if this helps explain the flow!
    
//     Copy code
    
//     function (Task $task) {
//       // Fetch $task by ID
      
//       // Update $task
      
//       $task->save();
//     }
//     So in summary:
    
//     Edit route fetches task by ID and passes to view
//     View displays task and sends its ID in the form
//     Update route gets ID from form and fetches task to update
//     This allows the same task to flow from the GET edit route to the POST update route.
    
//     Let me know if this helps explain the flow!
//     Let me know if this helps explain the flow!