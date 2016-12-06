<script type="text/javascript" src="../js/jquery/Chart.min.js"></script>
<div id="contentHistory">
<h1>Histórico de Brindes</h1> <br>
<div class="historyFilters filterdisplay">
  <form class="" action="#" method="post">
    <input type="text" name="txtsearch" value="" placeholder="Pesquisa por data">
  </form>
  <form action="?folder=system/presents/&file=presents_history_by_seller&ext=php" method="post">
    <input type="text" name="searchseller" value="" placeholder="Pesquisa por vendedor">
  </form>
</div>
<div class="historyTable">
  <table>
    <?php
        $sql_sel_removals = "SELECT
                              removals.date,
                              removals.hour,
                              removals.id,
                              sellers.name
                             FROM removals
                             INNER JOIN sellers
                             ON removals.sellers_id = sellers.id
                             WHERE type='b'
                             ORDER BY removals.date DESC, removals.hour DESC, sellers.name DESC";
        $sql_sel_removals_preparado = $conexaobd->prepare($sql_sel_removals);
        $sql_sel_removals_preparado -> execute();
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
        if($sql_sel_removals_preparado->rowCount()>0){ // Se tiver mais de um usuário...
          while($sql_sel_removals_dados = $sql_sel_removals_preparado->fetch()){ // Enquanto ainda não tiver chegado no último usuário...
      ?>
      <tr>
        <td>
          <a href="?folder=system/presents/&file=presents_view&ext=php&id=<?php echo $sql_sel_removals_dados['id'] ?>">
            <?php
              $sql_sel_removals_dados['date'] = converterData($sql_sel_removals_dados['date']);
              echo $sql_sel_removals_dados['date'];
            ?>
          </a>
        </td>
        <td>
          <?php echo $sql_sel_removals_dados['hour'] ?>
        </td>
        <td>
          <?php echo $sql_sel_removals_dados['name'] ?>
        </td>
        <td>
          <?php echo $sql_sel_removals_dados['id'] ?>
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
<script type="text/javascript" src="../js/graphModal.js"></script>
