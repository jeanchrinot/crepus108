        <!-- PRICING SECTION START  -->
            <div class="section-full bg-white p-t80 p-b120" id="pricing">
                <div class="container">
                    <!-- TITLE START-->
                    <div class="section-head text-center">
                        <h1><span class="text-primary">Nos Services </span>et Tarifs</h1>
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
                    @isset($service_subcategories)
                    <div class="section-content">
                        <div class="owl-carousel our-pricing-carousel owl-btn-vertical-center owl-btn-hover nav nav-tabs">
                    
                            @foreach($service_subcategories as $key => $subcategory)
                            <div class="item {{ $key==0 ? 'active-arrow acive':'' }}">
                                <div data-toggle="tab" data-target="#pricing-item{{ $key+1 }}" class="tab-block">
                                    <div class="our-pricing-tab  radius-sm bdr-1 bdr-gray">
                                        <div class="wt-icon-box-wraper center  p-lr10">
                                        	<div class="icon-lg m-b5">
                                                <span class="icon-cell  text-black"><i class="flaticon-people"></i></span>
                                            </div>
                                            <div class="icon-content">
                                                <span class="wt-tilte text-uppercase p-b10 inline-block font-weight-600">{{ $subcategory->name }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            
                        </div>
                    </div>
                        
                    <div class="tab-content">
                        <!-- Block 1 -->
                        @foreach($service_subcategories as $subkey => $subcategory)
                        <div id="pricing-item{{ $subkey+1 }}" class="pricing-tab-content-block tab-pane {{ $subkey==0 ? 'active active-arrow':'' }}">
                            <div class="section-content p-t50">
                                    <!-- TABS DEFAULT NAV LEFT -->
                                    <div class="wt-tabs vertical bg-tabs">
                                        
                                        <ul class="nav nav-tabs">
                                            @foreach($subcategory->services as $servicekey => $service)
                                            <li class="{{ $servicekey==0 ? 'active':'' }}"><a data-toggle="tab" href="#pricing-tab{{ $subkey+1 }}-{{ $servicekey+1 }}">{{ $service->name }}</a></li>
                                            @endforeach
                                        </ul>
                                        
                                        <div class="tab-content p-l50">
                                            @foreach($subcategory->services as $servicekey => $service)
                                            <div id="pricing-tab{{ $subkey+1 }}-{{ $servicekey+1 }}" class="tab-pane {{ $servicekey==0 ? 'active':'' }}">
                                                <div class="pricing-tab-inner">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="wt-media">
                                                                <img src="images/our-services/large/s1.jpg" alt="">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="wt-tilte">
                                                                <h3 class="font-26 p-b20 font-weight-400">{{ $service->name }}</h3>
                                                                <div style="display: flex;">
                                                                    <h4 class="text-primary" style="margin-right: 40px;">Ar {{ $service->price }}</h4>
                                                                    <h4 class="text-primary">{{ $service->duration }} min.</h4>
                                                                </div>
                                                                <p>{{ $service->details }}
                                                                </p>
                                                                <a href="{{ route('service.reservation',['service'=>$service->id]) }}" class="site-button skew-icon-btn radius-sm">
                                                                  <span class="font-weight-700 inline-block text-uppercase p-lr15">Réserver</span> 
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                            
                                        </div>
                                    </div>
                                </div>
                        </div>
                        @endforeach
                        
                    </div>
                    @endisset
                    
                </div>
            </div>
            <!-- PRICING SECTION END  -->   