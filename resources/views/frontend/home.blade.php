@extends('layouts.master')

@section('title', App\Library\SeoHelper::title())

@section('content')
    <!-- Row -->
    <div class="row">
        <!-- Column -->
        <div class="col-12">

            <div class="ribbon-wrapper-reverse card">
                <div class="ribbon ribbon-bookmark ribbon-vertical-r ribbon-danger"><i class="fa fa-heart-o"></i></div>
                <div class="card-block">
                    <h2 class="card-title text-primary">Cryptocurrency monitoring done right!</h2>
                    <p class="text-muted">Monitor {{ number_format($coins_approx) }}+ cryptocurrencies. Get advanced alerts based on Buy, Sell,
                        Volume and more.</p>
                    <p class="card-text">
                        {{ $app_name }} is an interactive platform where you can analyze the latest Crypto trends and
                        monitor all markets streaming in real time. View the latest Cryptocurrency price with our
                        interactive and live price chart including market capitalization. Monitor the latest prices of
                        {{ number_format($coins_approx) }}+ crypto-currencies on over 80 exchanges from all around the world. Track crypto currency
                        value with automatic price tracker. Make cryptocurrency trading easy and profitable.
                    </p>
                    <a href="{{ route('home.market') }}" class="btn btn-rounded btn-outline-success">View Market Data</a>
                </div>
            </div>

            @if(isset($adsense_pub_id, $adsense_slot1_id))
                @include('frontend.partials.adsense', ['slot_id' => $adsense_slot1_id])
            @endif

            <div class="card">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="p-20">
                            <h4 class="card-subtitle">Highest Grossing Cryptocurrencies</h4>
                            <div class="message-box m-t-30">
                                <div class="message-widget">
                                    @foreach($top_coins as $symbol => $c)
                                        <a class="coin_list" href="#" data-attr="{{ $symbol }}">
                                            <div class="user-img">
                                                <img src="{{ asset('asset/images/coins/tn/' . $c['logo']) }}" alt="user"
                                                     class="img-circle">
                                            </div>
                                            <div class="mail-contnet">
                                                <h5>{{ $c['name'] }} ({{ $symbol }})</h5>
                                                <span class="mail-desc">Price: {{ $c['price'] }}</span>
                                                <span class="time">Change: {{ $c['change'] }}%</span>
                                            </div>
                                        </a>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 b-l">
                        <div id="chart-div" class="card-block">
                            <h4 class="font-medium text-inverse">&nbsp;</h4>
                            <div class="price-chart" style="height: 420px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
    </div>
    <!-- Row -->

    @if(isset($adsense_pub_id, $adsense_slot2_id))
        @include('frontend.partials.adsense', ['slot_id' => $adsense_slot2_id])
    @endif


    <div class="row">

        <div class="col-lg-6">
            <div class="card">
                <div class="card-block bg-light-success">
                    <div class="row">
                        <div class="col-6">
                            <h2 class="m-b-0">Daily Top Gainers</h2>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    @include('frontend.partials.table-list', ['items' => $gainers, 'text_class' => 'text-success'])
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card">
                <div class="card-block bg-light-warning">
                    <div class="row">
                        <div class="col-6">
                            <h2 class="m-b-0">Daily Top Losers</h2>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    @include('frontend.partials.table-list', ['items' => $losers, 'text_class' => 'text-danger'])
                </div>
            </div>
        </div>

    </div>
@endsection

@push('after-styles')
    <link href="{{ asset('asset/vendor/chartist-js/dist/chartist.min.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/vendor/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css') }}"
          rel="stylesheet">
@endpush

@push('before-scripts')
    <script>
        var AJAX_URL = "{{ route('api.history') }}";
    </script>
@endpush

@push('after-scripts')
    <script src="{{ asset('asset/vendor/chartist-js/dist/chartist.min.js') }}"></script>
    <script src="{{ asset('asset/vendor/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js') }}"></script>
    <script src="{{ asset('asset/js/home.js') }}"></script>
@endpush