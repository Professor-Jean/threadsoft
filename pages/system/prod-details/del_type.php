<div id="result">
  <h1>Aviso</h1>
<?php
  $G_id = $_GET['id']; // Pega o ID do usuário que o adm quer deletar
  if($G_id==""){ // Se o ID estiver vazio...
    $msg = "Categoria inexistente";
  }else{ // Se o ID não estiver vazio...
    $sql_sel_products = "SELECT id FROM products WHERE categories_id='".$G_id."'";
    $sql_sel_products_preparado = $conexaobd -> prepare($sql_sel_products);
    $sql_sel_products_preparado -> execute();
    $sql_sel_products_rowcount = $sql_sel_products_preparado -> rowCount()>0;
    if($sql_sel_products_rowcount>0){
      $msg = "Essa categoria não pode ser excluída pois contém produtos vinculados!";
    }else{
      $tabela = "categories";
      $condicao = "id=".$G_id;
      $sql_del_states_resultado = deletar($tabela, $condicao); // Executa o código
      if($sql_del_states_resultado){ // Se deu certo...
        $classe   = "sucesso";
        $titulo   = "Confirmação";
        $msg = "Cadastro de categoria excluído com sucesso."; // Avisa que deu certo
      }else{ // Se deu errado...
        $msg = "Erro ao efetuar a exclusão de categoria."; // Avisa que deu errado
      }
    }
  }
  ?>
  <p>
    <?php echo $msg ?>
  </p>
  <a href="?folder=system/prod-details/&file=fmadd_prod-details&ext=php">Voltar</a>
</div>
