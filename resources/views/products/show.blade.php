<x-app-layout>

    <x-container class="py-12">

        <div class="grid grid-cols-12">
            <div class="col-span-7">
                <div class="card">
                    <div class="card-body">
                        <div class="flex">
                            <figure>
                                <img class="w-48 h-28 object-cover object-center" src="{{ $product->image }}" alt="{{ $product->name }}">
                            </figure>

                            <div class="flex-1 ml-4">
                                <h1 class="text-gray-600 font-semibold text-lg">
                                    {{ $product->title }}
                                </h1>

                                <p class="font-semibold text-sm text-gray-500">
                                    {{ $product->price }} USD
                                </p>
                            </div>
                        </div>

                        <hr class="my-4">

                        <p class="text-gray-600 text-sm">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eius doloremque deleniti mollitia iste qui.</p>
                    </div>
                </div>
            </div>

            <div class="col-span-5">

            </div>
        </div>

    </x-container>

</x-app-layout>