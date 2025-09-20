// HTMLドキュメントが完全に読み込まれた後にコードを実行する
    document.addEventListener('DOMContentLoaded', function() {
        const imageInput = document.getElementById('image');
        const imagePreview = document.querySelector('.item-image-container img');
        const fileNameDisplay = document.querySelector('.file-name-display');

        // ファイル入力欄の値が変更されたときにイベントを発生させる
        imageInput.addEventListener('change', function(event) {
            const file = event.target.files[0];

            if (file) {
                // FileReaderオブジェクトを作成し、ファイルの内容を読み込む
                const reader = new FileReader();
                reader.onload = function(e) {
                    // 読み込んだデータURLを画像プレビューのsrcに設定する
                    imagePreview.src = e.target.result;
                };
                reader.readAsDataURL(file);

                // ファイル名を表示する
                fileNameDisplay.textContent = file.name;
            } else {
                // ファイルが選択されなかった場合は、元のファイル名に戻す
                fileNameDisplay.textContent = "{{ $item->image }}";
            }
        });
    });