<div id="contentSingleAdd">
  <?php
    $id = $_GET['id'];
    $sql_sel_manufacturers = "SELECT id, name, phone, email, cnpj FROM manufacturers WHERE id='".$id."'";
    $sql_sel_manufacturers_preparado = $conexaobd->prepare($sql_sel_manufacturers);
    $sql_sel_manufacturers_preparado->execute();
    $sql_sel_manufacturers_dados = $sql_sel_manufacturers_preparado->fetch();
  ?>
  <h1><a href="?folder=system/manufacturer/&file=fmadd_manufacturer&ext=php"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a> Alterar Registro de Fabricante</h1><br>
  <div>
    <form action="?folder=system/manufacturer/&file=alt_manufacturer&ext=php" method="post">
      <input type="hidden" name="id" value="<?php echo $sql_sel_manufacturers_dados['id'] ?>">
      <input type="text" name="txtname" maxlength="45" placeholder="Nome" value="<?php echo $sql_sel_manufacturers_dados['name'] ?>"><br>
      <input type="text" name="txtphone" maxlength="20" placeholder="Telefone" value="<?php echo $sql_sel_manufacturers_dados['phone'] ?>"><br>
      <input type="text" name="txtemail" maxlength="60" placeholder="E-mail" value="<?php echo $sql_sel_manufacturers_dados['email'] ?>"><br>
      <input type="text" name="txtcnpj" maxlength="20" placeholder="CNPJ" value="<?php echo $sql_sel_manufacturers_dados['cnpj'] ?>"><br>
      <button type="reset" name="btnclean"><i class="fa fa-repeat" aria-hidden="true"></i></button>
      <button type="submit" name="btnsend">Alterar</button>
    </form>
  </div>
</div>
