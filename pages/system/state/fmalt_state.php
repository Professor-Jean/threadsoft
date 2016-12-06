<div id="contentSingleAdd">
  <?php
    $id = $_GET['id'];
    $sql_sel_states = "SELECT id, name, initials FROM states WHERE id='".$id."'";
    $sql_sel_states_preparado = $conexaobd->prepare($sql_sel_states);
    $sql_sel_states_preparado->execute();
    $sql_sel_states_dados = $sql_sel_states_preparado->fetch();
  ?>
  <h1><a href="?folder=system/state/&file=fmadd_state_city&ext=php"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a> Alterar Registro de Estado</h1><br>
  <div>
    <form action="?folder=system/state/&file=alt_state&ext=php" method="post">
      <input type="hidden" name="id" value="<?php echo $sql_sel_states_dados['id'] ?>">
      <input type="text" name="txtstate" maxlength="60" placeholder="Nome" value="<?php echo $sql_sel_states_dados['name'] ?>"><br>
      <input type="text" name="txtinitials" maxlength="2" placeholder="Sigla" value="<?php echo $sql_sel_states_dados['initials'] ?>"><br>
      <button type="reset" name="btnclean"><i class="fa fa-repeat" aria-hidden="true"></i></button>
      <button type="submit" name="btnsend">Alterar</button>
    </form>
  </div>
</div>
