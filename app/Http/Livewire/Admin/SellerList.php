<?php

namespace App\Http\Livewire\Admin;

use App\Models\Seller;
use App\Service\SellerService;
use Exception;
use Livewire\Component;
use Livewire\WithPagination;

class SellerList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search;

    protected $listeners = ['deleteSeller'];

    public function render()
    {
        $sellers = $this->search
            ? Seller::where('name', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'desc')
            ->paginate(15)
            : Seller::orderBy('id', 'desc')->paginate(15);

        return view('livewire.admin.seller-list', [
            'sellers' => $sellers
        ])->extends('admin.layout')->section('main');
    }

    public function updateList()
    {
        $this->resetPage();
    }

    public function deleteSeller($id)
    {
        $delOperation = SellerService::deleteSeller($id);
        $this->emit('sellerDeleted', $delOperation['title'], $delOperation['message'], $delOperation['code']);
    }
}
