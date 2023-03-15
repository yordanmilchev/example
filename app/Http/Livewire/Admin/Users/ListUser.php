<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\ACL\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ListUser extends Component
{
    use WithPagination;
    public $name, $lastname, $email, $user_id, $role_id;
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    public $allRoles = [];
    public $roles = [];
    public User $editing;


    public $rules = [
        'editing.name' => 'required',
        'editing.lastname' => 'nullable',
        'editing.email' => 'required',
        'editing.phone_number' => 'nullable',
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

    public function edit(User $user)
    {
        $this->editing = $user;
    }

    public function save()
    {
        $this->validate();
        $this->editing->save();

        $this->dispatchBrowserEvent('closeModal');

        session()->flash('success', 'Записът беше осъществен успешно !');
    }

    public function editRole(User $user)
    {
        $userRoles = $user->roles()->pluck('id')->toArray();

        $manageAclUser = Auth::user();
        if ($manageAclUser->hasRole('technical_administrator')) {
            $roles = Role::all();
        } else {
            $roles = Role::where('name', '!=', 'technical_administrator')->get();
        }

        $this->roles = $userRoles;
        $this->editing = $user;
        $this->allRoles = $roles;
    }

    public function saveRole()
    {
        $this->validate([
            'roles' => 'exists:roles,id'
        ]);

        $this->editing->roles()->sync($this->roles);

        $this->dispatchBrowserEvent('closeModal');

        session()->flash('success', 'Актуализацията беше извършена успешно!');
    }


    public function render()
    {
        $usersQb = User::select('*')
            ->where('name', 'like', '%'.$this->name.'%')
            ->where('lastname', 'like', '%'.$this->lastname.'%')
            ->where('email', 'like', '%'.$this->email.'%')
            ->where('id', 'like', '%'.$this->user_id.'%');

        if (!empty($this->role_id)){
            $usersQb->leftJoin('role_user', 'users.id', '=', 'role_user.user_id')
                ->where('role_user.role_id', $this->role_id);
        }

        $users = $usersQb->orderBy('users.'.$this->sortField, $this->sortDirection)
            ->paginate(20);

        return view('livewire.admin.users.list-user', [
            'users' => $users,
            'rolesList' => Role::all(),
        ]);
    }
}
