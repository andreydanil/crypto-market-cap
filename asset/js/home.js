$(function () {
    "use strict";

    new Chartist.Line('.price-chart', {}
        , {
            showArea: true
            , fullWidth: true
            , plugins: [
                Chartist.plugins.tooltip()
            ]
        });

    function fetchData(symbol) {
        var DATA = {symbol: symbol, limit: 7};
        $.ajax({
            type: "POST",
            url: AJAX_URL,
            dataType: "json",
            data: DATA,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
            .done(function (records) {
                $('#chart-div').find('h4').text(symbol + ' Price');

                records = records.reverse();

                var data = {
                    labels: records.map(function (r) {
                        return r.date;
                    }),
                    series: [records.map(function (r) {
                        return r.price;
                    })]
                };
                var price_chart = $('.price-chart');
                price_chart.get(0).__chartist__.update(data);
            })
            .fail(function () {
                //alert("error occured");
            });
    }

    fetchData('BTC');

    $('a.coin_list').click(function (e) {
        e.preventDefault();

        var el = $(this);
        var symbol = el.attr('data-attr');

        fetchData(symbol);

        /*
        el.removeClass('btn-secondary');
        el.addClass('btn-info');
        el.siblings().addClass('btn-secondary');
        el.siblings().removeClass('btn-info');
        */
    });

});
