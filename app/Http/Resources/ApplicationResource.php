<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ApplicationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' =>$this->slug,
            'description' => $this->description,
            'user' => new UserResource($this->user),
            'status' => new StatusResource($this->status),
            'created_at' =>$this->created_at->format('Y-m-d H:i:s'),
            'updated_at' =>$this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
