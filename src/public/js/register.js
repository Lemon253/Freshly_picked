document.addEventListener('DOMContentLoaded', function() {
    const imageInput = document.getElementById('image');
    const imageContainer = document.querySelector('.item-image-container'); // 正しく定義
    const imagePreview = imageContainer.querySelector('img');
    const fileNameDisplay = document.querySelector('.file-name-display');

    imageInput.addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                // コンテナにクラスを追加して表示
                imageContainer.classList.add('is-visible');
            };
            reader.readAsDataURL(file);

            fileNameDisplay.textContent = file.name;
        } else {
            imagePreview.src = '#';
            // コンテナのクラスを削除して非表示
            imageContainer.classList.remove('is-visible');
            fileNameDisplay.textContent = '';
        }
    });
});