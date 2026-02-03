<?php
// contact.php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // フォームデータの取得（XSS対策としてサニタイズ）
    $name    = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
    $company = htmlspecialchars($_POST['company'], ENT_QUOTES, 'UTF-8');
    $email   = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
    $message = htmlspecialchars($_POST['message'], ENT_QUOTES, 'UTF-8');
    $date    = date("Y-m-d H:i:s");

    // 保存するデータ配列
    $data = [$date, $name, $company, $email, $message];

    // CSVファイルのパス
    $filename = 'contact.log.csv';

    // ファイルを追記モードで開く
    $file = fopen($filename, 'a');

    // Windows環境でも文字化けしないよう、必要に応じてShift-JISに変換（任意）
    // mb_convert_variables('SJIS-win', 'UTF-8', $data);

    // CSVに一行書き込み
    fputcsv($file, $data);

    // ファイルを閉じる
    fclose($file);

    // 送信完了画面を表示
    echo "<script>alert('お問い合わせを受け付けました。'); window.location.href='example.html';</script>";
} else {
    // 直接アクセスされた場合はトップへリダイレクト
    header("Location: example.html");
    exit;
}
?>