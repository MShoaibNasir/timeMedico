<!-- popupExplore Programs -->
<div class="modal modal-account fade" id="modalLogin">
    <div class="modal-dialog modal-dialog-centered login">
        <div class="modal-content">
            <div class="flat-account">
                <div class="banner-account">
                    <img src="{{ asset('frontend/images/banner/banner-account1.jpg') }}" alt="banner">
                </div>
                <form class="form-account" method="post" action="{{ route('frontend.user.login') }}">
                    @csrf
                    <div class="title-box">
                        <h4>Login</h4>
                        <span class="close-modal icon-close2" data-bs-dismiss="modal"></span>
                    </div>
                    <div class="box">
                        <fieldset class="box-fieldset">
                            <label>Account</label>
                            <div class="ip-field">
                                <svg class="icon" width="18" height="18" viewBox="0 0 18 18" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M13.4869 14.0435C12.9628 13.3497 12.2848 12.787 11.5063 12.3998C10.7277 12.0126 9.86989 11.8115 9.00038 11.8123C8.13086 11.8115 7.27304 12.0126 6.49449 12.3998C5.71594 12.787 5.03793 13.3497 4.51388 14.0435M13.4869 14.0435C14.5095 13.1339 15.2307 11.9349 15.5563 10.6056C15.8818 9.27625 15.7956 7.87934 15.309 6.60014C14.8224 5.32093 13.9584 4.21986 12.8317 3.44295C11.7049 2.66604 10.3686 2.25 9 2.25C7.63137 2.25 6.29508 2.66604 5.16833 3.44295C4.04158 4.21986 3.17762 5.32093 2.69103 6.60014C2.20443 7.87934 2.11819 9.27625 2.44374 10.6056C2.76929 11.9349 3.49125 13.1339 4.51388 14.0435M13.4869 14.0435C12.2524 15.1447 10.6546 15.7521 9.00038 15.7498C7.3459 15.7523 5.74855 15.1448 4.51388 14.0435M11.2504 7.31228C11.2504 7.90902 11.0133 8.48131 10.5914 8.90327C10.1694 9.32523 9.59711 9.56228 9.00038 9.56228C8.40364 9.56228 7.83134 9.32523 7.40939 8.90327C6.98743 8.48131 6.75038 7.90902 6.75038 7.31228C6.75038 6.71554 6.98743 6.14325 7.40939 5.72129C7.83134 5.29933 8.40364 5.06228 9.00038 5.06228C9.59711 5.06228 10.1694 5.29933 10.5914 5.72129C11.0133 6.14325 11.2504 6.71554 11.2504 7.31228Z"
                                        stroke="#A3ABB0" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <input type="email" name="email" required class="form-control" placeholder="Email Address">
                            </div>
                        </fieldset>
                        <fieldset class="box-fieldset" style="border: none;">
                          <label>Password</label>
                          <div class="ip-field" style="position: relative;">
                            <input
                              type="password"
                              name="password"
                              id="password"
                              class="form-control"
                              placeholder="Your password"
                              style="padding-right: 35px;" required
                            >
                        
                            <!-- Eye Icon -->
                            <svg
                              id="togglePassword"
                              xmlns="http://www.w3.org/2000/svg"
                              width="20"
                              height="20"
                              fill="none"
                              viewBox="0 0 24 24"
                              stroke="gray"
                              style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;"
                            >
                              <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                              />
                              <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                              />
                            </svg>
                          </div>
                                
                        </fieldset>
                    </div>
                    <div class="box box-btn">
                        <input type="submit" value="Login" class="tf-btn primary w-100">
                     
                        <div class="text text-center">Don’t you have an account? <a href="#modalRegister"
                                data-bs-toggle="modal" class="text-primary">Register</a></div>
                        <div class="text text-center"> <a href="#forget_password" data-bs-toggle="modal" class="text-primary">Forget Password</a></div>        
                    </div>
                    {{--<p class="box text-center caption-2">orExplore Programs with</p>
                    <div class="group-btn">
                        <a href="#" class="btn-social">
                            <img src="{{ asset('frontend/images/logo/google.jpg') }}" alt="img">
                            Google
                        </a>
                        <a href="#" class="btn-social">
                            <img src="{{ asset('frontend/images/logo/fb.jpg') }}" alt="img">
                            Facebook
                        </a>

                    </div>--}}
                </form>


            </div>
        </div>
    </div>
