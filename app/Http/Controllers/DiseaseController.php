<?php

namespace App\Http\Controllers;

use App\Models\Disease;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DiseaseController extends Controller
{
    public function index()
    {
        $data = Disease::with('questions')->get();

        foreach ($data as $disease) {
            $questions = $disease->questions;
            $total = count($questions);
            foreach ($questions as $idx => $question) {
                $question->name .= ' ' . ($idx + 1) . '/' . $total;
            }
        }

        return response()->json($data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $disease = Disease::create($request->all());

        return response()->json($disease, 201);
    }

    public function show($id)
    {
        try {
            $disease = Disease::with('questions')->findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Disease not found'], 422);
        }

        return response()->json($disease, 200);
    }

    public function destroy($id)
    {
        try {
            $disease = Disease::findOrFail($id);
            $disease->delete();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Disease not found'], 422);
        }

        return response()->json(['message' => 'Disease deleted successfully'], 200);
    }
}
