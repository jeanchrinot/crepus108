@extends('layouts.app')

@section('title','Accueil')

@section('main')

            <!-- Inlude Slider -->
             @include('include.slider')
            
            <!-- Include Welcome section -->
            @include('include.welcome')

            <!--  Inlude Our Services -->                       
           
            
            <!-- Inlude Pricing -->
            @include('include.pricing')
                                
            <!--  Incldue Company Status -->
                        
            <!-- include Our Experts -->  
            
            <!-- include Special offers -->
            
            
            <!-- include galleries -->
            
            <!-- include Pricing Table -->
                       
            <!-- include our products -->
            
                    
            <!-- include testimonial -->
            @include('include.testimonials')
            
            <!-- include contact us -->
            @include('include.contactus')
                       
            @include('include.ourclientslider')

@endsection