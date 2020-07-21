@extends('layouts.app')

@section('content')
    <div class="content">
    <div class="clearfix"></div>

    @include('flash::message')

    <div class="clearfix"></div>
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
                    @if($model == 'resultatNominatifs')
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
        });
    </script>

@endsection