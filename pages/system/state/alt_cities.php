<div id="result">
  <h1>Aviso</h1>
  <?php
    $p_id = $_POST['id'];
    $p_city    = $_POST['txtcity'];
    $p_state = $_POST['selstate'];
    $url         = "?folder=system/state/&file=fmalt_cities&ext=php&id=".$p_id;
    if($p_city == ""){
      $msg = "O campo \"NOME\" não foi preenchido!";
    }else if($p_state == ""){
      $msg = "O campo \"ESTADO\" não foi selecionado!";
    }else{
      $sql_sel_cities = "SELECT * FROM cities WHERE name='".$p_city."' AND id<>'".$p_id."'";
      $sql_sel_cities_preparado = $conexaobd->prepare($sql_sel_cities);
      $sql_sel_cities_preparado->execute();
      if($sql_sel_cities_preparado->rowCount()==0){
      $tabela = "cities";
      $dados = array(
        'name'     => $p_city,
        'states_id' => $p_state
      );
      $condicao = "id=".$p_id;
      $sql_alt_cities_resultado = alterar($tabela, $dados, $condicao);
      if($sql_alt_cities_resultado){
        $msg = "Cidade alterada corretamente!";
        $url = "?folder=system/state/&file=fmadd_state_city&ext=php";
      }else{
        $msg = "Erro ao efetuar alteração de cidade.";
      }
      }else{
        $msg = "Cidade já existe!";
      }
    }
  ?>
  <p>
    <?php echo $msg ?>
  </p>
  <a href="<?php echo $url ?>">Voltar</a>
</div>
