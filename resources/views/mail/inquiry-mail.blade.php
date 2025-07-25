@component('mail::message')
    # Hi

    Name: {{ $data['name'] }}
    Email: {{ $data['email'] }}
    Phone: {{ $data['phone'] }}

    Message
    {{ $data['message'] }}

    <br>

    Best regards,<br>
    QuickRecords Team.<br>
@endcomponent
