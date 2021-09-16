DROP TABLE IF EXISTS new_schema.people CASCADE;
CREATE TABLE new_schema.people (
	ID INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    FNAME varchar(127),
    LNAME varchar(127),
    ADDR varchar(127),
    CITY varchar(127),
    IMG blob
);

INSERT INTO new_schema.people (FNAME, LNAME, ADDR, CITY) VALUES
('john1', 'doe1', '111 heck lane', 'Helsinki'),
('jane3', 'buck3', '311 heck lane', 'HeLsInKi'),
('john2', 'doe2', '112 heck lane', 'helsinki'),
('gabe', 'newell', 'valve corpo', 'steamcity');
SELECT * FROM new_schema.people;
