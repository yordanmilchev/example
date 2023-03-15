<?php

namespace App\Http\Livewire\Admin\Activity;

use App\Models\Activity\Activity;
use Livewire\Component;
use Livewire\WithPagination;

class ActivityList extends Component
{
    use WithPagination;
    public $title, $confirming;
    public Activity $activity;

    protected $listeners = ['filtersCleared'];

    public function filtersCleared()
    {
        $this->resetExcept();
    }

    public function confirmDelete($activity)
    {
        $this->confirming = $activity;
    }

    public function cancelDelete()
    {
        $this->confirming = null;
    }

    public function deleteActivity(Activity $activity)
    {
        $this->editing = $activity;
        $activityName = $this->editing->title;

        try {
            $this->editing->delete();
            session()->flash('error', 'Услуга '.$activityName.' беше изтрита !');
        } catch (\Exception $exception) {
            session()->flash('error', 'Записът не може да бъде изтрит поради наличието свързани обекти към него ! Обърнете се към разработчиците на системата, ако наистина искате да изпълните тази операция.');
        }
    }

    public function updateStatus(Activity $activity)
    {
        $this->editing = $activity;
        if ($this->editing->is_enabled){
            $this->editing->is_enabled = false;
        } else {
            $this->editing->is_enabled = true;
        }
        $this->editing->save();
    }

    public function render()
    {
        return view('livewire.admin.activity.activity-list', [
            'activities' => Activity::whereTranslationLike('title', '%'.$this->title.'%' )
                ->orderBy('weight')
                ->paginate(10),
        ]);
    }
}
