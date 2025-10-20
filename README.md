# Laravel9-note-app環境

Laravel9 のGitHubテンプレートリポジトリです。
下記動画の練習になります。
https://www.youtube.com/watch?v=NLqO2b3xEW0

# Webサーバー
docker exec -it laravel9-note-app-web bash

# DB参照先を変更
.envファイルのDB_DATABASE=laravelを変更しないとDB参照先がlaravelになり、php artisan migrateをしてもlaravelに保存される。
これを作成したsimplenoteのDBに変更してみよう。

# マイグレーションコマンド（作成）
php artisan make:migration create_memos_table --create=memos
php artisan make:migration create_tags_table --create=tags
php artisan migrate

# ログイン機能
動画の通りだとログイン機能のバージョンが古くて失敗する。
下記コマンドで自動で互換のものをインストールする。
composer require laravel/ui
