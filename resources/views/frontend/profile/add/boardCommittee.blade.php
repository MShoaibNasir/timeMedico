 <div class="nexus-section-card">
                    <h2 class="nexus-section-title">
                        <div class="section-icon">
                            <i class="fas fa-users-cog"></i>
                        </div>
                      Board Committee Memberships 
                    </h2>
                    
                    <div id="boardCommiteeContainer">
                        <div class="dynamic-section">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="nexus-form-group">
                                        <label class="form-label">Organization Name <span class="nexus-required">*</span></label>
                                        <input type="text" class="form-control" name="organization_name" id='organization_name' nexus-required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="nexus-form-group">
                                        <label class="form-label">Sector<span class="nexus-required">*</span></label>
                                        <input type="text" class="form-control" name="sector" id='sector' nexus-required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="nexus-form-group">
                                        <label class="form-label">Committee name<span class="nexus-required">*</span></label>
                                        <input type="text" class="form-control" name="committee_name" id='committee_name' nexus-required>
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
                                        <label class="form-label">Start Date<span class="nexus-required">*</span></label>
                                        <input type="date" class="form-control" name="experience_start_date" id='board_start_date' nexus-required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="nexus-form-group">
                                        <label class="form-label">End Date<span class="nexus-required">*</span></label>
                                        <input type="date" class="form-control" name="experience_end_date" id='experience_end_date' nexus-required>
                                    </div>
                                </div>
                                {{--
                                <div class="col-md-6">
                                    <div class="checkbox-group">
                                        <label class="form-label">Status<span class="nexus-required">*</span></label>
                                        <input type="checkbox"  name="board_status" id='board_status' nexus-required>
                                    </div>
                                </div>
                                --}}
                            </div>
                            
                        
                            
                            <div class="affidavit-section">
                               
                                <div class="checkbox-group">
                                    <input type="checkbox" name="affidavit" id='affidavit' nexus-required>
                                    <label>I hereby confirm the authenticity, accuracy, and completeness of the information and documents provided herein.</label>
                                </div>
                            </div>
                        
                        </div>
                    </div>
                    
                    <button type="button" class="add-more-btn" id='addMoreMember'>
                        <i class="fas fa-plus me-2"></i>Add Member
                    </button>
                    <div id="showMemberList"></div>
                </div>
@push('scripts')
<script>
  
        
    function showBoardData() {
     
        $.ajax({
            url: '{{ route('frontend.boardList') }}',
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                $('#showMemberList').html(response);
            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
   
    }
      showBoardData();
    $('#addMoreMember').click(function () {
    const container = document.getElementById('boardCommiteeContainer');
    const lastSection = container.querySelector('.dynamic-section:last-of-type');
    let valid = true;

    // Required fields (checkboxes handled separately)
    const requiredFields = [
        '[name="organization_name"]',
        '[name="sector"]',
        '[name="committee_name"]',
        '[name="designation"]',
        '[name="board_start_date"]',
        '[name="board_end_date"]',
        // '[name="board_status"]',
        '[name="affidavit"]',
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
    const boardCommitteeDetails = {
        organization_name: lastSection.querySelector('[name="organization_name"]').value,
        Sector: lastSection.querySelector('[name="sector"]').value,
        committee_name: lastSection.querySelector('[name="committee_name"]').value,
        designation: lastSection.querySelector('[name="designation"]').value,
        start_date: lastSection.querySelector('[name="experience_start_date"]').value,
        end_date: lastSection.querySelector('[name="experience_end_date"]') 
                 ? lastSection.querySelector('[name="experience_end_date"]').value 
                 : '',
        affidavit: lastSection.querySelector('[name="affidavit"]').checked ? 1 : 0,
       // status: lastSection.querySelector('[name="board_status"]').checked ? 1 : 0,
    };

    $.ajax({
        url: '{{ route("frontend.saveBoardMember") }}',
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: boardCommitteeDetails,
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
                title: 'Save Board Member Data',
                text: 'Board Member Data added successfully!',
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

            showBoardData();
        },
        error: function (xhr, status, error) {
            Swal.close();
            console.error(error);
        }
    });
});

 
</script>
@endpush
