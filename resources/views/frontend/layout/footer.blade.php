<div class="w-full bg-blue-900">
    <div class="flex flex-wrap text-center text-white">



        <div class="w-full md:w-1/3 p-5 border-r border-blue-800 md:text-left">
            <div class="my-6 ml-3 text-xl font-semibold">ABOUT US</div>
            <p class="p-3 text-gray-400">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean ac est massa. Donec eget elementum sapien, tincidunt tempor nunc. Cras sodales id ipsum at convallis.</p>
            <p class="p-3 text-gray-400">Morbi tristique massa nec massa auctor, at scelerisque felis consectetur. Morbi tempus et odio sit amet feugiat. Maecenas dignissim a turpis in molestie. Fusce tincidunt vestibulum iaculis.</p>
        </div>



        <div class="w-full md:w-1/3 p-5 border-r border-blue-800">
            <div class="my-6 text-xl font-semibold">CONTACT US</div>
            <p class="mt-8 text-gray-400">
                A108 Adam Street <br>
                New York, NY 535022 <br>
                United States <br>
                <strong>Phone:</strong> +1 5589 55488 55 <br>
                <strong>Email:</strong> info@webcraft.com
            </p>
            <div class="relative w-20 h-20 mx-auto my-12 bg-blue-300 rotate-45">
                <div class="flex justify-center items-center absolute left-0 top-0 w-10 h-10 hover:-ml-1 hover:-mt-1 bg-blue-800 cursor-pointer">
                    <i class="fab fa-facebook-f fa-lg text-blue-500 -rotate-45"></i>
                </div>
                <div class="flex justify-center items-center absolute top-0 right-0 w-10 h-10 hover:-mt-1 hover:-mr-1 bg-blue-800 cursor-pointer">
                    <i class="fab fa-twitter fa-lg text-blue-500 -rotate-45"></i>
                </div>
                <div class="flex justify-center items-center absolute right-0 bottom-0 w-10 h-10 hover:-mr-1 hover:-mb-1 bg-blue-800 cursor-pointer">
                    <i class="fab fa-google-plus-g fa-lg text-blue-500 -rotate-45"></i>
                </div>
                <div class="flex justify-center items-center absolute bottom-0 left-0 w-10 h-10 hover:-mb-1 hover:-ml-1 bg-blue-800 cursor-pointer">
                    <i class="fab fa-linkedin-in fa-lg text-blue-500 -rotate-45"></i>
                </div>
            </div>
        </div>



        <div class="w-full md:w-1/3 p-5">
            <div class="mt-6 text-xl font-semibold">SAY HELLO!</div>
            <form class="w-4/5 mx-auto mt-2 px-6 pt-6 pb-4 rounded">
                <div class="flex items-center mb-4">
                    <input class="w-full h-10 p-2 border-b border-blue-800 bg-blue-900 text-white" type="text" placeholder="Username">
                </div>
                <div class="flex items-center mb-4">
                    <input class="w-full h-10 p-2 border-b border-blue-800 bg-blue-900 text-white" type="text" placeholder="Email">
                </div>
                <div class="mb-6">
                    <textarea class="w-full h-24 px-2 pt-2 border-b-2 border-blue-800 bg-blue-900 text-white" placeholder="Message"></textarea>
                </div>
                <div class="flex justify-between items-center">
                    <button class="w-full py-2 px-4 rounded bg-orange-600 hover:bg-orange-700 text-white font-bold" type="button">SEND</button>
                </div>
            </form>
        </div>

    </div>
</div>
@yield('script')
