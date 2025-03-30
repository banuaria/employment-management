<div>
    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">Name</th>
                @foreach ($vendors as $vendor)
                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">{{ $vendor->name }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($employees as $employee)
            <tr class="bg-white border-b">
                    <td class="px-4 py-3 border-r">{{ $employee->name }}</td>
                    @foreach ($vendors as $vendor)
                        <td class="px-4 py-3 border-r">
                            <input type="checkbox"
                                   wire:click="toggleVendor({{ $employee->id }}, {{ $vendor->id }})"
                                   {{ in_array($vendor->id, $selectedVendors[$employee->id] ?? []) ? 'checked' : '' }}>
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
