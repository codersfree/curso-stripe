<x-app-layout>

    <x-container class="py-12">

        <h1 class="text-4xl font-semibold text-gray-700 mb-2">
            {{ $article->title }}
        </h1>

        <div class="text-lg text-gray-600">
            {{$article->extract}}
        </div>

        <figure class="mb-4">
            <img class="h-80 w-full object-cover object-center" src="{{$article->image}}" alt="">
        </figure>

        <div class="text-base text-gray-600">
            {!! $article->body !!}
        </div>

    </x-container>

</x-app-layout>