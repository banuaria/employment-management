<?php

namespace App\Livewire\Dashboard\Product;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class ProductIndex extends Component
{
    use WithPagination;

    #[Url(as: 'q', except: '')]
    public string $search = '';
    #[Url(as: 'sort', except: 'created_at')]
    public string $sort_field = 'created_at';
    #[Url(as: 'direction', except: 'desc')]
    public string $sort_direction = 'desc';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sort_field === $field) {
            $this->sort_direction = $this->sort_direction === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sort_field = $field;
            $this->sort_direction = 'desc';
        }
        $this->resetPage();
    }

    #[On('listen-alert-confirmation')]
    public function listenAlertConfirmation($do, $id)
    {
        if ($do === 'delete') {
            $this->delete($id);
        }
    }

    public function render()
    {
        $products = Product::with(['productCategory', 'ProductSubcategory', 'productTags', 'productPhotos', 'createdBy', 'updatedBy', 'publishedBy'])
            ->when($this->search !== '', fn (Builder $query) => $query->where('title', 'like', '%'. $this->search .'%'))
            ->orderBy($this->sort_field, $this->sort_direction)->paginate(10);

        $data = [
            'products' => $products,
        ];
        
        return view('livewire.dashboard.product.product-index', $data)->layout('layouts.dashboard', [
            'header' => 'Products'
        ]);
    }

    public function updateHighlight($id, $highlight)
    {
        $products = Product::where('highlight', 1)->count();

        if ($products) {
            if ($products >= 8 && $highlight == true) {
                $this->dispatch('alert-failure', title: 'Product Highlights are limited to 8 items only.');
                return;
            }
        }
        
        $product = Product::find($id);

        if ($product) {
            $product->update(['highlight' => $highlight, 'updated_by' => auth()->id()]);
            $this->dispatch('alert-success', title: 'Product Highlight Successfully Updated!');
        } else {
            $this->dispatch('alert-failure', title: 'Failed to Update Product Highlight');
        }
       
    }

    public function updateStatus($id, $status)
    {
        $product = Product::find($id);
        if ($product) {
            $product->update(['status' => $status, 'updated_by' => auth()->id()]);
            if ($product->published_by == null && $product->published_at == null) {
                $product->update(['published_by' => auth()->id(), 'published_at' => Carbon::now()]);
            }
            $this->dispatch('alert-success', title: 'Product Status Successfully Updated!');
        } else {
            $this->dispatch('alert-failure', title: 'Failed to Update Product Status');
        }
    }

    public function delete($id)
    {
        $product = Product::find($id);
        if ($product->delete()) {
            $this->dispatch('alert-success', title: 'Product Successfully Deleted!');
        } else {
            $this->dispatch('alert-failure', title: 'Failed to Delete Product');
        }
    }
}
