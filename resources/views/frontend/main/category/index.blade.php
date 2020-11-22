<div class="w-full p-6 bg-blue-100">
    <div class="w-48 mx-auto pt-6 border-b-2 border-orange-500 text-center text-2xl text-blue-700">Những sản phẩm </div>
    <div class="p-2 text-center text-lg text-gray-700">Dưới đây là các loại sản phẩm của chúng tôi.</div>
    <div class="flex justify-center flex-wrap p-10">
        @if(!empty($category_pro))
        @foreach($category_pro as $key => $cat_pro)
        <div class="relative w-48 h-64 m-5 bg-white shadow-lg">
            <div class="flex items-center w-48 h-20 bg-orange-500">
                <i class="fas fa-bezier-curve fa-3x mx-auto text-white"></i>
            </div>
            <p class="mx-2 py-2 border-b-2 text-center text-gray-700 font-semibold uppercase">{{ $cat_pro->name }}</p>
            <p class="p-2 text-sm text-gray-700">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean ac est massa.</p>
            <div class="absolute right-0 bottom-0 w-8 h-8 bg-gray-300 hover:bg-orange-300 text-center cursor-pointer">
                <i class="fas fa-chevron-right mt-2 text-orange-500"></i>
            </div>
        </div>
        @endforeach
        @endif
    </div>
</div>
</div>
