@extends('frontend.layout.master')
@section('content')
<style>
    .toggle-password {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        font-size: 16px;
        color: #999;
        user-select: none;
    }

    .toggle-password:hover {
        color: #333;
    }

    .error-message {
        color: red;
        /* Color for the error text */
        font-weight: bold;
        /* Makes the error text stand out more */
    }

    .success-message {
        color: green;
        /* Color for a potential success message */
    }

    /* For Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* For Firefox */
    input[type="number"] {
        -moz-appearance: textfield;
    }

    /* General property for other browsers, though the above are usually sufficient */
    input[type="number"] {
        appearance: textfield;
    }

    td {
        text-wrap: auto;
    }
</style>
<section class="flat-title-page">
<div class="flat-section-v4">
    <div class="nexus-form-container">
        <!-- Form Header -->
        <div class="form-header-professional">
            <h1 class="nexus-form-title text-white text-center">
                <i class="fas fa-user-edit me-3"></i>
                Professional Profile
            </h1>
            <p class="nexus-form-subtitle text-white text-center">Complete your professional profile information</p>
        </div>
        <!-- Progress Bar -->
        <div class="nexus-form-content">
            <form action='{{route('frontend.updateProfile')}}' id='profileForm' method='post' enctype="multipart/form-data">
                @csrf
                <!-- Basic Account Information -->
                @include('frontend.profile.add.basicInfo')
                <!-- Bio / Personal Profile -->
                @include('frontend.profile.add.bioProfile', ['user' => $user])
                <!-- Education -->
                <div class="flat-bt-top">
                    <input type='submit' value='Update Basic Info' style="margin-left: 30px;" class="btn btn-success submit_btn my-4">
                </div>
                @include('frontend.profile.add.education', ['user' => $user])
                <!-- Professional Experience -->
                @include('frontend.profile.add.professionalExperience')
                <!--director ship-->
                @include('frontend.profile.add.directorShip')
                <!--boardCommittee-->
                @include('frontend.profile.add.boardCommittee')
                <!-- Skills -->
                @include('frontend.profile.add.skills')
                <!-- additional certificate -->
                @include('frontend.profile.add.additionalCertificate')
                <!-- publications -->
                @include('frontend.profile.add.publication')
                <!-- award -->
                @include('frontend.profile.add.award')

            </form>
        </div>
    </div>
