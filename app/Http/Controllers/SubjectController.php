<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Subject;
use App\Http\Resources\SubjectResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;



class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subjects = Subject::get();
        
        if ($subjects->count() > 0)
        {
            return SubjectResource::collection($subjects);
        }
        else
        {
            response()->json([
                "message" => "No record available"
            ],200);
        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            "name"      => "required|string|max:200",
            "status"    => "required|boolean",
            "teacher_id"=> "required|integer",
        ]);

        if($validator->fails())
        {
            return response()->json([
                "message" => "Not all fields are right",
                "error" => $validator->messages(),
            ],422);
        }

        $subject = Subject::create([
            "name" => $request->name,
            "status" => $request->status,
            "teacher_id" => $request->teacher_id,
        ]);

        return response()->json([
            "message" => "Subject created successfully",
            "data" => new SubjectResource($subject),
        ],200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            // Attempt to find the subject by ID
            $subject = Subject::findOrFail($id);
            // Return the subject wrapped in a resource
            return new SubjectResource($subject);

        } catch (ModelNotFoundException) {
            // Handle the case where the subject is not found
            return response()->json([
                'message' => 'Subject not found'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        try {
            // Attempt to find the subject by ID
            $subject = Subject::findOrFail($id);
            
            // Perform the update
            $subject->update($request->all());
            
            // Return the updated subject wrapped in a resource
            return new SubjectResource($subject);
        } catch (ModelNotFoundException $e) {
            // Handle the case where the subject is not found
            return response()->json([
                'message' => 'Subject not found'
            ], 404);
        } catch (\Exception $e) {
            // Handle any other exceptions during the update
            return response()->json([
                'message' => 'An error occurred while updating the subject',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(String $id)
    {
        try {
            // Attempt to find the subject by ID
            $subject = Subject::findOrFail($id);
            
            // Delete related records in 'scores' and 'tests' tables first
            \DB::table('scores')->where('subject_id', $id)->delete();
            \DB::table('tests')->where('subject_id', $id)->delete();
            
            // Now delete the subject
            $subject->delete();
            
            // Return a success response
            return response()->json([
                'message' => 'Subject and related records deleted successfully',
            ], 200);
        } catch (ModelNotFoundException $e) {
            // Handle the case where the subject is not found
            return response()->json([
                'message' => 'Subject not found',
            ], 404);
        } catch (Exception $e) {
            // Handle any other exceptions during the deletion
            return response()->json([
                'message' => 'An error occurred while deleting the subject',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

}