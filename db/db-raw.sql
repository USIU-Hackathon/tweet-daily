CREATE TABLE user(
	uid int primary key auto_increment,
	first_name varchar(40),
	last_name varchar(40),
	email varchar(50),
	username varchar(100),
	password varchar(50),
	date_time timestamp default current_timestamp
);

CREATE TABLE handle(
	haid int primary key auto_increment,
	uid int,
	handle varchar(50),
	foreign key(uid) references user(uid)
);

CREATE TABLE hashtag(
	hid int primary key auto_increment,
	uid int,
	hashtag varchar(100),
	foreign key(uid) references user(uid)
);

CREATE TABLE tweet(
	tid int primary key auto_increment,
	haid int,
	hid int,
	tweet varchar(200),
	url varchar(250),
	date_time timestamp default current_timestamp
);