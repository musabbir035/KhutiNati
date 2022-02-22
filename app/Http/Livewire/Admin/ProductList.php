<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\Product;
use App\Service\ProductService;
use Livewire\Component;
use Livewire\WithPagination;

class ProductList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $categoryId, $search, $sellerId, $isCategoryDetailsPage;

    protected $listeners = ['deleteProduct'];

    public function render()
    {
        $products = Product::withFilters(
            $this->categoryId,
            $this->search,
            $this->sellerId
        )->paginate(15);

        return view('livewire.admin.product-list', [
            'products' => $products,
            'categories' => $this->isCategoryDetailsPage ? null : Category::all()
        ])->extends('admin.layout')->section('main');
    }

    public function updateList()
    {
        $this->resetPage();
    }

    public function deleteProduct($id)
    {
        $delOperation = ProductService::deleteProduct($id);
        $this->emit('productDeleted', $delOperation['title'], $delOperation['message'], $delOperation['code']);
    }
}
