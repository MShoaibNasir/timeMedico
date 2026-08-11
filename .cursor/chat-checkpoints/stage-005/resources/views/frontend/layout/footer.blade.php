{{--
@if (is_homepage())

@endif

@if(!empty($setting->phone))<li><i class="bi bi-phone"></i>{{ $setting->phone }}</li>@endif
@if(!empty($setting->email))<li><i class="bi bi-envelope"></i>{{ $setting->email }}</li>@endif
@if(!empty($setting->address))<li><i class="bi bi-map"></i>{{ $setting->address }}</li>@endif
--}}
 
 <!-- footer area -->
 <footer class="footer-area ft-bg">
     <div class="footer-widget">
         <div class="container">
             <div class="row footer-widget-wrapper pt-100 pb-40">
                 <div class="col-md-6 col-lg-3">
                     <div class="footer-widget-box about-us">
                         <a href="index.html" class="footer-logo">
    @if($setting?->hasMedia('logo'))
		<img src="{{ $setting->getFirstMediaUrl('logo', 'small') }}" alt="{{ $setting?->site_name ?? '' }}" />
	@endif
                         </a>
                         <p class="mb-3">
                             We are many variations of the passages available but the majoro have suffered alteration
                             injected.
                         </p>
						 
						 
						 
						 

			  

              
						 
						 
						 
                         <ul class="footer-contact">
@php
    $phones = $setting->phone ?? [];
    if (is_string($phones)) {
        $decoded = json_decode($phones, true);
        if (is_array($decoded)) {
            $phones = $decoded;
        } 
        else {
            $cleaned = str_replace(['"', "'"], '', $phones);
            $phones = preg_split('/[,|]/', $cleaned);
        }
    }
    $filteredPhones = array_filter(array_map('trim', (array) $phones));
	$phoneChunks = array_chunk(array_filter($filteredPhones), 1);
@endphp

@if(!empty($phoneChunks))
    @foreach($phoneChunks as $chunk)
        <li><i class="far fa-phone"></i>
            @foreach($chunk as $phone)
                <a href="tel:{{ trim($phone) }}">{{ trim($phone) }}</a>
            @endforeach
        </li>
    @endforeach
