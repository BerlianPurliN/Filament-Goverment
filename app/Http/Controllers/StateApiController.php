<?php

namespace App\Http\Controllers;

use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StateApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $state = State::all();
        return response()->json(
            [
                'status' => 'success',
                'data' => $state
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
            'country_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'validasi error',
                    'error' => $validator->errors()
                ],422);
        }

        $state = State::create($request->all());
        return response()->json(
            [
                'status' => 'success',
                'message' => 'State created successfully',
                'data' => $state
            ],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $state = State::findOrFail($id);
        if ($state) {
            return response()->json(
                [
                    'status' => 'success',
                    'data' => $state
                ]
            );
        } else {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => 'State not found'
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
            'country_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'validasi error',
                    'error' => $validator->errors()
                ],422);
        }

        $state = State::findOrFail($id);
        $state->update($request->all());
        return response()->json(
            [
                'status' => 'success',
                'message' => 'State updated successfully',
                'data' => $state
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $state = State::findOrFail($id);
        $state->delete();
        if ($state) {
            return response()->json(
                [
                    'status' => 'success',
                    'data' => $state
                ]
            );
        }
    }
}
