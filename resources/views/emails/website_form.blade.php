<p>Hello,</p>
<p>This email was sent from the website by <strong>{{ $formData['email_form'] ?? $formData['email'] ?? 'N/A' }}</strong>.</p>

@foreach($formData as $key => $value)
    @continue(in_array($key, ['email_form', '_token'])) 
    @php $formattedKey = ucwords(str_replace('_', ' ', $key)); @endphp
    <p><strong>{{ $formattedKey }}:</strong> {{ is_array($value) ? implode(', ', $value) : $value }}</p>
@endforeach
