CREATE table users_team (
    user_id SERIAL UNIQUE NOT NULL PRIMARY KEY,
    username varchar(255) UNIQUE NOT NULL,
    password varchar(255) NOT NULL
);
