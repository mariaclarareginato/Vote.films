<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $novaSenha = $_POST['novaSenha'];
    $confirmarSenha = $_POST['confirmarNovaSenha'];
    $email = $_POST['email'];
    // print_r($_POST);
    // Validação de senha
    if ($novaSenha !== $confirmarSenha) {
        echo "<script>alert('As senhas não coincidem.');</script>";
        exit;
    }

    // Critérios: 3 dígitos, 2 caracteres especiais e 5 letras
    // if (!preg_match('/^(?=.*[0-9]{3})(?=.*[!@#$%^&*]{2})(?=.*[a-zA-Z]{5}).{10,}$/', $novaSenha)) {
    //     echo "<script>alert('phpA senha deve conter ao menos 3 dígitos, 2 caracteres especiais e 5 letras.');</script>";
    //     exit;
    // }

    // Manipulação do arquivo cadastro.txt
    $arquivo = 'cadastro.txt';
    $dadosAlterados = '';
    $senhaAlterada = false;

    if (file_exists($arquivo)) {
        $linhas = file($arquivo, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ($linhas as $linha) {
            $dados = explode(',', $linha);
            // print_r($dados);
            // Verifica se o e-mail corresponde
            if (trim($dados[1]) === $email) {
                $dados[2] = $novaSenha; // Atualiza a senha
                $senhaAlterada = true;
            }

            // Reconstrói a linha
            $dadosAlterados .= implode(',', $dados) . PHP_EOL;
        }
        // print $dadosAlterados;
        // Sobrescreve o arquivo com os dados atualizados
        file_put_contents($arquivo, $dadosAlterados);

        if ($senhaAlterada == true) {
            echo "<script>alert('Senha alterada com sucesso!');</script>";
            session_destroy(); // Limpa a sessão após redefinição
            header('Location: index.php');
        } else {
            echo "<script>alert('Erro: Email não encontrado no registro.');</script>";
        }
    } else {
        echo "<script>alert('Erro: Arquivo de usuários não encontrado.');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-Br">
 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="../assets/css/esqsenha.css">
    <link rel="icon" href="../assets/img/icon/VOTE (1).png">
</head>
 
<body>
<header>
        <div class="menu__home_login">
           
            <img src="../assets/img/img-logo/1.jpg" class="img__menu">
                </div>
    </header>


    <div class="container">
        <div class="container-title">
            <div class="title">
                <h1>Redefina sua senha</h1>
                <p>Crie uma senha nova que não seja a mesma que a anterior, possua pelo menos 3 digitos, 2 caracteres especiais e 5 letras. </p>
            </div>
        </div>
        <form class="form" action="./esqsenha.php" method="post">
            <div class="quadro">
                <input class="style-email" type="email" placeholder="E-mail" name="email" required>
            </div>
            <div class="quadro">
                <input class="style-senha" onblur="validarFormulario()" type="password" placeholder="Senha" id="novaSenha" name="novaSenha" required>
            </div>
            <div class="quadro">
                <input class="conf-senha" onblur="validarConfirmar()" type="password" placeholder="Confirmar Senha" id="confirmarNovaSenha" name="confirmarNovaSenha" required>
            </div>
            <div class="quadro">
                <input class="style-enviar" type="submit" value="Enviar">
            </div>
        </form>
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
            <div class="footer-section links">
                <h3>Links</h3>
                <ul>
                   
                    <li><a href="../pages/index.php">LOGIN</a></li>
                    
                </ul>
            </div>

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


    <script>
        // alert();
        // Função JavaScript para validar os requisitos da senha
        function validarFormulario() {
            var novaSenha = document.getElementById('novaSenha');
            var confirmarNovaSenha = document.getElementById('confirmarNovaSenha').value;
 
            if (novaSenha.value != "") {
                // Função para validar os requisitos da senha
                function validarInput(senha) {
                    var temDigitos = /\d/.test(novaSenha.value) && (novaSenha.value.match(/\d/g) || []).length >= 3;
                    var temCaracteresEspeciais = /[^a-zA-Z0-9]/.test(novaSenha.value) && (novaSenha.value.match(/[^a-zA-Z0-9]/g) || []).length >= 2;
                    var temLetras = /[a-zA-Z]/.test(novaSenha.value) && (novaSenha.value.match(/[a-zA-Z]/g) || []).length >= 5;
 
                    return temDigitos && temCaracteresEspeciais && temLetras;
                }
 
                // Verifica os requisitos da senha
                if (!validarInput(novaSenha.value)) {
                    alert('A senha deve conter: \n- Pelo menos 3 dígitos \n- Pelo menos 2 caracteres especiais \n- Pelo menos 5 letras');
                    novaSenha.value = "";
                    novaSenha.focus();
                    return false;
                }
            }
            // Se passar em todas as validações, o formulário é enviado
            return true;
        }
 
        function validarConfirmar() {
            var novaSenha = document.getElementById('novaSenha').value;
            var confirmarNovaSenha = document.getElementById('confirmarNovaSenha');
 
            if (confirmarNovaSenha.value != '') {
                // Verifica se as senhas são iguais
                if (novaSenha !== confirmarNovaSenha.value) {
                    alert("As senhas não são iguais.");
                    confirmarNovaSenha.value = "";
                    confirmarNovaSenha.focus();
                    return false;
                }
 
            }
            // Se passar em todas as validações, o formulário é enviado
            return true;
        }
    </script>
 
