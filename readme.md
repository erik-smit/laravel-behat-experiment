1. composer install

2. patch https://github.com/laracasts/Behat-Laravel-Extension/pull/81/files to vendor\laracasts
3. patch https://github.com/Behat/Behat/pull/1163/files to 
4. sqlite3 database\database.sqlite "create table aTable(field1 int); drop table aTable;"