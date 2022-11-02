<?php
   if(isset($message)){
      foreach($message as $message){
         echo '
         <div class="message">
            <span>'.$message.'</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
         </div>
         ';
      }
   }
?>

<header class="header">

   <section class="flex">

      <a href="../admin/painel.php" class="logo">026Store <span>Painel</span></a>

      <nav class="navbar">
         <a href="../admin/painel.php">Painel de Controle</a>
         <a href="../admin/products.php">Produtos</a>
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="profile">
         <?php
            $select_profile = $conn->prepare("SELECT * FROM `admins` WHERE id = ?");
            $select_profile->execute([$admin_id]);
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <p>Olá <?= $fetch_profile['name']; ?>!</p>
         <a href="../admin/perfil_admin.php" class="btn">Atualizar Perfil</a>
         <a href="../components/sair_a.php" class="delete-btn" onclick="return confirm('Deseja terminar a sessão?');">Sair</a> 
      </div>
   </section>
</header>