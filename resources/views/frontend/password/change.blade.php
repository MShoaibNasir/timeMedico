@extends('frontend.layout.master')

@section('content')

<style>
.password-reset-container {
    max-width: 450px;
    margin: 60px auto;
    background: #fff;
    border-radius: 12px;
    padding: 40px 35px;
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
    margin-top:200px !important;
}

.password-reset-container h2 {
    text-align: center;
    color: #0d1b2a;
    font-weight: 700;
    margin-bottom: 25px;
}

.password-reset-container form {
    position: relative;
}

.form-group {
    position: relative;
    margin-bottom: 20px;
}

.form-control {
    width: 100%;
    padding: 12px 40px 12px 14px;
    font-size: 15px;
    border: 1px solid #ccc;
    border-radius: 8px;
    transition: border-color 0.3s;
}

.form-control:focus {
    border-color: #007bff;
    outline: none;
}

.toggle-password {
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
    font-size: 17px;
    color: #999;
    user-select: none;
}

.toggle-password:hover {
    color: #333;
}

.btn-reset {
    display: block;
    width: 100%;
    background-color: #0d6efd;
    color: white;
    padding: 12px;
    border: none;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.3s;
}

.btn-reset:hover {
    background-color: #0b5ed7;
}

.suggest-btn {
    background-color: #198754;
    color: #fff;
    padding: 6px 10px;
    border: none;
    border-radius: 6px;
    font-size: 13px;
    cursor: pointer;
    position: absolute;
    right: 38px;
    top: 50%;
    transform: translateY(-50%);
}

.error-message {
    color: red;
    font-size: 14px;
    margin-top: 4px;
}
.success-message {
    color: green;
    font-size: 14px;
    margin-top: 4px;
}
</style>

<div class="password-reset-container">
    <h2>Reset Your Password</h2>

    <form method="POST" action="{{route('frontend.updatePassword')}}">
        @csrf
        <input type="hidden" name="email" value="{{ $user->email }}">

        <div class="form-group">
            <label for="password">New Password</label>
            <input 
                type="password" 
                class="form-control" 
                id="password" 
                name="password" 
                placeholder="Enter new password" 
                required
                autocomplete="off"
            >
            <button type="button" class="suggest-btn" id="suggestPasswordBtn">Suggest</button>
            <span toggle="#password" class="toggle-password">👁️</span>
            <small id="passwordMessage" style="display:none;"></small>
        </div>

        @error('password')
            <span class="error-message text-danger my-4">{{ $message }}</span>
        @enderror

        <div class="form-group">
            <label for="password_confirmation">Confirm Password</label>
            <input 
                type="password" 
                class="form-control" 
                id="password_confirmation" 
                name="password_confirmation" 
                placeholder="Confirm your password" 
                required
                autocomplete="off"
            >
            <span toggle="#password_confirmation" class="toggle-password">👁️</span>
        </div>

        {{--@error('password_confirmation')
            <span class="error-message text-danger my-4">{{ $message }}</span>
        @enderror--}}

        <button type="submit" class="btn-reset">Update Password</button>
    </form>
</div>

<script>
// Toggle Password Visibility
document.querySelectorAll('.toggle-password').forEach(icon => {
    icon.addEventListener('click', function() {
        const input = document.querySelector(this.getAttribute('toggle'));
        const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
        input.setAttribute('type', type);
        this.textContent = type === 'password' ? '👁️' : '🙈';
    });
});

// Password Strength Validation
function validateStrongPassword(password) {
    const minLength = 8;
    const hasUppercase = /[A-Z]/.test(password);
    const hasLowercase = /[a-z]/.test(password);
    const hasNumber = /[0-9]/.test(password);
    const hasSpecialChar = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/.test(password);

    if (password.length < minLength) return "Password must be at least " + minLength + " characters long.";
    if (!hasUppercase) return "Password must contain at least one uppercase letter.";
    if (!hasLowercase) return "Password must contain at least one lowercase letter.";
    if (!hasNumber) return "Password must contain at least one number.";
    if (!hasSpecialChar) return "Password must contain at least one special character.";
    return "Strong password.";
}

// Live Validation
const passwordInput = document.getElementById('password');
const message = document.getElementById('passwordMessage');
passwordInput.addEventListener('input', function() {
    const result = validateStrongPassword(this.value);
    message.style.display = 'block';
    message.textContent = result;
    message.className = result === 'Strong password.' ? 'success-message' : 'error-message';
});

// Password Suggestion
function generateStrongPassword() {
    const chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*()_+";
    let password = "";
    for (let i = 0; i < 12; i++) {
        password += chars.charAt(Math.floor(Math.random() * chars.length));
    }
    return password;
}

document.getElementById('suggestPasswordBtn').addEventListener('click', function() {
    const newPassword = generateStrongPassword();
    passwordInput.value = newPassword;
    message.style.display = 'block';
    message.textContent = "Suggested: " + newPassword;
    message.className = "success-message";
});
</script>

@endsection
