@extends('layouts.app')

@section('title','Service - Tresses')

@section('main')

            @include('include.page-banner')
            
            @include('include.breadcrumb')

            <!-- Inlude Service categories -->
             @include('include.service-subcategories')

@endsection