USE my_database;

CREATE TABLE `users` (
	`id` int  PRIMARY KEY AUTO_INCREMENT,
	`firstname` varchar(50),
	`lastname` varchar(50),
	`middlename` varchar(50),
	`username` varchar(20) NOT NULL,
	`email` varchar(50) NOT NULL,
	`password` varchar(20) NOT NULL,
	-- `birthdate` datetime,
	`about` text
);

CREATE TABLE `posts` (
	`id` int PRIMARY KEY AUTO_INCREMENT,
	`title` varchar(20),
	`msg` text NOT NULL,
	`likes` int DEFAULT 0,
	`tags` text,
	`userid` int,
	`date_posted` DATETIME DEFAULT CURRENT_TIMESTAMP,
	FOREIGN KEY (`userid`) REFERENCES `users`(`id`)
);

CREATE TABLE `comments` (
	`id` int PRIMARY KEY AUTO_INCREMENT,
	`msg` text NOT NULL,
	`likes` int DEFAULT 0,
	`postid` int,
	`userid` int,
	`date_posted` datetime DEFAULT current_timestamp,
	FOREIGN KEY (`userid`) REFERENCES `users`(`id`),
	FOREIGN KEY (`postid`) REFERENCES `posts`(`id`)
);

CREATE TABLE `tags` (
	`id` int PRIMARY KEY AUTO_INCREMENT,
	`content` varchar(20),
	`userid` int,
	`postid` int,
	FOREIGN KEY (`userid`) REFERENCES `users`(`id`),
	FOREIGN KEY (`postid`) REFERENCES `posts`(`id`)
);
