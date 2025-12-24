document.addEventListener("DOMContentLoaded", function () {
    const imageUploadInput = document.getElementById("image-upload");
    const generateBtn = document.getElementById("generate-btn");

    if (imageUploadInput) {
        imageUploadInput.addEventListener("change", function () {
            clearContent("uploadedImage");
            handleImageUpload("/upload-image");
        });
    }

    if (generateBtn) {
        generateBtn.addEventListener("click", function () {
            const endpoint = this.dataset.endpoint;
            clearContent("result");
            handleImageGeneration(endpoint);
        });
    }
});

function handleImageUpload(uploadUrl) {
    const formData = new FormData();
    const fileInput = document.getElementById("image-upload");

    if (!fileInput.files.length) {
        alert("Please select an image to upload.");
        return;
    }

    formData.append("image", fileInput.files[0]);

    const csrfToken = document
        .querySelector('meta[name="csrf-token"]')
        ?.getAttribute("content");
    if (!csrfToken) {
        alert("CSRF token not found. Please refresh the page.");
        return;
    }
    formData.append("_token", csrfToken);

    showUploadLoader(true);

    fetch(uploadUrl, {
        method: "POST",
        body: formData,
    })
        .then(async (response) => {
            if (!response.ok) {
                throw new Error(
                    `Upload failed: ${response.status} ${response.statusText}`
                );
            }
            return response.json();
        })
        .then((data) => {
            if (data.image_url && data.public_id) {
                displayUploadedImage(data.image_url, data.public_id);
            } else {
                throw new Error("Invalid response. Upload failed.");
            }
        })
        .catch((error) => {
            console.error("Upload Error:", error);
            alert("An error occurred during the upload. Please try again.");
        })
        .finally(() => {
            showUploadLoader(false);
        });
}

async function handleImageGeneration(endpoint) {
    const publicID = document.getElementById("public_id")?.value;
    if (!publicID) return alert("Image not uploaded!");

    let requestData = { public_id: publicID };

    if (endpoint === "/gen-bg") {
        const backgroundPrompt =
            document.getElementById("background-prompt")?.value;
        if (!backgroundPrompt) return alert("Please enter Background Prompt!");
        requestData.background_prompt = backgroundPrompt;
    } else if (endpoint === "/gen-fill") {
        const aspect = document.querySelector(
            'input[name="aspect"]:checked'
        ).value;
        const focus = document.querySelector(
            'input[name="focus"]:checked'
        ).value;

        if (aspect == "landscape") {
            requestData.aspect_ratio = "16:9";
        } else if (aspect == "portrait") {
            requestData.aspect_ratio = "9:16";
        } else {
            requestData.aspect_ratio = "1:1";
        }

        if (focus == "center") {
            requestData.gravity = "center";
        } else if (focus == "left") {
            requestData.gravity = "east";
        } else {
            requestData.gravity = "west";
        }
    } else if (endpoint === "/gen-replace") {
        const public_id = document.getElementById("public_id")?.value;
        if (!public_id) return alert("Image not uploaded!");
        const item_to_replace =
            document.getElementById("item_to_replace")?.value;
        const replace_with = document.getElementById("replace_with")?.value;

        if (!item_to_replace) return alert("Please enter item to replace!");
        if (!replace_with) return alert("Please enter replace with!");

        requestData = {
            public_id,
            item_to_replace,
            replace_with,
            preserve_shape: document.getElementById("preserve_shape").checked
                ? 1
                : 0,
            replace_all_instances: document.getElementById(
                "replace_all_instances"
            ).checked
                ? 1
                : 0,
        };
    } else if (endpoint === "/gen-remove") {
        const public_id = document.getElementById("public_id")?.value;
        if (!public_id) return alert("Image not uploaded!");

        // Collect items to remove (from input and chips)
        const getItemsToRemove = () => {
            const input = document
                .getElementById("item_to_remove")
                ?.value.trim();
            const chips = Array.from(
                document.querySelectorAll("#chip-container .chip")
            ).map((chip) => chip.textContent.trim());
            if (input) chips.push(input); // Include input if it has a value
            return chips.slice(0, 3); // Limit to 3 items
        };

        requestData = {
            public_id,
            remove_shadows: document.getElementById("remove_shadows")?.checked
                ? "true"
                : "false",
            remove_all_instances: document.getElementById(
                "remove_all_instances"
            )?.checked
                ? "true"
                : "false",
            items_to_remove: getItemsToRemove(),
        };
    }else if(endpoint === '/gen-recolor'){
        const public_id = document.getElementById("public_id")?.value;
        if (!public_id) return alert("Image not uploaded!");

        // Collect items to remove (from input and chips)
        const getItemsToRemove = () => {
            const input = document
                .getElementById("item_to_remove")
                ?.value.trim();
            const chips = Array.from(
                document.querySelectorAll("#chip-container .chip")
            ).map((chip) => chip.textContent.trim());
            if (input) chips.push(input); // Include input if it has a value
            return chips.slice(0, 3); // Limit to 3 items
        };

        const colorInput = document.getElementById("colorInput")?.value;
        if (!colorInput) return alert("Please select replacement color!");



        requestData = {
            public_id,
            colorInput,
            items_to_remove: getItemsToRemove(),
            recolor_all_instances: document.getElementById(
                "recolor_all_instances"
            )?.checked
                ? "true"
                : "false",
        };

    }else if(endpoint === 'gen-restore' || endpoint === 'gen-enhancer' || endpoint === 'gen-upscale'){
        const public_id = document.getElementById("public_id")?.value;
        if (!public_id) return alert("Image not uploaded!");

        requestData = { public_id };
    }

    showGenerationLoader(true);

    console.log(requestData);


    try {
        const response = await fetch(endpoint, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content"),
            },
            body: JSON.stringify(requestData),
        });

        const data = await response.json();
        if (data.processed_url) {
            displayGeneratedImage(data.processed_url, data.public_id, () => {
                showGenerationLoader(false);
            });
        } else {
            alert("Image generation failed!");
            showGenerationLoader(false);
        }
    } catch (error) {
        console.error("Generation Error:", error);
        alert("Something went wrong!");
        showGenerationLoader(false);
    }
}

