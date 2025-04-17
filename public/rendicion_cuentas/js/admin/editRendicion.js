document.addEventListener("DOMContentLoaded", () => {
    if (document.getElementById('bannerRendicion')) {
        initImagePreview({
            inputId: "bannerRendicion",
            previewContainerId: "preview-container",
            previewImageId: "preview-image",
            fileNameId: "file-name",
            cancelBtnId: "cancel-image",
            hasCurrentImage: true,
            currentImageLabel: "(Banner actual)",
            newImageLabel: "(Nueva imagen)",
        })
    }
})