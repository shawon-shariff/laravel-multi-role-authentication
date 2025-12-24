<div class="flex flex-col md:flex-row items-center justify-center  px-1 pb-1 gap-1">
    <!-- Left Section: Uploaded Image -->
    <div class="w-full md:w-1/2 bg-white  shadow-lg p-4 flex flex-col items-center justify-center relative">
        <div class="m-0 p-0">
            <h4 class="text-lg font-semibold text-gray-800 mb-6 flex items-center gap-2 relative">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-500" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path d="M12 16v-4m0 0V8m0 4h4m-4 0H8" />
                    <circle cx="12" cy="12" r="10" />
                </svg>
                Uploaded Image
            </h4>
        </div>
        <p id="upload_dimension" class="w-full text-xs font-bold">-</p>
        <span class="absolute top-0 right-0 mt-5 px-5" id="upload_preview_icon"></span>
        <div id="loader" class="absolute inset-0 flex items-center justify-center hidden">
            <div class="w-8 h-8 border-4 border-blue-500 border-t-transparent rounded-full animate-spin">
            </div>
        </div>

        <div id="uploadedImage"
            class="w-full h-64 flex items-center justify-center border-2 border-dashed border-gray-300 rounded-lg ">


            <!-- Placeholder Text -->
            <p id="display-text" class="text-gray-400">Your uploaded image will appear here</p>

            <!-- Image (Hidden by default) -->
            <img id="imagePreview" class="hidden w-full h-full object-contain" />
        </div>

    </div>

    <!-- Right Section: Result Display -->
    <div class="w-full md:w-1/2 bg-white  shadow-lg p-4 flex flex-col items-center justify-center relative">
        <h5 class="text-lg font-semibold text-gray-800 mb-6 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-green-500" viewBox="0 0 24 24"
                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round">
                <path d="M9 12l2 2 4-4" />
                <circle cx="12" cy="12" r="10" />
            </svg>
            Result

        </h5>
        <p id="generated_dimension" class="w-full text-xs font-bold">-</p>
        <span class="absolute top-0 right-0 mt-5 px-5" id="preview_icon"></span>
        <div id="loader2" class="absolute inset-0 flex items-center justify-center hidden">
            <div class="w-8 h-8 border-4 border-blue-500 border-t-transparent rounded-full animate-spin">
            </div>
        </div>

        <div id="result"
            class="w-full h-64 flex items-center justify-center border-2 border-dashed border-gray-300 rounded-lg relative">

            <p class="text-gray-400">Your processed image will appear here</p>
        </div>
    </div>
</div>
