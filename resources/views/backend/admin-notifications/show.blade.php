@extends('backend.layout.master')
@section('content')

<section class="content mt-3">
    <div class="container-fluid">
        <div class="row mb-3 align-items-center">
            <div class="col-sm-6">
                <h1>Notification Detail</h1>
            </div>
            <div class="col-sm-6 text-sm-end">
                <a href="{{ route('manager.admin-notifications.index') }}" class="btn btn-outline-secondary btn-sm">← Back</a>
            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex flex-wrap gap-2 mb-3">
                    <span class="badge {{ $item->typeBadgeClass() }}">{{ str_replace('_', ' ', $item->type) }}</span>
                    <span class="badge {{ $item->priorityBadgeClass() }}">{{ ucfirst($item->severity) }}</span>
                    <span class="badge {{ $item->is_read ? 'bg-secondary' : 'bg-danger' }}">
                        {{ $item->is_read ? 'Read' : 'Unread' }}
                    </span>
                </div>
                <h4>{{ $item->title }}</h4>
                <p class="text-muted">{{ optional($item->created_at)->format('d M Y, h:i A') }}</p>
                <div class="p-3 rounded border bg-light" style="white-space: pre-wrap;">{{ $item->displayMessage() }}</div>

                @if($item->action_url)
                    <div class="mt-3">
                        <a href="{{ $item->action_url }}" class="btn btn-primary btn-sm">Go to related record</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

@endsection
