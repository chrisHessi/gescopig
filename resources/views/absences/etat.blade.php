@extends('layouts.app')

@section('content')

    @foreach($cycles as $cycle)
        @foreach($cycle->specialites as $specialite)

            <div class="col-lg-3 col-xs-6">
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

                    @foreach($cycle->semestres as $semestre)
                        <a href="{!! route('absences.affiche',[$semestre->id, $specialite->id]) !!}" class="small-box-footer ">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">
                                    {!! $semestre->title !!}
                                </font>
                            </font>
                            <i class="fa fa-arrow-circle-right">
                            </i>
                        </a>

                    @endforeach
                </div>
            </div>

        @endforeach
    @endforeach

@endsection

@section('scripts')

    <script>
        $(function(){
            $('.CG').addClass('bg-green');
            $('.CG .icon>i').addClass('fa fa-calculator'); //fa fa-bank
            $('.BF').addClass('bg-red');
            $('.BF .icon>i').addClass('fa fa-bank');
            $('.NM').addClass('bg-yellow');
            $('.NM .icon>i').addClass('fa fa-laptop');
            $(".TL").addClass('bg-aqua');
            $('.TL .icon>i').addClass('fa fa-truck');
        });
    </script>

@endsection