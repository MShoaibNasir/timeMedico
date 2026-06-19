<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Signup Page</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: #f8f9fa;
    }
    .card {
      border: none;
      border-radius: 1rem;
      box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    .form-control:focus {
      box-shadow: none;
      border-color: #6c63ff;
    }
    .btn-primary {
      background-color: #6c63ff;
      border: none;
    }
    .btn-primary:hover {
      background-color: #5a54e0;
    }
  </style>
</head>
<body>

<div class="container d-flex align-items-center justify-content-center min-vh-100">
  <div class="col-md-6 col-lg-5">
    <div class="card p-4">
      <div class="card-body">
        <h3 class="text-center mb-4">Create an Account</h3>
        <form method="post" action='{{route("user.register")}}'>
            @csrf
          <div class="mb-3">
            <label for="name" class="form-label">Full Name</label>
            <input type="text" class="form-control"  name="name" id="name" placeholder="John Doe">
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="example@email.com">
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="••••••••">
          </div>
          <div class="mb-3">
            <label for="confirm" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" name='password_confirmation' id="confirm" placeholder="••••••••">
          </div>
          <div class="d-grid">
            <button type="submit" class="btn btn-primary">Sign Up</button>
          </div>
          <p class="text-center mt-3 mb-0">Already have an account? <a href="#">Login</a></p>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
     
        $(document).ready(function() {
            var success = "{{ session('success') }}";
            if (success) {
                console.log('success');
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                });
                Toast.fire({
                    icon: "success",
                    title: success
                });
            }
            var error = "{{ session('error') }}";
            if (error) {
                console.log('error');
                Swal.fire({
                    icon: 'error',
                    title: error,
                    text: "{{ session('error') }}",
                    toast: true, // This enables the toast mode
                    position: 'top-end', // Position of the toast
                    showConfirmButton: false, // Hides the confirm button
                    timer: 3000 // Time to show the toast in milliseconds
                });
            }
            console.log(error);
        });
    
</script>
</body>
</html>
