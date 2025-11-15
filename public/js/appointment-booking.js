// Appointment Booking JavaScript Enhancements

document.addEventListener('DOMContentLoaded', function () {
    initializeTimeSlotSelection();
});

// Listen for Livewire updates
document.addEventListener('livewire:navigated', function () {
    initializeTimeSlotSelection();
});

function initializeTimeSlotSelection() {
    const timeSlotOptions = document.querySelectorAll('.time-slot-option');

    timeSlotOptions.forEach(option => {
        const radio = option.querySelector('input[type="radio"]');
        const btn = option.querySelector('.time-slot-btn');

        if (!radio || !btn) return;

        // Handle click on the button
        btn.addEventListener('click', function () {
            // Uncheck all other radios and reset their styles
            timeSlotOptions.forEach(opt => {
                const otherRadio = opt.querySelector('input[type="radio"]');
                const otherBtn = opt.querySelector('.time-slot-btn');
                if (otherRadio && otherBtn) {
                    otherRadio.checked = false;
                    otherBtn.classList.remove('selected');
                }
            });

            // Check this radio and apply selected style
            radio.checked = true;
            btn.classList.add('selected');

            // Trigger Livewire update
            radio.dispatchEvent(new Event('input', { bubbles: true }));
        });

        // Set initial state
        if (radio.checked) {
            btn.classList.add('selected');
        }
    });
}

// Add selected class styling via CSS
const style = document.createElement('style');
style.textContent = `
    .time-slot-btn.selected {
        border-color: #0066cc !important;
        background-color: #0066cc !important;
        color: #ffffff !important;
        box-shadow: 0 4px 12px rgba(0, 102, 204, 0.3) !important;
    }
`;
document.head.appendChild(style);

