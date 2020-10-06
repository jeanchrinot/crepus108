<!DOCTYPE html>

<html lang="fr">
<head>

	<!-- META -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <meta name="robots" content="" />    
    <meta name="description" content="" />
    
    <!-- FAVICONS ICON -->
    <link rel="icon" href="images/favicon.html" type="image/x-icon" />
    <link rel="shortcut icon" type="image/x-icon" href="/images/favicon.png" />
    
    <!-- PAGE TITLE HERE -->
    <title> @yield('title') | Crépus 108</title>
    
    <!-- MOBILE SPECIFIC -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- [if lt IE 9]>
        <script src="/js/html5shiv.min.js"></script>
        <script src="/js/respond.min.js"></script>
	<![endif] -->
    
    <!-- BOOTSTRAP STYLE SHEET -->
    <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
    <!-- FONTAWESOME STYLE SHEET -->
    <link rel="stylesheet" type="text/css" href="/css/fontawesome/css/font-awesome.min.css" />
    <!-- FLATICON STYLE SHEET -->
    <link rel="stylesheet" type="text/css" href="/css/flaticon.min.css">
    <!-- ANIMATE STYLE SHEET --> 
    <link rel="stylesheet" type="text/css" href="/css/animate.min.css">
    <!-- OWL CAROUSEL STYLE SHEET -->
    <link rel="stylesheet" type="text/css" href="/css/owl.carousel.min.css">
    <!-- BOOTSTRAP SELECT BOX STYLE SHEET -->
    <link rel="stylesheet" type="text/css" href="/css/bootstrap-select.min.css">
    <!-- MAGNIFIC POPUP STYLE SHEET -->
    <link rel="stylesheet" type="text/css" href="/css/magnific-popup.min.css">
    <!-- LOADER STYLE SHEET -->
    <link rel="stylesheet" type="text/css" href="/css/loader.min.css">    
    <!-- MAIN STYLE SHEET -->
    <link rel="stylesheet" type="text/css" href="/css/style.css">
    <!-- THEME COLOR CHANGE STYLE SHEET -->
    <link rel="stylesheet" class="skin" type="text/css" href="/css/skin/skin-1.css">
    <!-- CUSTOM  STYLE SHEET -->
    <link rel="stylesheet" type="text/css" href="/css/custom.css">
    <!-- SIDE SWITCHER STYLE SHEET -->
    <link rel="stylesheet" type="text/css" href="/css/switcher.css">    

    
    <!-- REVOLUTION SLIDER CSS -->
    <link rel="stylesheet" type="text/css" href="/plugins/revolution/revolution/css/settings.css">
    <!-- REVOLUTION NAVIGATION STYLE -->
    <link rel="stylesheet" type="text/css" href="/plugins/revolution/revolution/css/navigation.css">
    
    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

</head>

<body id="bg">
 
	<div id="app" class="page-wraper"> 
       	
       <!-- Inlcude Head -->
       @include('include.header')
        
        <!-- CONTENT START -->
        <div class="page-content">
        
            @yield('main')                        
             
        </div>
        <!-- CONTENT END -->
        
        <!-- Include Footer -->
        @include('include.footer')

        
        <!-- BUTTON TOP START -->
        <button class="scroltop"><span class=" iconmoon-house relative" id="btn-vibrate"></span>Top</button>
        
    </div>
 

<!-- Include Loading Area -->
@include('include.loading')

 <script src="{{ asset('js/app.js') }}"></script>
<!-- JAVASCRIPT  FILES ========================================= --> 
<script   src="/js/jquery-1.12.4.min.js"></script><!-- JQUERY.MIN JS -->
<script   src="/js/bootstrap.min.js"></script><!-- BOOTSTRAP.MIN JS -->

<script   src="/js/bootstrap-select.min.js"></script><!-- FORM JS -->
<script   src="/js/jquery.bootstrap-touchspin.min.js"></script><!-- FORM JS -->

<script   src="/js/magnific-popup.min.js"></script><!-- MAGNIFIC-POPUP JS -->

<script   src="/js/waypoints.min.js"></script><!-- WAYPOINTS JS -->
<script   src="/js/counterup.min.js"></script><!-- COUNTERUP JS -->
<script   src="/js/waypoints-sticky.min.js"></script><!-- COUNTERUP JS -->

<script  src="/js/isotope.pkgd.min.js"></script><!-- MASONRY  -->

<script   src="/js/owl.carousel.min.js"></script><!-- OWL  SLIDER  -->

<script   src="/js/stellar.min.js"></script><!-- PARALLAX BG IMAGE   --> 
<script   src="/js/scrolla.min.js"></script><!-- ON SCROLL CONTENT ANIMTE   -->

<script   src="/js/custom.js"></script><!-- CUSTOM FUCTIONS  -->
<script   src="/js/shortcode.js"></script><!-- SHORTCODE FUCTIONS  -->
<script   src="/js/switcher.js"></script><!-- SWITCHER FUCTIONS  -->

<!-- REVOLUTION JS FILES -->

<script  src="/plugins/revolution/revolution/js/jquery.themepunch.tools.min.js"></script>
<script  src="/plugins/revolution/revolution/js/jquery.themepunch.revolution.min.js"></script>

<!-- SLIDER REVOLUTION 5.0 EXTENSIONS  (Load Extensions only on Local File Systems !  The following part can be removed on Server for On Demand Loading) -->	
<script  src="/plugins/revolution/revolution/js/extensions/revolution-plugin.js"></script>

<!-- REVOLUTION SLIDER FUNCTION  ===== -->
<script   src="/js/rev-script-1.js"></script>

</body>

</html>