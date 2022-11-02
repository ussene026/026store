<?php
   include '../components/conex.php';
   session_start();
   $admin_id = $_SESSION['admin_id'];
   if(!isset($admin_id)){
      header('location:admin_login.php');
   }

   if(isset($_GET['delete'])){
      $delete_id = $_GET['delete'];
      $delete_user = $conn->prepare("DELETE FROM `clientes` WHERE id = ?");
      $delete_user->execute([$delete_id]);
      $delete_orders = $conn->prepare("DELETE FROM `pedidos` WHERE user_id = ?");
      $delete_orders->execute([$delete_id]);
      $delete_messages = $conn->prepare("DELETE FROM `messages` WHERE user_id = ?");
      $delete_messages->execute([$delete_id]);
      $delete_cart = $conn->prepare("DELETE FROM `carrinho` WHERE user_id = ?");
      $delete_cart->execute([$delete_id]);
      $delete_wishlist = $conn->prepare("DELETE FROM `favoritos` WHERE user_id = ?");
      $delete_wishlist->execute([$delete_id]);
      header('location:clientes.php');
   }
?>

<!DOCTYPE html>
<html lang="pt-PT">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Clientes - 026 STORE</title>
   <link rel="shortcut icon" href="../images/favicon.png" type="image/x-icon">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="../css/admin_style.css">
</head>
<body>

<?php include '../components/admin_header.php'; ?>

<section class="accounts">

   <h1 class="heading">Clientes registados</h1>

   <div class="box-container">

   <?php
      $select_accounts = $conn->prepare("SELECT * FROM `clientes`");
      $select_accounts->execute();
      if($select_accounts->rowCount() > 0){
         while($fetch_accounts = $select_accounts->fetch(PDO::FETCH_ASSOC)){   
   ?>
   <div class="box">
      <p>Identificação Única: <span><?= $fetch_accounts['id']; ?></span> </p>
      <p>Nome de usuário: <span><?= $fetch_accounts['name']; ?></span> </p>
      <p>Email: <span><?= $fetch_accounts['email']; ?></span> </p>
      <a href="clientes.php?delete=<?= $fetch_accounts['id']; ?>" onclick="return confirm('Deseja eliminar este cliente?')" class="delete-btn">Eliminar</a>
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">Nenhum cliente encontrado!</p>';
      }
   ?>

   </div>

</section>












<script src="../js/admin_script.js"></script>
   
</body>
</html>