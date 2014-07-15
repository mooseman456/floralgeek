-- File name: load_data.sql
-- File author: Joe St. Angelo
--
-- File is to be used for the Floralgeek Sales Database

LOAD DATA LOCAL INFILE 'htdocs/floralgeek/Database/property_active_with_phones.csv'
INTO TABLE contacts 
FIELDS TERMINATED BY ','
ENCLOSED BY '"'
LINES TERMINATED BY '\r\n'
IGNORE 2 LINES
(@contactID, businessName, addressOne, city, state, addressTwo, country, zip, countryCode, phone, numRooms, GDS);


DELETE FROM CONTACTS WHERE businessName = "";