<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use App\Http\Resources\NoteResource;


/**
 * @OA\SecurityScheme(
 *     securityScheme="bearerAuth",
 *     type="http",
 *     scheme="bearer"
 * )
 *
 * @OA\Info(
 *     title="LiteNotes API",
 *     version="1.0.0",
 *     description="Documentación de la API de notas con Swagger usando Sanctum"
 * )
 */
class NoteApiController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/notes",
     *     summary="Lista todas las notas",
     *     tags={"Notas"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Lista paginada de notas"
     *     )
     * )
     */
    public function index()
    {
        return NoteResource::collection(Note::paginate(5));
    }
    /**
     * @OA\Post(
     *     path="/api/notes",
     *     summary="Crea una nueva nota",
     *     tags={"Notas"},
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"title", "content"},
     *             @OA\Property(property="title", type="string", example="Nota de ejemplo"),
     *             @OA\Property(property="content", type="string", example="Contenido de la nota")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Nota creada exitosamente"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Datos inválidos"
     *     )
     * )
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'content' => 'required|string'
        ]);

        return Note::create($validated);
    }
    /**
     * @OA\Get(
     *     path="/api/notes/{id}",
     *     summary="Muestra una nota específica",
     *     tags={"Notas"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la nota",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Nota encontrada"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Nota no encontrada"
     *     )
     * )
     */
    public function show(Note $note)
    {
        return $note;
    }
    /**
     * @OA\Put(
     *     path="/api/notes/{id}",
     *     summary="Actualiza una nota existente",
     *     tags={"Notas"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la nota",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="title", type="string", example="Título actualizado"),
     *             @OA\Property(property="content", type="string", example="Contenido actualizado")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Nota actualizada"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Nota no encontrada"
     *     )
     * )
     */
    public function update(Request $request, Note $note)
    {
        $validated = $request->validate([
            'title' => 'sometimes|string',
            'content' => 'sometimes|string'
        ]);

        $note->update($validated);
        return $note;
    }
    /**
     * @OA\Delete(
     *     path="/api/notes/{id}",
     *     summary="Elimina una nota",
     *     tags={"Notas"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la nota",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Nota eliminada correctamente"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Nota no encontrada"
     *     )
     * )
     */
    public function destroy(Note $note)
    {
        $note->delete();
        return response()->json(null, 204);
    }
}
