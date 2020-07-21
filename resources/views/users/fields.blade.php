<div class="form-group @if ($errors->has('name')) has-error @endif">
    {!! Form::label('name', 'Name') !!}
    {!! Form::text('name', null, array('class' => 'form-control')) !!}
</div>
<div class="form-group @if ($errors->has('email')) has-error @endif">
    {!! Form::label('email', 'Email') !!}
    {!! Form::email('email', null, array('class' => 'form-control')) !!}
</div>

<hr>
<h4><b><u>Assign Role</u></b></h4>
<div class="form-group @if ($errors->has('roles')) has-error @endif">
    @foreach ($roles as $role)
        {!! Form::checkbox('roles[]',  $role->id, null, ['class' => 'checkbox checkbox-inline'] ) !!}
        {!! Form::label($role->name, ucfirst($role->name)) !!}<br>
    @endforeach
</div>
<hr>

<div class="form-group @if ($errors->has('password')) has-error @endif">
    {!! Form::label('password', 'Password') !!}<br>
    {!! Form::password('password', array('class' => 'form-control')) !!}
</div>
<div class="form-group @if ($errors->has('password')) has-error @endif">
    {!! Form::label('password', 'Confirm Password') !!}<br>
    {!! Form::password('password_confirmation', array('class' => 'form-control')) !!}
</div>