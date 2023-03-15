<?php

namespace App\Http\Livewire\Admin\Acl;

use App\Models\ACL\Role;
use Livewire\Component;

class Roles extends Component
{
    public $permissions = [];
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    public Role $editing;
    public Role $creating;

    public $rules = [
        'creating.name' => 'required|string',
        'creating.label' => 'required|string',
    ];

    public function sortBy($field)
    {
        if ($this->sortField === $field){
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }

    public function editPermissions(Role $role)
    {
        $rolePermissions = $role->permissions()->pluck('id')->toArray();

        $this->permissions = $rolePermissions;
        $this->editing = $role;
    }

    public function savePermissions()
    {
        $this->validate([
            'permissions' => 'exists:permissions,id'
        ]);

        $this->editing->permissions()->sync($this->permissions);

        $this->dispatchBrowserEvent('closeModal');

        session()->flash('success', 'Актуализацията беше извършена успешно!');
        return redirect(request()->header('Referer'));
    }

    public function createRole()
    {
        $this->creating = new Role;
    }

    public function saveRole()
    {
        $this->validate();
        $this->creating->save();

        $this->dispatchBrowserEvent('closeModal');

        session()->flash('success', 'Записът беше осъществен успешно !');
    }

    public function render()
    {
        return view('livewire.admin.acl.roles', [
            'roles' => Role::orderBy($this->sortField, $this->sortDirection)->get(),
        ]);
    }
}
