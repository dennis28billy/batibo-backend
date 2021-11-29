<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product') }}
        </h2>
    </x-slot>

    <div>
        <div class=" mx-auto">
            <div class="mb-10">
                <a href="{{ route('products.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                + Create Product
                </a>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <form action="/dashboard/products">
                        <div class="flex flex-wrap items-stretch w-1/3 mb-4 relative ">
                            <input type="text" class="flex-shrink flex-grow flex-auto leading-normal w-px flex-1 border h-10 border-grey-light rounded rounded-r-none px-3 relative" placeholder="Search.." name="search" value="{{ request('search') }}">
                            <div class="flex -mr-px px-2">
                                <button class="flex bg-green-500 text-white items-center leading-normal bg-grey-lighter rounded rounded-l-none border border-l-0 border-grey-light px-3 whitespace-no-wrap text-grey-dark text-sm" type="submit">Search</button>
                                {{-- <span class="flex items-center leading-normal bg-grey-lighter rounded rounded-l-none border border-l-0 border-grey-light px-3 whitespace-no-wrap text-grey-dark text-sm">@example.com</span> --}}
                            </div>	
                        </div>
                    </form>
                </div>
            </div>
            <div class="bg-white">
                <table class="table-auto w-full" cellpadding="0" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="border px-6 py-4">ID</th>
                            <th class="border px-6 py-4">Image</th>
                            <th class="border px-6 py-4">Name</th>
                            <th class="border px-6 py-4">Category</th>
                            <th class="border px-6 py-4">Product Unit</th>
                            <th class="border px-6 py-4">Price</th>
                            <th class="border px-6 py-4">Discount</th>
                            <th class="border px-6 py-4">Final Price</th>
                            <th class="border px-6 py-4">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($product as $item)
                            <tr>
                                <td class="border px-6 py-4">{{ $item->id }}</td>
                                <td style="text-align: center" class="border py-0 object-fill">
                                    <img src="{{ $item->picturePath }}" alt="img: {{ $item->name }}" class="inline-block object-contain h-48 w-48"/>
                                </td>
                                <td class="border px-6 py-4">{{ $item->name }}</td>
                                {{-- <td class="border px-6 py-4">{{ $item->detail }}</td> --}}
                                <td class="border px-6 py-4">{{ $item->category }}</td>
                                <td class="border px-6 py-4">{{ $item->product_unit }}</td>
                                <td class="border px-6 py-4">Rp.{{ number_format($item->price) }}</td>
                                <td class="border px-6 py-4">{{ $item->discount }}%</td>
                                <td class="border px-6 py-4">Rp.{{ $item->price_after_discount }}</td>
                                <td class="border px-6 py-4 text-center">
                                    <a href="{{ route('products.edit', $item->id) }}" class="inline-block bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 mx-2 rounded"> 
                                        Edit
                                    </a>
                                    <form action="{{ route('products.destroy', $item->id) }}" method="POST" class="inline-block">
                                        {!! method_field('delete') . csrf_field() !!}
                                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 mx-2 rounded ">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr> 
                        @empty
                            <tr>
                                <td colspan="9" class="border text-center p-5">
                                    Data not found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="text-center mt-5">
                {{ $product->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
