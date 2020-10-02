 <!-- HEADER START -->
        <header class="site-header header-style-1 ">
        
            <div class="top-bar">
                <div class="container">
                    <div class="row">
                    	<div class="wt-topbar-left clearfix">
                            @isset($header_contact)
                        	<ul class="list-unstyled e-p-bx pull-right">
                                <li class="email"><a href="mailto:{{ $header_contact->email ?? '' }}"><i class="fa fa-envelope"></i>{{ $header_contact->email ?? '' }}</a></li>
                                <li><a href="tel:{{ $header_contact->phone }}"><i class="fa fa-phone"></i>{{ $header_contact->phone ?? '' }}</a></li>
                            </ul>
                            @endisset
                        </div>
                        <div class="wt-topbar-right clearfix">
                            @isset($social)
                        	<ul class="social-bx list-inline pull-right">
                                <li><a href="{{ $social->facebook ?? '#' }}" class="fa fa-facebook"></a></li>
                                <li><a href="{{ $social->linkedin ?? '#' }}" class="fa fa-linkedin"></a></li>
                                <li><a href="{{ $social->youtube ?? '#' }}" class="fa fa-youtube"></a></li>
                                <li><a href="{{ $social->instagram ?? '#' }}" class="fa fa-instagram"></a></li>
                            </ul>
                            @endisset
                        </div>
                    </div>
                </div>
            </div>
            <!-- Search Link -->

<!-- Search Form -->

            <div class="sticky-header main-bar-wraper">
                <div class="main-bar bg-white">
                    <div class="container">
                        <div class="logo-header">
                            <a href="{{ route('home') }}">
                                <img src="/images/Crepus108-NoBG-small.png" width="216" height="37" alt="" />
                            </a>
                        </div>
                        <!-- NAV Toggle Button -->
                        <button data-target=".header-nav" data-toggle="collapse" type="button" class="navbar-toggle collapsed">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <!-- ETRA Nav -->
                        <!-- <div class="extra-nav">
                            <div class="extra-cell">
                                <a href="#search" class="site-search-btn"><i class="fa fa-search"></i></a>
                            </div>
                            <div class="extra-cell">
                                <a href="javascript:;" class="wt-cart cart-btn" title="Your Cart">
                                    <span class="link-inner">
                                        <span class="woo-cart-total"> </span>
                                        <span class="woo-cart-count">
                                            <span class="shopping-bag wcmenucart-count ">4</span>
                                        </span>
                                    </span>
                                </a>
                                
                                  <div class="cart-dropdown-item-wraper clearfix">
                                    <div class="nav-cart-content">
                                        
                                        <div class="nav-cart-items p-a15">
                                            <div class="nav-cart-item clearfix">
                                                <div class="nav-cart-item-image">
                                                    <a href="#"><img src="images/cart/pic-1.jpg" alt="p-1"></a>
                                                </div>
                                                <div class="nav-cart-item-desc">
                                                    <a href="#">Item one</a>
                                                    <span class="nav-cart-item-price"><strong>2</strong> x $19.99</span>
                                                    <a href="#" class="nav-cart-item-quantity">x</a>
                                                </div>
                                            </div>
                                            <div class="nav-cart-item clearfix">
                                                <div class="nav-cart-item-image">
                                                    <a href="#"><img src="images/cart/pic-2.jpg" alt="p-2"></a>
                                                </div>
                                                <div class="nav-cart-item-desc">
                                                    <a href="#">Item Two</a>
                                                    <span class="nav-cart-item-price"><strong>1</strong> x $24.99</span>
                                                    <a href="#" class="nav-cart-item-quantity">x</a>
                                                </div>
                                            </div>
                                            <div class="nav-cart-item clearfix">
                                                <div class="nav-cart-item-image">
                                                    <a href="#"><img src="images/cart/pic-3.jpg" alt="p-1"></a>
                                                </div>
                                                <div class="nav-cart-item-desc">
                                                    <a href="#">Item Three</a>
                                                    <span class="nav-cart-item-price"><strong>2</strong> x $19.99</span>
                                                    <a href="#" class="nav-cart-item-quantity">x</a>
                                                </div>
                                            </div>
                                            <div class="nav-cart-item clearfix">
                                                <div class="nav-cart-item-image">
                                                    <a href="#"><img src="images/cart/pic-4.jpg" alt="p-2"></a>
                                                </div>
                                                <div class="nav-cart-item-desc">
                                                    <a href="#">Item Four</a>
                                                    <span class="nav-cart-item-price"><strong>1</strong> x $24.99</span>
                                                    <a href="#" class="nav-cart-item-quantity">x</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="nav-cart-title p-tb10 p-lr15 clearfix">
                                            <h4  class="pull-left m-a0">Subtotal:</h4>
                                            <h5 class="pull-right m-a0">$114.95</h5>
                                        </div>
                                        <div class="nav-cart-action p-a15 clearfix">
                                            <button class="site-button  btn-block m-b15 " type="button">View Cart</button>
                                            <button class="site-button  btn-block" type="button">Checkout </button>
                                        </div>
                                    </div>
                                  </div>
                                
                            </div>
                         </div> -->
                        <!-- SITE Search -->
                        <!-- <div id="search"> 
                            <span class="close"></span>
                            <form role="search" id="searchform" action="http://thewebmax.com/search" method="get" class="radius-xl">
                                <div class="input-group">
                                    <input value="" name="q" type="search" placeholder="Type to search"/>
                                    <span class="input-group-btn"><button type="button" class="search-btn"><i class="fa fa-search"></i></button></span>
                                </div>   
                            </form>
                        </div> -->
                        
                        <!-- MAIN Vav -->
                        <div class="header-nav navbar-collapse collapse ">
                            <ul class=" nav navbar-nav">
                                <li class="active">
                                    <a href="{{ route('home') }}">Accueil</a>
                                </li>
                            
                                <li>
                                    <a href="{{ route('service.index') }}">Services<i class="fa fa-chevron-down"></i></a>
                                    @isset($menu_service_categories)
                                    <ul class="sub-menu">
                                        @foreach($menu_service_categories as $category)
                                        <li>
                                            <a href="{{ route('service.single',['slug'=>$category->slug]) }}">{{ $category->name }}</a>
                                            <!-- <ul class="sub-menu">
                                                <li><a href="#">Tresse sans rajouts</a></li>
                                                <li><a href="#">Tresse avec rajouts</a></li>
                                            </ul> -->
                                        </li>
                                        @endforeach
                                    </ul>
                                    @endisset
                                </li>
                                
                                <!-- <li>
                                    <a href="javascript:;">Shop</a>
                                </li> -->
                                <li>
                                    <a href="{{ route('service.reservation') }}">Réservation</a>
                                </li>
                                <li>
                                    <a href="{{ route('contact.index') }}">Contact</a>
                                </li>
                            
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            
        </header>
        <!-- HEADER END -->