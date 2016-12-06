<div id="result">
  <h1>Aviso</h1>
  <?php
    $p_id      = $_POST['id'];
    $p_seller  = $_POST['selseller'];
    $p_number  = $_POST['txtnumber'];
    $p_value = $_POST["txtvalue"];
    $p_datereceipt = converterData($_POST['txtdatereceipt']);
    $p_dategoodfor = converterData($_POST['txtdategoodfor']);
    $url         = "?folder=system/checks/&file=fmalt_checks&ext=php&id=".$p_id;
    if($p_seller == ""){
      $msg = "O campo \"VENDEDOR\" não foi selecionado!";
    }else if($p_number == ""){
      $msg = "O campo \"NÚMERO\" não foi preenchido!";
    }else if($p_value == ""){
      $msg = "O campo \"VALOR\" não foi preenchido!";
    }else if($p_datereceipt == ""){
      $msg = "O campo \"DATA DE RECEBIMENTO\" não foi preenchido!";
    }else if($p_dategoodfor == ""){
      $msg = "O campo \"DATA DE DESCONTO\" não foi selecionado!";
    }else{
      $sql_sel_checks = "SELECT * FROM checks WHERE number='".$p_number."' AND id<>'".$p_id."'";
      $sql_sel_checks_preparado = $conexaobd->prepare($sql_sel_checks);
      $sql_sel_checks_preparado->execute();
      if($sql_sel_checks_preparado->rowCount()==0){
      $tabela = "checks";
      $dados = array(
        'sellers_id' => $p_seller,
        'number'    => $p_number,
        'value'    => $p_value,
        'date_receipt'    => $p_datereceipt,
        'status' => '1',
        'date_good_for' => $p_dategoodfor
      );
      $condicao = "id=".$p_id;
      $sql_add_checks_resultado = alterar($tabela, $dados, $condicao);
      if($sql_add_checks_resultado){
        $msg = "Cheque alterado corretamente!";
        $url = "?folder=system/checks/&file=fmadd_checks&ext=php";
      }else{
        $msg = "Erro ao efetuar alteração de cheque.";
      }
      }else{
        $msg = "Cheque já existe!";
      }
      }
  ?>
  <p>
    <?php echo $msg ?>
  </p>
  <a href="<?php echo $url ?>">Voltar</a>
</div>
