<?php
   include '../components/conex.php';
   session_start();
   $admin_id = $_SESSION['admin_id'];
   if(!isset($admin_id)){
      header('location:admin_login.php');
   }
?>
<!DOCTYPE html>
<html lang="pt-PT">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Painel de Controle - 026 STORE</title>
      <link rel="shortcut icon" href="../images/favicon.png" type="image/x-icon">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
      <link rel="stylesheet" href="../css/admin_style.css">
   </head>
   <body>
      <?php include '../components/admin_header.php'; ?>
      <section class="dashboard">
         <h1 class="heading">Painel de Controle</h1>
         <div class="box-container">
            <!--
            <div class="box">
               <?php
                  $total_pendings = 0;
                  $select_pendings = $conn->prepare("SELECT * FROM `pedidos` WHERE payment_status = ?");
                  $select_pendings->execute(['pending']);
                  if($select_pendings->rowCount() > 0){
                     while($fetch_pendings = $select_pendings->fetch(PDO::FETCH_ASSOC)){
                        $total_pendings += $fetch_pendings['total_price'];
                     }
                  }
               ?>
               <h3><span></span><?= $total_pendings; ?><span></span></h3>
               <p>Pedidos Pendentes</p>
               <a href="pedidos.php" class="btn">ver pendentes</a>
            </div>
            -->

            <div class="box">
               <?php
                  $total_completes = 0;
                  $select_completes = $conn->prepare("SELECT * FROM `pedidos` WHERE payment_status = ?");
                  $select_completes->execute(['completed']);
                  if($select_completes->rowCount() > 0){
                     while($fetch_completes = $select_completes->fetch(PDO::FETCH_ASSOC)){
                        $total_completes += $fetch_completes['total_price'];
                     }
                  }
               ?>
               <h3><span></span><?= $total_completes; ?><span></span></h3>
               <p>Pedidos Completos</p>
               <a href="pedidos.php" class="btn">ver pedidos</a>
            </div>

            <div class="box">
               <?php
                  $select_orders = $conn->prepare("SELECT * FROM `pedidos`");
                  $select_orders->execute();
                  $number_of_orders = $select_orders->rowCount()
               ?>
               <h3><?= $number_of_orders; ?></h3>
               <p>Total de pedidos</p>
               <a href="pedidos.php" class="btn">ver pedidos</a>
            </div>

            <div class="box">
               <?php
                  $select_products = $conn->prepare("SELECT * FROM `produtos`");
                  $select_products->execute();
                  $number_of_products = $select_products->rowCount()
               ?>
               <h3><?= $number_of_products; ?></h3>
               <p>Produtos registados</p>
               <a href="produtos.php" class="btn">ver produtos</a>
            </div>

            <div class="box">
               <?php
                  $select_users = $conn->prepare("SELECT * FROM `clientes`");
                  $select_users->execute();
                  $number_of_users = $select_users->rowCount()
               ?>
               <h3>0</h3>
               <p>Produtos Mais vendidos</p>
               <a href="produtos.php" class="btn">ver produtos</a>
            </div>

            <div class="box">
               <?php
                  $select_admins = $conn->prepare("SELECT * FROM `admins`");
                  $select_admins->execute();
                  $number_of_admins = $select_admins->rowCount()
               ?>
               <h3><?= $number_of_admins; ?></h3>
               <p>Conta Admin</p>
               <a href="contas.php" class="btn">ver contas</a>
            </div>

            <div class="box">
               <?php
                  $select_users = $conn->prepare("SELECT * FROM `clientes`");
                  $select_users->execute();
                  $number_of_users = $select_users->rowCount()
               ?>
               <h3><?= $number_of_users; ?></h3>
               <p>Clientes Registados</p>
               <a href="clientes.php" class="btn">ver clientes</a>
            </div>
         </div>
      </section>
      <script src="../js/admin_script.js"></script>
   </body>
</html>