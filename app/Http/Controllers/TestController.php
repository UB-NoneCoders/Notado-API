<?php

namespace App\Http\Controllers;

use App\Http\Resources\TestResource;
use App\Models\Test;
use Illuminate\Http\Request;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Optional: Implement this if you need a view for creating resources
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    $data = $request->all();

    $test = Test::create($data);

    $resource = new TestResource($test);
    return $resource->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function getTest($id)
    {
        $test = Test::findOrFail($id);
        return new TestResource($test);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Test $test)
    {
        // Optional: Implement this if you need a view for editing resources
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Test $test)
    {
        $test->update($request->all());
        return new TestResource($test);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Test $test)
    {
        $test->delete();
        return response()->noContent();
    }
}
