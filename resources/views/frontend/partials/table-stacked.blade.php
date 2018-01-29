<table class="tablesaw tablesaw-stack" data-tablesaw-mode="stack">
    <thead>
    <tr>
        <th data-tablesaw-sortable-col>Currency</th>
        <th data-tablesaw-sortable-col data-tablesaw-sortable-numeric>Price</th>
        <th data-tablesaw-sortable-col data-tablesaw-sortable-default-col data-tablesaw-sortable-numeric>Mkt. Cap</th>
        <th data-tablesaw-sortable-col data-tablesaw-sortable-numeric>Volume 24H</th>
        <th data-tablesaw-sortable-col data-tablesaw-sortable-numeric>Change % (1H)</th>
        <th data-tablesaw-sortable-col data-tablesaw-sortable-numeric>Change % (24H)</th>
        <th data-tablesaw-sortable-col data-tablesaw-sortable-numeric>Change % (7D)</th>
    </tr>
    </thead>
    <tbody>
    @foreach($coins as $coin)
        <tr>
            <td>
                <span>
                    @if(isset($coin->logo))
                        <a href="{{ route('home.coin', $coin->symbol) }}">
                            <img src="{{ asset('asset/images/coins/tn/' . $coin->logo) }}" width="18">
                        </a>
                    @endif
                </span>
                <strong>
                    <a href="{{ route('home.coin', $coin->symbol) }}"> {{ $coin->name }}</a>
                </strong>
                &nbsp;
                <sup class="small-text">{{ $coin->symbol }}</sup>
            </td>
            <td><sup>$</sup> {{ $coin->price_usd }}</td>
            <td><sup>$</sup> {{ $coin->market_cap_usd }}</td>
            <td><sup>$</sup> {{ $coin->volume_usd_24h }}</td>
            @include('frontend.partials.change-td-no-label', ['value' => $coin->percent_change_1h, 'class' => ''])
            @include('frontend.partials.change-td-no-label', ['value' => $coin->percent_change_24h, 'class' => ''])
            @include('frontend.partials.change-td-no-label', ['value' => $coin->percent_change_7d, 'class' => ''])
        </tr>
    @endforeach
    </tbody>
</table>