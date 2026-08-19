@extends('backend.layout.master')
@section('content')

<section class="content mt-3">
    <div class="container-fluid">
        <div class="row mb-2 align-items-center">
            <div class="col-sm-7">
                <h1>Admin Notifications</h1>
                <p class="text-muted mb-0">
                    Operational alerts for orders, payments and feedback
                    @if($unreadCount > 0)
                        · <strong>{{ $unreadCount }}</strong> unread
                    @endif
                </p>
            </div>
            <div class="col-sm-5">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/manager') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Notifications</li>
                </ol>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card border-0 shadow-sm mb-3">
            <div class="card-body">
                <form method="GET" action="{{ route('manager.admin-notifications.index') }}" class="row g-2 align-items-end">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Search</label>
                        <input type="text" name="q" value="{{ $filters['q'] }}" class="form-control" placeholder="Title or message">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label fw-semibold">Type</label>
                        <select name="type" class="form-select">
                            <option value="">All</option>
                            @foreach($types as $type)
                                <option value="{{ $type }}" @selected($filters['type'] === $type)>{{ str_replace('_', ' ', ucfirst($type)) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label fw-semibold">Priority</label>
                        <select name="priority" class="form-select">
                            <option value="">All</option>
                            <option value="high" @selected($filters['priority'] === 'high')>High</option>
                            <option value="normal" @selected($filters['priority'] === 'normal')>Normal</option>
                            <option value="low" @selected($filters['priority'] === 'low')>Low</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label fw-semibold">Status</label>
                        <select name="is_read" class="form-select">
                            <option value="">All</option>
                            <option value="0" @selected($filters['is_read'] === '0')>Unread</option>
                            <option value="1" @selected($filters['is_read'] === '1')>Read</option>
                        </select>
                    </div>
                    <div class="col-md-2 d-flex gap-2">
                        <button class="btn btn-primary w-100" type="submit">Filter</button>
                        <a href="{{ route('manager.admin-notifications.index') }}" class="btn btn-outline-secondary">Reset</a>
                    </div>
                </form>
            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="text-muted small">
                        Showing <strong>{{ $notifications->count() }}</strong> of <strong>{{ $notifications->total() }}</strong>
                    </div>
                    @if($unreadCount > 0)
                        <form method="POST" action="{{ route('manager.admin-notifications.markAllRead') }}">
                            @csrf
                            <button class="btn btn-outline-primary btn-sm" type="submit">Mark all as read</button>
                        </form>
                    @endif
                </div>

                <div class="table-responsive">
                    <table class="table table-striped table-bordered align-middle">
                        <thead class="thead-dark">
                            <tr>
                                <th>When</th>
                                <th>Type</th>
                                <th>Priority</th>
                                <th>Alert</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($notifications as $item)
                                <tr class="{{ $item->is_read ? '' : 'table-warning' }}">
                                    <td class="text-nowrap">
                                        {{ optional($item->created_at)->format('d M Y') }}
                                        <div class="small text-muted">{{ optional($item->created_at)->format('h:i A') }}</div>
                                    </td>
                                    <td>
                                        <span class="badge {{ $item->typeBadgeClass() }}">
                                            {{ str_replace('_', ' ', $item->type) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge {{ $item->priorityBadgeClass() }}">{{ ucfirst($item->severity) }}</span>
                                    </td>
                                    <td style="min-width:260px;">
                                        <div class="fw-semibold">{{ $item->title }}</div>
                                        <div class="small text-muted">{{ \Illuminate\Support\Str::limit($item->displayMessage(), 110) }}</div>
                                    </td>
                                    <td>
                                        @if($item->is_read)
                                            <span class="badge bg-secondary">Read</span>
                                        @else
                                            <span class="badge bg-danger">Unread</span>
                                        @endif
                                    </td>
                                    <td class="text-nowrap">
                                        <a href="{{ route('manager.admin-notifications.show', $item->id) }}" class="btn btn-outline-primary btn-sm">
                                            Open
                                        </a>
                                        @if(! $item->is_read)
                                            <form method="POST" action="{{ route('manager.admin-notifications.markRead', $item->id) }}" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-outline-secondary btn-sm">Read</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">No admin notifications yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    {{ $notifications->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
