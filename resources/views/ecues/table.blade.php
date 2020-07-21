
<table class="table table-responsive results" id="ecuesTable">
    <thead>
        <tr>
            <th>Title</th>
            <th>Semestre</th>
            <th>Slug</th>
            <th>Credits</th>
            <th>Specialites</th>
            {{--<th>Unité d'enseignement</th>--}}
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($ecues as $ecue)
        <tr>
            <td>{!! $ecue->title !!}</td>
            <td>{!! $ecue->semestre->title !!}</td>
            <td>{!! $ecue->slug !!}</td>
            <td>{!! $ecue->credits !!}  </td>
            <td>
                <div class="label-group">
                    @foreach($ecue->specialites as $specialite)
                        <label>{!! '   '.$specialite->slug . $ecue->semestre->cycle->niveau!!}   </label>
                    @endforeach
                </div>
            </td>

            <td>
                {!! Form::open(['route' => ['ecues.destroy', $ecue->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('ecues.show', [$ecue->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('ecues.edit', [$ecue->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>