<?php

namespace App\Livewire\Dashboard\Feature;

use App\Models\Feature;
use Livewire\Attributes\On;
use Livewire\Component;

class FeatureIndex extends Component
{
    #[On('listen-alert-confirmation')]
    public function listenAlertConfirmation($do, $id)
    {
        if ($do === 'delete') {
            $this->delete($id);
        }
    }

    public function render()
    {
        $features = Feature::with(['createdBy', 'updatedBy'])
            ->paginate(10);
       
        $data = [
            'features' => $features,
        ];

        return view('livewire.dashboard.feature.feature-index', $data);
    }

    public function updateStatus($id, $status)
    {
        $feature = Feature::find($id);
        if ($feature) {
            $feature->update(['status' => $status, 'updated_by' => auth()->id()]);

            $this->dispatch('alert-success', title: 'Feature Status Successfully Updated!');
        } else {
            $this->dispatch('alert-failure', title: 'Failed to Update Feature Status');
        }
    }

    public function delete($id)
    {
        $feature = Feature::destroy($id);
        if ($feature) {
            $this->dispatch('alert-success', title: 'Feature Successfully Deleted!');
        } else {
            $this->dispatch('alert-failure', title: 'Failed to Delete Feature');
        }
    }
}
