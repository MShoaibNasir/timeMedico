@extends('frontend.layout.master')
@section('metadata')
<x-frontend.seo-meta :page="$page" :setting="$setting" />
@endsection
@section('content')
<main class="main {{$page->slug}}" id="page-{{$page->id}}">

@if(isset($page->title))
<!-- breadcrumb -->
<div class="site-breadcrumb">
    <div class="site-breadcrumb-bg" style="background: url({{ !empty($page->image) ? asset(Storage::url($page->image)) : asset('frontend/images/about-01.jpg') }})"></div>
    <div class="container">
        <div class="site-breadcrumb-wrap">
            <h4 class="breadcrumb-title">{{-- $page->banner_title ?? '' --}}{{ $page->title }}</h4>
            <ul class="breadcrumb-menu">
                <li><a href="home"><i class="far fa-home"></i> Home</a></li>
                <li class="active">{{ $page->title }}</li>
            </ul>
        </div>
    </div>
</div>
<!-- breadcrumb end -->

@if(isset($page->description))
@php $desc = trim($page->description ?? ''); @endphp
@if ($desc === '' || $desc === '.' || $desc === 'no' || $desc === 'null'|| $desc === 'none')
@else
<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
{!! $page->description ?? '' !!}
            </div></div></div></section>
@endif
@endif
@endif

</main>
@endsection

@push('styles')
@endpush

@push('script')
@endpush