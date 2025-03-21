<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmployeeApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $employee = Employee::all();
        return response()->json(
            [
                'status' => 'success',
                'data' => $employee
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
            'address' => 'required',
            'zip_code' => 'required',
            'date_hired' => 'required',
            'date_of_birth' => 'required',
            'photo' => 'required',
            'country_id' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',
            'department_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'validasi error',
                    'error' => $validator->errors()
                ],422);
        }

        $employee = Employee::create($request->all());
        return response()->json(
            [
                'status' => 'success',
                'message' => 'Employee created successfully',
                'data' => $employee
            ],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $employee = Employee::findOrFail($id);
        if ($employee) {
            return response()->json(
                [
                    'status' => 'success',
                    'data' => $employee
                ]
            );
        } else {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => 'Employee not found'
                ],404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name',
            'address',
            'zip_code',
            'date_hired',
            'date_of_birth',
            'photo',
            'country_id' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',
            'department_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'validasi error',
                    'error' => $validator->errors()
                ],422);
        }

        $employee = Employee::findOrFail($id);
        $employee -> update($request->all());
        return response()->json(
            [
                'status' => 'success',
                'message' => 'Employee updated successfully',
                'data' => $employee
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employee = Employee::findOrFail($id);
        $employee -> delete();
        if ($employee) {
            return response()->json(
                [
                    'status' => 'success',
                    'data' => $employee
                ]
            );
        }
    }
}
