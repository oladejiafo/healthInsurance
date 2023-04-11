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

class ClaimsSumDataTable extends DataTable
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
                $params = http_build_query([
                    'hcp_name' => $row->hcp_name,
                    'year' => $row->year,
                    'month' => $row->month,
                ]);
                return '<a href="/claims?'.$params.'" class="btn btn-sm btn-success" style="font-size:16px"><i class="fa fa-angle-down" style="font-size:19px"></i> Open</a>';
            });
            // ->addColumn('action', function ($row) {    
            //     return '<a href="/claims" class="btn btn-sm btn-primary">Open</a>';
            // });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Claims $model
     * @return \Illuminate\Database\Eloquent\Builder
     */


    public function query()
    {
        return Claims::query()
        ->selectRaw('hcp_name, month, year, COUNT(id) as claimcount, SUM(claim_amount) as sumamount')
        ->groupBy('hcp_name','month', 'year')
        ->orderBy('year', 'desc')
        ->orderBy('month', 'desc');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    { 
        return $this->builder()
            ->setTableId('claimsSum-table')
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->selectStyleSingle()
            ->columns($this->getColumns())
            ->ajax('')
            ->addAction(['width' => '80px'])
            ->parameters($this->getBuilderParameters());
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('period'),
            Column::make('hcp_name')->title('Provider Name'),
            Column::make('sumamount')->title('Total Claims Amount'),
            Column::make('claimcount')->title('No. of Claims'),

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
