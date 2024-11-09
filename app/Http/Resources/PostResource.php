<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $file = $request->file('file');
        $path = $file ? $file->store('uploads', 'public') : null; // Only store if the file exists

        return [
            'title' => $this->title,
            'sub_title' => $this->sub_title,
            'file' => $path, // Store the path or null if no file
            'description' => $this->description,
            'slug' => Str::slug($this->title),
        ];
 }
}
