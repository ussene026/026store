<?php
   include 'components/conex.php';
   session_start();
   if(isset($_SESSION['user_id'])){
      $user_id = $_SESSION['user_id'];
   }else{
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
      <title>026 STORE - Página Inicial</title>
      <link rel="shortcut icon" href="./images/favicon.png" type="image/x-icon">
      <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
      <link rel="stylesheet" href="css/style.css">
   </head>
   <body>
      <?php include 'components/user_header.php'; ?>
      <div class="home-bg">
         <section class="home">
            <div class="swiper home-slider">
               <div class="swiper-wrapper">

                  <div class="swiper-slide slide">
                     <div class="image">
                        <img src="images/home-img-1.png" alt="">
                     </div>
                     <div class="content">
                        <span>Promoção</span>
                        <h3>laptop HP ProBook</h3>
                        <a href="produtos.php" class="btn">ver mais...</a>
                     </div>
                  </div>

                  <div class="swiper-slide slide">
                     <div class="image">
                        <img src="images/home-img-2.png" alt="">
                     </div>
                     <div class="content">
                        <span>Promoção</span>
                        <h3>Xiaomi Mi 10t pro</h3>
                        <a href="produtos.php" class="btn">ver mais...</a>
                     </div>
                  </div>

                  <div class="swiper-slide slide">
                     <div class="image">
                        <img src="images/home-img-3.png" alt="">
                     </div>
                     <div class="content">
                        <span>Promoção</span>
                        <h3>Iphone 14 Pro Max</h3>
                        <a href="produtos.php" class="btn">ver mais...</a>
                     </div>
                  </div>
               </div>
               <div class="swiper-pagination"></div>
            </div>
         </section>
      </div>

      <?php include 'components/footer.php'; ?>
      <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
      <script src="js/script.js"></script>
      <script>
      var swiper = new Swiper(".home-slider", {
         loop:true,
         spaceBetween: 20,
         pagination: {
            el: ".swiper-pagination",
            clickable:true,
         },
      });

      var swiper = new Swiper(".category-slider", {
         loop:true,
         spaceBetween: 20,
         pagination: {
            el: ".swiper-pagination",
            clickable:true,
         },
         breakpoints: {
            0: {
               slidesPerView: 2,
            },
            650: {
            slidesPerView: 3,
            },
            768: {
            slidesPerView: 4,
            },
            1024: {
            slidesPerView: 5,
            },
         },
      });

      var swiper = new Swiper(".products-slider", {
         loop:true,
         spaceBetween: 20,
         pagination: {
            el: ".swiper-pagination",
            clickable:true,
         },
         breakpoints: {
            550: {
            slidesPerView: 2,
            },
            768: {
            slidesPerView: 2,
            },
            1024: {
            slidesPerView: 3,
            },
         },
      });
      </script>
   </body>
</html>