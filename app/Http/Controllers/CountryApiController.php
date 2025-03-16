<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use Illuminate\Support\Facades\Validator;

class CountryApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $country = Country::all();
        return response()->json(
            [
                'status' => 'success',
                'data' => $country
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
            'code' => 'required',
            'phonecode' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'validasi error',
                    'error' => $validator->errors()
                ],422);
        }

        $country = Country::create($request->all());
        return response()->json(
            [
                'status' => 'success',
                'message' => 'Country created successfully',
                'data' => $country
            ],201);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $country = Country::findOrFail($id);
        if ($country) {
            return response()->json(
                [
                    'status' => 'success',
                    'data' => $country
                ]
            );
        } else {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => 'Country not found'
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
        $country = Country::findOrFail($id);
        $country -> delete();
        if ($country) {
            return response()->json(
                [
                    'status' => 'success',
                    'data' => $country
                ]
            );
        }
    }
}
