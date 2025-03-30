<?php

namespace App\Livewire\Dashboard\Config;

use App\Models\Config;
use Livewire\Attributes\On;
use Livewire\Component;

class ConfigEditCover extends Component
{
    public $config;
    public $cover_about;
    public $cover_product;

    #[On('close-modal')]
    public function closeModal()
    {
        $this->reset();
        $this->resetValidation();
    }

    #[On('listen-filemanager-picker')]
    public function filemanagerPicker($property, $path)
    {
        if ($property === 'cover_about') {
            $this->cover_about = $path;
        } else if ($property === 'cover_product') {
            $this->cover_product = $path;
        }
    }

    public function resetFilemanagerPicker($property)
    {
        if ($property === 'cover_about') {
            $this->cover_about = null;
        } else if ($property === 'cover_product') {
            $this->cover_product = null;
        }
    }

    #[On('edited')]
    public function edited()
    {
        $config = Config::first();

        $this->config        = $config;
        $this->cover_about   = $config->cover_about;
        $this->cover_product = $config->cover_product;

        $this->dispatch('open-modal', name: 'edit-cover-config-modal');
    }

    public function render()
    {
        return view('livewire.dashboard.config.config-edit-cover');
    }

    public function store()
    {
        $config = $this->config;

        $validated = $this->validate([
            'cover_about' => ['nullable', 'string', 'max:255'],
            'cover_product' => ['nullable', 'string', 'max:255'],
        ]);

        $validated = array_map(function ($value) {
            return $value === '' ? null : $value;
        }, $validated);

        $config->update($validated);

        if ($config) {
            $this->dispatch('config-cover-edited');
            $this->dispatch('close-modal', name: 'edit-cover-config-modal');
            $this->dispatch('alert-success', title: 'Config Cover Successfully Edited!');
        } else {
            $this->dispatch('alert-failure', title: 'Failed to Edit Config Cover');
        }
    }
}
