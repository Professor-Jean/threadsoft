<div id="contentDoubleAdd">
  <h1>Registro de Estado e Cidade</h1><br>
  <div> <!-- div que contém os formulários de inserção e as tabelas -->
    <div> <!-- div que contém os formulários de inserção -->
      <h2>Registro de Estado</h2>
      <div>
        <form action="?folder=system/state/&file=add_state&ext=php" method="post">
          <input type="text" name="txtstate" maxlength="60" placeholder="Nome"><br>
          <input type="text" name="txtinitials" maxlength="2" placeholder="Sigla"><br>
          <button type="reset" name="btnclean"><i class="fa fa-repeat" aria-hidden="true"></i></button>
          <button type="submit" name="btnsend">Cadastrar</button>
        </form>
      </div>
        <h2>Registro de Cidade</h2>
      <div>
        <form action="?folder=system/state/&file=add_cities&ext=php" method="post">
          <input type="text" name="txtcity" maxlength="60" placeholder="Nome"><br>
          <?php
            $sql_sel_states = "SELECT initials, name,id FROM states";
            $sql_sel_states_preparado = $conexaobd -> prepare($sql_sel_states);
            $sql_sel_states_preparado -> execute();
          ?>
          <span class="seltitle">Estado - </span><select class="frmselect" name="selstate">
            <?php
              if($sql_sel_states_preparado->rowCount()>0){ // Se tiver mais de um usuário...
                while($sql_sel_states_dados = $sql_sel_states_preparado->fetch()){ // Enquanto ainda não tiver chegado no último usuário...
            ?>
            <option value="<?php echo $sql_sel_states_dados['id'] ?>"><?php echo $sql_sel_states_dados['initials'] ?> - <?php echo $sql_sel_states_dados['name'] ?></option>
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
          </select><br>
          <button type="reset" name="btnclean" style="margin-top: 10px;"><i class="fa fa-repeat" aria-hidden="true"></i></button>
          <button type="submit" name="btnsend" style="margin-top: 10px;">Cadastrar</button>
        </form>
      </div>
    </div> <!-- fim da div com os formulários de inserção -->
    <div>
      <div>
        <div class="tableDoubleAdd"><!-- div para a tabela com os tamanhos registrados -->
          <h2>Estado</h2>
          <table>
            <?php
              $sql_sel_states = "SELECT name, initials, id FROM states";
              $sql_sel_states_preparado = $conexaobd->prepare($sql_sel_states);
              $sql_sel_states_preparado->execute();
            ?>
            <thead>
              <tr>
                <th>Sigla</th>
                <th>Nome</th>
                <th>Editar</th>
                <th>Excluir</th>
              </tr>
            </thead>
            <tbody>
              <?php
                if($sql_sel_states_preparado->rowCount()>0){ // Se tiver mais de um usuário...
                  while($sql_sel_states_dados = $sql_sel_states_preparado->fetch()){ // Enquanto ainda não tiver chegado no último usuário...
              ?>
              <tr>
                <td><?php echo $sql_sel_states_dados['initials']; ?></td>
                <td><?php echo $sql_sel_states_dados['name']; ?></td>
                <td><a href="?folder=system/state/&file=fmalt_state&ext=php&id=<?php echo $sql_sel_states_dados['id'] ?>"><i class="fa fa-pencil-square" aria-hidden="true"></i></a></td>
                <td><a href="?folder=system/state/&file=del_state&ext=php&id=<?php echo $sql_sel_states_dados['id'] ?>"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
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
        </div><!-- fim da div para a tabela com os tamanhos registrados -->
        <div class="tableDoubleAdd citytable">
          <h2>Cidade</h2>
          <table>
            <?php
              $sql_sel_cities = "SELECT cities.name, cities.id, states.initials FROM cities INNER JOIN states ON cities.states_id = states.id";
              $sql_sel_cities_preparado = $conexaobd->prepare($sql_sel_cities);
              $sql_sel_cities_preparado->execute();
            ?>
            <thead>
              <tr>
                <th>Estado</th>
                <th>Nome</th>
                <th>Editar</th>
                <th>Excluir</th>
              </tr>
            </thead>
            <tbody>
              <?php
                if($sql_sel_cities_preparado->rowCount()>0){ // Se tiver mais de um usuário...
                  while($sql_sel_cities_dados = $sql_sel_cities_preparado->fetch()){ // Enquanto ainda não tiver chegado no último usuário...
              ?>
              <tr>
                <td><?php echo $sql_sel_cities_dados['initials']; ?></td>
                <td><?php echo $sql_sel_cities_dados['name']; ?></td>
                <td><a href="?folder=system/state/&file=fmalt_cities&ext=php&id=<?php echo $sql_sel_cities_dados['id'] ?>"><i class="fa fa-pencil-square" aria-hidden="true"></i></a></td>
                <td><a href="?folder=system/state/&file=del_cities&ext=php&id=<?php echo $sql_sel_cities_dados['id'] ?>"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
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
    </div>
  </div> <!-- fim da div com os formulários de inserção e as tabelas -->
</div> <!-- fim do content -->
