<div id="result">
  <h1>Aviso</h1>
  <?php
    $p_type    = $_POST['txttype'];
    if($p_type == ""){
      $msg = "O campo \"NOME\" não foi preenchido!";
    }else{
      $sql_sel_types = "SELECT * FROM categories WHERE category='".$p_type."'";
      $sql_sel_types_preparado = $conexaobd->prepare($sql_sel_types);
      $sql_sel_types_preparado->execute();
      if($sql_sel_types_preparado->rowCount()==0){
      $tabela = "categories";
      $dados = array(
        'category'     => $p_type
      );
      $sql_add_types_resultado = adicionar($tabela, $dados);
      if($sql_add_types_resultado){
        $msg = "Categoria cadastrada corretamente!";
      }else{
        $msg = "Erro ao efetuar cadastro de categoria.";
      }
      }else{
        $msg = "Categoria já existe!";
      }
    }
  ?>
  <p>
    <?php echo $msg ?>
  </p>
  <a href="?folder=system/prod-details/&file=fmadd_prod-details&ext=php">Voltar</a>
</div>
