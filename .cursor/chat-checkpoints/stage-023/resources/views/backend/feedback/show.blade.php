@extends('backend.layout.master')
@section('content')

<section class="content mt-3">
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-sm-6">
                <h1>Feedback Detail</h1>
            </div>
            <div class="col-sm-6 text-sm-end">
                <a href="{{ route('manager.feedback.index') }}" class="btn btn-outline-secondary btn-sm">
                    ← Back to list
                </a>
            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="text-muted small mb-0">Customer</label>
                        <p class="fw-semibold mb-0">{{ $item->user->name ?? 'Guest / N/A' }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small mb-0">Phone</label>
                        <p class="fw-semibold mb-0">{{ $item->user->phone_number ?? '—' }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small mb-0">Email</label>
                        <p class="fw-semibold mb-0">{{ $item->email ?: ($item->user->email ?? '—') }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small mb-0">Submitted On</label>
                        <p class="fw-semibold mb-0">{{ optional($item->created_at)->format('d M Y, h:i A') }}</p>
                    </div>
                    <div class="col-12">
                        <label class="text-muted small mb-0">Subject</label>
                        <p class="fw-semibold mb-0">{{ $item->subject ?: '—' }}</p>
                    </div>
                    <div class="col-12">
                        <label class="text-muted small mb-1">Message</label>
                        <div class="p-3 rounded border bg-light" style="white-space: pre-wrap;">{{ $item->message }}</div>
                    </div>
                </div>

                <div class="mt-4">
                    <form method="POST" action="{{ route('manager.feedback.destroy', $item->id) }}"
                          onsubmit="return confirm('Delete this feedback?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete Feedback</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
