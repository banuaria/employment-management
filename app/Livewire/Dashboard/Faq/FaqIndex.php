<?php

namespace App\Livewire\Dashboard\Faq;

use App\Models\Faq;
use App\Models\FaqCategory;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class FaqIndex extends Component
{
    use WithPagination;

    public $faq_categories = [];

    #[Url(as: 'faq_category_id', except: '')]
    public string $faq_category_id = '';
    #[Url(as: 'q', except: '')]
    public string $search = '';
    #[Url(as: 'sort', except: 'created_at')]
    public string $sort_field = 'created_at';
    #[Url(as: 'direction', except: 'asc')]
    public string $sort_direction = 'asc';


    public function updating($property)
    {
        if ($property === 'faq_category_id' || $property === 'search') {
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
        $this->faq_categories = FaqCategory::pluck('title', 'id')->filter()->sort();
    }

    public function render()
    {
        $faqs = Faq::with(['faqCategory', 'createdBy', 'updatedBy'])
            ->when($this->faq_category_id !== '', fn (Builder $query) => $query->where('faq_category_id', $this->faq_category_id))
            ->when($this->search !== '', fn (Builder $query) => $query->where('question', 'like', '%'. $this->search .'%'))
            ->orderBy($this->sort_field, $this->sort_direction)
            ->paginate(10);

        $data = [
            'faqs' => $faqs,
        ];

        return view('livewire.dashboard.faq.faq-index', $data)->layout('layouts.dashboard', [
            'header' => 'Faqs'
        ]);
    }

    public function updateStatus($id, $status)
    {
        $faq = Faq::find($id);
        if ($faq) {
            $faq->update(['status' => $status, 'updated_by' => auth()->id()]);

            $this->dispatch('alert-success', title: 'Faq Status Successfully Updated!');
        } else {
            $this->dispatch('alert-failure', title: 'Failed to Update Faq Status');
        }
    }

    public function delete($id)
    {
        $faq = Faq::destroy($id);
        if ($faq) {
            $this->dispatch('alert-success', title: 'Faq Successfully Deleted!');
        } else {
            $this->dispatch('alert-failure', title: 'Failed to Delete Faq');
        }
    }
}
