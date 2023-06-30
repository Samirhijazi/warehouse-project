<?php

namespace App\Http\Livewire\Goods\Pages;

use App\Models\Goods;
use App\Models\GoodsCategory;
use App\Models\Unit;
use Livewire\Component;

class AddGoodsPage extends Component
{
    public $name;
    public $code;
    public $categoryIds;
    public $stockLimit;
    public $unitId;
    public $description;
    public $price;

    public $categoryOptions;
    public $unitOptions;

    protected $rules = [
        'name' => 'required|max:80',
        'code' => 'required|max:25',
        'description' => 'max:200',
        'stockLimit' => 'numeric|min:0',
        'unitId' => 'required',
        'price' => 'numeric|min:0'
    ];

    public function mount() {
        $this->loadUnitOptions();
        $this->loadCategoryOptions();
    }

    public function loadUnitOptions() {
        $this->unitOptions = Unit::all(['id', 'name', 'symbol']);
    }

    public function loadCategoryOptions() {
        
    }

    public function submit() {
        $this->validate();

        $goods = Goods::create([
            'name' => $this->name,
            'code' => $this->code,
            'minimum_stock' => $this->stockLimit,
            'price' => $this->price,
            'unit_id' => $this->unitId,
            'description' => $this->description,
        ]);
        if ($goods) {
            $goods->categories()->attach($this->categoryIds);
        }
        return redirect()->to(route('goods.index'));
    }

    public function render()
    {
        $this->categoryOptions = [
            ['value' => '1', 'label' => 'drog'],
            ['value' => '2', 'label' => 'Option 2'],
            ['value' => '3', 'label' => 'Option 3'],
            ['value' => '4', 'label' => 'Option 4'],
        ];
        return view('livewire.goods.pages.add-goods-page',['categoryOptions'=>$this->categoryOptions]);
    }
}
