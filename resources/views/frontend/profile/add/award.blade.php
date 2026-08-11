 <div class="nexus-section-card">
                    <h2 class="nexus-section-title">
                        <div class="section-icon">
                            <i class="fas fa-trophy"></i>
                        </div>
                      Awards
                    </h2>
                    
                    <div id="awardContainer">
                        <div class="dynamic-section">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="nexus-form-group">
                                        <label class="form-label">Title<span class="nexus-required">*</span></label>
                                        <input type="text" class="form-control" name="title" id='title' nexus-required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="nexus-form-group">
                                        <label class="form-label">Organization<span class="nexus-required">*</span></label>
                                        <input type="text" class="form-control" name="organization" id='organization' nexus-required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="nexus-form-group">
                                        <label class="form-label">Evaluation Period<span class="nexus-required">*</span></label>
                                        <input type="text" class="form-control" name="evaluation_period" id='evaluation_period' nexus-required>
                                    </div>
                                </div>

                              
                           
                                <div class="col-md-6">
                                    <div class="nexus-form-group">
                                        <label class="form-label">Comments<span class="nexus-required">*</span></label>
                                        <input type="text" class="form-control" name="comments" id='comments' nexus-required>
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
                    
                    <button type="button" class="add-more-btn" id='addAward'>
                        <i class="fas fa-plus me-2"></i>Add Award
                    </button>
                    <div id="awardList"></div>
                </div>
@push('scripts')
<script>
  
        
    function showAward() {
     
        $.ajax({
            url: "{{ route('frontend.award.list') }}",
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                $('#awardList').html(response);
            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
   
    }
      showAward();
    $('#addAward').click(function () {
    const container = document.getElementById('awardContainer');
    const lastSection = container.querySelector('.dynamic-section:last-of-type');
    let valid = true;

    // Required fields (checkboxes handled separately)
    const requiredFields = [
        '[name="comments"]',
        '[name="evaluation_period"]',
        '[name="organization"]',
        '[name="title"]',
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
        comments: lastSection.querySelector('[name="comments"]').value,
        evaluation_period: lastSection.querySelector('[name="evaluation_period"]').value,
        organization: lastSection.querySelector('[name="organization"]').value,
        title: lastSection.querySelector('[name="title"]').value,
        affidavit: lastSection.querySelector('[name="affidavit"]').checked ? 1 : 0
    };

    $.ajax({
        url: '{{ route("frontend.saveAward") }}',
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
                title: 'Save Award Data',
                text: 'Award Data Save successfully!',
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

            showAward();
        },
        error: function (xhr, status, error) {
            Swal.close();
            console.error(error);
        }
    });
});

 
</script>
@endpush
