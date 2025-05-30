<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\contact;
use App\Mail\ApplicationConfirmationMail;
use Illuminate\Support\Facades\Mail;

class contactController extends Controller
{
   
    public function index()
    {

        $contact = contact::latest()->first();
        return view('applyNow.idCard',compact('contact'));
    }


    public function create()
    {
        return view('applyNow.contact');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'fname' => 'required|string|max:255',
            'dob' => 'required|string|max:255',
            'mobile' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $filePath = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('photo', $filename, 'public');
        }
    
        $contact = Contact::create([
            'name' => $data['name'],
            'fname' => $data['fname'],
            'dob' => $data['dob'],
            'mobile' => $data['mobile'],
            'email' => $data['email'],
            'address' => $data['address'],
            'image' => $filePath,
        ]);
    
        $roll_no = 'ROLL' . str_pad($contact->id, 4, '0', STR_PAD_LEFT);
    
        $contact->roll_no = $roll_no;
        $contact->save();
    
        Mail::to($contact->email)->send(new ApplicationConfirmationMail($contact));

        return redirect()->route('contact.index')->with([
            'success' => 'Data added successfully!',
            'roll_no' => $roll_no,
        ]);
    }

    
     public function searchForm()
        {
            return view('search');
        }
    
        public function getContact(Request $request)
        {
            $request->validate([
                'roll_no' => 'required'
            ]);
    
            $contact = Contact::where('roll_no', $request->roll_no)->first();
    
            return view('search', compact('contact'));
        }
    
    




    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $contact = contact::findOrFail($id);
        return view('applyNow.edit', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'fname' => 'required|string|max:255',
            'dob' => 'required|string|max:255',
            'mobile' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // nullable here
        ]);
    
        $contact = contact::findOrFail($id);
    
        // Update text fields from validated data
        $contact->name = $data['name'];
        $contact->fname = $data['fname'];
        $contact->dob = $data['dob'];
        $contact->mobile = $data['mobile'];
        $contact->email = $data['email'];
        $contact->address = $data['address'];
    
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($contact->image && \Storage::disk('public')->exists($contact->image)) {
                \Storage::disk('public')->delete($contact->image);
            }
    
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('photo', $filename, 'public');
            $contact->image = $filePath;  // store path like photo/filename.jpg
        }
    
        $contact->save();
    
        return redirect()->back()->with([
            'success' => 'Contact updated successfully!',
            'roll_no' => $contact->id
        ]);
    }
    
     
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
