# furkid-project

## Setup

步驟：

1. docekr env
2. server env
3. client env

### 1. 設定 docker env

以下為參考

```env
CONTAINER_NAME=furkid
VUE_PORT=8081
APACHE_PORT=8080
MYSQL_PORT=3306
MYSQL_ROOT_PASSWORD=test
MYSQL_DATABASE=furkid
MYSQL_USER=test
MYSQL_PASSWORD=test
```

### 2. 設定 server env

#### server/src/config/database.php

設定 database 的變數。

```php
private $host = [mysql host];
private $port = [mysql port / 同 docker env 裡的 MYSQL_PORT];
private $database_name = [db name / 同 docker env 裡的 MYSQL_DATABASE];
private $username = [mysql username / 同 docker env 裡的 MYSQL_USER];
private $password = [mysql password / 同 docker env 裡的 MYSQL_PASSWORD];
public $table_name = [table name];
```

#### server/src/api/\*

設定 api 裡面 php include 的相對路徑。

```php
include_once '../../config/database.php';
include_once '../../class/quiz.php';
```

### 3. 設定 client env

#### 設定 vue

以下為參考

```env
# [HOST]:[APACHE_PORT]
VUE_APP_API_ROOT=192.168.1.100:8080
```

#### 設定後臺測試頁

以下為參考

```js
// http://[HOST]:[APACHE_PORT]
const HOST = 'http://192.168.1.100:8080';
```

## 測試

### 1. 啟動 docker

```shell
docker-compose up -d
```

### 2. 初始化資料庫

GET `http://[host][port]/init-table.php`，產生 table 和新的題目資料。

### 3. 測試後臺功能

網頁瀏覽 `http://[host][APACHE_PORT]/index.html`，測試是否能正確顯示資料。

### 4. 測試活動頁面功能

網頁瀏覽 `http://[host][VUE_PORT]`，測試是否能正確更新資料。

## 布署

### Front-end

```shell
cd client
npm run build
```

將 client/dist 裡的檔案複製到目標路徑，ex: `https://[domain name]/furkid`。

### Back-end
