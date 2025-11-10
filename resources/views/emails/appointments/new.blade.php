<p>You have received a new appointment request.</p>

<p><strong>Doctor:</strong> {{ $appointment->doctor?->name ?? 'N/A' }}</p>
<p><strong>Requested Date:</strong> {{
    \Illuminate\Support\Carbon::parse($appointment->appointment_date)->format('Y-m-d') }}</p>

<p><strong>Patient Details</strong></p>
<ul>
    <li><strong>Name:</strong> {{ $appointment->patient_name }}</li>
    <li><strong>Email:</strong> {{ $appointment->patient_email }}</li>
    <li><strong>Phone:</strong> {{ $appointment->patient_phone }}</li>
</ul>

@if ($appointment->message)
<p><strong>Message:</strong></p>
<p>{{ $appointment->message }}</p>
@endif

<p><strong>Submitted at:</strong> {{ $appointment->created_at?->format('Y-m-d H:i') }}</p>