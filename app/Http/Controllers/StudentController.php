<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\course; // Import the Course model
use App\Models\registration; // Import the Student model
class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $detail = registration::latest()->first();
        $courseID = registration::latest()->first()->course;
        $course = course::where('id', $courseID)->first();// Fetch the course based on the latest registration
       return view('studentPanel.courseDetails',compact('course','detail'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $courses = course::all(); // Fetch all courses from the database
        
        return view('studentPanel.registration',compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'firstName' => 'required|string|max:255',
            'lastName'  => 'required|string|max:255',
            'email'     => 'required|email|unique:registrations,email',
            'mobile'    => 'nullable|digits:10',
            'course'    => 'required|exists:courses,id',
        ]);

        // Create registration
        registration::create($validated);

        // Redirect or return response
        return redirect()->route('stuRegistration.index')->with('success', 'Registration successful!');

    }

    /**
     * Display the specified resource.
     */
 
     public function registeredStudent()
     {
         $registrations = registration::with('courses')->get(); // eager loading course
    
         return view('studentPanel.registeredStudent', compact('registrations'));
     }
   

    /**
     * Show the form for editing the specified resource.
     */
    public function confirm(Request $request)
    {
        $detail = registration::latest()->first(); // Fetch all courses from the database
        $courses = course::all();
        return view('studentPanel.confirmation',compact('detail','courses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function edit($id)
    {
        // Find the registration record
        $detail = registration::findOrFail($id);
        $courses = course::all(); // Fetch all courses from the database

        return view('studentPanel.editregister', compact('detail', 'courses'));
    }
    
public function update(Request $request, $id)
{
    // Validate input
    $request->validate([
        'firstName' => 'required|string|max:255',
        'lastName' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:registrations,email,' . $id,
        'mobile' => 'nullable|digits:10',
        'course' => 'required|exists:courses,id',
    ]);

    // Find the registration record
    $registration = Registration::findOrFail($id);

    // Update with new values
    $registration->update([
        'firstName' => $request->input('firstName'),
        'lastName' => $request->input('lastName'),
        'email' => $request->input('email'),
        'mobile' => $request->input('mobile'),
        'course' => $request->input('course'),
    ]);

    // Redirect with success message
    return redirect()->route('stuRegistration.index')->with('success', 'Registration updated successfully!');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
