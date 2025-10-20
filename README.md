# Laravel9環境

Laravel9 のGitHubテンプレートリポジトリです。

## インストール

- Git (GitHub)
- Docker Desktop
- ターミナル (Windowsの場合、「PowerShell」, 「GitBash」等)
- VSCode (任意)
- SQLクライアント (任意 「A5:SQL Mk-2」、「DBeaver」等)

## テンプレート導入

導入は、ダウンロードするか、テンプレートからリポジトリを作成してください。

### ダウンロードする場合

「Code」から「Download ZIP」を選択するとダウンロードが可能です。

### リポジトリを作成する場合

#### リポジトリ作成

「Use this template」ボタンで、テンプレートから自身のリポジトリを作成してください。

- テンプレートからリポジトリを作成する
  - <https://docs.github.com/ja/repositories/creating-and-managing-repositories/creating-a-repository-from-a-template>

#### clone

自身で作成したリポジトリをcloneしてください。

- リポジトリをクローンする
  - <https://docs.github.com/ja/repositories/creating-and-managing-repositories/cloning-a-repository>

## 開発環境

Dockerを使って環境を構築します。  

### 構成図

![Docker](./docs/images/docker.svg)

### 構築する環境

- Webコンテナ
  - [php:8.1.14-apache](https://hub.docker.com/_/php)
  - [composer:2.5.1](https://hub.docker.com/_/composer)
- DBコンテナ
  - [mysql:8.0.31](https://hub.docker.com/_/mysql)
- phpMyAdminコンテナ
  - [phpmyadmin:5.2.0](https://hub.docker.com/_/phpmyadmin)

### .env

[.env](./.env)ファイルはDockerの環境ファイルです。  
各名称・ポート設定をしてください。  
基本的にはそのまま使用可能ですが、IPとポートが重複するとコンテナが起動しないので  
自身の環境に合わせて設定を変えてください。

### compose

以下のコマンドを実行します。

```bash
# ターミナルで実行
## ls コマンドで docker-compose.yml があるか確認
ls docker-compose.yml
## docker-compose で環境構築  ※ 時間がかかるので注意
docker-compose up -d
```

上記コマンドでエラーがなければ環境構築が完了しています。

### Laravel

Laravel関連のコマンドはDockerで用意した、WEBサーバー（コンテナ）上で行います。

```bash
# ターミナルで実行
## WEBサーバーに入るコマンド（-itの後に入る名称はコンテナ名「{NAME_PREFIX}-web」）
docker exec -it laravel9-note-app-web bash
```

VSCodeの[Docker拡張機能](https://marketplace.visualstudio.com/items?itemName=ms-azuretools.vscode-docker)が入っている場合、対象コンテナの「Attach Shell」でも開けます。  

#### composer install

```bash
# ■ WEBサーバーで入力
# 「composer.json」、「composer.lock」に記載されているパッケージをvendorディレクトリにインストール
#   ※ 時間がかかるので注意。
composer install
```

`composer install` 実行後に「`Exception`」が出ていると失敗しているので  
[root/vendor/](./root/vendor/)ディレクトリを削除して、再実行してみましょう。  
「`successfully`」が出ていれば成功です。

#### Laravel初期設定

```bash
# ■ WEBサーバーで入力
cd /var/www/root
# 「.env」ファイル
## 「.env.dev」ファイルを「.env」にコピー
cp .env.dev .env
# storage ディレクトリに読み取り・書き込み権限を与える（bootstrap, storage内に書き込み（ログ出力時等）に「Permission denied」のエラーが発生する）
chmod -R 777 bootstrap/cache/
chmod -R 777 storage/
```

以上です。developブランチにて引き続き作業を行いましょう。
