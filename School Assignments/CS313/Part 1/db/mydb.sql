CREATE TABLE users (
   id SERIAL UNIQUE NOT NULL PRIMARY KEY,
   username varchar(255) NOT NULL,
   email varchar(255) NOT NULL,
   pass varchar(255) NOT NULL
);

CREATE TABLE cats (
   id SERIAL UNIQUE NOT NULL PRIMARY KEY,
   cat_name varchar(255) NOT NULL,
   fav_food varchar(255),
   fav_pastime varchar(255),
   age int,
   owner_id int REFERENCES users (id)
);

CREATE TABLE pictures (
   id SERIAL UNIQUE NOT NULL PRIMARY KEY,
   image_name varchar(255) NOT NULL,
   likes int,
   cat_id int REFERENCES cats (id)
);

CREATE TABLE comments (
   id SERIAL UNIQUE NOT NULL PRIMARY KEY,
   comment text,
   use_id int REFERENCES users (id), -- ID of the user who typed the comment
   picture_id int REFERENCES pictures (id) -- ID of the picture that the comment belongs to
);