<!--ficcao cientifica--->
<?php
session_start();

// Redireciona para garantir que os dados sejam manipulados sempre nesta página
if (basename($_SERVER['PHP_SELF']) !== 'votacao_front6.php') {
    header("Location: votacao_front6.php");
    exit;
}

// Reinicia a sessão se "reset" for chamado
if (isset($_GET['reset'])) {
    session_destroy();
    session_start();
}

// Inicializa a lista de filmes 
if (!isset($_SESSION['filmes'])) {
    $_SESSION['filmes'] = [
        ['nome' => 'Matrix', 'imagem' => 'matrix.jpg'],
        ['nome' => 'A Origem', 'imagem' => 'a_origem.webp'],
        ['nome' => 'Duna', 'imagem' => 'duna.jpg'],
        ['nome' => 'Avatar', 'imagem' => 'avatar.jpg'],
        ['nome' => 'E.T. O Extraterrestre', 'imagem' => 'et.jpg'],
        ['nome' => 'Alien: Romulus', 'imagem' => 'alien_romulus.jpg'],
        ['nome' => 'Maze Runner: Correr ou Morrer', 'imagem' => 'maze_runner.jpeg'],
        ['nome' => 'Laranja Mecânica', 'imagem' => 'laranja_mecanica.webp'],
        ['nome' => 'Mad Max', 'imagem' => 'mad_max.jpg'],
        ['nome' => 'Logan', 'imagem' => 'logan.jpg'],
        ['nome' => 'O Exterminador do Futuro', 'imagem' => 'o_exterminador_do_futuro.jpg'],
        ['nome' => 'O Planeta dos Macacos', 'imagem' => 'o_planeta_dos_macacos.jpg'],
    ];
}

// Inicializa os filmes em votação
if (!isset($_SESSION['em_votacao'])) {
    $_SESSION['em_votacao'] = [array_shift($_SESSION['filmes']), array_shift($_SESSION['filmes'])];
}

// Processa o voto
if (isset($_GET['voto'])) {
    $voto = (int)$_GET['voto'];

    // Remove o filme perdedor
    $perdedor = $voto === 0 ? 1 : 0;
    unset($_SESSION['em_votacao'][$perdedor]);

    // Adiciona um novo filme à votação
    if (count($_SESSION['filmes']) > 0) {
        $_SESSION['em_votacao'][$perdedor] = array_shift($_SESSION['filmes']);
    }

    // Reorganiza os índices do array
    $_SESSION['em_votacao'] = array_values($_SESSION['em_votacao']);
}

// Checa se há apenas um filme restante e exibe o vencedor
if (count($_SESSION['em_votacao']) === 1) {
    $vencedor = $_SESSION['em_votacao'][0];
    echo "<!DOCTYPE html>
<html lang='pt-br'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Votação de Filmes</title>
    <link rel='stylesheet' href='../assets/css/styleVotacao.css'>
    <link rel='icon' href='../assets/img/icon/VOTE (1).png' >
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH' crossorigin='anonymous'>
</head>

<body>
    <header class= 'header-votacao'>
        <a href='../pages/generos.html'>  
                <button type='button' class='btn btn-danger'>VOLTAR</button>
            </a>
        </header>

            <!-------->
            <div class='vencedor-container'>
            <h1>Filme Vencedor:</h1>
            <p class='text-vencedor'>{$vencedor['nome']}</p>
            <img src='../assets/img/filmes/ficcaocientifica/{$vencedor['imagem']}' alt='{$vencedor['nome']}' class='img-vencedor'>
          </div>
</body>

</html>";
    session_destroy();
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votação de Filmes</title>
    <link rel="stylesheet" href="../assets/css/styleVotacao.css">
    <link rel="icon" href="../assets/img/icon/VOTE (1).png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
<header class= "header-votacao">
        <a href="../pages/generos.html">  
                <button type="button" class="btn btn-danger">VOLTAR</button>
            </a>
        </header>   
<!---main parte da votação-->
    <main class="main">
        <h1 class="titulo">Escolha o filme:</h1>
        <div class="opcoes">
            <?php foreach ($_SESSION['em_votacao'] as $key => $filme): ?>
                <a href="votacao_front6.php?voto=<?= $key ?>">
                    <input type="image" src="../assets/img/filmes/ficcaocientifica/<?= $filme['imagem'] ?>" 
                           alt="<?= $filme['nome'] ?>" class="button">
                </a>
            <?php endforeach; ?>
        </div>
        <!-- Botão para reiniciar -->
        <div class="reset">
            <a href="votacao_front6.php?reset=true">Reiniciar Votação</a>
        </div>
    </main>
</body>

</html>