@endif
                    @if(!empty($setting->address))
					<li><i class="far fa-map-marker-alt"></i>{!! $setting->address !!}</li>
				    @endif
					
                    @if(!empty($setting->email))
                    <li><a href="mailto:{{ $setting->email ?? '' }}"><i class="far fa-envelope"></i>{{ $setting->email ?? '' }}</a></li>
                    @endif

                         </ul>
                     </div>
                 </div>
                 <div class="col-md-6 col-lg-2">
                     <div class="footer-widget-box list">
                         <h4 class="footer-widget-title">Quick Links</h4>
                         <ul class="footer-list">
                             <x-frontend.simple-menu :items="$footerMenus['footer_menu_2']" />
                         </ul>
                     </div>
                 </div>
                 <div class="col-md-6 col-lg-2">
                     <div class="footer-widget-box list">
                         <h4 class="footer-widget-title">Browse Category</h4>
                         <ul class="footer-list">
                            @foreach($categories as $category)
                                <li><a href="{{ route('frontend.productFilter', [Crypt::encryptString($category->id)]) }}">{{ $category->name }}</a></li>
                            @endforeach
                         </ul>
                     </div>
                 </div>
                 <div class="col-md-6 col-lg-2">
                     <div class="footer-widget-box list">
                         <h4 class="footer-widget-title">Support Center</h4>
                         <ul class="footer-list">
                             <x-frontend.simple-menu :items="$footerMenus['footer_menu_3']" />


                         </ul>
                     </div>
                 </div>
                 <div class="col-md-6 col-lg-3">
                     <div class="footer-widget-box list">
                         <h4 class="footer-widget-title">Get Mobile App</h4>
                         <p>Medica App is now available on App Store & Google Play.</p>
                         <div class="footer-download">
                             <h5>Download Our Mobile App</h5>
                             <div class="footer-download-btn">
                                 <a href="#">
                                     <i class="fab fa-google-play"></i>
                                     <div class="download-btn-info">
                                         <span>Get It On</span>
                                         <h6>Google Play</h6>
                                     </div>
                                 </a>
                                 <a href="#">
                                     <i class="fab fa-app-store"></i>
                                     <div class="download-btn-info">
                                         <span>Get It On</span>
                                         <h6>App Store</h6>
                                     </div>
                                 </a>
                             </div>
                         </div>
                         <!--<div class="footer-payment mt-20">-->
                         <!--    <span>We Accept:</span>-->
                         <!--    <img src="assets/images/visa.svg" alt="">-->
                         <!--    <img src="assets/images/mastercard.svg" alt="">-->
                         <!--    <img src="assets/images/amex.svg" alt="">-->
                         <!--    <img src="assets/images/discover.svg" alt="">-->
                         <!--    <img src="assets/images/paypal.svg" alt="">-->
                         <!--</div>-->
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <div class="copyright">
         <div class="container">
             <div class="copyright-wrap">
                 <div class="row">
                     <div class="col-12 col-lg-6 align-self-center">
					 @if(!empty($setting->copyright_text))
	<p class="copyright-text">&copy; {{ date('Y') }} {{ $setting->copyright_text }}. All rights reserved. Designed & Developed By <a href="https://a2zcreatorz.com/" target="_blank">A2Z Creatorz</a></p>
	@endif
                     </div>
                     <div class="col-12 col-lg-6 align-self-center">
                         <div class="footer-social">
                             <span>Follow Us:</span>						 
	@if(!empty($setting->facebook))
	  <a href="{{ $setting->facebook }}" target="_blank" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
    @endif
    @if(!empty($setting->instagram))
	  <a href="{{ $setting->instagram }}" target="_blank" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
    @endif
    @if(!empty($setting->linkedin))
		<a href="{{ $setting->linkedin }}" target="_blank" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
    @endif
	@if(!empty($setting->twitter))
  <a href="{{ $setting->twitter }}" target="_blank" aria-label="Twitter/X"><i class="fab fa-x-twitter"></i></a>  
    @endif
	@if(!empty($setting->youtube)) 
  <a href="{{ $setting->youtube }}" target="_blank" aria-label="YouTube"><i class="fab fa-youtube"></i></a> 
    @endif
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </footer>
 <!-- footer area end -->


 <!-- scroll-top -->
 <a href="#" id="scroll-top"><i class="far fa-arrow-up-from-arc"></i></a>
 <!-- scroll-top end -->


 <!-- modal quick shop-->
 <div class="modal quickview fade " id="quickview" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="quickview" aria-hidden="true">
     <div class="modal-dialog modal-lg modal-dialog-centered quickViewModal" role="document">
     </div>
 </div>
 <!-- modal quick shop end -->


 <!-- js -->
 <script src="{{ asset('frontend/js/jquery-3.7.1.min.js') }}"></script>
 <script src="{{ asset('frontend/js/modernizr.min.js') }}"></script>
 <script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"></script>
 <script src="{{ asset('frontend/js/imagesloaded.pkgd.min.js') }}"></script>
 <script src="{{ asset('frontend/js/jquery.magnific-popup.min.js') }}"></script>
 <script src="{{ asset('frontend/js/isotope.pkgd.min.js') }}"></script>
 <script src="{{ asset('frontend/js/jquery.appear.min.js') }}"></script>
 <script src="{{ asset('frontend/js/jquery.easing.min.js') }}"></script>
 <script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
 <script src="{{ asset('frontend/js/counter-up.js') }}"></script>
 <script src="{{ asset('frontend/js/jquery-ui.min.js') }}"></script>
 <script src="{{ asset('frontend/js/jquery.nice-select.min.js') }}"></script>
 <script src="{{ asset('frontend/js/countdown.min.js') }}"></script>
 <script src="{{ asset('frontend/js/wow.min.js') }}"></script>
 <script src="{{ asset('frontend/js/flex-slider.js') }}"></script>
 <script src="{{ asset('frontend/js/main.js') }}"></script>
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 @stack('script')
 <script>
     // Create a reusable Toast configuration
     const Toast = Swal.mixin({
         toast: true,
         position: 'top-end',
         showConfirmButton: false,
         timer: 3000,
         timerProgressBar: true,
         didOpen: (toast) => {
             toast.addEventListener('mouseenter', Swal.stopTimer)
             toast.addEventListener('mouseleave', Swal.resumeTimer)
         }
     });

     const frontendIsLoggedIn = @json(Auth::guard('web')->check());
     const frontendAuthBaseUrl = @json(route('frontend.register'));

     function frontendAuthUrl(returnUrl) {
         const url = new URL(frontendAuthBaseUrl, window.location.origin);
         const target = returnUrl || (window.location.pathname + window.location.search + window.location.hash);
         url.searchParams.set('redirect', target);
         return url.toString();
     }

     function redirectToFrontendLogin(returnUrl) {
         window.location.href = frontendAuthUrl(returnUrl);
     }

     function handleFrontendLoginRequired(payload) {
         const data = payload && payload.responseJSON ? payload.responseJSON : payload;
         if (data && data.login_required && data.redirect) {
             window.location.href = data.redirect;
             return true;
         }
         return false;
     }

     function showWishList() {


         $.ajax({
             url: "{{ route('frontend.wishlist.show') }}",
             type: "POST",
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },
             success: function(response) {
                 $('.wishlist_count_show').html(response);
             },

             error: function(xhr) {
                 Swal.fire({
                     icon: 'error',
                     title: 'Error',
                     text: xhr.responseJSON?.message || 'Something went wrong.'
                 });
             }
         });
     }
     showWishList()


     function viewCart() {

         $.ajax({
             url: "{{ route('frontend.viewCart') }}",
             type: "POST",
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },


             success: function(response) {
                 $('.dropdown-cart').html(response)
             },

             error: function(xhr) {

                 Swal.fire({
                     icon: 'error',
                     title: 'Oops...',
                     text: xhr.responseJSON?.message || 'Something went wrong.'
                 });

             }
         });


     }
     viewCart();








 



     // wish list code

     $(document).on('click', '.wishlist', function() {

         let product_id = $(this).data('product-id');
         let btn = $(this);

         $.ajax({
             url: "{{ route('frontend.wishlist.add') }}",
             type: "POST",
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },
             data: {
                 product_id: product_id
             },


             success: function(response) {

                 Swal.close();

                 if (response.action === 'added') {

                     btn.find('span')
                         .removeClass('far')
                         .addClass('fas');
                     btn.css('background-color', 'red');

                 } else {

                     btn.find('span')
                         .removeClass('fas')
                         .addClass('far');
                     btn.css('background-color', '');
                 }
                 showWishList()

                 Swal.fire({
                     toast: true,
                     position: 'top-end',
                     icon: 'success',
                     title: response.message,
                     showConfirmButton: false,
                     timer: 1200,
                     timerProgressBar: true
                 });

                 $('#wishlist-count').text(response.wishlist_count);
             },

             error: function(xhr) {
                 if (handleFrontendLoginRequired(xhr)) {
                     return;
                 }
                 Swal.fire({
                     icon: 'error',
                     title: 'Error',
                     text: xhr.responseJSON?.message || 'Something went wrong.'
                 });
             }
         });
     });
     $(document).on('click', '.quickeView', function() {

         let product_id = $(this).data('product-id');
         let btn = $(this);
         $.ajax({
             url: "{{ route('frontend.quickeView') }}",
             type: "POST",
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },
             data: {
                 product_id: product_id
             },


             success: function(response) {
                 console.log(response);

                 $('.quickViewModal').html(response);

                 //  $('#wishlist-count').text(response.wishlist_count);
             },

             error: function(xhr) {
                 Swal.fire({
                     icon: 'error',
                     title: 'Error',
                     text: xhr.responseJSON?.message || 'Something went wrong.'
                 });
             }
         });
     });

     $(document).on('click', '.product-cart-btn', function() {
         if (!frontendIsLoggedIn) {
             redirectToFrontendLogin();
             return;
         }

         let product_id = $(this).data('product-id');
         let btn = $(this);

         $.ajax({
             url: "{{ route('frontend.addToCart') }}",
             type: "POST",
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },
             data: {
                 product_id: product_id,
                 return_url: window.location.href
             },

             success: function(response) {
                 if (handleFrontendLoginRequired(response)) {
                     return;
                 }

                 if (response.status) {
                     Toast.fire({
                         icon: 'success',
                         title: response.message || 'Product Add to Cart Successfully!'
                     });
                     viewCart();
                 } else {
                     Toast.fire({
                         icon: 'warning',
                         title: response.message
                     });
                 }
             },

             error: function(xhr) {
                 if (handleFrontendLoginRequired(xhr)) {
                     return;
                 }

                 Swal.fire({
                     icon: 'error',
                     title: 'Oops...',
                     text: xhr.responseJSON?.message || 'Something went wrong.'
                 });

             }
         });

     });
     $(document).on('click', '.cart-remove', function(e) {

         e.preventDefault();

         let product_id = $(this).data('product-id');

         $.ajax({
             url: "{{ route('frontend.removeFromCart') }}",
             type: "POST",
             data: {
                 _token: $('meta[name="csrf-token"]').attr('content'),
                 product_id: product_id
             },
             success: function(response) {

                 if (response.status) {

                     viewCart();

                     toastr.success(response.message);
                 }
             }
         });

     });
 </script>

 @if(session('success'))
 <script>
     Toast.fire({
         icon: 'success',
         title: "{{ session('success') }}"
     });
 </script>
 @endif

 @if(session('error'))
 <script>
     Toast.fire({
         icon: 'error',
         title: "{{ session('error') }}"
     });
 </script>
 @endif

 @if(session('warning'))
 <script>
     Toast.fire({
         icon: 'warning',
         title: "{{ session('warning') }}"
     });
 </script>
 @endif

 @if(session('info'))
 <script>
     Toast.fire({
         icon: 'info',
         title: "{{ session('info') }}"
     });
 </script>
 @endif
 </body>

 </html>