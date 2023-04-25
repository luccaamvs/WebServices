<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Resources\v1\CategoriaResource;
use App\Http\Requests\v1\StoreCategoriaRequest;
use App\Http\Controllers\Api;
use App\Http\Controllers\Api\Controller;
use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * @OA\Get(
     *  path="/api/categorias",
     *  operationId="getCategoriasList",
     *  tags={"Categorias"},
     *  summary="Retorna a lista de Categorias",
     *  description="Retorna o JSON da lista de Categorias",
     *  @OA\Response(
     *      response=200,
     *      description="Operação executada com sucesso" 
     *  )
     * )
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
     * @OA\Post(
     *  path="/api/categorias",
     *  operationId="storeCategoria",
     *  tags={"Categorias"},
     *  summary="Cria uma nova Categoria",
     *  description="Retorna o JSON com os dados da nova Categoria",
     *  @OA\RequestBody(
     *      required=true,
     *      @OA\JsonContent(ref="#/components/schemas/StoreCategoriaRequest")
     * ),
     *  @OA\Response(
     *      response=200,
     *      description="Operação executada com sucesso",
     *      @OA\JsonContent(ref="#/components/schemas/Categoria")
     *  )
     * )
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
     * @OA\Get(
     *      path="/api/categorias/{id}",
     *      operationId="getCategoriaById",
     *      tags={"Categorias"},
     *      summary="Retorna o JSON da Categoria requisitada",
     *      @OA\Parameter(
     *          name="id",
     *          description="Id da Categoria",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Operação executada com sucesso"
     *      )
     * )
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
     * @OA\Patch(
     *      path="/api/categorias/{id}",
     *      operationId="updateCategoria",
     *      tags={"Categorias"},
     *      summary="Atualiza uma Categoria existente",
     *      description="Retorna o JSOn da Categoria atualizada",
     *      @OA\Parameter(
     *      name="id",
     *      description="Id da Categoria",
     *      in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     * @OA\RequestBody(
     *      required=true,
     *      @OA\JsonContent(ref="#/components/schemas/StoreCategoriaRequest")
     * ),
     * @OA\Response(
     *      response=200,
     *      description="Operação executada com sucesso"
     * )
     * 
     * )
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
     * @OA\Delete(
     *      path="/api/categorias/{id}",
     *      operationId="deleteCategoria",
     *      tags={"Categorias"},
     *      summary="Apaga uma Categoria existente",
     *      description="Apaga uma Cagegoria existente e não há retorno de dados",
     * @OA\Parameter(
     *      name="id",
     *      description="Id da Categoria",
     *      required=true,
     *      in="path",
     *      @OA\Schema(
     *          type="integer"
     *      )
     * ),
     * @OA\Response(
     *      response=200,
     *      description="Operação executada com sucesso",
     *      @OA\JsonContent()
     * )
     * )
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
