<div id="contentSingleAdd">
  <h1>Registro de Cheque Recebido</h1><br>
  <div>
    <form action="?folder=system/checks/&file=add_checks&ext=php" method="post">
      <?php
        $sql_sel_checks = "SELECT name, id FROM sellers";
        $sql_sel_checks_preparado = $conexaobd -> prepare($sql_sel_checks);
        $sql_sel_checks_preparado -> execute();
      ?>
      <span class="seltitle">Vendedor - </span><select class="frmselect" name="selseller">
        <?php
          if($sql_sel_checks_preparado->rowCount()>0){ // Se tiver mais de um usuário...
            while($sql_sel_checks_dados = $sql_sel_checks_preparado->fetch()){ // Enquanto ainda não tiver chegado no último usuário...
        ?>
        <option value="<?php echo $sql_sel_checks_dados['id'] ?>"><?php echo $sql_sel_checks_dados['name'] ?></option>
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
      <input type="text" name="txtnumber" maxlength="30" placeholder="Número"><br>
      <input type="text" name="txtvalue" placeholder="Valor"><br>
      <input type="text" name="txtdatereceipt" maxlength="10" placeholder="Data de recebimento"><br>
      <input type="text" name="txtdategoodfor" maxlength="10" placeholder="Data a ser descontado"><br>
      <button type="reset" name="btnclean"><i class="fa fa-repeat" aria-hidden="true"></i></button>
      <button type="submit" name="btnsend">Cadastrar</button>
    </form>
  </div>
  <div>
    <table>
      <?php
        $sql_sel_checks = "SELECT
                              checks.id,
                              checks.date_receipt,
                              sellers.name,
                              checks.number,
                              checks.date_good_for,
                              checks.value
                            FROM checks
                            INNER JOIN sellers ON checks.sellers_id = sellers.id
                            WHERE status='1'";
        $sql_sel_checks_preparado = $conexaobd->prepare($sql_sel_checks);
        $sql_sel_checks_preparado->execute();
      ?>
      <thead>
        <tr>
          <th>Data de recebimento</th>
          <th>Vendedor</th>
          <th>Número</th>
          <th>Data de desconto</th>
          <th>Valor</th>
          <th>Editar</th>
          <th>Excluir</th>
        </tr>
      </thead>
      <tbody>
        <?php
          if($sql_sel_checks_preparado->rowCount()>0){ // Se tiver mais de um usuário...
            while($sql_sel_checks_dados = $sql_sel_checks_preparado->fetch()){ // Enquanto ainda não tiver chegado no último usuário...
        ?>
        <tr>
          <?php
            $sql_sel_checks_dados['date_receipt'] = converterData($sql_sel_checks_dados['date_receipt']);
            $sql_sel_checks_dados['date_good_for'] = converterData($sql_sel_checks_dados['date_good_for']);
          ?>
          <td><?php echo $sql_sel_checks_dados['date_receipt']; ?></td>
          <td><?php echo $sql_sel_checks_dados['name']; ?></td>
          <td><?php echo $sql_sel_checks_dados['number']; ?></td>
          <td><?php echo $sql_sel_checks_dados['date_good_for']; ?></td>
          <td>R$ <?php echo $sql_sel_checks_dados['value']; ?></td>
          <td><a href="?folder=system/checks/&file=fmalt_checks&ext=php&id=<?php echo $sql_sel_checks_dados['id'] ?>"><i class="fa fa-pencil-square" aria-hidden="true"></i></a></td>
          <td><a href="?folder=system/checks/&file=del_checks&ext=php&id=<?php echo $sql_sel_checks_dados['id'] ?>"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
        </tr>
        <?php
            }
          }else{ // Se só tiver um usuário...
        ?>
        <tr>
          <td align="center" colspan="7">Não há registros. </td> <!-- Ele avisa que não há registros -->
        </tr>
        <?php
          }
        ?>
      </tbody>
    </table>
  </div>
</div>
