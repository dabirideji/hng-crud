<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePersonRequest;
use App\Http\Resources\PersonResource;
use App\Models\Person;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   private function resource($resource)
    {
        return PersonResource::collection($resource);
    }
    public function __invoke()
    {
        $person = Person::all();
        if($person->isEmpty()){
            return response()->json(['message' => "No Data Found"], 200);
        }
        return $this->resource($person);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePersonRequest $request)
    {
        Person::create($request->all());
        return response()->json(['Success' => "Details Inserted "], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {

        $person = Person::where('id',$id)->get();

        // Check if the person exists
        if ($person->isEmpty()||!$person) {
            return response()->json(['error' => 'Person not found'], 404);
        }

        return $this->resource($person);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        // Find the person by their ID
        $person = Person::find($id);

        // Check if the person exists
        if (!$person) {
            return response()->json(['error' => 'Person not found'], 404);
        }

        // Update the person's name
        $person=Person::where('id', $id)->update(['name' => $request->name]);

        // Return the updated person as a resource
        return response()->json(['Success' => "Updataed Name Successfully " ]);
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $person = Person::find($id);

        // Check if the person exists
        if (!$person) {
            return response()->json(['error' => 'Person not found'], 404);
        }
        //Delete this user
        $person->delete();
    }
}
