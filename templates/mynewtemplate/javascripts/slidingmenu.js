// SLIDINGMENU.JS
//--------------------------------------------------------------------------------------------------------------------------------
//JS for operating the sliding menu*/
// -------------------------------------------------------------------------------------------------------------------------------
// Author: Designova.
// Website: http://www.designova.net 
// Copyright: (C) 2013 
// -------------------------------------------------------------------------------------------------------------------------------

/*global $K2:false */
/*global window: false */
var $K2 = jQuery.noConflict();
$K2(document).ready(function(){
  "use strict";

// Menu Action

$K2('#sm-trigger, .menu-close').on('click', function(){
    $K2('#sm-trigger').toggleClass('active');
    $K2('#sm-trigger').toggleClass('arrow-close');
    $K2('#sm-trigger').toggleClass('arrow-open');
    $K2('#mastwrap').toggleClass('sliding-toright');
    $K2('#mastwrap').toggleClass('mastwrap-open');
    $K2('#sm').toggleClass('menu-open');
    $K2('#mastwrap').addClass('nav-opened');
});


$K2('#mastwrap').on('click', function(){
	$K2('#sm-trigger').addClass('arrow-close');
    $K2('#sm-trigger').removeClass('arrow-open');
    $K2('#mastwrap').removeClass('sliding-toright');
    $K2('#mastwrap').removeClass('mastwrap-open');
    $K2('#sm').removeClass('menu-open');
});



});
//  JSHint wrapper $K2(function ($K2)  : ends

