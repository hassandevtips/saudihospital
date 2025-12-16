<?php

namespace App\Livewire;

use App\Models\Department;
use App\Models\Page;
use Livewire\Component;

class DoctorsTemplate extends Component
{
    public $page;
    public $doctors;
    public $departments;
    public $currentDepartment;
    public function mount(Department $department)
    {
        $this->departments = Department::active()->get();
        $this->currentDepartment = $department;
        $this->page = (object) [
            'title' => $department->name,
            'banner_image_url' => $department->thumbnail_image_url,
        ];

        $this->doctors = $department->doctors()->active()->get();
    }



    public function render()
    {
        return view('livewire.pages.doctors-template', [
            'page' => $this->page,
            'doctors' => $this->doctors,
            'currentDepartment' => $this->currentDepartment,
            'departments' => $this->departments,
        ]);
    }
}
