<?php

namespace App\Http\Livewire\Shipper\Components;

use App\Models\Goods;
use App\Models\GoodsCategory;
use App\Models\Shipper;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter;

class ShipperTable extends DataTableComponent
{
    protected $model = Shipper::class;
    protected $listeners = [
        'deleteConfirmed'
    ];

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setColumnSelectStatus(false);
        if (Auth::user()->hasPermissionTo('shipper.create')) {
            $this->setConfigurableAreas([
                'toolbar-left-start' => [
                    'livewire.livewire-datatable.add-action-button',
                    [
                        'route' => route('shipper.add')
                    ],
                ],
            ]);
        }
    }

    public function columns(): array
    {
        return [
            Column::make(__('Name'), 'name')
                ->searchable()
                ->sortable(),
            Column::make(__('Contact Phone'), 'cp_phone')
                ->sortable(),
            Column::make(__('Created at'), 'created_at')
                ->format(fn($value) => format_date($value))
                ->sortable(),
            Column::make(__('Actions'), 'id')
                ->view('livewire.shipper.components.shipper-action-menu'),
        ];
    }

    public function actionDelete($id) {
        $this->emitTo('components.delete-confirm-modal', 'deleteConfirmation', 'shipper.components.shipper-table', $id);
    }

    public function deleteConfirmed($id) {
        if ($id) {
            Shipper::where('id', $id)->delete();
        }
    }
}
