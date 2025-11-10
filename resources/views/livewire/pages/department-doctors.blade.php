<div>
    {{-- Banner Section --}}
    <section class="page-title pt-10">
        <div class="bg-layer bg-primary" style=""></div>
        <div class="auto-container">
            <div class="content-box">
                <h1>Our Medical Team</h1>
                <ul class="bread-crumb clearfix">
                    <li><a href="{{ route('home') }}" wire:navigate>Home</a></li>
                    <li>Department Doctors</li>
                </ul>
            </div>
        </div>
    </section>


    <div class="container py-5">
        <div class="row mb-4">
            <div class="col-12 text-center">
                <h2 class="mb-3" style="color: #02799c;">Select Department</h2>
                <p class="text-muted">Choose a department to view our specialized doctors</p>
            </div>
        </div>

        <div class="row">
            @forelse($departments as $department)
            <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                <div class="card department-card" wire:click="selectDepartment({{ $department->id }})" style="cursor: pointer; border: 2px solid {{ $selectedDepartment == $department->id ? '#02799c' : '#e9ecef' }};
                            transition: all 0.3s ease; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
                    <div class="card-body text-center">
                        @if($department->image)
                        <img src="{{ $department->image_url }}" alt="{{ $department->name }}"
                            style="width: 80px; height: 80px; object-fit: cover; border-radius: 50%;" class="mb-3">
                        @else
                        <div class="department-icon mb-3"
                            style="width: 80px; height: 80px; background: linear-gradient(135deg, #02799c, #015f7a); border-radius: 50%; margin: 0 auto; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-hospital text-white" style="font-size: 30px;"></i>
                        </div>
                        @endif
                        <h5 class="card-title"
                            style="color: {{ $selectedDepartment == $department->id ? '#02799c' : '#333' }};">{{
                            $department->name }}</h5>
                        @if($department->description)
                        <p class="text-muted">{{ \Str::limit($department->description, 80) }}</p>
                        @endif
                        <small class="text-muted">
                            <i class="fas fa-user-md" style="color: #02799c;"></i>
                            {{ $department->doctors()->where('is_active', true)->count() }} Doctors
                        </small>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <p>No departments available.</p>
            </div>
            @endforelse
        </div>

        @if($selectedDepartment && $doctors->count() > 0)
        <div class="row mt-5">
            <div class="col-12 text-center">
                <h2 class="mb-3" style="color: #02799c;">{{ $this->getSelectedDepartmentName() }} Doctors</h2>
                <p class="text-muted">Meet our specialized medical professionals</p>
            </div>
        </div>

        <div class="row">
            @foreach($doctors as $doctor)
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                <div class="card doctor-card"
                    style="border: none; box-shadow: 0 4px 15px rgba(2,121,156,0.1); transition: all 0.3s ease;">
                    <div class="card-body text-center">
                        <div class="doctor-image-wrapper mb-3" style="position: relative;">
                            <img src="{{ $doctor->image_url }}" alt="{{ $doctor->name }}"
                                style="width: 150px; height: 150px; object-fit: cover; border-radius: 50%; border: 4px solid #02799c;">
                            <div class="doctor-status"
                                style="position: absolute; bottom: 10px; right: 10px; width: 20px; height: 20px; background: #28a745; border-radius: 50%; border: 3px solid white;">
                            </div>
                        </div>
                        <h5 class="card-title text-dark">{{ $doctor->name }}</h5>
                        <p class="font-weight-bold" style="color: #02799c;">{{ $doctor->specialization }}</p>
                        @if($doctor->bio)
                        <p class="text-muted">{{ \Str::limit($doctor->bio, 120) }}</p>
                        @endif
                        <div class="doctor-contact mt-3">
                            @if($doctor->email)
                            <p class="small text-muted mb-1">
                                <i class="fas fa-envelope" style="color: #02799c;"></i> {{ $doctor->email }}
                            </p>
                            @endif
                            @if($doctor->phone)
                            <p class="small text-muted">
                                <i class="fas fa-phone" style="color: #02799c;"></i> {{ $doctor->phone }}
                            </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @elseif($selectedDepartment && $doctors->count() == 0)
        <div class="row mt-5">
            <div class="col-12">
                <div class="alert alert-info">
                    <h4>No Doctors Found</h4>
                    <p>There are currently no doctors assigned to this department.</p>
                </div>
            </div>
        </div>
        @endif

        @if(!$selectedDepartment)
        <div class="row mt-5">
            <div class="col-12">
                <div class="alert alert-light">
                    <h4>How to Find Our Doctors</h4>
                    <p>Select a department above to view our specialized medical professionals.</p>
                </div>
            </div>
        </div>
        @endif
    </div>

    {{-- JavaScript for smooth scrolling and URL handling --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Check if we came from a footer link with department parameter
            const urlParams = new URLSearchParams(window.location.search);
            const departmentId = urlParams.get('department');

            if (departmentId) {
                // Wait for Livewire to load, then scroll to doctors section
                setTimeout(function() {
                    const doctorsSection = document.querySelector('.doctors-section');
                    if (doctorsSection) {
                        doctorsSection.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                }, 1000);
            }
        });
    </script>
</div>
