@extends('layouts.app')

@section('title','Réservation en ligne')

@section('main')
            
            @include('include.breadcrumb')

             <!-- SECTION CONTENT START -->
                <div class="section-full p-t80 p-b50">
                    
                   <div class="container">
                        <!-- TITLE START-->
                        <div class="section-head text-center">
                            <h1 class="text-uppercase">Réservation en ligne</h1>
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

                            @php

                              $all_services = getAllServices();

                              if(!empty($all_services)){
                                $all_services = json_encode($all_services);
                              }
                              else{
                                $all_services = '';
                              }
                              
                            @endphp

                            <reservation-form :services="{{ $all_services }}"></reservation-form>

                        </div>
                    </div> 
                </div> 

@endsection