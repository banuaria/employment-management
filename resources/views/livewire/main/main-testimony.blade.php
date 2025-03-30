<div class="flex flex-col space-y-4">
    @foreach ($testimonies as $testimony)
    <div class="p-4 flex flex-col bg-gray-100">
        <div class="flex space-x-1">
            <span class="whitespace-nowrap">Name :</span>
            <span class="font-bold">{{ $testimony->name }}</span>
        </div>
        <div class="flex space-x-1">
            <span class="whitespace-nowrap">Profile Pic :</span>
            <span class="font-bold">{{ $testimony->profile_pic ?? '-' }}</span>
        </div>
        <div class="flex space-x-1">
            <span class="whitespace-nowrap">Designation :</span>
            <span class="font-bold">{{ $testimony->designation ?? '-' }}</span>
        </div>
        <div class="flex space-x-1">
            <span class="whitespace-nowrap">Content :</span>
            <span class="font-bold">{{ $testimony->content }}</span>
        </div>
    </div>
    @endforeach
</div>
