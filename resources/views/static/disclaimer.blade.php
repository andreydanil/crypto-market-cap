@extends('layouts.master')

@section('title', 'Website disclaimer')

@section('content')
    <section id="wrapper">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-block">
                    <h2>{{ $app_name }} - Website disclaimer</h2>
                    <p>The information contained in this website is for general information purposes only. The
                        information is provided by {{ $app_name }} and while we endeavour to keep the information up to
                        date and correct, we make no representations or warranties of any kind, express or implied,
                        about the completeness, accuracy, reliability, suitability or availability with respect to the
                        website or the information, products, services, or related graphics contained on the website for
                        any purpose. Any reliance you place on such information is therefore strictly at your own risk.
                    </p>
                    <p>In no event will we be liable for any loss or damage including without limitation, indirect or
                        consequential loss or damage, or any loss or damage whatsoever arising from loss of data or
                        profits arising out of, or in connection with, the use of this website.
                    </p>
                    <p>Through this website you are able to link to other websites which are not under the control
                        of {{ $app_name }}. We have no control over the nature, content and availability of those sites.
                        The inclusion of any links does not necessarily imply a recommendation or endorse the views
                        expressed within them.
                    </p>
                    <p>Every effort is made to keep the website up and running smoothly. However, {{ $app_name }} takes
                        no responsibility for, and will not be liable for, the website being temporarily unavailable due
                        to technical issues beyond our control.</p>
                </div>
            </div>
        </div>
    </section>
@stop