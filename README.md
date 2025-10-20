# Laravel9-note-app環境

Laravel9 のGitHubテンプレートリポジトリです。
下記動画の練習になります。
https://www.youtube.com/watch?v=NLqO2b3xEW0

# Webサーバー
docker exec -it laravel9-note-app-web bash

# マイグレーションコマンド（作成）
php artisan make:migration create_memos_table --create=memos
php artisan make:migration create_tags_table --create=tags

