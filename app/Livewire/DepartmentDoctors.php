<?php

namespace App\Livewire;

use App\Models\Department;
use App\Models\Doctor;
use Livewire\Component;

class DepartmentDoctors extends Component
{
    public $selectedDepartment = null;
    public $departments;
    public $doctors;

    public function mount()
    {
        $this->departments = Department::active()->orderBy('order')->get();
        $this->doctors = collect();

        // Check if department parameter is passed in URL
        if (request()->has('department')) {
            $departmentId = request()->get('department');
            if (Department::where('id', $departmentId)->where('is_active', true)->exists()) {
                $this->selectedDepartment = $departmentId;
                $this->loadDoctors();
            }
        }
    }

    public function selectDepartment($departmentId)
    {
        $this->selectedDepartment = $departmentId;
        $this->loadDoctors();
    }

    public function loadDoctors()
    {
        if ($this->selectedDepartment) {
            $this->doctors = Doctor::with('department')
                ->where('department_id', $this->selectedDepartment)
                ->where('is_active', true)
                ->orderBy('order')
                ->get();
        } else {
            $this->doctors = collect();
        }
    }

    public function getSelectedDepartmentName()
    {
        if ($this->selectedDepartment) {
            $department = Department::find($this->selectedDepartment);
            return $department ? $department->name : null;
        }
        return null;
    }

    public function render()
    {
        return view('livewire.pages.department-doctors');
    }
}
