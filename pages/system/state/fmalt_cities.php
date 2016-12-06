<div id="contentSingleAdd">
  <?php
    $id = $_GET['id'];
    $sql_sel_cities = "SELECT
                        id,
                        name,
                        states_id
                       FROM cities
                       WHERE id = '".$id."'";
    $sql_sel_cities_preparado = $conexaobd->prepare($sql_sel_cities);
    $sql_sel_cities_preparado->execute();
    $sql_sel_cities_dados = $sql_sel_cities_preparado->fetch();
  ?>
  <h1><a href="?folder=system/state/&file=fmadd_state_city&ext=php"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a> Alterar Registro de Cidade</h1><br>
  <div>
    <form action="?folder=system/state/&file=alt_cities&ext=php" method="post">
      <input type="hidden" name="id" value="<?php echo $sql_sel_cities_dados['id'] ?>">
      <input type="text" name="txtcity" maxlength="60" placeholder="Nome" value="<?php echo $sql_sel_cities_dados['name'] ?>"><br>
      <?php
        $sql_sel_states = "SELECT initials, name, id FROM states";
        $sql_sel_states_preparado = $conexaobd -> prepare($sql_sel_states);
        $sql_sel_states_preparado -> execute();
      ?>
      <span class="seltitle">Estado - </span> <select class="frmselect frmaltselect" name="selstate">
        <?php
          if($sql_sel_states_preparado->rowCount()>0){ // Se tiver mais de um usuário...
            while($sql_sel_states_dados = $sql_sel_states_preparado->fetch()){ // Enquanto ainda não tiver chegado no último usuário...
        ?>
        <option
        <?php
          if ($sql_sel_states_dados['id'] == $sql_sel_cities_dados['states_id']) {
            echo "selected";
          }
        ?>
        value="<?php echo $sql_sel_states_dados['id'] ?>"><?php echo $sql_sel_states_dados['initials'] ?> - <?php echo $sql_sel_states_dados['name'] ?></option>
        <?php
            }
          }else{ // Se só tiver um usuário...
        ?>
        <tr>
          <option>Não há estados registrados</option>
        </tr>
        <?php
          }
        ?>
      </select><br><br>
      <button type="reset" name="btnclean"><i class="fa fa-repeat" aria-hidden="true"></i></button>
      <button type="submit" name="btnsend">Alterar</button>
    </form>
  </div>
</div>
