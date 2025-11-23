<p>{{ gt('new_contact_message', 'You have received a new contact message from the website.') }}</p>

<p>
    <strong>{{ gt('name', 'Name') }}:</strong> {{ $submission->name }}<br>
    <strong>{{ gt('email', 'Email') }}:</strong> {{ $submission->email }}<br>
    @if ($submission->phone)
    <strong>{{ gt('phone', 'Phone') }}:</strong> {{ $submission->phone }}<br>
    @endif
    @if ($submission->subject)
    <strong>{{ gt('subject', 'Subject') }}:</strong> {{ $submission->subject }}<br>
    @endif
</p>

@if ($submission->message)
<p><strong>{{ gt('message', 'Message') }}:</strong></p>
<p>{!! nl2br(e($submission->message)) !!}</p>
@endif

@if ($submission->ip_address)
<p><small>{{ gt('submitted_from_ip', 'Submitted from IP') }}: {{ $submission->ip_address }}</small></p>
@endif