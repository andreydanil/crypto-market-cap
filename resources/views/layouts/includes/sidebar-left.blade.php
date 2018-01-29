<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">

        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li>
                    <a href="{{ route('home.market') }}" aria-expanded="false"><span class="hide-menu">Market</span></a>
                </li>
                <li><a href="{{ route('news.index') }}"> News</a></li>
                <li><a href="{{ route('contact.index') }}"> Contact Us</a></li>
                <li>
                    <a class="has-arrow " href="#" aria-expanded="false"><span class="hide-menu">Site</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ route('static.terms') }}">Terms &amp; Conditions</a></li>
                        <li><a href="{{ route('static.privacy') }}">Privacy Policy</a></li>
                        <li><a href="{{ route('static.disclaimer') }}">Website Disclaimer</a></li>
                        <li><a href="{{ route('sitemap.index') }}">Sitemap</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
