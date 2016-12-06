<div id="contentSingleAdd">
  <?php
    $id = $_GET['id'];
    $sql_sel_sellers = "SELECT id, name, phone, email, birth_date, cities_id FROM sellers WHERE id='".$id."'";
    $sql_sel_sellers_preparado = $conexaobd->prepare($sql_sel_sellers);
    $sql_sel_sellers_preparado->execute();
    $sql_sel_sellers_dados = $sql_sel_sellers_preparado->fetch();
  ?>
  <h1><a href="?folder=system/seller/&file=fmadd_seller&ext=php"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a> Alterar Registro de Vendedor</h1><br>
  <div>
    <form action="?folder=system/seller/&file=alt_seller&ext=php" method="post">
      <input type="hidden" name="id" value="<?php echo $sql_sel_sellers_dados['id'] ?>">
      <input type="text" name="txtname" maxlength="45" placeholder="Nome" value="<?php echo $sql_sel_sellers_dados['name'] ?>"><br>
      <input type="text" name="txtphone" maxlength="20" placeholder="Telefone" value="<?php echo $sql_sel_sellers_dados['phone'] ?>"><br>
      <input type="text" name="txtemail" maxlength="60" placeholder="E-mail" value="<?php echo $sql_sel_sellers_dados['email'] ?>"><br>
      <?php
        $sql_sel_sellers_dados['birth_date'] = converterData($sql_sel_sellers_dados['birth_date']);
      ?>
      <input type="text" name="txtbirthdate" maxlength="20" placeholder="Data de Nascimento" value="<?php echo $sql_sel_sellers_dados['birth_date'] ?>"><br>
      <?php
        $sql_sel_cities = "SELECT name,id FROM cities";
        $sql_sel_cities_preparado = $conexaobd -> prepare($sql_sel_cities);
        $sql_sel_cities_preparado -> execute();
      ?>
      <span class="seltitle">Cidade - </span><select class="frmselect" name="selcity">
        <?php
          if($sql_sel_cities_preparado->rowCount()>0){ // Se tiver mais de um usuário...
            while($sql_sel_cities_dados = $sql_sel_cities_preparado->fetch()){ // Enquanto ainda não tiver chegado no último usuário...
        ?>
        <option
        <?php
          if ($sql_sel_cities_dados['id'] == $sql_sel_sellers_dados['cities_id']) {
            echo "selected";
          }
        ?>
        value="<?php echo $sql_sel_cities_dados['id'] ?>"><?php echo $sql_sel_cities_dados['name'] ?></option>
        <?php
            }
          }else{ // Se só tiver um usuário...
        ?>
        <tr>
          <option>Não há cidades registrados</option>
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
