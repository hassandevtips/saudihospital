<?php

namespace App\Livewire;

use App\Models\Department;
use App\Models\Doctor;
use App\Models\Location;
use App\Models\Page;
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
        $this->page = Page::where('id', 53)->first();
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

            // Check if it's an Arabic letter
            $isArabic = preg_match('/[\x{0600}-\x{06FF}]/u', $letter);

            $query->where(function ($q) use ($letter, $lowerLetter, $isArabic) {
                if ($isArabic) {
                    // For Arabic letters, search in Arabic names
                    $q->whereRaw("REPLACE(JSON_EXTRACT(name, '$.ar'), '\"', '') LIKE ?", ["{$letter}%"])
                        ->orWhereRaw("REPLACE(JSON_EXTRACT(name, '$.ar'), '\"', '') LIKE ?", ["د. {$letter}%"])
                        ->orWhereRaw("REPLACE(JSON_EXTRACT(name, '$.ar'), '\"', '') LIKE ?", ["د.{$letter}%"])
                        ->orWhereRaw("REPLACE(JSON_EXTRACT(name, '$.ar'), '\"', '') LIKE ?", ["الدكتور {$letter}%"])
                        ->orWhereRaw("REPLACE(JSON_EXTRACT(name, '$.ar'), '\"', '') LIKE ?", ["الدكتورة {$letter}%"]);
                } else {
                    // For English letters, search in English names
                    $q->whereRaw("LOWER(REPLACE(JSON_EXTRACT(name, '$.en'), '\"', '')) LIKE ?", ["{$lowerLetter}%"])
                        ->orWhereRaw("LOWER(REPLACE(JSON_EXTRACT(name, '$.en'), '\"', '')) LIKE ?", ["dr. {$lowerLetter}%"])
                        ->orWhereRaw("LOWER(REPLACE(JSON_EXTRACT(name, '$.en'), '\"', '')) LIKE ?", ["dr {$lowerLetter}%"]);
                }
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
        // Check current locale
        if (app()->getLocale() === 'ar') {
            // Arabic alphabet
            return [
                'ا',
                'ب',
                'ت',
                'ث',
                'ج',
                'ح',
                'خ',
                'د',
                'ذ',
                'ر',
                'ز',
                'س',
                'ش',
                'ص',
                'ض',
                'ط',
                'ظ',
                'ع',
                'غ',
                'ف',
                'ق',
                'ك',
                'ل',
                'م',
                'ن',
                'ه',
                'و',
                'ي'
            ];
        }

        // English alphabet (default)
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
