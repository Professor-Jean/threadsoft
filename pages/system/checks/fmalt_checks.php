<div id="contentSingleAdd">
  <?php
    $id = $_GET['id'];
    $sql_sel_checks = "SELECT
                          id,
                          sellers_id,
                          number,
                          value,
                          date_receipt,
                          date_good_for
                        FROM checks
                        WHERE id='".$id."'";
    $sql_sel_checks_preparado = $conexaobd->prepare($sql_sel_checks);
    $sql_sel_checks_preparado->execute();
    $sql_sel_checks_dados = $sql_sel_checks_preparado->fetch();
  ?>
  <h1><a href="?folder=system/checks/&file=fmadd_checks&ext=php"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a> Alterar Registro de Cheque Recebidos</h1><br>
  <div>
    <form action="?folder=system/checks/&file=alt_checks&ext=php" method="post">
      <?php
        $sql_sel_sellers = "SELECT name, id FROM sellers";
        $sql_sel_sellers_preparado = $conexaobd -> prepare($sql_sel_sellers);
        $sql_sel_sellers_preparado -> execute();
      ?>
      <span class="seltitle">Vendedor - </span><select class="frmselect" name="selseller">
        <?php
          if($sql_sel_sellers_preparado->rowCount()>0){ // Se tiver mais de um usuário...
            while($sql_sel_sellers_dados = $sql_sel_sellers_preparado->fetch()){ // Enquanto ainda não tiver chegado no último usuário...
        ?>
        <option
        <?php
          if($sql_sel_sellers_dados['id'] == $sql_sel_checks_dados['sellers_id']){
            echo "selected";
          }
        ?>
        value="<?php echo $sql_sel_sellers_dados['id'] ?>"><?php echo $sql_sel_sellers_dados['name'] ?></option>
        <?php
            }
          }else{ // Se só tiver um usuário...
        ?>
        <tr>
          <option>Não há vendedores registrados</option>
        </tr>
        <?php
          }
        ?>
      </select><br><br>
      <?php
        $sql_sel_checks_dados['date_receipt'] = converterData($sql_sel_checks_dados['date_receipt']);
        $sql_sel_checks_dados['date_good_for'] = converterData($sql_sel_checks_dados['date_good_for']);        
      ?>
      <input type="hidden" name="id" value="<?php echo $sql_sel_checks_dados['id'] ?>">
      <input type="text" name="txtnumber" maxlength="30" placeholder="Número" value="<?php echo $sql_sel_checks_dados['number'] ?>"><br>
      <input type="text" name="txtvalue" placeholder="Valor" value="<?php echo $sql_sel_checks_dados['value'] ?>"><br>
      <input type="text" name="txtdatereceipt" maxlength="10" placeholder="Data de recebimento" value="<?php echo $sql_sel_checks_dados['date_receipt'] ?>"><br>
      <input type="text" name="txtdategoodfor" maxlength="10" placeholder="Data a ser descontado" value="<?php echo $sql_sel_checks_dados['date_good_for'] ?>"><br>
      <button type="reset" name="btnclean"><i class="fa fa-repeat" aria-hidden="true"></i></button>
      <button type="submit" name="btnsend">Alterar</button>
    </form>
  </div>
</div>
