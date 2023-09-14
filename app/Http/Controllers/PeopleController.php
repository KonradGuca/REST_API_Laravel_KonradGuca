<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\People;

class PeopleController extends Controller
{
    // Read
    public function index()
    {
        $people = People::all();
        return response()->json($people);
    }

    // Create 
    public function store(Request $request)
    {
        $request->validate([
            'forename' => 'required',
            'surname' => 'required',
            'phone' => 'required',
            'street' => 'required',
            'city' => 'required',
            'country' => 'required',
            'email' => 'required|email|unique:people,email',
            'password' => 'required|min:8',
        ]);

        $people = new People;
        $people->fill($request->all());
        $people->save();

        return response()->json($people, 200);
    }

    // Update
    public function edit(Request $request, $id)
    {
        $request->validate([
            'forename' => 'required',
            'surname' => 'required',
            'phone' => 'required',
            'street' => 'required',
            'city' => 'required',
            'country' => 'required',
            'email' => 'required|email|unique:people,email,' . $id,
            'password' => 'required|min:8',
        ]);

        $people = People::findOrFail($id);
        $people->update($request->all());

        return response()->json($people);
    }

    // Delete
    public function delete($id)
    {
        $people = People::findOrFail($id);
        $people->delete();

        return response()->json('Deleted successfully');
    }

    // Another Read
    public function read($id)
    {
        $people = People::findOrFail($id);
        return response()->json($people);
    }
}