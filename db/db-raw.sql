CREATE TABLE member(
	mid int primary key auto_increment,
	first_name varchar(20),
	last_name varchar(20),
	institution varchar(50),
	age int,
	date_time timestamp default current_timestamp,
	github varchar(50),
	role int
);

CREATE TABLE challenge(
	cid int primary key auto_increment,
	name varchar(50),
	descr text
);

CREATE TABLE solution(
	sid int primary key auto_increment,
	mid int,
	filename varchar(200),
	output text,
	date_time timestamp default current_timestamp,
	foreign key(mid) references member(mid)
);

CREATE TABLE comment(
	cid int primary key auto_increment,
	mid int,
	comment text,
	date_time timestamp default current_timestamp,
	foreign key(mid) references member(mid)
);


CREATE TABLE IF NOT EXISTS  `ci_sessions` (
	session_id varchar(40) DEFAULT '0' NOT NULL,
	ip_address varchar(45) DEFAULT '0' NOT NULL,
	user_agent varchar(120) NOT NULL,
	last_activity int(10) unsigned DEFAULT 0 NOT NULL,
	user_data text NOT NULL,
	PRIMARY KEY (session_id),
	KEY `last_activity_idx` (`last_activity`)
);

CREATE TABLE email_template(
	etid int primary key auto_increment,
	name varchar(20),
	html text
);