<div class="nexus-section-card">
    <h2 class="nexus-section-title">
        <div class="section-icon">
            <i class="fas fa-lightbulb"></i>
        </div>
        Skills
    </h2>

    @php
    $skill=App\Models\Skill::get();
    @endphp

    <div id="skillsContainer">
        <div class="dynamic-section skill-row">
            <div class="nexus-form-group">
                <label class="form-label">Skill Name <span class="nexus-required">*</span></label>
                <select class="form-select skill-name" name="skill_name">
                    <option value="">Select Skill</option>
                    @foreach($skill as $item)
                    <option value="{{$item->name}}">{{$item->name}}</option>
                    @endforeach

                </select>
            </div>

            <div class="skill-proficiency">
                <label class="form-label">Proficiency Level:</label>

                <div class="proficiency-scale">
                    <div class="scale-item" data-value="1">1</div>
                    <div class="scale-item" data-value="2">2</div>
                    <div class="scale-item" data-value="3">3</div>
                    <div class="scale-item" data-value="4">4</div>
                    <div class="scale-item" data-value="5">5</div>
                </div>
                <input type="hidden" class="skill-level" name="proficiency_level">
            </div>
        </div>

    </div>

    <button type="button" class="add-more-btn" id="addMoreSkill">
        <i class="fas fa-plus me-2"></i>Add Skills
    </button>

    <div id="showSkillList"></div>
</div>
@push('scripts')
<script>
    function setupProficiencyScale(parent) {
        parent.querySelectorAll('.proficiency-scale').forEach(scale => {
            const items = scale.querySelectorAll('.scale-item');
            const hiddenInput = scale.parentNode.querySelector('.skill-level');

            items.forEach(item => {
                item.addEventListener('click', function() {
                    const value = this.dataset.value;
                    hiddenInput.value = value;

                    // Active classes
                    items.forEach(i => i.classList.remove('active'));
                    this.classList.add('active');
                });
            });
        });
    }

    // ✅ INITIAL SETUP
    setupProficiencyScale(document);


    // ✅ SHOW SKILLS LIST
    function showSkills() {
        $.ajax({
            url: "{{ route('frontend.skills') }}",
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            success: function(response) {
                $('#showSkillList').html(response);
            }
        });
    }

    showSkills();


    // ✅ ADD MORE SKILL
    $('#addMoreSkill').click(function() {

        const last = document.querySelector('.skill-row:last-of-type');

        const skillName = last.querySelector('.skill-name').value;
        const skillLevel = last.querySelector('.skill-level').value;

        if (!skillName || !skillLevel) {
            alert("⚠️ Please select skill name and proficiency level before adding new skill.");
            return;
        }

        $.ajax({
            url: "{{ route('frontend.saveSkill') }}",
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            data: {
                name: skillName,
                skill_proficiency: skillLevel
            },
            beforeSend: function() {
                Swal.fire({
                    title: "Saving...",
                    text: "Please wait",
                    allowOutsideClick: false,
                    didOpen: () => Swal.showLoading()
                });
            },
            success: function(response) {
                console.log(response);
                
                Swal.close();

                if (response === 'false') {
                    Swal.fire('Error', 'This Skill Already Add in your Skill List!', 'error');
                } else {

                    Swal.fire('Success', 'Skill added successfully!', 'success');
                }
                showSkills();

                // ✅ Clone clean row
                let clone = last.cloneNode(true);
                clone.querySelector('.skill-name').value = '';
                clone.querySelector('.skill-level').value = '';
                clone.querySelectorAll('.scale-item').forEach(i => i.classList.remove('active'));

                // document.getElementById('skillsContainer').appendChild(clone);

                setupProficiencyScale(clone);
            }
        });

    });
</script>
@endpush