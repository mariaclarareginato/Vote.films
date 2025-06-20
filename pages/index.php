<?php
 
// Caminho do arquivo de dados
$arquivoCadastro = "cadastro.txt";
 
// Cadastro de novo usuário
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nome'], $_POST['email'], $_POST['senha'], $_POST['confirmarsenha'])) {
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $senha = trim($_POST['senha']);
    $confirmarSenha = trim($_POST['confirmarsenha']);
 
    // Validações básicas
    if ($senha !== $confirmarSenha) {
        echo "<script>alert('As senhas não coincidem.');</script>";
        return;
    }
 
    // Verifica se o e-mail já está cadastrado
    if (file_exists($arquivoCadastro)) {
        $usuarios = file($arquivoCadastro, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($usuarios as $usuario) {
            $dados = explode(",", $usuario);
            if ($dados[1] === $email) {
                echo "<script>alert('E-mail já cadastrado.');</script>";
                return;
            }
        }
    }
 
    // Salva o novo usuário
    $dados = $nome . "," . $email . "," . $senha . "\n";
    file_put_contents($arquivoCadastro, $dados, FILE_APPEND);
    echo "<script>alert('Cadastro realizado com sucesso!');</script>";
}
 
// Login do usuário
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['emaillogin'], $_POST['senhalogin'])) {
    $emailLogin = trim($_POST['emaillogin']);
    $senhaLogin = trim($_POST['senhalogin']);
   
    $loginValido = false;
    // Verifica credenciais no arquivo
    if (file_exists($arquivoCadastro)) {
        $usuarios = file($arquivoCadastro, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($usuarios as $usuario) {
            $dados = explode(",", $usuario);
     
            if (trim($dados[1]) == $emailLogin && trim($dados[2]) == $senhaLogin) {
           
                $loginValido = true; // Login válido
                header('Location: index.php');
            }
        }
    }
 
    if ($loginValido == true) {
        echo "<script>alert('Login realizado com sucesso!');";
        header('Location: home.html');
    } else {
        echo "<script>alert('Usuário ou senha incorretos.');</script>";
    }
}
 
?>
<!DOCTYPE html>
<html lang="pt-br">
 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="../assets/css/loginCadastro.css">
    <link rel="icon" href="../assets/img/icon/VOTE (1).png">
</head>
 
<body>
    <script src="../assets/js/loginCadastro.js"></script>
    <header>
        <div class="menu__home_login">
           
            <img src="../assets/img/img-logo/1.jpg" class="img__menu">
                </div>
    </header>


    <div class="estrutura">
        <div class="slide-titulo">
            <div class="titulo login">
                Login
            </div>
            <div class="titulo cadastro">
                Crie sua conta
            </div>
        </div>
        <div class="form-container">
            <div class="slide-controles" onclick="handlerTab(this, event)">
                <input type="radio" name="slide" id="login" checked>
                <input type="radio" name="slide" id="signup">
                <label for="login" class="slide-botão login">Login</label>
                <label for="signup" class="slide-botão signup">Cadastro</label>
                <div class="slider-button-tab"></div>
            </div>
            <div class="form-interno">
                <form class="login" action="" method="post">
                    <div class="quadro">
                        <input type="email" placeholder="E-mail" name="emaillogin" required>
                    </div>
                    <div class="quadro">
                        <input type="password" placeholder="Senha" name="senhalogin" required>
                    </div>
                    <div class="btn-senha">
                        <a href="./pages/esqsenha.php">Esqueceu a senha?</a>
                    </div>
                    <div class="quadro btn">
                        <input type="submit" value="Entrar">
                    </div>
                    <div class="contato">
                        Não tem conta?<a href="">Crie agora</a>
                    </div>
                </form>
                <form class="signup" action="./pages/home.html" method="post">
                    <div class="quadro">
                        <input type="text" placeholder="Nome" name="nome" required>
                    </div>
                    <div class="quadro">
                        <input type="email" placeholder="E-mail" name="email" required>
                    </div>
                    <div class="quadro">
                        <input type="password" placeholder="Senha" name="senha" required>
                    </div>
                    <div class="quadro">
                        <input type="password" placeholder="Confirme sua senha" name="confirmarsenha" required>
                    </div>
                    <div class="quadro btn">
                        <input type="submit" value="Entrar">
                    </div>
                </form>
            </div>
            <div class="requisito">
                <div class="sub-requisito">
                    <input type="checkbox" required>
                    <p>Eu concordo com os termos de segurança, e estou ciente de que meus resultados serão visualizados pela equipe VOTE.F para pesquisas com relação aos meus votos.</p>
                </div>
                <div class="sub-requisito">
                    <input type="checkbox" required>
                    <p>Quero que meus votos sejam anônimos, sem aparecerem nas pesquisas da VOTE.F.</p>
                </div>
            </div>
        </div>
    </div>
   <!--footer-->
   <footer>
        <div class="footer-container">
            <!--  -->
            <div class="footer-section contact">
                <h3>Contato</h3>
                <p>Telefone: (11) 1234-5678</p>
                <p>Email: vote.f@outlook.com</p>
                <p>Endereço: R. Santo André, 680 - Boa Vista, São Caetano do Sul - SP, 09572-000</p>
            </div>

            <!--  -->
           

            <!--  -->
            <div id="f" class="footer-section social">
                <h3>Siga os criadores</h3>
                <a href="#f" >Instagram: </a> |
                <a href="https://www.instagram.com/felipehenryss/profilecard/?igsh=MXVkZXFvNWt1bjdqaw==" target="_blank">Felipe Henry </a> |
                <a href="https://www.instagram.com/ma.rgnto?igsh=dnM2azZsMXowMG43" target="_blank"> Maria Clara</a> |
                <a href="https://www.instagram.com/011_s0usax/profilecard/?igsh=ZDd3YzAxcGFib2Rr" target="_blank"> Richard Garcia</a> <br>
                <a href="#" target="_blank">LinkedIn:</a> |
                <a href="https://www.linkedin.com/in/felipe-henry-severino-sacchi-621983337/" target="_blank">Felipe Henry </a> |
                <a href="https://www.linkedin.com/in/maria-clara-reginato-b44b63339/" target="_blank"> Maria Clara</a> |
                <a href="https://www.linkedin.com/in/richard-sousa-garcia-b91986337?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app" target="_blank"> Richard Garcia</a> 
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 vote.f. Todos os direitos reservados.</p>
        </div>
       
    </footer>

</body>