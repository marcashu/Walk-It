CREATE DATABASE walkitdatabase; 

CREATE TABLE useraccount 

( userid int NOT NULL AUTO_INCREMENT, 

  firstname char(50) NOT NULL,

  lastname char(50) NOT NULL, 

  username varchar(50) NOT NULL, 

  password LONGTEXT NOT NULL,

  email varchar(50) NOT NULL, 

  PRIMARY KEY (userid) 

); 

CREATE TABLE counties 
(
  countyid varchar(25) NOT NULL,
  county varchar(50) NOT NULL,
  PRIMARY KEY  (countyID)
)

INSERT INTO `counties` (`countyID`, `county`) VALUES
("1", "London"),
("2", "Bedfordshire"),
("3", "Buckinghamshire"),
("4", "Cambridgeshire"),
("5", "Cheshire"),
("6", "Cornwall and Isles of Scilly"),
("7", "Cumbria"),
("8", "Derbyshire"),
("9", "Devon"),
("10", "Dorset"),
("11", "Durham"),
("12", "East Sussex"),
("13", "Essex"),
("14", "Gloucestershire"),
("15", "Greater London"),
("16", "Greater Manchester"),
("17", "Hampshire"),
("18", "Hertfordshire"),
("19", "Kent"),
("20", "Lancashire"),
("21", "Leicestershire"),
("22", "Lincolnshire"),
("23", "Merseyside"),
("24", "Norfolk"),
("25", "North Yorkshire"),
("26", "Northamptonshire"),
("27", "Northumberland"),
("28", "Nottinghamshire"),
("29", "Oxfordshire"),
("30", "Shropshire"),
("31", "Somerset"),
("32", "South Yorkshire"),
("33", "Staffordshire"),
("34", "Suffolk"),
("35", "Surrey"),
("36", "Tyne and Wear"),
("37", "Warwickshire"),
("38", "West Midlands"),
("39", "West Sussex"),
("40", "West Yorkshire"),
("41", "Wiltshire"),
("42", "Worcestershire"),
("43", "Flintshire"),
("44", "Glamorgan"),
("45", "Merionethshire"),
("46", "Monmouthshire"),
("47", "Montgomeryshire"),
("48", "Pembrokeshire"),
("49", "Radnorshire"),
("50", "Anglesey"),
("51", "Breconshire"),
("52", "Caernarvonshire"),
("53", "Cardiganshire"),
("54", "Carmarthenshire"),
("55", "Denbighshire"),
("56", "Kirkcudbrightshire"),
("57", "Lanarkshire"),
("58", "Midlothian"),
("59", "Moray"),
("60", "Nairnshire"),
("61", "Orkney"),
("62", "Peebleshire"),
("63", "Perthshire"),
("64", "Renfrewshire"),
("65", "Ross & Cromarty"),
("66", "Roxburghshire"),
("67", "Selkirkshire"),
("68", "Shetland"),
("69", "Stirlingshire"),
("70", "Sutherland"),
("71", "West Lothian"),
("72", "Wigtownshire"),
("73", "Aberdeenshire"),
("74", "Angus"),
("75", "Argyll"),
("76", "Ayrshire"),
("77", "Banffshire"),
("78", "Berwickshire"),
("79", "Bute"),
("80", "Caithness"),
("81", "Clackmannanshire"),
("82", "Dumfriesshire"),
("83", "Dumbartonshire"),
("84", "East Lothian"),
("85", "Fife"),
("86", "Inverness"),
("87", "Kincardineshire"),
("88", "Kinross-shire");

CREATE TABLE pathcoordinates

( pathid int NOT NULL AUTO_INCREMENT,

  tmestamp timestamp NOT NULL,
  
  pathname char(50) NOT NULL,

  coords text NOT NULL,

  userid int NOT NULL,

  countyid varchar(25) NOT NULL,

  PRIMARY KEY (pathid),

  FOREIGN KEY (userid) REFERENCES useraccount(userid),

  FOREIGN KEY (countyid) REFERENCES counties(countyid)

);