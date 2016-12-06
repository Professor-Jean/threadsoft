<div id="contentHistory">
  <h1>Consulta de Cheques</h1> <br>
  <div class="historyFilters">
    De: <input type="text" name="txtsearch" value="" placeholder="DD/MM/AAAA"><i class="fa fa-calendar" aria-hidden="true"></i>
    Até: <input type="text" name="txtsearch" value="" placeholder="DD/MM/AAAA"><i class="fa fa-calendar" aria-hidden="true"></i>
  </div>
  <h1>Pendentes</h1>
  <div class="historyTable historyChecks">
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
    <table>
      <thead>
        <tr>
          <th>
            Data
          </th>
          <th>
            Vendedor
          </th>
          <th>
            Número do cheque
          </th>
          <th>
            Valor
          </th>
          <th>
            Data a ser descontado
          </th>
          <th>
            Confirmar
          </th>
          <th>
            Falhar
          </th>
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
          <td>R$ <?php echo $sql_sel_checks_dados['value']; ?></td>
          <td><?php echo $sql_sel_checks_dados['date_good_for']; ?></td>
          <td><a href="?folder=system/checks/&file=confirm_checks&ext=php&id=<?php echo $sql_sel_checks_dados['id'] ?>"><i class="fa fa-check" aria-hidden="true"></i></a></td>
          <td><a href="?folder=system/checks/&file=fail_checks&ext=php&id=<?php echo $sql_sel_checks_dados['id'] ?>"><i class="fa fa-times" aria-hidden="true"></i></a></td>
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
  <h1>Confirmados e Falhos</h1>
  <div class="historyTable historyChecks">
    <?php
      $sql_sel_checks = "SELECT
                            checks.id,
                            checks.date_receipt,
                            sellers.name,
                            checks.number,
                            checks.value,
                            checks.status
                         FROM checks
                         INNER JOIN sellers ON checks.sellers_id = sellers.id
                         WHERE status='2' OR status='3'";
      $sql_sel_checks_preparado = $conexaobd->prepare($sql_sel_checks);
      $sql_sel_checks_preparado->execute();
    ?>
    <table>
      <thead>
        <tr>
          <th>
            Data
          </th>
          <th>
            Vendedor
          </th>
          <th>
            Número do cheque
          </th>
          <th>
            Valor
          </th>
          <th>
            Status
          </th>
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
          ?>
          <td><?php echo $sql_sel_checks_dados['date_receipt']; ?></td>
          <td><?php echo $sql_sel_checks_dados['name']; ?></td>
          <td><?php echo $sql_sel_checks_dados['number']; ?></td>
          <td>R$ <?php echo $sql_sel_checks_dados['value']; ?></td>
          <td>
            <?php
              if($sql_sel_checks_dados['status'] == '2'){
                echo "Confirmado";
              }else{
                echo "Falho";
              }
            ?>
          </td>
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
