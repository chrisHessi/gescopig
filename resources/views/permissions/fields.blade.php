<div class="form-group">
    {{ Form::label('name', 'Name') }}
    {{ Form::text('name', null, array('class' => 'form-control')) }}
</div>
<br>
<hr>
@if(!$roles->isEmpty())
    <h3>Assign Permission to Roles</h3>
    @foreach ($roles as $role)
        {{ Form::checkbox('roles[]',  $role->id, isset($permission)? $permission->hasRole($role) : null ) }}
        {{ Form::label($role->name, ucfirst($role->name)) }}<br>
    @endforeach
@endif
<br>
<div class="form-group col-sm-12">
    {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}
    <a href="{!! route('permissions.index') !!}" class="btn btn-default">Cancel</a>
</div>
