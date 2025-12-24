<x-app-layout>
    <div class="w-full bg-cover bg-center" style="background-image: url('{{ asset('images/pexels-hngstrm-1939485.jpg') }}');">

        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm">
            <div class="px-6 py-2 text-gray-900 dark:text-gray-100 text-sm font-semibold">
                <a href="{{ route('view.transformation') }}" class="hover:underline">Transformation Center</a> /
                Generative Background
            </div>
        </div>


        <div class="flex flex-col bg-white md:flex-row items-center justify-center gap-2 p-2 my-1">

            @include('image_transform.module.upload_btn')

            <!-- Description Input Section -->
            <div class="w-full md:w-2/4 bg-white shadow-xl rounded-xl p-2">
                <label for="description" class="block text-gray-600 text-sm font-semibold mb-2">Background
                    Description</label>
                <input id="background-prompt" type="text" placeholder="Describe your background..."
                    class="w-full text-xs p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-4 focus:ring-blue-300 transition duration-300" />
            </div>

            <!-- Generate Button Section -->
            <div class="w-full md:w-1/4 flex items-center justify-center">
                <button id="generate-btn" data-endpoint="/gen-bg"
                    class="bg-[#172435] hover:bg-blue-700 text-white text-sm font-semibold py-4 px-20 rounded-lg shadow-lg transition-transform transform hover:scale-105">
                    Generate
                </button>
            </div>

        </div>

        @include('image_transform.module.result_section')

        <div class="text-center mt-3">
            <p class="instructions-title text-sm">Guidelines</p>
            <ol>
                <li>
                    <p class="text-xs">Supports images up to 10 MB.</p>
                </li>
                <li>
                    <p class="text-xs">Please avoid using commas in the description.</p>
                </li>
            </ol>
        </div>
    </div>



</x-app-layout>
