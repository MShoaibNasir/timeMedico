@extends('frontend.layout.master')
@section('content')
<section class="flat-title-page">
    <div class="container">
        <div class="row">
            <h4 class="pb-5">Directors Meets & Events</h4>
            <div class="col-lg-6">

                <div class="box-floor-property file-delete p-5  mx-auto">
                            
                            <div class="box-info-property">
                                <div class="box grid-2 gap-30">
                                    <fieldset class="box-fieldset">
                                        <label>
                                           Name:<span>*</span>
                                        </label>
                                        <input type="text" class="form-control" placeholder="Enter Name">
                                    </fieldset>
                                    <fieldset class="box-fieldset">
                                        <label>
                                            Phone: <span>*</span>
                                        </label>
                                        <input type="text" class="form-control" placeholder="Enter Phone">
                                    </fieldset>
                                    
                                </div>
                                <div class="box grid-2 gap-30 mt-5">
                                    <fieldset class="box-fieldset">
                                        <label>
                                           Directors Training Program:<span>*</span>
                                        </label>
                                        <div class="nice-select" tabindex="0"><span class="current">Directors Training Program</span>
                                            <ul class="list"> 
                                                <li data-value="1" class="option selected">Five-day DTP</li>
                                                <li data-value="2" class="option">Board Composition </li>
                                                <li data-value="3" class="option">Directors Duties </li>
                                            </ul>
                                        </div>
                                    </fieldset>
                                    <fieldset class="box-fieldset">
                                        <label>
                                            ESG Tracks Training Program:<span>*</span>
                                        </label>
                                        <div class="nice-select" tabindex="0"><span class="current">ESG Tracks Training Program</span>
                                            <ul class="list"> 
                                                 <li data-value="1" class="option selected">Five-day DTP</li>
                                                <li data-value="2" class="option">Board Composition </li>
                                                <li data-value="3" class="option">Directors Duties </li>
                                            </ul>
                                        </div>
                                    </fieldset>
                                </div>
                            <div class="box grid-1 gap-30 mt-5 mb-3">
                                <fieldset class="box-fieldset">
                                    <label>Description:</label>
                                    <textarea class="textarea" placeholder="Your Decscription"></textarea>
                                </fieldset>
                                </div></div>
                            <div class="box-btn">
                            <a href="#" class="tf-btn primary mt-4">Submit</a>

                        </div>
                        </div>
            </div>
            <div class="col-lg-6  ">
                <div class="m-3 p-4 shadow  round-12">
                    <img class="lazyload" src="{{asset('frontend/images/banner/directors-meets-events.png')}}"
                        class="img-fluid" alt="">
                </div>
            </div>
        </div>

    </div>

</section>
@endsection
<!-- public/frontend/images/banner/ESG-Ececutive-tracks.jpg -->