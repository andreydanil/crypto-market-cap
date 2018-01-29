@extends('layouts.master')

@section('content')

    <div class="col-md-8 col-md-offset-2">
        <h2>Contact us
            <small>get in touch with us by filling form below</small>
        </h2>
        <hr class="colorgraph">

        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>

        {!! Form::open(['route' => 'contact.store', 'class' => 'contactForm', 'method' => 'POST']) !!}
        <div class="form-group">
            {!! Form::label('Your Name') !!}
            {!! Form::text('name', null, ['required', 'class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('Your E-mail Address') !!}
            {!! Form::text('email', null, ['required', 'class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('Your Message') !!}
            {!! Form::textarea('message', null,
                ['required', 'class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Contact Us!',
              ['class'=>'btn btn-primary btn-lg']) !!}
        </div>
        {!! Form::close() !!}

    </div>
@endsection