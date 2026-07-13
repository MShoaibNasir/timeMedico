@extends('frontend.layout.master')
@section('content')
<main class="main">

    <!-- breadcrumb -->
    <div class="site-breadcrumb">
        <div class="site-breadcrumb-bg" style="background: url('{{ asset('frontend/images/about-01.jpg') }}');""></div>
        <div class=" container">
            <div class="site-breadcrumb-wrap">
                <h4 class="breadcrumb-title">Address</h4>
                <ul class="breadcrumb-menu">
                    <li><a href="home"><i class="far fa-home"></i> Home</a></li>
                    <li class="active">Address</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- breadcrumb end -->


    <!-- Upload Prescription -->
    <div class="contact-area pt-40 pb-80">
        <div class="container">

            <div class="contact-wrapper">
                <div class="row align-items-center">
                    <!-- Right Form -->
                    <div class="col-lg-12">
                        <div class="contact-form">
                            <div class="contact-form-header">
                                <h2>Address List</h2>
                            </div>

                            <div class="table-responsive mt-3">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Address Type</th>
                                            <th>Address</th>
                                            <th>Primary</th>
                                            <th>Created At</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($customer_address as $key => $address)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $address->address_type }}</td>
                                            <td>{{ $address->address }}</td>
                                            <td>
                                                @if($address->is_primary)
                                                <span class="badge bg-success">Yes</span>
                                                @else
                                                <span class="badge bg-secondary">No</span>
                                                @endif
                                            </td>
                                            <td>{{ $address->created_at->format('d M Y') }}</td>
                                            <td>
                                                @if($address->is_primary)
                                                <a style="color: #fff;" class="badge bg-success">Already Primary Address</a>
                                                @else
                                                <a href="{{route('frontend.customer.address.makePrimary',[$address->id])}}" style="color: #fff;" class="badge bg-danger">Make Primary</a>
                                                @endif
                                            </td>

                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="6" class="text-center">
                                                No addresses found.
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>



                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Upload Prescription End -->

</main>


@endsection