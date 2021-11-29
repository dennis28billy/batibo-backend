<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            User &raquo; {{ $item->name }} &raquo; Detail
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div>
                @if($errors->any())
                <div class="mb-5" role="alert">
                    <div class="bg-red-500 text-white font-bold rounded-t px-2">
                        There's something wrong
                    </div>
                    <div class="border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700">
                        <p>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </p>
                    </div>
                </div>
                @endif
                <div class="w-full grid grid-cols 2 gap-4">
                    <div class="mb-3 space-y-2 text-xs">
                        <label class=" font-semibold text-gray-600 py-2">PROFILE PHOTO</label>
                            <div class="flex rounded-lg border border-gray-700 py-12 flex-col justify-center items-center bg-white col-md-12 mb-2">
                                <img id="preview-image-before-upload" src="{{ $item->profile_photo_path }}"
                                    alt="preview image" style="max-height: 250px;">
                            </div>
                    </div>
                    
                    <div class="md:flex flex-row md:space-x-4 w-full text-xs">
                        <div class="mb-3 space-y-2 w-full text-xs">
                            <label class="font-semibold text-gray-600 py-2">NAME<abbr title="required"></abbr></label>
                            <p class="inline-block pt-1 text-left align-middle text-lg bg-white w-full text-grey-darker border border-gray-700 rounded-lg h-10 px-4">{{ $item->name }}</p>
                        </div>
                        <div class="mb-3 space-y-2 w-full text-xs">
                            <label class="font-semibold text-gray-600 py-2">EMAIL<abbr title="required"></abbr></label>
                            <p class="inline-block pt-1 text-left align-middle text-lg bg-white w-full text-grey-darker border border-gray-700 rounded-lg h-10 px-4">{{ $item->email }}</p>
                        </div>
                    </div>

                    
                    <div class="mb-3 space-y-2 w-full text-xs">
                        <div class="md:flex flex-row md:space-x-4 w-full text-xs">
                            <div class="w-full flex flex-col mb-3">
                                <label class="font-semibold text-gray-600 py-2">PHONE NUMBER<abbr title="required"></abbr></label>
                                <p class="inline-block pt-1 text-left align-middle text-lg bg-white w-full text-grey-darker border border-gray-700 rounded-lg h-10 px-4">{{ $item->phone_number }}</p>
                            </div>
                            <div class="w-full flex flex-col mb-3">
                                <label class="font-semibold text-gray-600 py-2">ROLES<abbr title="required"></abbr></label>
                                <p class="inline-block pt-1 text-left align-middle text-lg bg-white w-full text-grey-darker border border-gray-700 rounded-lg h-10 px-4">{{ $item->roles }}</p>
                            </div>
                        </div>
                    </div>
{{--
                    <div class="flex flex-wrap -mx-3 mt-6">
                        <div class="w-full px-3 text-left">
                            <a href="{{ route('addresses.create', $item) }}" class="inline-block bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"> 
                                Create Address
                            </a>
                        </div>
                    </div>
--}
                    <div class="mb-5">
                        <label class="font-semibold text-gray-600 py-2 text-xs mb-3">ADDRESS</label>
                        <table class="bg-white border-gray-700 rounded-lg table-auto w-full">
                            <thead>
                                <tr>
                                    <th id="id" class="border px-6 py-4">ID</th>
                                <th id="kategori" class="border px-6 py-4">Kategori</th>
                                <th id="provinsi" class="border px-6 py-4">Provinsi</th>
                                <th id="kota_kabupaten" class="border px-6 py-4">Kota/Kabupaten</th>
                                <th id="kelurahan" class="border px-6 py-4">Kelurahan</th>
                                <th id="kecamatan" class="border px-6 py-4">Kecamatan</th>
                                <th id="action" class="border px-6 py-4">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($item->address as $addr)
                            <tr>
                                <td class="border px-6 py-4">{{ $addr->id }}</td>
                                <td class="border px-6 py-4">{{ $addr->kategori }}</td>
                                {{-- <td class="border px-6 py-4">{{ $addr->detail }}</td> --}}
                                <td class="border px-6 py-4">{{ $addr->provinsi }}</td>
                                <td class="border px-6 py-4">{{ $addr->kota_kabupaten }}</td>
                                <td class="border px-6 py-4">{{ $addr->kelurahan }}</td>
                                <td class="border px-6 py-4">{{ $addr->kecamatan }}</td>
                                <td class="border px-6 py-4 text-center">
                                    <a href="{{ route('addresses.edit', $addr->id) }}" class="inline-block bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 mx-2 rounded"> 
                                            Edit
                                        </a>
                                        <form action="{{ route('addresses.destroy', $addr->id) }}" method="POST" class="inline-block">
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

                    <div class="my-5">
                        <label class="font-semibold text-gray-600 py-2 text-xs mb-3">CART</label>
                        <table class="bg-white border-gray-700 rounded-lg table-auto w-full">
                            <thead>
                                <tr>
                                    <th id="id" class="border px-6 py-4">ID</th>
                                <th id="product_id" class="border px-6 py-4">Product Name</th>
                                <th id="quantity" class="border px-6 py-4">Quantity</th>
                                <th id="total" class="border px-6 py-4">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($item->cart as $carts)
                            <tr>
                                <td class="border px-6 py-4">{{ $carts->id }}</td>
                                <td class="border px-6 py-4">{{ $carts->product->name }}</td>
                                <td class="border px-6 py-4">{{ $carts->quantity }}</td>
                                <td class="border px-6 py-4">{{ $carts->total }}</td>
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
                    
                    <div class="flex flex-wrap -mx-3 mb-6 mt-6">
                        <div class="w-full px-3 text-right">
                            <a href="{{ route('users.index') }}" class="inline-block bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 mx-2 rounded"> 
                                Back
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
 
        <script type="text/javascript">
            
        $(document).ready(function (e) {
            $('#image').change(function(){
                let reader = new FileReader();
                reader.onload = (e) => { 
                $('#preview-image-before-upload').attr('src', e.target.result); 
                }
                reader.readAsDataURL(this.files[0]); 
            });
        });
        </script>
        
    </div>
</x-app-layout>
