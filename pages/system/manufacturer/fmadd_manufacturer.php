<div id="contentSingleAdd">
  <h1>Registro de Fabricante</h1><br>
  <div>
    <form action="?folder=system/manufacturer/&file=add_manufacturer&ext=php" method="post">
      <input type="text" name="txtname" maxlength="45" placeholder="Nome"><br>
      <input type="text" name="txtphone" maxlength="20" placeholder="Telefone"><br>
      <input type="text" name="txtemail" maxlength="60" placeholder="E-mail"><br>
      <input type="text" name="txtcnpj" maxlength="20" placeholder="CNPJ"><br>
      <button type="reset" name="btnclean"><i class="fa fa-repeat" aria-hidden="true"></i></button>
      <button type="submit" name="btnsend">Cadastrar</button>
    </form>
  </div>
  <div>
    <table>
      <?php
        $sql_sel_manufacturers = "SELECT id, name, phone, email, cnpj FROM manufacturers";
        $sql_sel_manufacturers_preparado = $conexaobd->prepare($sql_sel_manufacturers);
        $sql_sel_manufacturers_preparado->execute();
      ?>
      <thead>
        <tr>
          <th>Nome</th>
          <th>Telefone</th>
          <th>E-mail</th>
          <th>CNPJ</th>
          <th>Editar</th>
          <th>Excluir</th>
        </tr>
      </thead>
      <tbody>
        <?php
          if($sql_sel_manufacturers_preparado->rowCount()>0){ // Se tiver mais de um usuário...
            while($sql_sel_manufacturers_dados = $sql_sel_manufacturers_preparado->fetch()){ // Enquanto ainda não tiver chegado no último usuário...
        ?>
        <tr>
          <td><?php echo $sql_sel_manufacturers_dados['name']; ?></td>
          <td><?php echo $sql_sel_manufacturers_dados['phone']; ?></td>
          <td><?php echo $sql_sel_manufacturers_dados['email']; ?></td>
          <td><?php echo $sql_sel_manufacturers_dados['cnpj']; ?></td>
          <td><a href="?folder=system/manufacturer/&file=fmalt_manufacturer&ext=php&id=<?php echo $sql_sel_manufacturers_dados['id'] ?>"><i class="fa fa-pencil-square" aria-hidden="true"></i></a></td>
          <td><a href="?folder=system/manufacturer/&file=del_manufacturer&ext=php&id=<?php echo $sql_sel_manufacturers_dados['id'] ?>"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
        </tr>
        <?php
            }
          }else{ // Se só tiver um usuário...
        ?>
        <tr>
          <td align="center" colspan="6">Não há registros. </td> <!-- Ele avisa que não há registros -->
        </tr>
        <?php
          }
        ?>
      </tbody>
    </table>
  </div>
</div>
