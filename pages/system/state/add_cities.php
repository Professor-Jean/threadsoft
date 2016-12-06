<div id="result">
  <h1>Aviso</h1>
  <?php
    $p_city    = $_POST['txtcity'];
    $p_state = $_POST['selstate'];
    if($p_city == ""){
      $msg = "O campo \"NOME\" não foi preenchido!";
    }else if($p_state == ""){
      $msg = "O campo \"ESTADO\" não foi selecionado!";
    }else{
      $sql_sel_cities = "SELECT * FROM cities WHERE name='".$p_city."'";
      $sql_sel_cities_preparado = $conexaobd->prepare($sql_sel_cities);
      $sql_sel_cities_preparado->execute();
      if($sql_sel_cities_preparado->rowCount()==0){
      $tabela = "cities";
      $dados = array(
        'name'     => $p_city,
        'states_id' => $p_state
      );
      $sql_add_states_resultado = adicionar($tabela, $dados);
      if($sql_add_states_resultado){
        $msg = "Cidade cadastrada corretamente!";
      }else{
        $msg = "Erro ao efetuar cadastro de cidade.";
      }
      }else{
        $msg = "Cidade já existe!";
      }
    }
  ?>
  <p>
    <?php echo $msg ?>
  </p>
  <a href="?folder=system/state/&file=fmadd_state_city&ext=php">Voltar</a>
</div>
