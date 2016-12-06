<div id="contentSingleAdd">
  <?php
    $id = $_GET['id'];
    $sql_sel_sizes = "SELECT
                        id,
                        size
                       FROM sizes
                       WHERE id = '".$id."'";
    $sql_sel_sizes_preparado = $conexaobd->prepare($sql_sel_sizes);
    $sql_sel_sizes_preparado->execute();
    $sql_sel_sizes_dados = $sql_sel_sizes_preparado->fetch();
  ?>
  <h1><a href="?folder=system/prod-details/&file=fmadd_prod-details&ext=php"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a> Alterar Registro de Tamanho</h1><br>
  <div>
    <form action="?folder=system/prod-details/&file=alt_size&ext=php" method="post">
      <input type="hidden" name="id" value="<?php echo $sql_sel_sizes_dados['id'] ?>">
      <input type="text" name="txtsize" maxlength="60" placeholder="Nome" value="<?php echo $sql_sel_sizes_dados['size'] ?>"><br>
      <button type="reset" name="btnclean"><i class="fa fa-repeat" aria-hidden="true"></i></button>
      <button type="submit" name="btnsend">Alterar</button>
    </form>
  </div>
</div>
