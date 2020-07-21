@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Creation des enseignements
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')

        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'enseignements.store']) !!}

                        @include('enseignements.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

    <script>
        $(function(){
            $('#dateDebutEff').val = null;
            $('#dateFinEff').val = null;
            $('#mhEff').val = null;
        });
    </script>

@endsection

@section('css')
    <style  type="text/css">
        .checkbox{
            width: 20px;
            height: 20px;
        }
    </style>
@endsection
