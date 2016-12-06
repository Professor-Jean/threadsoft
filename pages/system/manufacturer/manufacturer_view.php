<div id="contentHistory">
  <h1>Consulta de Fabricantes</h1> <br>
  <div class="historyFilters filterdisplay">
    <form action="?folder=system/manufacturer/&file=manufacturer_view_by_name&ext=php" method="post">
      <input type="text" name="searchname" value="" placeholder="Pesquisa por nome">
    </form>
    <form action="?folder=system/manufacturer/&file=manufacturer_view_by_phone&ext=php" method="post">
      <input type="text" name="searchphone" value="" placeholder="Pesquisa por telefone">
    </form>
    <form action="?folder=system/manufacturer/&file=manufacturer_view_by_email&ext=php" method="post">
      <input type="text" name="searchemail" value="" placeholder="Pesquisa por e-mail">
    </form>
    <form action="?folder=system/manufacturer/&file=manufacturer_view_by_cnpj&ext=php" method="post">
      <input type="text" name="searchcnpj" value="" placeholder="Pesquisa por CNPJ">
    </form>
  </div>
  <div class="historyTable historyBroken">
    <?php
      $sql_sel_manufacturers = "SELECT id, name, phone, email, cnpj FROM manufacturers";
      $sql_sel_manufacturers_preparado = $conexaobd->prepare($sql_sel_manufacturers);
      $sql_sel_manufacturers_preparado->execute();
    ?>
    <table>
      <thead>
        <tr>
          <th>
            Nome
          </th>
          <th>
            Telefone
          </th>
          <th>
            E-mail
          </th>
          <th>
            CNPJ
          </th>
        </tr>
      </thead>
      <tbody>
        <?php
          if($sql_sel_manufacturers_preparado->rowCount()>0){ // Se tiver mais de um usuário...
            while($sql_sel_manufacturers_dados = $sql_sel_manufacturers_preparado->fetch()){ // Enquanto ainda não tiver chegado no último usuário...
        ?>
        <tr>
          <td><?php echo $sql_sel_manufacturers_dados['name']; ?></td>
          <td><?php echo $sql_sel_manufacturers_dados['phone']; ?></td>
          <td><?php echo $sql_sel_manufacturers_dados['email']; ?></td>
          <td><?php echo $sql_sel_manufacturers_dados['cnpj']; ?></td>
        </tr>
        <?php
            }
          }else{ // Se só tiver um usuário...
        ?>
        <tr>
          <td align="center" colspan="6">Não há registros. </td> <!-- Ele avisa que não há registros -->
        </tr>
        <?php
          }
        ?>
      </tbody>
    </table>
  </div>
</div>
