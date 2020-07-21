<?php

namespace App\DataTables;

use App\Models\Apprenant;
use App\Repositories\ApprenantRepository;
use App\Transformers\ApprenantTransformer;
use App\User;
use Yajra\DataTables\Services\DataTable;

class ApprenantsDataTable extends DataTable
{
    protected $apprenant;

    public function __construct(ApprenantRepository $apprenant)
    {
        $this->apprenant = $apprenant;
    }

    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query)
            ->setTransformer(new ApprenantTransformer)
            ->toJson();
    }

    public function ajax()
    {
        return $this->dataTable($this->query($this->apprenant));
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Apprenant $apprenant)
    {
//        return $model->newQuery()->select('id', 'add-your-columns-here', 'created_at', 'updated_at');
        return $apprenant->with(['absences', 'specialite'])->get();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->addAction(['width' => '80px'])
                    ->parameters([
                        'dom' => 'Bfrtip',
                        'buttons' => ['export', 'print', 'reset', 'reload'],
                        'initComplete' => "function(){
                            this.api().columns().every(function(){
                                var column = this;
                                var input = document.createElement(\"input\");
                                $(input).appendTo($(column.footer()).empty()).on('change',function(){
                                    column.search($(this).val(), false, false, true).draw();
                                });
                            });
                        }",
                    ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            ['data'=>'id', 'title' => 'id'],
            ['data'=>'name', 'title' => 'Name'],
            ['data'=>'tel', 'title' => 'Tel'],
            ['data'=>'specialite_id', 'title'=>'Specialite', 'orderable'=>'false'],
            ['data' => 'absences', 'title'=>'absences']
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Apprenants_' . date('YmdHis');
    }
}
