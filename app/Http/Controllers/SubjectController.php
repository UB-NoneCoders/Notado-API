<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Subject;
use App\Http\Resources\SubjectResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


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
        $subject = Subject::findOrFail($id);
        return new SubjectResource($subject);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        $subject = Subject::find($id);
        $subject->update($request->all());
        return new SubjectResource($subject);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        Subject::find($id)->delete();
        return response()->json([
            "message" => "Subject deleted successfully",
        ],200);
    }

}