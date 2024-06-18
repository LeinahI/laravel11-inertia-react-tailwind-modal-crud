<?php

namespace App\Http\Controllers;

use App\Models\StudentsModel;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Log;

class StudentsController extends Controller
{
    /* Read */
    public function index(StudentsModel $model)
    {
        return Inertia::render('StudentsDashboard', [
            'studentsData' => $model->all(),
            'count' => $model->count(),
        ]);
    }
    /* Create */
    public function store(Request $request, StudentsModel $model)
    {
        $model->create($request->validate([
            'first_name' => 'required|max:255|min:2',
            'last_name' => 'required|max:255|min:2',
            'department' => 'required|max:255|min:2',
            'email' => 'required|email|max:255|unique:students,email',
        ]));

        return back()->with('message', 'Student added successfully');
    }
    /* Update */
    public function update(Request $request, StudentsModel $model, $student_id)
    {
        // You need this for encountering Log the incoming request data
        // dd($request->all()); You can also use this too it means Dump and Die
        Log::info('Update request received for student ID: ' . $student_id);
        Log::info('Update request data: ', $request->all());


        $validatedData = $request->validate( // Validate the incoming request data
            [
                'first_name' => 'required|max:255|min:2',
                'last_name' => 'required|max:255|min:2',
                'department' => 'required|max:255|min:2',
                'email' => 'required|email|max:255',
            ],
            [
                'email.unique' => 'The email has already been taken.', // Custom error message for unique rule
            ]
        );

        $student = $model->findOrFail($student_id);

        $student->update($validatedData);

        return back()->with('message', 'Student updated successfully');
    }

    /* Delete */
    public function destroy(StudentsModel $model, $student_id)
    {
        // Find the student by ID
        $student = $model->findOrFail($student_id);

        // Perform deletion logic
        $student->delete();

        // You can also use redirect()->route()
        return back()->with('message', 'Student deleted successfully');
    }
}
