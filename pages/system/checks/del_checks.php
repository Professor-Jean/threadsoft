<div id="result">
  <h1>Aviso</h1>
<?php
  $G_id = $_GET['id']; // Pega o ID do usuário que o adm quer deletar
  if($G_id==""){ // Se o ID estiver vazio...
    $msg = "Cheque inexistente";
  }else{ // Se o ID não estiver vazio...
    $tabela = "checks";
    $condicao = "id=".$G_id;
    $sql_del_states_resultado = deletar($tabela, $condicao); // Executa o código
    if($sql_del_states_resultado){ // Se deu certo...
      $classe   = "sucesso";
      $titulo   = "Confirmação";
      $msg = "Cadastro de cheque excluído com sucesso."; // Avisa que deu certo
    }else{ // Se deu errado...
      $msg = "Erro ao efetuar a exclusão de cheque."; // Avisa que deu errado
    }
  }
  ?>
  <p>
    <?php echo $msg ?>
  </p>
  <a href="?folder=system/checks/&file=fmadd_checks&ext=php">Voltar</a>
</div>
