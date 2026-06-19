@extends('frontend.layout.master')
@section('content')

<!-- MAIN CONTENT START -->
<section class="flat-title-page">
    <div class="row">
        <div class="container">
            <div class="flat-img-with-text style-3 bg-primary-new">
                <div class="content-left img-animation wow animated animated animated animated"
                    style="visibility: visible;">
                    <h1 class="hub-directors text-white">SPEAKING OPPORTUNITIES</h1>
                    <img class="lazyload"
                        src="{{asset('frontend/images/banner/speaking-writng.png')}}" alt="banner image">
                </div>
                <div class="content-right">

                    <!-- SPEAKING Section -->
                    <div class="home-form-sections-container">
                        <div class="writing-section">
                            <h2 class="section-header">
                                <i class="fas fa-microphone me-3"></i>
                                SPEAKING
                            </h2>
                        </div>
                        <div class="form-content-area">
                            <form action="{{route('frontend.Storespeeking')}}" method="post">
                                @csrf
                            <table class="form-table">
                                <tbody>
                                    <tr>
                                        <td><strong>Topic</strong></td>
                                        <td>
                                            <input type="text" name="topic" class="form-input-field"
                                                placeholder="Enter writing topic..." required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Topic Brief</strong></td>
                                        <td>
                                            <textarea name="topic_brief" class="form-input-field" required></textarea>
                                        </td>
                                    </tr>
                                  
                                    <tr>
                                        <td><strong>Suggested platform</strong></td>
                                        <td>
                                            <input type="text" class="form-input-field"
                                                placeholder="Suggested platform" required name="suggested_platform">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>link to sample videos Sector(s)</strong></td>
                                        <td>
                                            <input type="text" name="video_link" required class="form-input-field"
                                                placeholder="links to other writing Sector(s)">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Duration</strong></td>
                                        <td>
                                            <select class="form-input-field" required name="duration">
                                                <option value="">Select duration...</option>
                                                <option value="15">15 minutes</option>
                                                <option value="30">30 minutes</option>
                                                <option value="45">45 minutes</option>
                                                <option value="60">1 hour</option>
                                                <option value="90">1.5 hours</option>
                                                <option value="120">2 hours</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="button-cell">
                                            <button type="submit"
                                                class="tf-btn btn-view primary hover-btn-view submit">Submit
                                                <span class="icon icon-arrow-right2"></span></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            </form>
                        </div>
                    </div>



                </div>

            </div>

        </div>
    </div>
</section>
<!-- MAIN CONTENT END -->

@endsection