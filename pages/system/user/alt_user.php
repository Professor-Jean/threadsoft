<div id="result">
  <h1>Aviso</h1>
  <?php
    $p_id        = $_POST['id'];
    $p_username  = $_POST['txtusername'];
    $p_email     = $_POST["txtemail"];
    $p_oldpassword = $_POST['pwdoldpassword'];
    $p_password  = $_POST['pwdpassword'];
    $p_cpassword = $_POST['pwdcpassword'];
    $class       = "error";
    $url         = "?folder=system/user/&file=fmalt_user&ext=php&id=".$p_id;
    $sql_sel_users = "SELECT password FROM users WHERE id='".$p_id."'";
    $sql_sel_users_preparado = $conexaobd->prepare($sql_sel_users);
    $sql_sel_users_preparado->execute();
    $sql_sel_users_dados = $sql_sel_users_preparado -> fetch();
    if($p_username == ""){
      $msg = "O campo \"USUÁRIO\" não foi preenchido!";
    }else if($p_email == ""){
      $msg = "O campo \"E-MAIL\" não foi preenchido!";
    }else if($p_oldpassword != $sql_sel_users_dados['password']){
      $msg = "O campo \"SENHA ANTIGA\" não foi preenchido corretamente!";
    }else if($p_password == ""){
      $msg = "O campo \"SENHA NOVA\" não foi preenchido!";
    }else if($p_cpassword != $p_password){
      $msg = "O campo \"CONFIRMAR SENHA NOVA\" não foi preenchido corretamente!";
    }else{
      $sql_sel_users = "SELECT * FROM users WHERE username='".$p_username."' AND id<>'".$p_id."'";
      $sql_sel_users_preparado = $conexaobd->prepare($sql_sel_users);
      $sql_sel_users_preparado->execute();
      if($sql_sel_users_preparado->rowCount()==0){
      $tabela = "users";
      $dados = array(
        'username' => $p_username,
        'email'    => $p_email,
        'password'  => $p_password
      );
      $condicao = "id=".$p_id;
      $sql_add_users_resultado = alterar($tabela, $dados, $condicao);
      if($sql_add_users_resultado){
        $class    = "success";
        $msg = "Administrador alterado corretamente!";
        $url = "?folder=system/user/&file=fmadd_user&ext=php";
      }else{
        $msg = "Erro ao efetuar alteração de usuário.";
      }
      }else{
        $msg = "Usuário já existe!";
      }
      }
  ?>
  <p class="<?php echo $class ?>">
    <?php echo $msg ?>
  </p>
  <a href="<?php echo $url ?>">Voltar</a>
</div>
