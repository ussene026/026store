<?php
   include '../components/conex.php';
   session_start();
   $admin_id = $_SESSION['admin_id'];
   if(!isset($admin_id)){
      header('location:admin_login.php');
   };
   if(isset($_POST['add_product'])){
      $name = $_POST['name'];
      $name = filter_var($name, FILTER_SANITIZE_STRING);

      $price = $_POST['price'];
      $price = filter_var($price, FILTER_SANITIZE_STRING);

      $details = $_POST['details'];
      $details = filter_var($details, FILTER_SANITIZE_STRING);

      $image_01 = $_FILES['image_01']['name'];
      $image_01 = filter_var($image_01, FILTER_SANITIZE_STRING);

      $image_size_01 = $_FILES['image_01']['size'];
      $image_tmp_name_01 = $_FILES['image_01']['tmp_name'];
      $image_folder_01 = '../upload/'.$image_01;

      $image_02 = $_FILES['image_02']['name'];
      $image_02 = filter_var($image_02, FILTER_SANITIZE_STRING);

      $image_size_02 = $_FILES['image_02']['size'];
      $image_tmp_name_02 = $_FILES['image_02']['tmp_name'];
      $image_folder_02 = '../upload/'.$image_02;

      $image_03 = $_FILES['image_03']['name'];
      $image_03 = filter_var($image_03, FILTER_SANITIZE_STRING);

      $image_size_03 = $_FILES['image_03']['size'];
      $image_tmp_name_03 = $_FILES['image_03']['tmp_name'];
      $image_folder_03 = '../upload/'.$image_03;

      $select_products = $conn->prepare("SELECT * FROM `produtos` WHERE name = ?");
      $select_products->execute([$name]);

      if($select_products->rowCount() > 0){
         $message[] = 'Produto já registado!';
      } else {
         $insert_products = $conn->prepare("INSERT INTO `produtos`(name, details, price, image_01, image_02, image_03) VALUES(?,?,?,?,?,?)");
         $insert_products->execute([$name, $details, $price, $image_01, $image_02, $image_03]);

         if($insert_products){
            if($image_size_01 > 2000000 OR $image_size_02 > 2000000 OR $image_size_03 > 2000000){
               $message[] = 'Imagem muito grande, reduza o tamanho (MB)!';
            } else {
               move_uploaded_file($image_tmp_name_01, $image_folder_01);
               move_uploaded_file($image_tmp_name_02, $image_folder_02);
               move_uploaded_file($image_tmp_name_03, $image_folder_03);
               $message[] = 'Produto adicionado com sucesso!';
            }
         }
      }  
   };
   if(isset($_GET['delete'])){
      $delete_id = $_GET['delete'];
      $delete_product_image = $conn->prepare("SELECT * FROM `produtos` WHERE id = ?");
      $delete_product_image->execute([$delete_id]);
      $fetch_delete_image = $delete_product_image->fetch(PDO::FETCH_ASSOC);

      unlink('../upload/'.$fetch_delete_image['image_01']);
      unlink('../upload/'.$fetch_delete_image['image_02']);
      unlink('../upload/'.$fetch_delete_image['image_03']);

      $delete_product = $conn->prepare("DELETE FROM `produtos` WHERE id = ?");
      $delete_product->execute([$delete_id]);
      $delete_cart = $conn->prepare("DELETE FROM `carrinho` WHERE pid = ?");
      $delete_cart->execute([$delete_id]);
      $delete_wishlist = $conn->prepare("DELETE FROM `favoritos` WHERE pid = ?");
      $delete_wishlist->execute([$delete_id]);
      header('location:produtos.php');
   }
?>
<!DOCTYPE html>
<html lang="pt-PT">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Adicionar Produto - 026 STORE</title>
      <link rel="shortcut icon" href="../images/favicon.png" type="image/x-icon">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
      <link rel="stylesheet" href="../css/admin_style.css">
   </head>
   <body>
      <?php include '../components/admin_header.php'; ?>
      <section class="add-products">
         <h1 class="heading">Adicionar Produtos</h1>
         <form action="" method="post" enctype="multipart/form-data">
            <div class="flex">
               <div class="inputBox">
                  <span>Nome do produto</span>
                  <input type="text" class="box" required maxlength="100" placeholder="Digite o nome do produto" name="name">
               </div>
               <div class="inputBox">
                  <span>Preço do produto</span>
                  <input type="number" min="0" class="box" required max="9999999999" placeholder="Digite o preço do produto" onkeypress="if(this.value.length == 10) return false;" name="price">
               </div>
               <div class="inputBox">
                     <span>Imagem Principal</span>
                     <input type="file" name="image_01" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
               </div>
               <div class="inputBox">
                     <span>Imagem Secundária</span>
                     <input type="file" name="image_02" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
               </div>
               <div class="inputBox">
                     <span>Imagem da Galeria</span>
                     <input type="file" name="image_03" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
               </div>
               <div class="inputBox">
                  <span>Detalhes</span>
                  <textarea name="details" placeholder="Digite os detalhes do produto" class="box" required maxlength="500" cols="30" rows="10"></textarea>
               </div>
            </div>
            <input type="submit" value="Adicionar Produto" class="btn" name="add_product">
         </form>
      </section>

      <section class="show-products">
         <h1 class="heading">Produtos Adicionados</h1>
         <div class="box-container">
            <?php
               $select_products = $conn->prepare("SELECT * FROM `produtos`");
               $select_products->execute();
               if($select_products->rowCount() > 0){
                  while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){ ?>
                     <div class="box">
                        <img src="../upload/<?= $fetch_products['image_01']; ?>">
                        <div class="name"><?= $fetch_products['name']; ?></div>
                        <div class="price"><span><?= $fetch_products['price']; ?></span> MZN</div>
                        <div class="details"><span><?= $fetch_products['details']; ?></span></div>
                        <div class="flex-btn">
                           <a href="atualizar_prod.php?update=<?= $fetch_products['id']; ?>" class="option-btn">Atualizar</a>
                           <a href="produtos.php?delete=<?= $fetch_products['id']; ?>" class="delete-btn" onclick="return confirm('Deseja eliminar o cliente?');">Eliminar</a>
                        </div>
                     </div>
                  <?php }
               } else {
                  echo '<p class="empty">Nenhum produto encontrado!</p>';
               }
            ?>
         </div>
      </section>
      <script src="../js/admin_script.js"></script>
   </body>
</html>