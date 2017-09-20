create table users
(
username char(8) not null,
passcode char(8) not null,
userflag int,
primary key(username)
);

insert into users values('admin','admin123',1);