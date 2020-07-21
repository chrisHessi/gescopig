@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Apprenant
        </h1>
   </section>
    <div class="row">
        <div class="content col-md-12">
            @include('adminlte-templates::common.errors')

            {!! Form::model($apprenant, ['route' => ['apprenants.update', $apprenant->id], 'method' => 'patch']) !!}

                @include('apprenants.fields')

            {!! Form::close() !!}

        </div>
    </div>
@endsection