<?php
   include '../components/conex.php';
   session_start();
   $admin_id = $_SESSION['admin_id'];
   if(!isset($admin_id)){
      header('location:admin_login.php');
   }
   if(isset($_GET['delete'])){
      $delete_id = $_GET['delete'];
      $delete_admins = $conn->prepare("DELETE FROM `admins` WHERE id = ?");
      $delete_admins->execute([$delete_id]);
      header('location:contas.php');
   }
?>
<!DOCTYPE html>
<html lang="pt-PT">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Contas de Administradores - 026 STORE</title>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
      <link rel="stylesheet" href="../css/admin_style.css">
   </head>
   <body>
   <?php include '../components/admin_header.php'; ?>
   <section class="accounts">
      <h1 class="heading">Contas de Administradores</h1>
      <div class="box-container">
         <div class="box">
            <a href="criar_admin.php" class="option-btn">Adicionar nova conta</a>
         </div>
         <?php
            $select_accounts = $conn->prepare("SELECT * FROM `admins`");
            $select_accounts->execute();
            if($select_accounts->rowCount() > 0){
               while($fetch_accounts = $select_accounts->fetch(PDO::FETCH_ASSOC)){ ?>
                  <div class="box">
                     <p>Identificação Única: <span><?= $fetch_accounts['id']; ?></span> </p>
                     <p>Nome: <span><?= $fetch_accounts['name']; ?></span> </p>
                     <div class="flex-btn">
                        <a href="contas.php?delete=<?= $fetch_accounts['id']; ?>" onclick="return confirm('Deseja eliminar esta conta?')" class="delete-btn">Eliminar</a>
                        <?php
                           if($fetch_accounts['id'] == $admin_id){
                              echo '<a href="perfil_admin.php" class="option-btn">Atualizar</a>';
                           }
                        ?>
                     </div>
                  </div>
               <?php }
            } else {
               echo '<p class="empty">Nenhuma conta disponível!</p>';
            }
         ?>
      </div>
   </section>
   <script src="../js/admin_script.js"></script>
   </body>
</html>