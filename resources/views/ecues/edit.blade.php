@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Ecue
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="">
                   {!! Form::model($ecue, ['route' => ['ecues.update', $ecue->id], 'method' => 'patch']) !!}

                        @include('ecues.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection