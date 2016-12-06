<div id="result">
  <h1>Aviso</h1>
<?php
  $G_id = $_GET['id']; // Pega o ID do usuário que o adm quer deletar
  $sql_sel_products = "SELECT
                        products_has_sizes.id
                       FROM products_has_sizes
                       INNER JOIN products ON products.id = products_has_sizes.products_id
                       WHERE products.id='".$G_id."'";
  $sql_sel_products_preparado = $conexaobd->prepare($sql_sel_products);
  $sql_sel_products_preparado->execute();
  $sql_sel_products_dados = $sql_sel_products_preparado->fetch();
  if($G_id==""){ // Se o ID estiver vazio...
    $msg = "Produto inexistente";
  }else{ // Se o ID não estiver vazio...
    $sql_sel_products_has_sizes = "SELECT id FROM entries_has_products_has_sizes WHERE products_has_sizes_id='".$sql_sel_products_dados['id']."'";
    $sql_sel_products_has_sizes_preparado = $conexaobd -> prepare($sql_sel_products_has_sizes);
    $sql_sel_products_has_sizes_preparado -> execute();
    $sql_sel_products_has_sizes_rowcount = $sql_sel_products_has_sizes_preparado -> rowCount()>0;
    if($sql_sel_products_has_sizes_rowcount>0){
      $msg = "Esse produto não pode ser excluído pois contém entradas vinculadas!";
    }else{
      $sql_sel_products_has_sizes = "SELECT id FROM removals_has_products_has_sizes WHERE products_has_sizes_id='".$sql_sel_products_dados['id']."'";
      $sql_sel_products_has_sizes_preparado = $conexaobd -> prepare($sql_sel_products_has_sizes);
      $sql_sel_products_has_sizes_preparado -> execute();
      $sql_sel_products_has_sizes_rowcount = $sql_sel_products_has_sizes_preparado -> rowCount()>0;
      if($sql_sel_products_has_sizes_rowcount>0){
        $msg = "Esse produto não pode ser excluído pois contém saídas vinculadas!";
      }else{
        $tabela = "products_has_sizes";
        $condicao = "id=".$sql_sel_products_dados['id'];
        $sql_del_products_resultado = deletar($tabela, $condicao); // Executa o código
        if($sql_del_products_resultado){ // Se deu certo...
          $tabela = "products";
          $condicao = "id=".$G_id;
          $sql_del_sizes_resultado = deletar($tabela, $condicao); // Executa o código
          if($sql_del_sizes_resultado){ // Se deu certo...
            $msg = "Cadastro de produto excluído com sucesso."; // Avisa que deu certo
          }else{ // Se deu errado...
            $msg = "Erro ao efetuar a exclusão de produto [Erro 1]."; // Avisa que deu errado
          }
        }else{
          $msg = "Erro ao efetuar a exclusão de produto."; // Avisa que deu errado
        }
      }
    }
  }
  ?>
  <p>
    <?php echo $msg ?>
  </p>
  <a href="?folder=system/products/&file=fmadd_products&ext=php">Voltar</a>
</div>
