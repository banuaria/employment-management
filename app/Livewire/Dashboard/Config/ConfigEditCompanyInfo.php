<?php

namespace App\Livewire\Dashboard\Config;

use App\Models\Config;
use Livewire\Attributes\On;
use Livewire\Component;

class ConfigEditCompanyInfo extends Component
{
    public $config;
    public $company_name;
    public $address;
    public $email;
    public $phone;
    public $mobile;
    public $fax;

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

        $this->config       = $config;
        $this->company_name = $config->company_name;
        $this->address      = $config->address;
        $this->email        = $config->email;
        $this->phone        = $config->phone;
        $this->mobile       = $config->mobile;
        $this->fax          = $config->fax;

        $this->dispatch('open-modal', name: 'edit-company-info-config-modal');
    }

    public function render()
    {
        return view('livewire.dashboard.config.config-edit-company-info');
    }

    public function store()
    {
        $config = $this->config;

        $validated = $this->validate([
            'company_name' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'string', 'lowercase', 'email', 'max:255'],
            'phone' => ['nullable', 'numeric'],
            'mobile' => ['nullable', 'numeric'],
            'fax' => ['nullable', 'numeric'],
        ]);

        $validated = array_map(function ($value) {
            return $value === '' ? null : $value;
        }, $validated);

        $config->update($validated);

        if ($config) {
            $this->dispatch('config-company-info-edited');
            $this->dispatch('close-modal', name: 'edit-company-info-config-modal');
            $this->dispatch('alert-success', title: 'Config Company Info Successfully Edited!');
        } else {
            $this->dispatch('alert-failure', title: 'Failed to Edit Config Company Info');
        }
    }
}
