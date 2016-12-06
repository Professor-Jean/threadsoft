<div id="contentSingleAdd">
  <?php
    $id = $_GET['id'];
    $sql_sel_users = "SELECT id, username, email, password FROM users WHERE id='".$id."'";
    $sql_sel_users_preparado = $conexaobd->prepare($sql_sel_users);
    $sql_sel_users_preparado->execute();
    $sql_sel_users_dados = $sql_sel_users_preparado->fetch();
  ?>
  <h1><a href="?folder=system/user/&file=fmadd_user&ext=php"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a> Alterar Registro de Administrador</h1><br>
  <div>
    <form action="?folder=system/user/&file=alt_user&ext=php" method="post">
      <input type="hidden" name="id" value="<?php echo $sql_sel_users_dados['id'] ?>">
      <input type="text" name="txtusername" placeholder="Usuário" value="<?php echo $sql_sel_users_dados['username'] ?>"><br>
      <input type="text" name="txtemail" placeholder="E-mail" value="<?php echo $sql_sel_users_dados['email'] ?>"><br>
      <input type="password" name="pwdoldpassword" placeholder="Senha Antiga"><br>
      <input type="password" name="pwdpassword" placeholder="Senha Nova"><br>
      <input type="password" name="pwdcpassword" placeholder="Confirmar Senha Nova"><br>
      <button type="reset" name="btnclean"><i class="fa fa-repeat" aria-hidden="true"></i></button>
      <button type="submit" name="btnsend">Alterar</button>
    </form>
  </div>
</div>
