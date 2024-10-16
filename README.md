### Installation Instructions

1) git clone https://github.com/repo p42
2) mysql -u user -h host -p database_name < path/to/dump.sql
3) change db connection credentials in `app/config.php` to yours. 
4) start dev. server: `php -S localhost:8000 -t public`