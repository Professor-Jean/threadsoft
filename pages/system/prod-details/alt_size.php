<div id="result">
  <h1>Aviso</h1>
  <?php
    $p_size    = $_POST['txtsize'];
    $p_id      = $_POST['id'];
    $url         = "?folder=system/prod-details/&file=fmalt_size&ext=php&id=".$p_id;
    if($p_size == ""){
      $msg = "O campo \"NOME\" não foi preenchido!";
    }else{
      $sql_sel_sizes = "SELECT * FROM sizes WHERE size='".$p_size."' AND id<>'".$p_id."'";
      $sql_sel_sizes_preparado = $conexaobd->prepare($sql_sel_sizes);
      $sql_sel_sizes_preparado->execute();
      if($sql_sel_sizes_preparado->rowCount()==0){
      $tabela = "sizes";
      $dados = array(
        'size'     => $p_size
      );
      $condicao = "id=".$p_id;
      $sql_alt_sizes_resultado = alterar($tabela, $dados, $condicao);
      if($sql_alt_sizes_resultado){
        $msg = "Tamanho alterado corretamente!";
        $url = "?folder=system/prod-details/&file=fmadd_prod-details&ext=php";
      }else{
        $msg = "Erro ao efetuar alteração de tamanho.";
      }
      }else{
        $msg = "Tamanho já existe!";
      }
    }
  ?>
  <p>
    <?php echo $msg ?>
  </p>
  <a href="<?php echo $url ?>">Voltar</a>
</div>
