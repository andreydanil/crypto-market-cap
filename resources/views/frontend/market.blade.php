@extends('layouts.master')

@section('title', \App\Library\SeoHelper::title())

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-block">

                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-block">

                                <div class="col-md-3 col-3 pull-right">
                                    <div class="dropdown pull-right">
                                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                                id="dropdownMenuButton"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            {{ $maxcoins }}
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item"
                                               href="{{ route('home.market.pageSize', 10) }}">10</a>
                                            <a class="dropdown-item"
                                               href="{{ route('home.market.pageSize', 25) }}">25</a>
                                            <a class="dropdown-item"
                                               href="{{ route('home.market.pageSize', 50) }}">50</a>
                                            <a class="dropdown-item"
                                               href="{{ route('home.market.pageSize', 100) }}">100</a>
                                        </div>
                                    </div>
                                </div>

                                <h4 class="card-title d-none d-md-block d-lg-block d-xl-block">Latest Cryptocurrency
                                    Prices &amp; Market Capitalizations</h4>

                                @if(isset($adsense_pub_id, $adsense_slot1_id))
                                    @include('frontend.partials.adsense', ['slot_id' => $adsense_slot1_id])
                                @endif

                                <div class="table-responsive m-t-40 d-none d-md-block d-lg-block d-xl-block">
                                    @include('frontend.partials.table-fancy', ['coins' => $coins])
                                </div>

                                <div class="m-t-40 d-block d-sm-block d-md-none d-lg-none d-xl-none">
                                    @include('frontend.partials.table-stacked', ['coins' => $coins])
                                </div>

                                @if(isset($adsense_pub_id, $adsense_slot2_id))
                                    @include('frontend.partials.adsense', ['slot_id' => $adsense_slot2_id])
                                @endif

                            </div>
                        </div>
                    </div>

                    <nav>{!! $coins->appends(\Request::except('page'))->render('vendor.pagination.simple-bootstrap-4') !!}</nav>
                </div>
            </div>
        </div>
    </div>
@stop

@push('after-styles')
    <link href="{{ asset('asset/vendor/tablesaw/stackonly/tablesaw.stackonly.css') }}" rel="stylesheet">
    <style>
        @media (max-width: 40em) {
            .tablesaw-stack tbody tr {
                border-bottom: 2px solid #91a0e9;
            }

            .tablesaw-stack td {
                padding: 8px 0;
                border-bottom: 1px dotted #ececec;
            }

            .tablesaw-stack td .tablesaw-cell-label {
                width: 40%;
                /*background: #fcfcfc;*/
            }

            .tablesaw-cell-content {
                /*float: right;*/
            }
        }
    </style>
@endpush

@push('after-scripts')
    <script src="{{ asset('asset/vendor/tablesaw/stackonly/tablesaw.stackonly.jquery.js') }}"></script>
    <script src="{{ asset('asset/vendor/tablesaw/tablesaw-init.js') }}"></script>

    <script>
/*
        $(function () {
            "use strict";
            Tablesaw.init();
        });
*/
    </script>
@endpush