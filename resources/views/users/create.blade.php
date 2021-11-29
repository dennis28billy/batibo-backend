<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {!! __('User &raquo; Create') !!}
        </h2>
    </x-slot>

    <div class="grid  gap-8 grid-cols-1 py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex flex-col ">
                <div class="mt-5">
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
                    <form class="w-full" action="{{ route('users.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                            <div class="md:flex flex-row md:space-x-4 w-full text-xs">
                                <div class="mb-3 space-y-2 w-full text-xs">
                                    <label class="font-semibold text-gray-600 py-2">NAME<abbr title="required"></abbr></label>
                                    <input placeholder="User Name" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4" required="required" type="text" name="name" id="name">
                                    <p class="text-red text-xs hidden">Please fill out this field.</p>
                                </div>
                                <div class="mb-3 space-y-2 w-full text-xs">
                                    <label class="font-semibold text-gray-600 py-2">EMAIL<abbr title="required"></abbr></label>
                                    <input placeholder="Email" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4" required="required" type="text" name="email" id="email">
                                    <p class="text-red text-xs hidden">Please fill out this field.</p>
                                </div>
                            </div>

                            <div class="mb-3 space-y-2 w-full text-xs">
                                <label class=" font-semibold text-gray-600 py-2">PROFILE PHOTO</label>
                                <div class="flex bg-white rounded-lg border-dashed border-2 border-gray-400 py-12 flex flex-col justify-center items-center">
                                    <input type="file" src="{{ asset('uploadimage.png') }}" name="profile_photo_path" placeholder="Choose image" id="image">
                                        @error('image')
                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                        @enderror
                                    <div class="col-md-12 mb-2">
                                        <img id="preview-image-before-upload" src="{{ asset('uploadimage.png') }}"
                                            alt="preview image" style="max-height: 250px;">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mb-3 space-y-2 w-full text-xs">
                                <div class="md:flex md:flex-row md:space-x-4 w-full text-xs">
                                    <div class="w-full flex flex-col mb-3">
                                        <label class="font-semibold text-gray-600 py-2">PASSWORD</label>
                                        <input type="password" name="password" id="password" placeholder="Password" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4" >
                                    </div>
                                    <div class="w-full flex flex-col mb-3">
                                        <label class="font-semibold text-gray-600 py-2">PASSWORD CONFIRMATION</label>
                                        <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Password Confirmation" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4">
                                    </div>
                                    
                                </div>
                                <div class="md:flex flex-row md:space-x-4 w-full text-xs">
                                    <div class="w-full flex flex-col mb-3">
                                        <label class="font-semibold text-gray-600 py-2">PHONE NUMBER<abbr title="required"></abbr></label>
                                        <input placeholder="Phone Number" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4" required="required" type="number" name="phone_number" id="phone_number">
                                        <p class="text-red text-xs hidden">Please fill out this field.</p>
                                    </div>
                                    <div class="w-full flex flex-col mb-3">
                                        <label class="font-semibold text-gray-600 py-2">ROLES<abbr title="required"></abbr></label>
                                        <select class="block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4 md:w-full" name="roles" id="roles">
                                            <option value="USER">User</option>
                                            <option value="ADMIN">Admin</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            {{-- <div>
                                <label class="font-bold text-gray-700 py-2">ADDRESS</label>
                                <button type="button" class="bg-green-400 px-2 py-1 text-sm shadow-sm font-medium tracking-wider text-white rounded-full hover:shadow-lg hover:bg-green-500">+</button>
                                <div>
                                    <div class="md:flex flex-row md:space-x-4 w-full text-xs">
                                        <div class="mb-3 space-y-2 w-full text-xs">
                                            <label class="font-semibold text-gray-600 py-2">CATEGORY</label>
                                            <select class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4" name="kategori" id="kategori">
                                                <option value="Alamat Rumah">Alamat Rumah</option>
                                            </select>
                                        </div>
                                        <div class="mb-3 space-y-2 w-full text-xs">
                                            <label class="font-semibold text-gray-600 py-2">PROVINSI</label>
                                            <input placeholder="Provinsi" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4" required="required" type="text" name="provinsi" id="provinsi">
                                            <p class="text-red text-xs hidden">Please fill out this field.</p>
                                        </div>
                                    </div>
                                    <div class="md:flex flex-row md:space-x-4 w-full text-xs">
                                        <div class="mb-3 space-y-2 w-full text-xs">
                                            <label class="font-semibold text-gray-600 py-2">KOTA/KABUPATEN</label>
                                            <input placeholder="Kota/Kabupaten" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4" required="required" type="text" name="kota_kabupaten" id="kota_kabupaten">
                                        <p class="text-red text-xs hidden">Please fill out this field.</p>
                                        </div>
                                        <div class="mb-3 space-y-2 w-full text-xs">
                                            <label class="font-semibold text-gray-600 py-2">KELURAHAN</label>
                                            <input placeholder="Kelurahan" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4" required="required" type="text" name="kelurahan" id="kelurahan">
                                            <p class="text-red text-xs hidden">Please fill out this field.</p>
                                        </div>
                                        <div class="mb-3 space-y-2 w-full text-xs">
                                            <label class="font-semibold text-gray-600 py-2">KECAMATAN</label>
                                            <input placeholder="Kecamatan" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4" required="required" type="text" name="kecamatan" id="kecamatan">
                                            <p class="text-red text-xs hidden">Please fill out this field.</p>
                                        </div>
                                    </div>
                                    <div class="mb-3 space-y-2 w-full text-xs">
                                        <label class="font-semibold text-gray-600 py-2">ADDRESS DETAIL<abbr title="required"></abbr></label>
                                        <textarea placeholder="Address Detail" rows="5" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg px-4" required="required" type="text" name="detail_alamat" id="detail_alamat"></textarea>
                                        <p class="text-red text-xs hidden">Please fill out this field.</p>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                        {{-- <div class="md:flex flex-row md:space-x-4 w-full text-xs">
                            <div class="w-full flex flex-col mb-3">
                                <label class="font-semibold text-gray-600 py-2">ADDRESS<abbr title="required"></abbr></label>
                                <input placeholder="Address" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4" required="required" type="text" name="address" id="address">
                                <p class="text-red text-xs hidden">Please fill out this field.</p>
                            </div>
                        </div> --}}
                        <div class="mt-5 text-right md:space-x-3 md:block flex flex-col-reverse">
                                    <button type="submit" class="mb-2 md:mb-0 bg-green-400 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-full hover:shadow-lg hover:bg-green-500">Save User</button>
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
