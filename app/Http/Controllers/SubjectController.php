<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Subject;
use App\Http\Resources\SubjectResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

class SubjectController extends Controller
{
    /**
     * Exibir uma lista do recurso.
     */
    public function index()
    {
        $subjects = Subject::get();

        if ($subjects->count() > 0) {
            return SubjectResource::collection($subjects);
        } else {
            return response()->json([
                "message" => "Nenhum registro disponível"
            ], 200);
        }
    }

    /**
     * Armazenar um novo recurso no armazenamento.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required|string|max:200",
            "status" => "required|boolean",
            "teacher_id" => "required|integer",
        ]);

        if ($validator->fails()) {
            return response()->json([
                "message" => "Nem todos os campos estão corretos",
                "error" => $validator->messages(),
            ], 422);
        }

        $subject = Subject::create([
            "name" => $request->name,
            "status" => $request->status,
            "teacher_id" => $request->teacher_id,
        ]);

        return response()->json([
            "message" => "Disciplina criada com sucesso",
            "data" => new SubjectResource($subject),
        ], 200);
    }

    /**
     * Exibir o recurso especificado.
     */
    public function show($id)
    {
        try {
            $subject = Subject::findOrFail($id);

            return new SubjectResource($subject);
        } catch (ModelNotFoundException) {
            return response()->json([
                'message' => 'Disciplina não encontrada'
            ], 404);
        }
    }

    /**
     * Atualizar o recurso especificado no armazenamento.
     */
    public function update(Request $request, string $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                "name" => "required|string|max:200",
                "status" => "required|boolean",
                "teacher_id" => "required|integer",
            ]);

            $subject = Subject::findOrFail($id);

            $subject->update($request->all());

            return new SubjectResource($subject);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Disciplina não encontrada'
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ocorreu um erro ao atualizar a disciplina',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remover o recurso especificado do armazenamento.
     */
    public function destroy(string $id)
    {
        try {
            $subject = Subject::findOrFail($id);

            \DB::table('scores')->where('subject_id', $id)->delete();
            \DB::table('tests')->where('subject_id', $id)->delete();

            $subject->delete();

            return response()->json([
                'message' => 'Disciplina e registros relacionados excluídos com sucesso',
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Disciplina não encontrada',
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ocorreu um erro ao excluir a disciplina',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
