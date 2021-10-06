<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            User &raquo; {{ $user->name }} Address &raquo; Create
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
                <form class="w-full" action="{{ route('addresses.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="md:flex flex-row md:space-x-4 w-full text-xs">
                        <div class="mb-3 space-y-2 w-full text-xs">
                            <label class="font-semibold text-gray-600 py-2">KATEGORI<abbr title="required"></abbr></label>
                            <select name="kategori" id="kategori" class="block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4 md:w-full">
                                <option value="Alamat Rumah">Alamat Rumah</option>
                                <option value="Alamat Kerja">Alamat Kerja</option>
                            </select>
                        </div>
                    </div>

                    <div class="md:flex flex-row md:space-x-4 w-full text-xs">
                        <div class="mb-3 space-y-2 w-full text-xs">
                            <label class="font-semibold text-gray-600 py-2">PROVINSI<abbr title="required"></abbr></label>
                            <input placeholder="Provinsi" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4" required="required" type="text" name="provinsi" id="provinsi">
                            <p class="text-red text-xs hidden">Please fill out this field.</p>
                        </div>
                        <div class="mb-3 space-y-2 w-full text-xs">
                            <label class="font-semibold text-gray-600 py-2">KOTA / KABUPATEN<abbr title="required"></abbr></label>
                            <input placeholder="Kota / Kabupaten" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4" required="required" type="text" name="kota_kabupaten" id="kota_kabupaten">
                            <p class="text-red text-xs hidden">Please fill out this field.</p>
                        </div>
                    </div>

                    <div class="md:flex flex-row md:space-x-4 w-full text-xs">
                        <div class="mb-3 space-y-2 w-full text-xs">
                            <label class="font-semibold text-gray-600 py-2">KECAMATAN<abbr title="required"></abbr></label>
                            <input placeholder="Kecamatan" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4" required="required" type="text" name="kecamatan" id="kecamatan">
                            <p class="text-red text-xs hidden">Please fill out this field.</p>
                        </div>
                        <div class="mb-3 space-y-2 w-full text-xs">
                            <label class="font-semibold text-gray-600 py-2">KELURAHAN<abbr title="required"></abbr></label>
                            <input placeholder="Kelurahan" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4" required="required" type="text" name="kelurahan" id="kelurahan">
                            <p class="text-red text-xs hidden">Please fill out this field.</p>
                        </div>
                    </div>

                    <div class="md:flex flex-row md:space-x-4 w-full text-xs">
                        <div class="mb-3 space-y-2 w-full text-xs">
                            <label class="font-semibold text-gray-600 py-2">DETAIL<abbr title="required"></abbr></label>
                            <textarea placeholder="Detail Alamat" rows="5" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg px-4" required="required" type="text" name="detail_alamat" id="detail_alamat"></textarea>
                            <p class="text-red text-xs hidden">Please fill out this field.</p>
                        </div>
                    </div>

                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3 text-right">
                            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                Create Address
                            </button>
                        </div>
                    </div>
                </form>
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
