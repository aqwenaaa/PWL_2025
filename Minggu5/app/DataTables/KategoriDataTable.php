<?php

namespace App\DataTables;

use App\Models\KategoriModel;
use Illuminate\Database\Eloquent\Builder as QueryBuilder; 
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder; 
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor; 
use Yajra\DataTables\Html\Editor\Fields; 
use Yajra\DataTables\Services\DataTable;


class KategoriDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function ($row) {
                $editUrl = route('kategori.edit', ['id' => $row->kategori_id]); 
                $deleteUrl = route('kategori.destroy', ['id' => $row->kategori_id]); 
    
                return '
                    <a href="'.$editUrl.'" class="btn btn-warning btn-sm">Edit</a>
                    <form action="'.$deleteUrl.'" method="POST" style="display:inline;">
                        '.csrf_field().'
                        '.method_field("DELETE").'
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Yakin ingin menghapus kategori ini?\')">Delete</button>
                    </form>
                ';
            })
            ->rawColumns(['action']);
    }
    

    

    /**
     * Get the query source of dataTable.
     */
    public function query(KategoriModel $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
{
    return $this->builder()
                ->setTableId('kategori-table')
                ->columns([
                    ['data' => 'kategori_id', 'name' => 'kategori_id', 'title' => 'Kategori ID'], 
                    ['data' => 'kategori_kode', 'name' => 'kategori_kode', 'title' => 'Kategori Kode'],
                    ['data' => 'kategori_nama', 'name' => 'kategori_nama', 'title' => 'Kategori Nama'],
                    ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Created At'],
                    ['data' => 'updated_at', 'name' => 'updated_at', 'title' => 'Updated At'],
                    ['data' => 'action', 'name' => 'action', 'title' => 'Action', 'orderable' => false, 'searchable' => false],
                ])
                ->minifiedAjax()
                ->dom('Bfrtip')
                ->orderBy(1)
                ->selectStyleSingle()
                ->buttons([
                    Button::make('excel'),
                    Button::make('csv'),
                    Button::make('pdf'),
                    Button::make('print'),
                    Button::make('reset'),
                    Button::make('reload')
                ]);
}


    /**
     * Get the dataTable columns definition.
     */
    protected function getColumns()
    {
    return [
        'id',
        'kategori_kode',
        'kategori_nama',
        'created_at',
        'updated_at',
        Column::computed('action')
            ->exportable(false)
            ->printable(false)
            ->orderable(false)
            ->searchable(false)
            ->addClass('text-center'),
    ];
    }


    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Kategori_' . date('YmdHis');
    }

}
