    <!-- SECTION CONTENT START -->
        <div class="section-full p-t80 p-b50">
            
           <div class="container">
                <!-- TITLE START-->
                <div class="section-head text-center">
                    <h1 class="text-uppercase">Nos services</h1>
                    <div class="wt-separator-outer">
                        <div class="wt-separator style-icon">
                            <i class="fa fa-leaf text-black"></i>
                            <span class="separator-left bg-primary"></span>
                            <span class="separator-right bg-primary"></span>
                        </div>                            
                    </div>
                    <p>Choisissez un service qui correspond à votre besoin et faites votre réservation maintenant.</p>
                </div>
                <!-- TITLE END-->
                <div class="section-content">

                <!-- GELLERY CONTENT -->
                <div class="container-fluid">
                    <div class="row">
                        <div class="portfolio-wrap mfp-gallery no-col-gap">
                        
                            @isset($service_categories)
                            @foreach($service_categories as $category)
                            <div class="masonry-item cat-1 col-lg-6 col-md-6 col-sm-6">
                                <div class="wt-box p-a15">
                                    <div class="wt-thum-bx wt-img-effect zoom">
                                        <img src="images/portfolio/pic1.jpg" alt="">
                                        <div class="wt-info-has p-a20 bg-white ">
                                            <div class="wt-info p-b10">
                                                <h4 class="m-a0">{{ $category->name }}</h4>
                                            </div>
                                            <div class="wt-info-has-text">{{ $category->details }}</div>
                                            <a href="{{ route('service.single',['slug'=>$category->slug]) }}" class="site-button   ">Voir  <i class="fa fa-angle-double-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @endisset
                        </div>
                        @isset($service_categories) <div class="pagination-div text-left">{{ $service_categories->appends(request()->input())->links() }}</div> @endisset
                    </div>
                </div>
                <!-- GELLERY END -->
                
            </div>
        </div>

    </div>
    <!-- SECTION CONTENT END  -->