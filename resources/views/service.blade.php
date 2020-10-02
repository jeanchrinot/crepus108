@extends('layouts.app')

@section('title','Nos services')

@section('main')

            @include('include.page-banner')
            
            @include('include.breadcrumb')

            <!-- Inlude Service categories -->
             @include('include.service-categories')

@endsection