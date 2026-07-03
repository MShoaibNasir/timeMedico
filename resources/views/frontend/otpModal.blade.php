<style>
    .otp-icon {
        width: 70px;
        height: 70px;
        margin: auto;
        background: rgba(13, 110, 253, 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .otp-icon i {
        font-size: 30px;
        color: #EE1B21;
    }

    .otp-container {
        display: flex;
        justify-content: center;
        gap: 12px;
    }

    .otp-input {
        width: 60px;
        height: 60px;
        border: 2px solid #dee2e6;
        border-radius: 12px;
        text-align: center;
        font-size: 24px;
        font-weight: 700;
        outline: none;
        transition: all 0.3s ease;
    }

    .otp-input:focus {
        border-color: #EE1B21;
        box-shadow: 0 0 10px rgba(13, 110, 253, .2);
    }

    .verify-btn {
        width: 100%;
        border-radius: 10px;
        padding: 12px;
        font-weight: 600;
        color: #ffffff !important;
    }

    .modal-content {
        border-radius: 20px;
        overflow: hidden;
    }

    .r_otp {
        color: #EE1B21;
    }
</style>

<div class="modal fade" id="otpModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <h4 class="modal-title fw-bold w-100 text-center">OTP Verification</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body text-center">
                <div class="otp-icon mb-3">
                    <i class="fas fa-shield-alt"></i>
                </div>

                <h5 class="fw-bold">Verify Your Account</h5>

                <p class="text-muted mb-4">
                    We have sent a 4-digit verification code to your registered email.
                </p>

                <form id="otpSubmitForm" method="post" action="{{route('frontend.saveUser')}}">
                    @csrf
                    <input type="hidden" id="otp_phone" name="phone" value="{{$phone}}">
                    <input type="hidden" id="otp_email" name="email" value="{{$email}}">

                    <div class="otp-container">
                        <input type="text" class="otp-input" maxlength="1">
                        <input type="text" class="otp-input" maxlength="1">
                        <input type="text" class="otp-input" maxlength="1">
                        <input type="text" class="otp-input" maxlength="1">
                    </div>
                </form>

                <small class="text-muted d-block mt-3">
                    Didn't receive the code?
                    <a href="#" class="fw-bold r_otp">Resend OTP</a>
                </small>
            </div>

            <div class="modal-footer border-0 justify-content-center">
                <!-- <button type="button" style="background:#EE1B21; color:white;" class="btn verify-btn" id="verifyOtpBtn">
                    Verify OTP
                </button> -->
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-4.0.0.js"></script>
<script>
    // Initialize Modal
    if (!window.myOtpModalInstance) {
        window.myOtpModalInstance = new bootstrap.Modal(document.getElementById('otpModal'));
    }
    window.myOtpModalInstance.show();

    // Helper function to extract typed OTP string
    function getOtpValue() {
        let otp = '';
        $('.otp-input').each(function() {
            otp += $(this).val().trim();
        });
        return otp;
    }

    // Input Restrictions (Numbers only) & Auto Focus Next
    $(document).on('input', '.otp-input', function() {
        this.value = this.value.replace(/[^0-9]/g, ''); // Ensure only numbers are typed

        if (this.value.length >= 1) {
            $(this).next('.otp-input').focus();
        }

        let otp = getOtpValue();
        if (otp.length === 4) {
            verifyOTP(otp);
        }
    });

    // Backspace Navigation
    $(document).on('keydown', '.otp-input', function(e) {
        if (e.key === "Backspace" && this.value.length === 0) {
            $(this).prev('.otp-input').focus();
        }
    });

    // Manual Button Click Verification Trigger
    $(document).on('click', '#verifyOtpBtn', function() {
        let otp = getOtpValue();
        if (otp.length !== 4) {
            Swal.fire({
                icon: 'warning',
                title: 'Incomplete OTP',
                text: 'Please enter all 4 digits.'
            });
            return;
        }
        verifyOTP(otp);
    });

    // Main Verification Function
    function verifyOTP(otp) {
        const otp_phone = $('#otp_phone').val();
        const otp_email = $('#otp_email').val();

        $.ajax({
            url: "{{ route('frontend.verifyotp') }}",
            type: "POST",
            dataType: "json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Accept': 'application/json'
            },
            data: {
                otp_phone: otp_phone,
                otp_email: otp_email,
                otp: otp
            },
            beforeSend: function() {
                Swal.fire({
                    title: 'Verifying OTP...',
                    text: 'Please wait',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                $('#verifyOtpBtn').prop('disabled', true);
            },
            success: function(response) {
                Swal.close();
                if (response.success) {
                    // 1. Append OTP value dynamically to the form
                    $('#otpSubmitForm').append('<input type="hidden" name="otp" value="' + otp + '">');

                    // 2. Submit the form to target `frontend.saveUser`
                    $('#otpSubmitForm').submit();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Invalid OTP',
                        text: response.message || 'OTP verification failed.'
                    });
                    clearOtpInputs();
                }
            },
            error: function(xhr) {
                Swal.close();
                let errors = xhr.responseJSON?.errors;
                let errorMessage = '';

                if (errors) {
                    $.each(errors, function(key, value) {
                        errorMessage += value[0] + '<br>';
                    });
                } else {
                    errorMessage = xhr.responseJSON?.message || 'Something went wrong. Please try again.';
                }

                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    html: errorMessage
                });
                clearOtpInputs();
            },
            complete: function() {
                $('#verifyOtpBtn').prop('disabled', false);
            }
        });
    }

    function clearOtpInputs() {
        $('.otp-input').val('');
        $('.otp-input').first().focus();
    }
</script>