<?php

namespace Mortezaa97\Brands\Http\Resources;

use App\Enums\Status;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BrandSimpleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'slug' => $this->slug,
            'logo' => $this->logo ? url($this->logo) : null,
            // 'status' => Status::from((int) $this->status)?->label(),
            'color' => $this->color,
        ];
    }
}
