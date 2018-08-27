1. composer install
2. copy .env.example -> .env en config mysql
3. php artisan tinker

User::create(['name' => 'admin', 'email' => 'admin@example.com', 'role' => 'admin', 'password' => Hash::make("1234abcd")]);

voor behat:

4. patch https://github.com/laracasts/Behat-Laravel-Extension/pull/81/files to vendor\laracasts
5. patch https://github.com/Behat/Behat/pull/1163/files to 
6. sqlite3 database\database.sqlite "create table aTable(field1 int); drop table aTable;"


