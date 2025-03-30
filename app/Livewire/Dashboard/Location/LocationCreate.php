<?php

namespace App\Livewire\Dashboard\Location;

use App\Models\Location;
use Livewire\Attributes\On;
use Livewire\Component;

class LocationCreate extends Component
{
    public $location_categories = [];
    public $location_category_id = '';
    public $name = '';
    public $address = '';
    public $email = '';
    public $phone = '';
    public $mobile = '';
    public $fax = '';
    public $detail = '';
    public $desc = '';
    public $country = '';
    public $province = '';
    public $city = '';
    public $latitude = '';
    public $longitude = '';

    public function validationAttributes()
    {
        $attributes = [];
        $attributes["location_category_id"] = 'category';
        return $attributes;
    }

    #[On('close-modal')]
    public function closeModal()
    {
        $this->reset('location_category_id');
        $this->reset('name');
        $this->reset('address');
        $this->reset('email');
        $this->reset('phone');
        $this->reset('mobile');
        $this->reset('fax');
        $this->reset('detail');
        $this->reset('desc');
        $this->reset('country');
        $this->reset('province');
        $this->reset('city');
        $this->reset('latitude');
        $this->reset('longitude');
        $this->resetValidation();
    }

    #[On('tinymce-textarea')]
    public function tinymceTextarea($value, $textareaId)
    {
        if ($textareaId === '1') {
            $this->desc = $value;
        }
    }

    #[On('created')]
    public function created()
    {
        $this->dispatch('modal-refresh');
        $this->dispatch('open-modal', name: 'create-location-modal');
    }

    public function render()
    {
        return view('livewire.dashboard.location.location-create');
    }

    public function store()
    {
        $validated = $this->validate([
            'location_category_id' => ['required'],
            'name'                 => ['required', 'string', 'max:255'],
            'address'              => ['nullable', 'string', 'max:255'],
            'email'                => ['nullable', 'string', 'max:255'],
            'phone'                => ['nullable', 'string', 'max:255'],
            'mobile'               => ['nullable', 'string', 'max:255'],
            'fax'                  => ['nullable', 'string', 'max:255'],
            'detail'               => ['nullable', 'string', 'max:255'],
            'desc'                 => ['nullable', 'string', 'max:255'],
            'country'              => ['nullable', 'string', 'max:255'],
            'province'             => ['nullable', 'string', 'max:255'],
            'city'                 => ['nullable', 'string', 'max:255'],
            'latitude'             => ['nullable', 'numeric', 'min:-90', 'max:90'],
            'longitude'            => ['nullable', 'numeric', 'min:-180', 'max:180'],
        ]);

        $validated = array_map(function ($value) {
            return $value === '' ? null : $value;
        }, $validated);

        $validated['created_by'] = auth()->id();
        $validated['updated_by'] = auth()->id();

        try {
            Location::create($validated);

            $this->dispatch('location-created');
            $this->dispatch('close-modal', name: 'create-location-modal');
            $this->dispatch('alert-success', title: 'Location Successfully Created!');
        } catch (\Exception $e) {
            $this->dispatch('alert-failure', title: 'Failed to Create Location');
        }
    }
}
