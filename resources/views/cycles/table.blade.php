<table class="table table-responsive" id="cycles-table">
    <thead>
        <tr>
            <th>Label</th>
        <th>Niveau</th>
        <th>Slug</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($cycles as $cycle)
        <tr>
            <td>{!! $cycle->label !!}</td>
            <td>{!! $cycle->niveau !!}</td>
            <td>{!! $cycle->slug !!}</td>
            <td>
                {!! Form::open(['route' => ['cycles.destroy', $cycle->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('cycles.show', [$cycle->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('cycles.edit', [$cycle->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>