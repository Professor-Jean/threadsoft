<div id="result">
  <h1>Aviso</h1>
<?php
  $G_id = $_GET['id']; // Pega o ID do usuário que o adm quer deletar
  if($G_id==""){ // Se o ID estiver vazio...
    $msg = "Vendedor inexistente";
  }else{ // Se o ID não estiver vazio...
    $sql_sel_sellers = "SELECT id FROM entries WHERE sellers_id='".$G_id."'";
    $sql_sel_sellers_preparado = $conexaobd -> prepare($sql_sel_sellers);
    $sql_sel_sellers_preparado -> execute();
    $sql_sel_sellers_rowcount = $sql_sel_sellers_preparado -> rowCount()>0;
    if($sql_sel_sellers_rowcount>0){
      $msg = "Esse vendedor não pode ser excluído pois contém entradas vinculadas!";
    }else{
      $sql_sel_sellers = "SELECT id FROM removals WHERE sellers_id='".$G_id."'";
      $sql_sel_sellers_preparado = $conexaobd -> prepare($sql_sel_sellers);
      $sql_sel_sellers_preparado -> execute();
      $sql_sel_sellers_rowcount = $sql_sel_sellers_preparado -> rowCount()>0;
      if($sql_sel_sellers_rowcount>0){
        $msg = "Esse vendedor não pode ser excluído pois contém saídas vinculadas!";
      }else{
        $sql_sel_sellers = "SELECT id FROM repairs WHERE sellers_id='".$G_id."'";
        $sql_sel_sellers_preparado = $conexaobd -> prepare($sql_sel_sellers);
        $sql_sel_sellers_preparado -> execute();
        $sql_sel_sellers_rowcount = $sql_sel_sellers_preparado -> rowCount()>0;
        if($sql_sel_sellers_rowcount>0){
          $msg = "Esse vendedor não pode ser excluído pois contém brindes vinculados!";
        }else{
          $tabela = "sellers";
          $condicao = "id=".$G_id;
          $sql_del_states_resultado = deletar($tabela, $condicao); // Executa o código
          if($sql_del_states_resultado){ // Se deu certo...
            $classe   = "sucesso";
            $titulo   = "Confirmação";
            $msg = "Cadastro de vendedor excluído com sucesso."; // Avisa que deu certo
          }else{ // Se deu errado...
            $msg = "Erro ao efetuar a exclusão de vendedor."; // Avisa que deu errado
          }
        }
      }
    }
  }
  ?>
  <p>
    <?php echo $msg ?>
  </p>
  <a href="?folder=system/seller/&file=fmadd_seller&ext=php">Voltar</a>
</div>
