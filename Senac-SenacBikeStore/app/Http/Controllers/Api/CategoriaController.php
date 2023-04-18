<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\CategoriaResource;
use App\Http\Requests\StoreCategoriaRequest;
use App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Categoria;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;

class CategoriaController extends Controller{

    //Retorna lista de recursos
    public function index(Request $request){

        // Captura a coluna para ordenacao
        $sortParameter  = $request->input('ordenacao','nome_da_categoria');
        $sortDirection  = Str::startsWith($sortParameter,'-')? 'desc':'asc';
        $sortColumn     = ltrim($sortParameter,'-');
        //dd($sortColumn);

        // Determina se faz a query ordenada ou aplica o default.
        if($sortColumn == 'nome_da_categoria'){
            $categorias = Categoria::orderBy('nomedacategoria',$sortDirection)->get();
        }else {
            $categorias = Categoria::all();
        }

        return response()->json([
            'status' => 200,
            'mensagem' => 'Lista de categorias retornada',
            'categorias' => CategoriaResource::collection($categorias)
        ], 200);
    }

    // Show the form for creating a new resource.

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
    public function show($categoriaid)
    {
        try{
            $validator = Validator::make(['id' =>$categoriaid],[
                'id' => 'integer'
            ]);

            //Caso nao seja valido, levanar excecao
            if($validator->fails()){
                throw ValidationException::withMessages(['id'=> 'O campo ID deve ser numérico']);
            }

            //Continua o fluxo de execucao
            $categoria = Categoria::findofFail($categoriaid);
            return response() -> json([
                'status' => 200,
                'mensagem' => 'Categoria retornada',
                'categoria' => new CategoriaResource($categoria)
            ]);
        }catch(\Exception $ex){
            $class = get_class($ex);
            switch($class){
                case ModelNotFoundException::class: //caso n exista o id na base
                    return response() -> json([
                        'status' => 404,
                        'mensagem' => 'Categoria não encontrada',
                        'categoria' => []
                    ],400);
                    break;
                case \Illuminate\Validation\ValidationException::class: //caso tenha erro na validacao
                    return response() -> json([
                        'status' => 406,
                        'mensagem' => $ex->getMessage(),
                        'categoria' => []
                    ],400);
                    break;
                default: //caso tenha erro interno
                    return response() -> json([
                        'status' => 500,
                        'mensagem' => 'Erro Interno',
                        'categoria' => []
                    ],500);
                    break;
            }
        }
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
