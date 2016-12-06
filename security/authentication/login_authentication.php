<?php // Aqui começa o script de validação PHP
  include "../database/dbconfig.php";
  include "../database/dbconnect.php";
  $p_user = $_POST['txtuser']; // Salva os dados do input "usuário" em uma váriavel
  $p_password   = $_POST['pwdpassword']; // Salva os dados do input "senha" em uma variável
    if ($p_user == "") { // Se o campo "usuário" estiver vazio...
      $aviso_erro = "Campo \"USUÁRIO\" não foi preenchido!"; // Ele avisa ao usuário
      $aviso_dica = "Preencha os campos corretamente!"; // Ele dá uma dica ao usuário
    }else if ($p_password == "") { // Se o campo "senha" estiver vazio...
          $aviso_erro = "Campo \"SENHA\" não foi preenchido!"; // Ele avisa ao usuário
          $aviso_dica = "Preencha os campos corretamente!"; // Ele dá uma dica ao usuário
        }else{ // Se tudo estiver preenchido...
              $sql_sel_users = "SELECT * FROM users WHERE username='".$p_user."' AND password='".$p_password."'"; // Ele procura por usuários que tem o mesmo nome e senha ao que foi digitado pelo usuário
              $sql_sel_users_preparado = $conexaobd->prepare($sql_sel_users); // Prepara o código SQL
              $sql_sel_users_preparado->execute(); // Executa o código SQL
              if($sql_sel_users_preparado->rowCount()>0){ // Se tem um usuário no sistema com o mesmo usuário e senha ao que foi digitado
                $sql_sel_users_dados = $sql_sel_users_preparado->fetch(); // Ele procura os dados desse usuário
                session_start(); // Inicia uma sessão
                $_SESSION['idUsuario']  = $sql_sel_users_dados['id']; // Guarda o ID desse usuário num array
                $_SESSION['usuario']    = $sql_sel_users_dados['username']; // Guarda o nome desse usuário num array
                $_SESSION['idSessao']   = session_id(); // Guarda o ID da sessão num array
                header("location: ../../pages/main.php"); // Redireciona para a página de administração
              }else{ // Se não achar nenhum usuário com o mesmo nome e senha
                $aviso_erro = "Falha na autenticação!"; // Ele avisa que esse usuário não existe
                $aviso_dica = "Campo \"USUÁRIO\" ou \"SENHA\" não foi preenchido corretamente!";
              }
            } // Fim da estrutura condicional
?> <!-- Fim do script de validação PHP -->
<h1> <!-- O título da mensagem -->
  <?php
    echo $aviso_erro; // Ele avisa ao usuário o que deu de certo/errado
  ?>
</h1> <!-- Fim do título da mensagem -->
<p> <!-- Dica da mensagem -->
  <?php
    echo $aviso_dica; // Ele dá uma dica ao usuário do que fazer ou o parabeniza :)
  ?> <!-- Fim do script de validação PHP -->
</p> <!-- Fim da dica da mensagem -->
<a href="../../index.php">Voltar</a>
