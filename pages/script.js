document.addEventListener("DOMContentLoaded", function () {
    const resourceUploadForm = document.getElementById("resource-upload-form");
    const resourceFileInput = document.getElementById("resource-file");
    const resourceDescriptionInput = document.getElementById("resource-description");
    const resourceTypeInput = document.getElementById("resource-type");
    const resourcesList = document.getElementById("resources");
    const linkInput = document.getElementById("link-input");
    const codeEditor = document.getElementById("code-editor");
    const resourceLinkInput = document.getElementById("resource-link");
    const resourceCodeInput = document.getElementById("resource-code");

    // Show/hide input fields based on resource type
    resourceTypeInput.addEventListener("change", function () {
        if (resourceTypeInput.value === "link") {
            linkInput.style.display = "block";
            codeEditor.style.display = "none";
        } else if (resourceTypeInput.value === "code") {
            linkInput.style.display = "none";
            codeEditor.style.display = "block";
            initializeCodeMirror();
        } else {
            linkInput.style.display = "none";
            codeEditor.style.display = "none";
        }
    });

    resourceUploadForm.addEventListener("submit", function (e) {
        e.preventDefault();

        const file = resourceFileInput.files[0];
        const description = resourceDescriptionInput.value;
        const resourceType = resourceTypeInput.value;
        let resourceLink = "";
        let resourceCode = "";

        if (resourceType === "link") {
            resourceLink = resourceLinkInput.value;
        } else if (resourceType === "code") {
            resourceCode = resourceCodeInput.value;
        }

        if (file && description && resourceType) {
            // Upload the file using FormData
            const formData = new FormData();
            formData.append("resource", file);
            formData.append("description", description);
            formData.append("type", resourceType);
            formData.append("link", resourceLink);
            formData.append("code", resourceCode);

            fetch("upload.php", {
                method: "POST",
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Create a new resource element with the appropriate link
                    let resourceLink;
                    if (resourceType === "pdf") {
                        resourceLink = `<a href="downloads/${data.file}" target="_blank">View PDF</a>`;
                    } else if (resourceType === "description") {
                        resourceLink = `<p>${description}</p>`;
                    } else if (resourceType === "link") {
                        resourceLink = `<a href="${data.link}" target="_blank">${description}</a>`;
                    } else if (resourceType === "code") {
                        resourceLink = `<pre><code>${description}</code></pre>`;
                    }

                    const li = document.createElement("li");
                    li.innerHTML = `<strong>${description}</strong><br>${resourceLink}`;
                    resourcesList.appendChild(li);

                    // Clear the form inputs
                    resourceFileInput.value = "";
                    resourceDescriptionInput.value = "";
                    resourceTypeInput.selectedIndex = 0;
                    resourceLinkInput.value = "";
                    resourceCodeInput.value = "";
                } else {
                    alert("Resource sharing failed. Please try again.");
                }
            })
            .catch(error => {
                console.error("Error:", error);
                alert("An error occurred during resource sharing. Please try again.");
            });
        }
    });

    // Initialize CodeMirror for code input
    function initializeCodeMirror() {
        const codeMirrorEditor = CodeMirror.fromTextArea(resourceCodeInput, {
            mode: "text/html", // You can change the mode as needed (e.g., "text/css" for CSS)
            theme: "default",
            lineNumbers: true,
        });
        codeMirrorEditor.setSize("100%", "auto");
    }
});
