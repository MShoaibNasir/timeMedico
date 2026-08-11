 <div class="nexus-section-card">
                    <h2 class="nexus-section-title">
                        <div class="section-icon">
                            <i class="fas fa-certificate"></i>
                        </div>
                      Additional Certificate
                    </h2>
                    
                    <div id="certificateContainer">
                        <div class="dynamic-section">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="nexus-form-group">
                                        <label class="form-label">certificate title<span class="nexus-required">*</span></label>
                                        <input type="text" class="form-control" name="certificate_title" id='certificate_title' nexus-required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="nexus-form-group">
                                        <label class="form-label">Skills<span class="nexus-required">*</span></label>
                                        <input type="text" class="form-control" name="skills" id='skills' placeholder='skill1,skill2' nexus-required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="nexus-form-group">
                                        <label class="form-label">Issuing Organization<span class="nexus-required">*</span></label>
                                        <input type="text" class="form-control" name="issuing_organization" id='issuing_organization' nexus-required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="nexus-form-group">
                                        <label class="form-label">Issue Date<span class="nexus-required">*</span></label>
                                        <input type="date" class="form-control" name="issue_date" id='issue_date' nexus-required>
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
                    
                    <button type="button" class="add-more-btn" id='addMoreCertificate'>
                        <i class="fas fa-plus me-2"></i>Add Certificate
                    </button>
                    <div id="showCertificate"></div>
                </div>
@push('scripts')
<script>
    function showAdditionCertificateList() {
        $.ajax({
            url: "{{ route('frontend.certificateList') }}",
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                $('#showCertificate').html(response);
            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
   
    }
    showAdditionCertificateList();
    $('#addMoreCertificate').click(function () {
    const container = document.getElementById('certificateContainer');
    const lastSection = container.querySelector('.dynamic-section:last-of-type');
    let valid = true;

    // Required fields (checkboxes handled separately)
    const requiredFields = [
        '[name="certificate_title"]',
        '[name="skills"]',
        '[name="issuing_organization"]',
        '[name="issue_date"]',
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
        certificate_title: lastSection.querySelector('[name="certificate_title"]').value,
        skills: lastSection.querySelector('[name="skills"]').value,
        issuing_organization: lastSection.querySelector('[name="issuing_organization"]').value,
        issue_date: lastSection.querySelector('[name="issue_date"]').value,
        affidavit: lastSection.querySelector('[name="affidavit"]').checked ? 1 : 0
    };

    $.ajax({
        url: '{{ route("frontend.saveAdditionCertificate") }}',
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
            console.log(response);
            Swal.close();
            Swal.fire({
                title: 'Save Certificate Data',
                text: 'Certificate Data added successfully!',
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

            showAdditionCertificateList();
        },
        error: function (xhr, status, error) {
            Swal.close();
            console.error(error);
        }
    });
    
});

 
</script>
@endpush
