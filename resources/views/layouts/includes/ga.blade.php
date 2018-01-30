@if(isset($ga_id))
    <!-- Google Analytics -->
    <script>
        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', '{{ $ga_id }}']);
        _gaq.push(['_trackPageview']);

        (function () {
            var ga = document.createElement('script');
            ga.src = 'https://www.google-analytics.com/ga.js';
            var s = document.scripts[0];
            s.parentNode.insertBefore(ga, s);
        })();
    </script>
    <!-- END Google Analytics -->
@endif