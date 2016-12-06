<div id="contentSingleAdd">
  <h1>Registro de Vendedor</h1><br>
  <div>
    <form action="?folder=system/seller/&file=add_seller&ext=php" method="post">
      <input type="text" name="txtname" maxlength="45" placeholder="Nome"><br>
      <input type="text" name="txtphone" maxlength="20" placeholder="Telefone"><br>
      <input type="text" name="txtemail" maxlength="60" placeholder="E-mail"><br>
      <input type="text" name="txtbirthdate" maxlength="10" placeholder="Data de Nascimento"><br>
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
        <option value="<?php echo $sql_sel_cities_dados['id'] ?>"><?php echo $sql_sel_cities_dados['name'] ?></option>
        <?php
            }
          }else{ // Se só tiver um usuário...
        ?>
        <tr>
          <option>Não há cidades registradas</option>
        </tr>
        <?php
          }
        ?>
      </select><br><br>
      <button type="reset" name="btnclean"><i class="fa fa-repeat" aria-hidden="true"></i></button>
      <button type="submit" name="btnsend">Cadastrar</button>
    </form>
  </div>
  <div>
    <table>
      <?php
        $sql_sel_sellers = "SELECT
                              sellers.id,
                              sellers.name AS sellers_name,
                              sellers.phone,
                              sellers.email,
                              sellers.birth_date,
                              cities.name AS cities_name
                            FROM sellers INNER JOIN cities ON cities.id = sellers.cities_id";
        $sql_sel_sellers_preparado = $conexaobd->prepare($sql_sel_sellers);
        $sql_sel_sellers_preparado->execute();
      ?>
      <thead>
        <tr>
          <th>Nome</th>
          <th>Telefone</th>
          <th>E-mail</th>
          <th>Data de Nascimento</th>
          <th>Cidade</th>
          <th>Editar</th>
          <th>Excluir</th>
        </tr>
      </thead>
      <tbody>
        <?php
          if($sql_sel_sellers_preparado->rowCount()>0){ // Se tiver mais de um usuário...
            while($sql_sel_sellers_dados = $sql_sel_sellers_preparado->fetch()){ // Enquanto ainda não tiver chegado no último usuário...
        ?>
        <tr>
          <td><?php echo $sql_sel_sellers_dados['sellers_name']; ?></td>
          <td><?php echo $sql_sel_sellers_dados['phone']; ?></td>
          <td><?php echo $sql_sel_sellers_dados['email']; ?></td>
          <?php $sql_sel_sellers_dados['birth_date'] = converterData($sql_sel_sellers_dados['birth_date']) ?>
          <td><?php echo $sql_sel_sellers_dados['birth_date']; ?></td>
          <td><?php echo $sql_sel_sellers_dados['cities_name']; ?></td>
          <td><a href="?folder=system/seller/&file=fmalt_seller&ext=php&id=<?php echo $sql_sel_sellers_dados['id'] ?>"><i class="fa fa-pencil-square" aria-hidden="true"></i></a></td>
          <td><a href="?folder=system/seller/&file=del_seller&ext=php&id=<?php echo $sql_sel_sellers_dados['id'] ?>"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
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
