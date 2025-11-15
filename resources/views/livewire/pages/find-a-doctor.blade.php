<div>
    {{-- Banner Section --}}
    @include('livewire.includes.page-hero')

    {{-- Custom Styles --}}
    <style>
        .find-doctor-hero {
            background: linear-gradient(135deg, #02799c 0%, #015f7a 100%);
            padding: 60px 0;
            color: white;
        }

        .search-box {
            background: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            margin-top: -50px;
            position: relative;
            z-index: 10;
        }

        .filter-section {
            background: #f8f9fa;
            padding: 30px 0;
            border-bottom: 2px solid #e9ecef;
        }

        .form-control:focus {
            border-color: #02799c;
            box-shadow: 0 0 0 3px rgba(2, 121, 156, 0.1);
        }

        .alphabet-filter {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            justify-content: center;
            margin: 20px 0;
        }

        .letter-badge {
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid #e9ecef;
            border-radius: 50%;
            cursor: pointer;
            transition: all 0.3s ease;
            background: white;
            color: #333;
            font-weight: 600;
            font-size: 14px;
        }

        .letter-badge:hover {
            border-color: #02799c;
            color: #02799c;
            transform: scale(1.1);
        }

        .letter-badge.active {
            background: #02799c;
            border-color: #02799c;
            color: white;
        }

        .doctor-card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            height: 100%;
        }

        .doctor-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 30px rgba(2, 121, 156, 0.2);
        }

        .doctor-image-wrapper {
            position: relative;
            padding: 20px;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        }

        .doctor-image {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
            border: 5px solid white;
            margin: 0 auto;
            display: block;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .doctor-info {
            padding: 20px;
            text-align: center;
        }

        .doctor-name {
            font-size: 20px;
            font-weight: 700;
            color: #333;
            margin-bottom: 8px;
        }

        .doctor-specialization {
            font-size: 16px;
            color: #02799c;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .doctor-department {
            font-size: 14px;
            color: #6c757d;
            margin-bottom: 15px;
        }

        .doctor-contact {
            display: flex;
            flex-direction: column;
            gap: 8px;
            padding-top: 15px;
            border-top: 1px solid #e9ecef;
        }

        .contact-item {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-size: 14px;
            color: #6c757d;
        }

        .contact-item i {
            color: #02799c;
        }

        .view-profile-btn {
            background: linear-gradient(135deg, #02799c 0%, #015f7a 100%);
            color: white;
            border: none;
            padding: 10px 25px;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
            margin-top: 15px;
        }

        .view-profile-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(2, 121, 156, 0.3);
            color: white;
        }

        .results-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .clear-filters-btn {
            background: #dc3545;
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .clear-filters-btn:hover {
            background: #c82333;
            transform: scale(1.05);
        }

        .no-results {
            text-align: center;
            padding: 60px 20px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        .no-results i {
            font-size: 80px;
            color: #e9ecef;
            margin-bottom: 20px;
        }

        .pagination-wrapper {
            display: flex;
            justify-content: center;
            margin-top: 40px;
        }

        @media (max-width: 768px) {
            .search-box {
                padding: 20px;
                margin-top: -30px;
            }

            .results-header {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }

            select.form-control {
                font-size: 14px;
                height: auto;
            }

            .input-group-lg .form-control {
                font-size: 14px !important;
            }
        }
    </style>

    {{-- Search Section --}}
    <section class="filter-section">
        <div class="container">
            <div class="search-box">
                <div class="row">
                    <div class="col-12 text-center mb-4">
                        <h2 style="color: #02799c; font-weight: 700;">Find Your Doctor</h2>
                        <p class="text-muted">Search by name, specialization, or browse by department</p>
                    </div>
                </div>

                <div class="row g-3 align-items-center">
                    {{-- Search Bar --}}
                    <div class="col-lg-7 col-md-6">
                        <div class="input-group input-group-lg">
                            <span class="input-group-text" style="background: #f8f9fa; border-right: none;">
                                <i class="fas fa-search" style="color: #02799c;"></i>
                            </span>
                            <input type="text" class="form-control"
                                placeholder="Search by doctor name or specialization..."
                                wire:model.live.debounce.500ms="search" style="border-left: none; font-size: 16px;">
                        </div>
                    </div>

                    {{-- Department Select --}}
                    <div class="col-lg-5 col-md-6">
                        <div class="position-relative" wire:ignore>
                            <select wire:model="selectedDepartment" class="form-select department-dropdown"
                                style="height: 48px; border: 2px solid #e9ecef; border-radius: 8px; font-size: 16px;">
                                <option value="">All Departments</option>
                                @foreach($departments as $department)
                                <option value="{{ $department->id }}">
                                    {{ $department->name }}
                                    @if($department->doctors_count > 0)
                                    ({{ $department->doctors_count }})
                                    @endif
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Alphabet Filter --}}
            <div class="row mt-4">
                <div class="col-12">
                    <h5 class="text-center mb-3" style="color: #333; font-weight: 600;">Browse by Name</h5>
                    <div class="alphabet-filter">
                        @foreach($alphabet as $letter)
                        <div class="letter-badge {{ $selectedLetter == $letter ? 'active' : '' }}"
                            wire:click="selectLetter('{{ $letter }}')">
                            {{ $letter }}
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Results Section --}}
    <section class="py-5">
        <div class="container">
            {{-- Results Header --}}
            @if($search || $selectedDepartment || $selectedLetter)
            <div class="results-header">
                <div>
                    <h4 style="color: #333; margin: 0;">
                        Showing {{ $doctors->total() }} {{ Str::plural('Doctor', $doctors->total()) }}
                    </h4>
                    @if($search)
                    <p class="text-muted mb-0"><i class="fas fa-search"></i> Search: "{{ $search }}"</p>
                    @endif
                    @if($selectedDepartment)
                    @php
                    $selectedDept = $departments->firstWhere('id', $selectedDepartment);
                    @endphp
                    @if($selectedDept)
                    <p class="text-muted mb-0"><i class="fas fa-hospital"></i> Department: {{ $selectedDept->name }}</p>
                    @endif
                    @endif
                    @if($selectedLetter)
                    <p class="text-muted mb-0"><i class="fas fa-font"></i> Starting with: {{ $selectedLetter }}</p>
                    @endif
                </div>
                <button class="clear-filters-btn" wire:click="clearFilters">
                    <i class="fas fa-times"></i> Clear Filters
                </button>
            </div>
            @else
            <div class="text-center mb-4">
                <h3 style="color: #02799c; font-weight: 700;">All Doctors</h3>
                <p class="text-muted">Browse our complete team of medical professionals</p>
            </div>
            @endif

            {{-- Doctors Grid --}}
            @if($doctors->count() > 0)
            <div class="row">
                @foreach($doctors as $doctor)
                <div class="col-lg-3 col-md-3 col-sm-12 team-block">
                    <a wire:navigate href="{{ route('doctor-details', ['doctor' => $doctor->id]) }}">
                        <div class="team-block-two wow fadeInUp animated animated" data-wow-delay="00ms"
                            data-wow-duration="1500ms">
                            <div class="inner-box">
                                <figure class="image-box"><img src="{{ $doctor->image_url }}" alt="">
                                </figure>
                                <div class="lower-content p_relative d_block">
                                    <div class="share-box p_absolute">
                                        <a wire:navigate href="{{ $doctor->facebook }}"
                                            class="share-icon fs_14 d_iblock"><i class="icon-37"></i></a>
                                        <ul class="share-links p_absolute clearfix">
                                            <li><a href="mailto:{{ $doctor->email }}"><i
                                                        class="fas fa-envelope"></i></a></li>
                                            <li><a href="tel:{{ $doctor->phone }}"><i class="fas fa-phone"></i></a></li>
                                        </ul>
                                    </div>
                                    <h3>{{
                                        $doctor->name }}</h3>
                                    <span class="designation">{{ $doctor->specialization }}</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="pagination-wrapper">
                {{ $doctors->links() }}
            </div>
            @else
            {{-- No Results --}}
            <div class="no-results">
                <i class="fas fa-user-md"></i>
                <h3 style="color: #333;">No Doctors Found</h3>
                <p class="text-muted">We couldn't find any doctors matching your criteria.</p>
                <button class="btn view-profile-btn mt-3" wire:click="clearFilters">
                    <i class="fas fa-redo"></i> Clear Filters
                </button>
            </div>
            @endif
        </div>
    </section>

    {{-- Loading Indicator --}}
    <div wire:loading class="position-fixed top-50 start-50 translate-middle" style="z-index: 9999;">
        <div class="spinner-border text-primary" role="status"
            style="width: 3rem; height: 3rem; color: #02799c !important;">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    {{-- Nice Select Integration Script --}}
    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            initNiceSelect();
        });

        // Re-initialize on Livewire navigation
        document.addEventListener('livewire:navigated', function() {
            initNiceSelect();
        });

        function initNiceSelect() {
            if (typeof jQuery !== 'undefined' && jQuery.fn.niceSelect) {
                // Destroy existing nice-select if it exists
                if (jQuery('.department-dropdown').next('.nice-select').length) {
                    jQuery('.department-dropdown').niceSelect('destroy');
                }

                // Initialize nice-select
                jQuery('.department-dropdown').niceSelect();

                // Sync nice-select changes with Livewire
                jQuery('.department-dropdown').off('change').on('change', function() {
                    var value = jQuery(this).val();
                    @this.set('selectedDepartment', value);
                });
            }
        }

        // Listen for Livewire updates to reset the dropdown if needed
        if (typeof Livewire !== 'undefined') {
            Livewire.on('filtersCleared', function() {
                if (typeof jQuery !== 'undefined' && jQuery.fn.niceSelect) {
                    jQuery('.department-dropdown').val('').niceSelect('update');
                }
            });
        }
    </script>
    @endpush

</div>
