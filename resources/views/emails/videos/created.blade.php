<x-mail::message>
    # Nou Vídeo Creat

    S'ha creat un nou vídeo:

    Títol: {{ $video->title }}

    Descripció: {{ $video->description }}

    Sèrie: {{ $video->series->title }}

    Vídeo creat: ({{ route('videos.show', $video->id) }})

    Thanks,
    {{ config('app.name') }}
</x-mail::message>
