<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\CategoriaResource;
use App\Http\Requests\StoreCategoriaRequest;
use App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorias = Categoria::all();

        return response()->json([
            'status' => 200,
            'mensagem' => 'Lista de categorias retornada',
            'categorias' => CategoriaResource::collection($categorias)
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoriaRequest $request)
    {
    //cria objeto
      $categoria = new Categoria();
    //atribui o valor
      $categoria->nomedacategoria = $request-> nome_da_categoria;
    //salva o objeto
      $categoria->save();

      return response()-> json([
        'status' => 200,
        'mensagem' => 'Categoria criada',
        'categoria' => new CategoriaResource ($categoria)
      ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Categoria $categoria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categoria $categoria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCategoriaRequest $request, Categoria $categoria)
    {
       $categoria = Categoria::find($categoria->pkcategoria);
       $categoria->nomedacategoria = $request->nome_da_categoria;
       $categoria->update();

        return response() -> json([
            'status' => 200,
            'mensagem' => 'Categoria Atualizada'
        ], 200);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categoria $categoria)
    {
        $categoria->delete();

        return response() -> json([
            'status'=> 200,
            'mensagem'=> 'Categoria Apagada'
        ],200);
    }
}