</div>
</section>
@push('scripts')
<script>
    function isValidUrl(urlString) {
        try {
            new URL(urlString);
            return true;
        } catch (error) {
            return false;
        }
    }


    $('#linkdink_url').keyup(function() {
        const result = isValidUrl($(this).val());
        const errorSpan = $('#linkdink_url_error');

        if (result) {
            errorSpan.text('Valid URL!'); // Optional success message
            errorSpan.removeClass('error-message').addClass('success-message');
        } else {
            errorSpan.text('Could you please provide the URL?');
            errorSpan.removeClass('success-message').addClass('error-message'); // Apply the error class
        }
    });



    $('#website_url').keyup(function() {
        const result = isValidUrl($(this).val());
        const errorSpan = $('#website_url_error');

        if (result) {
            errorSpan.text('Valid URL!'); // Optional success message
            errorSpan.removeClass('error-message').addClass('success-message');
        } else {
            errorSpan.text('Could you please provide the URL?');
            errorSpan.removeClass('success-message').addClass('error-message'); // Apply the error class
        }
    });
    $('#facebok_url').keyup(function() {
        const result = isValidUrl($(this).val());
        const errorSpan = $('#facebok_url_error');

        if (result) {
            errorSpan.text('Valid URL!'); // Optional success message
            errorSpan.removeClass('error-message').addClass('success-message');
        } else {
            errorSpan.text('Could you please provide the URL?');
            errorSpan.removeClass('success-message').addClass('error-message'); // Apply the error class
        }
    });
    $('#twitter_url').keyup(function() {
        const result = isValidUrl($(this).val());
        const errorSpan = $('#twitter_url_error');

        if (result) {
            errorSpan.text('Valid URL!'); // Optional success message
            errorSpan.removeClass('error-message').addClass('success-message');
        } else {
            errorSpan.text('Could you please provide the URL?');
            errorSpan.removeClass('success-message').addClass('error-message'); // Apply the error class
        }
    });
    $('#instagram_url').keyup(function() {
        const result = isValidUrl($(this).val());
        const errorSpan = $('#instagram_url_error');

        if (result) {
            errorSpan.text('Valid URL!'); // Optional success message
            errorSpan.removeClass('error-message').addClass('success-message');
        } else {
            errorSpan.text('Could you please provide the URL?');
            errorSpan.removeClass('success-message').addClass('error-message'); // Apply the error class
        }
    });




    document.querySelector('textarea[name="bio_summary"]').addEventListener('input', function() {
        const counter = document.getElementById('bioCounter');
        counter.textContent = this.value.length;
    });


    function addEducation() {
        const container = document.getElementById('educationContainer');
        const lastSection = container.querySelector('.dynamic-section:last-of-type');
        let valid = true;

        // Required field selectors
        const requiredFields = [
            '[name="degree_title[]"]',
            '[name="institute_name[]"]',
            '[name="edu_country[]"]',
            '[name="start_date[]"]',
            '[name="end_date[]"]',
            '[name="majors[]"]',
            '[name="obtained_marks[]"]',
            '[name="total_marks[]"]',
            '[name="obtained_percentage[]"]',
            '[name="grade[]"]',
        ];

        // Check if last added section is complete
        requiredFields.forEach(selector => {
            const input = lastSection.querySelector(selector);
            if (!input.value.trim()) {
                valid = false;
                input.style.borderColor = 'red'; // highlight missing
            } else {
                input.style.borderColor = ''; // remove red border
            }
        });

        if (!valid) {
            alert("⚠️ Please fill all required fields before adding another education entry.");
            return; // stop here if not valid
        }

        // If all required fields are filled, clone and clear new section
        const newSection = lastSection.cloneNode(true);
        newSection.querySelectorAll('input, textarea, select').forEach(input => {
            if (input.type === 'checkbox') {
                input.checked = false;
            } else {
                input.value = '';
            }
            input.style.borderColor = ''; // clear any previous red borders
        });

        container.appendChild(newSection);
        updateProgress(); // your custom function
    }

    // Add Experience
    function addExperience() {
        const container = document.getElementById('experienceContainer');
        const newSection = container.querySelector('.dynamic-section').cloneNode(true);

        // Clear all inputs
        newSection.querySelectorAll('input, textarea, select').forEach(input => {
            if (input.type === 'checkbox') {
                input.checked = false;
            } else {
                input.value = '';
            }
        });

        container.appendChild(newSection);
        updateProgress();
    }

    // Add Skill
    function addSkill() {
        const container = document.getElementById('skillsContainer');
        const newSection = container.querySelector('.dynamic-section').cloneNode(true);

        // Clear all inputs
        newSection.querySelectorAll('input, select').forEach(input => {
            input.value = '';
        });

        // Reset proficiency scale
        newSection.querySelectorAll('.scale-item').forEach(item => {
            item.classList.remove('active');
        });

        container.appendChild(newSection);
        setupProficiencyScale(newSection);
        updateProgress();
    }

    // Remove Section
    function removeSection(button) {
        const section = button.closest('.dynamic-section');
        const container = section.parentNode;

        if (container.children.length > 1) {
            section.remove();
            updateProgress();
        }
    }

    // Setup Proficiency Scale
    function setupProficiencyScale(container = document) {
        container.querySelectorAll('.proficiency-scale').forEach(scale => {
            const items = scale.querySelectorAll('.scale-item');
            const hiddenInput = scale.parentNode.querySelector('input[type="hidden"]');

            items.forEach(item => {
                item.addEventListener('click', function() {
                    const value = this.dataset.value;
                    hiddenInput.value = value;

                    // Update visual state
                    items.forEach((scaleItem, index) => {
                        if (index < value) {
                            scaleItem.classList.add('active');
                        } else {
                            scaleItem.classList.remove('active');
                        }
                    });
                });
            });
        });
    }

    // Update Progress Bar
    // function updateProgress() {
    //     const form = document.getElementById('profileForm');
    //     const totalFields = form.querySelectorAll('input[nexus-required], select[nexus-required], textarea[nexus-required]').length;
    //     const filledFields = Array.from(form.querySelectorAll('input[nexus-required], select[nexus-required], textarea[nexus-required]'))
    //         .filter(field => field.value.trim() !== '').length;

    //     const progress = (filledFields / totalFields) * 100;
    //     document.getElementById('progressFill').style.width = progress + '%';
    // }



    // Initialize
    document.addEventListener('DOMContentLoaded', function() {
        setupProficiencyScale();
        // updateProgress();

        // Update progress on input change
        // document.querySelectorAll('input, select, textarea').forEach(field => {
        //     field.addEventListener('input', updateProgress);
        //     field.addEventListener('change', updateProgress);
        // });
    });
</script>
@endpush

@endsection