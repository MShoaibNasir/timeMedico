@extends('frontend.layout.master')
@section('content')
<style>
.bullet-design li {
    list-style: none;
    /* default bullet hata do */
    position: relative;
    margin-bottom: 8px;
    padding-left: 25px;
    /* space for custom bullet */
    color: #333;
}

.bullet-design li::before {
    content: "•";
    /* yahan aap emoji ya koi symbol bhi use kar sakte ho, jaise "⭐" */
    position: absolute;
    left: 0;
    color: #3f3f3f;
    /* bullet ka color */
    font-size: 25px;
    /* bullet ka size */
}
.service-box{
    transition:.3s ease;
}
.service-box:hover{
    background:#0dcaf0 !important;
    transform:translateY(-8px);
}
.icon-circle{
    width:70px;
    height:70px;
    line-height:70px;
    border-radius:50%;
}
.service-box p{
    opacity:0;
    transition:.3s;
}
.service-box:hover p{
    opacity:1;
}
</style>
<section class="flat-title-page">
    <div class="container">
        <div class="row">

            <div class="col-lg-6">
                <h3 class="title my-3">Company Profile</h3>
                <p class="desc text-variant-1">Pakistan Institute of Corporate Governance was established as a
                    public-private partnership following a memorandum of understanding (MOU) signed between two apex
                    regulators, the Securities and Exchange Commission of Pakistan (SECP) and the State Bank of Pakistan
                    (SBP), and 18 private sector institutions. PICG was set up on December 01, 2004, the same year the
                    Organization for Economic Cooperation and Development (OECD) released a revised version of its first
                    set of corporate governance principles developed in 1999 to help OECD and non-OECD governments in
                    their efforts to create legal and regulatory frameworks to promote corporate governance in their
                    countries.</p><br>
                <p class="desc text-variant-1">PICG embarked on its journey to inculcate the six OECD principles of
                    effective corporate governance in the corporate ecosystem in Pakistan. Our flagship program, the
                    Director Training Program (DTP), commenced with IFC’s technical support in February 2007, and was a
                    huge leap forward in inculcating a culture of good governance in Pakistan. The program completes the
                    40 hour training requirement outlined by the SECP. The Directors Orientation Workshop is a
                    subsidiary program of the DTP.</p>
               <div class="text-left my-5 ">
                                    <a href="https://picg.org.pk/about-us/" target="blank" class="tf-btn btn-view primary size-1 hover-btn-view">Read More <span class="icon icon-arrow-right2"></span></a>
            </div>
            </div>

            <div class="col-lg-6">
                <div class="tf-image-wrap item-2">
                    <div class="img-style hover-img-wrap">
                        <img class="lazyload" data-src="images/banner/img-w-text2.jpg"
                            src="{{asset('frontend/images/banner/about_img_1.jpg')}}" alt="">
                        <div
                            style="position: absolute; top: 8px; left: 8px; z-index: 1000; cursor: pointer; opacity: 1; transition: opacity 200ms; width: 24px; height: 24px;">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 56 54">
                                <defs>
                                    <style>
                                    .cls-1 {
                                        fill: #001e36;
                                    }

                                    .cls-2 {
                                        fill: #31a8ff;
                                    }
                                    </style>
                                </defs>
                            
                                <g id="Layer_2" data-name="Layer 2">
                                    <g id="Surfaces">
                                        <g id="Photo_Surface" data-name="Photo Surface">
                                            <g id="Outline_no_shadow" data-name="Outline no shadow">
                                                <rect class="cls-1" width="56" height="54" rx="9.91383"></rect>
                                            </g>
                                        </g>
                                    </g>
                                    <g id="Outlined_Mnemonics_Logos" data-name="Outlined Mnemonics &amp; Logos">
                                        <g id="Ps">
                                            <path class="cls-2"
                                                d="M11.63571,37.7063V14.06323c0-.17236.07422-.259.22217-.259q.59106,0,1.40576-.01856.81372-.0183,1.75781-.03686.94336-.01831,1.99805-.03711,1.05468-.01831,2.09033-.01855a13.90366,13.90366,0,0,1,4.73584.70312,8.22066,8.22066,0,0,1,3.08984,1.887,7.24021,7.24021,0,0,1,1.6836,2.6084,8.66365,8.66365,0,0,1,.51757,2.97852,8.21981,8.21981,0,0,1-1.36914,4.884,7.73031,7.73031,0,0,1-3.6997,2.79346,14.72217,14.72217,0,0,1-5.18018.86963q-.81445,0-1.14648-.01856-.33325-.01832-.999-.01855v7.28906a.2945.2945,0,0,1-.333.333H11.895Q11.6357,38.0022,11.63571,37.7063Zm5.10644-19.46216v7.65894q.48048.03735.8877.03711h1.2207a8.72661,8.72661,0,0,0,2.64551-.36988,3.99058,3.99058,0,0,0,1.88769-1.22119,3.55281,3.55281,0,0,0,.7212-2.36792,3.74033,3.74033,0,0,0-.53662-2.03491A3.45133,3.45133,0,0,0,21.959,18.63281a6.85543,6.85543,0,0,0-2.70117-.46264q-.8877,0-1.57227.01855Q17,18.20777,16.74215,18.24414Z">
                                            </path>
                                            <path class="cls-2"
                                                d="M43.53986,24.4231a13.0493,13.0493,0,0,0-2.66564-.77686,11.68613,11.68613,0,0,0-2.57129-.29614,4.79162,4.79162,0,0,0-1.38769.1665,1.2462,1.2462,0,0,0-.72168.46265,1.16569,1.16569,0,0,0-.18457.6289.9824.9824,0,0,0,.22168.59205,2.52063,2.52063,0,0,0,.77734.61059,15.472,15.472,0,0,0,1.62793.7583,16.142,16.142,0,0,1,3.53321,1.6836,5.37415,5.37415,0,0,1,1.813,1.90551,5.07861,5.07861,0,0,1,.53662,2.36792,5.31526,5.31526,0,0,1-.88818,3.05249,5.83656,5.83656,0,0,1-2.57129,2.05347,10.3516,10.3516,0,0,1-4.1626.74023,15.04788,15.04788,0,0,1-3.12646-.29614,11.45955,11.45955,0,0,1-2.49805-.74.47883.47883,0,0,1-.25879-.44409V32.89624a.21749.21749,0,0,1,.09278-.20361.17935.17935,0,0,1,.20312.01855,10.80533,10.80533,0,0,0,2.99756,1.12842,11.7417,11.7417,0,0,0,2.70117.35156,4.15006,4.15006,0,0,0,1.90528-.333,1.04519,1.04519,0,0,0,.61035-.96191,1.22388,1.22388,0,0,0-.55469-.925,9.19418,9.19418,0,0,0-2.25732-1.073,13.60639,13.60639,0,0,1-3.27442-1.665,5.63914,5.63914,0,0,1-1.73877-1.94238,5.09656,5.09656,0,0,1-.53711-2.34961,5.30352,5.30352,0,0,1,.77735-2.7749A5.64634,5.64634,0,0,1,34.344,20.05713a7.6279,7.6279,0,0,1,3.74425-.93447,23.40265,23.40265,0,0,1,3.12.04534,10.64682,10.64682,0,0,1,2.443.81515.3364.3364,0,0,1,.22168.20362,1.01923,1.01923,0,0,1,.0371.27734v3.73706a.24881.24881,0,0,1-.11084.22193A.24266.24266,0,0,1,43.53986,24.4231Z">
                                            </path>
                                        </g>
                                    </g>
                                </g>
                            </svg></div>
                        <div
                            style="position: absolute; top: 8px; left: 8px; z-index: 1000; cursor: pointer; opacity: 0; transition: opacity 200ms; width: 24px; height: 24px;">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 56 54">
                                <defs>
                                    <style>
                                    .cls-1 {
                                        fill: #001e36;
                                    }

                                    .cls-2 {
                                        fill: #31a8ff;
                                    }
                                    </style>
                                </defs>
                            
                                <g id="Layer_2" data-name="Layer 2">
                                    <g id="Surfaces">
                                        <g id="Photo_Surface" data-name="Photo Surface">
                                            <g id="Outline_no_shadow" data-name="Outline no shadow">
                                                <rect class="cls-1" width="56" height="54" rx="9.91383"></rect>
                                            </g>
                                        </g>
                                    </g>
                                    <g id="Outlined_Mnemonics_Logos" data-name="Outlined Mnemonics &amp; Logos">
                                        <g id="Ps">
                                            <path class="cls-2"
                                                d="M11.63571,37.7063V14.06323c0-.17236.07422-.259.22217-.259q.59106,0,1.40576-.01856.81372-.0183,1.75781-.03686.94336-.01831,1.99805-.03711,1.05468-.01831,2.09033-.01855a13.90366,13.90366,0,0,1,4.73584.70312,8.22066,8.22066,0,0,1,3.08984,1.887,7.24021,7.24021,0,0,1,1.6836,2.6084,8.66365,8.66365,0,0,1,.51757,2.97852,8.21981,8.21981,0,0,1-1.36914,4.884,7.73031,7.73031,0,0,1-3.6997,2.79346,14.72217,14.72217,0,0,1-5.18018.86963q-.81445,0-1.14648-.01856-.33325-.01832-.999-.01855v7.28906a.2945.2945,0,0,1-.333.333H11.895Q11.6357,38.0022,11.63571,37.7063Zm5.10644-19.46216v7.65894q.48048.03735.8877.03711h1.2207a8.72661,8.72661,0,0,0,2.64551-.36988,3.99058,3.99058,0,0,0,1.88769-1.22119,3.55281,3.55281,0,0,0,.7212-2.36792,3.74033,3.74033,0,0,0-.53662-2.03491A3.45133,3.45133,0,0,0,21.959,18.63281a6.85543,6.85543,0,0,0-2.70117-.46264q-.8877,0-1.57227.01855Q17,18.20777,16.74215,18.24414Z">
                                            </path>
                                            <path class="cls-2"
                                                d="M43.53986,24.4231a13.0493,13.0493,0,0,0-2.66564-.77686,11.68613,11.68613,0,0,0-2.57129-.29614,4.79162,4.79162,0,0,0-1.38769.1665,1.2462,1.2462,0,0,0-.72168.46265,1.16569,1.16569,0,0,0-.18457.6289.9824.9824,0,0,0,.22168.59205,2.52063,2.52063,0,0,0,.77734.61059,15.472,15.472,0,0,0,1.62793.7583,16.142,16.142,0,0,1,3.53321,1.6836,5.37415,5.37415,0,0,1,1.813,1.90551,5.07861,5.07861,0,0,1,.53662,2.36792,5.31526,5.31526,0,0,1-.88818,3.05249,5.83656,5.83656,0,0,1-2.57129,2.05347,10.3516,10.3516,0,0,1-4.1626.74023,15.04788,15.04788,0,0,1-3.12646-.29614,11.45955,11.45955,0,0,1-2.49805-.74.47883.47883,0,0,1-.25879-.44409V32.89624a.21749.21749,0,0,1,.09278-.20361.17935.17935,0,0,1,.20312.01855,10.80533,10.80533,0,0,0,2.99756,1.12842,11.7417,11.7417,0,0,0,2.70117.35156,4.15006,4.15006,0,0,0,1.90528-.333,1.04519,1.04519,0,0,0,.61035-.96191,1.22388,1.22388,0,0,0-.55469-.925,9.19418,9.19418,0,0,0-2.25732-1.073,13.60639,13.60639,0,0,1-3.27442-1.665,5.63914,5.63914,0,0,1-1.73877-1.94238,5.09656,5.09656,0,0,1-.53711-2.34961,5.30352,5.30352,0,0,1,.77735-2.7749A5.64634,5.64634,0,0,1,34.344,20.05713a7.6279,7.6279,0,0,1,3.74425-.93447,23.40265,23.40265,0,0,1,3.12.04534,10.64682,10.64682,0,0,1,2.443.81515.3364.3364,0,0,1,.22168.20362,1.01923,1.01923,0,0,1,.0371.27734v3.73706a.24881.24881,0,0,1-.11084.22193A.24266.24266,0,0,1,43.53986,24.4231Z">
                                            </path>
                                        </g>
                                    </g>
                                </g>
                            </svg></div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</section>

