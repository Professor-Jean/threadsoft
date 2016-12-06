<div id="result">
  <h1>Aviso</h1>
  <?php
    $p_id        = $_POST['id'];
    $p_name  = $_POST['txtstate'];
    $p_initials     = $_POST["txtinitials"];
    $url         = "?folder=system/state/&file=fmalt_state&ext=php&id=".$p_id;
    if($p_name == ""){
      $msg = "O campo \"NOME\" não foi preenchido!";
    }else if($p_initials == ""){
      $msg = "O campo \"SIGLA\" não foi preenchido!";
    }else{
      $sql_sel_states = "SELECT * FROM states WHERE name='".$p_name."' AND id<>'".$p_id."'";
      $sql_sel_states_preparado = $conexaobd->prepare($sql_sel_states);
      $sql_sel_states_preparado->execute();
      if($sql_sel_states_preparado->rowCount()==0){
      $tabela = "states";
      $dados = array(
        'name' => $p_name,
        'initials' => $p_initials
      );
      $condicao = "id=".$p_id;
      $sql_add_states_resultado = alterar($tabela, $dados, $condicao);
      if($sql_add_states_resultado){
        $msg = "Estado alterado corretamente!";
        $url = "?folder=system/state/&file=fmadd_state_city&ext=php";
      }else{
        $msg = "Erro ao efetuar alteração de estado.";
      }
      }else{
        $msg = "Estado já existe!";
      }
      }
  ?>
  <p class="<?php echo $class ?>">
    <?php echo $msg ?>
  </p>
  <a href="<?php echo $url ?>">Voltar</a>
</div>
