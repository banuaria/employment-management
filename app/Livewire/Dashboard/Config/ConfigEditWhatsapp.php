<?php

namespace App\Livewire\Dashboard\Config;

use App\Models\Config;
use Livewire\Attributes\On;
use Livewire\Component;

class ConfigEditWhatsapp extends Component
{
    public $config;
    public $whatsapp_phone;
    public $whatsapp_message;
    public $whatsapp_float;

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

        $this->config           = $config;
        $this->whatsapp_phone   = $config->whatsapp_phone;
        $this->whatsapp_message = $config->whatsapp_message;
        $this->whatsapp_float   = $config->whatsapp_float;

        $this->dispatch('open-modal', name: 'edit-whatsapp-config-modal');
    }

    public function render()
    {
        return view('livewire.dashboard.config.config-edit-whatsapp');
    }

    public function store()
    {
        $config = $this->config;

        $validated = $this->validate([
            'whatsapp_phone' => ['nullable', 'numeric'],
            'whatsapp_message' => ['nullable', 'string', 'max:255'],
            'whatsapp_float' => ['nullable', 'boolean'],
        ]);

        $validated = array_map(function ($value) {
            return $value === '' ? null : $value;
        }, $validated);

        $config->update($validated);

        if ($config) {
            $this->dispatch('config-whatsapp-edited');
            $this->dispatch('close-modal', name: 'edit-whatsapp-config-modal');
            $this->dispatch('alert-success', title: 'Config Whatsapp Successfully Edited!');
        } else {
            $this->dispatch('alert-failure', title: 'Failed to Edit Config Whatsapp');
        }
    }
}
