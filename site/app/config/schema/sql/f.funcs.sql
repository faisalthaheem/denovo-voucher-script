-- -----------------------------------------------------
-- function createSafeTitle
-- -----------------------------------------------------
DROP function IF EXISTS `createSafeTitle`;

DELIMITER $$
CREATE FUNCTION `createSafeTitle`(actualName VARCHAR(255)) RETURNS varchar(255) CHARSET latin1
BEGIN

-- 	Denovo Voucher Script
-- 	Copyright (c) 2007-2012 Computed Synergy, http://www.computedsynergy.com

    DECLARE safeName VARCHAR(255);
    DECLARE i INT;
    DECLARE temp VARCHAR(1);
    
    SET actualName = LOWER(actualName); 
    SET actualName = TRIM(actualName); 
    SET actualName = REPLACE(actualName, ' ', '-'); 
    SET actualName = REPLACE(actualName, '.', '_'); 
    
    SET i = 1;
    SET safeName = "";
    
    CharLoop: LOOP
    
        SET temp = SUBSTR(actualName, i, 1);
        
        IF  (ASCII(temp) >= 48 AND ASCII(temp) <= 57)
            OR 
            (ASCII(temp) >= 97 AND ASCII(temp) <= 122)
            OR 
            (ASCII(temp) = 45)
            OR
            (ASCII(temp) = 95)
        THEN
        
            SET safeName = CONCAT(safeName, temp);
        
        END IF;
        
        SET i = i + 1;
        
        
        IF i > CHAR_LENGTH(actualName) THEN
            
            LEAVE CharLoop;
        
        END IF;
    
    END LOOP;
    
    SET safeName = CONCAT(safeName, "-", FLOOR(1111 + (RAND() * 99999)));
    
    RETURN safeName;
END$$
DELIMITER ;


-- -----------------------------------------------------
-- procedure splitString
-- -----------------------------------------------------
DROP procedure IF EXISTS `splitString`;

DELIMITER $$
CREATE PROCEDURE `splitString`(inSites VARCHAR(255))
BEGIN

-- 	Denovo Voucher Script
-- 	Copyright (c) 2007-2012 Computed Synergy, http://www.computedsynergy.com

    DECLARE mString VARCHAR(255);
    DECLARE mId VARCHAR(10);
    DROP TABLE IF EXISTS temp;
    CREATE TEMPORARY TABLE temp (site_id VARCHAR(10) ) engine=InnoDb; 
        
    SET mString = inSites;
    
    Word_LOOP:  LOOP
    
        IF Length(mString) > 0 THEN
    
            IF LOCATE(',', mString) <> 0 THEN
                SET mId = SUBSTRING_INDEX(mString, ',', 1);
                INSERT INTO temp (site_id) values (Trim(mId));
                SET mString = REPLACE(mString, mId, '');
                SET mString = INSERT(mString, 1, 1, '');
            ELSE
                INSERT INTO temp (site_id) values (Trim(mString));
                LEAVE Word_LOOP;
            END IF;
        
        ELSE 
            LEAVE Word_LOOP;
        END IF;
    
    END LOOP;
END$$

DELIMITER ;

