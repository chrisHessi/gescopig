<table class="table table-responsive" id="absences-table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Total Absence</th>
            <th >Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($absences as $absence)
        <tr>

            {{--<td>--}}
                {{--{!! Form::open(['route' => ['absences.destroy', $absence->id], 'method' => 'delete']) !!}--}}
                {{--<div class='btn-group'>--}}
                    {{--<a href="{!! route('absences.show', [$absence->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>--}}
                    {{--<a href="{!! route('absences.edit', [$absence->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>--}}
                    {{--{!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}--}}
                {{--</div>--}}
                {{--{!! Form::close() !!}--}}
            {{--</td>--}}
        </tr>
    @endforeach
    </tbody>
</table>