<div id="result">
  <h1>Aviso</h1>
  <?php
    $p_type    = $_POST['txttype'];
    $p_id      = $_POST['id'];
    $url         = "?folder=system/prod-details/&file=fmalt_type&ext=php&id=".$p_id;
    if($p_type == ""){
      $msg = "O campo \"NOME\" não foi preenchido!";
    }else{
      $sql_sel_types = "SELECT * FROM categories WHERE category='".$p_type."' AND id<>'".$p_id."'";
      $sql_sel_types_preparado = $conexaobd->prepare($sql_sel_types);
      $sql_sel_types_preparado->execute();
      if($sql_sel_types_preparado->rowCount()==0){
      $tabela = "categories";
      $dados = array(
        'category'     => $p_type
      );
      $condicao = "id=".$p_id;
      $sql_add_types_resultado = alterar($tabela, $dados, $condicao);
      if($sql_add_types_resultado){
        $msg = "Categoria alterada corretamente!";
        $url = "?folder=system/prod-details/&file=fmadd_prod-details&ext=php";
      }else{
        $msg = "Erro ao efetuar alteração de categoria.";
      }
      }else{
        $msg = "Categoria já existe!";
      }
    }
  ?>
  <p>
    <?php echo $msg ?>
  </p>
  <a href="<?php echo $url ?>">Voltar</a>
</div>
