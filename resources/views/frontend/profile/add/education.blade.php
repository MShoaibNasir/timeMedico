 <div class="nexus-section-card">
     <h2 class="nexus-section-title">
         <div class="section-icon">
             <i class="fas fa-graduation-cap"></i>
         </div>
         Education
     </h2>

     <div id="educationContainer">
         <div class="dynamic-section">
             {{-- <button type="button" class="remove-btn" onclick="removeSection(this)">Remove</button> --}}

             <div class="row">
                 <div class="col-md-6">
                     <div class="nexus-form-group">
                         <label class="form-label">Degree/Certification Title <span class="nexus-required">*</span></label>
                         <input type="text" class="form-control" name="degree_title" id="degree_title" nexus-required>
                     </div>
                 </div>
                 <div class="col-md-6">
                     <div class="nexus-form-group">
                         <label class="form-label">Institute Name <span class="nexus-required">*</span></label>
                         <input type="text" class="form-control" name="institute_name" id="institute_name" nexus-required>
                     </div>
                 </div>
             </div>

             <div class="nexus-form-group">
                 <label class="form-label">Majors</label>
                 <input type="text" class="form-control" name="majors" id="majors" placeholder="Subject 1, Subject 2, Subject 3...">
             </div>

             <div class="row">
                 <div class="col-md-4">
                     <div class="nexus-form-group">
                         <label class="form-label">Country <span class="nexus-required">*</span></label>
                         <input type="text" class="form-control" name="edu_country" id="edu_country" nexus-required>
                     </div>
                 </div>
                 <div class="col-md-4">
                     <div class="nexus-form-group">
                         <label class="form-label">Start Date <span class="nexus-required">*</span></label>
                         <input type="date" class="form-control" name="start_date" id="start_date" nexus-required>
                     </div>
                 </div>
                 <div class="col-md-4">
                     <div class="nexus-form-group">
                         <label class="form-label">End Date <span class="nexus-required">*</span></label>
                         <input type="date" class="form-control" name="end_date" id="end_date" nexus-required>
                     </div>
                 </div>
             </div>

             <div class="row">
                 <div class="col-md-3">
                     <div class="nexus-form-group">
                         <label class="form-label">Obtained Marks</label>
                         <input type="number" class="form-control" name="obtained_marks" id="obtained_marks">
                     </div>
                 </div>
                 <div class="col-md-3">
                     <div class="nexus-form-group">
                         <label class="form-label">Total Marks</label>
                         <input type="number" class="form-control" name="total_marks" id="total_marks">
                     </div>
                 </div>
                 <div class="col-md-3">
                     <div class="nexus-form-group">
                         <label class="form-label">Obtained Percentage</label>
                         <input type="number" class="form-control" name="obtained_percentage" id="obtained_percentage" step="0.01">
                     </div>
                 </div>
                 <div class="col-md-3">
                     <div class="nexus-form-group">
                         <label class="form-label">Grade</label>
                         <input type="text" class="form-control" name="grade" id="grade">
                     </div>
                 </div>
             </div>
             <div class="affidavit-section">

                 <div class="checkbox-group">
                     <input type="checkbox" name="affidavit" id="affidavit" nexus-required>
                     <label>I hereby confirm the authenticity, accuracy, and completeness of the information and documents provided herein.</label>
                 </div>
             </div>
         </div>
     </div>

     <button type="button" class="add-more-btn" id='addMoreEducation'>
         <i class="fas fa-plus me-2"></i>Add Education
     </button>
     <div id="showEducationList"></div>
 </div>
 @push('scripts')
 <script>
     function showEducation() {

         $.ajax({
             url: "{{ route('frontend.addEducationList') }}",
             method: 'POST',

             // beforeSend: function () {
             //     Swal.fire({
             //         title: 'Loading...',
             //         text: 'Please wait',
             //         allowOutsideClick: false,
             //         didOpen: () => {
             //             Swal.showLoading();
             //         }
             //     });
             // },

             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },

             success: function(response) {
                //  Swal.close(); // ✅ Close loader
                 $('#showEducationList').html(response);
             },

             error: function(xhr, status, error) {
                 Swal.close(); // ✅ Close loader
                 console.error(error);
             }
         });
     }
     showEducation();
     $('#addMoreEducation').click(function() {
         const container = document.getElementById('educationContainer');
         const lastSection = container.querySelector('.dynamic-section:last-of-type');
         let valid = true;

         const requiredFields = [
             '[name="degree_title"]',
             '[name="institute_name"]',
             '[name="edu_country"]',
             '[name="start_date"]',
             '[name="end_date"]',
             '[name="majors"]',
             '[name="obtained_marks"]',
             '[name="total_marks"]',
             '[name="obtained_percentage"]',
             '[name="grade"]',
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
             alert("⚠️ Please fill all required fields before adding another education entry.");
             return;
         }

         const educationDetails = {
             degree_title: $('#degree_title').val(),
             institute_name: $('#institute_name').val(),
             majors: $('#majors').val(),
             edu_country: $('#edu_country').val(),
             start_date: $('#start_date').val(),
             end_date: $('#end_date').val(),
             obtained_marks: $('#obtained_marks').val(),
             total_marks: $('#total_marks').val(),
             obtained_percentage: $('#obtained_percentage').val(),
             grade: $('#grade').val()
         };


         $.ajax({
             url: "{{ route('frontend.saveEducation') }}",
             method: 'POST',

             beforeSend: function() {
                 Swal.fire({
                     title: 'Saving...',
                     text: 'Please wait',
                     allowOutsideClick: false,
                     didOpen: () => {
                         Swal.showLoading();
                     }
                 });
             },

             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },

             data: educationDetails,

             success: function(response) {
                 Swal.close(); // ✅ Close loader.
                 Swal.fire({
                     title: 'Save Education Data',
                     text: 'Education Data added successfully!',
                     icon: 'success',
                     timer: 3000,
                 });

                 // Clear the input fields in the last section
                 lastSection.querySelectorAll('input, textarea').forEach(input => {
                     if (input.type === 'checkbox') {
                         input.checked = false;
                     } else {
                         input.value = '';
                     }
                 });

                 showEducation();



             },

             error: function(xhr, status, error) {
                 Swal.close();
                 console.error(error);
             }
         });

     });
 </script>
 @endpush