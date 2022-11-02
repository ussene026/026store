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
      <a href="index.php" class="logo">026Store<span></span></a>
      <nav class="navbar">
         <a href="index.php">Página Inicial</a>
         <a href="orders.php">Pedidos</a>
         <a href="shop.php">Produtos</a>
         <a href="contact.php">Contactos</a>
         <a href="search_page.php"><i class="fas fa-search"></i></a>
      </nav>

      <div class="icons">
         <?php
            $count_wishlist_items = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
            $count_wishlist_items->execute([$user_id]);
            $total_wishlist_counts = $count_wishlist_items->rowCount();
            $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $count_cart_items->execute([$user_id]);
            $total_cart_counts = $count_cart_items->rowCount();
         ?>
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"> <span>Minha Conta</span></div>
      </div>

      <div class="profile">
         <?php          
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);
            if($select_profile->rowCount() > 0){
               $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
               ?>
                  <p><?= $fetch_profile["name"]; ?></p>
                  <a href="update_user.php" class="btn">update profile</a>
                  <div class="flex-btn">
                     <a href="wishlist.php" class="option-btn"><i class="fas fa-heart"></i> <?= $total_wishlist_counts; ?> Favoritos</a>
                     <a href="cart.php" class="option-btn"><i class="fas fa-shopping-cart"></i> <?= $total_cart_counts; ?> Pedidos</a>
                  </div>
                  <a href="components/user_logout.php" class="delete-btn" onclick="return confirm('logout from the website?');">logout</a> 
               <?php
            }else{
               ?>
                  <div class="flex-btn">
                     <a href="user_register.php" class="option-btn">Criar</a>
                     <a href="user_login.php" class="option-btn">Entrar</a>
                  </div>
               <?php
            }
         ?>      
      </div>
   </section>
</header>