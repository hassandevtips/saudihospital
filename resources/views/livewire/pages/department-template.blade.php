{{-- Doctor Template Page --}}
<section class="page-title pt-10">
    <div class="bg-layer bg-primary" style=""></div>
    <div class="auto-container">
        <div class="content-box">
            <h1>{{ $page->title }}</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>{{ $page->title }}</li>
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

    {{-- Custom content from page editor --}}
    @if($page->content)
    <div class="row mb-5">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    {!! $page->content !!}
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- Department listing --}}
    @php
    $departments = \App\Models\Department::active()->orderBy('order')->get();
    @endphp

    <div class="row">
        @forelse($departments as $department)
        <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
            <div class="card department-card"
                style="cursor: pointer; border: 2px solid #e9ecef; transition: all 0.3s ease; box-shadow: 0 2px 10px rgba(0,0,0,0.1);"
                onclick="window.location.href='{{ route('department-doctors') }}?department={{ $department->id }}'">
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
                    <h5 class="card-title" style="color: #333;">{{ $department->name }}</h5>
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
</div>
