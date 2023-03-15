<?php

namespace App\Http\Livewire\Admin\Homepage;

use App\Models\Homepage\Slider;
use Livewire\Component;
use Livewire\WithPagination;

class SlidersList extends Component
{
    use WithPagination;
    public $link, $confirming;
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    public Slider $editing;

    public $rules = [
        'editing.weight' => ['integer', 'required'],
    ];

    protected $listeners = ['filtersCleared'];

    public function filtersCleared()
    {
        $this->resetExcept('editing');
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field){
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }

    public function confirmDelete($slider)
    {
        $this->confirming = $slider;
    }

    public function cancelDelete()
    {
        $this->confirming = null;
    }

    public function deleteSlider(Slider $slider)
    {
        $this->editing = $slider;
        $sliderName = $this->editing->title;

        try {
            $this->editing->delete();
            session()->flash('error', 'Слайдър "'.$sliderName.'" беше изтрит успешно !');
        } catch (\Exception $exception) {
            session()->flash('error', 'Записът не може да бъде изтрит поради наличието свързани обекти към него ! Обърнете се към разработчиците на системата, ако наистина искате да изпълните тази операция.');
        }
    }

    public function updateStatus(Slider $slider)
    {
        $this->editing = $slider;
        if ($this->editing->is_enabled){
            $this->editing->is_enabled = false;
        } else {
            $this->editing->is_enabled = true;
        }
        $this->editing->save();
    }

    public function editWeight(Slider $slider)
    {
        $this->editing = $slider;
    }

    public function saveWeight()
    {
        $this->validate();
        $this->editing->save();
        session()->flash('success', 'Актуализацията беше извършена успешно!');
    }

    public function render()
    {
        $slidersQb =  Slider::query();

        if (!empty($this->link)){
            $slidersQb->whereTranslationLike('link', '%'.$this->link.'%' );
        }

        $sliders = $slidersQb->orderBy($this->sortField, $this->sortDirection)
            ->paginate(8);

        return view('livewire.admin.homepage.sliders-list', [
            'sliders' => $sliders,
        ]);
    }
}
