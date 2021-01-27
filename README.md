# Пример конфига Apache virtualhost 

```
<VirtualHost *:80>
    ServerName task1.local
    
    DocumentRoot "path_to_public_folder"
    <Directory "path_to_project_root">
        AllowOverride All
        Options FollowSymLinks Indexes
        Require all granted
    </Directory>
    ErrorLog "logs/task1.log"
    CustomLog "logs/task1.log" common
</VirtualHost>
```

# Запуск
В файле **app/Config/App.php** заменить значение переменной `$baseURL` на хост, который указан в конфиге Апача

# Данные для входа
test_user:test_password

Можно их изменить, отредактировав файл **app/Models/userdata.json**