<div id="result">
  <h1>Aviso</h1>
  <?php
    $p_name  = $_POST['txtname'];
    $p_phone  = $_POST['txtphone'];
    $p_email = $_POST["txtemail"];
    $p_birthdate = converterData($_POST['txtbirthdate']);
    $p_city = $_POST['selcity'];
    if($p_name == ""){
      $msg = "O campo \"NOME\" não foi preenchido!";
    }else if($p_phone == ""){
      $msg = "O campo \"TELEFONE\" não foi preenchido!";
    }else if($p_email == ""){
      $msg = "O campo \"E-MAIL\" não foi preenchido!";
    }else if($p_birthdate == ""){
      $msg = "O campo \"DATA DE NASCIMENTO\" não foi preenchido!";
    }else if($p_city == ""){
      $msg = "O campo \"CIDADE\" não foi selecionado!";
    }else{
      $sql_sel_sellers = "SELECT * FROM sellers WHERE name='".$p_name."'";
      $sql_sel_sellers_preparado = $conexaobd->prepare($sql_sel_sellers);
      $sql_sel_sellers_preparado->execute();
      if($sql_sel_sellers_preparado->rowCount()==0){
      $tabela = "sellers";
      $dados = array(
        'name' => $p_name,
        'phone'    => $p_phone,
        'email'    => $p_email,
        'birth_date'    => $p_birthdate,
        'cities_id' => $p_city
      );
      $sql_add_sellers_resultado = adicionar($tabela, $dados);
      if($sql_add_sellers_resultado){
        $msg = "Vendedor cadastrado corretamente!";
      }else{
        $msg = "Erro ao efetuar cadastro de vendedor.";
      }
      }else{
        $msg = "Vendedor já existe!";
      }
      }
  ?>
  <p>
    <?php echo $msg ?>
  </p>
  <a href="?folder=system/seller/&file=fmadd_seller&ext=php">Voltar</a>
</div>
