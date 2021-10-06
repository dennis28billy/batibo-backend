<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            User &raquo; {{ $item->user->name }} &raquo; Address &raquo; {{ $item->id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div>
                @if($errors->any())
                <div class="mb-5" role="alert">
                    <div class="bg-red-500 text-white font-bold rounded-t px-4 px-2">
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
                <form class="w-full" action="{{ route('addresses.update', $item->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method("put")

                    <div class="md:flex flex-row md:space-x-4 w-full text-xs">
                        <div class="mb-3 space-y-2 w-full text-xs">
                            <label class="font-semibold text-gray-600 py-2">Kategori<abbr title="required"></abbr></label>
                            <select name="kategori" id="kategori" class="block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4 md:w-full">
                                <option value="{{ $item->kategori }}">{{ $item->kategori }}</option>
                                <option value="Alamat Rumah">Alamat Rumah</option>
                                <option value="Alamat Kerja">Alamat Kerja</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="md:flex flex-row md:space-x-4 w-full text-xs">
                        <div class="mb-3 space-y-2 w-full text-xs">
                            <label class="font-semibold text-gray-600 py-2">Provinsi<abbr title="required"></abbr></label>
                            <input value="{{ old('provinsi') ?? $item->provinsi }}" placeholder="Provinsi" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4" required="required" type="text" name="provinsi" id="provinsi">
                            <p class="text-red text-xs hidden">Please fill out this field.</p>
                        </div>
                        <div class="mb-3 space-y-2 w-full text-xs">
                            <label class="font-semibold text-gray-600 py-2">Kota / Kabupaten<abbr title="required"></abbr></label>
                            <input value="{{ old('kota_kabupaten') ?? $item->kota_kabupaten }}" placeholder="Kota / Kabupaten" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4" required="required" type="text" name="kota_kabupaten" id="kota_kabupaten">
                            <p class="text-red text-xs hidden">Please fill out this field.</p>
                        </div>
                    </div>

                    <div class="md:flex flex-row md:space-x-4 w-full text-xs">
                        <div class="mb-3 space-y-2 w-full text-xs">
                            <label class="font-semibold text-gray-600 py-2">Kelurahan<abbr title="required"></abbr></label>
                            <input value="{{ old('kelurahan') ?? $item->kelurahan }}" placeholder="Kelurahan" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4" required="required" type="text" name="kelurahan" id="kelurahan">
                            <p class="text-red text-xs hidden">Please fill out this field.</p>
                        </div>
                        <div class="mb-3 space-y-2 w-full text-xs">
                            <label class="font-semibold text-gray-600 py-2">Kecamatan<abbr title="required"></abbr></label>
                            <input value="{{ old('kecamatan') ?? $item->kecamatan }}" placeholder="Kecamatan" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4" required="required" type="text" name="kecamatan" id="kecamatan">
                            <p class="text-red text-xs hidden">Please fill out this field.</p>
                        </div>
                    </div>

                    <div class="md:flex flex-row md:space-x-4 w-full text-xs">
                        <div class="mb-3 space-y-2 w-full text-xs">
                            <label class="font-semibold text-gray-600 py-2">DETAIL<abbr title="required"></abbr></label>
                            <textarea placeholder="Detail Alamat" rows="5" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg px-4" required="required" type="text" name="detail_alamat" id="detail_alamat">{{ old('detail_alamat') ?? $item->detail_alamat }}
                            </textarea>
                            <p class="text-red text-xs hidden">Please fill out this field.</p>
                        </div>
                    </div>

                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3 text-right">
                            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                Update Address
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            </div>
        </div>
    </div>
</x-app-layout>
