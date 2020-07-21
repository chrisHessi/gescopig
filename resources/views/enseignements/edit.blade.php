@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Enseignement
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($enseignement, ['route' => ['enseignements.update', $enseignement->id], 'method' => 'patch']) !!}

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
            $('#dateDebut').val = null;
            $('#dateFin').val = null;
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