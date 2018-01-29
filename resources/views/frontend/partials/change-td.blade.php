<td class="no-wrap {{ $class }}">
    @if($value > 0)
        <span class="change-up label label-light-success">
                <i class="fa fa-chevron-up"></i> {{ $value }}%</span>
    @elseif($value < 0)
        <span class="change-down label label-light-danger">
                <i class="fa fa-chevron-down"></i> {{ $value }}%</span>
    @endif
</td>