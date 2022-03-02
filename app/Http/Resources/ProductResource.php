<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'unit' => $this->unit,
            'price' => $this->price,
            'discounted_price' => $this->discounted_price,
            'image' => $this->image,
            'is_featured' => $this->is_featured,
            'category' => $this->category,
            'seller' => $this->seller,
            'inventory' => $this->inventory,
            'slug' => $this->slug,
            'sale' => 40,
        ];
    }
}
