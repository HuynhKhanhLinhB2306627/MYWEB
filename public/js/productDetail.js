
function changeImage(newImageSrc, clickedElement) {
    document.getElementById('mainProductImage').src = newImageSrc;
    document.querySelectorAll('.thumbnail-images img').forEach(thumb => thumb.classList.remove('active'));
    clickedElement.classList.add('active');
}
const quantityInput = document.getElementById('quantity');
document.getElementById('button-plus').addEventListener('click', () => {
    quantityInput.value = parseInt(quantityInput.value) + 1;
});
document.getElementById('button-minus').addEventListener('click', () => {
    let val = parseInt(quantityInput.value);
    if (val > 1) {
        quantityInput.value = val - 1;
    }
});