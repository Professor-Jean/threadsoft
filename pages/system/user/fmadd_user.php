<div id="contentSingleAdd">
  <h1>Registro de Administrador</h1><br>
  <div>
    <form action="?folder=system/user/&file=add_user&ext=php" method="post">
      <input type="text" name="txtusername" maxlength="20" placeholder="Usuário"><br>
      <input type="text" name="txtemail" maxlength="60" placeholder="E-mail"><br>
      <input type="password" name="pwdpassword" maxlength="20" placeholder="Senha"><br>
      <input type="password" name="pwdcpassword" maxlength="20" placeholder="Confirmar Senha"><br>
      <button type="reset" name="btnclean"><i class="fa fa-repeat" aria-hidden="true"></i></button>
      <button type="submit" name="btnsend">Cadastrar</button>
    </form>
  </div>
  <div>
    <table>
      <?php
        $sql_sel_users = "SELECT id, username, email FROM users";
        $sql_sel_users_preparado = $conexaobd->prepare($sql_sel_users);
        $sql_sel_users_preparado->execute();
      ?>
      <thead>
        <tr>
          <th>Nome</th>
          <th>E-mail</th>
          <th>Editar</th>
          <th>Excluir</th>
        </tr>
      </thead>
      <tbody>
        <?php
          if($sql_sel_users_preparado->rowCount()>0){ // Se tiver mais de um usuário...
            while($sql_sel_users_dados = $sql_sel_users_preparado->fetch()){ // Enquanto ainda não tiver chegado no último usuário...
        ?>
        <tr>
          <td><?php echo $sql_sel_users_dados['username']; ?></td>
          <td><?php echo $sql_sel_users_dados['email']; ?></td>
          <td><a href="?folder=system/user/&file=fmalt_user&ext=php&id=<?php echo $sql_sel_users_dados['id'] ?>"><i class="fa fa-pencil-square" aria-hidden="true"></i></a></td>
          <td><a href="?folder=system/user/&file=del_user&ext=php&id=<?php echo $sql_sel_users_dados['id'] ?>"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
        </tr>
        <?php
            }
          }else{ // Se só tiver um usuário...
        ?>
        <tr>
          <td align="center" colspan="4">Não há registros. </td> <!-- Ele avisa que não há registros -->
        </tr>
        <?php
          }
        ?>
      </tbody>
    </table>
  </div>
</div>
