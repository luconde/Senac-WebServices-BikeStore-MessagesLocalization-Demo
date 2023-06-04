<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\StoreCategoriaRequest;
use App\Http\Resources\CategoriaResource;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorias = Categoria::all();

        return response() -> json([
            'status' => 200,
            'mensagem' => __("categoria.listreturn"),
            'categorias' => CategoriaResource::collection($categorias)
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoriaRequest $request)
    {
        // Cria o objeto 
        $categoria =new Categoria();

        // Transfere os valores
        $categoria->nomedacategoria = $request->nome_da_categoria;

        // Salva
        $categoria->save();

        // Retorna o resultado
        return response() -> json([
            'status' => 200,
            'mensagem' => __("categoria.created"),
            'categoria' => new CategoriaResource($categoria)
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function show(Categoria $categoria)
    {
        $categoria = Categoria::find($categoria->pkcategoria);

        return response() -> json([
            'status' => 200,
            'mensagem' => __("categoria.returned"),
            'categoria' => new CategoriaResource($categoria)
        ]);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCategoriaRequest $request, Categoria $categoria)
    {
        $categoria = Categoria::find($categoria->pkcategoria);
        $categoria->nomedacategoria = $request->nome_da_categoria;
        $categoria->update();

        return response() -> json([
            'status' => 200,
            'mensagem' => __("categoria.updated")
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categoria $categoria)
    {
        $categoria->delete();

        return response() -> json([
            'status' => 200,
            'mensagem' => __("categoria.deleted")
        ], 200);
    }
}
