<div id="result">
  <h1>Aviso</h1>
  <?php
    $p_size    = $_POST['txtsize'];
    if($p_size == ""){
      $msg = "O campo \"NOME\" não foi preenchido!";
    }else{
      $sql_sel_sizes = "SELECT * FROM sizes WHERE size='".$p_size."'";
      $sql_sel_sizes_preparado = $conexaobd->prepare($sql_sel_sizes);
      $sql_sel_sizes_preparado->execute();
      if($sql_sel_sizes_preparado->rowCount()==0){
      $tabela = "sizes";
      $dados = array(
        'size'     => $p_size
      );
      $sql_add_sizes_resultado = adicionar($tabela, $dados);
      if($sql_add_sizes_resultado){
        $msg = "Tamanho cadastrado corretamente!";
      }else{
        $msg = "Erro ao efetuar cadastro de tamanho.";
      }
      }else{
        $msg = "Tamanho já existe!";
      }
    }
  ?>
  <p>
    <?php echo $msg ?>
  </p>
  <a href="?folder=system/prod-details/&file=fmadd_prod-details&ext=php">Voltar</a>
</div>
