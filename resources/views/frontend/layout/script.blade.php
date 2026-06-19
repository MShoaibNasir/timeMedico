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

$('#notifications').click(function(){
    


   $.ajax({
        url: '{{ route("notifications.show") }}',
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
   
        beforeSend: function() {
            Swal.fire({
                text: 'Please wait',
                allowOutsideClick: false,
                didOpen: () => Swal.showLoading()
            });
        },
        success: function(response) {
            console.log(response);
            $('.modal-body').html(response);
         
            Swal.close();
         

        

        },
        error: function(xhr, status, error) {
            Swal.close();
            console.error(error);
        }
    });


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

@if ($errors->any())
    <script>
        let errorMessages = '';
        @foreach ($errors->all() as $error)
            errorMessages += '{{ $error }}\n';
        @endforeach
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: errorMessages,
        });
    </script>
@endif
@stack('scripts')

</body>

</html>