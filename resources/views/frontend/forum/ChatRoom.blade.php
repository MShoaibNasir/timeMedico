@extends('frontend.layout.master')
<style>
    .avatar-circle {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: var(--avatar-bg);
    color: #fff;
    font-weight: 600;
    font-size: 13px;
}
</style>
@section('content')

<!-- MAIN CONTENT START -->
<section class="flat-title-page">

    <div class="row">
        <div class="container">
            <div class="flat-img-with-text style-3 bg-primary-new">
                <div class="container-fluid">
                    <div class="responsive-forums-wrapper" style="padding: 15px; margin-bottom:-3px">
                        <div class="container mx-auto">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0" style="color:#84898e">
                                {{ $forum->title }}
                            </h5>

                            @if($forum->detail)
                                <button class="btn btn-success btn-sm"
                                        data-bs-toggle="modal"
                                        data-bs-target="#detailModal{{ $forum->id }}"> View Detail
                                </button>
                            @endif
                            </div>
                            
                        </div>
                    </div>

                    <div class="modal fade" id="detailModal{{ $forum->id }}" tabindex="-1">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h5 class="modal-title">{{ $forum->title }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>

                                        <div class="modal-body">
                                            {!! nl2br(e($forum->detail)) !!}
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                        </div>

                                    </div>
                                </div>
                    </div>
                    <div class="row mt-3">

    <!-- CHAT SECTION -->
    <div class="col-md-8">
        <div class="card h-100">

            <div class="card-body chat-box"
                 style="height: 450px; overflow-y: auto; background: #f5f5f5;">
                @if($messages->count() > 0)
                    @foreach($messages as $message)
                        @if($message->user_id == Auth::guard('web')->user()->id)
                        
                            <!-- My Message -->
                            <div class="d-flex justify-content-end mb-3">
                                <div style="
                                    background: #d1e7dd;
                                    padding: 10px 15px;
                                    border-radius: 15px;
                                    max-width: 65%;
                                ">
                                    <div style="font-size:14px;">
                                        {{ $message->message }}
                                    </div>
                                    <div style="font-size:11px; text-align:right; color:gray;">
                                        {{ $message->created_at->format('h:i A') }}
                                    </div>
                                </div>
                            </div>
                        @else
                            <!-- Other Message -->
                            <div class="justify-content-start mb-3">
                                <div style="
                                    background: white;
                                    padding: 10px 15px;
                                    border-radius: 15px;
                                    max-width: 65%;
                                    border: 1px solid #ddd;
                                ">
                                    
                                    <div style="font-size:14px;">
                                        {{ $message->message }}
                                    </div>
                                    <div style="display: flex; justify-content: flex-end; gap: 8px; margin-top: 4px;">

                                        <strong style="font-size:13px; font-style: oblique; color: gray;">
                                            {{ $message->user->name }}
                                        </strong>

                                        <span style="font-size:11px; color:gray;">
                                            {{ $message->created_at->format('h:i A') }}
                                        </span>

                                    </div>
                                    
                                </div>
                            </div>
                        @endif

                    @endforeach
                @else
                    <div class="d-flex justify-content-center align-items-center h-100 empty-chat">
                        <div style="text-align:center; color:#999;">
                            <i class="fas fa-comments mb-2" style="font-size:40px;"></i>
                            <p style="font-size:16px;">Let’s start discussion</p>
                        </div>
                    </div>
                @endif

            </div>

            <div class="card-footer">
            <form id="chatForm">
                @csrf
                <div class="d-flex">
                    <input type="text"
                        name="message"
                        id="messageInput"
                        class="form-control me-2"
                        placeholder="Type your message..."
                        required>

                        <button type="submit" id="sendBtn" class="btn btn-primary">
                            <span id="btnText">Send</span>
                            <span id="btnLoader" class="spinner-border spinner-border-sm d-none" role="status"></span>
                        </button>
                </div>
            </form>
            
            </div>

        </div>
    </div>

    <!-- MEMBERS SECTION -->
    <div class="col-md-4">
        <div class="card h-100">

            <div class="card-header">
                <i class="fas fa-users text-primary"></i>
                Members ({{ $subscribers->count() }})
            </div>

            <div class="card-body"
                 style="height: 450px; overflow-y: auto;">

                @if($subscribers->count() > 0)

                   @foreach($subscribers->sortByDesc(fn($member) => Auth::guard('web')->check()  && $member->id == Auth::guard('web')->user()->id) as $member)                        @php
                            $names = explode(' ', trim($member->name));
                            $firstInitial = strtoupper(substr($names[0], 0, 1));
                            $lastInitial = isset($names[1]) ? strtoupper(substr(end($names), 0, 1)) : '';
                            $initials = $firstInitial . $lastInitial;

                            $colors = ['#0d6efd', '#6610f2', '#6f42c1', '#d63384', '#dc3545',
                                    '#fd7e14', '#198754', '#20c997', '#0dcaf0', '#6c757d'];

                            $bgColor = $colors[crc32($member->name) % count($colors)];
                        @endphp
                        <div class="d-flex align-items-center mb-3 p-2 rounded"
                            style="background:#f8f9fa;">

                            <div class="avatar-circle me-3"
                                style="--avatar-bg: {{ $bgColor }};">
                                {{ $initials }}
                            </div>
                        
                            <span style="font-size: 15px; font-weight: 500;">
                                {{ $member->name }}
                                @if(Auth::guard('web')->check() && Auth::guard('web')->user()->id == $member->id)
                                <span class="badge bg-success ms-2">You</span>
                                @endif
                            </span>

                        </div>
                    @endforeach

                @else
                    <p class="text-muted">No members yet.</p>
                @endif

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
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script>
const currentUserId = {{ Auth::guard('web')->user()->id }};

const chatBox = document.querySelector('.chat-box');
const chatForm = document.getElementById('chatForm');
const messageInput = document.getElementById('messageInput');
const sendBtn = document.getElementById('sendBtn');
const btnText = document.getElementById('btnText');
const btnLoader = document.getElementById('btnLoader');

function scrollChat() {
    chatBox.scrollTo({
        top: chatBox.scrollHeight,
        behavior: 'smooth'
    });
}

// Remove placeholder if first message appears
function removeEmptyState() {
    const emptyState = document.querySelector('.empty-chat');
    if (emptyState) emptyState.remove();
}

// Function to append message
function appendMessage(data, isMine) {
    removeEmptyState();

    let date = new Date(data.message.created_at || new Date());
    let formattedTime = date.toLocaleTimeString([], {
        hour: '2-digit',
        minute: '2-digit'
    });

    let messageHtml = '';

    if (isMine) {
        messageHtml = `
        <div class="d-flex justify-content-end mb-3">
            <div style="
                background:#d1e7dd;
                padding:10px 15px;
                border-radius:15px;
                max-width:65%;
            ">
                <div>${data.message.message}</div>
                <div style="font-size:11px; text-align:right; color:gray;">
                    ${formattedTime}
                </div>
            </div>
        </div>
        `;
    } else {
        messageHtml = `
        <div class="d-flex justify-content-start mb-3">
            <div style="
                background:white;
                padding:10px 15px;
                border-radius:15px;
                max-width:65%;
                border:1px solid #ddd;
            ">
                <div style="font-size:14px;">
                    ${data.message.message}
                </div>
                <div style="display:flex; justify-content:flex-end; gap:8px; margin-top:4px;">
                    <strong style="font-size:13px; color:gray;">
                        ${data.message.user.name}
                    </strong>
                    <span style="font-size:11px; color:gray;">
                        ${formattedTime}
                    </span>
                </div>
            </div>
        </div>
        `;
    }

    chatBox.innerHTML += messageHtml;
    scrollChat();
}

// AJAX Send Message
chatForm.addEventListener('submit', function(e) {
    e.preventDefault();

    let message = messageInput.value.trim();
    if (!message) return;

    // Show loading
    sendBtn.disabled = true;
    btnText.textContent = 'Sending...';
    btnLoader.classList.remove('d-none');

    fetch("{{ route('sendMessage', $forum->id) }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({ message })
    })
    .then(res => res.json())
    .then(data => {
        // Append message for sender
        appendMessage({ message: { ...data.message, user_id: currentUserId } }, true);
        messageInput.value = '';
    })
    .catch(err => alert('Message failed. Try again.'))
    .finally(() => {
        sendBtn.disabled = false;
        btnText.textContent = 'Send';
        btnLoader.classList.add('d-none');
    });
});

// Pusher Real-time updates
Pusher.logToConsole = true;

var pusher = new Pusher("{{ env('PUSHER_APP_KEY') }}", {
    cluster: "{{ env('PUSHER_APP_CLUSTER') }}",
    forceTLS: true
});

var channel = pusher.subscribe('forum.{{ $forum->id }}');

channel.bind('MessageSent', function(data) {
    const isMine = data.message.user_id === currentUserId;
    if (!isMine) appendMessage(data, false);
});

// Scroll to bottom on load
scrollChat();
</script>
@endsection