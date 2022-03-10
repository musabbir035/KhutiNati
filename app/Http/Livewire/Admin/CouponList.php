<?php

namespace App\Http\Livewire\Admin;

use App\Models\CouponCode;
use Livewire\Component;
use Livewire\WithPagination;

class CouponList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search;

    protected $listeners = ['deleteCoupon'];

    public function render()
    {
        $coupons = CouponCode::when($this->search, function ($q) {
            return $q->where('code', 'like', '%' . $this->search . '%');
        })->orderBy('validity_end', 'desc')->paginate(15);

        return view('livewire.admin.coupon-list', [
            'coupons' => $coupons
        ])->extends('admin.layout')->section('main');
    }

    public function updateList()
    {
        $this->resetPage();
    }

    public function deleteCoupon($id)
    {
        CouponCode::findOrFail($id)->delete();
        $this->emit('couponDeleted', 'Success', 'Coupon code deleted.', 200);
    }
}
