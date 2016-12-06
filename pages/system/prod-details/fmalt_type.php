<div id="contentSingleAdd">
  <?php
    $id = $_GET['id'];
    $sql_sel_types = "SELECT
                        id,
                        category
                       FROM categories
                       WHERE id = '".$id."'";
    $sql_sel_types_preparado = $conexaobd->prepare($sql_sel_types);
    $sql_sel_types_preparado->execute();
    $sql_sel_types_dados = $sql_sel_types_preparado->fetch();
  ?>
  <h1><a href="?folder=system/prod-details/&file=fmadd_prod-details&ext=php"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a> Alterar Registro de Categoria</h1><br>
  <div>
    <form action="?folder=system/prod-details/&file=alt_type&ext=php" method="post">
      <input type="hidden" name="id" value="<?php echo $sql_sel_types_dados['id'] ?>">
      <input type="text" name="txttype" maxlength="60" placeholder="Nome" value="<?php echo $sql_sel_types_dados['category'] ?>"><br>
      <button type="reset" name="btnclean"><i class="fa fa-repeat" aria-hidden="true"></i></button>
      <button type="submit" name="btnsend">Alterar</button>
    </form>
  </div>
</div>
