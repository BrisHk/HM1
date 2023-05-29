create database db_login;
use database db_login;

CREATE TABLE users_db(
  id INT(11) AUTO_INCREMENT NOT NULL PRIMARY KEY,
  Username VARCHAR(255) NOT NULL UNIQUE,
  email VARCHAR(255) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL
);

CREATE TABLE users_post(
  id INT(11) AUTO_INCREMENT NOT NULL,
  Username VARCHAR(255) NOT NULL,
  post VARCHAR(255) NOT NULL,
  post_time TIME,

  PRIMARY KEY(id,Username,post,post_time)
);

INSERT INTO users_db (id, Username, post, post_time) VALUES ('','GiovEx22','Avete visto le nuove carte?',CURRENT_TIMESTAMP());
INSERT INTO users_db (id, Username, post, post_time) VALUES ('','M@rk783','Vado a controllare subito!',CURRENT_TIMESTAMP());

CREATE TABLE users_fav(
  id INT(11) AUTO_INCREMENT NOT NULL PRIMARY KEY,
  Username VARCHAR(255) NOT NULL ,
  src MEDIUMTEXT() NOT NULL ,
);

CREATE TABLE users_msg(
  id INT(11) AUTO_INCREMENT NOT NULL,
  Username VARCHAR(255) NOT NULL,
  msg VARCHAR(255) NOT NULL,
  time_msg TIME,

    
  PRIMARY KEY(id,Username,msg,time_msg)
);