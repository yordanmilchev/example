<?php

namespace App\Http\Livewire\Admin\Inquiries;

use App\Models\ContactInquiry;
use Livewire\Component;
use Livewire\WithPagination;

class Messages extends Component
{
    use WithPagination;
    public $email, $name, $phone, $confirming;
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    public ContactInquiry $context;

    protected $listeners = ['filtersCleared'];

    public function filtersCleared()
    {
        $this->resetExcept('context');
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

    public function confirmDelete($contactInquiry)
    {
        $this->confirming = $contactInquiry;
    }

    public function cancelDelete()
    {
        $this->confirming = null;
    }

    public function deleteInquiry(ContactInquiry $contactInquiry)
    {
        $this->context = $contactInquiry;
        $messageName = $this->context->name;

        try {
            $this->context->delete();
            session()->flash('error', 'Запитването на '.$messageName.' беше изтрито !');
        } catch (\Exception $exception) {
            session()->flash('error', 'Записът не може да бъде изтрит поради наличието свързани обекти към него ! Обърнете се към разработчиците на системата, ако наистина искате да изпълните тази операция.');
        }
    }

    public function messageSeen(ContactInquiry $contactInquiry)
    {
        $this->context = $contactInquiry;
        $this->context->seen = true;
        $this->context->save();
    }

    public function getInquiry(ContactInquiry $contactInquiry)
    {
        $this->context = $contactInquiry;
        if (!$this->context->seen){
            $this->context->seen = true;
            $this->context->save();
        }
        $this->context->created_at_humanized = $this->context->created_at->format('d.m.Y').'г. '.$this->context->created_at->format('H:i');
    }

    public function render()
    {
        return view('livewire.admin.inquiries.messages', [
            'inquiries' => ContactInquiry::where('email', 'like', '%'.$this->email.'%')
                ->where('name', 'like', '%'.$this->name.'%')
                ->where('phone', 'like', '%'.$this->phone.'%')
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate(25),
        ]);
    }
}
