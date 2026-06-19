@extends('frontend.layout.master')
@section('content')

<!-- MAIN CONTENT START -->
<section class="flat-title-page">

    <div class="row">
        <div class="container">
            <div class="flat-img-with-text style-3 bg-primary-new">
                <div class="container-fluid">
                    <div class="responsive-forums-wrapper">
                        <div class="responsive-forums-container">

                            <!-- Left Section - Forums Title & Graphics -->
                            <div class="responsive-left-section">
                                <h1 class="responsive-forums-title">
                                    <i class="fas fa-comments me-3"></i>
                                    FORUMS
                                </h1>

                                <img src="{{asset('frontend/images/banner/forum.png')}}" alt="" class="img-fluid w-50 pt-3 pb-4">
                            </div>

                            <!-- Right Section - Discussions -->
                            <div class="responsive-right-section">

                                <!-- Desktop Table View -->
                                <table class="desktop-discussions-table">
                                    <thead>
                                        <tr class="desktop-table-header">
                                            <th class="desktop-header-cell desktop-main-header">RECENT
                                                DISCUSSIONS</th>
                                            <th class="desktop-header-cell">Posts</th>
                                            <th class="desktop-header-cell">Members</th>
                                            <th class="desktop-header-cell">Pages</th>
                                            <th class="desktop-header-cell">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="desktop-discussion-row">
                                            <td class="desktop-data-cell">
                                                <a href="#esg-guidelines" class="modern-topic-link">
                                                    <i class="fas fa-leaf me-2" style="color: #48bb78;"></i>
                                                    New ESG Guidelines
                                                </a>
                                            </td>
                                            <td class="desktop-data-cell modern-stats-number">84</td>
                                            <td class="desktop-data-cell modern-stats-number">25</td>
                                            <td class="desktop-data-cell modern-pages-indicator">1.....7
                                            </td>
                                            <td class="desktop-data-cell">
                                                <a href="#subscribe-esg" class="modern-subscribe-btn">
                                                    <i class="fas fa-bell"></i>
                                                    Subscribe
                                                </a>
                                            </td>
                                        </tr>

                                        <tr class="desktop-discussion-row">
                                            <td class="desktop-data-cell">
                                                <a href="#dei-board" class="modern-topic-link">
                                                    <i class="fas fa-users me-2"
                                                        style="color: #667eea;"></i>
                                                    DEI on Board Level
                                                </a>
                                            </td>
                                            <td class="desktop-data-cell modern-stats-number">42</td>
                                            <td class="desktop-data-cell modern-stats-number">18</td>
                                            <td class="desktop-data-cell modern-pages-indicator">1.....3
                                            </td>
                                            <td class="desktop-data-cell">
                                                <a href="#subscribe-dei" class="modern-subscribe-btn">
                                                    <i class="fas fa-bell"></i>
                                                    Subscribe
                                                </a>
                                            </td>
                                        </tr>

                                        <tr class="desktop-discussion-row">
                                            <td class="desktop-data-cell">
                                                <a href="#issb-s2" class="modern-topic-link">
                                                    <i class="fas fa-chart-line me-2"
                                                        style="color: #4ecdc4;"></i>
                                                    ISSB S2
                                                </a>
                                            </td>
                                            <td class="desktop-data-cell modern-stats-number">67</td>
                                            <td class="desktop-data-cell modern-stats-number">31</td>
                                            <td class="desktop-data-cell modern-pages-indicator">1.....5
                                            </td>
                                            <td class="desktop-data-cell">
                                                <a href="#subscribe-issb2" class="modern-subscribe-btn">
                                                    <i class="fas fa-bell"></i>
                                                    Subscribe
                                                </a>
                                            </td>
                                        </tr>

                                        <tr class="desktop-discussion-row">
                                            <td class="desktop-data-cell">
                                                <a href="#issb-s1" class="modern-topic-link">
                                                    <i class="fas fa-file-alt me-2"
                                                        style="color: #a55eea;"></i>
                                                    ISSB S1
                                                </a>
                                            </td>
                                            <td class="desktop-data-cell modern-stats-number">29</td>
                                            <td class="desktop-data-cell modern-stats-number">14</td>
                                            <td class="desktop-data-cell modern-pages-indicator">1.....2
                                            </td>
                                            <td class="desktop-data-cell">
                                                <a href="#subscribe-issb1" class="modern-subscribe-btn">
                                                    <i class="fas fa-bell"></i>
                                                    Subscribe
                                                </a>
                                            </td>
                                        </tr>

                                        <tr class="desktop-discussion-row">
                                            <td class="desktop-data-cell">
                                                <a href="#ccg-insurers" class="modern-topic-link">
                                                    <i class="fas fa-shield-alt me-2"
                                                        style="color: #ff6b6b;"></i>
                                                    New CCG for Insurers
                                                </a>
                                            </td>
                                            <td class="desktop-data-cell modern-stats-number">156</td>
                                            <td class="desktop-data-cell modern-stats-number">47</td>
                                            <td class="desktop-data-cell modern-pages-indicator">1.....12
                                            </td>
                                            <td class="desktop-data-cell">
                                                <a href="#subscribe-ccg" class="modern-subscribe-btn">
                                                    <i class="fas fa-bell"></i>
                                                    Subscribe
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <!-- Mobile Card View -->
                                <div class="mobile-discussions-cards">

                                    <div class="mobile-discussion-card">
                                        <div class="mobile-card-header">
                                            <div class="mobile-topic-title">
                                                <a href="#esg-guidelines" class="mobile-topic-link">
                                                    <i class="fas fa-leaf" style="color: #48bb78;"></i>
                                                    New ESG Guidelines
                                                </a>
                                            </div>
                                        </div>
                                        <div class="mobile-card-stats">
                                            <div class="mobile-stat-item">
                                                <span class="mobile-stat-number">84</span>
                                                <span class="mobile-stat-label">Posts</span>
                                            </div>
                                            <div class="mobile-stat-item">
                                                <span class="mobile-stat-number">25</span>
                                                <span class="mobile-stat-label">Members</span>
                                            </div>
                                            <div class="mobile-stat-item">
                                                <span class="mobile-stat-number">7</span>
                                                <span class="mobile-stat-label">Pages</span>
                                            </div>
                                        </div>
                                        <div class="mobile-card-actions">
                                            <span class="mobile-pages-info">Pages: 1.....7</span>
                                            <a href="#subscribe-esg" class="modern-subscribe-btn">
                                                <i class="fas fa-bell"></i>
                                                Subscribe
                                            </a>
                                        </div>
                                    </div>

                                    <div class="mobile-discussion-card">
                                        <div class="mobile-card-header">
                                            <div class="mobile-topic-title">
                                                <a href="#dei-board" class="mobile-topic-link">
                                                    <i class="fas fa-users" style="color: #667eea;"></i>
                                                    DEI on Board Level
                                                </a>
                                            </div>
                                        </div>
                                        <div class="mobile-card-stats">
                                            <div class="mobile-stat-item">
                                                <span class="mobile-stat-number">42</span>
                                                <span class="mobile-stat-label">Posts</span>
                                            </div>
                                            <div class="mobile-stat-item">
                                                <span class="mobile-stat-number">18</span>
                                                <span class="mobile-stat-label">Members</span>
                                            </div>
                                            <div class="mobile-stat-item">
                                                <span class="mobile-stat-number">3</span>
                                                <span class="mobile-stat-label">Pages</span>
                                            </div>
                                        </div>
                                        <div class="mobile-card-actions">
                                            <span class="mobile-pages-info">Pages: 1.....3</span>
                                            <a href="#subscribe-dei" class="modern-subscribe-btn">
                                                <i class="fas fa-bell"></i>
                                                Subscribe
                                            </a>
                                        </div>
                                    </div>

                                    <div class="mobile-discussion-card">
                                        <div class="mobile-card-header">
                                            <div class="mobile-topic-title">
                                                <a href="#issb-s2" class="mobile-topic-link">
                                                    <i class="fas fa-chart-line"
                                                        style="color: #4ecdc4;"></i>
                                                    ISSB S2
                                                </a>
                                            </div>
                                        </div>
                                        <div class="mobile-card-stats">
                                            <div class="mobile-stat-item">
                                                <span class="mobile-stat-number">67</span>
                                                <span class="mobile-stat-label">Posts</span>
                                            </div>
                                            <div class="mobile-stat-item">
                                                <span class="mobile-stat-number">31</span>
                                                <span class="mobile-stat-label">Members</span>
                                            </div>
                                            <div class="mobile-stat-item">
                                                <span class="mobile-stat-number">5</span>
                                                <span class="mobile-stat-label">Pages</span>
                                            </div>
                                        </div>
                                        <div class="mobile-card-actions">
                                            <span class="mobile-pages-info">Pages: 1.....5</span>
                                            <a href="#subscribe-issb2" class="modern-subscribe-btn">
                                                <i class="fas fa-bell"></i>
                                                Subscribe
                                            </a>
                                        </div>
                                    </div>

                                    <div class="mobile-discussion-card">
                                        <div class="mobile-card-header">
                                            <div class="mobile-topic-title">
                                                <a href="#issb-s1" class="mobile-topic-link">
                                                    <i class="fas fa-file-alt" style="color: #a55eea;"></i>
                                                    ISSB S1
                                                </a>
                                            </div>
                                        </div>
                                        <div class="mobile-card-stats">
                                            <div class="mobile-stat-item">
                                                <span class="mobile-stat-number">29</span>
                                                <span class="mobile-stat-label">Posts</span>
                                            </div>
                                            <div class="mobile-stat-item">
                                                <span class="mobile-stat-number">14</span>
                                                <span class="mobile-stat-label">Members</span>
                                            </div>
                                            <div class="mobile-stat-item">
                                                <span class="mobile-stat-number">2</span>
                                                <span class="mobile-stat-label">Pages</span>
                                            </div>
                                        </div>
                                        <div class="mobile-card-actions">
                                            <span class="mobile-pages-info">Pages: 1.....2</span>
                                            <a href="#subscribe-issb1" class="modern-subscribe-btn">
                                                <i class="fas fa-bell"></i>
                                                Subscribe
                                            </a>
                                        </div>
                                    </div>

                                    <div class="mobile-discussion-card">
                                        <div class="mobile-card-header">
                                            <div class="mobile-topic-title">
                                                <a href="#ccg-insurers" class="mobile-topic-link">
                                                    <i class="fas fa-shield-alt"
                                                        style="color: #ff6b6b;"></i>
                                                    New CCG for Insurers
                                                </a>
                                            </div>
                                        </div>
                                        <div class="mobile-card-stats">
                                            <div class="mobile-stat-item">
                                                <span class="mobile-stat-number">156</span>
                                                <span class="mobile-stat-label">Posts</span>
                                            </div>
                                            <div class="mobile-stat-item">
                                                <span class="mobile-stat-number">47</span>
                                                <span class="mobile-stat-label">Members</span>
                                            </div>
                                            <div class="mobile-stat-item">
                                                <span class="mobile-stat-number">12</span>
                                                <span class="mobile-stat-label">Pages</span>
                                            </div>
                                        </div>
                                        <div class="mobile-card-actions">
                                            <span class="mobile-pages-info">Pages: 1.....12</span>
                                            <a href="#subscribe-ccg" class="modern-subscribe-btn">
                                                <i class="fas fa-bell"></i>
                                                Subscribe
                                            </a>
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</section>
<!-- MAIN CONTENT END -->

@endsection