@extends('frontend.layout.master')
@section('content')

  <!-- MAIN CONTENT START -->
            <section class="flat-title-page">
                <div class="row">
                    <div class="container">
                        <div class="flat-img-with-text style-3 bg-primary-new">
                            <div class="content-left img-animation wow animated animated animated animated animated animated"
                                style="visibility: visible;">
                                <h1 class="hub-directors text-white">strtoupper({{$page->title}})</h1>
                                <img class="lazyload" src="{{asset('frontend/images/banner/recource.png')}}" alt="">
                            </div>
                            <div class="content-right">

                                    <div class="professional-category-grid-wrapper">
                                        <div class="professional-grid-container">
                                            <!-- Top Row - Dark Theme -->
                                            <a href="{{route('frontend.corporatelaws')}}"
                                                class="professional-grid-item corporate-laws-item">
                                                <div class="professional-item-content">
                                                    <i class="fas fa-gavel professional-item-icon"></i>
                                                    <div class="professional-item-title">
                                                        Corporate<br>Laws</div>
                                                </div>
                                            </a>

                                            <a href="{{route('frontend.sectorspecificlaws')}}" class="professional-grid-item sector-laws-item">
                                                <div class="professional-item-content">
                                                    <i class="fas fa-industry professional-item-icon"></i>
                                                    <div class="professional-item-title">
                                                        Sector<br>Specific Laws</div>
                                                </div>
                                            </a>

                                            <a href="{{route('frontend.soesgovernmententities')}}"
                                                class="professional-grid-item government-entities-item">
                                                <div class="professional-item-content">
                                                    <i class="fas fa-landmark professional-item-icon"></i>
                                                    <div class="professional-item-title">
                                                        SOEs/<br>Government<br>entities</div>
                                                </div>
                                            </a>

                                            <!-- Second Row - Light Green Theme -->
                                            <a href="{{route('frontend.picgquorum')}}" class="professional-grid-item picg-quorum-item">
                                                <div class="professional-item-content">
                                                    <i class="fas fa-users professional-item-icon"></i>
                                                    <div class="professional-item-title">PICG Quorum
                                                    </div>
                                                </div>
                                            </a>

                                            <a href="{{route('frontend.picgthoughtleadership')}}"
                                                class="professional-grid-item thought-leadership-item">
                                                <div class="professional-item-content">
                                                    <i class="fas fa-lightbulb professional-item-icon"></i>
                                                    <div class="professional-item-title">PICG
                                                        Thought<br>Leadership</div>
                                                </div>
                                            </a>

                                            <a href="{{route('frontend.oecd')}}" class="professional-grid-item oecd-item">
                                                <div class="professional-item-content">
                                                    <i class="fas fa-globe professional-item-icon"></i>
                                                    <div class="professional-item-title">OECD</div>
                                                </div>
                                            </a>

                                            <!-- Third Row - Medium Green Theme -->
                                            <a href="{{route('frontend.report')}}" class="professional-grid-item reports-item">
                                                <div class="professional-item-content">
                                                    <i class="fas fa-file-alt professional-item-icon"></i>
                                                    <div class="professional-item-title">Reports</div>
                                                </div>
                                            </a>

                                            <a href="{{route('frontend.bestpractices')}}"
                                                class="professional-grid-item best-practices-item">
                                                <div class="professional-item-content">
                                                    <i class="fas fa-star professional-item-icon"></i>
                                                    <div class="professional-item-title">Best Practices
                                                    </div>
                                                </div>
                                            </a>

                                            <a href="{{route('frontend.aicybersecurity')}}"
                                                class="professional-grid-item ai-cybersecurity-item">
                                                <div class="professional-item-content">
                                                    <i class="fas fa-shield-alt professional-item-icon"></i>
                                                    <div class="professional-item-title">AI
                                                        &amp;<br>Cybersecurity</div>
                                                </div>
                                            </a>

                                            <!-- Bottom Row - Dark Green Theme -->
                                            <a href="{{route('frontend.esg')}}" class="professional-grid-item esg-item">
                                                <div class="professional-item-content">
                                                    <i class="fas fa-leaf professional-item-icon"></i>
                                                    <div class="professional-item-title">ESG</div>
                                                </div>
                                            </a>

                                            <a href="{{route('frontend.sustainably')}}" class="professional-grid-item sustainably-item">
                                                <div class="professional-item-content">
                                                    <i class="fas fa-recycle professional-item-icon"></i>
                                                    <div class="professional-item-title">Sustainably
                                                    </div>
                                                </div>
                                            </a>

                                            <a href="{{route('frontend.reportingstandards')}}"
                                                class="professional-grid-item reporting-standards-item">
                                                <div class="professional-item-content">
                                                    <i class="fas fa-chart-bar professional-item-icon"></i>
                                                    <div class="professional-item-title">
                                                        Reporting<br>Standards</div>
                                                </div>
                                            </a>

                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- MAIN CONTENT END -->

@endsection