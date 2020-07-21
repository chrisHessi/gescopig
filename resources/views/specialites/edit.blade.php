@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Specialite
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($specialite, ['route' => ['specialites.update', $specialite->id], 'method' => 'patch']) !!}

                        @include('specialites.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection