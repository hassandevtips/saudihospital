<p>{{ gt('new_appointment_request', 'You have received a new appointment request.') }}</p>

<p><strong>{{ gt('doctor', 'Doctor') }}:</strong> {{ $appointment->doctor?->name ?? gt('na', 'N/A') }}</p>
<p><strong>{{ gt('requested_date', 'Requested Date') }}:</strong> {{
    \Illuminate\Support\Carbon::parse($appointment->appointment_date)->format('Y-m-d') }}</p>

<p><strong>{{ gt('patient_details', 'Patient Details') }}</strong></p>
<ul>
    <li><strong>{{ gt('name', 'Name') }}:</strong> {{ $appointment->patient_name }}</li>
    <li><strong>{{ gt('email', 'Email') }}:</strong> {{ $appointment->patient_email }}</li>
    <li><strong>{{ gt('phone', 'Phone') }}:</strong> {{ $appointment->patient_phone }}</li>
</ul>

@if ($appointment->message)
<p><strong>{{ gt('message', 'Message') }}:</strong></p>
<p>{{ $appointment->message }}</p>
@endif

<p><strong>{{ gt('submitted_at', 'Submitted at') }}:</strong> {{ $appointment->created_at?->format('Y-m-d H:i') }}</p>