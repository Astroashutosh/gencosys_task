<?php

namespace App\Http\Controllers;
use App\Models\ajaxform;
use Illuminate\Http\Request;

class formController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $data = ajaxform::all();
        // return view('showForm', compact('data'));

        $ajaxforms = ajaxform::latest()->get();
        return view('ajaxForm', compact('ajaxforms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ajaxForm');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            // $imagePath = $image->store('uploads', 'public');

            $imagename = time() . '_' . $image->getClientOriginalName();
            $imagePath = $image->storeAs('uploads', $imagename, 'public');
        }
    
        Ajaxform::create([
            'image' => $imagePath,
            'city' => $request->city,
            'courses' => implode(',', $request->courses ?? []),
        ]);
    
        return response()->json(['success' => true, 'message' => 'Saved']);
    }
    

    /**
     * Display the specified resource.
     */
//     public function show(string $id)
//     {
//         //
//     }

//     /**
//      * Show the form for editing the specified resource.
//      */
//     public function edit($id)
//     {
//         $form = ajaxform::findOrFail($id);
//         return response()->json($form);
//     }

//     /**
//      * Update the specified resource in storage.
//      */
//     public function update(Request $request, $id)
// {
//     $form = Ajaxform::findOrFail($id);

//     if ($request->hasFile('image')) {
//         $path = $request->file('image')->store('uploads', 'public');
//         $form->image = $path;
//     }

//     $form->city = $request->city;
//     $form->courses = implode(',', $request->courses ?? []);
//     $form->save();

//     return response()->json(['success' => true]);
// }
public function show($id)
{
    return Ajaxform::findOrFail($id);
}

public function update(Request $request, $id)
{
    $form = Ajaxform::findOrFail($id);

    if ($request->hasFile('image')) {
        if ($form->image) {
            \Storage::disk('public')->delete($form->image);
        }
        $form->image = $request->file('image')->store('images', 'public');
    }

    $form->city = $request->city;
    $form->courses = implode(',', $request->courses ?? []);
    $form->save();

    return response()->json(['success' => true]);
}
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $form = Ajaxform::findOrFail($id);
        if ($form->image) {
            \Storage::disk('public')->delete($form->image);
        }
        $form->delete();
    
        return response()->json(['success' => true]);
    }
    
}
