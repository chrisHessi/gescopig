    @extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Enseignant
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'enseignants.store']) !!}

                        @include('enseignants.fields')

                        <div class="form-group col-sm-6">
                            {!! Form::label('mh_licence', 'Montant Horaire licence:') !!}
                            {!! Form::number('mh_licence', null, ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group col-sm-6">
                            {!! Form::label('mh_master', 'Montant Horaire master:') !!}
                            {!! Form::number('mh_master', null, ['class' => 'form-control']) !!}
                        </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