</div>
<div class="modal modal-account fade" id="forget_password">
    <div class="modal-dialog modal-dialog-centered login">
        <div class="modal-content">
            <div class="flat-account">
                <div class="banner-account">
                    <img src="{{ asset('frontend/images/banner/banner-account1.jpg') }}" alt="banner">
                </div>
                
                <form class="form-account" method="post" action="{{ route('frontend.forget.password') }}">
                    @csrf
                    <div class="title-box">
                        <h4>Forget Password</h4>
                        <span class="close-modal icon-close2" data-bs-dismiss="modal"></span>
                    </div>
                    <div class="box">
                        <fieldset class="box-fieldset">
                            <label>Email</label>
                            <div class="ip-field">
                                <svg class="icon" width="18" height="18" viewBox="0 0 18 18" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M13.4869 14.0435C12.9628 13.3497 12.2848 12.787 11.5063 12.3998C10.7277 12.0126 9.86989 11.8115 9.00038 11.8123C8.13086 11.8115 7.27304 12.0126 6.49449 12.3998C5.71594 12.787 5.03793 13.3497 4.51388 14.0435M13.4869 14.0435C14.5095 13.1339 15.2307 11.9349 15.5563 10.6056C15.8818 9.27625 15.7956 7.87934 15.309 6.60014C14.8224 5.32093 13.9584 4.21986 12.8317 3.44295C11.7049 2.66604 10.3686 2.25 9 2.25C7.63137 2.25 6.29508 2.66604 5.16833 3.44295C4.04158 4.21986 3.17762 5.32093 2.69103 6.60014C2.20443 7.87934 2.11819 9.27625 2.44374 10.6056C2.76929 11.9349 3.49125 13.1339 4.51388 14.0435M13.4869 14.0435C12.2524 15.1447 10.6546 15.7521 9.00038 15.7498C7.3459 15.7523 5.74855 15.1448 4.51388 14.0435M11.2504 7.31228C11.2504 7.90902 11.0133 8.48131 10.5914 8.90327C10.1694 9.32523 9.59711 9.56228 9.00038 9.56228C8.40364 9.56228 7.83134 9.32523 7.40939 8.90327C6.98743 8.48131 6.75038 7.90902 6.75038 7.31228C6.75038 6.71554 6.98743 6.14325 7.40939 5.72129C7.83134 5.29933 8.40364 5.06228 9.00038 5.06228C9.59711 5.06228 10.1694 5.29933 10.5914 5.72129C11.0133 6.14325 11.2504 6.71554 11.2504 7.31228Z"
                                        stroke="#A3ABB0" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <input type="email" name="email" class="form-control" required placeholder="Email Address">
                            </div>
                        </fieldset>
                    </div>
                    <div class="box box-btn">
                        <input type="submit" value="Submit" class="tf-btn primary w-100">
                     
                        <div class="text text-center">Don’t you have an account? <a href="#modalRegister"
                                data-bs-toggle="modal" class="text-primary">Register</a></div>

                    </div>
                </form>


            </div>
        </div>
    </div>
</div>

<!-- popup register -->
<div class="modal modal-account fade" id="modalRegister">
    <div class="modal-dialog modal-dialog-centered login">
        <div class="modal-content">
            <div class="flat-account">
                <div class="banner-account">
                    <img src="{{ asset('frontend/images/banner/banner-account2.jpg') }}" alt="banner">
                </div>
                <form class="form-account" action="{{route('frontend.user.register')}}" method="post">
                    @csrf
                    <div class="title-box">
                        <h4>Register</h4>
                        <span class="close-modal icon-close2" data-bs-dismiss="modal"></span>
                    </div>
                    <div class="box">
                        <div class="row">
                            <div class="col-6">

                                <fieldset class="box-fieldset">
                                    <label>Full name</label>
                                    <div class="ip-field">
                                        <svg class="icon" width="18" height="18" viewBox="0 0 18 18" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M13.4869 14.0435C12.9628 13.3497 12.2848 12.787 11.5063 12.3998C10.7277 12.0126 9.86989 11.8115 9.00038 11.8123C8.13086 11.8115 7.27304 12.0126 6.49449 12.3998C5.71594 12.787 5.03793 13.3497 4.51388 14.0435M13.4869 14.0435C14.5095 13.1339 15.2307 11.9349 15.5563 10.6056C15.8818 9.27625 15.7956 7.87934 15.309 6.60014C14.8224 5.32093 13.9584 4.21986 12.8317 3.44295C11.7049 2.66604 10.3686 2.25 9 2.25C7.63137 2.25 6.29508 2.66604 5.16833 3.44295C4.04158 4.21986 3.17762 5.32093 2.69103 6.60014C2.20443 7.87934 2.11819 9.27625 2.44374 10.6056C2.76929 11.9349 3.49125 13.1339 4.51388 14.0435M13.4869 14.0435C12.2524 15.1447 10.6546 15.7521 9.00038 15.7498C7.3459 15.7523 5.74855 15.1448 4.51388 14.0435M11.2504 7.31228C11.2504 7.90902 11.0133 8.48131 10.5914 8.90327C10.1694 9.32523 9.59711 9.56228 9.00038 9.56228C8.40364 9.56228 7.83134 9.32523 7.40939 8.90327C6.98743 8.48131 6.75038 7.90902 6.75038 7.31228C6.75038 6.71554 6.98743 6.14325 7.40939 5.72129C7.83134 5.29933 8.40364 5.06228 9.00038 5.06228C9.59711 5.06228 10.1694 5.29933 10.5914 5.72129C11.0133 6.14325 11.2504 6.71554 11.2504 7.31228Z"
                                                stroke="#A3ABB0" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <input type="text" class="form-control" name="name" required placeholder="Full name">
                                    </div>
                                </fieldset>
                                <fieldset class="box-fieldset">
                                    <label>Email address</label>
                                    <div class="ip-field">
                                        <svg class="icon" width="18" height="18" viewBox="0 0 18 18" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M16.3125 5.0625V12.9375C16.3125 13.3851 16.1347 13.8143 15.8182 14.1307C15.5018 14.4472 15.0726 14.625 14.625 14.625H3.375C2.92745 14.625 2.49822 14.4472 2.18176 14.1307C1.86529 13.8143 1.6875 13.3851 1.6875 12.9375V5.0625M16.3125 5.0625C16.3125 4.61495 16.1347 4.18573 15.8182 3.86926C15.5018 3.55279 15.0726 3.375 14.625 3.375H3.375C2.92745 3.375 2.49822 3.55279 2.18176 3.86926C1.86529 4.18573 1.6875 4.61495 1.6875 5.0625M16.3125 5.0625V5.24475C16.3125 5.53286 16.2388 5.81618 16.0983 6.06772C15.9578 6.31926 15.7553 6.53065 15.51 6.68175L9.885 10.143C9.61891 10.3069 9.31252 10.3937 9 10.3937C8.68748 10.3937 8.38109 10.3069 8.115 10.143L2.49 6.6825C2.24469 6.5314 2.04215 6.32001 1.90168 6.06847C1.7612 5.81693 1.68747 5.53361 1.6875 5.2455V5.0625"
                                                stroke="#A3ABB0" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>

                                        <input type="email" name="email" required class="form-control" placeholder="Email address">
                                    </div>

                                </fieldset>
<fieldset class="box-fieldset" style="border: none;">
  <label>Password</label>
  <div class="ip-field" style="position: relative;">
    <input
      type="password"
      name="password"
      id="signupPassword"
      class="form-control"
      placeholder="Your password"
      style="padding-right: 35px;"
      required
      autocomplete="off"
    >

    <!-- Eye Icon -->
    <svg
      id="signupTogglePassword"
      xmlns="http://www.w3.org/2000/svg"
      width="20"
      height="20"
      fill="none"
      viewBox="0 0 24 24"
      stroke="gray"
      style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;"
    >
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 
           9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
    </svg>
  </div>

  <small id="passwordMessage" style="color: red; font-size: 13px; display: none;"></small>

  <div style="margin-top: 6px;">
    <button type="button" id="suggestPasswordBtn" style="border: none; background: none; color: #007bff; font-size: 13px; cursor: pointer;">
      🔒 Suggest Strong Password
    </button>
  </div>
</fieldset>

<!-- CONFIRM PASSWORD FIELD -->
<fieldset class="box-fieldset">
  <label>Confirm Password</label>
  <div class="ip-field" style="position: relative;">
    <input
      type="password"
      name="password_confirmation"
      id="signupConfirmPassword"
      class="form-control"
      placeholder="Confirm password"
      required
      autocomplete="off"
      style="padding-right: 35px;"
    >

    <!-- Eye Icon -->
    <svg
      id="signupToggleConfirmPassword"
      xmlns="http://www.w3.org/2000/svg"
      width="20"
      height="20"
      fill="none"
      viewBox="0 0 24 24"
      stroke="gray"
      style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;"
    >
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 
           9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
    </svg>
  </div>

  <small id="confirmPasswordMessage" style="color: red; font-size: 13px; display: none;"></small>
</fieldset>
                                <fieldset class="box-fieldset">
                                    <label>Date Of Birth</label>
                                    <div class="ip-field">
                                        <svg class="icon" width="18" height="18" viewBox="0 0 18 18" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M12.375 7.875V5.0625C12.375 4.16739 12.0194 3.30895 11.3865 2.67601C10.7535 2.04308 9.89511 1.6875 9 1.6875C8.10489 1.6875 7.24645 2.04308 6.61351 2.67601C5.98058 3.30895 5.625 4.16739 5.625 5.0625V7.875M5.0625 16.3125H12.9375C13.3851 16.3125 13.8143 16.1347 14.1307 15.8182C14.4472 15.5018 14.625 15.0726 14.625 14.625V9.5625C14.625 9.11495 14.4472 8.68573 14.1307 8.36926C13.8143 8.05279 13.3851 7.875 12.9375 7.875H5.0625C4.61495 7.875 4.18573 8.05279 3.86926 8.36926C3.55279 8.68573 3.375 9.11495 3.375 9.5625V14.625C3.375 15.0726 3.55279 15.5018 3.86926 15.8182C4.18573 16.1347 4.61495 16.3125 5.0625 16.3125Z"
                                                stroke="#A3ABB0" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <input type="date" class="form-control" name="date_of_birth">
                                    </div>
                                </fieldset>
                            </div>
                            <div class="col-6">
                                <fieldset class="box-fieldset">
                                    <label>Phone Number</label>
                                    <div class="ip-field">
                                        <svg class="icon" width="18" height="18" viewBox="0 0 18 18" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M13.4869 14.0435C12.9628 13.3497 12.2848 12.787 11.5063 12.3998C10.7277 12.0126 9.86989 11.8115 9.00038 11.8123C8.13086 11.8115 7.27304 12.0126 6.49449 12.3998C5.71594 12.787 5.03793 13.3497 4.51388 14.0435M13.4869 14.0435C14.5095 13.1339 15.2307 11.9349 15.5563 10.6056C15.8818 9.27625 15.7956 7.87934 15.309 6.60014C14.8224 5.32093 13.9584 4.21986 12.8317 3.44295C11.7049 2.66604 10.3686 2.25 9 2.25C7.63137 2.25 6.29508 2.66604 5.16833 3.44295C4.04158 4.21986 3.17762 5.32093 2.69103 6.60014C2.20443 7.87934 2.11819 9.27625 2.44374 10.6056C2.76929 11.9349 3.49125 13.1339 4.51388 14.0435M13.4869 14.0435C12.2524 15.1447 10.6546 15.7521 9.00038 15.7498C7.3459 15.7523 5.74855 15.1448 4.51388 14.0435M11.2504 7.31228C11.2504 7.90902 11.0133 8.48131 10.5914 8.90327C10.1694 9.32523 9.59711 9.56228 9.00038 9.56228C8.40364 9.56228 7.83134 9.32523 7.40939 8.90327C6.98743 8.48131 6.75038 7.90902 6.75038 7.31228C6.75038 6.71554 6.98743 6.14325 7.40939 5.72129C7.83134 5.29933 8.40364 5.06228 9.00038 5.06228C9.59711 5.06228 10.1694 5.29933 10.5914 5.72129C11.0133 6.14325 11.2504 6.71554 11.2504 7.31228Z"
                                                stroke="#A3ABB0" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <input type="text" class="form-control" name="phone_number" placeholder="Phone Number">
                                    </div>
                                </fieldset>
                                <fieldset class="box-fieldset">
                                    <label>Gender</label>
                                    <div class="ip-field">
                                        <!-- <svg class="icon" width="18" height="18" viewBox="0 0 18 18" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M16.3125 5.0625V12.9375C16.3125 13.3851 16.1347 13.8143 15.8182 14.1307C15.5018 14.4472 15.0726 14.625 14.625 14.625H3.375C2.92745 14.625 2.49822 14.4472 2.18176 14.1307C1.86529 13.8143 1.6875 13.3851 1.6875 12.9375V5.0625M16.3125 5.0625C16.3125 4.61495 16.1347 4.18573 15.8182 3.86926C15.5018 3.55279 15.0726 3.375 14.625 3.375H3.375C2.92745 3.375 2.49822 3.55279 2.18176 3.86926C1.86529 4.18573 1.6875 4.61495 1.6875 5.0625M16.3125 5.0625V5.24475C16.3125 5.53286 16.2388 5.81618 16.0983 6.06772C15.9578 6.31926 15.7553 6.53065 15.51 6.68175L9.885 10.143C9.61891 10.3069 9.31252 10.3937 9 10.3937C8.68748 10.3937 8.38109 10.3069 8.115 10.143L2.49 6.6825C2.24469 6.5314 2.04215 6.32001 1.90168 6.06847C1.7612 5.81693 1.68747 5.53361 1.6875 5.2455V5.0625"
                                                stroke="#A3ABB0" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg> -->

                                        <select name="gender" class="form-control">
                                            <option value="">Select Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>

                                </fieldset>
                                <fieldset class="box-fieldset">
                                    <label>Nationality</label>
                                    <div class="ip-field">
                                        <svg class="icon" width="18" height="18" viewBox="0 0 18 18" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M12.375 7.875V5.0625C12.375 4.16739 12.0194 3.30895 11.3865 2.67601C10.7535 2.04308 9.89511 1.6875 9 1.6875C8.10489 1.6875 7.24645 2.04308 6.61351 2.67601C5.98058 3.30895 5.625 4.16739 5.625 5.0625V7.875M5.0625 16.3125H12.9375C13.3851 16.3125 13.8143 16.1347 14.1307 15.8182C14.4472 15.5018 14.625 15.0726 14.625 14.625V9.5625C14.625 9.11495 14.4472 8.68573 14.1307 8.36926C13.8143 8.05279 13.3851 7.875 12.9375 7.875H5.0625C4.61495 7.875 4.18573 8.05279 3.86926 8.36926C3.55279 8.68573 3.375 9.11495 3.375 9.5625V14.625C3.375 15.0726 3.55279 15.5018 3.86926 15.8182C4.18573 16.1347 4.61495 16.3125 5.0625 16.3125Z"
                                                stroke="#A3ABB0" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <input type="nationality" class="form-control" name="nationality" placeholder="Nationality">
                                    </div>
                                </fieldset>
                                <fieldset class="box-fieldset">
                                    <label>CNIC</label>
                                    <div class="ip-field">
                                        <div style="display: flex; align-items: center;  padding: 5px; border-radius: 6px; width: 250px;">


                                            <input type="text" id="cnic" required name="cnic_or_passport" placeholder="XXXXX-XXXXXXX-X" maxlength="15"
                                                oninput="this.value=this.value.replace(/[^0-9-]/g,'')">
                                        </div>

                                    </div>
                                </fieldset>
                                <fieldset class="box-fieldset">
                                    <label>Residental Address</label>
                                    <div class="ip-field">
                                        <textarea name="residential_address" class="form-control"  placeholder="Residental Address" id=""></textarea>
                                    </div>
                                </fieldset>
                            </div>
                        </div>

                    </div>
                    <div class="box box-btn">
                        <input type="submit" class="tf-btn primary w-100" value="Sign up">
                        <div class="text text-center">Don’t you have an account? <a href="#modalLogin"
                                data-bs-toggle="modal" class="text-primary">Sign In</a></div>
                    </div>
                  {{--  <p class="box text-center caption-2">orExplore Programs with</p>
                    <div class="group-btn">
                        <a href="#" class="btn-social">
                            <img src="{{ asset('frontend/images/logo/google.jpg') }}" alt="img">
                            Google
                        </a>
                        <a href="#" class="btn-social">
                            <img src="{{ asset('frontend/images/logo/fb.jpg') }}" alt="img">
                            Facebook
                        </a>

                    </div>
                   --}}    
                </form>


            </div>
        </div>
    </div>
