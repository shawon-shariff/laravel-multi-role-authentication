<?php

namespace App\Http\Controllers;

use App\Models\Image as Image;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ImageUploadController extends Controller
{
    public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5048',
        ]);

        // Upload to Cloudinary
        $uploadedFile = $request->file('image');
        $uploadedImage = Cloudinary::upload($uploadedFile->getRealPath(), [
            'folder' => 'uploads'
        ]);

        // Store image info in database
        $image = new Image();
        $image->image_name = $uploadedFile->getClientOriginalName();
        $image->upload_date = now();
        $image->image_url = $uploadedImage->getSecurePath();
        $image->public_id = $uploadedImage->getPublicId();
        $image->user_id = Auth::id();
        $image->save();

        return response()->json([
            'message' => 'Image uploaded successfully',
            'image_url' => $image->image_url,
            'public_id' => $image->public_id
        ]);
    }

    public function genBackground(Request $request)
    {

        $backgroundPrompt = $request->input('background_prompt');
        $publicID = $request->input('public_id');

        $cloudName = env('CLOUDINARY_CLOUD_NAME');

        $imgUrl = "https://res.cloudinary.com/{$cloudName}/image/upload/e_gen_background_replace:prompt_{$backgroundPrompt}/{$publicID}";

        return response()->json([
            'processed_url' => $imgUrl
        ]);
    }

    public function genFill(Request $request)
    {
        $publicID = $request->input('public_id');
        $aspectRatio = $request->input('aspect_ratio');
        $gravity = $request->input('gravity');

        $cloudName = env('CLOUDINARY_CLOUD_NAME');

        $imgUrl = "https://res.cloudinary.com/{$cloudName}/image/upload/c_pad,ar_{$aspectRatio},g_{$gravity},b_gen_fill/{$publicID}";

        return response()->json([
            'processed_url' => $imgUrl
        ]);
    }

    public function genReplace(Request $request)
    {
        $publicID = $request->input('public_id');
        $item_to_replace = $request->input('item_to_replace');
        $replace_with = $request->input('replace_with');
        $preserve_shape = $request->input('preserve_shape');
        $replace_all_instances = $request->input('replace_all_instances');

        $cloudName = env('CLOUDINARY_CLOUD_NAME');

        $modifiers = [];

        if ($preserve_shape == 1 or $preserve_shape == '1') {
            $modifiers[] = 'preserve-geometry_true';
        }

        if ($replace_all_instances == 1 or $replace_all_instances == '1') {
            $modifiers[] = 'multiple_true';
        }

        $modifiersString = !empty($modifiers) ? ';' . implode(';', $modifiers) : '';
        $imgUrl = "https://res.cloudinary.com/{$cloudName}/image/upload/e_gen_replace:from_{$item_to_replace};to_{$replace_with}{$modifiersString}/{$publicID}";

        return response()->json([
            'processed_url' => $imgUrl
        ]);
    }

    public function genRemove(Request $request)
    {
        $publicID = $request->input('public_id');
        $itemsToRemove = $request->input('items_to_remove', []); // Collect array input

        $removeShadows = $request->input('remove_shadows');
        $removeAllInstances = $request->input('remove_all_instances');

        // Validate input
        if (!$publicID || empty($itemsToRemove)) {
            return response()->json(['error' => 'Invalid input'], 400);
        }

        $cloudName = env('CLOUDINARY_CLOUD_NAME');

        $modifiers = [];

        if ($removeShadows == 'true') {
            $modifiers[] = 'remove-shadow_true';
        }

        if ($removeAllInstances == 'true') {
            $modifiers[] = 'multiple_true';
        }

        // Clean and format items_to_remove (remove trailing '×' and trim whitespace)
        $itemsToRemove = array_map(function ($item) {
            return trim(str_replace('×', '', $item));
        }, $itemsToRemove);

        // Construct prompt based on item count
        $prompt = count($itemsToRemove) === 1
            ? "prompt_" . $itemsToRemove[0]
            : "prompt_(" . implode(';', $itemsToRemove) . ")";

        // Construct modifier string
        $modifiersString = !empty($modifiers) ? ';' . implode(';', $modifiers) : '';

        // Generate the final image URL
        $imgUrl = "https://res.cloudinary.com/{$cloudName}/image/upload/e_gen_remove:{$prompt}{$modifiersString}/{$publicID}";

        return response()->json([
            'processed_url' => $imgUrl
        ]);
    }

    public function genRecolor(Request $request)
    {
        $publicID = $request->input('public_id');
        $itemsToRemove = $request->input('items_to_remove', []); // Collect array input
        $colorInput = $request->input('colorInput');
        $recolorAllInstances = $request->input('recolor_all_instances');

        $colorInput = ltrim($colorInput, '#');
        // Validate input
        if (!$publicID || empty($itemsToRemove)) {
            return response()->json(['error' => 'Invalid input'], 400);
        }

        $cloudName = env('CLOUDINARY_CLOUD_NAME');

        // Clean and format items_to_remove (remove trailing '×' and trim whitespace)
        $itemsToRemove = array_map(function ($item) {
            return trim(str_replace('×', '', $item));
        }, $itemsToRemove);

        // Construct prompt based on item count
        $prompt = count($itemsToRemove) === 1
            ? "prompt_" . $itemsToRemove[0]
            : "prompt_(" . implode(';', $itemsToRemove) . ")";


        $modifier = '';
        if ($recolorAllInstances == 'true') {
            $modifier = ';multiple_true';
        }

        // Generate the final image URL
        $imgUrl = "https://res.cloudinary.com/{$cloudName}/image/upload/e_gen_recolor:{$prompt};to-color_{$colorInput}{$modifier}/{$publicID}";

        return response()->json([
            'processed_url' => $imgUrl
        ]);
    }

    public function genRestore(Request $request)
    {
        $publicID = $request->input('public_id');

        // Validate input
        if (!$publicID) {
            return response()->json(['error' => 'Invalid input'], 400);
        }

        $cloudName = env('CLOUDINARY_CLOUD_NAME');

        // Generate the final image URL
        $imgUrl = "https://res.cloudinary.com/{$cloudName}/image/upload/e_gen_restore/{$publicID}";

        return response()->json([
            'processed_url' => $imgUrl
        ]);
    }

    public function genEnhance(Request $request)
    {
        $publicID = $request->input('public_id');

        // Validate input
        if (!$publicID) {
            return response()->json(['error' => 'Invalid input'], 400);
        }

        $cloudName = env('CLOUDINARY_CLOUD_NAME');

        // Generate the final image URL
        $imgUrl = "https://res.cloudinary.com/{$cloudName}/image/upload/e_enhance/{$publicID}";

        return response()->json([
            'processed_url' => $imgUrl
        ]);
    }
    public function genUpscale(Request $request)
    {
        $publicID = $request->input('public_id');

        // Validate input
        if (!$publicID) {
            return response()->json(['error' => 'Invalid input'], 400);
        }

        $cloudName = env('CLOUDINARY_CLOUD_NAME');

        // Generate the final image URL
        $imgUrl = "https://res.cloudinary.com/{$cloudName}/image/upload/e_upscale/{$publicID}";

        return response()->json([
            'processed_url' => $imgUrl
        ]);
    }
}
