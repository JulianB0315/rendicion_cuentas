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
