<script type="text/javascript" src="../js/jquery/Chart.min.js"></script>
<div id="contentHistory">
<h1>Consulta de Devoluções</h1> <br>
<div class="historyFilters">
  <input type="text" name="txtsearch" value="" placeholder="Pesquisa por data">
  <a href="?folder=system/graphs/&file=devolutions_by_sellers&ext=php"><button type="button" name="btngraph"><i class="fa fa-pie-chart" aria-hidden="true"></i>  Gráfico de Devoluções</button></a>
</div>
<div class="historyTable">
  <table>
    <?php
        $sql_sel_entries = "SELECT
                              entries.date,
                              entries.hour,
                              entries.id,
                              sellers.name
                             FROM entries
                             INNER JOIN sellers
                             ON entries.sellers_id = sellers.id
                             WHERE type='d'
                             ORDER BY date DESC, hour DESC";
        $sql_sel_entries_preparado = $conexaobd->prepare($sql_sel_entries);
        $sql_sel_entries_preparado -> execute();
      ?>
    <thead>
      <tr>
        <th>
          Data
        </th>
        <th>
          Horário
        </th>
        <th>
          Vendedor
        </th>
        <th>
          Código
        </th>
      </tr>
    </thead>
    <tbody>
      <?php
        if($sql_sel_entries_preparado->rowCount()>0){ // Se tiver mais de um usuário...
          while($sql_sel_entries_dados = $sql_sel_entries_preparado->fetch()){ // Enquanto ainda não tiver chegado no último usuário...
      ?>
      <tr>
        <td>
          <a href="?folder=system/devolutions/&file=devolutions_view&ext=php&id=<?php echo $sql_sel_entries_dados['id'] ?>">
            <?php
              $sql_sel_entries_dados['date'] = converterData($sql_sel_entries_dados['date']);
              echo $sql_sel_entries_dados['date'];
            ?>
          </a>
        </td>
        <td>
          <?php echo $sql_sel_entries_dados['hour'] ?>
        </td>
        <td>
          <?php
            echo $sql_sel_entries_dados['name'];
          ?>
        </td>
        <td>
          <?php echo $sql_sel_entries_dados['id'] ?>
        </td>
      </tr>
      <?php
          }
        }else{ // Se só tiver um usuário...
      ?>
      <tr>
        <td align="center" colspan="4">Não há registros. </td> <!-- Ele avisa que não há registros -->
      </tr>
      <?php
        }
      ?>
    </tbody>
  </table>
</div>
</div>
