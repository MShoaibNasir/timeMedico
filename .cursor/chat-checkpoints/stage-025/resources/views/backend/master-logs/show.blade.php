@extends('backend.layout.master')
@section('content')

@push('specific_css')
<style>
    .ml-badge-teal { background: #0d9488; color: #fff; }
    .master-log-mono { font-family: ui-monospace, SFMono-Regular, Menlo, Consolas, monospace; font-size: .85rem; }
    .master-log-json {
        background: #0f2a3d;
        color: #e2e8f0;
        border-radius: 10px;
        padding: 1rem;
        max-height: 420px;
        overflow: auto;
        white-space: pre-wrap;
        word-break: break-word;
        font-size: .82rem;
    }
</style>
@endpush

<section class="content mt-3">
    <div class="container-fluid">
        <div class="row mb-3 align-items-center">
            <div class="col-sm-6">
                <h1>Log Detail #{{ $item->id }}</h1>
                <p class="text-muted mb-0">{{ optional($item->created_at)->format('d M Y, h:i:s A') }}</p>
            </div>
            <div class="col-sm-6 text-sm-end">
                <a href="{{ route('manager.master-logs.index') }}" class="btn btn-outline-secondary btn-sm">
                    ← Back to list
                </a>
            </div>
        </div>

        <div class="card border-0 shadow-sm mb-3">
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="text-muted small mb-0">Actor</label>
                        <p class="fw-semibold mb-1">
                            <span class="badge {{ $item->actor_type === 'user' ? 'ml-badge-teal' : $item->actorBadgeClass() }}">
                                {{ ucfirst($item->actor_type) }}
                            </span>
                            {{ $item->actor_name ?: '—' }}
                        </p>
                        <div class="small text-muted">
                            ID: {{ $item->actor_id ?? '—' }}
                            @if($item->actor_role) · {{ $item->actor_role }} @endif
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label class="text-muted small mb-0">Source</label>
                        <p class="fw-semibold mb-0">
                            <span class="badge {{ $item->sourceBadgeClass() }}">
                                {{ str_replace('_', ' ', $item->source) }}
                            </span>
                        </p>
                    </div>
                    <div class="col-md-3">
                        <label class="text-muted small mb-0">Action / Module</label>
                        <p class="fw-semibold mb-0">
                            {{ $item->action ?: '—' }}
                            <span class="text-muted">/</span>
                            {{ $item->module ?: '—' }}
                        </p>
                    </div>
                    <div class="col-md-3">
                        <label class="text-muted small mb-0">HTTP</label>
                        <p class="fw-semibold mb-0">
                            {{ $item->method ?: '—' }}
                            @if($item->response_status)
                                ·
                                <span class="badge {{ $item->response_status >= 400 ? 'bg-danger' : 'bg-success' }}">
                                    {{ $item->response_status }}
                                </span>
                            @endif
                        </p>
                    </div>
                    <div class="col-12">
                        <label class="text-muted small mb-0">Description</label>
                        <p class="fw-semibold mb-0">{{ $item->description ?: '—' }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small mb-0">Route</label>
                        <p class="master-log-mono mb-0">{{ $item->route_name ?: '—' }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small mb-0">IP Address</label>
                        <p class="master-log-mono mb-0">{{ $item->ip_address ?: '—' }}</p>
                    </div>
                    <div class="col-12">
                        <label class="text-muted small mb-0">URL</label>
                        <p class="master-log-mono mb-0" style="word-break: break-all;">{{ $item->url ?: '—' }}</p>
                    </div>
                    <div class="col-12">
                        <label class="text-muted small mb-0">User Agent</label>
                        <p class="small mb-0">{{ $item->user_agent ?: '—' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-3">
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-white border-0 pt-3">
                        <h5 class="mb-0">Request Data</h5>
                    </div>
                    <div class="card-body">
                        <pre class="master-log-json mb-0">{{ $item->request_data ? json_encode($item->request_data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) : 'No request payload captured.' }}</pre>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-white border-0 pt-3">
                        <h5 class="mb-0">Properties</h5>
                    </div>
                    <div class="card-body">
                        <pre class="master-log-json mb-0">{{ $item->properties ? json_encode($item->properties, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) : 'No extra properties.' }}</pre>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-4">
            <form method="POST" action="{{ route('manager.master-logs.destroy', $item->id) }}"
                  onsubmit="return confirm('Delete this log entry?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">Delete Log</button>
            </form>
        </div>
    </div>
</section>

@endsection
