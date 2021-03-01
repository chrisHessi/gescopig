@extends('layouts.app')

@section('content')
    <div class="content">
    <div class="clearfix"></div>

    @include('flash::message')

    <div class="clearfix"></div>
        @if(isset($academicYears))
            <div class="row">
                <div class="form-group col-xs-2 pull-right">
                    {!! Form::label('academic_year_id', 'Année Académique:') !!}
                    {!! Form::select('academic_year_id',$academicYears, null, ['class' => 'form-control', 'placeholder' => 'selectioner l\'année']) !!}
                </div>
            </div>
        @endif
        <div>
    @foreach($cycles as $cycle)
        @foreach($cycle->specialites as $specialite)

            <div class="{{ ($cycle->label == 'Master') ? 'col-lg-6' : 'col-lg-3' }} col-xs-6 clearfix">
                <div class="small-box {!! $specialite->slug !!}">
                    <div class="inner">
                        <h3>
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">{!! $specialite->slug.' '.$cycle->niveau !!}</font>
                            </font>
                        </h3>
                    </div>
                    <div class="icon">
                        <i class="">
                        </i>
                    </div>
                    @if($model == 'resultatNominatifs' || $model == 'scolarites')
                        <a href="{!! route($model .'.'.$method,[$cycle->id, $specialite->id]) !!}" class="small-box-footer ">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">
                                    {!! ($method == 'create')?'Enregistrer resultats' : 'Afficher les resultats' !!}
                                </font>
                            </font>
                            <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    @else
                        @foreach($cycle->semestres as $semestre)
                            <a href="{!! route($model .'.'.$method,[$semestre->id, $specialite->id, isset($type) ? $type : '']) !!}" class="small-box-footer ">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">
                                        {!! $semestre->title !!}
                                    </font>
                                </font>
                                <i class="fa fa-arrow-circle-right"></i>
                            </a>

                        @endforeach
                    @endif
                </div>
            </div>

        @endforeach
    @endforeach
    </div>
    </div>
@endsection

@section('scripts')

    <script>
        $(function(){
           $('.CG, .MAACO').addClass('bg-green');
            $('.CG .icon>i').addClass('fa fa-calculator'); //fa fa-bank
            $('.MAACO .icon>i').addClass('fa fa-calculator'); //fa fa-bank
           $('.BF').addClass('bg-red');
            $('.BF .icon>i').addClass('fa fa-bank');
            $('.MAQUAP').addClass('bg-yellow');
            $('.MAQUAP .icon>i').addClass('fa fa-bank');

            $('.MATRAS').addClass('bg-purple');
            $('.MATRAS .icon>i').addClass('fa fa-bank');

            $('.MAMES').addClass('bg-aqua');
            $('.MAMES .icon>i').addClass('fa fa-bank');

            $('.MAFINE').addClass('bg-info');
            $('.MAFINE .icon>i').addClass('fa fa-dollar');

            $('.MAMREH').addClass('bg-green');
            $('.MAMREH .icon>i').addClass('fa fa-bank');

            $('.MACMA').addClass('bg-red');
            $('.MACMA .icon>i').addClass('fa fa-bank');

           $('.CMD').addClass('bg-yellow');
            $('.CMD .icon>i').addClass('fa fa-laptop');
           $(".TL").addClass('bg-aqua');
            $('.TL .icon>i').addClass('fa fa-truck');
            get_academic()
        });

        @if($model == 'notes' || $model == 'scolarites')
        $('#academic_year_id').change(function () {
            get_academic()
        })

        function get_academic() {
            select_id = $('#academic_year_id').val()
            ay_id = (select_id == '') ? "{!! $cur_year->id !!}" : select_id
            console.log(ay_id)
            var links = document.querySelectorAll(".small-box a")

            links.forEach(element => {
                href = element.getAttribute('href')

                if(href.slice(-1) == '?'){
                    url = href + 'ay_id='+ ay_id
                }
                else if(href.slice(-7,-2) == 'ay_id'){
                    url = href.slice(0,-1) + ay_id
                }
                else {
                    url = href + '?ay_id='+ ay_id
                }
                element.setAttribute('href', url)
            });
        }

        @else
            function get_academic(){
                //
            }
        @endif

    </script>

@endsection