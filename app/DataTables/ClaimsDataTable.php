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
    public function dataTable($query)
    {
    
        return datatables()
            ->eloquent($query)
            ->addColumn('period', function($customer){
                return $customer->month.' '.$customer->year;
            })
            ->addColumn('action', function ($row) {    
                return '
                <a href="/claims/' . $row->id . '/edit" class="btn btn-sm btn-primary">Edit</a> 
                <a href="/claims/' . $row->id . '/del" class="btn btn-sm btn-danger">D<i class="i class="fa fa-trash"  aria-hidden="true" style="font-size:48px;"></i></a>';
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Claims $model
     * @return \Illuminate\Database\Eloquent\Builder
     */


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
            ->dom('Bfrtip')
            ->orderBy(1)
            ->selectStyleSingle()
            ->columns($this->getColumns())
            ->ajax('')
            ->addAction(['width' => '80px'])
            ->parameters($this->getBuilderParameters())
            ->buttons([
                Button::make('add'),
                // Button::make('excel'),
                // Button::make('csv'),
                // Button::make('pdf'),
                // Button::make('print'),
                // Button::make('reset'),
                // Button::make('reload')
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
                
            // Column::make('id'),
            // Column::make('hcp_name'),
            // Column::make('enrollee_name'),
            // Column::make('created_at'),
            // Column::make('updated_at'),

            Column::make('claim_date')->title('Date of Claim'),
            Column::make('enrollee_code')->title('Enrollee Code'),
            Column::make('enrollee_name')->title('Enrollee Name'),
            // Column::make('hcp_code')->title('Provider Code'),
            Column::make('hcp_name')->title('Provider Name'),
            Column::make('authorization_code')->title('Authorization Code'),
            Column::make('diagnosis')->title('Diagnosis'),
            Column::make('claim_amount')->title('Claim Amount'),
            Column::make('period'),
            // Column::computed('action')
            //       ->exportable(false)
            //       ->printable(false)
            //       ->width(60)
            //       ->addClass('text-center')
            //       ->title('Action'),
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
