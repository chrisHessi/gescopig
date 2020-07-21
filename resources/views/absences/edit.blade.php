@extends('layouts.app')

@section('content')
    <div class="clearfix"></div>

    @include('flash::message')

    <div class="clearfix"></div>
    <section class="content-header">
        <h1>
            {!! $contrat->apprenant->nom. ' ' .$contrat->apprenant->prenom . ' - ' .$contrat->specialite->slug .' '. $contrat->cycle->niveau !!}
        </h1>
    </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">

                   {{--{!! Form::model($absence, ['route' => ['absences.update', $absence->id], 'method' => 'patch']) !!}--}}

                        {{--@include('absences.fields')--}}

                   {{--{!! Form::close() !!}--}}

                   <div class="form-group pull-right">
                       {!! Form::select('typeAbsence',['0'=>'absences non jutifiées','1'=>'absences jutifiées'],null,['class' => 'form-control', 'placeholder' => '', 'id'=>'typeAbsence']) !!}
                   </div>

                   <table class="table table-responsive tablesorter" id="absenceTable">
                       <thead>
                       <tr>
                           <th>Date</th>
                           <th>Ecue</th>
                           <th>Absences justifiées</th>
                           <th>Motif</th>
                       </tr>
                       </thead>
                       <tbody>
                       @foreach($contrat->absences->whereIn('ecue_id', $ecues) as $absences)
                           <tr >
                               <td>
                                   {!!$absences->date->format('d.m.Y')!!}
                               </td>
                               <td>
                                   {!! $absences->ecue->title !!}
                               </td>
                               <td>
                                   {!! Form::checkbox('justify', $absences->justify ? 1:0, $absences->justify, ['class' => 'checkbox', 'disabled']) !!}
                               </td>
                                    {{--{!! Form::model($absences, ['route' => ['absences.update', $absences->id], 'method' => 'patch']) !!}--}}
                               <td class="justification">
                                    {{--{!! Form::checkbox('justify', 1, $absences->justify, ['class' => 'checkbox']) !!}--}}
                                   {{--<div class="justifyText">--}}
                                    {{--{!! Form::textarea('justification', $absences->justification, ['class' => 'form-control']) !!}--}}
                                    {{--{!! Form::submit('justifier', ['class'=> 'btn btn-primary']) !!}--}}
                                   {{--</div>--}}
                                   @if($absences->justify)
                                       <button type="button" class="btn btn-primary"
                                               data-toggle="modal" data-target="#justificationModal" data-action="voir"
                                               data-justification="{{ $absences->justification }}" id="voirMotif">
                                           voir le motif
                                       </button>
                                   @else
                                       @can('edit absences')
                                       <button type="button" class="btn btn-primary" data-toggle="modal"
                                               data-target="#justificationModal" data-id="{{ $absences->id }}"
                                               id="ajouterMotif">
                                           Ajouter une justification
                                       </button>
                                       @else
                                           <p>Non justifiée</p>
                                       @endcan
                                   @endif
                               </td>
                                    {{--{!! Form::close() !!}--}}
                           </tr>
                       @endforeach

                       </tbody>
                   </table>
           </div>
           <div class="box-footer"><a href="{!! route('absences.affiche',[$sem->id, $contrat->specialite->id]) !!}"
                                    class="btn btn-primary pull-right">back</a></div>
       </div>
   </div>

    <div class="modal fade" id="justificationModal" tabindex="-1" role="dialog" aria-labelledby="justificationModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="justificationModalLabel">Motif</h4>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close">Close</button>
                    <a class="btn btn-primary" id="save">Save changes</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <style  type="text/css">
        .checkbox{
            width: 20px;
            height: 20px;

        }
        textarea{
            resize: none;
        }
        .hidden{
            display: none;
        }

    </style>
@endsection

@section('scripts')
    <script src="{{ asset('js/jquery.tablesorter.js') }}"></script>


    <script>
        $(function(){
            $('#absenceTable').tablesorter();

            $('#typeAbsence').change(function(){
                var type = $(this).val();
                $('.checkbox').parent().parent().addClass('hidden');

                if(type == ''){
                    $('.checkbox').parent().parent().removeClass('hidden');
                }
                else {
                    $('.checkbox').each(function () {
                        if ($(this).val() == parseInt(type)) {
                            $(this).parent().parent().toggleClass('hidden');
                        }
                    })
                }

            });

            $('#justificationModal').on('show.bs.modal', function(e){
                var button = $(e.relatedTarget);
                var action = button.attr('id');
                var justification = button.data('justification');
                var modal = $(this);

                if(action == 'voirMotif'){
                    modal.find('#save').css('display','none');
                    modal.find('.modal-body').text(justification);
                }
                else{
                    var textarea = '{!! Form::textarea('justification', null,
                     ['class' => 'form-control', 'id' => 'justification']) !!}';

                    modal.find('#save').show();
                    modal.find('.modal-body').html(textarea);
                }

                $('#save').click(function(e){
                    e.preventDefault();
                    var justification = $('#justification').val();
                    var absence = parseInt(button.data('id'));
                    var url = 'http://'+ window.location.host +'/absences/updateJustif/'+justification+'/'+absence;
//                    var url = 'https://www.gescopig.com/absences/updateJustif/'+justification+'/'+absence;


                    if(justification){

//                        $.ajax({
//                            url: 'http://localhost/pigier/public/absences/updateJustif/'+justification+'/'+absence,
////                            url: 'https://www.gescopig.com/absences/updateJustif/'+justification+'/'+absence,
//                            success: function(){
//                                modal.hide();
//                                window.location.reload();
//                            },
//                            error: function(){
//                                alert('bad');
//                            }
//
//                        })
                        window.location.href = url;
                    }
                    else{
                        alert('veuillez entrer un motif svp');
                    }


                });
            });

        })
    </script>
@endsection