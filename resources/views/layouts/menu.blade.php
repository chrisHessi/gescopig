<li class="{{ Request::is('enseignants*') ? 'active' : '' }}">
    <a href="{!! route('enseignants.index') !!}"><i class="fa fa-edit"></i><span>Enseignants</span></a>
</li>

<li class="{{ Request::is('enseignements*') ? 'active' : '' }}">
    <a href="{!! route('enseignements.index') !!}"><i class="fa fa-edit"></i><span>Enseignements</span></a>
</li>

