@extends('frontend.layout.master')
@section('content')


<style>
    @media print {
        .main-header {
            display: none !important;
        }

        footer.footer {
            display: none;
        }

        .cv-generator {
            display: none;
        }

        .progress-wrap.active-progress {
            display: none;
        }
        
    }
</style>

@php
    $image=$user->profile_picture;
@endphp
<!--  Profile Form Start  -->
<section class="flat-title-page">
<div class="flat-section-v5">

    <div class="nexus-container">
        <!-- Profile Header / Banner Section -->
        <header class="nexus-profile-header">
            <div class="nexus-header-content">
                @if(isset($image))
                 <img src="{{ asset('storage/' . $image) }}" alt="Profile Picture" class="nexus-profile-picture">
                @else
                <img src="{{ asset('storage/uploads/general/media/profile/images.jpeg') }}" alt="Profile Picture" class="nexus-profile-picture">
                @endif
                <h1 class="nexus-profile-name text-white">{{Auth::guard('web')->user()->name}}</h1>
                <p class="nexus-profile-bio">
                    {{Auth::guard('web')->user()->residential_address ?? '--'}}
                </p>
                <div class="nexus-social-links">
                    <a href="{{$user->bioProfile->linkedin_url ?? '#'}}" target="_blank" aria-label="LinkedIn"><i class="fab fa-linkedin"></i></a>
                    <a href="{{$user->bioProfile->facebook_url ?? '#'}}" target="_blank" aria-label="GitHub"><i class="fab fa-facebook"></i></a>
                    <a href="{{$user->bioProfile->twitter_url ?? '#'}}" target="_blank" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                    <a href="{{$user->bioProfile->website_url ?? '#'}}" target="_blank" aria-label="Website"><i class="fas fa-globe"></i></a>
                </div>
            </div>
        </header>

        <div class="row">
            <div class="col-lg-8">
                <!-- About Section -->
                <section class="nexus-section-card">
                    <h2 class="nexus-section-title">
                        <div class="nexus-section-icon"><i class="fas fa-info-circle"></i></div>
                        About Me
                    </h2>
                    <p class="desc text-variant-1">
                        {{$user->bioProfile->bio_summary ?? 'No Data Found'}}
                    </p>
                </section>

                <!-- Experience Section -->
                <section class="nexus-section-card">
                    <h2 class="nexus-section-title">
                        <div class="nexus-section-icon"><i class="fas fa-briefcase"></i></div>
                        Experience
                    </h2>
                    @if(count($user->experience) > 0)
                    @foreach($user->experience as $item)
                    <div class="nexus-item">
                        <h3 class="nexus-item-title">{{$item->job_title ?? '--'}}</h3>
                        <p class="nexus-item-subtitle">{{$item->organization_name ?? '--'}}</p>
                        <p class="nexus-item-meta">
                            {{ $item->start_date ? date('M d, Y', strtotime($item->start_date)) : '--' }} –
                            {{ $item->end_date ? date('M d, Y', strtotime($item->end_date)) : '--' }}
                        </p>
                        <p class="nexus-item-meta">{{$item->country ?? '--'}}</p>
                        <p class="desc text-variant-1">
                            {{$item->job_description ?? '--'}}
                        </p>
                    </div>
                    <hr>
                    @endforeach
                    @else
                    <p class="desc text-variant-1">No Data Found</p>
                    @endif
                </section>
                <section class="nexus-section-card">
                    <h2 class="nexus-section-title">
                        <div class="nexus-section-icon"><i class="fas fas fa-chalkboard"></i></div>
                        Directorships / Board Memberships
                    </h2>
                    @if(count($user->directorship) > 0)
                    @foreach($user->directorship as $item)
                    <div class="nexus-item">
                        <h3 class="nexus-item-title">{{$item->organization_name ?? '--'}}</h3>
                        <p class="nexus-item-subtitle">{{$item->Sector ?? '--'}}</p>
                        <p class="nexus-item-subtitle">{{$item->designation ?? '--'}}</p>
                        <p class="nexus-item-subtitle">{{$item->executive ?? '--'}}</p>
                        <p class="nexus-item-meta">{{ $item->start_date ? date('M d, Y', strtotime($item->start_date)) : '--' }} – {{ $item->end_date ? date('M d, Y', strtotime($item->end_date)) : '--' }}
                        </p>

                    </div>
                    <hr>
                    @endforeach
                    @else
                    <p class="desc text-variant-1">No Data Found</p>
                    @endif
                </section>
                <section class="nexus-section-card">
                    <h2 class="nexus-section-title">
                        <div class="nexus-section-icon"><i class="fas fa-users-cog"></i></div>
                        Board Committee Memberships
                    </h2>

                    @if(count($user->boardComiittee) > 0)
                    @foreach($user->boardComiittee as $item)
                    <div class="nexus-item">
                        <h3 class="nexus-item-title">{{$item->organization_name ?? '--'}}</h3>
                        <p class="nexus-item-subtitle">{{$item->Sector ?? '--'}}</p>
                        <p class="nexus-item-subtitle">{{$item->committee_name ?? '--'}}</p>
                        <p class="nexus-item-subtitle">{{$item->designation ?? '--'}}</p>
                        <p class="nexus-item-meta">
                            {{ date('M d, Y', strtotime($item->start_date)) }} – {{ date('M d, Y', strtotime($item->end_date)) }}
                        </p>

                    </div>
                    <hr>
                    @endforeach
                    @else
                    <p class="desc text-variant-1">No Data Found</p>
                    @endif

                </section>
                <section class="nexus-section-card">
                    <h2 class="nexus-section-title">
                        <div class="nexus-section-icon"><i class="fas fa-certificate"></i></div>
                        Additional Certificate

                    </h2>
                    @if(count($user->additionCertificate) > 0)
                    @foreach($user->additionCertificate as $item)
                    <div class="nexus-item">
                        <h3 class="nexus-item-title">{{$item->certificate_title ?? '--'}}</h3>
                        <p class="nexus-item-subtitle">{{$item->skills ?? '--'}}</p>
                        <p class="nexus-item-subtitle">{{$item->issuing_organization ?? '--'}}</p>
                        <p class="nexus-item-meta">{{ $item->issue_date ? date('M d, Y', strtotime($item->issue_date)) : '--' }}</p>

                    </div>
                    <hr>
                    @endforeach
                    @else
                    <p class="desc text-variant-1">No Data Found</p>
                    @endif
                </section>

                <section class="nexus-section-card">
                    <h2 class="nexus-section-title">
                        <div class="nexus-section-icon"><i class="fas fas fa-newspaper"></i></div>
                        Publications
                    </h2>
                    @if(count($user->Publications) > 0)
                    @foreach($user->Publications as $item)
                    <div class="nexus-item">
                        <h3 class="nexus-item-title">{{$item->title ?? '--'}}</h3>
                        <h6 class="nexus-item-title">Published On:{{ $item->published_date ? date('M d, Y', strtotime($item->published_date)) : '--' }}</h6>
                        <h6 class="nexus-item-title">Published Type:{{ $item->publication_type ? $item->publication_type : '--' }}</h6>
                        <p class="nexus-item-subtitle">{{$item->topics ?? '--'}}</p>
                        <p class="nexus-item-subtitle">{{$item->publisher_name ?? '--'}}</p>
                        <p class="nexus-item-subtitle">
                            <a href="{{ $item->url }}" target="_blank">{{ $item->url }}</a>
                        </p>
                        <p class="nexus-item-subtitle">{{$item->description ?? '--'}}</p>
                    </div>
                    <hr>
                    @endforeach
                    @else
                    <p class="desc text-variant-1">No Data Found</p>
                    @endif
                </section>
                <section class="nexus-section-card">
                    <h2 class="nexus-section-title">

                        <div class="nexus-section-icon"><i class="fas fas fa-trophy"></i></div>
                        Awards
                    </h2>
                    @if(count($user->award) > 0)
                    @foreach($user->award as $item)
                    <div class="nexus-item">
                        <h3 class="nexus-item-title">{{$item->title ?? '--'}}</h3>
                        <p class="nexus-item-subtitle">{{$item->organization ?? '--'}}</p>
                        <p class="nexus-item-subtitle">{{$item->evaluation_period ?? '--'}}</p>
                        <p class="nexus-item-subtitle">{{$item->comments ?? '--'}}</p>
                    </div>
                    <hr>
                    @endforeach
                    @else
                    <p class="desc text-variant-1">No Data Found</p>
                    @endif
                </section>

                <!-- Education Section -->
                <section class="nexus-section-card education-section">
                    <h2 class="nexus-section-title">
                        <div class="nexus-section-icon"><i class="fas fa-graduation-cap"></i></div>
                        Education
                    </h2>

                    @if(count($user->education) > 0)
                    @foreach($user->education as $item)
                    <div class="nexus-item edu-card">
                        <div class="edu-header">
                            <h3 class="nexus-item-title">{{$item->degree_title ?? '--'}}</h3>
                            <span class="edu-date">
                                {{ $item->start_date ? date('M d, Y', strtotime($item->start_date)) : '--' }}
                                –
                                {{ $item->end_date ? date('M d, Y', strtotime($item->end_date)) : 'Present' }}
                            </span>
                        </div>

                        <p class="nexus-item-subtitle">{{$item->institute_name ?? '--'}}</p>

                        <p class="edu-meta">
                            <i class="fas fa-map-marker-alt"></i>
                            {{$item->edu_country ?? '--' }}
                        </p>

                        <h5 class="majors-title">Majors</h5>
                        <p class="desc text-variant-1">
                            {{ $item->majors ?? '—' }}
                        </p>
                    </div>
                    @endforeach
                    @else
                    <p class="desc text-variant-1">No Data Found</p>
                    @endif
                </section>

                <a class="btn btn-success cv-generator" href="{{ route('cv.downloadCV') }}">Generate CV</a>


            </div>


            <div class="col-lg-4">
                <!-- Skills Section -->
                <section class="nexus-section-card">
                    <h2 class="nexus-section-title">
                        <div class="nexus-section-icon"><i class="fas fa-cogs"></i></div>
                        Skills
                    </h2>
                    @if(count($user->Userskill) > 0)
                    <div class="nexus-skill-tag-container">
                        @foreach($user->Userskill as $item)
                        <div class="nexus-skill-tag">{{$item->name}} <span
                                class="nexus-proficiency-stars">@for($i=0; $i<$item->skill_proficiency; $i++) ★ @endfor <span></div>
                        @endforeach
                    </div>
                    @else
                    <div class="nexus-skill-tag-container">No Skills Available!</diV>
                    @endif
                </section>

                <!-- Contact Information (Example) -->
                <section class="nexus-section-card">
                    <h2 class="nexus-section-title">
                        <div class="nexus-section-icon"><i class="fas fa-envelope"></i></div>
                        Contact
                    </h2>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="fas fa-map-marker-alt me-2 text-muted"></i>{{$user->nationality ?? '--'}} </li>
                        <li class="mb-2"><i class="fas fa-phone me-2 text-muted"></i> {{$user->phone_number ?? '--'}}</li>
                        <li class="mb-2"><i class="fas fa-envelope me-2 text-muted"></i>
                            {{$user->email ?? '--'}}
                        </li>
                        <li class="mb-2"><i class="fas fa-globe me-2 text-muted"></i> <a href="{{$user->bioProfile->website_url ?? '#'}}"
                                class="text-decoration-none text-primary" target="_blank">{{$user->bioProfile->website_url ?? '---'}}</a></li>
                    </ul>
                </section>
            </div>
        </div>
    </div>
</div>
</section>
<!-- Form Profile end -->

@endsection