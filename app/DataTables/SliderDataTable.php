<?php

namespace App\DataTables;

use App\Models\Slider;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class SliderDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function($query) {
                $deleteButton = $this->createButton(
                    'destroy',
                    $query->id,
                    'trash',
                    'btn-danger delete-item'
                );

                return <<<HTML
                    {$this->createButton('edit', $query->id, 'edit', 'btn-primary')}
                    $deleteButton
                    HTML;
            })
            ->addColumn('image', function($query) {
                return <<<HTML
                    <img width="100" height="100" src="$query->image" alt="image">
                    HTML;
            })
            ->addColumn('status', function($query) {
                return $query->status === 1
                    ? <<<HTML
                        <span class="badge badge-primary">Active</span>
                        HTML
                    : <<<HTML
                        <span class="badge badge-danger">Inactive</span>
                        HTML;
            })
            ->rawColumns([ 'image', 'action', 'status'])
            ->setRowId('id');
    }

    protected static function createButton(
        string $route,
        int $id,
        string $iconType,
        string $classes = ''
    ): string {
        $link = route("admin.slider.$route", $id);

        return <<<HTML
            <a href="$link" class="ml-2 btn $classes">
                <i class="fas fa-$iconType"></i>
            </a>
            HTML;
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Slider $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('slider-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(0)
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
    public function getColumns(): array
    {
        return [
            Column::make('id')->width(60),
            Column::make('image')->width(150)->class('image-holder'),
            Column::make('title'),
            Column::make('status'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(150)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Slider_' . date('YmdHis');
    }
}
