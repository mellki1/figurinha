<?php
    //Chamar o arquivo verificar para poder saber se realmente está logado 
    include 'verificar.php';
    $ultimoAcesso = date('Y/m/d H:i:s', time());
    $update = "UPDATE `usuarios` SET `ultimoAcesso` = '$ultimoAcesso' WHERE `id` = '$idUser'";
    if(!alterarDatas($update, $conexao)){
        echo "<script>alert('Erro ao passar Ultimo Acesso');</script>";
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>PokeFigurinhas</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link href="../css/round-about.css" rel="stylesheet">
    </head>
    <body class="text-center">
       <?php include "menu.php";?>
        <!-- conteudo -->
        <div class="container">

        <div class="row">
            <div class="col-lg-12">
                <h2 class="my-4 text-center">Suas figurinhas</h2>
            </div>
            <div class="">
                <?php
                    $select = "SELECT figurinhas.* 
                    FROM figurinhas, usuariosfigurinhas, usuarios 
                    WHERE usuarios.id = '$idUser' 
                    AND usuarios.id = usuariosfigurinhas.usuarios_id 
                    AND usuariosfigurinhas.figurinha_id = figurinhas.id";
                    $vetor = buscarFigurinhas($select, $idUser, $conexao);
                    if($vetor != -1){
                        foreach ($vetor as $key => $valor) {
                            echo "<img class='figure-img img-fluid rounded border border-dark ' src='img/$valor[caminho]' alt=' 'style='margin-right: 8px;'>";
                        }
                    }else{
                        echo "<p>Voce não possui nenhuma figurinha</p>";
                    }
                ?>
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        </div>
    </body>
</html>