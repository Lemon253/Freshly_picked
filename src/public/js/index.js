document.addEventListener('DOMContentLoaded', function() {
    const selectElement = document.getElementById('sort-select');
    const form = selectElement.closest('form');
    const searchInput = document.getElementById('search-input');

    selectElement.addEventListener('change', function() {
        // 現在の検索キーワードをdata属性から取得
        const searchTerm = form.getAttribute('data-search-term');
        // フォームを送信
        form.submit();
    });
});