### Installation Instructions

1) git clone 
2) cd p42
3) mysql -u user -h host -p database_name < ./sql/dump.sql
4) change credentials for db connections inside `app/config.php` to your own. 
5) start development server: `php -S localhost:8000 -t public`