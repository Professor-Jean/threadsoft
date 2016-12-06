<div id="result">
  <h1>Aviso</h1>
<?php
  $G_id = $_GET['id']; // Pega o ID do usuário que o adm quer deletar
  if($G_id==""){ // Se o ID estiver vazio...
    $msg = "Cidade inexistente";
  }else{ // Se o ID não estiver vazio...
    $sql_sel_cities = "SELECT id FROM sellers WHERE cities_id='".$G_id."'";
    $sql_sel_cities_preparado = $conexaobd -> prepare($sql_sel_cities);
    $sql_sel_cities_preparado -> execute();
    $sql_sel_cities_rowcount = $sql_sel_cities_preparado -> rowCount()>0;
    if($sql_sel_cities_rowcount>0){
      $msg = "Essa cidade não pode ser excluída pois contém vendedores vinculados!";
    }else{
      $tabela = "cities";
      $condicao = "id=".$G_id;
      $sql_del_states_resultado = deletar($tabela, $condicao); // Executa o código
      if($sql_del_states_resultado){ // Se deu certo...
        $classe   = "sucesso";
        $titulo   = "Confirmação";
        $msg = "Cadastro de cidade excluído com sucesso."; // Avisa que deu certo
      }else{ // Se deu errado...
        $msg = "Erro ao efetuar a exclusão de cidade."; // Avisa que deu errado
      }
    }
  }
  ?>
  <p>
    <?php echo $msg ?>
  </p>
  <a href="?folder=system/state/&file=fmadd_state_city&ext=php">Voltar</a>
</div>
