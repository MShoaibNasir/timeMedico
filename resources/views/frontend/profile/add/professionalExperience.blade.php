 <div class="nexus-section-card">
                    <h2 class="nexus-section-title">
                        <div class="section-icon">
                            <i class="fas fa-briefcase"></i>
                        </div>
                        Professional Experience
                    </h2>
                    
                    <div id="experienceContainer">
                        <div class="dynamic-section">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="nexus-form-group">
                                        <label class="form-label">Job Title <span class="nexus-required">*</span></label>
                                        <input type="text" class="form-control" name="job_title" id='job_title' nexus-required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="nexus-form-group">
                                        <label class="form-label">Organization Name <span class="nexus-required">*</span></label>
                                        <input type="text" class="form-control" name="organization_name" id='organization_name' nexus-required>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="nexus-form-group">
                                <label class="form-label">Job Description (2 line summary) <span class="nexus-required">*</span></label>
                                <textarea 
                                    class="form-control" 
                                    name="job_description" 
                                    id="job_description"
                                    rows="2" 
                                    maxlength="220" 
                                    oninput="limitLines(this, 2)" 
                                    nexus-required
                                ></textarea>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="nexus-form-group">
                                        <label class="form-label">Country <span class="nexus-required">*</span></label>
                                        <input type="text" class="form-control" id='country' name="country" nexus-required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="nexus-form-group">
                                        <label class="form-label">Start Date <span class="nexus-required">*</span></label>
                                        <input type="date" class="form-control" id='experience_start_date' name="experience_start_date" nexus-required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="nexus-form-group">
                                        <label class="form-label">End Date</label>
                                        <input type="date" class="form-control" id="experience_end_date"  name="experience_end_date">
                                        <div class="checkbox-group mt-2">
                                            <input type="checkbox" name="is_current">
                                            <label>Currently working here</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="affidavit-section">
                               
                                <div class="checkbox-group">
                                    <input type="checkbox" name="affidavit" id='affidavit' nexus-required>
                                    <label>I hereby confirm the authenticity, accuracy, and completeness of the information and documents provided herein.</label>
                                </div>
                            </div>
                        
                        </div>
                    </div>
                    
                    <button type="button" class="add-more-btn" id='addMoreExperience'>
                        <i class="fas fa-plus me-2"></i>Add Experience
                    </button>
                    <div id="showExperienceList"></div>
                </div>
@push('scripts')
<script>
  
        
    function showProfessionalExperience() {
     
        $.ajax({
            url: '{{ route('frontend.experienceList') }}',
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                $('#showExperienceList').html(response);
            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
   
    }
      showProfessionalExperience();
    $('#addMoreExperience').click(function () {
    const container = document.getElementById('experienceContainer');
    const lastSection = container.querySelector('.dynamic-section:last-of-type');
    let valid = true;

    // Required fields (checkboxes handled separately)
    const requiredFields = [
        '[name="job_title"]',
        '[name="organization_name"]',
        '[name="job_description"]',
        '[name="country"]',
        '[name="experience_start_date"]',
        '[name="affidavit"]'
    ];

    requiredFields.forEach(selector => {
        const input = lastSection.querySelector(selector);
        if (!input) return; // safety check

        if (input.type === 'checkbox') {
            if (!input.checked) {
                valid = false;
                input.closest('.checkbox-group').style.outline = '1px solid red';
            } else {
                input.closest('.checkbox-group').style.outline = '';
            }
        } else {
            if (!input.value.trim()) {
                valid = false;
                input.style.borderColor = 'red';
            } else {
                input.style.borderColor = '';
            }
        }
    });

    if (!valid) {
        alert("⚠️ Please fill all required fields including the affidavit.");
        return;
    }

    // Collect data from the last dynamic section
    const experienceDetails = {
        job_title: lastSection.querySelector('[name="job_title"]').value,
        organization_name: lastSection.querySelector('[name="organization_name"]').value,
        job_description: lastSection.querySelector('[name="job_description"]').value,
        country: lastSection.querySelector('[name="country"]').value,
        start_date: lastSection.querySelector('[name="experience_start_date"]').value,
        end_date: lastSection.querySelector('[name="experience_end_date"]') 
                 ? lastSection.querySelector('[name="experience_end_date"]').value 
                 : '',
        affidavit: lastSection.querySelector('[name="affidavit"]').checked ? 1 : 0
    };

    $.ajax({
        url: '{{ route("frontend.saveExperience") }}',
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: experienceDetails,
        beforeSend: function () {
            Swal.fire({
                title: 'Saving...',
                text: 'Please wait',
                allowOutsideClick: false,
                didOpen: () => Swal.showLoading()
            });
        },
        success: function (response) {
            Swal.close();
            Swal.fire({
                title: 'Save Experience Data',
                text: 'Experience Data added successfully!',
                icon: 'success',
                timer: 3000
            });

            // Clear the input fields in the last section
            lastSection.querySelectorAll('input, textarea').forEach(input => {
                if (input.type === 'checkbox') {
                    input.checked = false;
                } else {
                    input.value = '';
                }
            });

            showProfessionalExperience();
        },
        error: function (xhr, status, error) {
            Swal.close();
            console.error(error);
        }
    });
});

 
</script>
@endpush
