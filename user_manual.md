The default credentials are: 

(user need to import .sql file from DB/inout.sql into a new database and need to mention it in function/dbconn.php file and need to write koha database in "koha" variable)

username: master 
password: superuser
loc: master

In this way the inout fetch the users from koha. 

Also user may create new loc(location) after login, i created loc="central library" and add new users with "central library".

1. The user with role = user have option to create make new entries. 
2. The user with role =  admin have access to the previous reports. 

So admin may create users accordingly.
