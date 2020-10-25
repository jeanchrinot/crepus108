@extends('layouts.app')

@section('title','Conditions de services')

@section('main')
            
            @include('include.breadcrumb')

             <!-- SECTION CONTENT START -->
                <div class="section-full p-t80 p-b50">
                    
                   <div class="container">
                        <!-- TITLE START-->
                        <div class="section-head text-center">
                            <h1 class="text-uppercase">{{ $condition->title ?? 'Conditions de Services' }}</h1>
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
                        <div class="section-content section-content--centered section-content--terms">

                            <div class="wrapper wrapper--medium">
                                {!! $condition->conditions ?? '' !!}
                            </div>

                        </div>
                    </div> 
                </div> 

@endsection