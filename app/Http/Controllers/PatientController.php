<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PatientController extends Controller
{
    public function index(Request $request)
    {
        $query = Patient::query();

        if ($request->has('ci')) {
            $query->where('ci', $request->input('ci'));
        }

        if ($request->has('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }

        $data = $query->get();

        return response()->json($data);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'ci' => 'nullable|string|max:20|unique:patients,ci',
            'age' => 'required|numeric|min:1',
            'phone' => 'required|string|max:15',
        ], [
            'ci.unique' => 'La cedula ya ha sido registrada',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $patient = Patient::create($request->all());

        return response()->json($patient, 201);
    }

    public function setLocation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'patient_id' => 'required|exists:patients,id',
            'lat' => 'required|numeric',
            'long' => 'required|numeric',
            'percentage' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $patient = Patient::find($request->input('patient_id'));

        $patient->lat = $request->input('lat');
        $patient->long = $request->input('long');
        $patient->percentage = $request->input('percentage');
        $patient->save();

        return response()->json(['message' => 'Location set successfully']);
    }

    public function show($id)
    {
        try {
            $patient = Patient::with(['answers.question'])->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Patient not found'], 422);
        }

        return response()->json($patient, 200);
    }
}
