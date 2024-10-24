<?php

namespace App\Http\Controllers;

use App\Models\UnansweredQuestions;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class UnansweredQuestionsController extends Controller
{
    /**
     * Get all unanswered questions with pagination.
     */
    public function index(Request $request)
    {
        $questions = UnansweredQuestions::paginate(10);

        return response()->json($questions, 200);
    }

    /**
     * Store a new unanswered question.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string',
        ]);

        // Create the question
        $question = UnansweredQuestions::create($validated);
        return response()->json($question, 201);
    }

    /**
     * Get a specific unanswered question by ID.
     */
    public function show($id)
    {
        $question = UnansweredQuestions::find($id);

        // Check if question exists
        if (!$question) {
            return response()->json(['error' => 'Question not found'], 404);
        }

        return response()->json($question, 200);
    }

    /**
     * Update an unanswered question.
     */
    public function update(Request $request, $id)
    {
        $question = UnansweredQuestions::find($id);

        // Check if question exists
        if (!$question) {
            return response()->json(['error' => 'Question not found'], 404);
        }

        // Validate the request
        $validated = $request->validate([
            'question' => 'sometimes|required|string',
        ]);

        // Update the question
        $question->update($validated);

        return response()->json($question, 200);
    }

    /**
     * Delete an unanswered question.
     */
    public function destroy($id)
    {
        $question = UnansweredQuestions::find($id);

        // Check if question exists
        if (!$question) {
            return response()->json(['error' => 'Question not found'], 404);
        }

        $question->delete();

        return response()->json(['message' => 'Question deleted successfully'], 200);
    }
}
