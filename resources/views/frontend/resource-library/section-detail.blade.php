@extends('frontend.layout.master')
@section('content')
<section class="flat-title-page">
<div class="container">
        <h4 class="mb-4">{{  $sectionItem->description}}</h4>
        <div class="card shadow-sm border-1 rounded-2">
            <div class="card-body p-4">

                <div class="table-responsive">
                    <table class="table custom-table align-middle mb-0">

                        <thead class="table-dark">
                            <tr>
                                <th width="10%">#</th>
                                <th width="70%">Name</th>
                                <th width="20%" class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                        @foreach ($sectionItem->items as $key=>$item)
                            <tr>
                                <td>{{ ++$key}}</td>

                                <td class="fw-semibold">{{ $item->title }}</td>

                                <td class="text-center">
                                    <a href="{{ $item->link }}" target="_blank" class="btn btn-sm btn-primary  px-4">
                                        Read More
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                           
                        </tbody>

                    </table>
                </div>

            </div>
        </div>
    </div>
</section>
    @endsection
