<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>CV - {{ $user->name }}</title>

    <style>
        /* GLOBAL */
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 13px;
            margin: 0;
            padding: 0;
            color: #333;
            line-height: 1.4;
            background: #fff;
        }

        .cv-container {
            width: 800px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
        }

        /* HEADER */
        .cv-header {
            width: 100%;
            display: table;
            padding-bottom: 15px;
            margin-bottom: 15px;
            border-bottom: 3px solid #2c3e50;
        }

        .cv-header-left {
            display: table-cell;
            width: 140px;
            vertical-align: top;
        }

        .cv-header-right {
            display: table-cell;
            vertical-align: middle;
            padding-left: 20px;
        }

        .cv-header img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 3px solid #2c3e50;
        }

        .cv-header-right h1 {
            margin: 0;
            font-size: 26px;
            color: #2c3e50;
        }

        .cv-header-right p {
            font-size: 12px;
            margin: 2px 0;
        }

        /* BODY */
        .cv-body {
            width: 100%;
            display: table;
        }

        .cv-left,
        .cv-right {
            display: table-cell;
            vertical-align: top;
        }

        .cv-left {
            width: 32%;
            padding-right: 15px;
            border-right: 1px solid #ccc;
        }

        .cv-right {
            width: 68%;
            padding-left: 15px;
        }

        /* SECTIONS */
        .cv-section {
            margin-bottom: 20px;
        }

        .cv-section h2 {
            font-size: 15px;
            background: #2c3e50;
            color: #fff;
            padding: 6px 10px;
            margin: 0 0 10px 0;
            text-transform: uppercase;
        }

        .cv-item h3 {
            margin: 0 0 3px 0;
            font-size: 14px;
        }

        .cv-item p {
            margin: 2px 0;
            font-size: 12px;
        }

        /* SKILLS */
        .cv-skill {
            display: inline-block;
            background: #ecf0f1;
            color: #2c3e50;
            padding: 4px 10px;
            margin: 3px 0;
            border-radius: 10px;
            font-size: 11px;
        }

    </style>
</head>

<body>
<div class="cv-container">

    <!-- HEADER -->
    <div class="cv-header">
        <div class="cv-header-left">
        <img src="{{ asset('storage/uploads/general/media/profile/' . ( Auth::guard('web')->user()->profile_image  ? Auth::guard('web')->user()->profile_image : 'images.jpeg')) }}">
        </div>
        <div class="cv-header-right">
            <h1>{{ $user->name }}</h1>
            <p>{{ $user->residential_address }}</p>
            <p>Email: {{ $user->email }} | Phone: {{ $user->phone_number }}</p>
            <p>Website: {{ $user->bioProfile->website_url ?? '' }}</p>
        </div>
    </div>

    <!-- BODY -->
    <div class="cv-body">

        <!-- LEFT -->
        <div class="cv-left">

            <!-- ABOUT -->
            <div class="cv-section">
                <h2>About Me</h2>
                <p>{{ $user->bioProfile->bio_summary ?? 'No summary added yet.' }}</p>
            </div>

            <!-- SKILLS -->
            <div class="cv-section">
                <h2>Skills</h2>
                @forelse($user->skill as $item)
                    <span class="cv-skill">{{ $item->name }} ({{ $item->skill_proficiency }}/5)</span><br>
                @empty
                    <p>No skills added.</p>
                @endforelse
            </div>

            <!-- CERTIFICATES -->
            <div class="cv-section">
                <h2>Certificates</h2>
                @forelse($user->additionCertificate as $item)
                    <div class="cv-item">
                        <h3>{{ $item->certificate_title }}</h3>
                        <p>{{ $item->issuing_organization }}</p>
                        <p>{{ date('M Y', strtotime($item->issue_date)) }}</p>
                    </div>
                @empty
                    <p>No certificates added.</p>
                @endforelse
            </div>

            <!-- CONTACT -->
            <div class="cv-section">
                <h2>Contact</h2>
                <p>Nationality: {{ $user->nationality }}</p>
                <p>Phone: {{ $user->phone_number }}</p>
                <p>Email: {{ $user->email }}</p>
                <p>Website: {{ $user->bioProfile->website_url ?? '' }}</p>
            </div>

        </div>

        <!-- RIGHT -->
        <div class="cv-right">

            <!-- EXPERIENCE -->
            <div class="cv-section">
                <h2>Experience</h2>
                @forelse($user->experience as $item)
                    <div class="cv-item">
                        <h3>{{ $item->job_title }}</h3>
                        <p><strong>{{ $item->organization_name }}</strong></p>
                        <p>{{ date('M Y', strtotime($item->start_date)) }} - {{ $item->end_date ? date('M Y', strtotime($item->end_date)) : 'Present' }}</p>
                        <p>{{ $item->country }}</p>
                        <p>{{ $item->job_description }}</p>
                    </div>
                @empty
                    <p>No experience added.</p>
                @endforelse
            </div>

            <!-- EDUCATION -->
            <div class="cv-section">
                <h2>Education</h2>
                @forelse($user->education as $item)
                    <div class="cv-item">
                        <h3>{{ $item->degree_title }}</h3>
                        <p>{{ $item->institute_name }}</p>
                        <p>{{ date('M Y', strtotime($item->start_date)) }} - {{ $item->end_date ? date('M Y', strtotime($item->end_date)) : 'Present' }}</p>
                        <p>Majors: {{ $item->majors }}</p>
                    </div>
                @empty
                    <p>No education added.</p>
                @endforelse
            </div>

            <!-- AWARDS -->
            <div class="cv-section">
                <h2>Awards</h2>
                @forelse($user->award as $item)
                    <div class="cv-item">
                        <h3>{{ $item->title }}</h3>
                        <p>{{ $item->organization }}</p>
                        <p>{{ $item->evaluation_period }}</p>
                        <p>{{ $item->comments }}</p>
                    </div>
                @empty
                    <p>No awards added.</p>
                @endforelse
            </div>

            <!-- PUBLICATIONS -->
            <div class="cv-section">
                <h2>Publications</h2>
                @forelse($user->Publications as $item)
                    <div class="cv-item">
                        <h3>{{ $item->title }}</h3>
                        <p>Published On: {{ date('M d Y', strtotime($item->published_date)) }}</p>
                        <p>{{ $item->publisher_name }}</p>
                        <p>{{ $item->url }}</p>
                        <p>{{ $item->description }}</p>
                    </div>
                @empty
                    <p>No publications added.</p>
                @endforelse
            </div>

        </div>

    </div>
</div>
</body>
</html>
