<x-app-layout>
    <div class="w-full bg-cover bg-center"
        style="background-image: url('{{ asset('images/pexels-hngstrm-1939485.jpg') }}');">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm">
            <div class="px-6 py-2 text-gray-900 dark:text-gray-100 text-sm font-semibold">
                <a href="{{ route('view.transformation') }}" class="hover:underline">Transformation Center</a> /
                Generative Restore
            </div>
        </div>
        <div class="flex flex-col md:flex-row items-center justify-center gap-2 p-2 my-1">

            @include('image_transform.module.upload_btn')


            <!-- Generate Button Section -->
            <div class="w-full md:w-1/4 flex items-center justify-center">
                <button id="generate-btn" data-endpoint="/gen-restore"
                    class="bg-[#172435] hover:bg-blue-700 text-white text-sm font-semibold py-4 px-20 rounded-lg shadow-lg transition-transform transform hover:scale-105">
                    Generate
                </button>
            </div>

        </div>

        @include('image_transform.module.result_section')


    </div>
</x-app-layout>
