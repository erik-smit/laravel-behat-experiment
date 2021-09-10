1. composer update
2. composer install
3. copy .env.example -> .env en config mysql
4. php artisan tinker

User::create(['name' => 'admin', 'email' => 'admin@example.com', 'role' => 'admin', 'password' => Hash::make("1234abcd")]);

voor behat:

5. patch https://github.com/laracasts/Behat-Laravel-Extension/pull/81/files to vendor\laracasts
6. patch https://github.com/Behat/Behat/pull/1163/files to 
7. sqlite3 database\database.sqlite "create table aTable(field1 int); drop table aTable;"


