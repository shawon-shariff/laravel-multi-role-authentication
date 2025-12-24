<x-app-layout>

    <div class="relative  w-full h-auto bg-cover bg-center"
        style="background-image: url('{{ asset('images/pexels-hngstrm-1939485.jpg') }}');">
        <div class="z-10">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm">
                <div class="px-6 py-2 text-gray-900 dark:text-gray-100 text-sm font-semibold">
                    {{ __('Transformation Center') }}
                </div>
            </div>
            <div class="text-center justify-center bg-white mt-1 py-2">
                <p class="text-center text-2xl font-extrabold">Transformation Center</p>
                <p class="text-xs mx-auto">
                    Unlock the power of AI with advanced generative tools – transform images with ease using our
                    Generative Background, Fill, Replace, Remove, Recolor, and Restore features.
                </p>
            </div>
            <div class="flex flex-row gap-2 m-2">
                <!-- Generative Background -->
                <div class="w-full md:w-1/3 p-3 text-center bg-white rounded-lg ">
                    <div class="flex justify-center">
                        <div class="relative mr-2">
                            <img class="h-24 w-auto" src="{{ asset('images/demo_images/gen-bgr-object-1.jpeg') }}"
                                alt="Before Image">
                            <span
                                class="absolute top-1 left-1 bg-indigo-600 text-white text-xs font-semibold px-2 py-1 rounded">Before</span>
                        </div>
                        <div class="relative">
                            <img class="h-24 w-auto" src="{{ asset('images/demo_images/gen_bg.jpeg') }}"
                                alt="After Image">
                            <span
                                class="absolute top-1 left-1 bg-green-600 text-white text-xs font-semibold px-2 py-1 rounded">After</span>
                        </div>
                    </div>

                    <div class="bg-gray-900 shadow-lg rounded-lg overflow-hidden mt-3">
                        <div class="p-4">
                            <a href="{{ route('view.generative-background') }}"
                                class="text-white text-sm font-semibold hover:text-blue-700">
                                Generative Background
                            </a>
                        </div>
                    </div>
                </div>


                <!-- Generative Fill -->
                <div class="w-full md:w-1/3 p-3 text-center bg-white rounded-lg ">
                    <div class="flex justify-center">
                        <div class="relative mr-2">
                            <img class="h-24 w-auto" src="{{ asset('images/demo_images/genfill-nature-3.jpeg') }}"
                                alt="After Image">
                            <span
                                class="absolute top-1 left-1 bg-indigo-600 text-white text-xs font-semibold px-2 py-1 rounded">Before</span>
                        </div>
                        <div class="relative">
                            <img class="h-24 w-auto"
                                src="{{ asset('images/demo_images/genfill-nature-3_output.jpeg') }}" alt="Before Image">

                            <span
                                class="absolute top-1 left-1 bg-green-600 text-white text-xs font-semibold px-2 py-1 rounded">After</span>
                        </div>
                    </div>

                    <div class="bg-gray-900 shadow-lg rounded-lg overflow-hidden mt-3">
                        <div class="p-4">
                            <a href="{{ route('view.generative-fill') }}"
                                class="text-sm font-semibold text-white hover:text-blue-700">
                                Generative Fill
                            </a>
                        </div>
                    </div>
                </div>


                <!-- Generative Replace -->
                <div class="w-full md:w-1/3 p-3 text-center bg-white rounded-lg ">
                    <div class="flex justify-center gap-8">
                        <div class="relative mr-2">
                            <img class="h-24 w-auto" src="{{ asset('images/demo_images/replace-frame-before.jpeg') }}"
                                alt="Before Image">
                            <span
                                class="absolute top-1 left-1 bg-indigo-600 text-white text-xs font-semibold px-2 py-1 rounded">Before</span>
                        </div>
                        <div class="relative">
                            <img class="h-24 w-auto" src="{{ asset('images/demo_images/replace-frame-after.jpeg') }}"
                                alt="After Image">

                            <span
                                class="absolute top-1 left-1 bg-green-600 text-white text-xs font-semibold px-2 py-1 rounded">After</span>
                        </div>
                    </div>

                    <div class="bg-gray-900 shadow-lg rounded-lg overflow-hidden mt-3">
                        <div class="p-4">
                            <a href="{{ route('view.generative-replace') }}"
                                class="text-sm font-semibold text-white hover:text-blue-700">
                                Generative Replace
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex flex-row gap-2 m-2">
                <!-- Generative Remove -->
                <div class="w-full md:w-1/3 p-3 text-center bg-white rounded-lg">
                    <div class="flex justify-center">
                        <div class="relative mr-2">
                            <img class="h-24 w-auto" src="{{ asset('images/demo_images/remove-before.jpg') }}"
                                alt="Before Image">
                            <span
                                class="absolute top-1 left-1 bg-indigo-600 text-white text-xs font-semibold px-2 py-1 rounded">Before</span>
                        </div>
                        <div class="relative">
                            <img class="h-24 w-auto" src="{{ asset('images/demo_images/remove-after.jpg') }}"
                                alt="After Image">
                            <span
                                class="absolute top-1 left-1 bg-green-600 text-white text-xs font-semibold px-2 py-1 rounded">After</span>
                        </div>
                    </div>

                    <div class="bg-gray-900 shadow-lg rounded-lg overflow-hidden mt-3">
                        <div class="p-4">
                            <a href="{{ route('view.generative-remove') }}"
                                class="text-white text-sm font-semibold hover:text-blue-700">
                                Generative Remove
                            </a>
                        </div>
                    </div>
                </div>


                <!-- Generative Recolor -->
                <div class="w-full md:w-1/3 p-3 text-center bg-white rounded-lg ">
                    <div class="flex justify-center">
                        <div class="relative mr-2">
                            <img class="h-24 w-auto" src="{{ asset('images/demo_images/recolor-before.jpg') }}"
                                alt="Before Image">
                            <span
                                class="absolute top-1 left-1 bg-indigo-600 text-white text-xs font-semibold px-2 py-1 rounded">Before</span>
                        </div>
                        <div class="relative">
                            <img class="h-24 w-auto" src="{{ asset('images/demo_images/recolor-after.jpg') }}"
                                alt="After Image">

                            <span
                                class="absolute top-1 left-1 bg-green-600 text-white text-xs font-semibold px-2 py-1 rounded">After</span>
                        </div>
                    </div>

                    <div class="bg-gray-900 shadow-lg rounded-lg overflow-hidden mt-3">
                        <div class="p-4">
                            <a href="{{ route('view.generative-recolor') }}"
                                class="text-sm font-semibold text-white hover:text-blue-700">
                                Generative Recolor
                            </a>
                        </div>
                    </div>
                </div>


                <!-- Generative Restore -->
                <div class="w-full md:w-1/3 p-3 text-center bg-white rounded-lg ">
                    <div class="flex justify-center">
                        <div class="relative mr-2">
                            <img class="h-24 w-auto" src="{{ asset('images/demo_images/restore-before.jpeg') }}"
                                alt="Before Image">
                            <span
                                class="absolute top-1 left-1 bg-indigo-600 text-white text-xs font-semibold px-2 py-1 rounded">Before</span>
                        </div>
                        <div class="relative">
                            <img class="h-24 w-auto" src="{{ asset('images/demo_images/restore-after.jpeg') }}"
                                alt="After Image">

                            <span
                                class="absolute top-1 left-1 bg-green-600 text-white text-xs font-semibold px-2 py-1 rounded">After</span>
                        </div>
                    </div>

                    <div class="bg-gray-900 shadow-lg rounded-lg overflow-hidden mt-3">
                        <div class="p-4">
                            <a href="{{ route('view.generative-restore') }}"
                                class="text-sm font-semibold text-white hover:text-blue-700">
                                Generative Restore
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex flex-row gap-2 m-2">
                <!-- AI Image Enhancer -->
                <div class="w-full md:w-1/3 p-3 text-center bg-white rounded-lg ">
                    <div class="flex justify-center">
                        <div class="relative mr-2">
                            <img class="h-24 w-auto" src="{{ asset('images/demo_images/enhance-before.jpg') }}"
                                alt="Before Image">
                            <span
                                class="absolute top-1 left-1 bg-indigo-600 text-white text-xs font-semibold px-2 py-1 rounded">Before</span>
                        </div>
                        <div class="relative">
                            <img class="h-24 w-auto" src="{{ asset('images/demo_images/enhancer-after.jpg') }}"
                                alt="After Image">

                            <span
                                class="absolute top-1 left-1 bg-green-600 text-white text-xs font-semibold px-2 py-1 rounded">After</span>
                        </div>
                    </div>

                    <div class="bg-gray-900 shadow-lg rounded-lg overflow-hidden mt-3">
                        <div class="p-4">
                            <a href="{{ route('view.generative-enhance') }}"
                                class="text-sm font-semibold text-white hover:text-blue-700">
                                AI Image Enhancer
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Upscale -->
                <div class="w-full md:w-1/3 p-3 text-center bg-white rounded-lg ">
                    <div class="flex justify-center">
                        <div class="relative mr-2">
                            <img class="h-24 w-auto" src="{{ asset('images/demo_images/upscale-before.jpeg') }}"
                                alt="Before Image">
                            <span
                                class="absolute top-1 left-1 bg-indigo-600 text-white text-xs font-semibold px-2 py-1 rounded">Before</span>
                        </div>
                        <div class="relative">
                            <img class="h-24 w-auto" src="{{ asset('images/demo_images/upscale-after.jpeg') }}"
                                alt="After Image">

                            <span
                                class="absolute top-1 left-1 bg-green-600 text-white text-xs font-semibold px-2 py-1 rounded">After</span>
                        </div>
                    </div>

                    <div class="bg-gray-900 shadow-lg rounded-lg overflow-hidden mt-3">
                        <div class="p-4">
                            <a href="{{ route('view.generative-upscale') }}"
                                class="text-sm font-semibold text-white hover:text-blue-700">
                                Generative Upscale
                            </a>
                        </div>
                    </div>
                </div>

                 <!-- Upscale -->
                 <div class="w-full md:w-1/3 p-3 text-center bg-white rounded-lg ">

                </div>
            </div>
        </div>

    </div>

    <script>
        document.querySelectorAll('.before-after-container').forEach(container => {
            const slider = container.querySelector('.slider');
            const afterImage = container.querySelector('.after-image');

            const onMouseMove = (e) => {
                const rect = container.getBoundingClientRect();
                let offsetX = e.clientX - rect.left;
                if (offsetX < 0) offsetX = 0;
                if (offsetX > rect.width) offsetX = rect.width;
                slider.style.left = `${offsetX}px`;
                afterImage.style.width = `${offsetX}px`;
            };

            slider.addEventListener('mousedown', () => {
                document.addEventListener('mousemove', onMouseMove);
                document.addEventListener('mouseup', () => {
                    document.removeEventListener('mousemove', onMouseMove);
                }, {
                    once: true
                });
            });
        });
    </script>
</x-app-layout>
