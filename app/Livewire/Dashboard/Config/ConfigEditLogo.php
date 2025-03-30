<?php

namespace App\Livewire\Dashboard\Config;

use App\Models\Config;
use Livewire\Attributes\On;
use Livewire\Component;

class ConfigEditLogo extends Component
{
    public $config;
    public $primary_logo;
    public $secondary_logo;
    public $favicon;

    #[On('close-modal')]
    public function closeModal()
    {
        $this->reset();
        $this->resetValidation();
    }

    #[On('listen-filemanager-picker')]
    public function filemanagerPicker($property, $path)
    {
        if ($property === 'primary_logo') {
            $this->primary_logo = $path;
        } else if ($property === 'secondary_logo') {
            $this->secondary_logo = $path;
        } else if ($property === 'favicon') {
            $this->favicon = $path;
        }
    }

    public function resetFilemanagerPicker($property)
    {
        if ($property === 'primary_logo') {
            $this->primary_logo = null;
        } else if ($property === 'secondary_logo') {
            $this->secondary_logo = null;
        } else if ($property === 'favicon') {
            $this->favicon = null;
        }
    }

    #[On('edited')]
    public function edited()
    {
        $config = Config::first();

        $this->config         = $config;
        $this->primary_logo   = $config->primary_logo;
        $this->secondary_logo = $config->secondary_logo;
        $this->favicon        = $config->favicon;

        $this->dispatch('open-modal', name: 'edit-logo-config-modal');
    }

    public function render()
    {
        return view('livewire.dashboard.config.config-edit-logo');
    }

    public function store()
    {
        $config = $this->config;

        $validated = $this->validate([
            'primary_logo' => ['nullable', 'string', 'max:255'],
            'secondary_logo' => ['nullable', 'string', 'max:255'],
            'favicon' => ['nullable', 'string', 'max:255'],
        ]);

        $validated = array_map(function ($value) {
            return $value === '' ? null : $value;
        }, $validated);

        $config->update($validated);

        if ($config) {
            $this->dispatch('config-logo-edited');
            $this->dispatch('close-modal', name: 'edit-logo-config-modal');
            $this->dispatch('alert-success', title: 'Config Logo Successfully Edited!');
        } else {
            $this->dispatch('alert-failure', title: 'Failed to Edit Config Logo');
        }
    }
}
