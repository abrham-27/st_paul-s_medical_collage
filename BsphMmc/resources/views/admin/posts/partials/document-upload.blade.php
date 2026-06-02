<div id="document-file-field" class="hidden">
    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
        Document File <span class="text-red-500">*</span>
    </label>
    @if(isset($post) && $post->file_path)
        <div class="mb-3 p-3 rounded-lg bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600">
            <p class="text-sm text-gray-700 dark:text-gray-300 font-medium mb-1">
                <i class="fa-solid fa-file-pdf text-red-500 mr-1"></i> Current file
            </p>
            <a href="{{ $post->file_url }}" target="_blank" rel="noopener noreferrer"
               class="text-sm text-blue-600 dark:text-blue-400 hover:underline break-all">
                {{ basename($post->file_path) }}
            </a>
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Upload a new file below to replace it</p>
        </div>
    @endif
    <input type="file" name="document_file" id="document_file"
           accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.txt,.zip,.rar,.csv,.7z"
           class="w-full text-sm text-gray-600 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-blue-900 dark:file:text-blue-300">
    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
        PDF, Word, Excel, PowerPoint, ZIP, and more. Maximum size: 200 MB.
    </p>
    @error('document_file') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
</div>
