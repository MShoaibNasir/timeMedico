 <div class="nexus-section-card">
                    <h2 class="nexus-section-title">
                        <div class="section-icon">
                            <i class="fas fa-user"></i>
                        </div>
                        Basic Account Information
                    </h2>
                   
                    <div class="row">
                        <div class="col-md-6">
                            <div class="nexus-form-group">
                                <label class="form-label">Full Name <span class="nexus-required">*</span></label>
                                <input type="text" class="form-control" value='{{Auth::guard('web')->user()->name}}' id='full_name' name="name" nexus-required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="nexus-form-group">
                                <label class="form-label">Email <span class="nexus-required">*</span></label>
                                <input type="email" class="form-control" value='{{Auth::guard('web')->user()->email}}' id='email' readonly name="email" nexus-required>
                            </div>
                        </div>
                        {{--  
                        <div class="col-md-6">
                            <div class="nexus-form-group">
                                <label class="form-label">Your Professional <span class="nexus-required">*</span></label>
                                <input type="text" class="form-control" value='{{Auth::guard('web')->user()->professional}}' id='professional' name="professional" nexus-required>
                            </div>
                        </div>
                        --}}
                   
                    
                   
                        <div class="col-md-6">
                            <div class="nexus-form-group">
                                <label class="form-label">Phone Number <span class="nexus-required">*</span></label>
                                <input type="tel" class="form-control" value='{{Auth::guard('web')->user()->phone_number}}' name="phone_number" nexus-required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="nexus-form-group">
                                <label class="form-label">Gender <span class="nexus-required">*</span></label>
                                <select class="form-select" name="gender" nexus-required>
                                    <option value="">Select Gender</option>
                                    <option value="Male" {{Auth::guard('web')->user()->gender=='Male' ? 'selected' : ''}}>Male</option>
                                    <option value="Female" {{Auth::guard('web')->user()->gender=='Female' ? 'selected' : ''}}>Female</option>
                                    <option value="Other" {{Auth::guard('web')->user()->gender=='Other' ? 'selected' : ''}}>Other</option>
                                </select>
                            </div>
                        </div>
                   
                    
                  
                        <div class="col-md-6">
                            <div class="nexus-form-group">
                                <label class="form-label">Nationality <span class="nexus-required">*</span></label>
                                <input type="text" class="form-control" value='{{Auth::guard('web')->user()->nationality}}'  name="nationality" nexus-required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="nexus-form-group">
                                <label class="form-label">CNIC or Passport <span class="nexus-required">*</span></label>
                                <input type="text" class="form-control" value='{{Auth::guard('web')->user()->cnic_or_passport}}' name="cnic_or_passport" nexus-required>
                            </div>
                        </div>
                 
                    
              
                        <div class="col-md-6">
                            <div class="nexus-form-group">
                                <label class="form-label">Date of Birth <span class="nexus-required">*</span></label>
                                <input type="date" class="form-control" value='{{Auth::guard('web')->user()->date_of_birth}}' name="date_of_birth" nexus-required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="nexus-form-group">
                                <label class="form-label">Profile Picture</label>
                                <input type="file" class="form-control" name="profile_picture" accept="image/*">
                            </div>
                        </div>
                 
                    
                    <div class="nexus-form-group">
                        <label class="form-label">Residential Address <span class="nexus-required">*</span></label>
                        <textarea class="form-control" name="residential_address" rows="3" nexus-required>{{Auth::guard('web')->user()->residential_address}}</textarea>
                    </div>
                   {{-- <div class="nexus-form-group">
                        <label class="form-label">Intoduction About Your Self <span class="nexus-required">*</span></label>
                        <textarea class="form-control" name="introduction" rows="3" nexus-required>{{Auth::guard('web')->user()->introduction}}</textarea>
                    </div>
                    --}}
                </div>
                 
                    
                </div>