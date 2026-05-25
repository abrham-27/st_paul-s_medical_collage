@extends('admin.layouts.app')

@section('title', 'Add Staff Member')
@section('page-title', 'Add Staff Member')

@section('content')
<div class="py-6 max-w-2xl">

    @if($errors->any())
        <div class="mb-4 p-3 bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-700 rounded-lg text-sm text-red-700 dark:text-red-300">
            <ul class="list-disc list-inside space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
        <form method="POST" action="{{ route('admin.academic-staffs.store') }}" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">School <span class="text-red-500">*</span></label>
                    <select name="school_type" required
                            class="w-full px-4 py-2.5 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none">
                        <option value="">Select school</option>
                        <option value="medicine"      {{ old('school_type') === 'medicine'      ? 'selected' : '' }}>School of Medicine</option>
                        <option value="nursing"       {{ old('school_type') === 'nursing'       ? 'selected' : '' }}>School of Nursing</option>
                        <option value="public_health" {{ old('school_type') === 'public_health' ? 'selected' : '' }}>School of Public Health</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Status <span class="text-red-500">*</span></label>
                    <select name="status" required
                            class="w-full px-4 py-2.5 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none">
                        <option value="active"   {{ old('status', 'active') === 'active'   ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Full Name <span class="text-red-500">*</span></label>
                <input type="text" name="full_name" value="{{ old('full_name') }}" required
                       class="w-full px-4 py-2.5 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Position <span class="text-red-500">*</span></label>
                    <input type="text" name="position" value="{{ old('position') }}" required
                           placeholder="e.g. Associate Professor"
                           class="w-full px-4 py-2.5 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Department</label>
                    <select id="department_select"
                            class="w-full px-4 py-2.5 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none"
                            disabled>
                        <option value="">Select a school first</option>
                    </select>
                    <input type="hidden" name="department" id="department_input" value="{{ old('department', '') }}">
                    <input type="text" id="department_custom_input" value="{{ old('department', '') }}"
                           placeholder="Enter a custom department"
                           class="w-full px-4 py-2.5 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none mt-3 hidden">
                    <p id="department_help" class="text-xs text-gray-500 dark:text-gray-400 mt-2">Select a department for the chosen school, or choose "Other" to type a custom department.</p>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Rank</label>
                <input type="text" name="qualification" value="{{ old('qualification') }}"
                       placeholder="e.g. MD, PhD"
                       class="w-full px-4 py-2.5 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Biography</label>
                <textarea name="biography" rows="4"
                placeholder="Write a brief biography of the staff member (educational background, research interests, publications) "
                          class="w-full px-4 py-2.5 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none resize-none rich-editor">{{ old('biography') }} </textarea>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                           class="w-full px-4 py-2.5 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Phone</label>
                    <input type="text" name="phone" value="{{ old('phone') }}"
                           class="w-full px-4 py-2.5 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Profile Image</label>
                    <input type="file" name="profile_image" accept="image/*"
                           class="w-full text-sm text-gray-600 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-blue-900 dark:file:text-blue-300">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Display Order</label>
                    <input type="number" name="display_order" value="{{ old('display_order', 0) }}" min="0"
                           class="w-full px-4 py-2.5 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit"
                        class="px-6 py-2.5 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition">
                    Create Staff
                </button>
                <a href="{{ route('admin.academic-staffs.index') }}"
                   class="px-6 py-2.5 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 text-sm font-medium rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>

<script>
(function() {
    const schoolSelect = document.querySelector('[name="school_type"]');
    const departmentSelect = document.getElementById('department_select');
    const departmentInput = document.getElementById('department_input');
    const departmentCustom = document.getElementById('department_custom_input');
    const departmentHelp = document.getElementById('department_help');
    const otherValue = '__other__';

    const loadDepartments = async (school) => {
        if (!school) {
            departmentSelect.innerHTML = '<option value="">Select a school first</option>';
            departmentSelect.disabled = true;
            departmentCustom.classList.add('hidden');
            return;
        }

        departmentSelect.disabled = true;
        departmentSelect.innerHTML = '<option value="">Loading departments...</option>';

        try {
            const response = await fetch(`/api/academics/${school}/departments`);
            const payload = await response.json();
            if (!payload.success || !Array.isArray(payload.data)) {
                throw new Error('Invalid department response');
            }

            departmentSelect.innerHTML = '';
            const placeholder = document.createElement('option');
            placeholder.value = '';
            placeholder.textContent = 'Select department';
            placeholder.disabled = true;
            placeholder.selected = true;
            departmentSelect.appendChild(placeholder);

            payload.data.forEach((item) => {
                const option = document.createElement('option');
                option.value = item.value;
                option.textContent = item.label;
                departmentSelect.appendChild(option);
            });

            const otherOption = document.createElement('option');
            otherOption.value = otherValue;
            otherOption.textContent = 'Other (manual entry)';
            departmentSelect.appendChild(otherOption);

            departmentSelect.disabled = false;

            if (departmentInput.value) {
                const existingOption = Array.from(departmentSelect.options).find((option) => option.value === departmentInput.value);
                if (existingOption) {
                    departmentSelect.value = departmentInput.value;
                    departmentCustom.classList.add('hidden');
                } else {
                    departmentSelect.value = otherValue;
                    departmentCustom.classList.remove('hidden');
                }
            }
        } catch (error) {
            departmentSelect.innerHTML = '<option value="">Unable to load departments</option>';
            departmentSelect.disabled = true;
            departmentCustom.classList.remove('hidden');
        }
    };

    const updateDepartmentValue = () => {
        if (departmentSelect.value === otherValue) {
            departmentCustom.classList.remove('hidden');
            departmentInput.value = departmentCustom.value;
        } else {
            departmentCustom.classList.add('hidden');
            departmentInput.value = departmentSelect.value || '';
        }
    };

    schoolSelect.addEventListener('change', () => {
        departmentInput.value = '';
        departmentCustom.value = '';
        loadDepartments(schoolSelect.value);
    });

    departmentSelect.addEventListener('change', updateDepartmentValue);
    departmentCustom.addEventListener('input', () => {
        departmentInput.value = departmentCustom.value;
    });

    loadDepartments(schoolSelect.value);
})();
</script>
@endsection
