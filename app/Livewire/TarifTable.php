<?php

namespace App\Livewire;

use App\Models\ViewTarif;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Components\SetUp\Responsive;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;


final class TarifTable extends PowerGridComponent
{
    public string $tableName = 'tarif-table-3gmcvg-table';
    public bool $deferLoading = false;


    public function setUp(): array
    {
        // $this->showCheckBox();

        return [
            PowerGrid::header()
                ->showSearchInput(),
            PowerGrid::footer()
                ->showPerPage(10, [10, 50, 100, 500])
                ->showRecordCount('full'),

            PowerGrid::responsive(),
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
            ->add('gb')
            ->add('nama_gb')
            ->add('nama_asal_gb')
            ->add('gol1')
            ->add('gol2')
            ->add('gol3')
            ->add('gol4')
            ->add('gol5')
            ->add('ags');
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

            Column::make('Gerbang Id', 'gb')
                ->sortable()
                ->searchable(),

            Column::make('Nama Gerbang', 'nama_gb')
                ->sortable()
                ->searchable(),

            Column::make('Nama Asal Gerbang', 'nama_asal_gb')
                ->sortable()
                ->searchable(),

            Column::make('Golonga 1', 'gol1')
                ->sortable()
                ->searchable(),

            Column::make('Golonga 2', 'gol2')
                ->sortable()
                ->searchable(),

            Column::make('Golonga 3', 'gol3')
                ->sortable()
                ->searchable(),

            Column::make('Golonga 4', 'gol4')
                ->sortable()
                ->searchable(),

            Column::make('Golonga 5', 'gol5')
                ->sortable()
                ->searchable(),

            Column::make('AGS', 'ags')
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
            Filter::select('gb')
                ->dataSource(ViewTarif::groupByGerbang()->get())
                ->optionLabel('gb')
                ->optionValue('gb'),

            // Filter nama gerbang
            Filter::inputText('nama_gb')
                ->placeholder('Filter by nama gerbang')
                ->operators(['contains', 'is', 'is_not']),

            // Filter nama asal gerbang
            Filter::inputText('nama_asal_gb')
                ->placeholder('Filter by nama asal gerbang')
                ->operators(['contains', 'is', 'is_not']),
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
