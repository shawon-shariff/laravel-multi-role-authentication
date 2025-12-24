<div class="w-full md:w-1/3 bg-white shadow-xl rounded-xl">
    <form id="upload-form" action="/upload-image" method="POST" enctype="multipart/form-data"
        class="text-center">
        @csrf
        <label for="image-upload" class="cursor-pointer">
            <div class="flex flex-col items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-blue-500" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path d="M16 16l-4-4-4 4M12 12v8M20 16v4H4v-4" />
                </svg>
                <p class="text-gray-700 text-sm font-medium pb-2">Drag & Drop your image or <span
                        class="text-blue-600 font-semibold">Browse</span></p>
            </div>
            <input type="file" id="image-upload" name="image" hidden />
        </label>
    </form>
</div>
