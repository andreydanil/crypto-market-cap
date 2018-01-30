<!-- modal -->
<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Donate Coins</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                @if(isset($donate_btc))
                    <p>Donate Bitcoin: <br/><strong>{{ $donate_btc }}</strong></p>
                @endif
                @if(isset($donate_eth))
                    <p>Donate Ethereum: <br/><strong>{{ $donate_eth }}</strong></p>
                @endif
                @if(isset($donate_ltc))
                    <p>Donate Litecoin: <br/><strong>{{ $donate_ltc }}</strong></p>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->