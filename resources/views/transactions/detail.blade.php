<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Transaction &raquo; {{ $item->id }} by {{ $item->user->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="w-full rounded overflow-hidden shadow-lg px-6 py-6 bg-white">
                <div class="flex flex-wrap -mx-4 -mb-4 md:mb-0">
                    <div class="w-full md:w-1/6 px-4 mb-4 md:mb-0">
                        
                        <img component="span" src="{{ asset('batibofavicon.png') }}" alt="asdf" class="w-full rounded"> 
                    </div>
                    <div class="w-full md:w-5/6 px-4 mb-4 md:mb-0">
                        <div class="flex flex-wrap mb-3">
                            {{-- <div class="w-2/6">
                                <div class="text-sm">Product Name</div>
                                <div class="text-xl font-bold">{{ $item->products->name }}</div>
                            </div> --}}
                            {{-- <div class="w-1/6">
                                <div class="text-sm">Quantity</div>
                                <div class="text-xl font-bold">{{ number_format($item->quantity) }}</div>
                            </div> --}}
                            <div class="w-1/6">
                                <div class="text-sm">Total Cost</div>
                                <div class="text-xl font-bold">{{ number_format($item->total) }}</div>
                            </div>
                            <div class="w-1/6">
                                <div class="text-sm">Delivery Cost</div>
                                <div class="text-xl font-bold">{{ number_format($item->ongkosKirim) }}</div>
                            </div>
                            <div class="w-1/6">
                                <div class="text-sm">Status</div>
                                <div class="text-xl font-bold">{{ $item->status }}</div>
                            </div>
                        </div>
                        <div class="flex flex-wrap mb-3">
                            <div class="w-2/6">
                                <div class="text-sm">User Name</div>
                                <div class="text-xl font-bold">{{ $item->user->name }}</div>
                            </div>
                            <div class="w-2/6">
                                <div class="text-sm">Email</div>
                                <div class="text-xl font-bold">{{ $item->user->email }}</div>
                            </div>
                            <div class="w-1/6">
                                <div class="text-sm">Phone Number</div>
                                <div class="text-xl font-bold">{{ $item->user->phone_number }}</div>
                            </div>
			</div>
			<div class="flex flex-wrap mb-3">
                            <div class="w-2/6">
                                <div class="text-sm">Receiver Name</div>
                                <div class="text-xl font-bold">{{ $item->address->nama_penerima }}</div>
                            </div>
                            <div class="w-2/6">
                                <div class="text-sm">Receiver Email</div>
                                <div class="text-xl font-bold">{{ $item->address->email }}</div>
                            </div>
                            <div class="w-1/6">
                                <div class="text-sm">Receiver Phone Number</div>
                                <div class="text-xl font-bold">{{ $item->address->nomor_handphone }}</div>
                            </div>
                        </div>

                        <div class="flex flex-wrap mb-3">
                            <div >
                                <div class="text-sm">Google Map Location</div>
                                <div class="text-xl font-bold"><a href="https://maps.google.com/?q={{ $item->latitude }},{{ $item->longitude }}" target="_blank">https://maps.google.com/?q={{ $item->latitude }},{{ $item->longitude }}</a></div>
                            </div>
                        </div>
                        <div class="flex flex-wrap mb-3">
                            <div class="w-3/6">
                                <div class="text-sm">Address</div>
                                <div class="text-xl font-bold">{{ $item->address->kelurahan }}, {{ $item->address->kecamatan }}, {{ $item->address->kota_kabupaten }}, {{ $item->address->provinsi }}</div>
                                <div class="text-xl font-semibold">{{ $item->address->detail_alamat }}</div>
                            </div>
                        </div>
                        <div class="flex flex-wrap mb-3">
                            <div class="w-5/6">
                                <div class="text-sm">Payment URL</div>
                                <div class="text-lg">
                                    <a href="{{ $item->payment_url }}">{{ $item->payment_url }}</a>
                                </div>
                            </div>
                            @if($item->status == 'SUCCESS' || $item->status == 'ON_DELIVERY')
                            <div class="w-1/6">
                                <div class="text-sm mb-1">Change Status</div>
                                <a href="{{ route('transactions.changeStatus', ['id' => $item->id, 'status' => 'ON_DELIVERY' ]) }}"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold px-2 rounded block text-center w-full mb-1">
                                On Delivery
                                </a>
                                <a href="{{ route('transactions.changeStatus', ['id' => $item->id, 'status' => 'DELIVERED' ]) }}"
                                    class="bg-green-500 hover:bg-green-700 text-white font-bold px-2 rounded block text-center w-full mb-1">
                                Delivered
                                </a>
                                <a href="{{ route('transactions.changeStatus', ['id' => $item->id, 'status' => 'CANCELLED' ]) }}"
                                    class="bg-red-500 hover:bg-red-700 text-white font-bold px-2 rounded block text-center w-full mb-1">
                                Cancelled
                                </a>
                            </div>
                            @else
                                <div></div>
                            @endif
                        </div>
                    </div>
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
                            <th class="border px-6 py-4">Quantity</th>
                            <th class="border px-6 py-4">Discount</th>
                            <th class="border px-6 py-4">Total Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($item->order as $prods)
                            <tr>
                                <td class="border px-6 py-4">{{ $prods->id }}</td>
                                <td style="text-align: center" class="border py-0 object-fill">
                                    <img src="{{ $prods->product->picturePath }}" alt="img: {{ $prods->product->name }}" class="inline-block object-scale-down h-1/2 w-1/2"/>
                                </td>
                                <td class="border px-6 py-4">{{ $prods->product->name }}</td>
                                <td class="border px-6 py-4">{{ $prods->product->category }}</td>
                                <td class="border px-6 py-4">{{ $prods->product->product_unit }}</td>
                                <td class="border px-6 py-4">Rp.{{ number_format($prods->product->price) }}</td>
                                <td class="border px-6 py-4">{{ $prods->quantity }}</td>
                                <td class="border px-6 py-4">{{ $prods->product->discount }}%</td>
                                <td class="border px-6 py-4">Rp.{{ $prods->total }}</td>
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
        </div>


    </div>
</x-app-layout>
