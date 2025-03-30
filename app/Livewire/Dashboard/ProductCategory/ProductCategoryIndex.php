<?php

namespace App\Livewire\Dashboard\ProductCategory;

use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class ProductCategoryIndex extends Component
{
    use WithPagination;

    #[Url(as: 'q', except: '')]
    public string $search = '';
    #[Url(as: 'sort', except: 'created_at')]
    public string $sort_field = 'created_at';
    #[Url(as: 'direction', except: 'asc')]
    public string $sort_direction = 'asc';

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
        $product_categories = ProductCategory::with(['productSubcategories', 'productTags', 'createdBy', 'updatedBy'])
            ->when($this->search !== '', fn (Builder $query) => $query->where('title', 'like', '%'. $this->search .'%'))
            ->orderBy($this->sort_field, $this->sort_direction)->paginate(10);

        $data = [
            'product_categories' => $product_categories,
        ];

        return view('livewire.dashboard.product-category.product-category-index', $data)->layout('layouts.dashboard', [
            'header' => 'Product Categories'
        ]);
    }

    public function updateStatus($id, $status)
    {
        $product_category = ProductCategory::find($id);
        if ($product_category) {
            $product_category->update(['status' => $status, 'updated_by' => auth()->id()]);

            $this->dispatch('alert-success', title: 'Product Category Status Successfully Updated!');
        } else {
            $this->dispatch('alert-failure', title: 'Failed to Update Product Category Status');
        }
    }

    public function delete($id)
    {
        $product_category = ProductCategory::with(['productSubcategories', 'products'])->find($id);

        if ($product_category->productSubcategories->isNotEmpty() || $product_category->products->isNotEmpty()) {
            $this->dispatch('alert-failure', title: 'Cannot delete category because it has associated products or subcategories.');
            return;
        }

        if ($product_category->delete()) {
            $this->dispatch('alert-success', title: 'Product Category Successfully Deleted!');
        } else {
            $this->dispatch('alert-failure', title: 'Failed to Delete Product Category');
        }
    }
}
