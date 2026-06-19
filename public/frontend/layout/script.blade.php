<script type="text/javascript" src="{{asset('frontend/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('frontend/js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('frontend/js/swiper-bundle.min.js')}}"></script>
<script type="text/javascript" src="{{asset('frontend/js/carousel.js')}}"></script>
<script type="text/javascript" src="{{asset('frontend/js/plugin.js')}}"></script>
<script type="text/javascript" src="{{asset('frontend/js/jquery.nice-select.min.js')}}"></script>
<script type="text/javascript" src="{{asset('frontend/js/rangle-slider.js')}}"></script>
<script type="text/javascript" src="{{asset('frontend/js/animation_heading.js')}}"></script>
<script type="text/javascript" src="{{asset('frontend/js/shortcodes.js')}}"></script>
<script type="text/javascript" src="{{asset('frontend/js/main.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.querySelector("#cnic").addEventListener("input", function(e) {
        let value = e.target.value.replace(/\D/g, "");
        if (value.length > 5) value = value.slice(0, 5) + "-" + value.slice(5);
        if (value.length > 13) value = value.slice(0, 13) + "-" + value.slice(13, 14);
        e.target.value = value;
    });
</script>
@if(session('success'))
<script>
    Swal.fire({
        title: 'Success!',
        text: "{{ session('success') }}",
        icon: 'success',
        confirmButtonText: 'OK'
    });
</script>
@endif
@if(session('error'))
<script>
    Swal.fire({
        title: 'Error!',
        text: "{{ session('error') }}",
        icon: 'error',
        confirmButtonText: 'Try Again'
    });
</script>
@endif



</body>

</html>