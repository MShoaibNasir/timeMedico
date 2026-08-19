@extends('frontend.layout.master')
@section('content')
<main class="main">
    <div class="site-breadcrumb">
        <div class="site-breadcrumb-bg" style="background-image: url('{{ asset('frontend/images/about-01.jpg') }}');"></div>
        <div class="container">
            <div class="site-breadcrumb-wrap">
                <h4 class="breadcrumb-title">Notifications</h4>
                <ul class="breadcrumb-menu">
                    <li><a href="{{ route('frontend.home.page') }}"><i class="far fa-home"></i> Home</a></li>
                    <li class="active">Notifications</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="user-area bg pt-100 pb-80">
        <div class="container">
            <div class="row">
                @include('components.userDashboardSidebar', ['active' => 'notifications'])
                <div class="col-lg-9">
                    <div class="user-wrapper">
                        <div class="user-card">
                            <div class="user-card-header d-flex flex-wrap justify-content-between align-items-center gap-2">
                                <h4 class="user-card-title mb-0">My Notifications</h4>
                                <div class="d-flex flex-wrap gap-2">
                                    @if(Auth::guard('web')->user()->unreadAppNotifications()->count())
                                    <form method="POST" action="{{ route('frontend.notifications.markAllRead') }}">
                                        @csrf
                                        <button type="submit" class="theme-btn">Mark all read</button>
                                    </form>
                                    @endif
                                    @if($notifications->count())
                                    <form method="POST"
                                          action="{{ route('frontend.notifications.destroyAll') }}"
                                          onsubmit="return confirm('Delete all notifications?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="theme-btn" style="background:#dc3545;">Delete all</button>
                                    </form>
                                    @endif
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-borderless align-middle">
                                    <thead>
                                        <tr>
                                            <th>Notification</th>
                                            <th>Order</th>
                                            <th>Date</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($notifications as $notification)
                                            @php
                                                $data = is_array($notification->data) ? $notification->data : [];
                                                $isUnread = ! $notification->is_read;
                                                $title = $notification->title ?: ($data['title'] ?? 'Notification');
                                                $body = $notification->message ?: ($data['body'] ?? '');
                                                $status = $notification->any_relivent_message ?: ($data['status'] ?? null);
                                                $orderNo = $data['order_no'] ?? null;
                                                $url = $data['url'] ?? null;
                                            @endphp
                                            <tr class="{{ $isUnread ? 'table-light' : '' }}">
                                                <td style="min-width:260px;">
                                                    <div class="d-flex align-items-start gap-2">
                                                        @if($isUnread)
                                                            <span class="badge bg-primary mt-1">New</span>
                                                        @endif
                                                        <div>
                                                            <strong>{{ $title }}</strong>
                                                            <div class="text-muted">{{ $body }}</div>
                                                            @if($status)
                                                                <span class="badge bg-secondary mt-1">{{ $status }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    @if($orderNo)
                                                        #{{ $orderNo }}
                                                    @elseif($notification->action_type === 'order' && $notification->action_id)
                                                        #{{ $notification->action_id }}
                                                    @else
                                                        —
                                                    @endif
                                                </td>
                                                <td class="text-nowrap">
                                                    {{ optional($notification->created_at)->format('d M Y, h:i A') }}
                                                </td>
                                                <td class="text-nowrap text-end">
                                                    @if($url)
                                                        <a href="{{ $url }}" class="btn btn-sm btn-outline-primary">View</a>
                                                    @endif
                                                    @if($isUnread)
                                                        <form method="POST"
                                                              action="{{ route('frontend.notifications.markRead', $notification->id) }}"
                                                              class="d-inline">
                                                            @csrf
                                                            <button type="submit" class="btn btn-sm btn-outline-secondary">Read</button>
                                                        </form>
                                                    @endif
                                                    <form method="POST"
                                                          action="{{ route('frontend.notifications.destroy', $notification->id) }}"
                                                          class="d-inline"
                                                          onsubmit="return confirm('Delete this notification?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center text-muted py-4">
                                                    No notifications yet. Order updates will appear here.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <div class="mt-3">
                                {{ $notifications->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
