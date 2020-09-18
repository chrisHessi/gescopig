@extends('layouts.app')

@section('content')
    @foreach($payments as $payment)
        <p>{{$payment->enseignements()}}</p><br>
    @endforeach
@endsection