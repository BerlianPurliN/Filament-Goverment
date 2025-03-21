<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DepartmentApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $department = Department::all();
        return response()->json(
            [
                'status' => 'success',
                'data' => $department
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'validasi error',
                    'error' => $validator->errors()
                ],422);
        }

        $department = Department::create($request->all());
        return response()->json(
            [
                'status' => 'success',
                'message' => 'Department created successfully',
                'data' => $department
            ],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $department = Department::findOrFail($id);
        if ($department) {
            return response()->json(
                [
                    'status' => 'success',
                    'data' => $department
                ]
            );
        } else {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => 'Department not found'
                ],404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'validasi error',
                    'error' => $validator->errors()
                ],422);
        }

        $department = Department::findOrFail($id);
        $department -> update($request->all());
        return response()->json(
            [
                'status' => 'success',
                'message' => 'Department updated successfully',
                'data' => $department
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $department = Department::findOrFail($id);
        $department -> delete();
        if ($department) {
            return response()->json(
                [
                    'status' => 'success',
                    'data' => $department
                ]
            );
        }
    }
}
