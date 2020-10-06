        <!-- CONTACT US SECTION END  -->         
			<div class="section-full p-tb80">
                <div class="container equal-wraper no-col-gap">
                  	
                        <!-- TITLE START -->
                        <div class="section-head text-center">
                            <h1><span class="text-primary"> Contactez</span> Nous</h1>
                            <div class="wt-separator-outer ">
                            <div class="wt-separator style-icon">
                                <i class="fa fa-leaf text-black"></i>
                                <span class="separator-left bg-primary"></span>
                                <span class="separator-right bg-primary"></span>
                            </div>                            
                        </div>
                            <p>Pour plus d'information sur nos services et produits, n'hésitez pas a nous contacter.</p>
                        </div>
                        <!-- TITLE END -->   
                                     	      
                        <div class="row conntact-home bg-gray">
                        	<div class="col-md-4 col-sm-6 contact-home-left bg-no-repeat bg-primary bg-left-center"  style="background-image:url(images/background/contact-map.png);">
                            	<div class="section-content">
                                	<div class="p-a50">
                                    	@isset($contact)
                                        <div class="wt-icon-box-wraper left p-b20 text-white">
                                            <span class="icon-lg">
                                                <span class="flaticon-placeholder"></span>
                                            </span>
                                            <div class="icon-content">
                                                <h4 class="m-b5">Adresse</h4>
                                                <span class="font-12">{{ $contact->address }}</span>
                                            </div>
                                        </div>
                                        
                                        <div class="wt-icon-box-wraper left p-b20 text-white">
                                            <span class="icon-lg">
                                                <span class="flaticon-envelope"></span>
                                            </span>
                                            <div class="icon-content">
                                                <h4 class="m-b5">Email</h4>
                                                <span class="font-12">{{ $contact->email ?? '' }} </span><br>
                                                <span class="font-12">{{ $contact->email2 ?? '' }}</span>
                                            </div>
                                        </div>
                                        
                                        <div class="wt-icon-box-wraper left p-b20 text-white">
                                            <span class="icon-lg">
                                                <span class="flaticon-smartphone"></span>
                                            </span>
                                            <div class="icon-content">
                                                <h4 class="m-b5">Téléphone</h4>
                                                <span class="font-12">{{ $contact->phone ?? '' }} </span><br>
                                                <span class="font-12">{{ $contact->phone2 ?? '' }} </span>
                                            </div>
                                        </div>
                                        @endisset

                                        <div class="Opening-hours text-white">
                                            <h3 class="wt-title text-uppercase m-t0">Horaire</h3>
                                            <ul class="list-unstyled">
                                                <li>Lundi - Vendredi <span class="pull-right">9:00 - 17:00</span></li>
                                                <li>Semedi <span class="pull-right">9:00 - 14:00</span></li>
                                                <li>Dimanche <span class="pull-right">Fermé</span></li>
                                            </ul>
                                        </div>
                                            
                                    </div>
                                </div>                               
                            </div>
                            <div class="col-md-8 col-sm-6">
                            	<contact-form></contact-form>
                            </div>
                        </div>
                    
                </div>
                
            </div> 
            <!-- CONTACT US OFFER SECTION END  --> 