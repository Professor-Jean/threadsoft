<div id="result">
  <h1>Aviso</h1>
  <?php
    $p_id        = $_POST['id'];
    $p_name  = $_POST['txtname'];
    $p_phone  = $_POST['txtphone'];
    $p_email = $_POST["txtemail"];
    $p_birthdate = converterData($_POST['txtbirthdate']);
    $p_city = $_POST['selcity'];
    $url         = "?folder=system/seller/&file=fmalt_seller&ext=php&id=".$p_id;
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
      $sql_sel_sellers = "SELECT * FROM sellers WHERE name='".$p_name."' AND id<>'".$p_id."'";
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
      $condicao = "id=".$p_id;
      $sql_add_sellers_resultado = alterar($tabela, $dados, $condicao);
      if($sql_add_sellers_resultado){
        $msg = "Vendedor alterado corretamente!";
        $url = "?folder=system/seller/&file=fmadd_seller&ext=php";
      }else{
        $msg = "Erro ao efetuar alteração de vendedor.";
      }
      }else{
        $msg = "Vendedor já existe!";
      }
      }
  ?>
  <p>
    <?php echo $msg ?>
  </p>
  <a href="<?php echo $url ?>">Voltar</a>
</div>
