@extends('frontend.layout.master')
@section('content')

<!-- MAIN CONTENT START -->
<section class="flat-title-page">

    <div class="row">
        <div class="container">
            <div class="flat-img-with-text style-3 bg-primary-new">
                <div class="container-fluid">
                    <div class="responsive-forums-wrapper">
                        <div class="responsive-forums-container">

                            <!-- Left Section - Forums Title & Graphics -->
                            <div class="responsive-left-section">
                                <h1 class="responsive-forums-title">
                                    <i class="fas fa-comments me-3"></i>
                                    FORUMS
                                </h1>

                                <img src="{{asset('frontend/images/banner/forum.png')}}" alt="" class="img-fluid w-50 pt-3 pb-4">
                                @if(Auth::guard('web')->check())
                                <a href="{{ route('forum.create') }}" class="modern-subscribe-btn btn-secondary" style="background-color: #339440;">
                                    <i class="fas fa-pencil"></i>
                                    Create new forum
                                </a>
                                @endif
                            </div>

                            <!-- Right Section - Discussions -->
                            <div class="responsive-right-section">

                                <!-- Desktop Table View -->
                                <table class="desktop-discussions-table">
                                    <thead>
                                        <tr class="desktop-table-header">
                                            <th class="desktop-header-cell desktop-main-header">RECENT
                                                DISCUSSIONS</th>
                                            <th class="desktop-header-cell">Posts</th>
                                            <th class="desktop-header-cell">Members</th>
                                            <th class="desktop-header-cell">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($forums as $forum)
                                        <tr class="desktop-discussion-row">
                                            <td class="desktop-data-cell"> {{ $forum->title }}</td>
                                            <td class="desktop-data-cell modern-stats-number">{{ $forum->messages_count ?? '0' }}</td>
                                            <td class="desktop-data-cell modern-stats-number">{{ $forum->subscribers_count }}</td>
                                            <td class="desktop-data-cell">
                                            @if(!Auth::guard('web')->check())
                                                <button class="modern-subscribe-btn" onclick="showLoginMessage()">
                                                    <i class="fas fa-bell"></i> Subscribe
                                                </button>
                                            @elseif(Auth::guard('web')->check() && Auth::guard('web')->user()->subscribedForums->contains($forum->id))  
                                                   <a href="{{ route('forumChatRoom',$forum->id) }}" class="modern-topic-link">
                                                    View Discussion
                                                </a>
                                            @else
                                                <form method="POST" action="{{ route('forum.subscribe',$forum->id) }}">
                                                    @csrf
                                                    <button class="modern-subscribe-btn">
                                                        <i class="fas fa-bell"></i> Subscribe
                                                    </button>
                                                </form>
                                            @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <!-- Mobile Card View -->
                                <div class="mobile-discussions-cards">
                                    @foreach ($forums as $forum)
                                    <div class="mobile-discussion-card">
                                        <div class="mobile-card-header">
                                            <div class="mobile-topic-title">
                                                <a href="#esg-guidelines" class="mobile-topic-link">{{ $forum->title }}</a>
                                            </div>
                                        </div>
                                        <div class="mobile-card-stats">
                                            <div class="mobile-stat-item">
                                                <span class="mobile-stat-number">{{ $forum->messages_count ?? '0' }}</span>
                                                <span class="mobile-stat-label">Posts</span>
                                            </div>
                                            <div class="mobile-stat-item">
                                                <span class="mobile-stat-number">{{ $forum->subscribers_count }}</span>
                                                <span class="mobile-stat-label">Members</span>
                                            </div>
                                        </div>
                                        <div class="mobile-card-actions">
                                        @if(!Auth::guard('web')->check())
                                                <button class="modern-subscribe-btn" onclick="showLoginMessage()">
                                                    <i class="fas fa-bell"></i> Subscribe
                                                </button>
                                            @elseif(Auth::guard('web')->check() && Auth::guard('web')->user()->subscribedForums->contains($forum->id))                                                <a href="{{ route('forumChatRoom',$forum->id) }}" class="modern-topic-link">
                                                    View Discussion
                                                </a>
                                            @else
                                                <form method="POST" action="{{ route('forum.subscribe',$forum->id) }}">
                                                    @csrf
                                                    <button class="modern-subscribe-btn">
                                                        <i class="fas fa-bell"></i> Subscribe
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                    @endforeach

                                </div>

                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</section>
<!-- MAIN CONTENT END -->

<script>
function showLoginMessage() {
    alert("Please login first to subscribe.");
}
</script>
@endsection