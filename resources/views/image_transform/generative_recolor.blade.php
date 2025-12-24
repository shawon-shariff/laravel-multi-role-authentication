<x-app-layout>
    <div class="w-full bg-cover bg-center"
        style="background-image: url('{{ asset('images/pexels-hngstrm-1939485.jpg') }}');">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm">
            <div class="px-6 py-2 text-gray-900 dark:text-gray-100 text-sm font-semibold">
                <a href="{{ route('view.transformation') }}" class="hover:underline">Transformation Center</a> /
                Generative Recolor
            </div>
        </div>

        <div class="flex flex-col bg-white md:flex-row items-center justify-center gap-2 p-2">

            @include('image_transform.module.upload_btn')


            <div class="w-full md:w-2/4">
                <!-- Description Input Section -->
                <div class="w-full md:flex bg-white shadow-xl rounded-xl">
                    <!-- Left Section: Aspect Ratio -->
                    <div class="w-full md:w-2/3 mb-4 md:mb-0">
                        <div class="flex flex-row items-center justify-center gap-2 p-2">
                            <div class="w-full">
                                <label for="item_to_replace" class="block text-gray-600 text-xs font-semibold mb-1">
                                    Items to recolor (up to 3 items)
                                </label>

                                <div id="chip-container" class="flex flex-wrap gap-2 p-2 border rounded-lg    ">
                                    <input id="item_to_remove" type="text" placeholder="sweater"
                                        class="flex-grow text-xs outline-none" onkeydown="handleKeyDown(event)" />
                                </div>
                            </div>

                        </div>
                        <div class="px-4 pb-2">
                            <label class="flex items-center space-x-2">
                                <input type="checkbox" id="recolor_all_instances" name="recolor_all_instances" value="recolor_all_instances" class="h-3 w-3 text-blue-500">
                                <span class="text-xs">Recolor all instances</span>
                            </label>
                        </div>
                    </div>

                    <div class="w-full md:w-1/3 p-2 relative">
                        <p class="text-xs text-gray-600 font-semibold mb-2">Replacement Color</p>
                        <div class="flex items-center justify-center gap-2">
                            <!-- Color Picker (positioned below the div) -->
                            <input type="color" id="colorPicker" value="#FF00FF" class="mt-1 h-8 w-8">


                            <!-- Input for Generated Hex Code -->
                            <input type="text" id="colorInput" name="selected_color" value="#FF00FF"
                                class="mt-1 w-20 p-1 border rounded-md text-xs outline-none" />


                        </div>
                    </div>
                </div>
            </div>


            <!-- Generate Button Section -->
            <div class="w-full md:w-1/4 flex items-center justify-center">
                <button id="generate-btn" data-endpoint="/gen-recolor"
                    class="bg-[#172435] hover:bg-blue-700 text-white text-sm font-semibold py-4 px-20 rounded-lg shadow-lg transition-transform transform hover:scale-105">
                    Generate
                </button>
            </div>

        </div>
        @include('image_transform.module.result_section')
    </div>

    <script>
        const colorPicker = document.getElementById('colorPicker');
        const colorInput = document.getElementById('colorInput');

        // Toggle color picker visibility
        function toggleColorPicker() {
            colorPicker.click();
        }

        // Sync color input and preview with picker
        colorPicker.addEventListener('input', () => {
            colorInput.value = colorPicker.value.toUpperCase();

        });

        // Update picker and preview when manually typing
        colorInput.addEventListener('input', () => {
            colorPicker.value = colorInput.value;

        });
    </script>
</x-app-layout>
