@extends('frontend.layout.master')
@section('content')

  <!-- MAIN CONTENT START -->
            <section class="flat-title-page">
                <div class="row">
                    <div class="container">
                        <div class="flat-img-with-text style-3 bg-primary-new">
                            <div class="content-left img-animation wow animated animated animated animated animated animated"
                                style="visibility: visible;">
                                <h1 class="hub-directors text-white">{{  strtoupper($page->title)}}</h1>
                                <img class="lazyload" src="{{asset('frontend/images/banner/recource.png')}}" alt="">
                            </div>
                            <div class="content-right">

                                    <div class="professional-category-grid-wrapper">
                                        <div class="professional-grid-container">
                                        @php
                                            $colors = [
                                                ['#3e4a5e', '#4b596f', '#56657a'], // Row 1 (Dark Blue)
                                                ['#58b87a', '#60c38a', '#6ccc95'], // Row 2 (Light Green)
                                                ['#4db6ac', '#4fc3b4', '#55d0bf'], // Row 3 (Teal)
                                                ['#2e8b57', '#2f9e66', '#36a96e'], // Row 4 (Dark Green)
                                            ];
                                        @endphp
                                        @foreach($page->sections as $index => $section)
                                        @php
                                            $row = floor($index / 3); // 3 items per row
                                            $col = $index % 3;

                                            $rowColor = $colors[$row % count($colors)];
                                            $bgColor = $rowColor[$col % count($rowColor)];
                                        @endphp
                                            <a href="{{ route('frontend.section.show', $section->slug) }}"
                                            class="professional-grid-item d-block text-center text-white"style="background: {{ $bgColor }}; padding:40px 20px; transition:.3s;">

                                                <div class="professional-item-content">
                                                    <i class="{{ $section->icon ?? 'fa-solid fa-folder' }} professional-item-icon"></i>

                                                    <div class="professional-item-title">
                                                        {!! nl2br(e(wordwrap($section->heading, 12, "\n", true))) !!}
                                                    </div>
                                                </div>

                                            </a>
                                        @endforeach
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- MAIN CONTENT END -->

@endsection