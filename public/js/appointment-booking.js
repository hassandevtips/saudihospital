// Appointment Booking JavaScript Enhancements

// Global state
let currentStep = 1;
const totalSteps = 4;

document.addEventListener('DOMContentLoaded', function () {
    initializeAppointmentBooking();
});

// Listen for Livewire updates
document.addEventListener('livewire:navigated', function () {
    initializeAppointmentBooking();
});

// Listen for Livewire load event
document.addEventListener('livewire:init', function () {
    initializeAppointmentBooking();
});

// Listen for appointment created event to close modal
document.addEventListener('livewire:init', () => {
    Livewire.on('appointment-created', () => {
        setTimeout(() => {
            closeAppointmentModal();
            // Show success message
            showSuccessNotification();
        }, 1500);
    });
});

// Listen for Livewire updates to re-validate buttons
document.addEventListener('livewire:init', () => {
    Livewire.hook('morph.updated', ({ el, component }) => {
        setTimeout(() => {
            if (currentStep > 0) {
                updateStepButtons();
                initializeTimeSlotSelection();
            }
        }, 150);
    });
});

function initializeAppointmentBooking() {
    initializeTimeSlotSelection();
    initializeFormValidation();
}

function initializeTimeSlotSelection() {
    const timeSlotOptions = document.querySelectorAll('.time-slot-option');

    timeSlotOptions.forEach(option => {
        const radio = option.querySelector('input[type="radio"]');
        const btn = option.querySelector('.time-slot-btn');

        if (!radio || !btn) return;

        // Remove existing listeners by cloning
        const newBtn = btn.cloneNode(true);
        btn.parentNode.replaceChild(newBtn, btn);

        // Handle click on the button
        newBtn.addEventListener('click', function () {
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
            newBtn.classList.add('selected');

            // Trigger Livewire update
            radio.dispatchEvent(new Event('input', { bubbles: true }));
            radio.dispatchEvent(new Event('change', { bubbles: true }));

            // Enable next button
            updateStepButtons();
        });

        // Set initial state
        if (radio.checked) {
            newBtn.classList.add('selected');
        }
    });
}

function initializeFormValidation() {
    const form = document.getElementById('appointmentForm');
    if (!form) return;

    // Add input listeners for real-time validation
    const inputs = form.querySelectorAll('input[required], textarea[required]');
    inputs.forEach(input => {
        input.addEventListener('input', updateStepButtons);
        input.addEventListener('change', updateStepButtons);
    });
}

// Modal Functions
function openAppointmentModal() {
    const modal = document.getElementById('appointmentModal');
    if (modal) {
        modal.classList.add('active');
        document.body.style.overflow = 'hidden';
        currentStep = 1;
        showStep(1);
    }
}

function closeAppointmentModal() {
    const modal = document.getElementById('appointmentModal');
    if (modal) {
        modal.classList.remove('active');
        document.body.style.overflow = '';
        currentStep = 1;
        showStep(1);
    }
}

// Step Navigation
function nextStep() {
    if (currentStep >= totalSteps) return;

    if (!validateCurrentStep()) {
        console.log('Validation failed for step', currentStep);
        return;
    }

    currentStep++;
    showStep(currentStep);

    // Reinitialize time slot selection when moving to step 2
    if (currentStep === 2) {
        setTimeout(() => {
            initializeTimeSlotSelection();
            updateStepButtons();
        }, 200);
    }
}

function prevStep() {
    if (currentStep > 1) {
        currentStep--;
        showStep(currentStep);
    }
}

function showStep(stepNumber) {
    // Store current step globally
    currentStep = stepNumber;

    // Hide all step contents
    const stepContents = document.querySelectorAll('.appointment-step-content');
    stepContents.forEach(content => {
        content.style.display = 'none';
    });

    // Show current step content
    const currentContent = document.querySelector(`[data-step-content="${stepNumber}"]`);
    if (currentContent) {
        currentContent.style.display = 'block';
    }

    // Update step indicators
    const steps = document.querySelectorAll('.appointment-steps .step');
    steps.forEach((step, index) => {
        const stepNum = index + 1;
        step.classList.remove('active', 'completed');

        if (stepNum < stepNumber) {
            step.classList.add('completed');
        } else if (stepNum === stepNumber) {
            step.classList.add('active');
        }
    });

    // Update buttons after a short delay to ensure DOM is ready
    setTimeout(() => {
        updateStepButtons();
    }, 100);

    // Scroll to top of modal
    const modalContent = document.querySelector('.appointment-modal-content');
    if (modalContent) {
        modalContent.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
}

function validateCurrentStep() {
    const currentContent = document.querySelector(`[data-step-content="${currentStep}"]`);
    if (!currentContent) return false;

    // Step 1: Check if date is selected
    if (currentStep === 1) {
        const dateInput = currentContent.querySelector('input[type="date"]');
        return dateInput && dateInput.value && dateInput.value.trim() !== '';
    }

    // Step 2: Check if time slot is selected AND doctor is available
    if (currentStep === 2) {
        const warningAlert = document.querySelector('.availability-alert.warning');
        const infoAlert = document.querySelector('.availability-alert.info');

        // If doctor not available or all slots booked, don't allow next
        if (warningAlert || infoAlert) {
            return false;
        }

        const timeRadios = currentContent.querySelectorAll('input[type="radio"][name="appointment_time"]');
        let isSelected = false;
        timeRadios.forEach(radio => {
            if (radio.checked) isSelected = true;
        });
        return isSelected;
    }

    // Step 3: Validate all required fields
    if (currentStep === 3) {
        const requiredInputs = currentContent.querySelectorAll('input[required], textarea[required]');
        let isValid = true;

        requiredInputs.forEach(input => {
            if (!input.value || input.value.trim() === '') {
                isValid = false;
                input.classList.add('error');
            } else {
                input.classList.remove('error');
            }
        });
        return isValid;
    }

    return true;
}

function updateStepButtons() {
    // Update button for current step
    const currentContent = document.querySelector(`[data-step-content="${currentStep}"]`);
    if (!currentContent) return;

    const nextButton = currentContent.querySelector('.btn-primary');
    if (!nextButton) return;

    // Check if current step is valid
    const isValid = validateCurrentStep();
    nextButton.disabled = !isValid;

    // Also update specific step buttons by ID
    if (currentStep === 1) {
        const step1Btn = document.getElementById('step1NextBtn');
        if (step1Btn) step1Btn.disabled = !isValid;
    } else if (currentStep === 2) {
        const step2Btn = document.getElementById('step2NextBtn');
        if (step2Btn) step2Btn.disabled = !isValid;
    }
}

function showSuccessNotification() {
    // You can implement a custom notification here
    console.log('Appointment booked successfully!');
}

// Utility function for date formatting
function formatDate(dateString) {
    if (!dateString) return 'Not selected';

    const date = new Date(dateString);
    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    return date.toLocaleDateString('en-US', options);
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

    .form-control.error {
        border-color: #dc3545 !important;
        box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.1) !important;
    }
`;
document.head.appendChild(style);

// Close modal on escape key
document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') {
        closeAppointmentModal();
    }
});

// Prevent modal close when clicking inside modal content
document.addEventListener('click', function (e) {
    const modalContent = document.querySelector('.appointment-modal-content');
    const modal = document.getElementById('appointmentModal');

    if (modal && modal.classList.contains('active')) {
        if (e.target === modal || e.target.classList.contains('appointment-modal-overlay')) {
            closeAppointmentModal();
        }
    }
});
