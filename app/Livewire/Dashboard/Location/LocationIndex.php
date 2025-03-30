<?php

namespace App\Livewire\Dashboard\Location;

use App\Models\Location;
use App\Models\LocationCategory;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class LocationIndex extends Component
{
    use WithPagination;

    public $location_categories;
    public $countries;
    public $provinces;
    public $cities;

    #[Url(as: 'location_category_id', except: '')]
    public string $location_category_id = '';
    #[Url(as: 'country', except: '')]
    public string $country = '';
    #[Url(as: 'province', except: '')]
    public string $province = '';
    #[Url(as: 'city', except: '')]
    public string $city = '';
    #[Url(as: 'q', except: '')]
    public string $search = '';
    #[Url(as: 'sort', except: 'created_at')]
    public string $sort_field = 'created_at';
    #[Url(as: 'direction', except: 'asc')]
    public string $sort_direction = 'asc';


    public function updating($property)
    {
        if ($property === 'location_category_id' || $property === 'country' || $property === 'province' || $property === 'city' || $property === 'search') {
            $this->resetPage();
        }
    }

    public function sortBy($field)
    {
        if ($this->sort_field === $field) {
            $this->sort_direction = $this->sort_direction === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sort_field = $field;
            $this->sort_direction = 'desc';
        }
        $this->resetPage();
    }

    #[On('listen-alert-confirmation')]
    public function listenAlertConfirmation($do, $id)
    {
        if ($do === 'delete') {
            $this->delete($id);
        }
    }

    public function mount()
    {
        $this->location_categories = LocationCategory::pluck('title', 'id')->filter()->sort();
        $this->countries = Location::distinct('country')->pluck('country')->filter()->sort()->values();
        $this->provinces = Location::distinct('province')->pluck('province')->filter()->sort()->values();
        $this->cities = Location::distinct('city')->pluck('city')->filter()->sort()->values();
    }

    public function render()
    {
        $locations = Location::with(['locationCategory', 'createdBy', 'updatedBy'])
            ->when($this->location_category_id !== '', fn (Builder $query) => $query->where('location_category_id', $this->location_category_id))
            ->when($this->country !== '', fn (Builder $query) => $query->where('country', $this->country))
            ->when($this->province !== '', fn (Builder $query) => $query->where('province', $this->province))
            ->when($this->city !== '', fn (Builder $query) => $query->where('city', $this->city))
            ->when($this->search !== '', fn (Builder $query) => $query->where('name', 'like', '%'. $this->search .'%'))
            ->orderBy($this->sort_field, $this->sort_direction)
            ->paginate(10);

        $data = [
            'locations' => $locations,
        ];

        return view('livewire.dashboard.location.location-index', $data)->layout('layouts.dashboard', [
            'header' => 'Locations'
        ]);
    }

    public function updateStatus($id, $status)
    {
        $location = Location::find($id);
        if ($location) {
            $location->update(['status' => $status, 'updated_by' => auth()->id()]);

            $this->dispatch('alert-success', title: 'Location Status Successfully Updated!');
        } else {
            $this->dispatch('alert-failure', title: 'Failed to Update Location Status');
        }
    }

    public function delete($id)
    {
        $location = Location::destroy($id);
        if ($location) {
            $this->dispatch('alert-success', title: 'Location Successfully Deleted!');
        } else {
            $this->dispatch('alert-failure', title: 'Failed to Delete Location');
        }
    }
}
