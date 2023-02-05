// /**
//  * Berger Menu.
//  */
// function burgerClick(menuWrap) {
//   const openMenu = document.querySelector(`.${menuWrap}`);
//   const secondPopup = document.querySelector('.active-menu');
//   if(secondPopup){
//     secondPopup.classList.remove('active-menu');
//   }
//   openMenu.classList.add('active-menu');
// }
//
// function closeClick(menuClass) {
//   const closeMenu = document.querySelector(`.${menuClass}`);
//   closeMenu.classList.remove('active-menu');
// }
//
// const navbarBurgerClose = () => {
//   let navbarMenu = document.getElementById('block-menu-menu-menu-categories-taxonomy');
//   navbarMenu.classList.remove('active-navbar-burger');
//   subMenuClose();
// };
//
// function subMenuClose() {
//   let menuItem = document.querySelectorAll('.is-expanded');
//   menuItem.forEach((item) => {
//     let subMenu = item.querySelector('.menu');
//     item.classList.remove('staticHover');
//     subMenu.classList.remove('showSub');
//   });
// }
//
//
// /**
//  * JS with jQuery.
//  */
// (function($) {
//   /**
//    * Placeholder input search form && filter input.
//    */
//   Drupal.behaviors.formPlaceholder = {
//     attach: function(context, settings) {
//       const search_banner = '#edit-key';
//       $(search_banner).attr('placeholder', 'Que-ce que vous cherchez?');
//
//       /* Placeholder for filter input max/min price */
//       const price_min = '#edit-field-price-min';
//       const price_max = '#edit-field-price-max';
//       $(price_min).attr('placeholder', 'Minimale');
//       $(price_max).attr('placeholder', 'Maximale');
//     }
//   };
//
//   Drupal.behaviors.favorites = {
//     attach: function(context, settings) {
//       const flag = '.flag-bookmarks';
//       const unflagged = '.flag-bookmarks .unflagged';
//       const flagged = '.flag-bookmarks .flagged';
//
//       $(unflagged).hover(
//         function() {
//           $(flag).toggleClass("box-hover");
//         }
//       );
//     }
//   };
//
//   /**
//    * Add classes on active men. Count li from pages categories.
//    */
//   Drupal.behaviors.subTitle = {
//     attach: function(context, settings) {
//       const menu = $('#SC .is-active-trail > .menu');
//       const empty = $('.view-empty');
//       const id = $('#SC');
//
//       if (empty) {
//
//       }
//
//       if (menu) {
//         const li = $('#SC .is-active-trail > .menu li');
//         let count = li.length;
//         $(menu).addClass(`active-count active-count--${count}`);
//       }
//     }
//   };
// })(jQuery);
//
// /**
//  * Add class to region-stick-mobile after scroll.
//  */
// Drupal.behaviors.scrollStick = {
//   attach: function(context, settings) {
//     let el = document.getElementById('stick-mobile');
//     if (el) {
//       window.addEventListener('scroll', function() {
//         if (window.scrollY > 75) {
//           el.classList.add("active-stick");
//         } else {
//           el.classList.remove("active-stick");
//         }
//       });
//     }
//   }
// };
//
// function showPass(pass){
//   const passField = document.getElementById(pass);
//   if(passField) {
//     const passWrap = passField.parentElement;
//     const eyeBtn = document.createElement('div');
//     eyeBtn.classList.add('eyeBtn');
//     passWrap.append(eyeBtn);
//     eyeBtn.addEventListener('click', ()=>{
//       eyeBtn.classList.toggle('openEye');
//       if(eyeBtn.classList.contains('openEye')){
//         passField.setAttribute('type', 'text');
//       }
//       else{
//         passField.setAttribute('type', 'password');
//       }
//     });
//   }
// }
//
// function showMenu(){
//   const burgers= document.querySelectorAll(".message-item__chat-burger");
//
//   if(burgers){
//     for (let i = 0; i < burgers.length; i++) {
//       let parent = burgers[i].closest('.message-item-wrap');
//       let menu = parent.querySelector('.chat-menu');
//       let closeBtn = parent.querySelector('.chat-menu__close');
//       const menus = document.querySelectorAll('.chat-menu');
//       burgers[i].addEventListener("click",()=>{
//         menus.forEach((el)=>{
//           el.classList.remove('active');
//         });
//         menu.classList.add('active');
//       });
//       closeBtn.addEventListener('click', ()=>{
//         menu.classList.remove('active');
//       });
//     }
//   }
// }
//
// function unshowMobileMenu(){
//   const menuWraps = document.querySelectorAll('.views-row');
//   menuWraps.forEach((el)=>{
//     el.addEventListener('scroll', ()=>{
//       let active = this.event.target;
//       //console.log(this.event.target);
//       menuWraps.forEach((el)=>{
//     if(el != active){
//         el.scrollLeft = 0;
//     }
//       });
//     })
//   });
// }
//
// /* Add Button for password */
// document.addEventListener('DOMContentLoaded', ()=>{
//   showMenu();
//   unshowMobileMenu();
//   showPass('edit-pass');
//   showPass('edit-pass-pass1');
//   showPass('edit-pass-pass2');
//
//   function start(){
//     let slideWidth = document.documentElement.clientWidth - 40;
//     if (document.documentElement.clientWidth < 1024){
//       const slideWrap = document.querySelectorAll('.views-slideshow-cycle-main-frame-row-item');
//       slideWrap.forEach((slide)=>{
//         let slideImg = slide.getElementsByTagName('img');
//         slideImg[0].attributes[2].value = slideWidth;
//       });
//     }
//
//   }
//   start();
//   window.onresize = start;
//
//   /**
//    * Automatic visible categories btn after load.
//    */
//   const subtitleWrap = document.querySelector('.subtitle-categories');
//
//   if(subtitleWrap) {
//     subtitleWrap.classList.add('show');
//   }
// });
//
// /**
//  * Submit search form.
//  */
// Drupal.behaviors.searchForm = {
//   attach: function(context, settings) {
//     const searchBtn = document.querySelector('.search-btn');
//     const searchInput = document.querySelector('.search-input');
//     const searchContainer = document.querySelector('.page-search');
//     if(searchContainer){
//       const inputSearch = searchContainer.querySelector('.search-input');
//       const btnSearch = searchContainer.querySelector('.search-btn');
//       const filterSearchwrap = document.getElementById('views-exposed-form-views-search-page');
//       const unvisibleInput = filterSearchwrap.querySelector('.form-text');
//       const btnSubmit = filterSearchwrap.querySelector('.form-submit');
//       inputSearch.value = unvisibleInput.value;
//
//       inputSearch.addEventListener('input',()=>{
//         unvisibleInput.value = inputSearch.value;
//       })
//
//       btnSearch.addEventListener('click',()=>{
//         btnSubmit.click();
//       })
//     }
//
//     if(searchBtn && searchInput && !searchContainer){
//       searchBtn.addEventListener('click',()=>{
//         window.location.href=`/search?%2F=${searchInput.value}`;
//       });
//     }
//
//   }
// };
//
//
// /*Custom filters visible **/
// Drupal.behaviors.customFilter = {
//   attach: function(context, settings) {
//   const filters = document.querySelectorAll('.views-exposed-widget[id$=\'tid-selective-wrapper\']');
//
//   let categoryLink = window.location.href.split('&field_categories_tid=');
//   let searchLink = window.location.href.split('search?%2F=');
//
//   if(searchLink[1] && categoryLink[1]) {
//     searchLink = searchLink[1].split('&');
//     searchLink = searchLink[0];
//     categoryLink = categoryLink[1].split('&');
//     categoryLink = categoryLink[0];
//     console.log(searchLink);
//     console.log(categoryLink);
//     if(categoryLink != 'All' || searchLink != ''){
//       filters.forEach((el)=>{
//         el.style.display='block';
//       });
//     }
//   }
//
//   /* Change TYPE text on TYPE number */
//   const priceEdit = document.getElementById('edit-field-price-und-0-value');
//   const priceMin = document.getElementById('edit-field-price-value');
//   const priceMax = document.getElementById('edit-field-price-value-1');
//
//   priceEdit ? priceEdit.setAttribute('type', 'number') : false
//   priceMin ? priceMin.setAttribute('type', 'number') : false
//   priceMax ? priceMax.setAttribute('type', 'number') : false
//
//   }
// };
//
//
