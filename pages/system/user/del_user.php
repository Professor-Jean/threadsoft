<div id="result">
  <h1>Aviso</h1>
<?php
  $G_id = $_GET['id']; // Pega o ID do usuário que o adm quer deletar
  if($G_id==""){ // Se o ID estiver vazio...
    $msg = "Usuário inexistente";
  }else{ // Se o ID não estiver vazio...
    $sql_sel_users = "SELECT * FROM users";
    $sql_sel_users_preparado = $conexaobd -> prepare($sql_sel_users);
    $sql_sel_users_preparado -> execute();
    if($sql_sel_users_preparado -> rowCount()>1){
      $tabela = "users";
      $condicao = "id=".$G_id;
      $sql_del_users_resultado = deletar($tabela, $condicao); // Executa o código
      if($sql_del_users_resultado){ // Se deu certo...
        if($G_id == $_SESSION['idUsuario']){
          header("Location: ".BASE_URL."security/authentication/logout_authentication.php"); // Desloga e manda pra index
        }
        $classe   = "sucesso";
        $titulo   = "Confirmação";
        $msg = "Cadastro de administrador excluído com sucesso."; // Avisa que deu certo
      }else{ // Se deu errado...
        $msg = "Erro ao efetuar a exclusão do administrador."; // Avisa que deu errado
      }
    }else{
      $msg = "Você não pode se excluir sendo o único administrador registrado.";
    }
  }
  ?>
  <p>
    <?php echo $msg ?>
  </p>
  <a href="?folder=system/user/&file=fmadd_user&ext=php">Voltar</a>
</div>
