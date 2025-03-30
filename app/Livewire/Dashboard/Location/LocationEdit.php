<?php

namespace App\Livewire\Dashboard\Location;

use App\Models\Location;
use Livewire\Attributes\On;
use Livewire\Component;

class LocationEdit extends Component
{
    public $location;
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
        $this->reset('location');
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

    #[On('edited')]
    public function edited($id)
    {
        $location = Location::find($id);

        $this->location             = $location;
        $this->location_category_id = $location->location_category_id;
        $this->name                 = $location->name;
        $this->address              = $location->address;
        $this->email                = $location->email;
        $this->phone                = $location->phone;
        $this->mobile               = $location->mobile;
        $this->fax                  = $location->fax;
        $this->detail               = $location->detail;
        $this->desc                 = $location->desc;
        $this->country              = $location->country;
        $this->province             = $location->province;
        $this->city                 = $location->city;
        $this->latitude             = $location->latitude;
        $this->longitude            = $location->longitude;

        $this->dispatch('modal-refresh');
        $this->dispatch('open-modal', name: 'edit-location-modal');
    }

    public function render()
    {
        return view('livewire.dashboard.location.location-edit');
    }

    public function store()
    {
        $location = $this->location;

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

        $validated['updated_by'] = auth()->id();

        try {
            $location->update($validated);

            $this->dispatch('location-edited');
            $this->dispatch('close-modal', name: 'edit-location-modal');
            $this->dispatch('alert-success', title: 'Location Successfully Edited!');
        } catch (\Exception $e) {
            $this->dispatch('alert-failure', title: 'Failed to Edit Location');
        }
    }
}
