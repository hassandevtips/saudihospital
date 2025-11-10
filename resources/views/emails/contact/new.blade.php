<p>{{ __('You have received a new contact message from the website.') }}</p>

<p>
    <strong>{{ __('Name') }}:</strong> {{ $submission->name }}<br>
    <strong>{{ __('Email') }}:</strong> {{ $submission->email }}<br>
    @if ($submission->phone)
    <strong>{{ __('Phone') }}:</strong> {{ $submission->phone }}<br>
    @endif
    @if ($submission->subject)
    <strong>{{ __('Subject') }}:</strong> {{ $submission->subject }}<br>
    @endif
</p>

@if ($submission->message)
<p><strong>{{ __('Message') }}:</strong></p>
<p>{!! nl2br(e($submission->message)) !!}</p>
@endif

@if ($submission->ip_address)
<p><small>{{ __('Submitted from IP') }}: {{ $submission->ip_address }}</small></p>
@endif