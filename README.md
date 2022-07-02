# furkid-project

## Setup

三個步驟：

1. docekr env
2. server/src/config/database.php
3. server/src/api/*
4. index.html

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
private $host = [apache host];
private $port = [apache port / 同 docker env 裡的 MYSQL_PORT];
private $database_name = [db name / 同 docker env 裡的 MYSQL_DATABASE];
private $username = [mysql username / 同 docker env 裡的 MYSQL_USER];
private $password = [mysql password / 同 docker env 裡的 MYSQL_PASSWORD];
public $table_name = [table name];
```

#### server/src/api/*

設定 include 的相對路徑。

```php
include_once '../../config/database.php';
include_once '../../class/question.php';
```

### 設定 index.html 裡面的 api host

例如: `http://192.168.1.100:8080`

```js
const HOST = [your apache host];
```

## Start

### 1. 啟動 docker

```shell
docker-compose up
```

### 2. 初始化資料庫

GET `http://[host][port]/init-table.php`，產生 table 和新的題目資料。

### 3. 測試網頁功能

網頁瀏覽 <http://[host>][port]/index.html，測試 click 功能是否能更新資料。
