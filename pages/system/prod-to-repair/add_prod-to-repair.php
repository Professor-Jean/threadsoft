<div id="result">
  <h1>Aviso</h1>
  <?php
    $p_seller = $_POST['selseller'];
    $p_UCD = $_POST['useCurrentDate'];
    $p_repasse = $_POST['selrepasse'];
    if($p_UCD){
      $p_date = date("d/m/Y");
      $p_hour = date("H:i");
    }else{
      $p_date = $_POST['txtdate'];
      $p_hour = $_POST['txthour'];
    }
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
                                            removals_has_products_has_sizes.products_has_sizes_id,
                                            removals_has_products_has_sizes.quantity,
                                            removals_has_products_has_sizes.id AS 'phs_id',
                                            products.code
                                     FROM removals
                                     INNER JOIN removals_has_products_has_sizes
                                     on removals_has_products_has_sizes.removals_id = removals.id
                                     INNER JOIN products_has_sizes
                                     ON removals_has_products_has_sizes.products_has_sizes_id = products_has_sizes.id
                                     INNER JOIN products
                                     ON products_has_sizes.products_id = products.id
                                     WHERE removals.id = '".$p_repasse."'";
              $sql_sel_removals_preparado = $conexaobd -> prepare($sql_sel_removals);
              $sql_sel_removals_preparado -> execute();
              $sql_sel_removals_dados = $sql_sel_removals_preparado ->fetch();

              $sql_sel_inventory = "SELECT inventories.quantity,
                                          inventories.id AS inventories_id,
                                          products_has_sizes.id AS phs_id
                                   FROM inventories
                                   INNER JOIN products_has_sizes
                                   ON inventories.products_has_sizes_id = products_has_sizes.id
                                   INNER JOIN products on products_has_sizes.products_id = products.id
                                   WHERE products.code = '".$sql_sel_removals_dados['code']."'";
              $sql_sel_inventory_preparado = $conexaobd -> prepare($sql_sel_inventory);
              $sql_sel_inventory_preparado -> execute();
              $sql_sel_inventory_dados = $sql_sel_inventory_preparado -> fetch();


              $quantity = $sql_sel_inventory_dados['quantity'] - $sql_sel_removals_dados['quantity'];
              if($quantity > 0){
                $tabela = "removals";
                $dados = array(
                  'sellers_id' => $sql_sel_removals_dados['sel_id'],
                  'date' => $p_date,
                  'hour' => $p_hour,
                  'type' => 'c'
                );

                $sql_add_removals_resultado = adicionar($tabela, $dados);
                if($sql_add_removals_resultado){
                  $removals_id = $conexaobd->lastInsertId();
                  $tabela = "removals_has_products_has_sizes";
                  $dados = array(
                    'removals_id' => $removals_id,
                    'products_has_sizes_id' => $sql_sel_inventory_dados['phs_id'],
                    'quantity' => $sql_sel_removals_dados['quantity']
                  );
                  $sql_del_removals_has_products_has_sizes_resultado = adicionar($tabela, $dados);
                  $removals_hphs = $conexaobd->lastInsertId();
                  if($sql_del_removals_has_products_has_sizes_resultado){
                    $tabela = 'inventories';
                    $dados = array(
                      'quantity' => $quantity
                    );
                    $condicao = "id=".$sql_sel_inventory_dados['inventories_id'];
                    $sql_alt_inventories_resultado = alterar($tabela, $dados, $condicao);
                    if($sql_alt_inventories_resultado){
                        $tabela = 'repairs';
                        $dados = array(
                          'removals_has_products_has_sizes_id' => $removals_hphs,
                          'date' => $p_date,
                          'hour' => $p_hour
                        );
                        $sql_add_repairs = adicionar($tabela, $dados);
                        if($sql_add_repairs){
                          $tabela = 'removals_has_products_has_sizes';
                          $condicao = "id= ".$sql_sel_removals_dados['phs_id'];
                          $sql_del_removals_has_products_has_sizes_resultado = deletar($tabela, $condicao); // Executa o código
                          if($sql_del_removals_has_products_has_sizes_resultado){
                            $tabela = 'removals';
                            $condicao = "id= ".$sql_sel_removals_dados['r_id'];
                            $sql_del_removals = deletar($tabela, $condicao);
                            if($sql_del_removals){
                              $msg = "Registro de repasse de produtos para conserto cadastrado com sucesso!";
                            }else{
                              $msg= "Erro ao efetuar cadastro de repasse de produtos para conserto. [erro 07]";
                            }
                          }else{
                            $msg = "Erro ao efetuar cadastro de repasse de produtos para conserto. [erro 06]";
                          }
                        }else{
                          $msg = "Erro ao efetuar cadastro de repasse de produtos para conserto. [erro 05]";
                        }
                      }else{
                        $msg = "Erro ao efetuar cadastro de repasse de produtos para conserto. [erro 04]";
                      }
                    }else{
                      $msg = "Erro ao efetuar cadastro de repasse de produtos para conserto. [erro 03]";
                    }
                  }else{
                    $msg = "Erro ao efetuar cadastro de repasse de produtos para conserto. [erro 02]";
                  }
              }else if($quantity=='0'){
                $tabela = "removals";
                $dados = array(
                  'sellers_id' => $sql_sel_removals_dados['sel_id'],
                  'date' => $p_date,
                  'hour' => $p_hour,
                  'type' => 'c'
                );
                $sql_add_removals_resultado = adicionar($tabela, $dados);
                if($sql_add_removals_resultado){
                  $removals_id = $conexaobd->lastInsertId();
                  $tabela = "removals_has_products_has_sizes";
                  $dados = array(
                    'removals_id' => $removals_id,
                    'products_has_sizes_id' => $sql_sel_inventory_dados['phs_id'],
                    'quantity' => $sql_sel_removals_dados['quantity']
                  );
                  $sql_del_removals_has_products_has_sizes_resultado = adicionar($tabela, $dados);
                  if($sql_del_removals_has_products_has_sizes_resultado){
                    $tabela = 'inventories';
                    $condicao = 'id='.$sql_sel_inventory_dados['inventories_id'];
                    $sql_del_inventories_resultado = deletar($tabela, $condicao);
                    if($sql_del_inventories_resultado){
                      $msg = 'Registro de repasse de produtos para conserto cadastrado com sucesso!';
                    }else{
                      $msg =  "Erro ao efetuar cadastro de repasse de produtos para conserto. [erro 04]";
                    }
                  }else{
                    $msg =  "Erro ao efetuar cadastro de repasse de produtos para conserto. [erro 05]";
                  }
                }else{
                  $msg =  "Erro ao efetuar cadastro de repasse de produtos para conserto. [erro 06]";
                }
              }else if($quantity < '0'){
                $msg = "Não há produtos suficientes no estoque!";
              }
            }


  ?>
  <p>
    <?php echo $msg ?>
  </p>
  <a href="?folder=system/prod-to-repair/&file=fmadd_prod-to-repair&ext=php">Voltar</a>
</div>
