<?php

namespace App\Http\Livewire\Supplier\Pages;

use App\Models\Supplier;
use Livewire\Component;

class EditSupplierPage extends Component
{
    public string $name;
    public string|null $address = null;
    public string|null $cp_phone = null;
    public string|null $cp_name = null;

    public $supplier;
    public $supplierId;

    protected $rules = [
        'name' => 'required|max:60',
        'address' => 'max:200',
        'cp_phone' => 'sometimes|nullable|max:15|min:9',
        'cp_name' => 'max:60'
    ];

    public function mount($id) {
        $this->supplierId = $id;
        $this->loadSupplier();
    }

    public function loadSupplier() {
        $this->supplier = Supplier::where('id', $this->supplierId)->first();
        if ($this->supplier) {
            $this->name = $this->supplier->name;
            $this->address = $this->supplier->address;
            $this->cp_name = $this->supplier->cp_name;
            $this->cp_phone = $this->supplier->cp_phone;

            return;
        }
        return redirect()->to(route('shipper.index'));
    }

    public function submit() {
        $this->validate();

        $this->supplier->update([
            'name' => $this->name,
            'address' => $this->address,
            'cp_phone' => $this->cp_phone,
            'cp_name' => $this->cp_name,
        ]);

        return redirect()->to(route('supplier.index'));
    }

    public function render()
    {
        return view('livewire.supplier.pages.edit-supplier-page');
    }
}
