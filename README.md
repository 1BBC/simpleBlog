SimpleBlog
-------------

Yii2 blog.

Configuration
-------------

### Database

Edit the file `config/db.php` with real data, for example:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=yii2basic',
    'username' => 'root',
    'password' => '1234',
    'charset' => 'utf8',
];
```

To update the database to the latest structure, apply all new migrations using the following command:

```php
yii migrate
```

View
-------------

### Home page
![alt text](http://drive.google.com/uc?export=view&id=1iKDQFnUMs_F0hgTodTGohWqy1jKziF0o)

### Admin page

Available on the link `://host/admin` for registered users with the attribute `isAdmin`

![alt text](http://drive.google.com/uc?export=view&id=1mOH4Anv-1ZKUP-T4rl-K2GrsRTscL46J)
