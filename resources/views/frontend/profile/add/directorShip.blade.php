 <div class="nexus-section-card">
                    <h2 class="nexus-section-title">
                        <div class="section-icon">
                            <i class="fas fa-chalkboard"></i>
                        </div>
                        Directorships / Board Memberships
                    </h2>
                    
                    <div id="directorShipContainer">
                        <div class="dynamic-section">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="nexus-form-group">
                                        <label class="form-label">Organization Name<span class="nexus-required">*</span></label>
                                        <input type="text" class="form-control" name="organization_name" id='organization_name' nexus-required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="nexus-form-group">
                                        <label class="form-label">Sector<span class="nexus-required">*</span></label>
                                        <input type="text" class="form-control" name="Sector" id='Sector' nexus-required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="nexus-form-group">
                                        <label class="form-label">Designation - Member/Chairperson<span class="nexus-required">*</span></label>
                                        <input type="text" class="form-control" name="designation" id='designation' nexus-required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="nexus-form-group">
                                        <label class="form-label">Nature – Executive, Independent, Nominee<span class="nexus-required">*</span></label>
                                        <input type="text" class="form-control" name="executive" id='executive' nexus-required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="nexus-form-group">
                                        <label class="form-label">Start Date<span class="nexus-required">*</span></label>
                                        <input type="date" class="form-control" name="start_date" id='' nexus-required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="nexus-form-group">
                                        <label class="form-label">End Date<span class="nexus-required">*</span></label>
                                        <input type="date" class="form-control" name="end_date" id='end_date' nexus-required>
                                    </div>
                                </div>
                                {{-- <div class="col-md-6">
                                    <div class="checkbox-group">
                                        <label class="form-label">Status<span class="nexus-required">*</span></label>
                                        <input type="checkbox"  name="status" id='status' nexus-required>
                                    </div>
                                </div> --}}
                            </div>
                            
                        
                            
                            <div class="affidavit-section">
                                <div class="checkbox-group">
                                    <input type="checkbox" name="director_affidavit" id='director_affidavit' nexus-required>
                                    <label>I hereby confirm the authenticity, accuracy, and completeness of the information and documents provided herein.</label>
                                </div>
                            </div>
                        
                        </div>
                    </div>
                    
                    <button type="button" class="add-more-btn" id='addMoreDirectorship'>
                        <i class="fas fa-plus me-2"></i>Add Directorship 
                    </button>
                    <div id="showDirectorshipList"></div>
                </div>
@push('scripts')
<script>
  
        
    function showDirectorData() {
     
        $.ajax({
            url: '{{ route('frontend.directorList') }}',
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                console.log("test");
                $('#showDirectorshipList').html(response);
            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
   
    }
      showDirectorData();
    $('#addMoreDirectorship').click(function () {
    const container = document.getElementById('directorShipContainer');
    const lastSection = container.querySelector('.dynamic-section:last-of-type');
    let valid = true;

    // Required fields (checkboxes handled separately)
    const requiredFields = [
        '[name="organization_name"]',
        '[name="Sector"]',
        '[name="designation"]',
        '[name="executive"]',
        '[name="start_date"]',
        '[name="end_date"]',
        //'[name="status"]',
        '[name="director_affidavit"]',
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
    const directorshipDetails = {
        organization_name: lastSection.querySelector('[name="organization_name"]').value,
        Sector: lastSection.querySelector('[name="Sector"]').value,
        designation: lastSection.querySelector('[name="designation"]').value,
        executive: lastSection.querySelector('[name="executive"]').value,
        start_date: lastSection.querySelector('[name="start_date"]').value,
        // status: lastSection.querySelector('[name="status"]').checked ? 1 : 0,
        end_date: lastSection.querySelector('[name="end_date"]') 
                 ? lastSection.querySelector('[name="end_date"]').value 
                 : '',
        director_affidavit: lastSection.querySelector('[name="director_affidavit"]').checked ? 1 : 0
    };


    $.ajax({
        url: '{{ route("frontend.saveDirector") }}',
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: directorshipDetails,
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
                title: 'Save Director Data',
                text: 'Director Data added successfully!',
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

            showDirectorData();
        },
        error: function (xhr, status, error) {
            Swal.close();
            console.error(error);
        }
    });
});

 
</script>
@endpush
