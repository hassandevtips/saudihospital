<?php

namespace App\Livewire;

use App\Models\Department;
use App\Models\Doctor;
use App\Models\Location;
use Livewire\Component;
use Livewire\WithPagination;

class FindADoctor extends Component
{
    use WithPagination;

    public $page;
    public $search = '';
    public $selectedDepartment = '';
    public $selectedLocation = '';
    public $selectedLetter = '';
    public $perPage = 9;

    protected $queryString = [
        'search' => ['except' => ''],
        'selectedDepartment' => ['except' => ''],
        'selectedLocation' => ['except' => ''],
        'selectedLetter' => ['except' => ''],
    ];

    public function mount(): void
    {
        $this->page = (object) [
            'title' => 'Find a Doctor',
            'banner_image_url' => asset('assets/images/banner/banner-1.jpg'),
        ];
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingSelectedDepartment()
    {
        $this->resetPage();
    }

    public function updatingSelectedLocation()
    {
        $this->resetPage();
    }

    public function updatingSelectedLetter()
    {
        $this->resetPage();
    }

    public function selectDepartment($departmentId)
    {
        $this->selectedDepartment = $this->selectedDepartment == $departmentId ? '' : $departmentId;
        $this->resetPage();
    }

    public function selectLocation($locationId)
    {
        $this->selectedLocation = $this->selectedLocation == $locationId ? '' : $locationId;
        $this->resetPage();
    }

    public function selectLetter($letter)
    {
        $this->selectedLetter = $this->selectedLetter == $letter ? '' : $letter;
        $this->resetPage();
    }

    public function clearFilters()
    {
        $this->search = '';
        $this->selectedDepartment = '';
        $this->selectedLocation = '';
        $this->selectedLetter = '';
        $this->resetPage();
    }

    public function getDoctorsProperty()
    {
        $query = Doctor::query()
            ->with(['department', 'location'])
            ->where('is_active', true);

        // Search filter (case-insensitive)
        if (!empty($this->search)) {
            $searchTerm = $this->search;
            // Remove common prefixes for better matching
            $cleanSearchTerm = preg_replace('/^(Dr\.?|Doctor)\s*/i', '', $searchTerm);

            $query->where(function ($q) use ($searchTerm, $cleanSearchTerm) {
                $q->whereRaw("LOWER(REPLACE(REPLACE(JSON_EXTRACT(name, '$.en'), 'Dr.', ''), 'Dr ', '')) LIKE LOWER(?)", ["%{$cleanSearchTerm}%"])
                    ->orWhereRaw("LOWER(REPLACE(REPLACE(JSON_EXTRACT(name, '$.ar'), 'Dr.', ''), 'Dr ', '')) LIKE LOWER(?)", ["%{$cleanSearchTerm}%"])
                    ->orWhereRaw("LOWER(JSON_EXTRACT(name, '$.en')) LIKE LOWER(?)", ["%{$searchTerm}%"])
                    ->orWhereRaw("LOWER(JSON_EXTRACT(name, '$.ar')) LIKE LOWER(?)", ["%{$searchTerm}%"])
                    ->orWhereRaw("LOWER(JSON_EXTRACT(specialization, '$.en')) LIKE LOWER(?)", ["%{$searchTerm}%"])
                    ->orWhereRaw("LOWER(JSON_EXTRACT(specialization, '$.ar')) LIKE LOWER(?)", ["%{$searchTerm}%"]);
            });
        }

        // Department filter
        if (!empty($this->selectedDepartment)) {
            $query->where('department_id', $this->selectedDepartment);
        }

        // Location filter
        if (!empty($this->selectedLocation)) {
            $query->where('location_id', $this->selectedLocation);
        }

        // Letter filter - handle "Dr." prefix (case-insensitive)
        if (!empty($this->selectedLetter)) {
            $letter = $this->selectedLetter;
            $lowerLetter = strtolower($letter);
            $query->where(function ($q) use ($letter, $lowerLetter) {
                // Remove quotes from JSON and match names starting with the letter or "Dr. Letter"
                $q->whereRaw("LOWER(REPLACE(JSON_EXTRACT(name, '$.en'), '\"', '')) LIKE ?", ["{$lowerLetter}%"])
                    ->orWhereRaw("LOWER(REPLACE(JSON_EXTRACT(name, '$.ar'), '\"', '')) LIKE ?", ["{$lowerLetter}%"])
                    ->orWhereRaw("LOWER(REPLACE(JSON_EXTRACT(name, '$.en'), '\"', '')) LIKE ?", ["dr. {$lowerLetter}%"])
                    ->orWhereRaw("LOWER(REPLACE(JSON_EXTRACT(name, '$.en'), '\"', '')) LIKE ?", ["dr {$lowerLetter}%"])
                    ->orWhereRaw("LOWER(REPLACE(JSON_EXTRACT(name, '$.ar'), '\"', '')) LIKE ?", ["د. {$lowerLetter}%"]);
            });
        }

        return $query->orderBy('order')->paginate($this->perPage);
    }

    public function getDepartmentsProperty()
    {
        return Department::query()
            ->where('is_active', true)
            ->withCount(['doctors' => function ($query) {
                $query->where('is_active', true);
            }])
            ->orderBy('order')
            ->get();
    }

    public function getLocationsProperty()
    {
        return Location::query()
            ->where('is_active', true)
            ->orderBy('order')
            ->get();
    }

    public function getAlphabetProperty()
    {
        return range('A', 'Z');
    }

    public function render()
    {
        return view('livewire.pages.find-a-doctor', [
            'doctors' => $this->doctors,
            'departments' => $this->departments,
            'locations' => $this->locations,
            'alphabet' => $this->alphabet,
        ]);
    }
}
