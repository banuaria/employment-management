<?php

namespace App\Livewire\Dashboard\Config;

use App\Models\Config;
use Livewire\Attributes\On;
use Livewire\Component;

class ConfigEditIntegration extends Component
{
    public $config;
    public $head_tag;
    public $body_tag;
    public $google_map_tag;

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

        $this->config         = $config;
        $this->head_tag       = $config->head_tag;
        $this->body_tag       = $config->body_tag;
        $this->google_map_tag = $config->google_map_tag;

        $this->dispatch('open-modal', name: 'edit-integration-config-modal');
    }

    public function render()
    {
        return view('livewire.dashboard.config.config-edit-integration');
    }

    public function store()
    {
        $config = $this->config;

        $validated = $this->validate([
            'head_tag' => ['nullable', 'string'],
            'body_tag' => ['nullable', 'string'],
            'google_map_tag' => ['nullable', 'string'],
        ]);

        $validated = array_map(function ($value) {
            return $value === '' ? null : $value;
        }, $validated);

        $config->update($validated);

        if ($config) {
            $this->dispatch('config-integration-edited');
            $this->dispatch('close-modal', name: 'edit-integration-config-modal');
            $this->dispatch('alert-success', title: 'Config Integration Successfully Edited!');
        } else {
            $this->dispatch('alert-failure', title: 'Failed to Edit Config Integration');
        }
    }
}
