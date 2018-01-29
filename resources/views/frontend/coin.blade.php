@extends('layouts.master')

@section('title', \App\Library\SeoHelper::title($coin))

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-block">

                        <div class="d-flex flex-row">
                            <div class=""><img src="{{ asset('asset/images/coins/img/'. $coin->logo) }}"
                                               class="img-rounded"
                                               height="80"></div>
                            <div class="p-l-20">
                                <h3 class="font-medium">{{ $coin->name }} <sup>{{ $coin->symbol }}</sup></h3>
                                <p>{{ \App\Library\SeoHelper::metaDescription($coin) }}</p>
                                @if(isset($changelly_aff_id))
                                    <div class="pull-right">
                                        <a href="https://changelly.com/?ref_id={{ $changelly_aff_id }}" target="_blank"
                                           rel="nofollow">
                                            <button class="btn btn-danger" type="button">
                                                <span class="btn-label">
                                                    <i class="fa fa-shopping-cart"></i>
                                                </span>
                                                Buy {{ $coin->name }}
                                            </button>
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        @if(isset($adsense_pub_id) && isset($adsense_slot1_id))
            @include('frontend.partials.adsense', ['slot_id' => $adsense_slot1_id])
        @endif

        <div class="row">
            @include('frontend.partials.coin_widget', ['col_size' => 3, 'title' => 'Price', 'subtitle' => 'USD', 'price' => $coin->price_usd, 'footer' => (isset($coin->price_btc) && $coin->price_btc != 1) ? $coin->price_btc : '', 'footer_sub' => 'BTC'])

            @include('frontend.partials.coin_widget', ['col_size' => 3, 'title' => 'Market Cap.', 'subtitle' => 'USD', 'price' => $coin->market_cap_usd, 'footer' => null, 'footer_sub' => null])

            @include('frontend.partials.coin_widget', ['col_size' => 3, 'title' => 'Change % (1H)', 'subtitle' => '%', 'price' => \App\Library\Helper::arrowSignal($coin->percent_change_1h), 'footer' => null, 'footer_sub' => null])

            @include('frontend.partials.coin_widget', ['col_size' => 3, 'title' => 'Change % (24H)', 'subtitle' => '%', 'price' => \App\Library\Helper::arrowSignal($coin->percent_change_24h), 'footer' => null, 'footer_sub' => null])

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-block">
                        <h4 class="card-title text-center">{{ $coin->name }} ({{ $coin->symbol }}) Historical Price
                            &amp; Volume Charts</h4>
                        <div style="background: url({{ asset('asset/images/coins/img/' . $coin->logo) }}) no-repeat center center; position: absolute; height: 100%; width: 100%; opacity: 0.15;"></div>

                        <div class="btn-group" role="group" id="ranges">
                            <button data-range='7' type="button" class="btn btn-sm btn-info"> 7D</button>
                            <button data-range='30' type="button" class="btn btn-sm btn-secondary"> 1M</button>
                            <button data-range='60' type="button" class="btn btn-sm btn-secondary"> 2M</button>
                            <button data-range='90' type="button" class="btn btn-sm btn-secondary"> 3M</button>
                            <button data-range='180' type="button" class="btn btn-sm btn-secondary"> 6M</button>
                            <button data-range='365' type="button" class="btn btn-sm btn-secondary"> 1Y</button>
                            <button data-range='1000' type="button" class="btn btn-sm btn-secondary"> ALL</button>
                        </div>

                        <div id="price_chart" style="height: 400px;"></div>
                        <div id="volume_chart" style="height: 200px;"></div>

                    </div>
                </div>

                @if(isset($adsense_pub_id, $adsense_slot2_id))
                    @include('frontend.partials.adsense', ['slot_id' => $adsense_slot2_id])
                @endif

                <div class="card">
                    <div class="card-block p-b-0">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs customtab" role="tablist">
                            @if (!blank($coin->description))
                                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#info"
                                                        role="tab"><span
                                                class="hidden-sm-up"><i class="ti-home"></i></span> <span
                                                class="hidden-xs-down">Information</span></a></li>
                            @endif
                            @if (!blank($coin->features))
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#features"
                                                        role="tab"><span
                                                class="hidden-sm-up"><i class="ti-user"></i></span> <span
                                                class="hidden-xs-down">Features</span></a></li>
                            @endif
                            @if (!blank($coin->technology))
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tech" role="tab"><span
                                                class="hidden-sm-up"><i class="ti-user"></i></span> <span
                                                class="hidden-xs-down">Technology</span></a></li>
                            @endif
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab_hx" role="tab"><span
                                            class="hidden-sm-up"><i class="ti-email"></i></span> <span
                                            class="hidden-xs-down">Historical Data</span></a></li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            @if (!blank($coin->description))
                                <div class="tab-pane active" id="info" role="tabpanel">
                                    <div class="p-20">
                                        <h3>Description</h3>
                                        @markdown($coin->description)

                                        @if(!blank($coin->start_date))
                                            <p>Genesis Date: {{ $coin->start_date }}</p>
                                        @endif
                                        @if(!blank($coin->website))
                                            <p>Website: <a href="{{ $coin->website }}"
                                                           target="_blank">{{ $coin->website }}</a></p>
                                        @endif
                                    </div>
                                </div>
                            @endif

                            @if (!blank($coin->features))
                                <div class="tab-pane  p-20" id="features" role="tabpanel">
                                    @markdown($coin->features)
                                </div>
                            @endif

                            @if (!blank($coin->technology))
                                <div class="tab-pane  p-20" id="tech" role="tabpanel">
                                    @markdown($coin->technology)
                                </div>
                            @endif

                            <div class="tab-pane p-20 @if(blank($coin->description)) active @endif" id="tab_hx"
                                 role="tabpanel">
                                <div class="table-responsive m-t-40">
                                    <table id="historical-data" class="table table-bordered" data-page-length='10'>
                                        <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Price</th>
                                            <th>Volume</th>
                                        </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if ($disqus_enabled)
                        <div class="card-block p-b-0">
                            @include('frontend.partials.disqus')
                        </div>
                    @endif

                </div>

            </div>
        </div>
    </div>

    <script type="text/javascript">
        var AJAX_URL = "{{ route('api.history') }}";
        var SYMBOL = "{{ $coin->symbol }}";
    </script>
@stop

@push('after-styles')
    <link href="{{ asset('asset/vendor/morrisjs/morris.css') }}" rel="stylesheet">
@endpush

@push('after-scripts')
    <script src="{{ asset('asset/vendor/raphael/raphael-min.js') }}"></script>
    <script src="{{ asset('asset/vendor/morrisjs/morris.js') }}"></script>
    <script src="{{ asset('asset/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('asset/js/chart.js') }}"></script>
@endpush