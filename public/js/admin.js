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
document.addEventListener('DOMContentLoaded', function() {
    const alerts = document.querySelectorAll('.alert');
    
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.transition = 'opacity 0.3s ease';
            alert.style.opacity = '0';
            setTimeout(() => {
                alert.remove();
            }, 500);
        }, 3000);
    });
});