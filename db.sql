show databases;
create database blog_db;
use blog_db;
show tables;

create table if not exists User (
user_id int primary key auto_increment,
username varchar(20) unique not null,
email varchar(50) unique not null,
user_password  varchar(255) not null,
user_role  enum('Admin','Author','Reader') not null  default 'Reader',
creat_at timestamp default current_timestamp,
index idx_user_role (user_role),
index idx_username (username),
index idx_email (email)
);



create table if not exists Article(
article_id int primary key auto_increment,
title varchar(200) not null,
content longtext not null,
author_id int not null,
categorie_id int ,
create_at timestamp default current_timestamp,
foreign key (author_id) references User(user_id) on delete cascade,
foreign key (categorie_id) references categories(categorie_id) on delete set null,
index idx_author_id (author_id)
);
create table if not exists comments(
comment_id int primary key auto_increment,
article_id int not null,
user_id int not null,
content text not null,
foreign key (user_id) references User(user_id) on delete cascade,
foreign key (article_id) references Article(article_id) on delete cascade,
index idx_article_id (article_id),
index idx_user_id (user_id)

);
create table if not exists comments(
comment_id int primary key auto_increment,
article_id int not null,
user_id int not null,
content text not null,
foreign key (user_id) references User(user_id) on delete cascade,
foreign key (article_id) references Article(article_id) on delete cascade,
index idx_article_id (article_id),
index idx_user_id (user_id)

);



CREATE TABLE if not exists categories (
    categorie_id INT PRIMARY KEY AUTO_INCREMENT,
    categorie_name VARCHAR(50) UNIQUE NOT NULL,
    description TEXT,
    creator_id INT,
    create_at timestamp default current_timestamp,
    FOREIGN KEY (creator_id) REFERENCES User(user_id) ON DELETE SET NULL,
    index idx_categorie_name (categorie_name)
);


create table if not exists Likes(
like_id int primary key auto_increment,
user_id int not null,
article_id int not null,

FOREIGN KEY (user_id) REFERENCES User(user_id) on delete cascade,
foreign key (article_id) references Article(article_id) on delete cascade,
unique key prev_double_like(user_id,article_id),
index idx_user_id (user_id),
index idx_article_id (article_id)
);
ALTER TABLE Article
ADD FOREIGN KEY  (categorie_id) REFERENCES categories(categorie_id);
show tables;