</div>
<script>
  // ---------------------- LOGIN PASSWORD TOGGLE ----------------------
  const togglePassword = document.querySelector('#togglePassword');
  const passwordField = document.querySelector('#password');

  let visible = false;

  togglePassword.addEventListener('click', function () {
    visible = !visible;
    passwordField.type = visible ? 'text' : 'password';

    togglePassword.innerHTML = visible
      ? `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.953 9.953 0 012.224-3.592m2.664-2.06A9.956 9.956 0 0112 5c4.477 0 8.268 2.943 9.542 7a9.956 9.956 0 01-4.279 5.043M15 12a3 3 0 01-3 3m0-6a3 3 0 013 3m-3 3a3 3 0 01-3-3m0 0a3 3 0 013-3"/>`
      : `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>`;
  });


  // ---------------------- SIGNUP PASSWORD TOGGLE ----------------------
  const signupTogglePassword = document.querySelector('#signupTogglePassword');
  const signupPassword = document.querySelector('#signupPassword');

  let visibleForSignup = false;

  signupTogglePassword.addEventListener('click', function () {
    visibleForSignup = !visibleForSignup;
    signupPassword.type = visibleForSignup ? 'text' : 'password';

    signupTogglePassword.innerHTML = visibleForSignup
      ? `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.953 9.953 0 012.224-3.592m2.664-2.06A9.956 9.956 0 0112 5c4.477 0 8.268 2.943 9.542 7a9.956 9.956 0 01-4.279 5.043M15 12a3 3 0 01-3 3m0-6a3 3 0 013 3m-3 3a3 3 0 01-3-3m0 0a3 3 0 013-3"/>`
      : `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>`;
  });
  
  
   // ---------------------- SIGNUP Confirm PASSWORD TOGGLE ----------------------
  const signupToggleConfirmPassword = document.querySelector('#signupToggleConfirmPassword');
  const signupConfirmPassword = document.querySelector('#signupConfirmPassword');

  let visibleConfirmForSignup = false;

  signupToggleConfirmPassword.addEventListener('click', function () {
    visibleConfirmForSignup = !visibleConfirmForSignup;
    signupConfirmPassword.type = visibleConfirmForSignup ? 'text' : 'password';

    signupToggleConfirmPassword.innerHTML = visibleConfirmForSignup
      ? `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.953 9.953 0 012.224-3.592m2.664-2.06A9.956 9.956 0 0112 5c4.477 0 8.268 2.943 9.542 7a9.956 9.956 0 01-4.279 5.043M15 12a3 3 0 01-3 3m0-6a3 3 0 013 3m-3 3a3 3 0 01-3-3m0 0a3 3 0 013-3"/>`
      : `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>`;
  }); 
  
 function validateStrongPassword(password) {
    const minLength = 8;
    const hasUppercase = /[A-Z]/.test(password);
    const hasLowercase = /[a-z]/.test(password);
    const hasNumber = /[0-9]/.test(password);
    const hasSpecialChar = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/.test(password);

    if (password.length < minLength) return "Password must be at least 8 characters long.";
    if (!hasUppercase) return "Password must contain at least one uppercase letter.";
    if (!hasLowercase) return "Password must contain at least one lowercase letter.";
    if (!hasNumber) return "Password must contain at least one number.";
    if (!hasSpecialChar) return "Password must contain at least one special character.";
    return "Strong password.";
  }

  // ✅ Generate strong random password
  function generateStrongPassword(length = 12) {
    const chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*()_+-=[]{}|;:,.<>?";
    let password = "";
    for (let i = 0; i < length; i++) {
      password += chars.charAt(Math.floor(Math.random() * chars.length));
    }
    return password;
  }

  const passwordInput = document.getElementById('signupPassword');
  const confirmInput = document.getElementById('signupConfirmPassword');
  const message = document.getElementById('passwordMessage');
  const confirmMessage = document.getElementById('confirmPasswordMessage');
