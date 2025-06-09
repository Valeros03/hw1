/*CREATE DATABASE spotifyWebProg;
USE spotifyWebProg;


DROP TABLE IF EXISTS songsplaylist;
DROP TABLE IF EXISTS playlist;
DROP TABLE IF EXISTS likes;
DROP TABLE IF EXISTS songs;
DROP TABLE IF EXISTS albums;
DROP TABLE IF EXISTS artists;
DROP TABLE IF EXISTS accounts;

CREATE TABLE accounts(

	username VARCHAR(255) not null,
	pass VARCHAR(255) not null,
	nome VARCHAR(255) not null,
	nascita DATE  not null,
	sesso VARCHAR(64)  not null,
	PRIMARY KEY(username)

);

CREATE TABLE artists(

	id VARCHAR(255) NOT NULL UNIQUE,
	nome VARCHAR(255) NOT NULL,
	img VARCHAR(255),
	PRIMARY KEY (id)

);

CREATE TABLE albums(

	id VARCHAR(255) not null unique,
	artist VARCHAR(255) not NULL,
	nome VARCHAR(255)not null,
	tipo VARCHAR(255) NOT null,
	img VARCHAR(255),
	PRIMARY KEY(id),
	FOREIGN KEY (artist) REFERENCES artists(id)
	
);

CREATE TABLE songs(

	id VARCHAR(255) not null unique,
	artist VARCHAR(255) not null,
	album VARCHAR(255),
	nome VARCHAR(255)not null,
	PRIMARY KEY(id),
	FOREIGN KEY (artist) REFERENCES artists(id),
	FOREIGN KEY (album) REFERENCES albums(id)
	
);


CREATE TABLE likes(

	username VARCHAR(255) not null,
	song VARCHAR(255) not null,
	FOREIGN KEY (song) REFERENCES songs(id),
	FOREIGN KEY (username) REFERENCES accounts(username),
	PRIMARY KEY (username, song)
	
);


CREATE TABLE playlist (

	nome VARCHAR(255) not null,
	id INTEGER not null unique,
	username VARCHAR(255) not null,
	PRIMARY KEY(id, username),
	FOREIGN KEY (username) REFERENCES accounts(username)
	
);


CREATE TABLE songsPlaylist(

	playlistID INTEGER,
	songID VARCHAR(255),
	PRIMARY KEY(playlistID, songID),
	FOREIGN KEY (songID) REFERENCES songs(id),
	FOREIGN KEY (playlistID) REFERENCES playlist(id)

);
*/



