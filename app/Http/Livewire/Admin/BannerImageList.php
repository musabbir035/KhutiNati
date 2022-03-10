<?php

namespace App\Http\Livewire\Admin;

use App\Models\BannerImage;
use Livewire\Component;

class BannerImageList extends Component
{
    public $search;

    public function render()
    {
        $images = BannerImage::when($this->search, function ($q) {
            return $q->where('title', 'like', '%' . $this->search . '%');
        })->orderBy('id', 'desc')->paginate(15);

        return view('livewire.admin.banner-image-list', [
            'images' => $images
        ])->extends('admin.layout')->section('main');
    }
}
