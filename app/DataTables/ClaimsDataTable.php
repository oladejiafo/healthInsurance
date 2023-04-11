<?php

namespace App\DataTables;

use App\Models\Claims;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ClaimsDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query): EloquentDataTable
    {
    
        // return datatables()
        //     ->eloquent($query)
        //     ->addColumn('action', 'claims.action');

        return (new EloquentDataTable($query))->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Claims $model
     * @return \Illuminate\Database\Eloquent\Builder
     */

    // public function ajax() {
    //     return datatables()
    //     ->eloquent($this->query())
    //     ->make(true);
    // }

    public function query()
    {
        return Claims::query()->select();

    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    { 

        
        return $this->builder()
            ->setTableId('claims-table')
            ->minifiedAjax()
            ->dom('Bfrtip',[
                'buttonsContainer' => '#myButtons'
            ])
            ->orderBy(1)
            ->selectStyleSingle()
            ->columns($this->getColumns())
            ->buttons([
                Button::make('add'), 
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            ]);

    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns(): array
    {
        return [
            // Column::computed('action')
            //       ->exportable(true)
            //       ->printable(true)
            //       ->width(60)
            //       ->addClass('text-center'),
            Column::make('id'),
            Column::make('hcp_name'),
            Column::make('enrollee_name'),
            Column::make('created_at'),
            Column::make('updated_at'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Claims_' . date('YmdHis');
    }
}
