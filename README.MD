# Basic Pdo Functionalization

This project includes basic functions for **MySQL** databases using **PDO**. It aims to perform database queries with writing ***zero SQL Queries***.

The project is inspired from [BasicDB](https://github.com/tayfunerbilen/basicdb).

## Installation

Just add the ```inc/db.php``` file into your project, and you are good to go.

## Usage

Basic usage of code is explained in ```test.php``` and below here:

```php
include 'db.php';
//Define your db object
$db = new DB();
$db->setCharSet('utf8');
$result = $db->select()
              ->columns('*')
              ->from('MyTable')
              ->where(['id >'=>123])
              ->orderBy('id desc')
              ->limit(200)
              ->get();
```

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.



## License
[MIT](https://choosealicense.com/licenses/mit/)
