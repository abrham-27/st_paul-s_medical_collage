@extends('admin.layouts.app')

@section('title', 'Research Goals - Admin')

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
                    <h1 class="text-xl font-semibold text-gray-900 dark:text-white">Research Goals</h1>
                </div>
                <div class="flex space-x-2">
                    <a href="{{ route('admin.research.overview') }}" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition">
                        Back to Overview
                    </a>
                    <button onclick="showAddGoalModal()" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        Add New Goal
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Goals List -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Title</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Description</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Order</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse($goals as $goal)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $goal->title }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-500 dark:text-gray-400 truncate max-w-xs">{{ Str::limit($goal->description, 100) }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900 dark:text-white">{{ $goal->display_order }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $goal->status === 'active' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' }}">
                                        {{ ucfirst($goal->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="{{ route('admin.research.goals.edit', $goal) }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-900 dark:hover:text-blue-300 mr-3">Edit</a>
                                    <form action="{{ route('admin.research.goals.destroy', $goal) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this goal?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-300">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-gray-500 dark:text-gray-400">
                                    <div class="flex flex-col items-center space-y-2">
                                        <i class="fas fa-trophy text-3xl"></i>
                                        <p>No goals found. Click "Add New Goal" to create your first goal.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Add Goal Modal -->
<div id="goalModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
    <div class="relative min-h-screen flex items-center justify-center p-4">
        <div class="relative bg-white dark:bg-gray-800 rounded-lg text-left shadow-xl transform transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
            <div class="flex items-center justify-between border-b border-gray-200 dark:border-gray-700 pb-4">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">Add New Goal</h3>
                <button onclick="hideAddGoalModal()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form action="{{ route('admin.research.goals.store') }}" method="POST" class="mt-4">
                @csrf
                <div class="space-y-4">
                    <!-- Title -->
                    <div>
                        <label for="goalTitle" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Title</label>
                        <input type="text" 
                               id="goalTitle" 
                               name="title" 
                               class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               required>
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="goalDescription" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Description</label>
                        <textarea id="goalDescription" 
                                  name="description" 
                                  rows="4"
                                  class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent rich-editor"></textarea>
                    </div>

                    <!-- Display Order -->
                    <div>
                        <label for="goalOrder" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Display Order</label>
                        <input type="number" 
                               id="goalOrder" 
                               name="display_order" 
                               min="1"
                               value="1"
                               class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               required>
                    </div>

                    <!-- Buttons -->
                    <div class="flex justify-end space-x-3">
                        <button onclick="hideAddGoalModal()" type="button" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition focus:outline-none focus:ring-2 focus:ring-blue-500">
                            Add Goal
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Goal Modal -->
<div id="editGoalModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
    <div class="relative min-h-screen flex items-center justify-center p-4">
        <div class="relative bg-white dark:bg-gray-800 rounded-lg text-left shadow-xl transform transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
            <div class="flex items-center justify-between border-b border-gray-200 dark:border-gray-700 pb-4">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">Edit Goal</h3>
                <button onclick="hideEditGoalModal()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form id="editGoalForm" class="mt-4">
                @csrf
                <div class="space-y-4">
                    <!-- Title -->
                    <div>
                        <label for="editGoalTitle" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Title</label>
                        <input type="text" 
                               id="editGoalTitle" 
                               name="title" 
                               class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               required>
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="editGoalDescription" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Description</label>
                        <textarea id="editGoalDescription" 
                                  name="description" 
                                  rows="4"
                                  class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent rich-editor"></textarea>
                    </div>

                    <!-- Display Order -->
                    <div>
                        <label for="editGoalOrder" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Display Order</label>
                        <input type="number" 
                               id="editGoalOrder" 
                               name="display_order" 
                               min="1"
                               class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               required>
                    </div>

                    <!-- Buttons -->
                    <div class="flex justify-end space-x-3">
                        <button onclick="hideEditGoalModal()" type="button" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition focus:outline-none focus:ring-2 focus:ring-blue-500">
                            Update Goal
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function showAddGoalModal() {
    document.getElementById('goalModal').classList.remove('hidden');
}

function hideAddGoalModal() {
    document.getElementById('goalModal').classList.add('hidden');
}

function showEditGoalModal(goalId, title, description, order) {
    const form = document.getElementById('editGoalForm');
    form.action = `/admin/research/goals/${goalId}`;
    document.getElementById('editGoalTitle').value = title;
    document.getElementById('editGoalDescription').value = description;
    document.getElementById('editGoalOrder').value = order;
    
    // Add method override for PUT
    let methodInput = document.createElement('input');
    methodInput.type = 'hidden';
    methodInput.name = '_method';
    methodInput.value = 'PUT';
    form.appendChild(methodInput);
    
    document.getElementById('editGoalModal').classList.remove('hidden');
}

function hideEditGoalModal() {
    document.getElementById('editGoalModal').classList.add('hidden');
}

// Edit goal button click handler
document.addEventListener('DOMContentLoaded', function() {
    const editButtons = document.querySelectorAll('[onclick*="showEditGoalModal"]');
    editButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const goalId = this.getAttribute('data-goal-id');
            const title = this.getAttribute('data-title');
            const description = this.getAttribute('data-description');
            const order = this.getAttribute('data-order');
            showEditGoalModal(goalId, title, description, order);
        });
    });
});
</script>
@endsection
