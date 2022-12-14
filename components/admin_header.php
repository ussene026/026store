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
         <a href="../admin/produtos.php">Produtos</a>
         <a href="../admin/contas.php">Administradores</a>
         <a href="../admin/clientes.php">Clientes</a>
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
         <a href="../index.php" class="btn" target="_blank">Ir Para Pagina Inicial</a>
         <a href="../components/admin_logout.php" class="delete-btn" onclick="return confirm('Deseja terminar a sessão?');">Sair</a> 
      </div>
   </section>
</header>