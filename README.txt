General information on how to get website running with phpmyadmin.




!!the file "gamesitedatabase_DATABASE_SETUP" contains SQL code to setup the database and the relevant tables, it should be run first to create the database structure. 




Be aware, modification to the SQL setup file may be required as it assumes the database to be called gamesitedatabase.
Some developoment environments may restrict the creation of new databases.





"dbConnection.php" is so we can set the login details of the server and propogate it to all things that need to make a dbConnection






platform and genre type use junction tables to link them to the products table, so that we can have many products with many platforms and genres.
the aim is to be able to manage many products even at a small scale like this..


---------------------------------------------------------------------------------------------------------------------------
the following files are purely functional and should not be modified unless the code that is referencing them is updated:
-------------------------------------------------------------------------------------------------------------------------
script_fetch_games_by_genre.php
script_addToCart.php
script_removeFromCart.php
session_manager.php
----------------------------------------------------------------------------------------------------------------------------------
