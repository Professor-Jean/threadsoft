<div id="result">
  <h1>Aviso</h1>
  <?php
    $p_name  = $_POST['txtname'];
    $p_phone  = $_POST['txtphone'];
    $p_email     = $_POST["txtemail"];
    $p_cnpj = $_POST['txtcnpj'];
    if($p_name == ""){
      $msg = "O campo \"NOME\" não foi preenchido!";
    }else if($p_phone == ""){
      $msg = "O campo \"TELEFONE\" não foi preenchido!";
    }else if($p_email == ""){
      $msg = "O campo \"E-MAIL\" não foi preenchido!";
    }else if($p_cnpj == ""){
      $msg = "O campo \"CNPJ\" não foi preenchido!";
    }else{
      $sql_sel_manufacturers = "SELECT * FROM manufacturers WHERE name='".$p_name."'";
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
      $sql_add_manufacturers_resultado = adicionar($tabela, $dados);
      if($sql_add_manufacturers_resultado){
        $msg = "Fabricante cadastrado corretamente!";
      }else{
        $msg = "Erro ao efetuar cadastro de Fabricante.";
      }
      }else{
        $msg = "Fabricante já existe!";
      }
      }
  ?>
  <p>
    <?php echo $msg ?>
  </p>
  <a href="?folder=system/manufacturer/&file=fmadd_manufacturer&ext=php">Voltar</a>
</div>
