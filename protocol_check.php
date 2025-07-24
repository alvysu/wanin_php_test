<?php
$is_https = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off');
$current_protocol = $is_https ? 'HTTPS' : 'HTTP';
?>

<!DOCTYPE html>
<html lang="zh-Hant">
<head>
    <meta charset="UTF-8">
    <title>協議檢查</title>
</head>
<body>
    <h2>目前使用的是 <?= $current_protocol ?> 協議</h2>

    <h3>📘 協議概念說明：</h3>
    <ul>
        <li><strong>HTTP（HyperText Transfer Protocol）：</strong> 一種明文傳輸協議，用於瀏覽器與伺服器之間傳送資料，**不具備加密功能**。</li>
        <li><strong>HTTPS（HTTP Secure）：</strong> 是 HTTP 加上 <strong>TLS/SSL 加密</strong>，傳輸過程中內容被加密，能防止竊聽與中間人攻擊。</li>
    </ul>

    <h3>🔐 TLS/SSL 加密說明：</h3>
    <ul>
        <li><strong>SSL（Secure Sockets Layer）：</strong> 是最早的加密協議，已逐漸被淘汰（如 SSL 3.0 被發現安全漏洞）。</li>
        <li><strong>TLS（Transport Layer Security）：</strong> 是 SSL 的後繼版本，現今 HTTPS 採用的實際加密協議是 TLS。</li>
        <li><strong>TLS 加密流程：</strong>
            <ol>
                <li>瀏覽器向伺服器請求 HTTPS 連線。</li>
                <li>伺服器傳送憑證（含公開金鑰）給瀏覽器。</li>
                <li>瀏覽器驗證憑證合法性後，產生對稱金鑰並加密傳送回伺服器。</li>
                <li>雙方使用對稱金鑰進行後續加密通訊。</li>
            </ol>
        </li>
        <li>這樣的設計可同時兼顧：
            <ul>
                <li>📦 資料內容加密（防竊聽）</li>
                <li>🔐 來源驗證（避免偽造伺服器）</li>
                <li>🧾 資料完整性檢查（防篡改）</li>
            </ul>
        </li>
    </ul>


    <h3>📌 協議差異比較：</h3>
    <table border="1" cellpadding="8">
        <thead>
            <tr>
                <th>項目</th>
                <th>HTTP</th>
                <th>HTTPS</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>加密</td>
                <td>❌ 無</td>
                <td>✅ 使用 TLS/SSL 加密</td>
            </tr>
            <tr>
                <td>傳輸安全性</td>
                <td>低（可能被竊聽）</td>
                <td>高（可防竊聽、中間人攻擊）</td>
            </tr>
            <tr>
                <td>常見應用</td>
                <td>部落格、開發環境</td>
                <td>登入系統、電商平台</td>
            </tr>
            <tr>
                <td>預設埠號</td>
                <td>80</td>
                <td>443</td>
            </tr>
        </tbody>
    </table>
