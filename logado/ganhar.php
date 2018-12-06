<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ganhar Figurinahs</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="../css/round-about.css" rel="stylesheet">
</head>
<body class="text-center">
    <?php include "menu.php";?>
    <!-- conteudo -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="my-4">Figurinhas ganhas</h2>
            </div>
                <?php
                    include 'verificar.php';
                    if(verificarUltimasFigurinhas($idUser, $conexao) == 1){
                        for($i = 0; $i <= 4; $i++){
                            $aleatorio = rand(1, 29);
                            ganharFigurinhas($conexao, $idUser, $aleatorio);
                        }
                        echo "<script>alert('Parabéns! Voce Ganhou as figurinhas do dia, volte amanhã.');</script>";
                        echo '<p>';
                        $select = "SELECT figurinhas.* 
                        FROM figurinhas, usuariosfigurinhas, usuarios 
                        WHERE usuarios.id = $idUser 
                        AND usuarios.id = usuariosfigurinhas.usuarios_id 
                        AND usuariosfigurinhas.figurinha_id = figurinhas.id
                        ORDER BY usuariosfigurinhas.id DESC LIMIT 5";
                        $vetor = buscarFigurinhas($select, $idUser, $conexao);
                        if($vetor != -1){
                            foreach ($vetor as $key => $valor) {
                                echo "<img class='figure-img img-fluid rounded border border-dark ' src='img/$valor[caminho]' alt=' 'style='margin-right: 8px;'>";
                            }
                        }else{
                            echo "<p>Voce não possui nenhuma figurinha</p>";
                        }
                        echo '</p>';
                    }elseif(verificarUltimasFigurinhas($idUser, $conexao) == 0){
                        echo "<p>Voce já ganhou as figurinhas do dia! Volte amanhã.</p>";
                    }else{
                        echo "<script>alert('Erro na função verificarUltimasFigurinhas.');</script>";
                    }
                ?>
        </div>
    </div>
</body>
</html>
