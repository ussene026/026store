<?php
   include 'components/conex.php';
   session_start();
   if(isset($_SESSION['user_id'])){
      $user_id = $_SESSION['user_id'];
   } else {
      $user_id = '';
   };
   include 'components/carrinho_fav.php';
?>
<!DOCTYPE html>
<html lang="pt-PT">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Produtos - 026 STORE</title>
      <link rel="shortcut icon" href="./images/favicon.png" type="image/x-icon">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
      <link rel="stylesheet" href="css/style.css">
   </head>
   <body>
      <?php include 'components/user_header.php'; ?>
      <section class="products">
         <h1 class="heading">Produtos Disponíveis</h1>
         <div class="box-container">
            <?php
               $select_products = $conn->prepare("SELECT * FROM `produtos`"); 
               $select_products->execute();
               if($select_products->rowCount() > 0){
                  while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
                     ?>
                        <form action="" method="post" class="box">
                           <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
                           <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
                           <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
                           <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
                           <button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
                           <a href="ver.php?pid=<?= $fetch_product['id']; ?>" class="fas fa-eye"></a>
                           <img src="upload/<?= $fetch_product['image_01']; ?>">
                           <div class="name">
                              <?= $fetch_product['name']; ?>
                           </div>
                           <div class="flex">
                              <div class="price">
                                 <?= $fetch_product['price']; ?><span> MZN</span>
                              </div>
                              <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
                           </div>
                           <input type="submit" value="Comprar" class="btn" name="add_to_cart">
                        </form>
                     <?php
                  }
               } else {
                  echo '<p class="empty">Nenhum produto encontrado.</p>';
               }
            ?>
         </div>
      </section>
      <?php include 'components/footer.php'; ?>
      <script src="js/script.js"></script>
   </body>
</html>