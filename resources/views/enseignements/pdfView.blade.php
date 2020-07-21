<table class="table table-striped table-bordered">
    <thead>
    <th>Niveau</th>
    <th>Date Debut</th>
    <th>Date de Fin</th>
    <th>Nombre de Semaine Total</th>
    <th>Nombre de semaines Ecoulées</th>
    <th>Nombre de Semaine Restante</th>
    <th>Nombre d'heures par Semaine</th>
    <th>Classe</th>
    <th>MH Prevue</th>
    <th>MH Programmée</th>
    <th>MH Realisee</th>
    <th>MH programmée Restante</th>
    <th>MH théorique Restante</th>
    <th>Ecart</th>
    <th>Progression (en %)</th>
    </thead>

    <tbody>
        @foreach($semestres as $semestre)
            <tr>
                <td rowspan="{{ $semestre->cycle->specialites->count() +1 }}">{{ $semestre->cycle->label. ' ' .$semestre->cycle->niveau }}</td>
                <td rowspan="{{ $semestre->cycle->specialites->count() +1 }}">{{ $semestre->academic_calendars->where('academic_year_id', $anneeAcademic)->first()->dateDebutPrevue->format('d/m/Y') }}</td>
                <td rowspan="{{ $semestre->cycle->specialites->count() +1 }}">{{ $semestre->academic_calendars->where('academic_year_id', $anneeAcademic)->first()->dateFinPrevue->format('d/m/Y') }}</td>
                <td rowspan="{{ $semestre->cycle->specialites->count() +1 }}">
                    {{ number_format($semestre->academic_calendars->where('academic_year_id', $anneeAcademic)->first()->
                        dateFinPrevue->diffInWeeks($semestre->academic_calendars->where('academic_year_id', $anneeAcademic)->first()->dateDebutPrevue))
                    }}
                </td>
                <td rowspan="{{ $semestre->cycle->specialites->count() +1 }}">{{ number_format(\Carbon\Carbon::now()->diffInWeeks($semestre->academic_calendars->where('academic_year_id', $anneeAcademic)->first()->dateDebutPrevue)) }}</td>
                <td rowspan="{{ $semestre->cycle->specialites->count() +1 }}">{{ number_format($semestre->academic_calendars->where('academic_year_id', $anneeAcademic)->first()->dateFinPrevue->diffInDays(\Carbon\Carbon::now())/7) }}</td>
                <td rowspan="{{ $semestre->cycle->specialites->count() +1 }}">{{ $semestre->mhSemaine }}</td>
            </tr>

            @foreach($semestre->cycle->specialites as $specialite)

                <tr>
                    <td>{{ $specialite->slug. ' ' .$semestre->cycle->niveau }}</td>
                    <td>300</td>
                    <td>{{ $semestre->enseignements->where('specialite_id', $specialite->id)->where('academic_year_id', $anneeAcademic)->sum('mhTotal') }}</td>
                    <td>{{ $semestre->enseignements->where('specialite_id', $specialite->id)->where('academic_year_id', $anneeAcademic)->sum('mhEff') }}</td>
                    <td>{{ $semestre->enseignements->where('specialite_id', $specialite->id)->where('academic_year_id', $anneeAcademic)->sum('mhTotal') - $semestre->enseignements->where('specialite_id', $specialite->id)->where('academic_year_id', $anneeAcademic)->sum('mhEff')}}</td>
                    <td>{{ (number_format(\Carbon\Carbon::now()->diffInWeeks($semestre->academic_calendars->where('academic_year_id', $anneeAcademic)->first()->dateFinPrevue, false)) > 0) ? number_format(\Carbon\Carbon::now()->diffInDays($semestre->academic_calendars->where('academic_year_id', $anneeAcademic)->first()->dateFinPrevue)/7, 1)*20 : 0 }}</td>
                    <td>{{ number_format(\Carbon\Carbon::now()->diffInDays($semestre->academic_calendars->where('academic_year_id', $anneeAcademic)->first()->dateFinPrevue)/7, 1)*20 - (300 - $semestre->enseignements->where('specialite_id', $specialite->id)->where('academic_year_id', $anneeAcademic)->sum('mhEff')) }}</td>
                    <td>{{ ($semestre->enseignements->where('specialite_id', $specialite->id)->where('academic_year_id', $anneeAcademic)->sum('mhTotal') != 0) ? number_format(($semestre->enseignements->where('specialite_id', $specialite->id)->where('academic_year_id', $anneeAcademic)->sum('mhEff')*100)/300,2) : 0 }}</td>
                </tr>

            @endforeach
        @endforeach
    </tbody>
</table>