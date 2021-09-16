<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Transaction') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="row">
                <div class="col-md-6">
                    <form action="/dashboard/transactions">
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
                <table class="table-auto w-full">
                    <thead>
                        <tr>
                            <th class="border px-6 py-4">ID</th>
                            {{-- <th class="border px-6 py-4">Product</th> --}}
                            <th class="border px-6 py-4">User</th>
                            {{-- <th class="border px-6 py-4">Quantity</th> --}}
                            <th class="border px-6 py-4">Total</th>
                            <th class="border px-6 py-4">Status</th>
                            <th class="border px-6 py-4">Payment URL</th>
                            <th class="border px-6 py-4">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($transactions->sortBy('timestamps') as $item)
                            <tr>
                                <td class="border px-6 py-4">{{ $item->id }}</td>
                                {{-- <td class="border px-6 py-4">{{ $item->products->name }}</td> --}}
                                <td class="border px-6 py-4">{{ $item->user->name }}</td>
                                {{-- <td class="border px-6 py-4">{{ $item->quantity }}</td> --}}
                                <td class="border px-6 py-4">Rp. {{ number_format($item->total) }}</td>
                                <td class="border px-6 py-4">{{ $item->status }}</td>
                                <td class="border px-6 py-4"><a href="{{ $item->payment_url }}">{{ $item->payment_url }}</a></td>
                                <td class="border px-6 py-4 text-center">
                                    <a href="{{ route('transactions.show', $item->id) }}" class="inline-block bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 mx-2 rounded"> 
                                        View 
                                    </a>
                                    <form action="{{ route('transactions.destroy', $item->id) }}" method="POST" class="inline-block">
                                        {!! method_field('delete') . csrf_field() !!}
                                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 mx-2 rounded">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr> 
                        @empty
                            <tr>
                                <td colspan="7" class="border text-center p-5">
                                    Data tidak ditemukan
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="text-center mt-5">
                {{ $transactions->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
