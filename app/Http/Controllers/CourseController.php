<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\course; // Import the Course model
class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = course::all(); // Fetch all courses from the database
        return view('courseMaster.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('courseMaster.addCourse');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // ✅ Validate the form input
        $validatedData = $request->validate([
            'courseName' => 'required|string|max:255',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required|string',
            'fees' => 'required|numeric|min:0', // Add validation for fees
        ]);

        // ✅ Handle file upload
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('thumbnails', $filename, 'public'); // stored in storage/app/public/thumbnails
        }

        // ✅ Save course to database
        $course = course::create([
            'courseName' => $validatedData['courseName'],
            'thumbnail' => $filePath ?? null,
            'description' => $validatedData['description'],
        
            'fees' => $validatedData['fees'], // Save fees to the database
        ]);

       
        // ✅ Redirect or return response
        return redirect()->back()->with('success', 'Course created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $course = Course::findOrFail($id);
        return view('courseMaster.editCourse', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'courseName' => 'required|string|max:255',
            'thumbnail' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
            'description' => 'required|string',
            'fees' => 'required|numeric|min:0', // Add validation for fees
        ]);
    
        $course = Course::findOrFail($id);
    
        // Check if new thumbnail is uploaded
        if ($request->hasFile('thumbnail')) {
            // delete old image
            if ($course->thumbnail && \Storage::disk('public')->exists($course->thumbnail)) {
                \Storage::disk('public')->delete($course->thumbnail);
            }
    
            $file = $request->file('thumbnail');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('thumbnails', $filename, 'public');
            $validated['thumbnail'] = $filePath;
        }
    
        $course->update($validated);
    
        return redirect()->route('courses.index')->with('success', 'Course updated successfully.');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $course = Course::findOrFail($id);
    
        // Optionally delete the thumbnail from storage
        if ($course->thumbnail && \Storage::disk('public')->exists($course->thumbnail)) {
            \Storage::disk('public')->delete($course->thumbnail);
        }
    
        $course->delete();
    
        return redirect()->back()->with('success', 'Course deleted successfully.');
    }
}
