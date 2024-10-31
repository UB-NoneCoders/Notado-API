<?php

namespace App\Http\Controllers;

use App\Http\Resources\TestResource;
use App\Models\Score;
use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

class TestController extends Controller
{
    /**
     * Exibir uma lista do recurso.
     */
    public function index()
    {
        try {
            $tests = Test::all();

            return response()->json($tests);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ocorreu um erro ao recuperar os testes',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Armazenar um novo recurso no armazenamento.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'bimonthly' => 'required|integer',
                'maximum_score' => 'required|numeric',
                "subject_id" => 'required|integer',
            ]);

            $test = Test::create($validatedData);

            $resource = new TestResource($test);

            return response()->json([
                'message' => 'Teste criado com sucesso.',
                'data' => $resource
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Erro de validação.',
                'errors' => $e->errors()
            ], 422);
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Erro no banco de dados.',
                'error' => $e->getMessage()
            ], 500);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ocorreu um erro ao criar o teste.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Exibir o recurso especificado.
     */
    public function getTest($id)
    {
        try {
            $test = Test::findOrFail($id);

            return new TestResource($test);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Teste não encontrado.',
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ocorreu um erro ao recuperar o teste.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Atualizar o recurso especificado no armazenamento.
     */
    public function update(Request $request, Test $test)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'bimonthly' => 'required|integer',
                'maximum_score' => 'required|numeric',
                "subject_id" => 'required|integer',
            ]);

            $test->update($validatedData);

            return new TestResource($test);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Erro de validação.',
                'errors' => $e->errors()
            ], 422);
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Erro no banco de dados.',
                'error' => $e->getMessage()
            ], 500);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ocorreu um erro ao atualizar o teste.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remover o recurso especificado do armazenamento.
     */
    public function destroy(Test $test)
    {
        try {
            $test->delete();

            return response()->json([
                'message' => 'Teste excluído com sucesso.',
            ], 200);
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Erro no banco de dados. Não foi possível excluir o teste.',
                'error' => $e->getMessage()
            ], 500);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ocorreu um erro ao excluir o teste.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function giveScore(Request $request)
    {
        $validatedData = $request->validate([
            'student_id' => 'required|exists:users,id',
            'test_id' => 'required|exists:tests,id',
            'test_score' => 'required|numeric|min:0|max:10',
        ]);

        $score = Score::where('student_id', $request->student_id)
            ->where('test_id', $request->test_id)
            ->first();

        if ($score) {
            $score->test_score = $request->test_score;
            $score->updated_at = now();
            $score->save();
        } else {
            $score = new Score;
            $score->student_id = $request->student_id;
            $score->test_id = $request->test_id;
            $score->test_score = $request->test_score;
            $score->created_at = now();
            $score->updated_at = now();
            $score->save();
        }

        return response()->json([
            'message' => 'Nota registrada com sucesso!',
            'data' => $score
        ]);
    }
}
