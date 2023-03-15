<?php

namespace App\Http\Livewire\Admin\LayoutBlocks;

use App\Models\LayoutBlock;
use Livewire\Component;
use Livewire\WithPagination;

class BlocksIndex extends Component
{
    use WithPagination;
    public $region_name, $location, $confirming;
    public LayoutBlock $editing;

    public $rules = [
        'editing.weight' => ['integer', 'required'],
    ];

    protected $listeners = ['filtersCleared'];

    public function filtersCleared()
    {
        $this->resetExcept('editing');
    }

    public function confirmDelete($layoutBlock)
    {
        $this->confirming = $layoutBlock;
    }

    public function cancelDelete()
    {
        $this->confirming = null;
    }

    public function deleteLayoutBlock(LayoutBlock $layoutBlock)
    {
        $this->editing = $layoutBlock;
        $layoutBlockName = $this->editing->name;

        try {
            $this->editing->delete();
            session()->flash('error', 'Layout block '.$layoutBlockName.' беше изтрит !');
        } catch (\Exception $exception) {
            session()->flash('error', 'Записът не може да бъде изтрит поради наличието свързани обекти към него ! Обърнете се към разработчиците на системата, ако наистина искате да изпълните тази операция.');
        }
    }

    public function updateStatus(LayoutBlock $layoutBlock)
    {
        $this->editing = $layoutBlock;
        if ($this->editing->is_enabled){
            $this->editing->is_enabled = false;
        } else {
            $this->editing->is_enabled = true;
        }
        $this->editing->save();
    }

    public function editWeight(LayoutBlock $layoutBlock)
    {
        $this->editing = $layoutBlock;
    }

    public function saveWeight()
    {
        $this->validate();
        $this->editing->save();

        $this->dispatchBrowserEvent('closeModal');

        session()->flash('success', 'Актуализацията беше извършена успешно!');
    }

    public function render()
    {
        $blocksQr = LayoutBlock::orderBy('locale')
            ->orderBy('region_name');

        if(!empty($this->region_name)) {
            $blocksQr->where('region_name', $this->region_name);
        }
        if(!empty($this->location)) {
            $blocksQr->where('locale', $this->location);
        }

        $blocks = $blocksQr->orderBy('weight')->paginate(20);

        return view('livewire.admin.layout-blocks.blocks-index', [
            'blocks' => $blocks,
        ]);
    }
}
