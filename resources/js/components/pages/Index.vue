<template>
   <div>
      <div class="uk-container-expand uk-margin uk-margin-remove-bottom">
         <div class="uk-card uk-card-small uk-card-body uk-padding-remove-bottom wi-home-topNav">
            <div class="uk-position-relative uk-margin-medium">
               <a class="uk-align-left uk-margin uk-margin-remove-adjacent">
                  <img src="img/logo.png" style="width:30px;"></a>
                  <p class="wi-text-large uk-margin-large-right">Open with an app</p> 
                  <div class="uk-position-top-right wi-left-arrow">
                     <router-link to="#!">
                        <span uk-icon="icon: download; ratio: 1.5" style="color:#000"></span>
                        </router-link>
                        </div>
                        </div>
                        </div>
                        </div>
        <div><h2 class="text-center uk-padding-small" style="color: #0000ff;">Welcome</h2></div>                
      <div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1" uk-slider="center: true">
         <ul class="uk-slider-items uk-grid uk-grid-match" uk-height-viewport="offset-top: true; offset-bottom: 30">
            <li class="uk-width-1-1">
               <div class="uk-cover-container">
                  <img src="img/slider1.png" alt="" uk-cover>
                   <div class="uk-position-center  uk-panel"><h3 class="uk-margin-large-right">Electronic Product</h3></div>
               </div>
            </li>
            <li class="uk-width-1-1">
               <div class="uk-cover-container">
                  <img src="img/slider2.png" alt="" uk-cover>
                  
               </div>
            </li>
            <li class="uk-width-1-1">
               <div class="uk-cover-container">
                  <img src="img/slider3.png" alt="" uk-cover>
                  <div class="uk-position-center uk-panel"><h3>Fashion Collections</h3></div>
               </div>
            </li>
            <li class="uk-width-1-1">
               <div class="uk-cover-container">
                  <img src="img/slider4.png" alt="" uk-cover>
                  <div class="uk-position-center  uk-panel"><h3 class="uk-margin-large-right">Watch Smart Sport</h3></div>
               </div>
            </li>
         </ul>
         <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slider-item="previous"></a>
         <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slider-item="next"></a>
      </div>
      <div class="uk-section uk-section-default uk-padding-remove-top uk-margin-bottom">
         <div class="uk-container uk-section uk-section-xsmall">
            <div class="uk-grid uk-grid-medium uk-child-width-1-2" uk-grid>
               <div>
                  <div class="uk-card uk-card-default wi-home-product-shadow uk-card-small">
                      <router-link to="/productdetails">
                     <div class="uk-cover-container uk-height-small">
                        <img data-src="img/product2.png" alt="" uk-img uk-cover>
                     </div>
                     <div class="uk-card-body">
                        <h5 class="uk-card-title uk-margin-remove-bottom product-txt">Travel Bag</h5>
                        <div class="uk-margin-small-top">
                           <span class="uk-label uk-label-warning">₹ 699</span>
                        </div>
                     </div>
                      </router-link>
                  </div>
               </div>
               <div>
                <div class="uk-card uk-card-default wi-home-product-shadow uk-card-small">
                     <div class="uk-cover-container uk-height-small">
                        <img data-src="img/product3.png" alt="" uk-img uk-cover>
                     </div>
                     <div class="uk-card-body">
                        <h5 class="uk-card-title uk-margin-remove-bottom product-txt">Blue Cap </h5>
                        <div class="uk-margin-small-top">
                           <span class="uk-label uk-label-warning">₹ 599</span>
                        </div>
                     </div>
                  </div>
               </div>
                <div>
                  <div class="uk-card uk-card-default wi-home-product-shadow uk-card-small">
                     <div class="uk-cover-container uk-height-small">
                        <img data-src="img/product6.png" alt="" uk-img uk-cover>
                     </div>
                     <div class="uk-card-body">
                        <h5 class="uk-card-title uk-margin-remove-bottom product-txt">Women Shoe</h5>
                        <div class="uk-margin-small-top">
                           <span class="uk-label uk-label-warning">₹ 499</span>
                        </div>
                     </div>
                  </div>
               </div>
                <div>
                  <div class="uk-card uk-card-default wi-home-product-shadow uk-card-small">
                     <div class="uk-cover-container uk-height-small">
                        <img data-src="img/product7.png" alt="" uk-img uk-cover>
                     </div>
                     <div class="uk-card-body">
                        <h5 class="uk-card-title uk-margin-remove-bottom product-txt">Men Shoe</h5>
                        <div class="uk-margin-small-top">
                           <span class="uk-label uk-label-warning">₹ 799</span>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</template>
<script>
   export default {
   
   }
</script>
<style>
   .uk-cover-container img {
   width: 100%!important;
   height: auto!important;
   }
   .uk-label-warning{
   background-color: #faa05a;
   color: #fff;
   font-size: 15px;
   padding: 0 15px;
   }
   .product-txt{
   font-size: 14px;
   }
   .download-btn{
   font-size: 11px;
    padding: 0px 9px 0px 9px;
    background: #5ae1e1;
    border: 1px solid #5ae1e1;
    margin: 0px 15px 0px 15px;
   }
   .wi-home-topNav {
    background-color: #eeeeee !important;
    color: #525151!important;
    box-shadow: 0 1px 4px rgb(0 0 0 / 74%);
    transition: background-color .3s!important;
    z-index: 999;
}
   .wi-home-product-shadow{
   -webkit-box-shadow: 0 3px 1px -2px rgba(0,0,0,.2), 0 2px 2px 0 rgba(0,0,0,.14), 0 1px 5px 0 rgba(0,0,0,.12);
    box-shadow: 0 3px 1px -2px rgba(0,0,0,.2), 0 2px 2px 0 rgba(0,0,0,.14), 0 1px 5px 0 rgba(0,0,0,.12);
   }
   @media (min-width: 425px) {
   .uk-cover-container img {
   height: auto!important;
   }
   }
</style>