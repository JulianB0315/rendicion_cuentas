document.addEventListener('DOMContentLoaded', () => {
    const ejesContainer = document.getElementById('select-eje-container');
    const ejes = document.getElementById('ejes');
    const createRendBtn = document.getElementById('btn-crear-rendicion');

    if (ejes) {
        if (ejes.children.length > 0) {
            ejesContainer.style.display = 'block';
            if (createRendBtn) createRendBtn.disabled = false;
        } else {
            ejesContainer.style.display = 'none';
            if (createRendBtn) createRendBtn.disabled = true;
        }
    }
    
    if (document.getElementById('bannerRendicion')) {
        initImagePreview({
            inputId: 'bannerRendicion',
            previewContainerId: 'preview-container',
            previewImageId: 'preview-image',
            fileNameId: 'file-name',
            cancelBtnId: 'cancel-image',
            hasCurrentImage: false,
            newImageLabel: ' (Nueva imagen)'
        });
    }
});