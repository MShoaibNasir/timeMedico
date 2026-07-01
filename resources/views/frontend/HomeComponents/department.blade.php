    <!-- category area -->
    <div class="category-area pt-80 pb-100">
        <div class="container">
            <div class="row">
                <div class="col-12 wow fadeInDown" data-wow-delay=".25s">
                    <div class="site-heading-inline">
                        <h2 class="site-title">Departments</h2>
                        <a href="category">View More <i class="fas fa-angle-double-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="category-slider owl-carousel owl-theme wow fadeInUp" data-wow-delay=".25s">
                @foreach ($departments as $department)
                <div class="category-item">
                    <a href="{{ route('frontend.categories', [Crypt::encryptString($department->id)]) }}">
                        <div class="category-info">
                            <div class="icon">
                                <img src="{{ asset('storage/'.$department->image) }}" alt="image">
                            </div>
                            <div class="content">
                                <h4>{{$department->name}}</h4>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach

            </div>

        </div>
    </div>
    <!-- category area end-->