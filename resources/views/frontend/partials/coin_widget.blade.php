<div class="col-lg-3 col-md-{{ $col_size }}">
    <div class="card">
        <div class="card-block">
            <h4 class="card-title">{{ $title }}</h4>
            @if (strlen($footer) > 0)
                <div class="pull-left small-text">
                    <span class="text-muted"><sup>{{ $footer_sub }}</sup> {{ $footer }}</span>
                </div>
            @endif
            <div class="text-right">
                @if (strlen($subtitle) > 0)
                    <span class="text-muted">{{ $subtitle }}</span>
                @endif
                <p class="font-price font-light">{!! $price !!}</p>
            </div>
        </div>
    </div>
</div>