<section class="mx-5  bg-primary-new radius-30 mb-5">
    <div class="flat-img-with-text">
        <div class="content-left img-animation wow animated animated animated animated" style="visibility: visible;">
            <img class="lazyload" data-src="images/banner/img-w-text5.jpg"
                src="{{asset('frontend/images/banner/about_img_2.jpg')}}" alt="">
        </div>
        <div class="content-right">
            <div class="flat-service wow fadeInUp" data-wow-delay=".2s"
                style="visibility: visible; animation-delay: 0.2s;">
                <a href="#" class="box-benefit hover-btn-view mt-5">
                    <div class="icon-box">
                        <span class="icon icon-proven"></span>
                    </div>
                    <div class="content">
                        <h5 class="title">Our Vision</h5>
                        <p class="description">Enable good governance that creates shared prosperity, an ethical society
                            and an inclusive, sustainable economy.</p>
                    </div>
                </a>
                <a href="#" class="box-benefit hover-btn-view">
                    <div class="icon-box">
                        <span class="icon icon-customize"></span>
                    </div>
                    <div class="content">
                        <h5 class="title">Our Mission</h5>
                        <p class="description">To create awareness of the benefit of good governance to business and
                            society thereby catalysing best practices for long-term sustainability.</p>
                    </div>
                </a>
                <a href="#" class="box-benefit hover-btn-view">
                    <div class="icon-box">
                        <span class="icon icon-partnership"></span>
                    </div>
                    <div class="content">
                        <h5 class="title">Core Values</h5>
                        <p class="description">
                        </p>
                        <ul class="box list-price">
                            <li class="item">
                                <span class="check-icon icon-tick2"></span>
                                Responsibility
                            </li>
                            <li class="item">
                                <span class="check-icon icon-tick2"></span>

                                Accountability
                            </li>
                            <li class="item">
                                <span class="check-icon icon-tick2"></span>

                                Transparency
                            </li>
                            <li class="item">
                                <span class="check-icon icon-tick2"></span>

                                Fairness
                            </li>

                        </ul>
                        <p></p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

