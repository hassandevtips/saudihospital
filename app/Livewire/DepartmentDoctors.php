<?php

namespace App\Livewire;

use App\Models\Department;
use App\Models\Page;
use Livewire\Component;

class DepartmentDoctors extends Component
{
    public $page;
    public $departments;

    public function mount()
    {
        $this->page = Page::firstOrCreate(
            ['template' => 'department-template'],
            [
                'title' => 'Department Doctors',
                'template' => 'department-template',
                'is_active' => true,
                'order' => 1
            ]
        );

        $this->departments = Department::active()->orderBy('order')->get();
    }



    public function render()
    {
        return view('livewire.pages.department-template', [
            'page' => $this->page,
        ]);
    }
}
