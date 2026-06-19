@include('frontend.layout.header')
<style>
    .custom-modal {
        border-radius: 15px;
        /* smooth corners */
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        /* subtle shadow */
        border: none;
        /* remove default border */
        overflow: hidden;
        /* prevent content overflow */
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .custom-modal .modal-header {
        background: linear-gradient(135deg, #4e73df, #1cc88a);
        /* gradient header */
        color: #fff;
        border-bottom: none;
        padding: 1rem 1.5rem;
    }

    .custom-modal .modal-title {
        font-weight: 600;
        font-size: 1.25rem;
    }

    .custom-modal .modal-body {
        padding: 1.5rem;
        font-size: 1rem;
        color: #333;
        background-color: #f9f9f9;
    }

    .custom-modal .modal-footer {
        border-top: none;
        padding: 1rem 1.5rem;
        background-color: #f1f1f1;
    }

    .custom-modal .btn-secondary {
        background-color: #6c757d;
        border: none;
        border-radius: 8px;
        padding: 0.5rem 1rem;
        transition: all 0.3s ease;
    }

    .custom-modal .btn-secondary:hover {
        background-color: #5a6268;
    }
</style>
@include('frontend.layout.nav')
@yield('content')



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered"> <!-- centered modal -->
        <div class="modal-content custom-modal">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Notifications</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>No new notifications.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>





@include('frontend.layout.footer')
@include('frontend.layout.authModal')
@include('frontend.layout.script')