        <!-- OUR TESTIMONIAL SECTION START  -->
            <div class="section-full bg-gray bg-repeat p-t80 p-b120" style="background-image:url(images/background/bg-6.jpg);">
            	<div class="container">
                    <!-- TITLE START-->
                    <div class="section-head text-center">
                        <h1><span class="text-primary">Ce que disent</span> nos clients</h1>
                        <div class="wt-separator-outer ">
                            <div class="wt-separator style-icon">
                                <i class="fa fa-leaf text-black"></i>
                                <span class="separator-left bg-primary"></span>
                                <span class="separator-right bg-primary"></span>
                            </div>                            
                        </div>
                        <p>Nos clients expriment leur avis sur la qualité de nos services.</p>
                    </div>
                    <!-- TITLE END-->
                    <div class="section-content">
                        @isset($testimonials)
                        <div class="owl-carousel home-carousel-1">
                            @foreach($testimonials as $key => $testimonial)
                            <div class="item">
                                <div class="testimonial-5 bg-white radius-sm">
                                	<div class="testimonial-pic-block radius-bx"> 
                                    	<div class="testimonial-pic radius">
                                        	<img src="{{ getUserImage($testimonial->image) }}" width="132" height="132" alt="">
                                        </div>
                                    </div>
                                    <div class="testimonial-text clearfix">
                                        <div class="testimonial-paragraph">
                                            <span class="fa fa-quote-left text-primary"></span>
                                            <p>{{ $testimonial->quote }}
                                            </p>
                                        </div>
                                        <div class="testimonial-detail clearfix">
                                            <strong class="testimonial-name">{{ $testimonial->name }}</strong>
                                            <span class="testimonial-position text-primary p-t10">{{ $testimonial->title }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                          @endforeach
                        </div>
                        @endisset
                    </div>
                </div>
            </div>
            <!-- OUR TESTIMONIAL SECTION END  --> 