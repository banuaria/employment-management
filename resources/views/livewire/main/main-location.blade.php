<div class="flex flex-col space-y-4">
    @foreach ($locations as $location)
    <div class="p-4 flex flex-col bg-gray-100">
        <div class="flex space-x-1">
            <span class="whitespace-nowrap">Name :</span>
            <span class="font-bold">{{ $location->name }}</span>
        </div>
        <div class="flex space-x-1">
            <span class="whitespace-nowrap">Address :</span>
            <span class="font-bold">{{ $location->address }}</span>
        </div>
        <div class="flex space-x-1">
            <span class="whitespace-nowrap">Email :</span>
            <span class="font-bold">{{ $location->email }}</span>
        </div>
        <div class="flex space-x-1">
            <span class="whitespace-nowrap">Phone :</span>
            <span class="font-bold">{{ $location->phone }}</span>
        </div>
        <div class="flex space-x-1">
            <span class="whitespace-nowrap">Mobile :</span>
            <span class="font-bold">{{ $location->mobile }}</span>
        </div>
        <div class="flex space-x-1">
            <span class="whitespace-nowrap">Fax :</span>
            <span class="font-bold">{{ $location->fax }}</span>
        </div>
        <div class="flex space-x-1">
            <span class="whitespace-nowrap">Detail :</span>
            <span class="font-bold">{{ $location->detail }}</span>
        </div>
        <div class="flex space-x-1">
            <span class="whitespace-nowrap">Desc :</span>
            <span class="font-bold">{!! $location->desc !!}</span>
        </div>
        <div class="flex space-x-1">
            <span class="whitespace-nowrap">Country :</span>
            <span class="font-bold">{{ $location->country }}</span>
        </div>
        <div class="flex space-x-1">
            <span class="whitespace-nowrap">Province :</span>
            <span class="font-bold">{{ $location->province }}</span>
        </div>
        <div class="flex space-x-1">
            <span class="whitespace-nowrap">City :</span>
            <span class="font-bold">{{ $location->city }}</span>
        </div>
        <div class="flex space-x-1">
            <span class="whitespace-nowrap">Latitude :</span>
            <span class="font-bold">{{ $location->latitude }}</span>
        </div>
        <div class="flex space-x-1">
            <span class="whitespace-nowrap">Longitude :</span>
            <span class="font-bold">{{ $location->longitude }}</span>
        </div>
    </div>
    @endforeach
</div>
