    <!-- FOOTER START -->
        <footer class="site-footer footer-light">
            <!-- COLL-TO ACTION START -->
            <div class="section-full overlay-wraper bg-primary" style="background-image:url(/images/background/bg-7.png);">
            	
                <div class="section-content ">
                <!-- COLL-TO ACTION START -->
                	<div class="wt-subscribe-box">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-8 col-sm-8">
                                    <div class="call-to-action-left p-tb20 p-r50">
                                        <h4 class="text-uppercase m-b10">Vous avez des questions ?</h4>
                                        <p> N'hésitez pas a nous contacter et prendre des informations supplémentaires.</p>
                                    </div>
                                </div>
                                
                                <div class="col-md-3">
                                    <div class="call-to-action-right p-tb30">
                                        <a href="{{ route('contact.index') }}" class="site-button-secondry text-uppercase radius-sm font-weight-600">
                                            Contactez-nous
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            
            <!-- FOOTER BLOCKES START -->  
            <div class="footer-top overlay-wraper">
                <div class="overlay-main"></div>
                <div class="container">
                    <div class="row">
                        <!-- ABOUT COMPANY -->
                        <div class="col-md-4 col-sm-12">  
                            <div class="widget widget_about">
                                <h4 class="widget-title">A propos de nous</h4>
                                <div class="logo-footer clearfix p-b15">
                                    <a href="{{ route('home') }}"><img src="/images/crepus108-NoBG-small.png" width="230" height="67" alt=""/></a>
                                </div>
                                <p>{{ $about->about_short ?? '' }} </p>  
                            </div>
                        </div>      
                        <!-- USEFUL LINKS -->
                        <div class="col-md-4 col-sm-12">
                            <div class="widget widget_services">
                                <h4 class="widget-title">Liens rapides</h4>
                                <ul>
                                    <li><a href="{{ route('service.index') }}">Services</a></li>
                                    <li><a href="{{ route('service.reservation') }}">Réservation</a></li>
                                    <li><a href="#">Galerie Photos</a></li>
                                    <li><a href="#">Galerie Vidéos</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- NEWSLETTER -->
                        <div class="col-md-4 col-sm-12">
                            <div class="widget widget_newsletter">
                                <h4 class="widget-title">Newsletter</h4>
                                <newsletter-form></newsletter-form>
                            </div>
                            <!-- SOCIAL LINKS -->
                            <div class="widget widget_social_inks">
                                <h4 class="widget-title">Suivez-nous</h4>
                                @isset($social)
                                <ul class="social-icons social-square social-darkest">
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
            </div>
            <!-- FOOTER COPYRIGHT -->
            <div class="footer-bottom overlay-wraper">
                <div class="overlay-main"></div>
                <div class="constrot-strip"></div>
                <div class="container p-t30">
                    <div class="row">
                        <div class="wt-footer-bot-left">
                            <span class="copyrights-text">© 2020 Crépus 108. Tous droits reservés. By MAKIBOOM.</span>
                        </div>
                        <div class="wt-footer-bot-right">
                            <ul class="copyrights-nav pull-right"> 
                                <li><a href="{{ route('service.condition') }}">Conditions</a></li>
                                <li><a href="{{ route('contact.index') }}">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- FOOTER END -->