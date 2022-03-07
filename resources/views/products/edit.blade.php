<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Product &raquo; {{ $item->name }} &raquo; Edit
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
                <form class="w-full" action="{{ route('products.update', $item->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method("put")

                    <div class="md:flex flex-row md:space-x-4 w-full text-xs">
                        <div class="mb-3 space-y-2 w-full text-xs">
                            <label class="font-semibold text-gray-600 py-2">NAME<abbr title="required"></abbr></label>
                            <input value="{{ old('name') ?? $item->name }}" placeholder="Product Name" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4" required="required" type="text" name="name" id="name">
                            <p class="text-red text-xs hidden">Please fill out this field.</p>
                        </div>
                        <div class="mb-3 space-y-2 w-full text-xs">
                            <label class="font-semibold text-gray-600 py-2">CATEGORY<abbr title="required"></abbr></label>
                            <select name="category" id="category" class="block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4 md:w-full">
                                <option value="{{ old('category') ?? $item->category}}" >{{$item->category}}</option>
                                <option value="Sayuran">Sayuran</option>
                                <option value="Buah">Buah</option>
                                <option value="Rempah">Rempah</option>
                                <option value="Karbohidrat">Karbohidrat</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3 space-y-2 w-full text-xs">
                        <label class=" font-semibold text-gray-600 py-2">IMAGE</label>
                        <div class="flex rounded-lg border-dashed border border-gray-700 py-12 flex flex-col justify-center items-center bg-white">
                            <input type="file" value="{{ old('picturePath') ?? $item->picturePath }}" name="picturePath" placeholder="Choose image" id="image">
                                @error('image')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            <div class="col-md-12 mb-2">
                                <img id="preview-image-before-upload" src="{{ old('picturePath') ?? $item->picturePath }}"
                                    alt="preview image" style="max-height: 250px;">
                            </div>
                        </div>
                    </div>

                    <div class="md:flex flex-row md:space-x-4 w-full text-xs">
                        <div class="mb-3 space-y-2 w-full text-xs">
                            <label class="font-semibold text-gray-600 py-2">DETAIL<abbr title="required"></abbr></label>
                            <textarea placeholder="Product Detail" rows="5" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg px-4" required="required" type="text" name="detail" id="detail">{{ old('detail') ?? $item->detail }}
                            </textarea>
                            <p class="text-red text-xs hidden">Please fill out this field.</p>
                        </div>
                    </div>

                    <div class="md:flex flex-row md:space-x-4 w-full text-xs">
                        <div class="w-full flex flex-col mb-3">
                            <label class="font-semibold text-gray-600 py-2">PRODUCT UNIT<abbr title="required"></abbr></label>
                            <select class="block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4 md:w-full" name="product_unit" id="product_unit">
                                <option value="{{ old('product_unit') ?? $item->product_unit}}" >{{$item->product_unit}}</option>
                                <option value="Satuan" >Satuan</option>
                                <option value="1 kg" >1 kg</option>
                            </select>
                        </div>
                        <div class="w-full flex flex-col mb-3">
                            <label class="font-semibold text-gray-600 py-2">PRICE<abbr title="required"></abbr></label>
                            <input value="{{ old('price') ?? $item->price}}" placeholder="Product Price" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4" required="required" type="number" name="price" id="price">
                            <p class="text-red text-xs hidden">Please fill out this field.</p>
                        </div>
                        <div class="w-full flex flex-col mb-3">
                            <label class="font-semibold text-gray-600 py-2">DISCOUNT<abbr title="required"></abbr></label>
                            <input value="{{ old('discount') ?? $item->discount}}" placeholder="Discount" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4" required="required" type="number" name="discount" id="discount">
                            <p class="text-red text-xs hidden">Please fill out this field.</p>
                        </div>
                        <div class="w-full flex flex-col mb-3">
                            <label class="font-semibold text-gray-600 py-2">STOCK<abbr title="required"></abbr></label>
                            <input value="{{ old('quantity') ?? $item->quantity}}" placeholder="Stock" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4" required="required" type="number" name="quantity" id="quantity">
                            <p class="text-red text-xs hidden">Please fill out this field.</p>
                        </div>
                    </div>

                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3 text-right">
                            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                Update Product
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
