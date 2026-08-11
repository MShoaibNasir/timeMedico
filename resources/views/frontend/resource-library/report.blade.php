@extends('frontend.layout.master')
@section('content')
<section class="flat-title-page">
<div class="container">
        <h4 class="mb-4">Reports &amp; Updates</h4>
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

                            <tr>
                                <td>1</td>

                                <td class="fw-semibold">
                                    Governance Highlights
                                </td>

                                <td class="text-center">
                                    <a href="https://picg.org.pk/governance-updates/" target="_blank" class="btn btn-sm btn-primary  px-4">
                                        Read More
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td>2</td>

                                <td class="fw-semibold">
                                    SME Case Studies
                                </td>

                                <td class="text-center">
                                    <a href="https://picg.org.pk/sme-case-studies/" target="_blank" class="btn btn-sm btn-primary  px-4">
                                        Read More
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td>3</td>

                                <td class="fw-semibold">
                                    Research Publications
                                </td>

                                <td class="text-center">
                                    <a href="https://picg.org.pk/research-publications/ " target="_blank" class="btn btn-sm btn-primary  px-4">
                                        Read More
                                    </a>
                                </td>
                            </tr>
                        </tbody>

                    </table>
                </div>

            </div>
        </div>
    </div>
</section>
    @endsection
