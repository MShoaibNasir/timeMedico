 <div class="nexus-section-card">
     <h2 class="nexus-section-title">
         <div class="section-icon">
             <i class="fas fas fa-newspaper"></i>
         </div>
         Publications
     </h2>

     <div id="PublicationContainer">
         <div class="dynamic-section">
             {{-- <button type="button" class="remove-btn" onclick="removeSection(this)">Remove</button> --}}

             <div class="row">
                 <div class="col-md-6">
                     <div class="nexus-form-group">
                         <label class="form-label">Title<span class="nexus-required">*</span></label>
                         <input type="text" class="form-control" name="title" id="title" nexus-required>
                     </div>
                 </div>
                 <div class="col-md-6">
                     <div class="nexus-form-group">
                         <label class="form-label">Topics<span class="nexus-required">*</span></label>
                         <input type="text" class="form-control" name="topics" id="topics" nexus-required>
                     </div>
                 </div>
             </div>



             <div class="row">
                 <div class="col-6">
                     <div class="nexus-form-group">
                         <label class="form-label">Publication Type</label>
                         <input type="text" class="form-control" name="publication_type" id="publication_type" placeholder="Publication Type">
                     </div>
                 </div>

                 <div class="col-md-6">
                     <div class="nexus-form-group">
                         <label class="form-label">Publication Date <span class="nexus-required">*</span></label>
                         <input type="date" class="form-control" name="published_date" id="published_date" nexus-required>
                     </div>
                 </div>
             </div>

             <div class="row">
                 <div class="col-md-6">
                     <div class="nexus-form-group">
                         <label class="form-label">Publication Name</label>
                         <input type="text" class="form-control" name="publisher_name" id="publisher_name">
                     </div>
                 </div>
                 <div class="col-md-6">
                     <div class="nexus-form-group">
                         <label class="form-label">URL</label>
                         <input type="text" class="form-control" name="url" id="publication_url">
                         <span id='publication_url_error'></span>
                     </div>
                 </div>
                 <div class="col-md-12">
                     <div class="nexus-form-group">
                         <label class="form-label">Description</label>
                         <textarea name="description" class="form-control" id='description'></textarea>
                     </div>
                 </div>

             </div>
             {{-- <div class="affidavit-section">
                                <p class="affidavit-text">
                                    <i class="fas fa-exclamation-triangle me-2"></i>
                                    <strong>Affidavit:</strong> I hereby confirm the authenticity, accuracy, and completeness of the information and documents provided herein.
                                </p>
                                <div class="checkbox-group">
                                    <input type="checkbox" name="edu_affidavit[]" nexus-required>
                                    <label>I agree to the affidavit statement</label>
                                </div>
                            </div> --}}
         </div>
     </div>

     <button type="button" class="add-more-btn" id='addPublication'>
         <i class="fas fa-plus me-2"></i>Add Publications
     </button>
     <div id="showPublicationList"></div>
 </div>
 @push('scripts')
 <script>
     function showPublication() {

         $.ajax({
             url: "{{route('frontend.publications.list')}}",
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
                 $('#showPublicationList').html(response);
             },

             error: function(xhr, status, error) {
                 console.error(error);
             }
         });
     }
     showPublication();

     var isCorrectUrl = true;
     $('#publication_url').keyup(function() {
         const isCorrectUrl = isValidUrl($(this).val());
         const errorSpan = $('#publication_url_error');
         if (isCorrectUrl) {
             errorSpan.text('Valid URL!'); // Optional success message
             errorSpan.removeClass('error-message').addClass('success-message');
         } else {
             errorSpan.text('Could you please provide the URL?');
             errorSpan.removeClass('success-message').addClass('error-message'); // Apply the error class
         }
     });



     $('#addPublication').click(function() {
         const container = document.getElementById('PublicationContainer');
         const lastSection = container.querySelector('.dynamic-section:last-of-type');
         let valid = true;

         const requiredFields = [
             '[name="title"]',
             '[name="topics"]',
             '[name="publication_type"]',
             '[name="published_date"]',
             '[name="publisher_name"]',
             '[name="url"]',
             '[name="description"]'
         ];

         requiredFields.forEach(selector => {
             const input = lastSection.querySelector(selector);
             if (!input.value.trim()) {
                 valid = false;
                 input.style.borderColor = 'red';
             } else {
                 input.style.borderColor = '';
             }
         });

         if (!valid) {
             alert("⚠️ Please fill all required fields before adding another publication entry.");
             return;
         }

         const educationDetails = {
             title: $('#title').val(),
             topics: $('#topics').val(),
             publication_type: $('#publication_type').val(),
             published_date: $('#published_date').val(),
             publisher_name: $('#publisher_name').val(),
             url: $('#publication_url').val(),
             description: $('#description').val()
         };


         $.ajax({
             url: "{{ route('frontend.savePublications') }}",
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
                     title: 'Save Publication Data',
                     text: 'Publication Data added successfully!',
                     icon: 'success',
                     timer: 3000,
                 });
                 $('#degree_title').val(null),
                     $('#title').val(null),
                     $('#topics').val(null),
                     $('#publication_type').val(null),
                     $('#published_date').val(''),
                     $('#publisher_name').val(''),
                     $('#publication_url').val(null),
                     $('#description').val(null)

                 showPublication();



             },

             error: function(xhr, status, error) {
                 Swal.close();
                 console.error(error);
             }
         });

     });
 </script>
 @endpush