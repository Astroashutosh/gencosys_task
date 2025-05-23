<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\formajax;
class ajaxController extends Controller
{
    public function store(Request $request)
    {

        $file= $request->file('picture');
        $fileName = time() . '' . $file->getClientOriginalName();
        $path= $file->storeAs('picture', $fileName, 'public');
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'age' => 'required|numeric',
            'picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        formajax::create([
            'name' => $request->name,
            'email' => $request->email,
            'age' => $request->age,
            'picture' => $path,
        ]);

        return response()->json([
            'message' => 'Data submitted successfully!',
        ]);
    }
    public function show(Request $request)
    {
        $data = formajax::all();
        return response()->json([
            'data' => $data,
        ]);
    }
}
