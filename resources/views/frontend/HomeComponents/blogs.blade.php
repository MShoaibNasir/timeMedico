<!-- blog area -->
<div class="blog-area py-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mx-auto">
                <div class="site-heading text-center">
                    <span class="site-title-tagline">Our Blog</span>
                    <h2 class="site-title">Our Latest News & <span>Blog</span></h2>
                </div>
            </div>
        </div>

        <div class="row g-4">
            @forelse($blogs as $blog)
            <div class="col-md-6 col-lg-4">
                <div class="blog-item wow fadeInUp" data-wow-delay=".25s">
                    <div class="blog-item-img">
                        <img src="{{ asset($blog->image) }}" alt="{{ $blog->name }}">

                        <span class="blog-date">
                            <i class="far fa-calendar-alt"></i>
                            {{ \Carbon\Carbon::parse($blog->created_at)->format('M d, Y') }}
                        </span>
                    </div>

                    <div class="blog-item-info">
                        <div class="blog-item-meta">
                            <ul>
                                <li>
                                    <a href="{{route('frontend.blog.show',[$blog->id])}}">
                                        <i class="far fa-user-circle"></i>
                                        By Admin
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <h4 class="blog-title">
                            <a href="{{route('frontend.blog.show',[$blog->id])}}">
                                {{ $blog->name }}
                            </a>
                        </h4>

                        <p>
                            {{ \Illuminate\Support\Str::limit(strip_tags($blog->description), 120) }}
                        </p>

                        <a class="theme-btn" href="{{route('frontend.blog.show',[$blog->id])}}">
                            Read More
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center">
                <p>No blogs found.</p>
            </div>
            @endforelse
        </div>
    </div>
</div>
<!-- blog area end -->