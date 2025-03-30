<?php

namespace App\Livewire\Dashboard\Config;

use App\Models\Config;
use Livewire\Attributes\On;
use Livewire\Component;

class ConfigEditSocialMedia extends Component
{
    public $config;
    public $instagram;
    public $facebook;
    public $x;
    public $linkedin;
    public $youtube;
    public $tiktok;

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

        $this->config    = $config;
        $this->instagram = $config->instagram;
        $this->facebook  = $config->facebook;
        $this->x         = $config->x;
        $this->linkedin  = $config->linkedin;
        $this->youtube   = $config->youtube;
        $this->tiktok    = $config->tiktok;

        $this->dispatch('open-modal', name: 'edit-social-media-config-modal');
    }

    public function render()
    {
        return view('livewire.dashboard.config.config-edit-social-media');
    }

    public function store()
    {
        $config = $this->config;

        $validated = $this->validate([
            'instagram' => ['nullable', 'string', 'max:255', 'url'],
            'facebook' => ['nullable', 'string', 'max:255', 'url'],
            'x' => ['nullable', 'string', 'max:255', 'url'],
            'linkedin' => ['nullable', 'string', 'max:255', 'url'],
            'youtube' => ['nullable', 'string', 'max:255', 'url'],
            'tiktok' => ['nullable', 'string', 'max:255', 'url'],
        ]);

        $validated = array_map(function ($value) {
            return $value === '' ? null : $value;
        }, $validated);

        $config->update($validated);

        if ($config) {
            $this->dispatch('config-social-media-edited');
            $this->dispatch('close-modal', name: 'edit-social-media-config-modal');
            $this->dispatch('alert-success', title: 'Config Social Media Successfully Edited!');
        } else {
            $this->dispatch('alert-failure', title: 'Failed to Edit Config Social Media');
        }
    }
}
