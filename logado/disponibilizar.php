<?php
    //Chamar o arquivo verificar para poder saber se realmente está logado 
    include 'verificar.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Disponibilizar para Troca</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link href="../css/round-about.css" rel="stylesheet">
    </head>
   
    <body class="text-center">
        <?php include "menu.php";?>
        <!-- conteudo -->
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="my-4">Figurinhas disponiveis para troca</h2>
                    <form action="disponibilizarBd.php" method="post">
                        <table class="table table-bordered table-dark">
                            <?php
                                $select = "SELECT figurinhas.*
                                FROM figurinhas, usuariosfigurinhas, usuarios 
                                WHERE usuarios.id = '$idUser' 
                                AND usuarios.id = usuariosfigurinhas.usuarios_id 
                                AND usuariosfigurinhas.figurinha_id = figurinhas.id
                                AND usuariosfigurinhas.disponivel = 1";
                                $vetor = buscarFigurinhas($select, $idUser, $conexao);
                                $cont = 1;
                                if($vetor != -1){
                                    foreach ($vetor as $key => $value) {
                                        if($cont == 1){
                                            echo "<tr>";
                                        }
                                        echo '<td>';
                                        
                                        echo "<img class='figure-img img-fluid rounded border border-dark ' src='img/$value[caminho]' alt='' 'style='margin-right: 8px;'>";
                                        echo "<input type='checkbox' class='checkbox' name='array[]' value='".$value['id']."'>";
                                        echo '</td>';
                                    
                                        if($cont == 5){
                                            
                                            echo "</tr>";
                                            $cont = 0;
                                        }
                                        $cont++;
                                    }
                                }else{
                                    echo "<p>Voce não possui nenhuma figurinha disponivel para troca!</p>";
                                }
                            ?>
                        </table>
                        <button type='submit' class="btn btn-primary btn-lg" style='margin-bottom: 20px;'>Disponibilizar Selecionadas</button>
                    </form>
                </div>
            </div>
            
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </body>
</html>