<section class="py-5 mb-5">
    <div class="container">
        <div class="row">
 <div class="col-lg-6">
                <div class="tf-image-wrap item-2">
                    <div class="img-style hover-img-wrap">
                        <img class="lazyload" data-src="images/banner/"
                            src="{{asset('frontend/images/banner/strategic-managment.webp')}}" alt="">
                        <div
                            style="position: absolute; top: 8px; left: 8px; z-index: 1000; cursor: pointer; opacity: 1; transition: opacity 200ms; width: 24px; height: 24px;">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 56 54">
                                <defs>
                                    <style>
                                    .cls-1 {
                                        fill: #001e36;
                                    }

                                    .cls-2 {
                                        fill: #31a8ff;
                                    }
                                    </style>
                                </defs>
                            
                                <g id="Layer_2" data-name="Layer 2">
                                    <g id="Surfaces">
                                        <g id="Photo_Surface" data-name="Photo Surface">
                                            <g id="Outline_no_shadow" data-name="Outline no shadow">
                                                <rect class="cls-1" width="56" height="54" rx="9.91383"></rect>
                                            </g>
                                        </g>
                                    </g>
                                    <g id="Outlined_Mnemonics_Logos" data-name="Outlined Mnemonics &amp; Logos">
                                        <g id="Ps">
                                            <path class="cls-2"
                                                d="M11.63571,37.7063V14.06323c0-.17236.07422-.259.22217-.259q.59106,0,1.40576-.01856.81372-.0183,1.75781-.03686.94336-.01831,1.99805-.03711,1.05468-.01831,2.09033-.01855a13.90366,13.90366,0,0,1,4.73584.70312,8.22066,8.22066,0,0,1,3.08984,1.887,7.24021,7.24021,0,0,1,1.6836,2.6084,8.66365,8.66365,0,0,1,.51757,2.97852,8.21981,8.21981,0,0,1-1.36914,4.884,7.73031,7.73031,0,0,1-3.6997,2.79346,14.72217,14.72217,0,0,1-5.18018.86963q-.81445,0-1.14648-.01856-.33325-.01832-.999-.01855v7.28906a.2945.2945,0,0,1-.333.333H11.895Q11.6357,38.0022,11.63571,37.7063Zm5.10644-19.46216v7.65894q.48048.03735.8877.03711h1.2207a8.72661,8.72661,0,0,0,2.64551-.36988,3.99058,3.99058,0,0,0,1.88769-1.22119,3.55281,3.55281,0,0,0,.7212-2.36792,3.74033,3.74033,0,0,0-.53662-2.03491A3.45133,3.45133,0,0,0,21.959,18.63281a6.85543,6.85543,0,0,0-2.70117-.46264q-.8877,0-1.57227.01855Q17,18.20777,16.74215,18.24414Z">
                                            </path>
                                            <path class="cls-2"
                                                d="M43.53986,24.4231a13.0493,13.0493,0,0,0-2.66564-.77686,11.68613,11.68613,0,0,0-2.57129-.29614,4.79162,4.79162,0,0,0-1.38769.1665,1.2462,1.2462,0,0,0-.72168.46265,1.16569,1.16569,0,0,0-.18457.6289.9824.9824,0,0,0,.22168.59205,2.52063,2.52063,0,0,0,.77734.61059,15.472,15.472,0,0,0,1.62793.7583,16.142,16.142,0,0,1,3.53321,1.6836,5.37415,5.37415,0,0,1,1.813,1.90551,5.07861,5.07861,0,0,1,.53662,2.36792,5.31526,5.31526,0,0,1-.88818,3.05249,5.83656,5.83656,0,0,1-2.57129,2.05347,10.3516,10.3516,0,0,1-4.1626.74023,15.04788,15.04788,0,0,1-3.12646-.29614,11.45955,11.45955,0,0,1-2.49805-.74.47883.47883,0,0,1-.25879-.44409V32.89624a.21749.21749,0,0,1,.09278-.20361.17935.17935,0,0,1,.20312.01855,10.80533,10.80533,0,0,0,2.99756,1.12842,11.7417,11.7417,0,0,0,2.70117.35156,4.15006,4.15006,0,0,0,1.90528-.333,1.04519,1.04519,0,0,0,.61035-.96191,1.22388,1.22388,0,0,0-.55469-.925,9.19418,9.19418,0,0,0-2.25732-1.073,13.60639,13.60639,0,0,1-3.27442-1.665,5.63914,5.63914,0,0,1-1.73877-1.94238,5.09656,5.09656,0,0,1-.53711-2.34961,5.30352,5.30352,0,0,1,.77735-2.7749A5.64634,5.64634,0,0,1,34.344,20.05713a7.6279,7.6279,0,0,1,3.74425-.93447,23.40265,23.40265,0,0,1,3.12.04534,10.64682,10.64682,0,0,1,2.443.81515.3364.3364,0,0,1,.22168.20362,1.01923,1.01923,0,0,1,.0371.27734v3.73706a.24881.24881,0,0,1-.11084.22193A.24266.24266,0,0,1,43.53986,24.4231Z">
                                            </path>
                                        </g>
                                    </g>
                                </g>
                            </svg></div>
                        <div
                            style="position: absolute; top: 8px; left: 8px; z-index: 1000; cursor: pointer; opacity: 0; transition: opacity 200ms; width: 24px; height: 24px;">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 56 54">
                                <defs>
                                    <style>
                                    .cls-1 {
                                        fill: #001e36;
                                    }

                                    .cls-2 {
                                        fill: #31a8ff;
                                    }
                                    </style>
                                </defs>
                            
                                <g id="Layer_2" data-name="Layer 2">
                                    <g id="Surfaces">
                                        <g id="Photo_Surface" data-name="Photo Surface">
                                            <g id="Outline_no_shadow" data-name="Outline no shadow">
                                                <rect class="cls-1" width="56" height="54" rx="9.91383"></rect>
                                            </g>
                                        </g>
                                    </g>
                                    <g id="Outlined_Mnemonics_Logos" data-name="Outlined Mnemonics &amp; Logos">
                                        <g id="Ps">
                                            <path class="cls-2"
                                                d="M11.63571,37.7063V14.06323c0-.17236.07422-.259.22217-.259q.59106,0,1.40576-.01856.81372-.0183,1.75781-.03686.94336-.01831,1.99805-.03711,1.05468-.01831,2.09033-.01855a13.90366,13.90366,0,0,1,4.73584.70312,8.22066,8.22066,0,0,1,3.08984,1.887,7.24021,7.24021,0,0,1,1.6836,2.6084,8.66365,8.66365,0,0,1,.51757,2.97852,8.21981,8.21981,0,0,1-1.36914,4.884,7.73031,7.73031,0,0,1-3.6997,2.79346,14.72217,14.72217,0,0,1-5.18018.86963q-.81445,0-1.14648-.01856-.33325-.01832-.999-.01855v7.28906a.2945.2945,0,0,1-.333.333H11.895Q11.6357,38.0022,11.63571,37.7063Zm5.10644-19.46216v7.65894q.48048.03735.8877.03711h1.2207a8.72661,8.72661,0,0,0,2.64551-.36988,3.99058,3.99058,0,0,0,1.88769-1.22119,3.55281,3.55281,0,0,0,.7212-2.36792,3.74033,3.74033,0,0,0-.53662-2.03491A3.45133,3.45133,0,0,0,21.959,18.63281a6.85543,6.85543,0,0,0-2.70117-.46264q-.8877,0-1.57227.01855Q17,18.20777,16.74215,18.24414Z">
                                            </path>
                                            <path class="cls-2"
                                                d="M43.53986,24.4231a13.0493,13.0493,0,0,0-2.66564-.77686,11.68613,11.68613,0,0,0-2.57129-.29614,4.79162,4.79162,0,0,0-1.38769.1665,1.2462,1.2462,0,0,0-.72168.46265,1.16569,1.16569,0,0,0-.18457.6289.9824.9824,0,0,0,.22168.59205,2.52063,2.52063,0,0,0,.77734.61059,15.472,15.472,0,0,0,1.62793.7583,16.142,16.142,0,0,1,3.53321,1.6836,5.37415,5.37415,0,0,1,1.813,1.90551,5.07861,5.07861,0,0,1,.53662,2.36792,5.31526,5.31526,0,0,1-.88818,3.05249,5.83656,5.83656,0,0,1-2.57129,2.05347,10.3516,10.3516,0,0,1-4.1626.74023,15.04788,15.04788,0,0,1-3.12646-.29614,11.45955,11.45955,0,0,1-2.49805-.74.47883.47883,0,0,1-.25879-.44409V32.89624a.21749.21749,0,0,1,.09278-.20361.17935.17935,0,0,1,.20312.01855,10.80533,10.80533,0,0,0,2.99756,1.12842,11.7417,11.7417,0,0,0,2.70117.35156,4.15006,4.15006,0,0,0,1.90528-.333,1.04519,1.04519,0,0,0,.61035-.96191,1.22388,1.22388,0,0,0-.55469-.925,9.19418,9.19418,0,0,0-2.25732-1.073,13.60639,13.60639,0,0,1-3.27442-1.665,5.63914,5.63914,0,0,1-1.73877-1.94238,5.09656,5.09656,0,0,1-.53711-2.34961,5.30352,5.30352,0,0,1,.77735-2.7749A5.64634,5.64634,0,0,1,34.344,20.05713a7.6279,7.6279,0,0,1,3.74425-.93447,23.40265,23.40265,0,0,1,3.12.04534,10.64682,10.64682,0,0,1,2.443.81515.3364.3364,0,0,1,.22168.20362,1.01923,1.01923,0,0,1,.0371.27734v3.73706a.24881.24881,0,0,1-.11084.22193A.24266.24266,0,0,1,43.53986,24.4231Z">
                                            </path>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </div>
                    </div>


                </div>
            </div>

            <div class="col-lg-6">
                <h3 class="title my-5">Strategic Objectives</h3>
                <ul class="bullet-design ">
                    <li>To broaden the scope of corporate governance to include ESG practices and to foster awareness of
                        its benefits to business and society</li>
                    <li>To partner with business, civil society, public sector and other stakeholders, enabling greater
                        compliance through the sharing of data, research; and the organising of trainings, seminars and
                        conferences.</li>
                    <li>Establish ESG standards for disclosure and build capacity for reporting through high quality
                        training.</li>
                    <li>To enhance the global competitiveness of domestic corporations through capacity building for the
                        consistent practice of good, ethical, governance.</li>
                    <li>Establish an ESG index in Pakistan to reposition corporate best practice to align with
                        sustainability priorities and help attract global capital to favour local ESG progressive
                        businesses.</li>
                </ul>
            </div>

        </div>
    </div>
