# 予約管理アプリ
## ダウンロード方法

git clone https://github.com/uiternia/reserveAzachi.git

## インストール方法

cd reserveAzachi
composer install
npm install
npm run dev

.env.example をコピー後　.envファイルを作成し

.envファイルの中の下記をご利用の環境に合わせて変更をお願いいたします。

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=reserveAzachi
DB_USERNAME=reserveAzachi
DB_PASSWORD=passworddesu

XAMP/MAMPまたは他の開発環境でDBを起動した後に、

php artisan migrate:fresh --seed

の実行をお願いいたします。

最後に
php artisan key:generate
と入力しキーを生成後、

php artisan serve
で簡易サーバを立ち上げ、表示確認お願いいたします。