/*




INSERT INTO artists (id, nome, img) VALUES ("0qFiW6fZtJxh0tb9fLrhoZ","Sebastiano Fichera","https://i.scdn.co/image/ab676161000051742aae1743e53fc160807d22f6");
INSERT INTO artists (id, nome, img) VALUES ("42ErEQmLZxx28yo0nebV22","High Disaster","https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRfPRYoo7VZz5-stPsFpVEzP7Va-J5hZk2XPQ&s");
INSERT INTO artists (id, nome, img) VALUES ("13ZNswkCI4ypY51zscRpOn","Vittoria Sciacca","https://i.scdn.co/image/ab6761610000e5eb739a9aaca7901038da5bbb86");
INSERT INTO artists (id, nome, img) VALUES ("6XyY86QOPPrYVGvF9ch6wz","Linkin Park","https://upload.wikimedia.org/wikipedia/commons/thumb/0/06/Linkin_Park_logo_2024.svg/2048px-Linkin_Park_logo_2024.svg.png");
INSERT INTO artists (id, nome, img) VALUES ("0qT79UgT5tY4yudH9VfsdT","Sum 41","https://i.iheart.com/v3/catalog/artist/40497?ops=fit(480%2C480)%2Crun(%22circle%22)");
INSERT INTO artists (id, nome, img) VALUES ("3Ayl7mCk0nScecqOzvNp6s","Jimmy Eat World","https://i.scdn.co/image/ab6761610000e5eb0dc33cfd207772f8e2f6b46f");



INSERT INTO songs (id, artist, album, nome) VALUES ("3h0pe0WuiHOPKwsQzw1sba", "0qFiW6fZtJxh0tb9fLrhoZ", "0iDOXl6kCBEd7hXSp6L3DD", "Another Day");
INSERT INTO songs (id, artist, album, nome) VALUES ("2Ats2HOPh5LWzbZx0Wza3y", "0qFiW6fZtJxh0tb9fLrhoZ", "0iDOXl6kCBEd7hXSp6L3DD", "Me and You");
INSERT INTO songs (id, artist, album, nome) VALUES ("6rLvi0pZPwAVn4XOZ9fDVC", "0qFiW6fZtJxh0tb9fLrhoZ", "0iDOXl6kCBEd7hXSp6L3DD", "Nothing will Remain");
INSERT INTO songs (id, artist, album, nome) VALUES ("21faYZCa7djPLYSlg09stC", "0qFiW6fZtJxh0tb9fLrhoZ", "0iDOXl6kCBEd7hXSp6L3DD", "Words About...");
INSERT INTO songs (id, artist, album, nome) VALUES ("4pSYgziLKpjKvU92qmvAE9", "0qFiW6fZtJxh0tb9fLrhoZ", "0iDOXl6kCBEd7hXSp6L3DD", "Vecchio Inciso");
INSERT INTO songs (id, artist, album, nome) VALUES ("6DIbm6da7OTfemsUXR9zoc", "0qFiW6fZtJxh0tb9fLrhoZ", "0iDOXl6kCBEd7hXSp6L3DD", "Summerlife");
INSERT INTO songs (id, artist, album, nome) VALUES ("2nLtzopw4rPReszdYBJU6h", "6XyY86QOPPrYVGvF9ch6wz", "4Gfnly5CzMJQqkUFfoHaP3", "Numb");
INSERT INTO songs (id, artist, album, nome) VALUES ("3agtg0x11wPvLIWkYR39nZ", "6XyY86QOPPrYVGvF9ch6wz", "4Gfnly5CzMJQqkUFfoHaP3", "Somewhere I Belong");
INSERT INTO songs (id, artist, album, nome) VALUES ("60IkVf7UfQXmt5CwkpcX8a", "6XyY86QOPPrYVGvF9ch6wz", "4Gfnly5CzMJQqkUFfoHaP3", "From The Inside");
INSERT INTO songs (id, artist, album, nome) VALUES ("17bgialGAwoiGj1STY4cnR", "6XyY86QOPPrYVGvF9ch6wz", "4Gfnly5CzMJQqkUFfoHaP3", "Easier To Run");
INSERT INTO songs (id, artist, album, nome) VALUES ("6n8TMVyFKoUmDc4apxceRD", "6XyY86QOPPrYVGvF9ch6wz", "4Gfnly5CzMJQqkUFfoHaP3", "Breaking The Habbit");
INSERT INTO songs (id, artist, album, nome) VALUES ("4zP2e2aIzOZGEFTq1MDJmm", "6XyY86QOPPrYVGvF9ch6wz", "4Gfnly5CzMJQqkUFfoHaP3", "Lying From You");
INSERT INTO songs (id, artist, album, nome) VALUES ("4Yf5bqU3NK4kNOypcrLYwU", "6XyY86QOPPrYVGvF9ch6wz", "4Gfnly5CzMJQqkUFfoHaP3", "Faint");
INSERT INTO songs (id, artist, album, nome) VALUES ("3tFuViD1r1YcjDegM7fiCU", "0qT79UgT5tY4yudH9VfsdT", "17UgmsH23ijxLEWerAINUg", "Holy Images Of Lies");
INSERT INTO songs (id, artist, album, nome) VALUES ("1s7egXFpKAkd5VQBYwVf35", "0qT79UgT5tY4yudH9VfsdT", "17UgmsH23ijxLEWerAINUg", "Happiness Machine");
INSERT INTO songs (id, artist, album, nome) VALUES ("4DJVmSP42li51r1C8zhURQ", "0qT79UgT5tY4yudH9VfsdT", "17UgmsH23ijxLEWerAINUg", "Reason To Believe");
INSERT INTO songs (id, artist, album, nome) VALUES ("2zoKi9AQKjtn3Q7Ll8CK7v", "0qT79UgT5tY4yudH9VfsdT", "17UgmsH23ijxLEWerAINUg", "What Am I To Say");
INSERT INTO songs (id, artist, album, nome) VALUES ("1lQmSh729NT4nWjfwoYFzq", "0qT79UgT5tY4yudH9VfsdT", "17UgmsH23ijxLEWerAINUg", "Sick Of Everyone");
INSERT INTO songs (id, artist, album, nome) VALUES ("6sfU2LwBKxjbukPZnUbGtt", "0qT79UgT5tY4yudH9VfsdT", "17UgmsH23ijxLEWerAINUg", "Blood In My Eyes");
INSERT INTO songs (id, artist, album, nome) VALUES ("3lwZ2WyU3EyEXVkuMrQFfA", "42ErEQmLZxx28yo0nebV22", "73IhsDiCOPoVkKEZ2rBtuz", "Do Not Lie");
INSERT INTO songs (id, artist, album, nome) VALUES ("7AvvlhwY3wPd2MZs8oiTst", "13ZNswkCI4ypY51zscRpOn", "2EH2aWX3kqXvrovwOv3zrJ", "Ricaduta");
INSERT INTO songs (id, artist, album, nome) VALUES ("6GG73Jik4jUlQCkKg9JuGO", "3Ayl7mCk0nScecqOzvNp6s", "0UJhhj5bn5AGAjryFnhueP", "The Middle");
INSERT INTO songs (id, artist, album, nome) VALUES ("7Jxz80MpbvTsrW8EttiaY0", "3Ayl7mCk0nScecqOzvNp6s", "0UJhhj5bn5AGAjryFnhueP", "My Sundown");



CREATE TABLE playlist (

	nome VARCHAR(255) not null,
	idNumber INTEGER not NULL,
	username VARCHAR(255) not NULL,
	id VARCHAR(255),
	PRIMARY KEY (id),
	FOREIGN KEY (username) REFERENCES accounts(username)
	
);


CREATE TABLE songsPlaylist(

	playlistID VARCHAR(255),
	songID VARCHAR(255),
	PRIMARY KEY(playlistID, songID),
	FOREIGN KEY (songID) REFERENCES songs(id),
	FOREIGN KEY (playlistID) REFERENCES playlist(id)

);



DROP TRIGGER IF EXISTS increment_playlist_id;
DELIMITER //
CREATE TRIGGER IF NOT EXISTS increment_playlist_id
BEFORE INSERT ON playlist
FOR EACH ROW
BEGIN

	DECLARE last_id INT DEFAULT 0;

	
	IF (SELECT COUNT(*) FROM playlist WHERE playlist.username = NEW.username) > 0
	THEN
			SELECT MAX(idNumber) INTO last_id FROM playlist WHERE playlist.username = NEW.username;
			
	END IF;
	
	SET NEW.idNumber = last_id + 1;
	SET NEW.id = CONCAT(NEW.username, NEW.idNumber);

END//
DELIMITER ;




INSERT INTO playlist (nome, id, username) VALUES ("Chill", "0", "kkkkkkkkkkkkkkk");
INSERT INTO playlist (nome, id, username) VALUES ("Sleep", "0", "kkkkkkkkkkkkkkk");
INSERT INTO playlist (nome, id, username) VALUES ("Party", "0", "kkkkkkkkkkkkkkk");
INSERT INTO playlist (nome, id, username) VALUES ("Sad", "0", "kkkkkkkkkkkkkkk");
INSERT INTO playlist (nome, id, username) VALUES ("Happy", "0", "kkkkkkkkkkkkkkk");
INSERT INTO playlist (nome, id, username) VALUES ("Energy", "0", "kkkkkkkkkkkkkkk");



INSERT INTO songsPlaylist (playlistID, songID) VALUES 
('kkkkkkkkkkkkkkk1', '3h0pe0WuiHOPKwsQzw1sba'),
('kkkkkkkkkkkkkkk1', '2Ats2HOPh5LWzbZx0Wza3y'),
('kkkkkkkkkkkkkkk1', '6rLvi0pZPwAVn4XOZ9fDVC'),
('kkkkkkkkkkkkkkk1', '21faYZCa7djPLYSlg09stC'),
('kkkkkkkkkkkkkkk1', '4pSYgziLKpjKvU92qmvAE9'),
('kkkkkkkkkkkkkkk1', '6DIbm6da7OTfemsUXR9zoc'),
('kkkkkkkkkkkkkkk1', '2nLtzopw4rPReszdYBJU6h'),
('kkkkkkkkkkkkkkk1', '3agtg0x11wPvLIWkYR39nZ');


INSERT INTO songsPlaylist (playlistID, songID) VALUES 
('kkkkkkkkkkkkkkk2', '60IkVf7UfQXmt5CwkpcX8a'),
('kkkkkkkkkkkkkkk2', '17bgialGAwoiGj1STY4cnR'),
('kkkkkkkkkkkkkkk2', '6n8TMVyFKoUmDc4apxceRD'),
('kkkkkkkkkkkkkkk2', '4zP2e2aIzOZGEFTq1MDJmm'),
('kkkkkkkkkkkkkkk2', '4Yf5bqU3NK4kNOypcrLYwU'),
('kkkkkkkkkkkkkkk2', '3tFuViD1r1YcjDegM7fiCU'),
('kkkkkkkkkkkkkkk2', '1s7egXFpKAkd5VQBYwVf35'),
('kkkkkkkkkkkkkkk2', '4DJVmSP42li51r1C8zhURQ');

INSERT INTO songsPlaylist (playlistID, songID) VALUES 
('kkkkkkkkkkkkkkk3', '2zoKi9AQKjtn3Q7Ll8CK7v'),
('kkkkkkkkkkkkkkk3', '1lQmSh729NT4nWjfwoYFzq'),
('kkkkkkkkkkkkkkk3', '6sfU2LwBKxjbukPZnUbGtt'),
('kkkkkkkkkkkkkkk3', '3lwZ2WyU3EyEXVkuMrQFfA'),
('kkkkkkkkkkkkkkk3', '7AvvlhwY3wPd2MZs8oiTst'),
('kkkkkkkkkkkkkkk3', '6GG73Jik4jUlQCkKg9JuGO'),
('kkkkkkkkkkkkkkk3', '7Jxz80MpbvTsrW8EttiaY0'),
('kkkkkkkkkkkkkkk3', '3agtg0x11wPvLIWkYR39nZ');


INSERT INTO songsPlaylist (playlistID, songID) VALUES 
('kkkkkkkkkkkkkkk4', '3h0pe0WuiHOPKwsQzw1sba'),
('kkkkkkkkkkkkkkk4', '60IkVf7UfQXmt5CwkpcX8a'),
('kkkkkkkkkkkkkkk4', '2Ats2HOPh5LWzbZx0Wza3y'),
('kkkkkkkkkkkkkkk4', '4pSYgziLKpjKvU92qmvAE9'),
('kkkkkkkkkkkkkkk4', '6n8TMVyFKoUmDc4apxceRD'),
('kkkkkkkkkkkkkkk4', '6sfU2LwBKxjbukPZnUbGtt'),
('kkkkkkkkkkkkkkk4', '4Yf5bqU3NK4kNOypcrLYwU'),
('kkkkkkkkkkkkkkk4', '7AvvlhwY3wPd2MZs8oiTst');

INSERT INTO songsPlaylist (playlistID, songID) VALUES 
('kkkkkkkkkkkkkkk5', '6rLvi0pZPwAVn4XOZ9fDVC'),
('kkkkkkkkkkkkkkk5', '2nLtzopw4rPReszdYBJU6h'),
('kkkkkkkkkkkkkkk5', '3tFuViD1r1YcjDegM7fiCU'),
('kkkkkkkkkkkkkkk5', '1s7egXFpKAkd5VQBYwVf35'),
('kkkkkkkkkkkkkkk5', '2zoKi9AQKjtn3Q7Ll8CK7v'),
('kkkkkkkkkkkkkkk5', '3lwZ2WyU3EyEXVkuMrQFfA'),
('kkkkkkkkkkkkkkk5', '6GG73Jik4jUlQCkKg9JuGO'),
('kkkkkkkkkkkkkkk5', '6DIbm6da7OTfemsUXR9zoc');

INSERT INTO songsPlaylist (playlistID, songID) VALUES 
('kkkkkkkkkkkkkkk6', '21faYZCa7djPLYSlg09stC'),
('kkkkkkkkkkkkkkk6', '17bgialGAwoiGj1STY4cnR'),
('kkkkkkkkkkkkkkk6', '4zP2e2aIzOZGEFTq1MDJmm'),
('kkkkkkkkkkkkkkk6', '4DJVmSP42li51r1C8zhURQ'),
('kkkkkkkkkkkkkkk6', '1lQmSh729NT4nWjfwoYFzq'),
('kkkkkkkkkkkkkkk6', '7Jxz80MpbvTsrW8EttiaY0'),
('kkkkkkkkkkkkkkk6', '3agtg0x11wPvLIWkYR39nZ'),
('kkkkkkkkkkkkkkk6', '4Yf5bqU3NK4kNOypcrLYwU');

CREATE TABLE playlistPopolari(

	id VARCHAR(255),
	PRIMARY KEY(id),
	FOREIGN KEY (id) REFERENCES playlist(id)
);
*/


