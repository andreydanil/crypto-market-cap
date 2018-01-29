<td class="no-wrap {{ $class }}">
    @if($value > 0)
        <span class="change-up">
                <i class="fa fa-arrow-up"></i> {{ $value }}%</span>
    @elseif($value < 0)
        <span class="change-down">
                <i class="fa fa-arrow-down"></i> {{ $value }}%</span>
    @endif
</td>