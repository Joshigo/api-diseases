<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AnswerController extends Controller
{
    public function index()
    {
        $data = Answer::with(['question', 'patient'])->get();

        return response()->json($data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'question_ids' => 'required|array',
            'question_ids.*' => 'integer|exists:questions,id',
            'patient_id' => 'required|integer|exists:patients,id',
            'responses' => 'required|array',
            'responses.*' => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $questionIds = $request->input('question_ids');
        $responses = $request->input('responses');
        $patientId = $request->input('patient_id');

        $totalQuestions = count($questionIds);
        $trueResponses = 0;
        $dangerBonus = 0;

        foreach ($questionIds as $index => $questionId) {
            $response = $responses[$index];
            $question = Question::find($questionId);

            if ($response) {
                $trueResponses++;
                if ($question->IsDanger) { // Acceder al campo con el nombre correcto
                    $dangerBonus += 0.3; // Aumentar el porcentaje en un 30%
                }
            }

            Answer::create([
                'question_id' => $questionId,
                'patient_id' => $patientId,
                'response' => $response,
            ]);
        }

        $percentage = ($trueResponses / $totalQuestions) * 100;
        $percentage += $dangerBonus * 100;

        return response()->json(['message' => 'Answers created successfully', 'percentage' => $percentage], 201);
    }
}
