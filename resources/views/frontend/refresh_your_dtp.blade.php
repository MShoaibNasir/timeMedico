@extends('frontend.layout.master')
@section('content')

<!-- MAIN CONTENT START -->
<section class="flat-title-page">

    <div class="row">
        <div class="container">
            <div class="flat-img-with-text style-3">
                <div class="row">
                    <div class="col-12">
                        <h3 class="title text-center">Strategic Objectives</h3>
                        <p class="text-center py-3 w-75 mx-auto mb-4">Do you wish to bring yourself up to speed with the
                            latest developments in Corporate Law and best practices?
                            Do you want to equip yourself with knowledge about ESG, Sustainability, AI, Cybersecurity,
                            State-Owned Enterprises, and other modern topics?
                            PICG is offering you a unique opportunity to build on your existing knowledge, skills and
                            experience. Please use this form to select your preferred programs/topics and we will be
                            offering a customized training package for you.
                        </p>
                    </div>

                    <div class="box-floor-property file-delete p-5 w-75 mx-auto">
                        <form method="POST" action="{{ route('frontend.uploadRefreshyourdtp') }}">
                            @csrf

                            <!-- NAME -->
                            <div class="box grid-2 gap-30">
                                <fieldset class="box-fieldset">
                                    <label>Name:<span>*</span></label>
                                    <input type="text"
                                        name="name"
                                        class="form-control"
                                        placeholder="Enter Name"
                                        required>
                                </fieldset>

                                <!-- DESIGNATION -->
                                <fieldset class="box-fieldset">
                                    <label>Designation:<span>*</span></label>
                                    <input type="text"
                                        name="designation"
                                        class="form-control"
                                        placeholder="Enter Designation"
                                        required>
                                </fieldset>

                                <!-- PHONE -->
                                <fieldset class="box-fieldset">
                                    <label>Phone:<span>*</span></label>
                                    <input type="tel"
                                        name="phone"
                                        class="form-control"
                                        placeholder="03XXXXXXXXX"
                                        required
                                        maxlength="11"
                                        pattern="^03[0-9]{9}$"
                                        title="Enter valid Pakistani number e.g. 03001234567">
                                </fieldset>
                            </div>

                            <!-- PROGRAM SELECTION -->
                            <div class="box grid-2 gap-30 mt-5">

                                <!-- DTP -->
                                <fieldset class="box-fieldset">
                                    <label>Directors Training Program:<span>*</span></label>
                                    <select name="dtp" class="form-control" required>
                                        <option value="">Select Option</option>
                                        <option value="Five-day DTP">Five-day DTP</option>
                                        <option value="3-day DTP for SOEs">3-day DTP for SOEs</option>
                                        <option value="AI for Boards">AI for Boards</option>
                                        <option value="Company Secretary Development Program">Company Secretary Development Program</option>
                                        <option value="Board Composition">Board Composition</option>
                                        <option value="Directors Duties">Directors Duties</option>
                                        <option value="Board Meetings">Board Meetings and Proceedings</option>
                                        <option value="Financial Stewardship">Financial Stewardship</option>
                                        <option value="Reporting and Disclosure">Reporting and Disclosure</option>
                                        <option value="Strategic Governance">Strategic Governance</option>
                                        <option value="Managing the CEO">Managing the CEO</option>
                                        <option value="Risk Governance">Risk Governance</option>
                                        <option value="Cybersecurity">Cybersecurity</option>
                                        <option value="ESG Basics">ESG Basics</option>
                                        <option value="Workplace Harassment">Managing Workplace Harassment</option>
                                        <option value="HR Governance">HR Governance</option>
                                        <option value="AI Governance">AI Governance</option>
                                    </select>
                                </fieldset>

                                <!-- ESG -->
                                <fieldset class="box-fieldset">
                                    <label>ESG Tracks Training Program:<span>*</span></label>
                                    <select name="esg" class="form-control" required>
                                        <option value="">Select Option</option>
                                        <option value="12-Course Certification">12-Course Certification</option>
                                        <option value="ESG For Board Directors">ESG For Board Directors</option>
                                        <option value="ESG for Business">ESG for Business</option>
                                        <option value="IFRS S1 & S2">IFRS S1 & S2</option>
                                        <option value="GHG Disclosures">GHG Disclosures</option>
                                        <option value="ESG Strategy">ESG Strategy</option>
                                        <option value="ESG Target Setting">ESG Target Setting</option>
                                        <option value="HR Metrics for ESG">Critical HR Metrics for ESG</option>
                                        <option value="Health and Safety">Occupational Health and Safety</option>
                                        <option value="AI ESG Angle">AI: The ESG Angle</option>
                                    </select>
                                </fieldset>

                            </div>

                            <!-- DESCRIPTION -->
                            <div class="box grid-1 gap-30 mt-5">
                                <fieldset class="box-fieldset">
                                    <label>Description:<span>*</span></label>
                                    <textarea name="description"
                                        class="textarea"
                                        placeholder="Your Description"
                                        required></textarea>
                                </fieldset>
                            </div>

                            <!-- SUBMIT BUTTON -->
                            <div class="box-btn text-center">
                                <button type="submit" class="tf-btn primary mt-4">
                                    Submit Form
                                </button>
                            </div>

                        </form>
                    </div>
                </div>

</section>
<!-- MAIN CONTENT END -->

@endsection