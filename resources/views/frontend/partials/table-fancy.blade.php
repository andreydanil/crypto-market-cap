<table class="table stylish-table table-hover">
    <thead>
    <tr>
        <th colspan="2">@sortablelink('name', 'Currency')</th>
        <th class="text-right">@sortablelink('price_usd', 'Price')</th>
        <th class="text-right">@sortablelink('market_cap_usd', 'Market Cap')</th>
        <th class="text-right">@sortablelink('volume_usd_24h', 'Volume 24H')</th>
        <th class="text-right">@sortablelink('percent_change_1h', 'Change % (1H)')</th>
        <th class="text-right">@sortablelink('percent_change_24h', 'Change % (24H)')</th>
        <th class="text-right">@sortablelink('percent_change_7d', 'Change % (7D)')</th>
    </tr>
    </thead>
    <tbody>
    @foreach($coins as $coin)
        <tr>
            <td style="width:30px; padding-right: 6px;">
                <span>
                    @if(isset($coin->logo))
                        <a href="{{ route('home.coin', $coin->symbol) }}">
                            <img src="{{ asset('asset/images/coins/tn/' . $coin->logo) }}" width="30">
                        </a>
                    @endif
                </span>
            </td>
            <td>
                <h6>
                    <a href="{{ route('home.coin', $coin->symbol) }}" class="d-none d-md-block d-lg-block d-xl-block"> {{ $coin->name }}</a>
                </h6>
                <small class="text-muted">{{ $coin->symbol }}</small>
            </td>
            <td class="text-right"><sup>$</sup> {{ $coin->price_usd }}</td>
            <td class="text-right"><sup>$</sup> {{ $coin->market_cap_usd }}</td>
            <td class="text-right"><sup>$</sup> {{ $coin->volume_usd_24h }}</td>
            @include('frontend.partials.change-td', ['value' => $coin->percent_change_1h, 'class' => 'text-right'])
            @include('frontend.partials.change-td', ['value' => $coin->percent_change_24h, 'class' => 'text-right'])
            @include('frontend.partials.change-td', ['value' => $coin->percent_change_7d, 'class' => 'text-right'])
        </tr>
    @endforeach
    </tbody>
</table>

<script>
    TablesawConfig = {
        swipeHorizontalThreshold: 2,
        swipeVerticalThreshold: 20
    };
</script>