CREATE DATABASE esoko;
CREATE USER puser@localhost IDENTIFIED WITH mysql_native_password BY '1@2@3#4';
GRANT ALL ON esoko.* TO puser@localhost;
