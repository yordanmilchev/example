<?php

namespace App\Http\Livewire\Admin\Service;

use App\Models\Service\Service;
use Livewire\Component;
use Livewire\WithPagination;

class ServiceList extends Component
{
    use WithPagination;
    public $title, $confirming;
    public Service $service;

    protected $listeners = ['filtersCleared'];

    public function filtersCleared()
    {
        $this->resetExcept();
    }

    public function confirmDelete($service)
    {
        $this->confirming = $service;
    }

    public function cancelDelete()
    {
        $this->confirming = null;
    }

    public function deleteService(Service $service)
    {
        $this->editing = $service;
        $serviceName = $this->editing->title;

        try {
            $this->editing->delete();
            session()->flash('error', 'Услуга '.$serviceName.' беше изтрита !');
        } catch (\Exception $exception) {
            session()->flash('error', 'Записът не може да бъде изтрит поради наличието свързани обекти към него ! Обърнете се към разработчиците на системата, ако наистина искате да изпълните тази операция.');
        }
    }

    public function updateStatus(Service $service)
    {
        $this->editing = $service;
        if ($this->editing->is_enabled){
            $this->editing->is_enabled = false;
        } else {
            $this->editing->is_enabled = true;
        }
        $this->editing->save();
    }

    public function render()
    {
        return view('livewire.admin.service.service-list', [
            'services' => Service::whereTranslationLike('title', '%'.$this->title.'%' )
                ->orderBy('weight')
                ->paginate(10),
        ]);
    }
}
