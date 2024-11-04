# 勤怠管理アプリ Atte

・従業員の勤怠管理アプリ<br>

# 作成した目的

・人事評価のため<br>

# アプリケーション URL

<開発環境><br>
・phpmyadmin<br>
http://localhost:8080/<br>
<br>
・アプリ url<br>
http://localhost/register<br>
<br>
<本番環境><br>
・phpmyadmin<br>
http://localhost:8080<br>
<br>
・アプリ url<br>
https://atte.ddns.net<br>
(AWS を使用していましたが、無料期間を過ぎ課金が発生した為切りました)<br>


# 他のリポジトリ
<開発環境><br>
https://github.com/mana62/atte-local
<br>
<本番環境><br>
https://github.com/mana62/atte-prod

# 機能一覧

・会員登録<br>
・ログイン<br>
・ログアウト<br>
・勤務開始<br>
・勤務終了<br>
・休憩開始(1 日で何度も休憩が可能)<br>
・休憩終了<br>
・日付別勤怠情報取得<br>
・ページネーション(5 ページずつ取得)<br>
・ユーザー一覧ページ<br>
・ユーザーごとの勤怠表ページ<br>
・メール認証

# 使用技術

nginx: latest<br>
php: 8.1-fpm<br>
mysql: 8.0.26<br>
Laravel: 8<br>

# テーブル設計

![テーブル仕様書](https://github.com/user-attachments/assets/dfd993eb-30ba-46c6-bd18-e313cedb91b4)

# ER図
![ER図 ](https://github.com/user-attachments/assets/8a6d8a73-fca7-46f6-abd1-1a06bcfe09fb)

# 環境構築

1. リモートリポジトリを作成
2. ローカルリポジトリの作成
3. リモートリポジトリをローカルリポジトリに追加
4. docker-compose.yml の作成
5. Nginx の設定
6. PHP の設定
7. MySQL の設定
8. phpMyAdmin の設定
9. docker compose up -d --build
10. docker compose exec php bash
11. composer create-project "laravel/laravel=8.\*" . --prefer-dist
12. app.php の timezone を修正
13. .env ファイルの環境変数を変更
14. php artisan key:generate
15. docker の再起動
16. php artisan migrate
17. php artisan db
18. 本番用のリモートリポジトリを作成
19. .env.local, .env.prod 開発、本番用.env 作成
20. 環境別に Docker コンテナを起動<br>
21. 開発環境と本番環境の切り替え<br>
22. AWS 環境構築（ストレージを S3、バックエンドを EC2、データベースを RDS）<br>
23. EC2 内で git をクローン<br>
24. SSL 証明書の設定<br>

# クローンの流れ

1. Git リポジトリのクローン<br>
git clone git@github.com:mana62/atte-local.git
cd atte-local<br>

2. .env ファイルの作成
cp .env.example .env<br>

3. .env ファイルの編集<br>

DB_CONNECTION=mysql<br>
DB_HOST=mysql<br>
DB_PORT=3306<br>
DB_DATABASE=db-atte<br>
DB_USERNAME=user<br>
DB_PASSWORD=pass<br>
<br>
MAIL_MAILER=smtp<br>
MAIL_HOST=mailhog<br>
MAIL_PORT=1025<br>
MAIL_FROM_ADDRESS=test@example.com<br>

4. Docker の設定<br>
docker compose up -d --build<br>

5. PHP コンテナにアクセス<br>
docker compose exec -it php bash<br>

6. Laravel パッケージのインストール<br>
composer install<br>

7. アプリケーションキーの生成<br>
php artisan key:generate<br>

8. マイグレーション<br>
php artisan migrate<br>

9. シーディング<br>
php artisan db:seed<br>