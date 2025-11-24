@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-6">
                <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $room->name }}</h1>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Room Image -->
                    <div class="space-y-4">
                        <div class="aspect-w-16 aspect-h-9 bg-gray-200 rounded-lg overflow-hidden">
                            @if($room->image)
                                <img src="{{ asset('storage/' . $room->image) }}" alt="{{ $room->name }}" class="w-full h-64 object-cover">
                            @else
                                <div class="w-full h-64 bg-gray-300 flex items-center justify-center">
                                    <span class="text-gray-500">No Image</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Room Details -->
                    <div class="space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Type</label>
                                <p class="text-lg font-semibold">{{ $room->display_type }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Price</label>
                                <p class="text-lg font-semibold text-green-600">Rp {{ number_format($room->price, 0, ',', '.') }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Capacity</label>
                                <p class="text-lg">{{ $room->capacity }} people</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Size</label>
                                <p class="text-lg">{{ $room->size }}</p>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Facilities</label>
                            <div class="flex flex-wrap gap-2">
                                @foreach($room->facilities as $facility)
                                    <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">{{ $facility }}</span>
                                @endforeach
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                            <span class="px-3 py-1 rounded-full text-sm {{ $room->is_available ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $room->is_available ? 'Available' : 'Not Available' }}
                            </span>
                        </div>

                        @if($room->description)
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                                <p class="text-gray-700">{{ $room->description }}</p>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="mt-8 flex justify-between">
                    <a href="{{ route('rooms.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                        Back to Rooms
                    </a>

                    @if(Auth::check() && Auth::user()->is_admin)
                        <div class="space-x-2">
                            <a href="{{ route('rooms.edit', $room->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Edit Room
                            </a>
                            <form method="POST" action="{{ route('rooms.destroy', $room->id) }}" class="inline" onsubmit="return confirm('Are you sure you want to delete this room?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                    Delete Room
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
