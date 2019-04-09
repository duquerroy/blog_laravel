@component('mail::message')
# Titre: {{ $post->title}}

Vous avez écrit un nouvel article

@component('mail::button', ['url' => url('/posts/' . $post->id)])
voir l'article
@endcomponent

Merci !<br>
{{ config('app.name') }}
@endcomponent
