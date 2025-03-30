<?php

namespace App\Livewire\Dashboard\ProductSubcategory;

use App\Models\ProductCategory;
use App\Models\ProductSubcategory;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class ProductSubcategoryIndex extends Component
{
    use WithPagination;

    public $product_categories = [];

    #[Url(as: 'product_category_id', except: '')]
    public string $product_category_id = '';
    #[Url(as: 'q', except: '')]
    public string $search = '';
    #[Url(as: 'sort', except: 'created_at')]
    public string $sort_field = 'created_at';
    #[Url(as: 'direction', except: 'asc')]
    public string $sort_direction = 'asc';

    public function updating($property)
    {
        if ($property === 'product_category_id' || $property === 'search') {
            $this->resetPage();
        }
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

    public function mount()
    {
        $this->product_categories = ProductCategory::pluck('title', 'id')->filter()->sort();
    }

    public function render()
    {
        $product_subcategories = ProductSubcategory::with(['productCategory', 'createdBy', 'updatedBy'])
            ->when($this->product_category_id !== '', fn (Builder $query) => $query->where('product_category_id', $this->product_category_id))
            ->when($this->search !== '', fn (Builder $query) => $query->where('title', 'like', '%'. $this->search .'%'))
            ->orderBy($this->sort_field, $this->sort_direction)->paginate(10);

        $data = [
            'product_subcategories' => $product_subcategories,
        ];

        return view('livewire.dashboard.product-subcategory.product-subcategory-index', $data)->layout('layouts.dashboard', [
            'header' => 'Product Subcategories'
        ]);
    }

    public function updateStatus($id, $status)
    {
        $product_subcategory = ProductSubcategory::find($id);
        if ($product_subcategory) {
            $product_subcategory->update(['status' => $status, 'updated_by' => auth()->id()]);

            $this->dispatch('alert-success', title: 'Product Subcategory Status Successfully Updated!');
        } else {
            $this->dispatch('alert-failure', title: 'Failed to Update Product Subcategory Status');
        }
    }

    public function delete($id)
    {
        $product_subcategory = ProductSubcategory::with('products')->find($id);

        if ($product_subcategory->products->isNotEmpty()) {
            $this->dispatch('alert-failure', title: 'Cannot delete subcategory because it has associated products.');
            return;
        }

        if ($product_subcategory->delete()) {
            $this->dispatch('alert-success', title: 'Product Subcategory Successfully Deleted!');
        } else {
            $this->dispatch('alert-failure', title: 'Failed to Delete Product Subcategory');
        }
    }
}
