<div id="result">
  <h1>Aviso</h1>
  <?php
    $p_states    = $_POST['txtstate'];
    $p_initials = $_POST["txtinitials"];
    if($p_states == ""){
      $msg = "O campo \"ESTADO\" não foi preenchido!";
    }else if($p_initials == ""){
      $msg = "O campo \"SIGLA\" não foi preenchido!";
    }else{
      $sql_sel_states = "SELECT * FROM states WHERE name='".$p_states."'";
      $sql_sel_states_preparado = $conexaobd->prepare($sql_sel_states);
      $sql_sel_states_preparado->execute();
      if($sql_sel_states_preparado->rowCount()==0){
      $tabela = "states";
      $dados = array(
        'name'     => $p_states,
        'initials' => $p_initials
      );
      $sql_add_states_resultado = adicionar($tabela, $dados);
      if($sql_add_states_resultado){
        $msg = "Estado cadastrado corretamente!";
      }else{
        $msg = "Erro ao efetuar cadastro de estado.";
      }
      }else{
        $msg = "Estado já existe!";
      }
    }
  ?>
  <p>
    <?php echo $msg ?>
  </p>
  <a href="?folder=system/state/&file=fmadd_state_city&ext=php">Voltar</a>
</div>
