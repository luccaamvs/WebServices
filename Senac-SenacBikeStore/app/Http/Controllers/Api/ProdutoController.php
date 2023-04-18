<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\produto;
use Illuminate\Http\Request;
use App\Http\Resources\ProdutoResource;
use Illuminate\Support\Str;

class ProdutoController extends Controller
{
    // Filtro de Entrada
    public function index(Request $request)
    {

        $query = Produto::with('categoria', 'marca');

        $mensagem = "Lista de Produtos retornada";
        $codigoderetorno = 0;

        $filterParameter = $request -> input("filtro");

        if($filterParameter == null){
            //retorna todos os default
            $mensagem = "Lista de Produtos retornada - Completa";
            $codigoderetorno = 200;
        }else{
            //Obtem o nome do filtro e seu criterio
            [$filterCriteria, $filterValue] = explode(":", $filterParameter);

            //Se o filtro esta de acordo com seus valores
            if($filterCriteria == "nome_da_categoria"){
                $produtos = $query->join("categorias", "pkcategoria","=","fkcategoria")
                ->where("nomedacategoria", "=",$filterValue);
                $mensagem = "Lista de produtos retornada - Filtrada";
                $codigoderetorno = 200;
            }else{
                //Usuario chamou um filtro que nao existe
                $produtos = [];
                $mensagem = "Filtro nao aceito";
                $codigoderetorno = 406;
            }
        }

        if($codigoderetorno == 200){
            //realiza ordenacao
            if($request->input('ordenacao','')){
                $sorts = explode(',', $request->input('ordenacao',''));

                foreach($sorts as $sortColumn){
                    $sortDirection = Str::startsWith($sortColumn, '-')?'desc':'asc';
                    $sortColumn = ltrim($sortColumn, '-');

                    switch($sortColumn){
                        case("nome_do_produto"):
                            $query->orderBy('nomedoproduto', $sortDirection);
                        break;
                        case("ano_do_produto"):
                            $query->orderBy('anodomodelo', $sortDirection);
                        break;
                        case("preco_de_lista"):
                            $query->orderBy('precodelista', $sortDirection);
                        break;
                    }
                }
                $mensagem = $mensagem . "+Ordenada";
            }
        }

      

        //Paginacao
        $input = $request->input('pagina');
        if($input){
            $page = $input;
            $perPage = 10;
            $query->offset(($page-1)* $perPage)->limit($perPage);
            $produtos = $query->get();
            
            $recordsTotal = Produto::count();
            $numberofPages = ceil($recordsTotal / $perPage);

            $mensagem = $mensagem . "+Paginada";
        }

        if($codigoderetorno == 200){
            $produtos = $query->get();
            $response = response() -> json([
                'status' => 200,
                'mensagem' => $mensagem,
                'produtos' => ProdutoResource::collection($produtos)
            ],200);
        }else{
            //Retorna o erro
            $response = response()->json([
                'status' => 406,
                'mensagem' => $mensagem,
                'produtos' => $produtos
            ],406);
        }

            return $response;
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(produto $produto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(produto $produto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, produto $produto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(produto $produto)
    {
        //
    }
}
