<table class="table table-responsive" id="specialites-table">
    <thead>
        <tr>
            <th>Title</th>
        <th>Slug</th>
        <th>Niveau Academique</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($specialites as $specialite)
        <tr>
            <td>{!! $specialite->title !!}</td>
            <td>{!! $specialite->slug !!}</td>
            <td>
                <table class="table table-responsive" id="cycles-table">
                    <tr>
                        @foreach($specialite->cycles as $cycles)
                            <td>{!! $cycles->slug !!}</td>
                        @endforeach
                    </tr>
                </table>
            </td>
            <td>
                {!! Form::open(['route' => ['specialites.destroy', $specialite->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
{{--                    <a href="{!! route('specialites.show', [$specialite->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>--}}
                    @can('edit specialites')
                    <a href="{!! route('specialites.edit', [$specialite->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    @endcan
                    @can('delete specialites')
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    @endcan
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>