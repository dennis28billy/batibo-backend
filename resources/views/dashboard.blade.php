<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="mx-auto sm:px-6 lg:px-8 py-12 h-64">
        <h2 class="font-bold">Transactions</h2>
        <div>
            <div class="grid grid-cols-6 gap-4">
                @foreach ($transactions as $item)
                <div class=" w-full lg:max-w-full lg:flex ">
                    <div class=" bg-white rounded-b p-2 flex flex-col justify-between content-center leading-normal shadow-md grid grid-cols-4">
                      <div class="p-4">
                        <div class="text-gray-900 font-bold text-xl mb-2">{{ $item->user->name }}</div>
                        <p class="text-gray-700 text-base">ID: {{ $item->id }}</p>
                      </div>
                      <div class="p-4">
                        <p class="text-gray-700 text-base font-bold text-xl mb-2">Rp. {{ $item->total }}</p>
                        <p class="text-gray-700 text-base">{{ $item->status }}</p>
                      </div>
                    </div>
                  </div>
                @endforeach
            </div>
            <a class="text-right object-right" href="/dashboard/transactions">See More ></a>
        </div>
        <br/>
        <h2 class="font-bold">Products</h2>
        <div>
            <div class="grid grid-cols-4 gap-4">
                @foreach ($products as $item)
                <div class=" w-full lg:max-w-full lg:flex ">
                    <div class=" shadow-md h-48 lg:h-auto lg:w-48 flex-none bg-cover rounded-t text-center overflow-hidden" style="background-image: url('{{ $item->picturePath }}')" title="{{ $item->name }}">
                        {{-- <img src="{{ $item->picturePath }}" alt="{{ $item->name }}"> --}}
                    </div>
                    <div class=" bg-white rounded-b p-4 flex flex-col justify-between leading-normal shadow-md">
                      <div class="mb-8 p-4">
                        <div class="text-gray-900 font-bold text-xl mb-2">{{ $item->name }}</div>
                        <p class="text-gray-700 text-base font-bold">{{ $item->category }}</p>
                        <p class="text-gray-700 text-base">Rp.{{ $item->price }}</p>
                        <p class="text-gray-700 text-base">/{{ $item->product_unit }}</p>
                      </div>
                    </div>
                  </div>
                {{-- <div class="bg-white w-1/4">
                    <h3 class="font-semibold">
                        {{ $item->name }}
                    </h3>
                </div> --}}
                @endforeach
            </div>
            <a class="text-right" href="/dashboard/products">See More ></a>
        </div>
        <br/>
        <h2 class="font-bold">Users</h2>
        <div>
            <div class="grid grid-cols-6 gap-4">
                @foreach ($users as $item)
                <div class=" w-full lg:max-w-full lg:flex ">
                    <div class=" bg-white rounded-b p-4 flex flex-col justify-between leading-normal shadow-md shadow-md h-48 lg:h-auto lg:w-48 flex-none bg-cover rounded-t text-center overflow-hidden">
                      <div class="p-4">
                        <div class="text-gray-900 font-bold text-xl mb-2">{{ $item->name }}</div>
                        <p class="text-gray-700 text-base font-bold">{{ $item->email }}</p>
                        <p class="text-gray-700 text-base">{{ $item->roles }}</p>
                      </div>
                    </div>
                  </div>
                @endforeach
            </div>
            <a class="text-right" href="/dashboard/users">See More ></a>
        </div>
    </div>

</x-app-layout>
