@props([
    'page' => null,
    'setting' => null,
])

@php
    $metaTitle = $page?->meta_title
        ?: $page?->title
        ?: $setting?->site_name
        ?: config('app.name');

    $metaDescription = $page?->meta_description
        ?: $setting?->site_name
        ?: '';

    $metaKeywords = $page?->meta_keywords
        ?: $setting?->site_name
        ?: '';

    $metaImage = !empty($page?->image)
        ? asset(Storage::url($page->image))
        : (
            $setting?->hasMedia('logo')
                ? ($setting->getFirstMediaUrl('logo', 'small') ?: $setting->getFirstMediaUrl('logo'))
                : (
                    $setting?->hasMedia('favicon')
                        ? $setting->getFirstMediaUrl('favicon')
                        : asset('images/default-og-image.jpg')
                )
        );
        
     $schema = [
    "@context" => "https://schema.org",
    "@type" => "EducationalOrganization",
    "name" => $setting?->site_name ?? config('app.name'),
    "url" => url('/'),
    "logo" => $metaImage,
]; 

 
@endphp
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>{{ $metaTitle }}</title>
@if(!empty($setting?->google_site_verification))
<meta name="google-site-verification" content="{{ $setting?->google_site_verification ?? '' }}" />
@endif
<meta name="description" content="{{ $metaDescription }}">

@if(!empty($metaKeywords))
<meta name="keywords" content="{{ $metaKeywords }}">
@endif

<meta name="author" content="{{ $setting?->site_name ?? config('app.name') }}">
<meta name="robots" content="index,follow">
<link rel="canonical" href="{{ url()->current() }}">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="website">
<meta property="og:title" content="{{ $metaTitle }}">
<meta property="og:description" content="{{ $metaDescription }}">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:site_name" content="{{ $setting?->site_name ?? config('app.name') }}">
<meta property="og:image" content="{{ $metaImage }}">

<!-- Twitter -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $metaTitle }}">
<meta name="twitter:description" content="{{ $metaDescription }}">
<meta name="twitter:image" content="{{ $metaImage }}">

<!-- Favicon -->
@if($setting?->hasMedia('favicon'))
<link rel="icon" href="{{ $setting->getFirstMediaUrl('favicon') }}">
@endif

<!-- Apple Touch Icon -->
@if($setting?->hasMedia('favicon'))
<link rel="apple-touch-icon" href="{{ $setting->getFirstMediaUrl('favicon') }}">
@endif

<script type="application/ld+json">
{!! json_encode($schema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}
</script>

@if(!empty($setting?->google_analytic))
{!! $setting?->google_analytic !!}
@endif