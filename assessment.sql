use assessment;
select * from users;

create table users(
    id int primary key auto_increment,
    name varchar(100) not null,
    email varchar(100) unique not null,
    password varchar(255) not null
);

create table student(
id int auto_increment primary key,
name varchar(100) not null,
class enum("8","9","10","11","12"),
batch enum("Morning","Afternoon","Evening"),
email varchar(100) unique not null);

alter table student add column city varchar(100) not null;
