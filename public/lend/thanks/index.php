<?php
session_start();
$fbid = isset($_SESSION['fbid']) ? $_SESSION['fbid'] : '-';
?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <!--<script src="https://fox-showcase.ru/analitiks/1745/thanks.js"></script>-->
    <script src="https://focs.emsot.com/analitiks/1888/thanks.js"></script>
    <title>LAZARD worldwide healthcare | Thank you for placing an order!!</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=<?=$fbid?>&ev=Lead&noscript=1" />
    <link rel="shortcut icon" href="favicon.ico">
    <!-- css styles -->
    <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/livingston-css3-mediaqueries-js/1.0.0/css3-mediaqueries.min.js"></script><![endif]-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/2.9.0/css/flag-icon.min.css">
    <!-- build:css assets/css/style.min.css-->
    <link rel="stylesheet" href="assets/css/fonts.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- endbuild -->
    <!-- end css styles -->
    <!-- INTH_SNIPPET_TOP -->
  </head>
  <body>
    <div class="d-flex flex-column justify-content-between h-100">
      <!-- header-->
      <header class="header">
        <div class="container">
          <div class="d-flex align-items-center">
            <div class="logo header-logo"><a href="#"><img class="logo__img" src="assets/images/logo/logo.svg" alt="logo"></a></div>
            <p class="header__text m-0">Official distributor of <span class="current-product__name">PhenQ CPL </span><span class="country"></span></p>
          </div>
        </div>
      </header>
      <!-- main-->
      <main class="main">
        <div class="container">
          <div class="row">
            <div class="order__content clearfix">
              <div class="col-md-6 float-md-left pr-md-2">
                <div class="order-info__content order-info__content_light_green mb-sm-3 mb-2">
                  <div class="order-info__info-line">
                    <div class="d-flex align-items-center"><img class="order-is-issued__img" src="assets/images/icons/order_green.svg" alt="order">
                      <p class="order-info__title m-0">Thank you for placing an order!</p>
                    </div>
                  </div>
                  <p class="order-info__text m-0"> <span class="current-product__name font-weight-bold">PhenQ CPL</span>&nbsp;product specialist will contact you soon to answer your questions and clarify delivery details.</p>
                </div>
              </div>
              <div class="col-md-6 float-md-right pl-md-2">
                <div class="order-product__content mb-3">
                  <div class="order-product__item current-product">
                    <div class="d-flex align-items-center justify-content-between">
                      <div class="order-product-spec-wrap">
                        <p class="order-id">Your order number is <span class="order-id__value">8924060-ID</span></p>
                        <p class="current-product__text"><span class="current-product__name">PhenQ CPL</span></p>
                        <p class="current-product__description m-0"></p>
                      </div><img class="current-product__img" src="https://static.infothroat.com/offers/aa9249f5-8798-49a3-9591-1ee0dd4096ba.jpg" alt="product">
                    </div>
                  </div>
                  
                  <div class="order-product__item product-guarantee">
                    <div class="d-flex align-items-center"><img class="label label_img guarantee-label_img" src="assets/images/labels/guarantee.png" alt="guarantee">
                      <p class="product-guarantee_text">100% satisfaction guarantee or your money back during 365 days</p>
                    </div>
                  </div>
                  <div class="order-product__item product-confirmed">
                    <div class="d-flex align-items-center"><img class="label label_img" src="assets/images/labels/confirmed.png" alt="confirmed">
                      <p class="product-confirmed_text">Product safety and effectiveness are clinically confirmed</p>
                    </div>
                  </div>
                </div>
              </div>
              
            </div>
          </div>
        </div>
      </main>
      <!-- footer-->
      <footer class="footer">
        <div class="container">
          <div class="d-flex align-items-center">
            <div class="company-about__content">
              <div class="logo footer-logo"><a href="#"><img class="logo__img" src="assets/images/logo/logo.svg" alt="logo"></a></div>
            </div>
            <div class="footer-contacts__content">
              <div class="d-flex justify-content-between flex-xl-row flex-column">
                <p class="footer_address__text m-0">Lazard inc. Grenzacherstrasse 124, floor 9-16 4058 Basel, Switzerland</p>
                <p class="footer-phone__text m-0">Phone: &nbsp;<a class="footer-phone__link" href="tel:+62215727585">+62 21 5727585</a></p><a class="footer-url__link" href="lazardhealthcare.com" target="_blank">lazardhealthcare.com</a>
              </div>
            </div>
          </div>
        </div>
      </footer>
    </div>
    <!-- js scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!-- build:js assets/js/main.min.js -->
    <script src="assets/js/main.js"></script>
    <!-- endbuild -->
    <!-- end js scripts-->
    <!-- INTH_SNIPPET_BOTTOM -->
  </body>
</html>
