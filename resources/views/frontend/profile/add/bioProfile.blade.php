<div class="nexus-section-card">
                    <h2 class="nexus-section-title">
                        <div class="section-icon">
                            <i class="fas fa-id-card"></i>
                        </div>
                        Bio / Personal Profile
                    </h2>
                    
                    <div class="nexus-form-group">
                        <label class="form-label">Bio Summary (3 lines limit) <span class="nexus-required">*</span></label>
                            <textarea 
                                class="form-control textarea-limit" 
                                name="bio_summary" 
                                rows="3" 
                                maxlength="300" 
                                oninput="limitLines(this, 3)"
                                nexus-required
                            >{{$user->bioProfile->bio_summary ?? ''}}</textarea>                        <div class="char-counter">
                            <span id="bioCounter">0</span>/300 characters
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="nexus-form-group">
                                <label class="form-label">LinkedIn URL</label>
                                <input type="url" id='linkdink_url' class="form-control" name="linkedin_url" value='{{$user->bioProfile->linkedin_url ?? ""}}' placeholder="https://linkedin.com/in/username">
                                <span id='linkdink_url_error'></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="nexus-form-group">
                                <label class="form-label">Website URL</label>
                                <input type="url" id='website_url' class="form-control" name="website_url" value='{{$user->bioProfile->website_url ?? ""}}' placeholder="https://yourwebsite.com">
                                <span id='website_url_error'></span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-4">
                            <div class="nexus-form-group">
                                <label class="form-label">Facebook URL</label>
                                <input type="url" id='facebok_url' class="form-control" name="facebook_url" value='{{$user->bioProfile->facebook_url ?? ""}}' placeholder="https://facebook.com/username">
                                <span id='facebok_url_error'></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="nexus-form-group">
                                <label class="form-label">Twitter URL</label>
                                <input type="url" class="form-control" name="twitter_url" id='twitter_url' value='{{$user->bioProfile->twitter_url ?? "" }}' placeholder="https://twitter.com/username">
                               <span id='twitter_url_error'></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="nexus-form-group">
                                <label class="form-label">Instagram URL</label>
                                <input type="url" class="form-control" name="instagram_url" id='instagram_url' value='{{$user->bioProfile->instagram_url ?? ""}}' placeholder="https://instagram.com/username">
                                  <span id='instagram_url_error'></span>
                            </div>
                        </div>
                    </div>
                </div>
@push('scripts')
<script>
function limitLines(textarea, maxLines) {
    const lines = textarea.value.split('\n');
    if (lines.length > maxLines) {
        textarea.value = lines.slice(0, maxLines).join('\n');
    }
}
</script>
@endpush
                