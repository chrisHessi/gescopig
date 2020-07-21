@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Semestre
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($semestre, ['route' => ['semestres.update', $semestre->id], 'method' => 'patch']) !!}

                        @include('semestres.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection