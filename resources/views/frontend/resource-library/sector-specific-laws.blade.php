@extends('frontend.layout.master')
@section('content')
<section class="flat-title-page">
<div class="container">
        <h4 class="mb-4">State Bank of Pakistan</h4>
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
                                    Laws &amp; Regulations
                                </td>

                                <td class="text-center">
                                    <a href="https://www.sbp.org.pk/l_frame/index2.asp" target="_blank" class="btn btn-sm btn-primary  px-4">
                                        Read More
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td>2</td>

                                <td class="fw-semibold">
                                    Circulars/Notifications
                                </td>

                                <td class="text-center">
                                    <a href="https://www.sbp.org.pk/circulars/index.asp" target="_blank" class="btn btn-sm btn-primary  px-4">
                                        Read More
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td>3</td>

                                <td class="fw-semibold">
                                    Monetary Policy
                                </td>

                                <td class="text-center">
                                    <a href="https://www.sbp.org.pk/m_policy/index.asp" target="_blank" class="btn btn-sm btn-primary  px-4">
                                        Read More
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td>4</td>

                                <td class="fw-semibold">
                                    Publications
                                </td>

                                <td class="text-center">
                                    <a href="https://www.sbp.org.pk/publications/index2.asp" target="_blank" class="btn btn-sm btn-primary  px-4">
                                        Read More
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td>5</td>

                                <td class="fw-semibold">
                                    Financial Data
                                </td>

                                <td class="text-center">
                                    <a href="https://www.sbp.org.pk/ecodata/index2.asp" target="_blank" class="btn btn-sm btn-primary  px-4">
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