<div id="contentHistory">
  <h1>Histórico de Entrada de Produtos em Estoque</h1> <br>
  <div class="historyFilters filterdisplay">
    <form class="" action="?folder=system/entries/&file=entries_history_by_date&ext=php" method="post">
      <input type="text" name="searchdate" value="" placeholder="Pesquisa por data">
    </form>
  </div>
  <div class="historyTable">
    <?php
        $sql_sel_entries = "SELECT
                              date,
                              hour,
                              id
                             FROM entries
                             ORDER BY date DESC, hour DESC";
        $sql_sel_entries_preparado = $conexaobd->prepare($sql_sel_entries);
        $sql_sel_entries_preparado -> execute();
      ?>
    <table>
      <thead>
        <tr>
          <th>
            Data
          </th>
          <th>
            Horário
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
              <a href="?folder=system/entries/&file=entry_view&ext=php&id=<?php echo $sql_sel_entries_dados['id'] ?>">
                <?php
                  $sql_sel_entries_dados['date'] = converterData($sql_sel_entries_dados['date']);
                  echo $sql_sel_entries_dados['date'];
                ?>
              </a>
            </td>
            <td>
              <?php echo $sql_sel_entries_dados['hour'] ?>
            </td>
          </tr>
          <?php
              }
            }else{ // Se só tiver um usuário...
          ?>
          <tr>
            <td align="center" colspan="2">Não há registros. </td> <!-- Ele avisa que não há registros -->
          </tr>
          <?php
            }
          ?>
      </tbody>
    </table>
  </div>
</div>
