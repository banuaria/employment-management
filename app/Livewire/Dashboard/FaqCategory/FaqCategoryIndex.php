<?php

namespace App\Livewire\Dashboard\FaqCategory;

use App\Models\FaqCategory;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class FaqCategoryIndex extends Component
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
        $faq_categories = FaqCategory::with(['createdBy', 'updatedBy'])
            ->when($this->search !== '', fn (Builder $query) => $query->where('title', 'like', '%'. $this->search .'%'))
            ->orderBy($this->sort_field, $this->sort_direction)->paginate(10);

        $data = [
            'faq_categories' => $faq_categories,
        ];
        
        return view('livewire.dashboard.faq-category.faq-category-index', $data)->layout('layouts.dashboard', [
            'header' => 'Faq Categories'
        ]);
    }

    public function updateStatus($id, $status)
    {
        $faq_category = FaqCategory::find($id);
        if ($faq_category) {
            $faq_category->update(['status' => $status, 'updated_by' => auth()->id()]);

            $this->dispatch('alert-success', title: 'Faq Category Status Successfully Updated!');
        } else {
            $this->dispatch('alert-failure', title: 'Failed to Update Faq Category Status');
        }
    }

    public function delete($id)
    {
        $faq_category = FaqCategory::destroy($id);
        if ($faq_category) {
            $this->dispatch('alert-success', title: 'Faq Category Successfully Deleted!');
        } else {
            $this->dispatch('alert-failure', title: 'Failed to Delete Faq Category');
        }
    }
}
