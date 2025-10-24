<?php

namespace Mortezaa97\Brands\Http\Resources;

use App\Enums\Status;
use App\Http\Resources\CategorySimpleResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BrandResource extends JsonResource
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
            'desc' => html_entity_decode($this->desc, ENT_HTML5, 'UTF-8'),
            'meta_title' => $this->meta_title,
            'meta_desc' => $this->meta_desc,
            'meta_keywords' => $this->meta_keywords,
            'page_title' => $this->page_title,
            'color' => $this->color,
            'category' => $this->whenLoaded('category', CategorySimpleResource::make($this->category)),
        ];
    }
}
