<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use App\Models\IdeaImage;

class IdeaImageController extends Controller
{
    public function destroy(Idea $idea)
    {
        Gate::authorize('workWith', $idea);
        Storage::disk('public')->delete($idea->image_path);
        $idea->update(['image_path' => null]);

        return back();
    }

    public function download(IdeaImage $image)    {
        return response()->download(
            storage_path('app/public/' . $image->path)
        );
    }
}
