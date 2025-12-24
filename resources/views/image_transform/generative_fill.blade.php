<x-app-layout>
    <div class="w-full bg-cover bg-center" style="background-image: url('{{ asset('images/pexels-hngstrm-1939485.jpg') }}');">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm">
            <div class="px-6 py-2 text-gray-900 dark:text-gray-100 text-sm font-semibold">
                <a href="{{ route('view.transformation') }}" class="hover:underline">Transformation Center</a> /
                Generative Fill
            </div>
        </div>
        <div class="flex flex-col bg-white md:flex-row items-center justify-center gap-2 p-2 my-1">

            @include('image_transform.module.upload_btn')


            <div class="w-full md:w-2/4">
                <!-- Description Input Section -->
                <div class="w-full md:flex bg-white shadow-xl rounded-xl p-4">
                    <!-- Left Section: Aspect Ratio -->
                    <div class="w-full md:w-1/2 mb-4 md:mb-0">
                        <p class="text-xs font-medium mb-2">Aspect Ratio</p>
                        <div class="flex flex-col space-y-2">
                            <!-- Radio Button 1 (Default: Landscape) -->
                            <label class="inline-flex items-center">
                                <input type="radio" name="aspect" value="landscape" checked
                                    class="w-4 h-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                <span class="ml-2 text-gray-700 text-xs">Landscape (16:9)</span>
                            </label>

                            <!-- Radio Button 2 -->
                            <label class="inline-flex items-center">
                                <input type="radio" name="aspect" value="portrait"
                                    class="w-4 h-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                <span class="ml-2 text-gray-700 text-xs">Portrait (9:16)</span>
                            </label>

                            <!-- Radio Button 3 -->
                            <label class="inline-flex items-center">
                                <input type="radio" name="aspect" value="square"
                                    class="w-4 h-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                <span class="ml-2 text-gray-700 text-xs">Square (1:1)</span>
                            </label>
                        </div>
                    </div>

                    <!-- Right Section: Focus On -->
                    <div class="w-full md:w-1/2">
                        <p class="text-xs font-medium mb-2">Focus On</p>
                        <div class="flex flex-col space-y-2">
                            <!-- Radio Button 1 (Default: Center) -->
                            <label class="inline-flex items-center">
                                <input type="radio" name="focus" value="center" checked
                                    class="w-4 h-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                <span class="ml-2 text-gray-700 text-xs">Center</span>
                            </label>

                            <!-- Radio Button 2 -->
                            <label class="inline-flex items-center">
                                <input type="radio" name="focus" value="left"
                                    class="w-4 h-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                <span class="ml-2 text-gray-700 text-xs">Left</span>
                            </label>

                            <!-- Radio Button 3 -->
                            <label class="inline-flex items-center">
                                <input type="radio" name="focus" value="right"
                                    class="w-4 h-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                <span class="ml-2 text-gray-700 text-xs">Right</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Generate Button Section -->
            <div class="w-full md:w-1/4 flex items-center justify-center">
                <button id="generate-btn" data-endpoint="/gen-fill"
                    class="bg-[#172435] hover:bg-blue-700 text-white text-sm font-semibold py-4 px-20 rounded-lg shadow-lg transition-transform transform hover:scale-105">
                    Generate
                </button>
            </div>

        </div>



        @include('image_transform.module.result_section')


    </div>
    {{-- <script>
        document.getElementById("image-upload").addEventListener("change", function() {
            const formData = new FormData();
            formData.append("image", this.files[0]);

            // Add CSRF Token
            formData.append("_token", "{{ csrf_token() }}");

            const loader = document.getElementById('loader');
            const displayText = document.getElementById('display-text');

            // Show loader when uploading starts
            loader.classList.remove('hidden');
            displayText.style.display = 'none';

            fetch("/upload-image", {
                    method: "POST",
                    body: formData,
                })
                .then((response) => response.json())
                .then((data) => {
                    if (data.image_url) {
                        // Display uploaded image
                        document.getElementById('uploadedImage').innerHTML = `
                            <div class="image-container max-w-full max-h-full">
                                <input id="public_id" type="hidden" value="${data.public_id}" />
                                <img src="${data.image_url}" alt="Uploaded Image" class="uploaded-image" />
                            </div>
                        `;
                    } else {
                        alert("Upload failed. Please try again.");
                        loader.classList.add('hidden');
                        displayText.style.display = 'block';
                    }
                })
                .catch((error) => {
                    alert("An error occurred during the upload.");
                    console.error("Error:", error);
                    loader.classList.add('hidden');
                    displayText.style.display = 'block';
                });
        });

        document.getElementById('generate-btn').addEventListener('click', async function() {
            const publicID = document.getElementById('public_id').value;

            const loader2 = document.getElementById('loader2');
            loader2.classList.remove('hidden');

            try {
                const response = await fetch('/gen-fill', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}' // For Laravel CSRF protection
                    },
                    body: JSON.stringify({
                        public_id: publicID
                    })
                });

                const data = await response.json();

                if (data.processed_url) {
                    const img = new Image();
                    img.src = data.processed_url;
                    img.alt = 'Generated Image';
                    img.className = 'uploaded-image max-w-full max-h-full';

                    img.onload = () => {
                        document.getElementById('result').innerHTML = `
                    <div class="image-container max-w-full max-h-full">
                         <input id="public_id" type="hidden" value="${data.public_id}" />
                    </div>
                `;
                        document.querySelector('#result .image-container').appendChild(img);
                        loader2.classList.add('hidden');
                    };
                } else {
                    alert('Image generation failed!');
                    loader2.classList.add('hidden');
                }
            } catch (error) {
                loader2.classList.add('hidden');
                console.error('Error:', error);
                alert('Something went wrong!');
            }
        });
    </script> --}}
    <script src="{{ asset('assets/js/imageHandler.js') }}"></script>

</x-app-layout>