function displayUploadedImage(imageUrl, publicId) {
    const container = document.getElementById("uploadedImage");
    const uploadPreview = document.getElementById("upload_preview_icon");
    const dimension = document.getElementById("upload_dimension");

    if (container) {
        container.innerHTML = `
            <div class="image-container max-w-full max-h-full">
                <input id="public_id" type="hidden" value="${publicId}" />
                <img src="${imageUrl}" alt="Uploaded Image" class="uploaded-image" />
            </div>`;
    }

    // Create an Image object to get dimensions
    const img = new Image();
    img.src = imageUrl;
    img.onload = function () {
        if (dimension) {
            dimension.textContent = `Original : ${img.naturalWidth} x ${img.naturalHeight}`;
        }
        if (uploadPreview) {
            uploadPreview.innerHTML = `
            <!-- Fancybox Preview Button with SVG Icon -->
                <a href="${imageUrl}" data-fancybox="gallery" class="preview-btn" title="Full Preview">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                        <circle cx="12" cy="12" r="3"></circle>
                    </svg>
                </a>
            `;
        }
    };
}

// Function to download image (Moved to global scope)
function downloadImage(url, filename) {
    fetch(url)
        .then((response) => response.blob())
        .then((blob) => {
            const link = document.createElement("a");
            link.href = URL.createObjectURL(blob);
            link.download = filename;
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        })
        .catch(console.error);
}

function displayGeneratedImage(imageUrl, publicId, callback) {
    const img = new Image();
    img.src = imageUrl;
    img.alt = "Generated Image";
    img.className = "uploaded-image max-w-full max-h-full";

    img.onload = () => {
        const resultContainer = document.getElementById("result");
        const previewIcon = document.getElementById("preview_icon");
        const generatedDimension = document.getElementById("generated_dimension")
        if (resultContainer) {
            resultContainer.innerHTML = `
                <div class="image-container max-w-full max-h-full">
                    <input id="public_id" type="hidden" value="${publicId}" />
                `;
            resultContainer.querySelector(".image-container").appendChild(img);
        }
        if (previewIcon) {
            previewIcon.innerHTML = `
            <button class="download-btn" title="Download Image">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-download">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                    <polyline points="7 10 12 15 17 10"></polyline>
                    <line x1="12" y1="15" x2="12" y2="3"></line>
                </svg>
            </button>
            <!-- Fancybox Preview Button with SVG Icon -->
                <a href="${imageUrl}" data-fancybox="gallery" class="preview-btn" title="Full Preview">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                        <circle cx="12" cy="12" r="3"></circle>
                    </svg>
                </a>
            `;
        }
        if(generatedDimension){
            generatedDimension.textContent = `Transformed : ${img.naturalWidth} x ${img.naturalHeight}`;
        }
        const filename = "generated-image.jpg";

        // Event Listener
        document
            .querySelector(".download-btn")
            .addEventListener("click", () => {
                downloadImage(imageUrl, filename);
            });

        if (callback) callback();
    };
}

// Download Function
function downloadImage(url, filename) {
    fetch(url)
        .then((response) => response.blob())
        .then((blob) => {
            const link = document.createElement("a");
            link.href = URL.createObjectURL(blob);
            link.download = filename;
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        })
        .catch(console.error);
}

function showUploadLoader(show) {
    const loader = document.getElementById("loader");

    if (!loader) {
        console.error("Upload Loader not found");
        return;
    }

    loader.classList.toggle("hidden", !show);
}

function showGenerationLoader(show) {
    const loader = document.getElementById("loader2");

    if (!loader) {
        console.error("Generation Loader not found");
        return;
    }

    loader.classList.toggle("hidden", !show);
}

function clearContent(elementId) {
    const element = document.getElementById(elementId);
    if (element) {
        element.innerHTML = "";
    }
}

//Generative remove
const chipContainer = document.getElementById("chip-container");

function handleKeyDown(event) {
    if (event.key === "Enter" && event.target.value.trim() !== "") {
        event.preventDefault();
        const value = event.target.value.trim();
        addChip(value);
        event.target.value = "";
    }
}

function addChip(value) {
    if (chipContainer.querySelectorAll(".chip").length >= 3) return;

    const chip = document.createElement("div");
    chip.className =
        "chip bg-gray-200 text-xs px-2 py-1 rounded-full flex items-center";
    chip.innerHTML = `${value} <button class="ml-2" onclick="removeChip(this)">&times;</button>`;
    chipContainer.insertBefore(chip, document.getElementById("item_to_remove"));
}

function removeChip(button) {
    button.parentElement.remove();
}

// Ensure Fancybox script is loaded
const fancyboxScript = document.createElement("script");
fancyboxScript.src =
    "https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0.31/dist/fancybox.umd.js";
document.head.appendChild(fancyboxScript);

const fancyboxStyles = document.createElement("link");
fancyboxStyles.rel = "stylesheet";
fancyboxStyles.href =
    "https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0.31/dist/fancybox.css";
document.head.appendChild(fancyboxStyles);
