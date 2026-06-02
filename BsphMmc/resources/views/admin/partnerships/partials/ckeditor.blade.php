<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    if (!window.ClassicEditor) return;

    document.querySelectorAll('textarea.ckeditor').forEach(function (textarea) {
        ClassicEditor.create(textarea).then(function (editor) {
            const form = textarea.closest('form');
            if (form) {
                form.addEventListener('submit', function () {
                    textarea.value = editor.getData();
                });
            }
        }).catch(function (error) {
            console.error(error);
        });
    });
});
</script>