//   const togglePassword = document.getElementById('signupTogglePassword');
  const toggleConfirm = document.getElementById('signupToggleConfirmPassword');
  const suggestBtn = document.getElementById('suggestPasswordBtn');

  // 👁 Toggle password visibility
  togglePassword.addEventListener('click', () => {
    passwordInput.type = passwordInput.type === 'password' ? 'text' : 'password';
  });
  toggleConfirm.addEventListener('click', () => {
    confirmInput.type = confirmInput.type === 'password' ? 'text' : 'password';
  });

  // 🧩 Validate password strength
  passwordInput.addEventListener('input', () => {
    const result = validateStrongPassword(passwordInput.value);
    message.textContent = result;
    console.log(result);
    message.style.display = "block";
    message.style.color = result === "Strong password." ? "green" : "red";
    passwordInput.style.borderColor = result === "Strong password." ? "green" : "red";
    checkConfirmPassword(); // recheck confirm match as well
  });

  // 🔁 Confirm password match
  confirmInput.addEventListener('input', checkConfirmPassword);
  function checkConfirmPassword() {
    if (!confirmInput.value) {
      confirmMessage.style.display = "none";
      return;
    }

    if (passwordInput.value === confirmInput.value) {
      confirmMessage.textContent = "Passwords match ✅";
      confirmMessage.style.color = "green";
      confirmMessage.style.display = "block";
      confirmInput.style.borderColor = "green";
    } else {
      confirmMessage.textContent = "Passwords do not match ❌";
      confirmMessage.style.color = "red";
      confirmMessage.style.display = "block";
      confirmInput.style.borderColor = "red";
    }
  }

  // 💡 Suggest strong password
  suggestBtn.addEventListener('click', () => {
    const strongPassword = generateStrongPassword();
    passwordInput.value = strongPassword;
    const result = validateStrongPassword(strongPassword);
    message.textContent = result;
    message.style.color = result === "Strong password." ? "green" : "red";
    message.style.display = "block";
    passwordInput.style.borderColor = "green";
    checkConfirmPassword();
  });

//   const passwordInput = document.getElementById('signupPassword');
//   const message = document.getElementById('passwordMessage');
//   const togglePassword = document.getElementById('signupTogglePassword');

  // 👁 Toggle password visibility
  togglePassword.addEventListener('click', () => {
    const type = passwordInput.type === 'password' ? 'text' : 'password';
    passwordInput.type = type;
  });

  // 🧩 Check password as user types
  passwordInput.addEventListener('input', () => {
    const result = validateStrongPassword(passwordInput.value);

    if (result === "Strong password.") {
      message.style.color = "green";
      passwordInput.style.borderColor = "green";
    } else {
      message.style.color = "red";
      passwordInput.style.borderColor = "red";
    }

    message.textContent = result;
    message.style.display = "block";
  });
  
</script>

