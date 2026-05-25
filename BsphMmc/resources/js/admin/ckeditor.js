import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
const uploadUrl = `${window.location.origin}/admin/editor/upload`;

const initializeRichEditors = () => {
    document.querySelectorAll('textarea.rich-editor').forEach((editor) => {
        ClassicEditor.create(editor, {
            simpleUpload: {
                uploadUrl,
                headers: {
                    'X-CSRF-TOKEN': csrfToken || '',
                },
            },
            toolbar: [
                'heading',
                '|',
                'bold',
                'italic',
                'link',
                'bulletedList',
                'numberedList',
                'blockQuote',
                'insertTable',
                'uploadImage',
                'undo',
                'redo',
            ],
            image: {
                toolbar: [
                    'imageTextAlternative',
                    'imageStyle:full',
                    'imageStyle:side',
                ],
            },
        })
            .catch((error) => {
                console.error('Failed to initialize CKEditor on', editor, error);
            });
    });
};

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initializeRichEditors);
} else {
    initializeRichEditors();
}

