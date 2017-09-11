# NinjaDB 
## Query Builder Database Wrapper for WordPress

A lightweight, expressive query builder for WordPress. NInjaDB use the same `$wbdp` instance and methods, It will help you to write $wpdb queries easily and expressively. At least PHP 5.3 is required.

It has some advanced features like:
 - Query Like Laravel Basic Queries
 - Where, orWhere methods
 - Search data in all the columns or specific columns
 - Easily Implement Pagination
 - use insert, update or delete methods expressively.

The syntax is quite similar to Laravel's query builder.

## Example
```PHP
// Make sure you have autoload file included
require 'NinjaDB/autoload.php';

$table = 'post'; // Make sure you don't add db predix; 

//You can just use global function ( Recommended )
$ninjaTable = ninjaDB($table);


// OR  Create an NinjaDB instance
$ninjaTable = new NinjaDB\BaseModel($table);
```

**Simple Query:**

The query below returns the row where id = 3, null if no rows.
```PHP
$row = $ninjaTable->find(3);
```

**Full Queries:**

```PHP 
$query = $ninjaTable->where('post_author', '=', 1);  // for equal you can just use where('post_author, 1);


// Get result as array of objects
$query->get();
```


## Installation

Download this package and just include the autoload.php file in your plugin or theme's function.php file.

```php
require 'NinjaDB/autoload.php';
```

## Full Usage API


### Initiate
---
```PHP 
// Select a table

$query = ninjaDB()->table('post');  // post is the table name without prefix;
```
**OR You can pass your table name as an argument**
```PHP 
// Select a table
$query = ninjaDB('post');  // post is the table name without prefix;
```

## Query


### Get Easily
The query below returns the (first) row where id = 3, null if no rows.
```PHP
$row = ninjaDB('my_table')->find(3);
```
Access your row like, `echo $row->name`. If your field name is not `id` then pass the field name as second parameter `ninjaDB('my_table')->find(3, 'author_id');`.

The query below returns the all rows as array of objects where author_id = 3, null if no rows.
```PHP
$result = ninjaDB('my_table')->findAll('author_id', 3);
```

### Select
```PHP
$query = ninjaDB('my_table')->select('*');
```

#### Multiple Selects
```PHP
->select(array('myfield1', 'myfield2', 'myfield3'));
```

Using select method multiple times `select('a')->select('b')` will also select `a` and `b`. Can be useful if you want to do conditional selects (within a PHP `if`).

#### Select Distinct
```PHP
->selectDistinct(array('myfield1', 'myfield2', 'myfield3'));
```

#### Get All
Return an array of objects.
```PHP
$query = ninjaDB('my_table')->where('author_id', 1);
$result = $query->get();
```
You can loop through it like:
```PHP
foreach ($result as $row) {
    echo $row->name;
}
```

#### Get First Row
```PHP
$query = ninjaDB('my_table')->where('author_id', 1);
$row = $query->first();
```
Returns the first row, or null if there is no record. Using this method you can also make sure if a record exists. Access these like `echo $row->name`.


#### Get Rows Count, MAX, MIN, AVerage, SUM
```PHP
$query = ninjaDB('my_table')->where('author_id', 1);
$count = $query->count();
$max = $query->max('views'); // Where `views` is the column name and all these will return integer / float
$min = $query->min('views');
$avg = $query->avg('views');
$avg = $query->avg('views');
$sum = $query->sum('views');
```

### Where
Basic syntax is `(fieldname, operator, value)`, if you give two parameters then `=` operator is assumed. So `where('name', 'jewel')` and `where('name', '=', 'jewel')` is the same.

```PHP
ninjaDB('my_table')
    ->where('name', '=', 'jewel')
    ->whereNot('age', '>', 25)
    ->orWhere('description', 'LIKE', '%query%')
    ;
```

### Limit and Offset
```PHP
->limit(30);
->offset(10);

// or you can use aliases
->take(30);
->skip(10);
```

### Order By
```PHP
->orderBy('id', 'ASC');
```

### Insert
```PHP
$data = array(
    'name' => 'Jewel',
    'description' => 'Hello, There'
);
$insertId = ninjaDB('my_table')->insert($data);
```

`insert()` method returns the insert id. optionally you can pass $format of your data as `->insert($data, $format);` where `$format` is  an array of formats to be mapped to each of the value in $data

#### Batch Insert
```PHP
$data = array(
    array(
          'name' => 'Jewel',
    	'description' => 'Hello, There'
    ),
    array(
        'name'        => 'Adre',
        'description' => 'Hello, I am Adre Astrian'
    ),
);
$insertIds = ninjaDB('my_table')->batch_insert($data);
```

In case of batch insert, it will return an array of insert ids.


### Update
```PHP
$data = array(
    'name' => 'Shahjahan Jewel',
    'description' => 'Hello, There'
);

ninjaDB('my_table')->where('id', 5)->update($data);
```

Will update the name field to `Shahjahan Jewel` and description field to `Hello, There` where `id = 5`.



### Delete
```PHP
ninjaDB('my_table')->where('id', '>', 5)->delete();
```

Will delete all the rows where id is greater than 5.


___
If you find any typo or extend any functionality then please edit and send a pull request.


## TODO
- [ ]  join()
- [ ]  whereIN()
- [ ]  whereNotIN()
- [ ] whereBetween
- [ ] whereNotBetween
- [ ] Having
- [ ] GroupBy
- [x] ~~selectDistinct~~

*If you would like to implement any of the TODO please feel free to do and do a pull request*

___
&copy; 2017 [WPManageNinja](https://wpmanageninja.com/). Licensed under GPLv3 license.