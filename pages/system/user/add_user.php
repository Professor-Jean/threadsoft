<div id="result">
  <h1>Aviso</h1>
  <?php
    $p_username  = $_POST['txtusername'];
    $p_email     = $_POST["txtemail"];
    $p_password  = $_POST['pwdpassword'];
    $p_cpassword = $_POST['pwdcpassword'];
    if($p_username == ""){
      $msg = "O campo \"USUÁRIO\" não foi preenchido!";
    }else if($p_email == ""){
      $msg = "O campo \"E-MAIL\" não foi preenchido!";
    }else if($p_password == ""){
      $msg = "O campo \"SENHA\" não foi preenchido!";
    }else if($p_cpassword != $p_password){
      $msg = "O campo \"CONFIRMAR SENHA\" não foi preenchido corretamente!";
    }else{
      $sql_sel_users = "SELECT * FROM users WHERE username='".$p_username."'";
      $sql_sel_users_preparado = $conexaobd->prepare($sql_sel_users);
      $sql_sel_users_preparado->execute();
      if($sql_sel_users_preparado->rowCount()==0){
      $tabela = "users";
      $dados = array(
        'username' => $p_username,
        'email'    => $p_email,
        'password'  => $p_password
      );
      $sql_add_users_resultado = adicionar($tabela, $dados);
      if($sql_add_users_resultado){
        $msg = "Administrador cadastrado corretamente!";
      }else{
        $msg = "Erro ao efetuar cadastro de administrador.";
      }
      }else{
        $msg = "Usuário já existe!";
      }
      }
  ?>
  <p>
    <?php echo $msg ?>
  </p>
  <a href="?folder=system/user/&file=fmadd_user&ext=php">Voltar</a>
</div>
