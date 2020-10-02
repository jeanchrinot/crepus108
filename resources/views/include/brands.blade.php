        <!-- OUR CLIENT SLIDER START -->
            <div class="section-full p-t80 p-b50 bg-repeat" style="background-image:url(images/background/bg-6.jpg);">
                <div class="container">
                
                	<!-- TITLE START -->
                    <div class="section-head text-center">
                        <h1><span class="text-primary"> Nos</span> Marques</h1>
                        <div class="wt-separator-outer ">
                            <div class="wt-separator style-icon">
                                <i class="fa fa-leaf text-black"></i>
                                <span class="separator-left bg-primary"></span>
                                <span class="separator-right bg-primary"></span>
                            </div>                            
                        </div>
                        <p>Les marques des produits que nous utilisons et vendons.</p>
                    </div>
                    <!-- TITLE END -->
                    
                    <!-- IMAGE CAROUSEL START -->
                    <div class="section-content">
                        @isset($brands)
                        <div class="owl-carousel client-logo-carousel">
                        
                        	@foreach($brands as $key => $brand)
                            <div class="item">
                                <div class="ow-client-logo">
                                    <div class="client-logo wt-img-effect on-color">
                                        <a href="javascript:;"><img src="images/client-logo/{{ $brand->logo }}" alt="{{ $brand->name }}"></a>
                                    </div>
                                </div>
                            </div>                      
                            @endforeach
                        </div>
                        @endisset
                    </div>
                    <!-- IMAGE CAROUSEL START -->
                </div>
            </div>
            <!-- OUR CLIENT SLIDER END --> 