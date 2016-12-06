<!DOCTYPE html>
<?php
  include "../security/setup_security.php";
  include "../security/database/dbconfig.php";
  include "../security/database/dbconnect.php";
  include "../php/dboperations.php";
?>
<html>
  <head>
    <meta charset="utf-8">
    <title>threadsoft</title>
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/font-awesome-4.6.3/css/font-awesome.min.css">
    <link rel="icon" href="../img/favicon.png" />
    <script src="../js/jquery/jquery-3.1.1.min.js"></script>
  </head>
  <body>
    <header>
      <nav id="headerMenu">
        <a href="?folder=/&file=initial&ext=php"><img src="../img/logo.png" id="menuLogo"/></a>
        <ul id="menuList">
          <li class="dropdown">
               <a href="#" class="dropbtn">Registros <i class="fa fa-caret-down" aria-hidden="true"></i></a>
               <div class="dropdown-content">
                 <a href="?folder=system/user/&file=fmadd_user&ext=php">Registro de Administrador</a>
                 <a href="?folder=system/manufacturer/&file=fmadd_manufacturer&ext=php">Registro de Fabricante</a>
                 <a href="?folder=system/state/&file=fmadd_state_city&ext=php">Registro de Estado e Cidade</a>
                 <a href="?folder=system/seller/&file=fmadd_seller&ext=php">Registro de Vendedor</a>
                 <a href="?folder=system/prod-details/&file=fmadd_prod-details&ext=php">Registro de Detalhes de Produto</a>
                 <a href="?folder=system/products/&file=fmadd_products&ext=php">Registro de Produto</a>
                 <a href="?folder=system/checks/&file=fmadd_checks&ext=php">Registro de Cheque Recebido</a>
               </div>
             </li><!--
       --><li class="dropdown">
            <a href="#" class="dropbtn">Estoque <i class="fa fa-caret-down" aria-hidden="true"></i></a>
            <div class="dropdown-content">
              <a href="?folder=system/entries/&file=fmadd_entries&ext=php">Entrada de Produtos em Estoque</a>
              <a href="?folder=system/prod-to-seller/&file=fmadd_prod-to-seller&ext=php">Repasse de Mercadorias para Vendedores</a>
              <a href="?folder=system/prod-to-repair/&file=fmadd_prod-to-repair&ext=php">Repasse de Produto para Conserto</a>
              <a href="?folder=system/presents/&file=fmadd_presents&ext=php">Repasse de Brindes para Vendedores</a>
            </div>
          </li><!--
       --><li class="dropdown">
            <a href="#" class="dropbtn">Consultas / Relatórios <i class="fa fa-caret-down" aria-hidden="true"></i></a>
            <div class="dropdown-content">
              <a href="?folder=system/manufacturer/&file=manufacturer_view&ext=php">Consulta de Fabricantes</a>
              <a href="?folder=system/products/&file=products_view&ext=php">Consulta de Produtos</a>
              <a href="?folder=system/inventories/&file=inventories_view&ext=php">Consulta de Estoque</a>
              <a href="?folder=system/entries/&file=entries_history&ext=php">Histórico de Entradas de Produtos em Estoque</a>
              <a href="?folder=system/devolutions/&file=devolutions_history&ext=php">Consulta de Devoluções</a>
              <a href="?folder=system/prod-to-seller/&file=prod-to-seller_history&ext=php">Histórico de Repasses de Mercadoria</a>
              <a href="?folder=system/prod-to-repair/&file=prod-to-repair_history&ext=php">Consulta de Repasses de Conserto</a>
              <a href="?folder=system/presents/&file=presents_history&ext=php">Histórico de Brindes</a>
              <a href="?folder=system/checks/&file=checks_view&ext=php">Consulta de Cheques</a>
            </div>
          </li>
        </ul>
        <div id="menuUser">
          <?php
            $sql_sel_users = "SELECT username, id FROM users WHERE id = ".$_SESSION['idUsuario'];
            $sql_sel_users_preparado = $conexaobd -> prepare($sql_sel_users);
            $sql_sel_users_preparado -> execute();
            $sql_sel_users_dados = $sql_sel_users_preparado -> fetch();
          ?>
          <a href="?folder=system/user/&file=fmalt_user&ext=php&id=<?php echo $sql_sel_users_dados['id'] ?>"><?php echo $sql_sel_users_dados['username'] ?></a>
          <a href="../security/authentication/logout_authentication.php"><i class="fa fa-sign-out" aria-hidden="true"></i></a>
        </div>
      </nav>
    </header>
    <?php
      if(isset($_GET['folder'])&&isset($_GET['file'])&&isset($_GET['ext'])){
        if(!include $_GET['folder'].$_GET['file'].".".$_GET['ext']){
          echo "<h1>Página não encontrada!</h1>";
        }
      }else{
        include "initial.php";
      }
    ?>
    <div id="devModal" class="devModal"> <!-- modal com as informações do desenvolvedor -->
      <div class="devModal-content"> <!-- conteúdo da modal -->
        <span onclick="closeModal()" class="closeModal"><i class="fa fa-times-circle" aria-hidden="true"></i></span>
          <h1>Mateus Gomes da Rocha</h1>
          <h2>Desenvolvedor</h2>
          <div> <!-- rodapé da modal -->
            <i class="fa fa-envelope-o" aria-hidden="true"></i> mateusgmsrocha@gmail.com
            <i class="fa fa-whatsapp" aria-hidden="true"></i> +55 (47) 99649-7204
          </div> <!-- fim do rodapé da modal -->
      </div> <!-- fim do conteúdo da modal -->
    </div> <!-- fim da modal -->
    <footer>
      <button onclick="openModal()" id="openModal">Desenvolvedor</button>
    </footer>
    <script type="text/javascript" src="../js/footerModal.js"></script>
  </body>
</html>
