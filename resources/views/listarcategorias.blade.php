<html>
    <head>
        <title>Titulo</title>
    </head>
    <body>
        <p>Resultado do Processamento</p>
        <p><b>Código de retorno: {{ $categorias->status}}</b></p>
        <p><b>Mensagem: {{ $categorias->mensagem}}</b></p>
        <br>
        <table>
            <tr>
                <th>Id</th>
                <th>Nome</th>
            </tr>
            @foreach($categorias->categorias as $categoria)
            <tr>
                <td>{{ $categoria->id}}</td>
                <td>{{ $categoria->nome_da_categoria }}</td>
            </tr>
            @endforeach
        </table>
    </body>
</html>