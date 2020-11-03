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
                    {!! Form::open(['route' => 'ecues.store']) !!}

                        {{--@include('ecues.fields')--}}
                        <div class="form-group col-xs-4">
                            {!! Form::label('academic_year_id', 'Année Académique:') !!}
                            {!! Form::select('academic_year_id',$academicYears, isset($apprenant)? $apprenant->academic_year_id : null, ['class' => 'form-control', 'placeholder' => 'selectioner l\'année']) !!}
                        </div>
                    
                        <div class="form-group col-md-4">
                            {!! Form::label('title', 'Title:') !!}
                            {!! Form::text('title', null, ['class' => 'form-control', 'id' => 'ecue', 'disabled']) !!}
                        </div>

                        <div class="form-group col-md-4">
                            {!! Form::label('semestre_id', 'Semestre') !!}
                            {!! Form::select('semestre_id', $semestres, null, ['class' => 'form-control', 'disabled']) !!}
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading"><strong>Specialite</strong></div>
                            <div class="panel-body">
                                <ul class="form-group list-group">
                                    @foreach($specialites as $specialite)
                                        <li class="list-group-item">
                                            <label class="checkbox-inline">
                                                {{--{!! Form::hidden('cycle', false) !!}--}}
                                                <label class="checkbox-inline">
                                                    {{--{!! Form::hidden('cycle', false) !!}--}}

                                                    {!! Form::checkbox('specialite[]', $specialite->id,null) !!}
                                                    {!! Form::label($specialite->title,$specialite->title. ' - ' .$specialite->slug)!!}

                                                </label>

                                            </label>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <div class="form-group col-md-12">
                            {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                            <a href="{!! route('ecues.index') !!}" class="btn btn-default">Cancel</a>
                        </div>


                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')

    <link rel="stylesheet" href="{{ url('css/easy-autocomplete.min.css') }}">

@endsection

@section('scripts')
    <script src="{{ url('js/jquery.easy-autocomplete.min.js') }}"></script>
    <script type="text/javascript">
        $(function(){
            var ecues = {!! $ecues !!};
            var title = null
            $("#academic_year_id").change(function () {
                var ay = $("#academic_year_id").val()
                if (ay !='') {
                    $("#ecue, #semestre_id").attr('disabled', false)
                    var url = 'http://' + window.location.host + '/public/ecues/' + ay + '/getEcues'
                    $.ajax({
                        url: url,
                        type: 'get',
                        success: (data, status) => {
                            ecues = data
                            title = {
                                data: ecues,
                                getValue: function (e) {
                                    return e.title
                                },
                                list: {
                                    match: {
                                        enabled: true
                                    },
                                    onClickEvent: function (e) {

                                        var id = $('#ecue').getSelectedItemData().id;
                                        window.location.href = 'http://' + window.location.host + '/ecues/' + id + '/edit';
                                    }
                                }
                            };

                            console.log(title)

                            $('#ecue').easyAutocomplete(title);
                        }
                    })
                }
                else {
                    $("#ecue, #semestre_id").attr('disabled', true)
                }
            })
        });
    </script>

@endsection
