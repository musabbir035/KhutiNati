<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Service\CategoryService;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search;

    protected $listeners = ['deleteCategory'];

    public function render()
    {
        $categories = $this->search
            ? Category::where('name', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'desc')
            ->paginate(15)
            : Category::orderBy('id', 'desc')->paginate(15);

        return view('livewire.admin.category-list', [
            'categories' => $categories
        ])->extends('admin.layout')->section('main');
    }

    public function updateList()
    {
        $this->resetPage();
    }

    public function deleteCategory($id)
    {
        $delOperation = CategoryService::deleteCategory($id);
        $this->emit('categoryDeleted', $delOperation['title'], $delOperation['message'], $delOperation['code']);
    }
}
