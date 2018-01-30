@extends('layouts.master')

@section('title', 'Search Results')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-block">

                    <div class="table-responsive">
                        @if(count($coins) == 0)
                            <div class="aligncenter">
                                <p>No coins found.</p>
                            </div>
                        @else
                            @include('frontend.partials.table-plain', ['coins' => $coins])
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection