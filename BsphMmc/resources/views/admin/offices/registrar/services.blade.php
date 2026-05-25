@extends('admin.layouts.app')

@section('title', 'Registrar Services - Admin')

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    <!-- Header -->
    <div class="bg-white dark:bg-gray-800 shadow-sm border-b border-gray-200 dark:border-gray-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center space-x-4">
                    <a href="{{ route('admin.dashboard') }}" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </a>
                    <h1 class="text-xl font-semibold text-gray-900 dark:text-white">Registrar Services</h1>
                </div>
                <button onclick="showAddServiceModal()" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                    Add New Service
                </button>
            </div>
        </div>
    </div>

    <!-- Services List -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Icon</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Title</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Description</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Order</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse($services as $service)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($service->icon)
                                        <img src="{{ asset('storage/' . $service->icon) }}" alt="{{ $service->title }}" class="h-8 w-8 rounded">
                                    @else
                                        <div class="h-8 w-8 bg-gray-200 dark:bg-gray-600 rounded flex items-center justify-center">
                                            <span class="text-gray-500 dark:text-gray-400 text-sm">📋</span>
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $service->title }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-500 dark:text-gray-400 truncate max-w-xs">{{ Str::limit($service->description, 100) }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900 dark:text-white">{{ $service->display_order }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $service->status === 'active' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' }}">
                                        {{ ucfirst($service->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <button onclick="editService({{ $service->id }})" class="text-blue-600 dark:text-blue-400 hover:text-blue-900 dark:hover:text-blue-300 mr-3">Edit</button>
                                    <form action="{{ route('admin.offices.registrar.services.destroy', $service) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this service?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-300">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                    No services found. Click "Add New Service" to create one.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Add/Edit Service Modal -->
<div id="serviceModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-lg bg-white dark:bg-gray-800">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4" id="modalTitle">Add New Service</h3>
            
            <form id="serviceForm" action="{{ route('admin.offices.registrar.services.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="serviceId" name="service_id">
                <input type="hidden" id="formMethod" name="_method" value="POST">
                
                <!-- Title -->
                <div class="mb-4">
                    <label for="serviceTitle" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Title</label>
                    <input type="text" id="serviceTitle" name="title" required
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Description -->
                <div class="mb-4">
                    <label for="serviceDescription" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Description</label>
                    <textarea id="serviceDescription" name="description" rows="3" required
                              class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500"></textarea>
                </div>

                <!-- Icon -->
                <div class="mb-4">
                    <label for="serviceIcon" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Icon</label>
                    <input type="file" id="serviceIcon" name="icon" accept="image/*"
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Display Order -->
                <div class="mb-4">
                    <label for="serviceOrder" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Display Order</label>
                    <input type="number" id="serviceOrder" name="display_order" min="1" required
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Status -->
                <div class="mb-4">
                    <label for="serviceStatus" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Status</label>
                    <select id="serviceStatus" name="status" required
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>

                <!-- Buttons -->
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="hideServiceModal()" 
                            class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        Save Service
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function showAddServiceModal() {
    document.getElementById('modalTitle').textContent = 'Add New Service';
    document.getElementById('serviceForm').reset();
    document.getElementById('serviceForm').action = '{{ route('admin.offices.registrar.services.store') }}';
    document.getElementById('formMethod').value = 'POST';
    document.getElementById('serviceModal').classList.remove('hidden');
}

function editService(id) {
    // This would typically fetch service data via AJAX and populate the form
    // For now, we'll show a simplified version
    document.getElementById('modalTitle').textContent = 'Edit Service';
    document.getElementById('serviceForm').reset();
    document.getElementById('serviceId').value = id;
    document.getElementById('serviceForm').action = '{{ route('admin.offices.registrar.services.update', ':id') }}'.replace(':id', id);
    document.getElementById('formMethod').value = 'PUT';
    document.getElementById('serviceModal').classList.remove('hidden');
    
    // In a real implementation, you would fetch the service data here
    // and populate the form fields
}

function hideServiceModal() {
    document.getElementById('serviceModal').classList.add('hidden');
}
</script>
@endsection
