<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-10">
                <a href="{{ route('products.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                + Create Product
                </a>
            </div>
            <div class="bg-white">
                <table class="table-auto w-full">
                    <thead>
                        <tr>
                            <th class="border px-6 py-4">ID</th>
                            <th class="border px-6 py-4">Name</th>
                            {{-- <th class="border px-6 py-4">Detail</th> --}}
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
                                <td class="border px-6 py-4">{{ $item->name }}</td>
                                {{-- <td class="border px-6 py-4">{{ $item->detail }}</td> --}}
                                <td class="border px-6 py-4">{{ $item->category }}</td>
                                <td class="border px-6 py-4">{{ $item->product_unit }}</td>
                                <td class="border px-6 py-4">Rp.{{ number_format($item->price) }}</td>
                                <td class="border px-6 py-4">{{ $item->discount }}%</td>
                                <td class="border px-6 py-4">Rp.{{ $item->price_after_discount }}</td>
                                <td class="border px-6 py-4 text-center">
                                    <a href="{{ route('products.edit', $item->id) }}" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 mx-2 rounded"> 
                                        Edit
                                    </a>
                                    <form action="{{ route('products.destroy', $item->id) }}" method="POST" class="inline-block">
                                        {!! method_field('delete') . csrf_field() !!}
                                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 mx-2 rounded">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr> 
                        @empty
                            <tr>
                                <td colspan="9" class="border text-center p-5">
                                    Data tidak ditemukan
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
