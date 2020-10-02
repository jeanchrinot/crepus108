@extends('layouts.app')

@section('title','Conditions de services')

@section('main')
            
            @include('include.breadcrumb')

             <!-- SECTION CONTENT START -->
                <div class="section-full p-t80 p-b50">
                    
                   <div class="container">
                        <!-- TITLE START-->
                        <div class="section-head text-center">
                            <h1 class="text-uppercase">Conditions de services</h1>
                            <div class="wt-separator-outer">
                                <div class="wt-separator style-icon">
                                    <i class="fa fa-leaf text-black"></i>
                                    <span class="separator-left bg-primary"></span>
                                    <span class="separator-right bg-primary"></span>
                                </div>                            
                            </div>
                            <p>Veuillez lire attentivement les conditions d'utilisations de nos services.</p>
                        </div>
                        <!-- TITLE END-->
                        <div class="section-content">


                            <ol type="i" class="m-l15 list-simple">
                                <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</li>
                                <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</li>
                                <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</li>
                                <li>Corem ipsum dolor sit amet</li>
                                <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</li>
                                <li>Eorem ipsum dolor sit amet</li>
                            </ol>

                           <!--  <form class="form-horizontal mb-lg" novalidate>
                                <div class="form-group">
                                    <div class="col-sm-12 col-md-8">
                                        <input name="condition" id="condition" class="form-control" type="checkbox">
                                        <label for="condition">J'ai lu et compris les conditions d'utilisations.</label>
                                    </div>
                                    <div class="col-sm-12 col-md-4">
                                        <button type="button" class="site-button pull-right">Sauvegarder
                                            <i class="fa fa fa-check"></i>
                                        </button>
                                    </div>
                                </div>
                            </form> -->

                        </div>
                    </div> 
                </div> 

@endsection