</section>

<section class="flat-section pt-0">
                <div class="container"> 
                    <div class="tf-faq">
                        <div class="box-title style-1 text-center wow fadeInUpSmall animated animated" data-wow-delay=".2s" data-wow-duration="2000ms" style="visibility: visible; animation-duration: 2000ms; animation-delay: 0.2s;">
                            <h3 class="title mt-4">Our Services and Products</h3>
                        </div>
                        <ul class="box-faq" id="wrapper-faq">
                            <li class="faq-item active">
                                <a href="#accordion-faq-one" class="faq-header collapsed" data-bs-toggle="collapse" aria-expanded="false" aria-controls="accordion-faq-one">
                                  Director Training Program – DTP
                                </a>
                                <div id="accordion-faq-one" class="collapse" data-bs-parent="#wrapper-faq">
                                    <p class="faq-body">
                                    The Code of Corporate Governance (2019) has brought significant changes to corporate governance practices in Pakistan.
                                    </p>
                                </div>
                            </li>
                            <li class="faq-item ">
                                <a href="#accordion-faq-two" class="faq-header" data-bs-toggle="collapse" aria-expanded="false" aria-controls="accordion-faq-two">
                                  Specialized Workshops
                                </a>
                                <div id="accordion-faq-two" class="collapse show" data-bs-parent="#wrapper-faq">
                                    <p class="faq-body">
                                      Conducting responsible business has gained increasing attention over the past few years with many institutional investors.
                                </div>
                            </li>
                            <li class="faq-item">
                                <a href="#accordion-faq-three" class="faq-header collapsed" data-bs-toggle="collapse" aria-expanded="false" aria-controls="accordion-faq-three">
                                  Advisory Services
                                </a>
                                <div id="accordion-faq-three" class="collapse" data-bs-parent="#wrapper-faq">
                                    <p class="faq-body">
                                    At PICG we stand ready to work with boards and C-suites to provide advisory services customized for a constantly evolving regulatory and governance landscape.
                                    </p>
                                </div>
                            </li>
                            <li class="faq-item">
                                <a href="#accordion-faq-four" class="faq-header collapsed" data-bs-toggle="collapse" aria-expanded="false" aria-controls="accordion-faq-four">
                                   Board Performance Evaluation
                                </a>
                                <div id="accordion-faq-four" class="collapse" data-bs-parent="#wrapper-faq">
                                    <p class="faq-body">
                                      PICG’s Board Performance Evaluation service enables an assessment of how the Board has performed.
                                    </p>
                                </div>
                            </li>
                        
                        </ul>
                        
                    </div>
                </div>
            </section>

