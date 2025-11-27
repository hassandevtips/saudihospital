<x-filament-panels::page>
    {{-- Ensure icon CSS is loaded --}}
    <link rel="stylesheet" href="{{ asset('css/filament-icons.css') }}">

    <style>
        .icon-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            gap: 1rem;
            margin-top: 1rem;
        }

        .icon-card {
            background: white;
            border: 2px solid #e5e7eb;
            border-radius: 0.5rem;
            padding: 1.5rem;
            text-align: center;
            transition: all 0.2s ease;
            cursor: pointer;
            position: relative;
        }

        .icon-card:hover {
            border-color: #f59e0b;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
        }

        .icon-card i {
            font-size: 3rem;
            color: #1f2937;
            margin-bottom: 0.75rem;
            display: block;
        }

        .icon-card .icon-name {
            font-size: 0.875rem;
            font-weight: 600;
            color: #6b7280;
            margin-top: 0.5rem;
        }

        .icon-card .copy-feedback {
            position: absolute;
            top: 0.5rem;
            right: 0.5rem;
            background: #10b981;
            color: white;
            padding: 0.25rem 0.5rem;
            border-radius: 0.25rem;
            font-size: 0.75rem;
            opacity: 0;
            transition: opacity 0.2s;
        }

        .icon-card .copy-feedback.show {
            opacity: 1;
        }

        .search-box {
            margin-bottom: 1.5rem;
        }

        .search-box input {
            width: 100%;
            max-width: 400px;
            padding: 0.75rem 1rem;
            border: 2px solid #e5e7eb;
            border-radius: 0.5rem;
            font-size: 1rem;
        }

        .search-box input:focus {
            outline: none;
            border-color: #f59e0b;
        }

        .dark .icon-card {
            background: #1f2937;
            border-color: #374151;
        }

        .dark .icon-card:hover {
            border-color: #f59e0b;
        }

        .dark .icon-card i {
            color: #f3f4f6;
        }

        .dark .icon-card .icon-name {
            color: #9ca3af;
        }

        .info-banner {
            background: #fef3c7;
            border: 1px solid #fbbf24;
            border-radius: 0.5rem;
            padding: 1rem;
            margin-bottom: 1.5rem;
        }

        .info-banner p {
            margin: 0;
            color: #92400e;
        }

        .dark .info-banner {
            background: #451a03;
            border-color: #f59e0b;
        }

        .dark .info-banner p {
            color: #fbbf24;
        }
    </style>

    <div class="info-banner">
        <p><strong>💡 Tip:</strong> Click on any icon to copy its class name to your clipboard. Use these icon classes
            in your forms and templates.</p>
    </div>

    <div class="search-box">
        <input type="text" id="iconSearch" placeholder="Search icons... (e.g., icon-17)" onkeyup="filterIcons()" />
    </div>

    <div class="icon-grid" id="iconGrid">
        @foreach($this->getIcons() as $icon)
        <div class="icon-card" onclick="copyIconName('{{ $icon }}', this)" data-icon="{{ $icon }}">
            <i class="{{ $icon }}"></i>
            <div class="icon-name">{{ $icon }}</div>
            <div class="copy-feedback">Copied!</div>
        </div>
        @endforeach
    </div>

    <script>
        function copyIconName(iconName, element) {
            // Copy to clipboard
            navigator.clipboard.writeText(iconName).then(function() {
                // Show feedback
                const feedback = element.querySelector('.copy-feedback');
                feedback.classList.add('show');

                // Hide feedback after 1.5 seconds
                setTimeout(function() {
                    feedback.classList.remove('show');
                }, 1500);
            }).catch(function(err) {
                console.error('Failed to copy: ', err);
            });
        }

        function filterIcons() {
            const searchValue = document.getElementById('iconSearch').value.toLowerCase();
            const iconCards = document.querySelectorAll('.icon-card');

            iconCards.forEach(function(card) {
                const iconName = card.getAttribute('data-icon').toLowerCase();
                if (iconName.includes(searchValue)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }
    </script>
</x-filament-panels::page>
