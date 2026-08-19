@extends('backend.layout.master')
@section('content')

@push('specific_css')
<style>
    .ml-badge-teal { background: #0d9488; color: #fff; }
    .master-log-filters .form-label { font-size: .8rem; margin-bottom: .25rem; }
    .master-log-mono { font-family: ui-monospace, SFMono-Regular, Menlo, Consolas, monospace; font-size: .82rem; }
</style>
@endpush

<section class="content mt-3">
    <div class="container-fluid">

        <div class="row mb-2 align-items-center">
            <div class="col-sm-6">
                <h1>Master Logs</h1>
                <p class="text-muted mb-0">All admin, customer, frontend and mobile activity</p>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ url('/manager') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Master Logs</li>
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
            <div class="card-body master-log-filters">
                <form method="GET" action="{{ route('manager.master-logs.index') }}" class="row g-2 align-items-end">
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Search</label>
                        <input type="text"
                               name="q"
                               value="{{ $filters['q'] ?? '' }}"
                               class="form-control"
                               placeholder="Actor, description, URL, IP">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label fw-semibold">Source</label>
                        <select name="source" class="form-select">
                            <option value="">All</option>
                            @foreach ($sources as $source)
                                <option value="{{ $source }}" @selected(($filters['source'] ?? '') === $source)>
                                    {{ str_replace('_', ' ', ucfirst($source)) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label fw-semibold">Actor</label>
                        <select name="actor_type" class="form-select">
                            <option value="">All</option>
                            @foreach ($actorTypes as $type)
                                <option value="{{ $type }}" @selected(($filters['actor_type'] ?? '') === $type)>
                                    {{ ucfirst($type) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label fw-semibold">Action</label>
                        <select name="action" class="form-select">
                            <option value="">All</option>
                            @foreach ($actions as $action)
                                <option value="{{ $action }}" @selected(($filters['action'] ?? '') === $action)>
                                    {{ ucfirst($action) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Module</label>
                        <select name="module" class="form-select">
                            <option value="">All</option>
                            @foreach ($modules as $module)
                                <option value="{{ $module }}" @selected(($filters['module'] ?? '') === $module)>
                                    {{ $module }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Date From</label>
                        <input type="date" name="date_from" value="{{ $filters['date_from'] ?? '' }}" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Date To</label>
                        <input type="date" name="date_to" value="{{ $filters['date_to'] ?? '' }}" class="form-control">
                    </div>
                    <div class="col-md-6 d-flex flex-wrap gap-2">
                        <button type="submit" class="btn btn-primary">Filter</button>
                        <a href="{{ route('manager.master-logs.index') }}" class="btn btn-outline-secondary">Reset</a>
                    </div>
                </form>
            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
                    <div class="text-muted small">
                        Showing <strong>{{ $logs->count() }}</strong> of
                        <strong>{{ $logs->total() }}</strong> record(s)
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped table-bordered align-middle" width="100%">
                        <thead class="thead-dark">
                            <tr>
                                <th>ID</th>
                                <th>When</th>
                                <th>Actor</th>
                                <th>Source</th>
                                <th>Action</th>
                                <th>Module</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($logs as $data)
                            <tr>
                                <td>{{ $data->id }}</td>
                                <td class="text-nowrap">
                                    {{ optional($data->created_at)->format('d M Y') }}
                                    <div class="small text-muted">{{ optional($data->created_at)->format('h:i A') }}</div>
                                </td>
                                <td>
                                    <span class="badge {{ $data->actor_type === 'user' ? 'ml-badge-teal' : $data->actorBadgeClass() }}">
                                        {{ ucfirst($data->actor_type) }}
                                    </span>
                                    <div class="fw-semibold">{{ $data->actor_name ?: '—' }}</div>
                                    @if($data->actor_role)
                                        <div class="small text-muted">{{ $data->actor_role }}</div>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge {{ $data->sourceBadgeClass() }}">
                                        {{ str_replace('_', ' ', $data->source) }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border">{{ $data->action ?: '—' }}</span>
                                    @if($data->method)
                                        <div class="small text-muted master-log-mono">{{ $data->method }}</div>
                                    @endif
                                </td>
                                <td>{{ $data->module ?: '—' }}</td>
                                <td style="min-width: 220px;">
                                    {{ \Illuminate\Support\Str::limit($data->description, 90) }}
                                    @if($data->ip_address)
                                        <div class="small text-muted master-log-mono">{{ $data->ip_address }}</div>
                                    @endif
                                </td>
                                <td>
                                    @if($data->response_status)
                                        <span class="badge {{ $data->response_status >= 400 ? 'bg-danger' : ($data->response_status >= 300 ? 'bg-warning text-dark' : 'bg-success') }}">
                                            {{ $data->response_status }}
                                        </span>
                                    @else
                                        —
                                    @endif
                                </td>
                                <td class="text-nowrap">
                                    <a href="{{ route('manager.master-logs.show', $data->id) }}"
                                       class="btn btn-outline-primary btn-sm">
                                        View
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9" class="text-center text-muted py-4">
                                    No activity logs found for the selected filters.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    {{ $logs->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>

    </div>
</section>

@endsection
