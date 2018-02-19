@component('mail::message')
# Ciao

The post {{ $post->title }} has been updated

@component('mail::button', ['url' => route('posts.show', $post) ])
See post
@endcomponent

Grazie,<br>
{{ config('app.name') }}
@endcomponent
