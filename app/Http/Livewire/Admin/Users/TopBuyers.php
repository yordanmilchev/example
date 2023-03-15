<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use App\Repositories\OrderRepository;
use Livewire\Component;
use Livewire\WithPagination;

class TopBuyers extends Component
{
    use WithPagination;
    public $email;
    public $sortField = 'SUM(orders.total)';
    public $sortDirection = 'desc';

    protected $listeners = ['filtersCleared'];

    public function filtersCleared()
    {
        $this->resetExcept();
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

    public function render()
    {
        $ordersByUser = OrderRepository::getAggregatedForTopBuyers($this->sortField, $this->sortDirection, $this->email)
            ->paginate(20);

        $users = User::all()
            ->keyBy('email');

        return view('livewire.admin.users.top-buyers', [
            'ordersByUser' => $ordersByUser,
            'users' => $users,
        ]);
    }
}
