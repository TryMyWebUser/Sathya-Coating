<!-- Bootstrap bundle JS -->
<script src="assets/js/bootstrap.bundle.min.js"></script>
<!--plugins-->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
<script src="assets/plugins/metismenu/js/metisMenu.min.js"></script>
<script src="assets/plugins/easyPieChart/jquery.easypiechart.js"></script>
<script src="assets/plugins/peity/jquery.peity.min.js"></script>
<script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
<script src="assets/js/pace.min.js"></script>
<script src="assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
<script src="assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="assets/plugins/apexcharts-bundle/js/apexcharts.min.js"></script>
<script src="assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
<script src="assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
<!--app-->
<script src="assets/js/app.js"></script>
<script src="assets/js/index.js"></script>

<script>
    new PerfectScrollbar(".best-product");
    new PerfectScrollbar(".top-sellers-list");
<<<<<<< HEAD
=======
</script>

<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const toolbarOptions = [
            ['bold', 'italic', 'underline', 'strike'],
            ['blockquote', 'code-block'],
            ['link', 'image', 'video', 'formula'],
            [{ 'header': 1 }, { 'header': 2 }],
            [{ 'list': 'ordered' }, { 'list': 'bullet' }, { 'list': 'check' }],
            [{ 'script': 'sub' }, { 'script': 'super' }],
            [{ 'indent': '-1' }, { 'indent': '+1' }],
            [{ 'direction': 'rtl' }],
            [{ 'size': ['small', false, 'large', 'huge'] }],
            [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
            [{ 'color': [] }, { 'background': [] }],
            [{ 'font': [] }],
            [{ 'align': [] }],
            ['clean']
        ];

        document.querySelectorAll(".quill-editor").forEach(editorDiv => {
            let fieldName = editorDiv.getAttribute("data-name");
            let hiddenInput = document.querySelector(`input[name="${fieldName}"]`);

            let quill = new Quill(editorDiv, {
                theme: "snow",
                modules: { toolbar: toolbarOptions }
            });

            // Load the initial content from the hidden input
            if (hiddenInput.value.trim() !== "") {
                quill.root.innerHTML = hiddenInput.value;
            }

            // Sync Quill content with hidden input on text change
            quill.on("text-change", function () {
                hiddenInput.value = quill.root.innerHTML;
            });
        });

        // Ensure all editors save data before form submission
        document.querySelector("form").addEventListener("submit", function () {
            document.querySelectorAll(".quill-editor").forEach(editorDiv => {
                let fieldName = editorDiv.getAttribute("data-name");
                let hiddenInput = document.querySelector(`input[name="${fieldName}"]`);
                let quillEditor = Quill.find(editorDiv);
                hiddenInput.value = quillEditor.root.innerHTML;
            });
        });
    });
>>>>>>> developer
</script>