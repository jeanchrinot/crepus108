@extends('layouts.app')

@section('title')
	Services - {{ $page_banner[1] ?? 'Services' }}
@endsection

@section('main')

            @include('include.page-banner')
            
            @include('include.breadcrumb')

            <!-- Inlude Service categories -->
             @include('include.service-subcategories')

@endsection