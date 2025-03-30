<?php

namespace App\Livewire\Dashboard\Config;

use App\Models\Config;
use Livewire\Attributes\On;
use Livewire\Component;

class ConfigEditMetaSeo extends Component
{
    public $config;
    public $meta_title;
    public $meta_desc;
    public $meta_keywords;

    #[On('close-modal')]
    public function closeModal()
    {
        $this->reset();
        $this->resetValidation();
    }

    #[On('edited')]
    public function edited()
    {
        $config = Config::first();

        $this->config        = $config;
        $this->meta_title    = $config->meta_title;
        $this->meta_desc     = $config->meta_desc;
        $this->meta_keywords = $config->meta_keywords;

        $this->dispatch('open-modal', name: 'edit-meta-seo-config-modal');
    }

    public function render()
    {
        return view('livewire.dashboard.config.config-edit-meta-seo');
    }

    public function store()
    {
        $config = $this->config;

        $validated = $this->validate([
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_desc' => ['nullable', 'string', 'max:255'],
            'meta_keywords' => ['nullable', 'string', 'max:255'],
        ]);

        $validated = array_map(function ($value) {
            return $value === '' ? null : $value;
        }, $validated);

        $config->update($validated);

        if ($config) {
            $this->dispatch('config-meta-seo-edited');
            $this->dispatch('close-modal', name: 'edit-meta-seo-config-modal');
            $this->dispatch('alert-success', title: 'Config Meta SEO Successfully Edited!');
        } else {
            $this->dispatch('alert-failure', title: 'Failed to Edit Config Meta SEO');
        }
    }
}
