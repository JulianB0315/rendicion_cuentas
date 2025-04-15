const ejesContainer = document.getElementById('select-eje-container');
const ejes = document.getElementById('ejes');
const createRendBtn = document.getElementById('btn-crear-rendicion');

if (ejes){
    if (ejes.children.length > 0) {
        ejesContainer.style.display = 'block';
        createRendBtn.disabled = false;
    } else{
        ejesContainer.style.display = 'none';
        createRendBtn.disabled = true
    }
}
document.addEventListener('DOMContentLoaded', () => {
    const fileInput = document.getElementById('bannerRendicion');
    const previewContainer = document.getElementById('preview-container');
    const previewImage = document.getElementById('preview-image') || document.createElement('img');
    const fileName = document.getElementById('file-name');
    const cancelBtn = document.getElementById('cancel-image');

    if (!document.getElementById('preview-image') && previewContainer) {
        previewImage.id = 'preview-image';
        previewImage.classList.add('img-fluid');
        previewImage.alt = 'Vista previa';
        previewImage.style.maxHeight = '200px';
        previewImage.style.borderRadius = '8px';
        
        // Crear un contenedor para la imagen si no existe
        let imageContainer = previewContainer.querySelector('.preview-image-container');
        if (!imageContainer) {
            imageContainer = document.createElement('div');
            imageContainer.classList.add('preview-image-container');
            previewContainer.appendChild(imageContainer);
        }
        
        imageContainer.appendChild(previewImage);
    }
    if (fileInput) {
        // Cuando se selecciona un archivo
        fileInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const file = this.files[0];
                
                // Mostrar el nombre del archivo
                if (fileName) {
                    fileName.textContent = file.name;
                }
                
                // Crear una URL para la imagen y mostrarla
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    if (previewContainer) {
                        previewContainer.classList.remove('d-none');
                    }
                };
                reader.readAsDataURL(file);
            } else {
                // Si no hay archivo seleccionado, ocultar la previsualización
                resetPreview();
            }
        });
        if (cancelBtn) {
            cancelBtn.addEventListener('click', function() {
                // Limpiar el input file
                fileInput.value = '';
                
                // Ocultar la previsualización
                resetPreview();
            });
        }
    }
    const resetPreview = () => {
        if (previewContainer) previewContainer.classList.add('d-none')
        if (fileName) fileName.textContent = '';
        if (previewImage) previewImage.src = '';
    }

})