<?php

namespace App\Livewire\Main;

use App\Models\Faq;
use App\Models\FaqCategory;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class MainFaq extends Component
{
    public $faq_categories = [];

    public string $faq_category_id = '';
    public string $sort_field = 'created_at';
    public string $sort_direction = 'asc';

    public function mount()
    {
        $this->faq_categories = FaqCategory::pluck('title', 'id');
        $this->faq_category_id = collect($this->faq_categories)->keys()->first();
    }

    public function render()
    {
        $faqs = Faq::with(['faqCategory', 'createdBy'])
            ->active()
            ->when($this->faq_category_id !== '', fn (Builder $query) => $query->where('faq_category_id', $this->faq_category_id))
            ->orderBy($this->sort_field, $this->sort_direction)->get();
        
        $data = [
            'faqs' => $faqs,
        ];

        return view('livewire.main.main-faq', $data)->layout('layouts.main');
    }

    public function setActive($id)
    {
        $this->faq_category_id = $id;
        $this->dispatch('flowbite-refresh');
    }
}