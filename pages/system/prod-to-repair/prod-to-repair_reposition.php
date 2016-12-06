<div id="result">
  <h1>Aviso</h1>
  <?php
    $G_id = $_GET['id'];
    $sql_sel_removals = "SELECT sellers_id
                         FROM removals
                         WHERE id='".$G_id."'";
    $sql_sel_removals_preparado = $conexaobd -> prepare($sql_sel_removals);
    $sql_sel_removals_preparado -> execute();
    $sql_sel_removals_dados = $sql_sel_removals_preparado -> fetch();
    $p_seller = $sql_sel_removals_dados['sellers_id'];
    $p_repasse = $G_id;
    $p_date = date("d/m/Y");
    $p_hour = date("H:i");
    $p_date = converterData($p_date);
    if($p_date == ""){
      $msg = "O campo \"DATA\" não foi preenchido!";
    }else if($p_seller == ""){
      $msg = "O campo \"VENDEDOR\" não foi preenchido!";
    }else if($p_hour == ""){
      $msg = "O campo \"HORÁRIO\" não foi preenchido!";
    }else if(!$p_repasse){
  	  	$msg = "O campo \"REPASSE\" não foi preenchido!";
    		// se nenhuma variável tiver o valor falso, faz o que tem que fazer...
    	  }else{
                $sql_sel_removals = "SELECT removals.sellers_id AS 'sel_id',
                                            removals.date,
                                            removals.hour,
                                            removals.id AS 'r_id',
                                            removals_has_products_has_sizes.products_has_sizes_id AS 'phs_id',
                                            removals_has_products_has_sizes.quantity,
                                            removals_has_products_has_sizes.id AS 'rhphs_id',
                                            products.code,
                                            inventories.id AS 'inv_id'
                                     FROM removals
                                     INNER JOIN removals_has_products_has_sizes
                                     on removals_has_products_has_sizes.removals_id = removals.id
                                     INNER JOIN products_has_sizes
                                     ON removals_has_products_has_sizes.products_has_sizes_id = products_has_sizes.id
                                     INNER JOIN products
                                     ON products_has_sizes.products_id = products.id
                                     INNER JOIN inventories
                                     ON inventories.products_has_sizes_id = products_has_sizes.id
                                     WHERE removals.id = '".$p_repasse."'";
              $sql_sel_removals_preparado = $conexaobd -> prepare($sql_sel_removals);
              $sql_sel_removals_preparado -> execute();
              $sql_sel_removals_dados = $sql_sel_removals_preparado ->fetch();
              $tabela = "entries";
              $dados = array(
                'sellers_id' => $sql_sel_removals_dados['sel_id'],
                'date' => $sql_sel_removals_dados['date'],
                'hour' => $sql_sel_removals_dados['hour'],
                'type' => 'd'
              );
              $sql_add_entries_resultado = adicionar($tabela, $dados);
              if($sql_add_entries_resultado){
                $entries_id = $conexaobd -> lastInsertId();
                $tabela = "entries_has_products_has_sizes";
                $dados = array(
                  'entries_id' => $entries_id,
                  'products_has_sizes_id' => $sql_sel_removals_dados['phs_id'],
                  'quantity' => $sql_sel_removals_dados['quantity']
                );
                $sql_add_entries_has_products_has_sizes_resultado = adicionar($tabela, $dados);
                if($sql_add_entries_has_products_has_sizes_resultado){
                  $tabela = "repairs";
                  $condicao = 'removals_has_products_has_sizes_id= '.$sql_sel_removals_dados['rhphs_id'];
                  $sql_del_repairs = deletar($tabela, $condicao);
                  if($sql_del_repairs){
                    $tabela = "removals_has_products_has_sizes";
                    $condicao = 'id= '.$sql_sel_removals_dados['rhphs_id'];
                    $sql_del_removals_has_products_has_sizes_resultado = deletar($tabela, $condicao);
                    if($sql_del_removals_has_products_has_sizes_resultado){
                      $tabela = 'removals';
                      $condicao = 'id= '.$p_repasse;
                      $sql_del_removals = deletar($tabela, $condicao);
                      if($sql_del_removals){
                        $sql_sel_inventories = "SELECT quantity
                                                FROM inventories
                                                WHERE id ='".$sql_sel_removals_dados['inv_id']."'";
                        $sql_sel_inventories_preparado = $conexaobd -> prepare($sql_sel_inventories);
                        $sql_sel_inventories_preparado -> execute();
                        $sql_sel_inventories_dados = $sql_sel_inventories_preparado -> fetch();
                        $quantity = $sql_sel_inventories_dados['quantity'] + $sql_sel_removals_dados['quantity'];
                        $tabela = "inventories";
                        $dados = array(
                          'products_has_sizes_id' => $sql_sel_removals_dados['phs_id'],
                          'quantity' => $quantity
                        );
                        $condicao = 'id= '.$sql_sel_removals_dados['inv_id'];
                        $sql_add_inventories = alterar($tabela, $dados, $condicao);
                        if($sql_add_inventories){
                          $msg = "Reposição de produtos em estoque cadastrada corretamente!";
                        }else{
                          $msg =  "Erro ao efetuar cadastro de reposição de produtos em estoque. [erro 06]";
                        }
                      }else{
                        $msg =  "Erro ao efetuar cadastro de reposição de produtos em estoque. [erro 04]";
                      }
                    }else{
                      $msg =  "Erro ao efetuar cadastro de reposição de produtos em estoque. [erro 05]";
                    }
                  }else{
                    $msg =  "Erro ao efetuar cadastro de reposição de produtos em estoque. [erro 03]";
                  }
                }else{
                  $msg =  "Erro ao efetuar cadastro de reposição de produtos em estoque. [erro 02]";
                }
              }else{
                $msg =  "Erro ao efetuar cadastro de reposição de produtos em estoque. [erro 01]";
              }
            }




  ?>
  <p>
    <?php echo $msg ?>
  </p>
  <a href="?folder=system/prod-to-repair/&file=prod-to-repair_history&ext=php">Voltar</a>
</div>
