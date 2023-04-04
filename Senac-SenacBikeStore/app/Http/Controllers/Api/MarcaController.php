<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\MarcaResource;
use App\Http\Requests\StoreMarcaRequest;
use App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Marca;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $marcas = Marca::all();

        return response()->json([
            'status' => 200,
            'mensagem' => 'Lista de Marcas retornada',
            'marcas' => MarcaResource::collection($marcas)
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
    public function store(StoreMarcaRequest $request)
    {
    //cria objeto
        $marca = new Marca();
    //atribui o valor
        $marca->nomedamarca = $request-> nome_da_marca;
    //salva o objeto
        $marca->save();

      return response()-> json([
        'status' => 200,
        'mensagem' => 'Marca criada',
        'marca' => new MarcaResource ($marca)
      ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Marcas $marcas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Marcas $marcas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreMarcaRequest $request, Marcas $marcas)
    {
        $marca = Marca::find($marca->pkmarca);
        $marca->nomedamarca = $request->nome_da_marca;
        $marca->update();
 
         return response() -> json([
             'status' => 200,
             'mensagem' => 'Marca Atualizada'
         ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Marca $marca)
    {
        $marca->delete();

        return response() -> json([
            'status'=> 200,
            'mensagem'=> 'Marca Apagada'
        ],200);
    }
}