<section class="flat-section pt-5 bg-primary-new">
                <div class="container pt-5"> 
    <div dir="ltr" class="wow fadeInUp swiper tf-sw-mobile sw-over" data-screen="575" data-preview="1" data-space="15" data-wow-delay=".2s" style="visibility: visible; animation-delay: 0.2s;">
                        <div class="tf-layout-mobile-sm sm-col-2 lg-col-4 swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="box-location-v3 hover-img not-overlay hover-btn-view">
                                    
                                    <div class="content">
                                        <h6><a href="https://picg.org.pk/board-of-directors/" class="link">Board of Directors </a></h6>
                                   
                                        <a href="https://picg.org.pk/board-of-directors/" target="blank" class="btn-view style-1"><span class="text">Explore Now</span> <span class="icon icon-arrow-right2"></span> </a>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="box-location-v3 hover-img not-overlay hover-btn-view active">
                                    
                                    <div class="content">
                                        <h6><a href="https://picg.org.pk/code-of-conduct/" class="link">Code of Conduct</a></h6>
                                        <p class="mt-4"></p>
                                           <a href="https://picg.org.pk/code-of-conduct/" target="blank" class="btn-view style-1"><span class="text">Explore Now</span> <span class="icon icon-arrow-right2"></span> </a>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="box-location-v3 hover-img not-overlay hover-btn-view">
                                    
                                    <div class="content">
                                        <h6><a href="https://picg.org.pk/board-of-directors/" class="link">Faculty Profile</a></h6>
                                           <a href="https://picg.org.pk/board-of-directors/" target="blank" class="btn-view style-1"><span class="text">Explore Now</span> <span class="icon icon-arrow-right2"></span> </a>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="box-location-v3 hover-img not-overlay hover-btn-view">
                                    
                                    <div class="content">
                                        <h6><a href="www.picg.org.pk" class="link">Find Out More</a></h6>
                                           <a href="www.picg.org.pk" target="blank" class="btn-view style-1"><span class="text">Explore Now</span> <span class="icon icon-arrow-right2"></span> </a>
                                    </div>
                                </div>
                            </div>
                            
                            
                            
                            
                            
                        </div>
                      
                    </div>
</div>    
</section>  
@endsection