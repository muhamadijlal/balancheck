<?php

namespace App\Livewire;

use App\Models\ViewTarif;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;
use PowerComponents\LivewirePowerGrid\Components\SetUp\Exportable; 


final class TarifTable extends PowerGridComponent
{
    public string $tableName = 'tarif-table-3gmcvg-table';
    public bool $deferLoading = false;

    use WithExport;

    public function setUp(): array
    {
        // $this->showCheckBox();

        $fileName = 'Data-Tarif-'.date("d-m-Y");

        return [
            PowerGrid::header()
                ->showSearchInput(),
            PowerGrid::footer()
                ->showPerPage(10, [10, 50, 100, 500])
                ->showRecordCount('full'),
            
            PowerGrid::exportable(fileName: $fileName)->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV)

            // PowerGrid::responsive(),
        ];
    }

    public function datasource(): Builder
    {    
        $query = DB::table('view_tarif');

        return $query;
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('cluster')
            ->add('cabang')
            ->add('nama_gb')
            ->add('nama_asal_gb')
            ->add('gol1', function($row){
                return "Rp. ".number_format($row->gol1, 0, '.', '.').",-";
            })
            ->add('gol2', function($row){
                return "Rp. ".number_format($row->gol2, 0, '.', '.').",-";
            })
            ->add('gol3', function($row){
                return "Rp. ".number_format($row->gol3, 0, '.', '.').",-";
            })
            ->add('gol4', function($row){
                return "Rp. ".number_format($row->gol4, 0, '.', '.').",-";
            })
            ->add('gol5', function($row){
                return "Rp. ".number_format($row->gol5, 0, '.', '.').",-";
            });
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id')
                ->sortable()
                ->searchable(),

            Column::make('Cluster', 'cluster')
                ->sortable()
                ->searchable(),

            Column::make('Nama Cabang', 'cabang')
                ->sortable()
                ->searchable(),

            Column::make('Nama Gerbang', 'nama_gb')
                ->sortable()
                ->searchable(),

            Column::make('Nama Asal Gerbang', 'nama_asal_gb')
                ->sortable()
                ->searchable(),

            Column::make('Golongan 1', 'gol1')
                ->sortable()
                ->searchable(),

            Column::make('Golongan 2', 'gol2')
                ->sortable()
                ->searchable(),

            Column::make('Golongan 3', 'gol3')
                ->sortable()
                ->searchable(),

            Column::make('Golongan 4', 'gol4')
                ->sortable()
                ->searchable(),

            Column::make('Golongan 5', 'gol5')
                ->sortable()
                ->searchable(),

            // Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [
            // Filter By Cluster
            Filter::select('cluster')
                ->dataSource(ViewTarif::groupByCluster()->get())
                ->optionLabel('cluster')
                ->optionValue('cluster'),

            // Filter By Ruas (cabang)
            Filter::select('cabang')
                ->dataSource(ViewTarif::groupByRuas()->get())
                ->optionLabel('cabang')
                ->optionValue('cabang'),

            // Filter By (gerbang)
            Filter::select('nama_gb')
                ->dataSource(ViewTarif::groupByGerbang()->get())
                ->optionLabel('nama_gb')
                ->optionValue('nama_gb'),

            // Filter By (gerbang)
            Filter::select('nama_asal_gb')
                ->dataSource(ViewTarif::groupByAsalGerbang()->get())
                ->optionLabel('nama_asal_gb')
                ->optionValue('nama_asal_gb'),
        ];
    }

    public function boot(): void
    {
        config(['livewire-powergrid.filter' => 'outside']);
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert('.$rowId.')');
    }

    // public function actions($row): array
    // {
    //     return [
    //         Button::add('edit')
    //             ->slot('Edit')
    //             ->id()
    //             ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
    //             ->dispatch('edit', ['rowId' => $row->id])
    //     ];
    // }

    // public function actionRules($row): array
    // {
    //    return [
    //         // Hide button edit for ID 1
    //         Rule::button('edit')
    //             ->when(fn($row) => $row->id === 1)
    //             ->hide(),
    //     ];
    // }
}
