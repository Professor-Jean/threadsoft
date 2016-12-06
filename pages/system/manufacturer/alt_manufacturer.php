<div id="result">
  <h1>Aviso</h1>
  <?php
    $p_id        = $_POST['id'];
    $p_name  = $_POST['txtname'];
    $p_phone  = $_POST['txtphone'];
    $p_email     = $_POST["txtemail"];
    $p_cnpj = $_POST['txtcnpj'];
    $url         = "?folder=system/manufacturer/&file=fmalt_manufacturer&ext=php&id=".$p_id;
    if($p_name == ""){
      $msg = "O campo \"NOME\" não foi preenchido!";
    }else if($p_phone == ""){
      $msg = "O campo \"TELEFONE\" não foi preenchido!";
    }else if($p_email == ""){
      $msg = "O campo \"E-MAIL\" não foi preenchido!";
    }else if($p_cnpj == ""){
      $msg = "O campo \"CNPJ\" não foi preenchido!";
    }else{
      $sql_sel_manufacturers = "SELECT * FROM manufacturers WHERE name='".$p_name."' AND id<>'".$p_id."'";
      $sql_sel_manufacturers_preparado = $conexaobd->prepare($sql_sel_manufacturers);
      $sql_sel_manufacturers_preparado->execute();
      if($sql_sel_manufacturers_preparado->rowCount()==0){
      $tabela = "manufacturers";
      $dados = array(
        'name' => $p_name,
        'phone'    => $p_phone,
        'email'    => $p_email,
        'cnpj'    => $p_cnpj
      );
      $condicao = "id=".$p_id;
      $sql_add_manufacturers_resultado = alterar($tabela, $dados, $condicao);
      if($sql_add_manufacturers_resultado){
        $msg = "Fabricante alterado corretamente!";
        $url = "?folder=system/manufacturer/&file=fmadd_manufacturer&ext=php";
      }else{
        $msg = "Erro ao efetuar alteração de Fabricante.";
      }
      }else{
        $msg = "Fabricante já existe!";
      }
      }
  ?>
  <p>
    <?php echo $msg ?>
  </p>
  <a href="<?php echo $url ?>">Voltar</a>
</div>
