<?php 
    session_start();
    require_once 'conect.php';

    if (!isset($_SESSION['iduser'])){
        $_SESSION['msg']= 'Login Necessário!';
        header('location:index.php');
        exit;
    }
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="home.css">
    <title>Página Inicial</title>
</head>

<body>
    <header>
        <nav>
            <ul>
                <li>
                    <h2>
                        Poggitter
                    </h2>
                    <a style="opacity: 100%;" href="home.php">Página Inicial</a>
                    <a href="postagem.php">Publicar Algo</a>
                    <a href="mypost.php">Minhas Postagens</a>
                    <a class="sair" href="exit.php">Sair</a>
                </li>
            </ul>
        </nav>
    </header>
        <?php 
            $sql = "SELECT postagens.*, usuarios.nome FROM postagens JOIN usuarios ON postagens.usuarioid = usuarios.id ORDER BY data DESC";
            $result = mysqli_query($conect, $sql);

            if (mysqli_num_rows($result) > 0) {

                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="post"';
                    echo '<p class="name">@'. $row['nome']. '</p>';
                    echo '<p class="conteudo">'. $row['descricao']. '</p>';
                    echo '<p class="hora">'. $row['data']. '</p>';
                    echo '</div>';
                }
            } else {
                echo "<p class='aviso'>Nenhuma postagem encontrada.</p>";
            }
            mysqli_close($conect);
            ?>
</body>

</html>