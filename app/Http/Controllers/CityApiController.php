<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CityApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $city = City::all();
        return response()->json(
            [
                'status' => 'success',
                'data' => $city
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
            'state_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'validasi error',
                    'error' => $validator->errors()
                ],422);
        }

        $city = City::create($request->all());
        return response()->json(
            [
                'status' => 'success',
                'message' => 'City created successfully',
                'data' => $city
            ],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $city = City::findOrFail($id);
        if ($city) {
            return response()->json(
                [
                    'status' => 'success',
                    'data' => $city
                ]
            );
        } else {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => 'City not found'
                ],404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
