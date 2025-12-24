<x-app-layout>
    <div class="w-full bg-cover bg-center"
        style="background-image: url('{{ asset('images/pexels-hngstrm-1939485.jpg') }}');">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm">
            <div class="px-6 py-2 text-gray-900 dark:text-gray-100 text-sm font-semibold">
                <a href="{{ route('view.transformation') }}" class="hover:underline">Transformation Center</a> /
                Generative Replace
            </div>
        </div>
        <div class="flex flex-col bg-white  md:flex-row items-center justify-center gap-2 p-2 my-1">

            @include('image_transform.module.upload_btn')


            <div class="w-full md:w-2/4">
                <div class="flex flex-row items-center justify-center gap-2 p-2  bg-white rounded-lg shadow-lg">
                    <div class="w-2/3">
                        <label for="item_to_replace" class="block text-gray-600 text-xs font-semibold">Item to replace</label>
                        <input id="item_to_replace" type="text" placeholder="sweater"
                            class="w-full mb-1 text-xs p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-4 focus:ring-blue-300 transition duration-300" />

                        <label for="replace_with" class="block text-gray-600 text-xs font-semibold">Replace
                            with</label>
                        <input id="replace_with" type="text" placeholder="Leather Jacket with pockets"
                            class="w-full text-xs p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-4 focus:ring-blue-300 transition duration-300" />
                    </div>
                    <div class="w-1/3 p-2">
                        <label class="flex items-center space-x-2 mb-2">
                            <input type="checkbox" id="preserve_shape" name="preserve_shape" value="preserve_shape" class="h-3 w-3 text-blue-500">
                            <span class="text-xs">Preserve Shape</span>
                        </label>

                        <label class="flex items-center space-x-2">
                            <input type="checkbox" id="replace_all_instances" name="replace_all_instances" value="replace_all_instances" class="h-3 w-3 text-blue-500">
                            <span class="text-xs">Replace all instances</span>
                        </label>
                    </div>
                </div>

            </div>


            <!-- Generate Button Section -->
            <div class="w-full md:w-1/4 flex items-center justify-center">
                <button id="generate-btn" data-endpoint="/gen-replace"
                    class="bg-[#172435] hover:bg-blue-900 text-white text-sm font-semibold py-4 px-20 rounded-lg shadow-lg transition-transform transform hover:scale-105">
                    Generate
                </button>
            </div>

        </div>



        @include('image_transform.module.result_section')


    </div>

    <script src="{{ asset('assets/js/imageHandler.js') }}"></script>

</x-app-layout>
