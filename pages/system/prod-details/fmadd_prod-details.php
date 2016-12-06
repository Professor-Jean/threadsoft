<div id="contentDoubleAdd">
  <h1>Registro de Detalhes de Produto</h1><br>
  <div> <!-- div que contém os formulários de inserção e as tabelas -->
    <div> <!-- div que contém os formulários de inserção -->
      <h2>Registro de Tamanho</h2>
      <div>
        <form action="?folder=system/prod-details/&file=add_size&ext=php" method="post">
          <input type="text" name="txtsize" placeholder="Nome"><br>
          <button type="reset" name="btnclean"><i class="fa fa-repeat" aria-hidden="true"></i></button>
          <button type="submit" name="btnsend">Cadastrar</button>
        </form>
      </div>
        <h2>Registro de Categoria</h2>
      <div>
        <form action="?folder=system/prod-details/&file=add_type&ext=php" method="post">
          <input type="text" name="txttype" placeholder="Nome"><br>
          <button type="reset" name="btnclean"><i class="fa fa-repeat" aria-hidden="true"></i></button>
          <button type="submit" name="btnsend">Cadastrar</button>
        </form>
      </div>
    </div> <!-- fim da div com os formulários de inserção -->
    <div>
      <div>
        <div class="tableDoubleAdd"><!-- div para a tabela com os tamanhos registrados -->
          <h2>Tamanho</h2>
          <table>
            <?php
              $sql_sel_sizes = "SELECT size, id FROM sizes";
              $sql_sel_sizes_preparado = $conexaobd->prepare($sql_sel_sizes);
              $sql_sel_sizes_preparado->execute();
            ?>
            <thead>
              <tr>
                <th>Nome</th>
                <th>Editar</th>
                <th>Excluir</th>
              </tr>
            </thead>
            <tbody>
              <?php
                if($sql_sel_sizes_preparado->rowCount()>0){ // Se tiver mais de um usuário...
                  while($sql_sel_sizes_dados = $sql_sel_sizes_preparado->fetch()){ // Enquanto ainda não tiver chegado no último usuário...
              ?>
              <tr>
                <td><?php echo $sql_sel_sizes_dados['size']; ?></td>
                <td><a href="?folder=system/prod-details/&file=fmalt_size&ext=php&id=<?php echo $sql_sel_sizes_dados['id'] ?>"><i class="fa fa-pencil-square" aria-hidden="true"></i></a></td>
                <td><a href="?folder=system/prod-details/&file=del_size&ext=php&id=<?php echo $sql_sel_sizes_dados['id'] ?>"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
              </tr>
              <?php
                  }
                }else{ // Se só tiver um usuário...
              ?>
              <tr>
                <td align="center" colspan="3">Não há registros. </td> <!-- Ele avisa que não há registros -->
              </tr>
              <?php
                }
              ?>
            </tbody>
          </table>
        </div><!-- fim da div para a tabela com os tamanhos registrados -->
        <div class="tableDoubleAdd">
        <h2>Categoria</h2>
          <table>
            <?php
              $sql_sel_types = "SELECT category, id FROM categories";
              $sql_sel_types_preparado = $conexaobd->prepare($sql_sel_types);
              $sql_sel_types_preparado->execute();
            ?>
            <thead>
              <tr>
                <th>Nome</th>
                <th>Editar</th>
                <th>Excluir</th>
              </tr>
            </thead>
            <tbody>
              <?php
                if($sql_sel_types_preparado->rowCount()>0){ // Se tiver mais de um usuário...
                  while($sql_sel_types_dados = $sql_sel_types_preparado->fetch()){ // Enquanto ainda não tiver chegado no último usuário...
              ?>
              <tr>
                <td><?php echo $sql_sel_types_dados['category']; ?></td>
                <td><a href="?folder=system/prod-details/&file=fmalt_type&ext=php&id=<?php echo $sql_sel_types_dados['id'] ?>"><i class="fa fa-pencil-square" aria-hidden="true"></i></a></td>
                <td><a href="?folder=system/prod-details/&file=del_type&ext=php&id=<?php echo $sql_sel_types_dados['id'] ?>"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
              </tr>
              <?php
                  }
                }else{ // Se só tiver um usuário...
              ?>
              <tr>
                <td align="center" colspan="3">Não há registros. </td> <!-- Ele avisa que não há registros -->
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
