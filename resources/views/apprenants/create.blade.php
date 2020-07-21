@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Apprenant
        </h1>
    </section>
    <div class="row container">
        <div class="content">
            @include('adminlte-templates::common.errors')

            {!! Form::open(['route' => 'apprenants.store', 'id' => 'form']) !!}

                @include('apprenants.fields')

            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(function(){
            var elem = $('#parent1').clone();
            var form = $('#form')
            var i = 1;
            $('#ajouter').click(function(e){
                e.preventDefault();
                var clone = elem;
                console.log(clone)
                ++i;
                clone.attr('id','parent' + i);
                clone.find('h3').html('Informations du parent'+i)
                clone.find('.nameLabel').attr('for', 'name'+i).val('');
                clone.find('.nameInput').attr('name', 'name'+i).val('');

                clone.find('.professionLabel').attr('for', 'profession'+i).val('');
                clone.find('.professionInput').attr('name', 'profession'+i).val('');

                clone.find('.addresseLabel').attr('for', 'addresse'+i).val('');
                clone.find('.addresseInput').attr('name', 'addresse'+i).val('');

                clone.find('.tel_mobileLabel').attr('for', 'tel_mobile'+i).val('');
                clone.find('.tel_mobileInput').attr('name', 'tel_mobile'+i).val('');

                clone.find('.tel_bureauLabel').attr('for', 'tel_bureau'+i).val('');
                clone.find('.tel_bureauInput').attr('name', 'tel_bureau'+i).val('');

                clone.find('.tel_fixeLabel').attr('for', 'tel_fixe'+i).val('');
                clone.find('.tel_fixeInput').attr('name', 'tel_fixe'+i).val('');

                clone.find('.typeLabel').attr('for', 'type'+i).val('');
                clone.find('.typeInput').attr('name', 'type'+i).val('');

                clone.insertBefore('.button-container')
                elem = clone.clone()
            })

            $('#save').click(function(e){
                e.preventDefault();
                var input = '<input type="hidden" value="'+i+'" name="number"/>';
                $('#parent1').append(input);
                console.log(input);
                form.submit();
            })
        })
    </script>
@endsection
