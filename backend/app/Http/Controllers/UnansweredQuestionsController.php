<?php

namespace App\Http\Controllers;

use App\Models\UnansweredQuestions;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class UnansweredQuestionsController extends Controller
{

    public function index(Request $request)
    {
        $questions = UnansweredQuestions::paginate(10);

        return response()->json($questions, 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string',
        ]);

        $question = UnansweredQuestions::create($validated);
        return response()->json($question, 201);
    }

    public function show($id)
    {
        $question = UnansweredQuestions::find($id);

        if (!$question) {
            return response()->json(['error' => 'Question not found'], 404);
        }

        return response()->json($question, 200);
    }

    public function update(Request $request, $id)
    {
        $question = UnansweredQuestions::find($id);

        if (!$question) {
            return response()->json(['error' => 'Question not found'], 404);
        }

        $validated = $request->validate([
            'question' => 'sometimes|required|string',
        ]);


        $question->update($validated);

        return response()->json($question, 200);
    }

    public function destroy($id)
    {
        $question = UnansweredQuestions::find($id);

        if (!$question) {
            return response()->json(['error' => 'Question not found'], 404);
        }

        $question->delete();

        return response()->json(['message' => 'Question deleted successfully'], 200);
    }
}
