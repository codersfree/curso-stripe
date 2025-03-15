<x-app-layout>

    <x-container class="py-12">

        <div class="space-y-6">
            @foreach ($articles as $article)
                <div class="bg-white rounded shadow-lg">
                    <img class="h-72 w-full object-cover object-center" src="{{$article->image}}" alt="">

                    <div class="px-6 py-4">
                        <h1 class="font-semibold text-xl mb-2">
                            <a href="{{route('articles.show', $article)}}">
                                {{$article->title}}
                            </a>
                        </h1>

                        {{ Str::limit($article->extract, 150) }}
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-4">
            {{$articles->links()}}
        </div>
    </x-container>


</x-app-layout>