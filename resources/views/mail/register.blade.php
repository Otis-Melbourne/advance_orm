<x-mail::message>
# Introduction

{{ $user->name }} has registered on the platform.

<x-mail::button :url="''">
Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
