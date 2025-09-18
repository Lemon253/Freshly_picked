document.addEventListener('DOMContentLoaded', function() {
        const selectElement = document.getElementById('sort-select');
        const form = selectElement.closest('form');

        selectElement.addEventListener('change', function() {
            // セレクトボックスの値が変更されたらフォームを自動送信する
            form.submit();
        });
    });