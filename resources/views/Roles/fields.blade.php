<div class="form-group">
    {{ Form::label('name', 'Name') }}
    {{ Form::text('name', null, array('class' => 'form-control')) }}
</div>
<br>
<hr>
<h4><b>Assign Permissions</b></h4>
<div class='form-group'>
    @foreach ($permissions as $permission)
        {{ Form::checkbox('permissions[]',  $permission->id, isset($role) ? $role->hasPermissionTo($permission) : null, ['id' => 'permissions'] ) }}
        {{ Form::label('permissions', ucfirst($permission->name)) }}<br>
    @endforeach
</div>