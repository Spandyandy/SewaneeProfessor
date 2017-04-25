CREATE DATABASE professorArchives;
USE professorArchives;


CREATE TABLE profTable(
   profID           int AUTO_INCREMENT NOT NULL PRIMARY KEY
  ,first_name       varchar(40)
  ,last_name        varchar(40)
  ,email            varchar(40)
  ,phone            char(10)
);

CREATE TABLE studentTable(
   username         varchar(40) NOT NULL PRIMARY KEY
  ,password	    varchar(20) NOT NULL
  ,sewanee_Email    varchar(40) NOT NULL
  ,first_Year       SMALLINT 
);

CREATE TABLE departments(
   deptID           int  AUTO_INCREMENT PRIMARY KEY
  ,dept             varchar(45)
);

CREATE TABLE semester(
   semesterID       int AUTO_INCREMENT PRIMARY KEY
  ,period           VARCHAR(20) 
);


CREATE TABLE hasLiked(
   likeID int AUTO_INCREMENT PRIMARY KEY
  ,username varchar(40)
  ,profID int
);


CREATE TABLE whoTeachesWhat(
  registerID       char(5) PRIMARY KEY
  ,profID           int
  ,deptID           int
  ,courseNo       int
);

CREATE TABLE whatIsTaughtWhen(
  registerID       char(5)
  ,semesterID       int
  ,max_Size         int
);


CREATE TABLE studentMajor(
  username          varchar(40) NOT NULL PRIMARY KEY
  ,deptID            int
);





/*Inserts*/
INSERT INTO profTable(first_name, last_name, email, phone)
  VALUES('Stephen','Carl', 'scarl@sewanee.edu', '9315981305')
	,('Lucia', 'Dale', 'ldale@sewanee.edu', '9315981814')
	,('Anne', 'Duffee', 'laduffee@sewanee.edu', '9315983385')
	,('William', 'Engel', 'wengel@sewanee.edu', '9315981361')
	,('Stephanie', 'Batkie', 'slbatkie@sewanee.edu', '9315981280')
	,('Benito', 'Szapiro', 'bszapiro@sewanee.edu', '9315981858')
	;

INSERT INTO studentTable(username, password, sewanee_Email, first_Year)
  VALUES('root123', 'thisismypw123', 'kimj0@sewanee.edu', 2015)
	,('bslayer', 'imemmanuel', 'oluloep0@sewanee.edu', 2015)
	,('prororo', 'randomrandom', 'antoik0@sewanee.edu', 2014)
	;

INSERT INTO departments(dept)
  VALUES('American Studies')
	,('Anthropology')
	,('Arabic')
	,('Archaeology')
	,('Art and Art History')
	,('Asian Studies')
	,('Biology')
	,('Chemistry')
	,('Classics')
	,('Computer Science')
	,('Earth & Environmental Systems')
	,('Economics')
	,('Education')
	,('English')
	,('Environmental Studies')
	,('Film Studies')
	,('French')
	,('German')
	,('History')
	,('Humanities')
	,('Intergroup Dialogues')
	,('International & Global Studies')
	,('Italian')
	,('Mathematics')
	,('Music')
	,('Philosophy')
	,('Physical Education')
	,('Physics and Astronomy')
	,('Politics')
	,('Psychology')
	,('Religious Studies')
	,('Rhetoric')
	,('Russian')
	,('Southern Appalachian and Place-Based Studies')
	,('Spanish')
	,('Statistics')
	,('Theatre and Dance')
	,('Womens and Gender Studies')
	;


INSERT INTO semester(period)
  VALUES('Easter 2017')
	,('Advent 2017')
	,('Easter 2018')
	,('Advent 2018')
	,('Easter 2019')
	,('Advent 2019')
	,('Easter 2020')
	,('Advent 2020')
	;
	
INSERT INTO hasLiked(username, profID)
  VALUES('root123', 1)
	,('bslayer', 1)
	,('root123', 2)
	,('bslayer', 2)
	,('prororo', 2)
	;

INSERT INTO whoTeachesWhat(registerID, profID, deptID, courseNo)
  VALUES
     ('20524', 2,  10, 157)
	,('20525', 2,  10, 320)
	,('20526', 1,  10, 370)
	,('20527', 1,  10, 415)
	,('20938', 4, 14, 101)
	,('20939', 5, 14, 101)
	,('20851', 6, 28, 101)
	,('20764', 3, 24, 102)
	,('15664', 6, 28, 102)
	;

INSERT INTO whatIsTaughtWhen(registerID, semesterID, max_Size)
  VALUES('20524', 2, 20)
	,('20525', 2, 18)
	,('20526', 2, 18)
	,('20527', 2, 18)
	,('20938', 2, 20)
	,('20939', 2, 20)
	,('20851', 2, 25)
	,('20764', 2, 33)
	,('15664', 1, 20)
	;

INSERT INTO studentMajor(username, deptID)
  VALUES('root123', 10)
	,('bslayer', 10)
	,('prororo', 10)
	;

