# furkid-project

## Setup

三個步驟：

1. docekr env
2. server/src/config/database.php
3. server/src/api/*

### 設定 docker env

```env
CONTAINER_NAME=
APACHE_PORT=
MYSQL_PORT=
MYSQL_ROOT_PASSWORD=
MYSQL_DATABASE=
MYSQL_USER=
MYSQL_PASSWORD=
```

### 設定 php env

#### server/src/config/database.php

設定 database 的變數。

```php
private $host = "10.17.249.238";
private $port = "8366";
private $database_name = "furkid";
private $username = "test";
private $password = "test";
public $table_name = "furkid_questions";
```

#### server/src/api/*

設定 include 的相對路徑。

```php
include_once '../../config/database.php';
include_once '../../class/question.php';
```

## Start

### 1. 啟動 docker

```shell
docker up -d
```

### 2. 初始化資料庫

GET `http://[host][port]/init-table.php`，產生 table 和新的題目資料。

### 3. 測試網頁功能

網頁瀏覽 <http://[host>][port]/index.html，測試 click 功能是否能更新資料。
