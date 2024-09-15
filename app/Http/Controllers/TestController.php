<?php

namespace App\Http\Controllers;

use App\Http\Resources\TestResource;
use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;


class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            // Attempt to retrieve all tests
            $tests = Test::all();
            
            // Return the list of tests as JSON
            return response()->json($tests);
        } catch (Exception $e) {
            // Handle any exceptions that occur during data retrieval
            return response()->json([
                'message' => 'An error occurred while retrieving the tests',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validate the incoming request data (if you are using validation)
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'bimonthly' => 'required|integer',  // Add validation for 'bimonthly'
                'maximum_score' => 'required|numeric',
                "subject_id"=> 'required|integer',
                // Add other validation rules as needed
            ]);
    
            // Create the new Test record
            $test = Test::create($validatedData);
    
            // Wrap the created Test record in a resource
            $resource = new TestResource($test);
    
            // Return the resource with a success message and a 201 status code
            return response()->json([
                'message' => 'Test created successfully.',
                'data' => $resource
            ], 201);
        } catch (ValidationException $e) {
            // Handle validation errors
            return response()->json([
                'message' => 'Validation error.',
                'errors' => $e->errors()
            ], 422);
        } catch (QueryException $e) {
            // Handle database errors
            return response()->json([
                'message' => 'Database error.',
                'error' => $e->getMessage()
            ], 500);
        } catch (Exception $e) {
            // Handle any other exceptions
            return response()->json([
                'message' => 'An error occurred while creating the test.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */

    public function getTest($id)
    {
        try {
            // Attempt to find the test by ID
            $test = Test::findOrFail($id);
    
            // Wrap the found Test record in a resource
            return new TestResource($test);
        } catch (ModelNotFoundException $e) {
            // Handle the case where the test is not found
            return response()->json([
                'message' => 'Test not found.',
            ], 404);
        } catch (Exception $e) {
            // Handle any other exceptions
            return response()->json([
                'message' => 'An error occurred while retrieving the test.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Test $test)
    {
        try {
            // Validate the incoming request data
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'bimonthly' => 'required|integer',  // Add validation for 'bimonthly'
                'maximum_score' => 'required|numeric',
                "subject_id"=> 'required|integer',
                // Add other validation rules as needed
            ]);
    
            // Update the test record with the validated data
            $test->update($validatedData);
    
            // Wrap the updated Test record in a resource
            return new TestResource($test);
        } catch (ValidationException $e) {
            // Handle validation errors
            return response()->json([
                'message' => 'Validation error.',
                'errors' => $e->errors()
            ], 422);
        } catch (QueryException $e) {
            // Handle database errors
            return response()->json([
                'message' => 'Database error.',
                'error' => $e->getMessage()
            ], 500);
        } catch (Exception $e) {
            // Handle any other exceptions
            return response()->json([
                'message' => 'An error occurred while updating the test.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
  
    public function destroy(Test $test)
    {
        try {
            // Attempt to delete the test record
            $test->delete();
    
            // Return a successful response with no content
            return response()->json([
                'message' => 'Test deleted successfully.',
            ], 200);
        } catch (QueryException $e) {
            // Handle database errors, such as foreign key constraint violations
            return response()->json([
                'message' => 'Database error. Could not delete the test.',
                'error' => $e->getMessage()
            ], 500);
        } catch (Exception $e) {
            // Handle any other exceptions
            return response()->json([
                'message' => 'An error occurred while deleting the test.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
