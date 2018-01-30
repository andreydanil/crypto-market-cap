<table class="table table-hover">
    <thead>
    <th>Currency</th>
    <th class="text-right">Price</th>
    <th class="text-right">Market Cap</th>
    <th class="text-right">Volume 24H</th>
    <th class="text-right d-none d-md-block d-lg-block d-xl-block">Change % (1H)</th>
    <th class="text-right">Change % (24H)</th>
    <th class="text-right d-none d-md-block d-lg-block d-xl-block">Change % (7D)</th>
    </thead>
    <tbody>
    @foreach($coins as $coin)
        <tr>
            <td><a href="{{ route('home.coin', $coin->symbol) }}"> {{ $coin->name }}</a></td>
            <td class="text-right"><sup>$</sup> {{ $coin->price_usd }}</td>
            <td class="text-right"><sup>$</sup> {{ $coin->market_cap_usd }}</td>
            <td class="text-right"><sup>$</sup> {{ $coin->volume_usd_24h }}</td>
            @include('frontend.partials.change-td', ['value' => $coin->percent_change_1h, 'class' => 'text-right d-none d-md-block d-lg-block d-xl-block'])
            @include('frontend.partials.change-td', ['value' => $coin->percent_change_24h, 'class' => 'text-right'])
            @include('frontend.partials.change-td', ['value' => $coin->percent_change_7d, 'class' => 'text-right d-none d-md-block d-lg-block d-xl-block'])
        </tr>
    @endforeach
    </tbody>
</table>