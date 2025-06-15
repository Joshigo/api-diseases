<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class QuestionController extends Controller
{
    public function index(Request $request)
    {
        $adminPassParam = $request->query('adminpass');
        $adminPassEnv = env('ADMIN_PASS');

        if ($adminPassParam !== $adminPassEnv || !$adminPassParam) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $data = Question::all();

        foreach ($data as $idx => $question) {
            $question->name .= ' ' . ($idx + 1) . '/' . count($data);
        }

        return response()->json($data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'disease_id' => 'required|integer|exists:diseases,id',
            'name' => 'required|string',
            'IsDanger' => 'sometimes|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $question = Question::create($request->all());

        return response()->json($question, 201);
    }

    public function destroy($id)
    {
        $question = Question::find($id);

        if (!$question) {
            return response()->json(['message' => 'Question not found'], 404);
        }

        $question->delete();

        return response()->json(['message' => 'Question deleted successfully'], 200);
    }
}
