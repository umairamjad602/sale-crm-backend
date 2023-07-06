<?php

namespace App\Http\Resources\Categories;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryCollection extends JsonResource {
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'category_name' => $this->category_name,
            'image' => asset('images/category_images') . '/' . $this->category_image
        ];
    }
}
