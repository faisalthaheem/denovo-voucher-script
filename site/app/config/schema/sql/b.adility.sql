SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';


-- -----------------------------------------------------
-- Table `aodbcategoriesdumps`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `aodbcategoriesdumps` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `odbid` VARCHAR(100) NULL ,
  `parent_id` VARCHAR(100) NULL ,
  `title` VARCHAR(255) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
COMMENT = 'Temporary table for dumping in categories imported from rest' /* comment truncated */ ;


-- -----------------------------------------------------
-- Table `aodbadvertiserdumps`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `aodbadvertiserdumps` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `odbid` VARCHAR(100) NULL ,
  `title` VARCHAR(255) NULL ,
  `description` TEXT NULL ,
  `category_id` VARCHAR(100) NULL ,
  `contact_phone` VARCHAR(45) NULL ,
  `site_url` VARCHAR(1024) NULL ,
  `logo_url` VARCHAR(1024) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `aodbcategories`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `aodbcategories` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `odbid` VARCHAR(100) NULL ,
  `title` VARCHAR(255) NULL ,
  `processed` TINYINT NULL DEFAULT 0 ,
  `created` DATETIME NULL ,
  `modified` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `title_index` (`title` ASC) ,
  INDEX `processed_index` (`processed` ASC) ,
  INDEX `odb_id_index` (`odbid` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `aodbadvertiserlocationsdumps`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `aodbadvertiserlocationsdumps` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `advertiser_id` VARCHAR(100) NULL ,
  `aodboffer_id` VARCHAR(100) NULL ,
  `address1` VARCHAR(255) NULL ,
  `address2` VARCHAR(255) NULL ,
  `city` VARCHAR(100) NULL ,
  `state` VARCHAR(45) NULL ,
  `zipcode` VARCHAR(45) NULL ,
  `lat` DOUBLE NULL ,
  `lng` DOUBLE NULL ,
  `country_code` VARCHAR(45) NULL ,
  `comments` TEXT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `aodbadvertisers`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `aodbadvertisers` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `odbid` VARCHAR(100) NULL ,
  `title` VARCHAR(255) NULL ,
  `description` TEXT NULL ,
  `category_id` VARCHAR(100) NULL ,
  `contact_phone` VARCHAR(45) NULL ,
  `site_url` VARCHAR(1024) NULL ,
  `logo_url` VARCHAR(1024) NULL ,
  `processed` TINYINT NULL DEFAULT 0 ,
  `created` DATETIME NULL ,
  `modified` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `odb_id_index` (`odbid` ASC) ,
  INDEX `processed_index` (`processed` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `aodbadvertiserlocations`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `aodbadvertiserlocations` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `advertiser_id` VARCHAR(100) NULL ,
  `aodboffer_id` VARCHAR(100) NULL ,
  `address1` VARCHAR(255) NULL ,
  `address2` VARCHAR(255) NULL ,
  `city` VARCHAR(100) NULL ,
  `state` VARCHAR(45) NULL ,
  `zipcode` VARCHAR(45) NULL ,
  `lat` DOUBLE NULL ,
  `lng` DOUBLE NULL ,
  `country_code` VARCHAR(45) NULL ,
  `comments` TEXT NULL ,
  `processed` TINYINT NULL DEFAULT 0 ,
  `created` DATETIME NULL ,
  `modified` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `advertiser_id_index` (`advertiser_id` ASC) ,
  INDEX `offer_id_index` (`aodboffer_id` ASC) ,
  INDEX `processed_index` (`processed` ASC) ,
  INDEX `country_code` (`country_code` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `aodboffersdumps`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `aodboffersdumps` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `aodbid` VARCHAR(100) NULL ,
  `sku` VARCHAR(100) NULL ,
  `title` VARCHAR(255) NULL ,
  `price` DOUBLE NULL ,
  `cvalue` DOUBLE NULL ,
  `quantity` INT NULL DEFAULT -1 ,
  `ctype` VARCHAR(45) NULL ,
  `discounttype` VARCHAR(45) NULL ,
  `discountvalue` DOUBLE NULL ,
  `checkinsrequired` INT NULL ,
  `fineprint` TEXT NULL ,
  `description` TEXT NULL ,
  `items` TEXT NULL COMMENT 'certificate items not to be initially supported. text field so to store all data.' ,
  `startdate` DATETIME NULL ,
  `enddate` DATETIME NULL ,
  `expirationdate` DATETIME NULL ,
  `advertisername` VARCHAR(255) NULL ,
  `advertiserid` VARCHAR(100) NULL ,
  `illustrationurl` VARCHAR(1024) NULL ,
  `revenue` DOUBLE NULL ,
  `publishedat` DATETIME NULL ,
  `updatedat` DATETIME NULL ,
  `soldoutat` DATETIME NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `aodboffers`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `aodboffers` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `aodbid` VARCHAR(100) NULL ,
  `sku` VARCHAR(100) NULL ,
  `title` VARCHAR(255) NULL ,
  `price` DOUBLE NULL ,
  `cvalue` DOUBLE NULL ,
  `quantity` INT NULL DEFAULT -1 COMMENT '0 quantity mean unlimited.' ,
  `ctype` VARCHAR(45) NULL ,
  `discounttype` VARCHAR(45) NULL ,
  `discountvalue` DOUBLE NULL ,
  `checkinsrequired` INT NULL ,
  `fineprint` TEXT NULL ,
  `description` TEXT NULL ,
  `items` TEXT NULL COMMENT 'certificate items not to be initially supported. text field so to store all data.' ,
  `startdate` DATETIME NULL ,
  `enddate` DATETIME NULL ,
  `expirationdate` DATETIME NULL ,
  `advertisername` VARCHAR(255) NULL ,
  `advertiserid` VARCHAR(100) NULL ,
  `illustrationurl` VARCHAR(1024) NULL ,
  `revenue` DOUBLE NULL ,
  `publishedat` DATETIME NULL ,
  `updatedat` DATETIME NULL ,
  `soldoutat` DATETIME NULL ,
  `processed` TINYINT NULL DEFAULT 0 ,
  `created` DATETIME NULL ,
  `modified` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `aodbid_index` (`aodbid` ASC) ,
  INDEX `type_index` (`ctype` ASC) ,
  INDEX `advertiserid_index` (`advertiserid` ASC) ,
  INDEX `processed_index` (`processed` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- procedure AdilityODBCopyAdvertisersFromDump
-- -----------------------------------------------------
DELIMITER $$
CREATE PROCEDURE `AdilityODBCopyAdvertisersFromDump`()

BEGIN
/*

	Denovo Voucher Script
	Copyright (c) 2007-2011 Computed Synergy, http://www.computedsynergy.com
	Website: http://www.voucherscript.com
	Support: http://talk.voucherscript.com
	Email: support@voucherscript.com
	The DVS License (http://www.voucherscript.com/license.html)

*** THIS IS A COMMERCIAL PRODUCT ***
*** FOR PERSONAL USE ONLY, REDISTRIBUTION PROHIBITED IN ANY FORM AND/OR MANNER ***

*/

/**
 *   STORED PROCEDURE : AdilityODBCopyAdvertisersFromDump
 *   DESCRIPTION      : This SP copies all merchants from dump table to middle dump table.
 */

    -- Declare Variables
    DECLARE done INT DEFAULT 0;                 -- flag for no more records
    DECLARE mODBAdvertiserId VARCHAR(100);      -- for odbid
    DECLARE mMerchantName VARCHAR(255);         -- merchant name
    DECLARE mDescription TEXT;                  -- for description
    DECLARE mCategoryId VARCHAR(100);           -- for category_id
    DECLARE mContactPhone VARCHAR(45);          -- for contact_phone
    DECLARE mSiteURL VARCHAR(1024);             -- for site_url
    DECLARE mLogoURL VARCHAR(1024);             -- for logo_url

    -- Declare Cursor and Handler
    DECLARE MerchantDump CURSOR FOR 
        SELECT  odbid, title, description, category_id, contact_phone, 
                site_url, logo_url
                FROM aodbadvertiserdumps;
    
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;

    
    OPEN MerchantDump;

    Merchant_Records: LOOP
    
        FETCH MerchantDump INTO 
            mODBAdvertiserId, mMerchantName, mDescription, 
            mCategoryId, mContactPhone, mSiteURL, mLogoURL;  
    
        IF done THEN
            Leave Merchant_Records;
        END IF;
        
        -- Check if Advertiser Exists
        --      Update Advertiser details
        -- ELSE 
        --      Insert Advertiser
        IF (SELECT Count(*) FROM aodbadvertisers WHERE odbid = mODBAdvertiserId) = 0 THEN
        
            INSERT INTO aodbadvertisers
                    
                    (odbid, title, description, category_id, contact_phone, site_url, 
                    logo_url, processed, created, modified)
                    
                    VALUES
                    
                    (mODBAdvertiserId, mMerchantName, mDescription, mCategoryId, 
                    mContactPhone, mSiteURL, mLogoURL, 0, now(), now());
    
    
        ELSEIF (SELECT Count(*) FROM aodbadvertisers WHERE odbid = mODBAdvertiserId) > 0 THEN
        
            UPDATE aodbadvertisers SET
                
                title = mMerchantName, 
                description = mDescription,
                contact_phone = mContactPhone, 
                site_url = mSiteURL, 
                logo_url = mLogoURL
                
                WHERE odbid = mODBAdvertiserId AND processed = 0;
        
        END IF;
    
    END LOOP;

    CLOSE MerchantDump;
END




$$

$$
DELIMITER ;


-- -----------------------------------------------------
-- procedure AdilityODBCopyCategoriesFromDump
-- -----------------------------------------------------
DELIMITER $$
CREATE PROCEDURE `AdilityODBCopyCategoriesFromDump`()

BEGIN
/*

	Denovo Voucher Script
	Copyright (c) 2007-2011 Computed Synergy, http://www.computedsynergy.com
	Website: http://www.voucherscript.com
	Support: http://talk.voucherscript.com
	Email: support@voucherscript.com
	The DVS License (http://www.voucherscript.com/license.html)

*** THIS IS A COMMERCIAL PRODUCT ***
*** FOR PERSONAL USE ONLY, REDISTRIBUTION PROHIBITED IN ANY FORM AND/OR MANNER ***

*/

/**
 *       STORED PROCEDURE : AdilityODBCopyCategoriesFromDump
 *       DESCRIPTION      : This SP inserts and Updates categories to middle dump table from categories dump table.
 */
    
    DECLARE done INT DEFAULT 0;     -- flag for no more records
    DECLARE cat_name VARCHAR(255);  -- for category name    
    DECLARE cat_id VARCHAR(100);    -- category id
    
    -- Declaring cursor and Handler
    DECLARE catDump CURSOR FOR 
        SELECT  odbid, title  
                FROM aodbcategoriesdumps;
    
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;

    OPEN catDump;
    
    categry: LOOP
        
        FETCH catDump INTO cat_id, cat_name;
        
        IF done THEN
            LEAVE categry;
        END IF;
        
        
        -- Check if category exist 
        --  Update it
        -- Else 
        --  Insert it
        
        IF (SELECT COUNT(*) FROM aodbcategories WHERE odbid = cat_id) > 0 THEN
        
            /* UPDATE if Category already exists */
            UPDATE aodbcategories SET title = cat_name WHERE odbid = cat_id;
        
        
        ELSEIF (SELECT COUNT(*) FROM aodbcategories WHERE odbid = cat_id) = 0 THEN
        
            /* INSERT category if does not exits */
            INSERT INTO aodbcategories
                    
                (odbid, title, processed, created, modified)
                
                VALUES
                
                (cat_id, cat_name, 0, now(), now());
        
        END IF;  
        
    END LOOP;
    
    CLOSE catDump;

END




$$

$$
DELIMITER ;


-- -----------------------------------------------------
-- procedure AdilityODBCopyOffersFromDump
-- -----------------------------------------------------
DELIMITER $$
CREATE PROCEDURE `AdilityODBCopyOffersFromDump`()

BEGIN
/*

	Denovo Voucher Script
	Copyright (c) 2007-2011 Computed Synergy, http://www.computedsynergy.com
	Website: http://www.voucherscript.com
	Support: http://talk.voucherscript.com
	Email: support@voucherscript.com
	The DVS License (http://www.voucherscript.com/license.html)

*** THIS IS A COMMERCIAL PRODUCT ***
*** FOR PERSONAL USE ONLY, REDISTRIBUTION PROHIBITED IN ANY FORM AND/OR MANNER ***

*/

/**
 *       STORED PROCEDURE : AdilityODBCopyOffersFromDump
 *       DESCRIPTION      : This SP inserts and Updates Offers from dump table to middle dump table.
 */

    -- Declare Variables 
    DECLARE done INT DEFAULT 0;             -- flag for no more records
    DECLARE mOfferAodbId VARCHAR(100);      -- for aodbid offer id    
    DECLARE mSKU VARCHAR(100);              -- for sku
    DECLARE mTitle VARCHAR(255);            -- for title
    DECLARE mPrice DOUBLE;                  -- for price
    DECLARE mCValue DOUBLE;                  -- for value
    DECLARE mQuantity INT;                  -- for quantity
    DECLARE mCType VARCHAR(45);              -- for type
    DECLARE mDiscountType VARCHAR(45);      -- for discounttype
    DECLARE mDiscountValue DOUBLE;          -- for discountvalue
    DECLARE mCheckInsRequired INT;          -- for checkinsrequired
    DECLARE mFinePrint TEXT;                -- for fineprint
    DECLARE mDescription TEXT;              -- for offer description
    DECLARE mItems TEXT;                    -- for items
    DECLARE mStartDate DATETIME;            -- for startdate
    DECLARE mEndDate DATETIME;              -- for enddate
    DECLARE mExpirationDate DATETIME;       -- for expirationdate
    DECLARE mAdvertiserName VARCHAR(255);   -- for advertisername
    DECLARE mAdvertiserId VARCHAR(100);     -- for advertiserid
    DECLARE mIllustrationURL VARCHAR(1024); -- for illustrationurl
    DECLARE mRevenue DOUBLE;                -- for revenue
    DECLARE mPublishedAt DATETIME;          -- for publishedat
    DECLARE mUpdatedAt DATETIME;            -- for updatedat
    DECLARE mSoldoutAt DATETIME;            -- for soldoutat
    
    -- Declaring cursor and Handler
    DECLARE OffersDump CURSOR FOR 
    SELECT  aodbid, sku, title, price, cvalue, quantity, ctype,
            discounttype, discountvalue, checkinsrequired, fineprint,
            description, items, startdate, enddate, expirationdate, 
            advertisername, advertiserid, illustrationurl, revenue,
            publishedat, updatedat, soldoutat
            FROM aodboffersdumps;
    
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;

    
    OPEN OffersDump;
    
    Offers_Loop: LOOP
    
        Fetch OffersDump INTO 
            
            mOfferAodbId, mSKU, mTitle, mPrice, mCValue, mQuantity, mCType, 
            mDiscountType, mDiscountValue, mCheckInsRequired, mFinePrint,
            mDescription, mItems, mStartDate, mEndDate, mExpirationDate,
            mAdvertiserName, mAdvertiserId, mIllustrationURL, mRevenue, 
            mPublishedAt, mUpdatedAt, mSoldoutAt; 
            
        IF done THEN
            Leave Offers_Loop;
        END IF;
        
        
        -- Check if Offer exists
        --      UPDATE Offer Details
        -- ELSE 
        --      INSERT Offer Details
        
        IF(SELECT Count(*) FROM aodboffers WHERE aodbid = mOfferAodbId) = 0 THEN
        
            INSERT INTO aodboffers 
                            
                (
                    aodbid, sku, title, price, cvalue, quantity, ctype, discounttype, discountvalue,
                    checkinsrequired, fineprint, description, items, startdate, enddate, expirationdate,
                    advertisername, advertiserid, illustrationurl, revenue, publishedat, updatedat,
                    soldoutat, processed, created, modified
                )
                
                VALUES
                            
                (
                    mOfferAodbId, mSKU, mTitle, mPrice, mCValue, mQuantity, mCType, mDiscountType, 
                    mDiscountValue, mCheckInsRequired, mFinePrint, mDescription, mItems, mStartDate, 
                    mEndDate, mExpirationDate, mAdvertiserName, mAdvertiserId, mIllustrationURL, mRevenue, 
                    mPublishedAt, mUpdatedAt, mSoldoutAt, 0, now(), now() 
                
                );
        
        ELSEIF (SELECT Count(*) FROM aodboffers WHERE aodbid = mOfferAodbId) > 0 THEN
        
            UPDATE aodboffers SET
            
                            sku = mSKU, 
                            title = mTitle, 
                            price = mPrice, 
                            cvalue = mCValue, 
                            quantity = mQuantity,
                            ctype = mCType, 
                            discounttype = mDiscountType, 
                            discountvalue = mDiscountValue, 
                            checkinsrequired = mCheckInsRequired, 
                            fineprint = mFinePrint, 
                            description = mDescription, 
                            items = mItems, 
                            startdate = mStartDate,
                            enddate = mEndDate,
                            expirationdate = mExpirationDate,
                            advertisername = mAdvertiserName,
                            advertiserid = mAdvertiserId,
                            illustrationurl = mIllustrationURL,
                            revenue = mRevenue,
                            publishedat = mPublishedAt,
                            updatedat = mUpdatedAt,
                            soldoutat = mSoldoutAt
                            
                            WHERE aodbid = mOfferAodbId AND processed = 0;
        END IF;
    
    END LOOP;
    
    CLOSE OffersDump;

END



$$

$$
DELIMITER ;


-- -----------------------------------------------------
-- procedure AdilityODBGetImportedAdvertisers
-- -----------------------------------------------------
DELIMITER $$
CREATE PROCEDURE `AdilityODBGetImportedAdvertisers`(mSites VARCHAR(255))
BEGIN
/*

	Denovo Voucher Script
	Copyright (c) 2007-2011 Computed Synergy, http://www.computedsynergy.com
	Website: http://www.voucherscript.com
	Support: http://talk.voucherscript.com
	Email: support@voucherscript.com
	The DVS License (http://www.voucherscript.com/license.html)

*** THIS IS A COMMERCIAL PRODUCT ***
*** FOR PERSONAL USE ONLY, REDISTRIBUTION PROHIBITED IN ANY FORM AND/OR MANNER ***

*/

/**
 * STORED PROCEDURE : AdilityODBGetImportedAdvertisers
 * DESCRIPTION      : This SP copies all merchants imported from Adility to our live merchants table.
 */

    -- Declare Variables
    DECLARE done INT DEFAULT 0;                 -- flag for no more records
    DECLARE mAdvertiserId VARCHAR(100);         -- for aodbid
    DECLARE mTitle VARCHAR(255);                -- for title
    DECLARE mDescription TEXT;                  -- for description
    DECLARE mCategoryId VARCHAR(100);           -- for category_id
    DECLARE mContactPhone VARCHAR(45);          -- for contact_phone
    DECLARE mSiteURL VARCHAR(1024);             -- for site_url
    DECLARE mLogoURL VARCHAR(1024);             -- for logo_url

    DECLARE mCatId INT;                        -- category primery key
    DECLARE mMergedId INT;                      -- merged in category id
    DECLARE mMerchantId INT;                    -- Merchant primery key
    
    -- Declare Cursor and Handler
    DECLARE Advertiser CURSOR FOR 
        SELECT  odbid, title, description, category_id, contact_phone, 
                site_url, logo_url 
                FROM aodbadvertisers
                WHERE processed = 0;
    
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;

    -- following procedure creates a temporary table 
    -- of default site ids for this plugin 
    call splitString(mSites);

    -- Opening Cursor
    OPEN Advertiser;

    Merchant: LOOP
    
        FETCH Advertiser INTO 
            mAdvertiserId, mTitle, mDescription, mCategoryId, 
            mContactPhone, mSiteURL, mLogoURL;  
    
        IF done THEN
            Leave Merchant;
        END IF;

        --  NEW ALGO    
        --  IF merchant name exists
        --      update merchant if autoupdate is 1
        --  ELSE
        --      IF merchant id exists
        --          update merchant if autoupdate is 1
        --      ELSE
        --          insert merchant
        --          create relation with category check if category merged
        --          create relation with default sites
        --      END IF;

        IF (SELECT Count(*) FROM merchants WHERE merchant_name = mTitle) > 0 THEN
        
            -- merchant name found
            IF (SELECT Count(*) FROM merchants WHERE merchant_name = mTitle AND autoupdate = 1) THEN
                UPDATE merchants SET
                        aodb_advertiser_id = mAdvertiserId, description = mDescription, contact_phone = mContactPhone,
                        logo_url = mLogoURL, site_url = mSiteURL, modified = now()
                        WHERE merchant_name = mTitle;
        
            ELSE
                UPDATE merchants SET
                        aodb_advertiser_id = mAdvertiserId, modified = now()
                        WHERE merchant_name = mTitle;
            END IF;
        
        ELSE 
            
            -- merchant name not found check for aodbId
            IF (SELECT Count(*) FROM merchants WHERE aodb_advertiser_id = mAdvertiserId) > 0 THEN
                
                -- merchant id found
                IF (SELECT Count(*) FROM merchants WHERE aodb_advertiser_id = mAdvertiserId AND autoupdate = 1) THEN
                    
                    UPDATE merchants SET
                            merchant_name = mTitle,
                            description = mDescription,
                            contact_phone = mContactPhone,
                            logo_url = mLogoURL,
                            site_url = mSiteURL,
                            modified = now()
                            WHERE 
                            aodb_advertiser_id = mAdvertiserId;
        
                END IF;
            
            ELSE
            
                -- id not found now insert merchant
                INSERT INTO merchants
                    (source, merchant_name, safe_merchant_name, description, aodb_advertiser_id, contact_phone, 
                    logo_url, site_url, created, modified)
                    VALUES
                    ('AdilityODB', mTitle, (SELECT createSafeTitle(mTitle)), mDescription, mAdvertiserId, 
                    mContactPhone, mLogoURL, mSiteURL, now(), now());
                
                SELECT id INTO mMerchantId FROM merchants WHERE aodb_advertiser_id = mAdvertiserId;
                
                -- check for merchant category
                IF (SELECT Count(*) FROM categories WHERE aodb_category_id = mCategoryId) > 0 THEN
                
                    SELECT id, merged_in INTO mCatId, mMergedId FROM categories WHERE aodb_category_id = mCategoryId;
                    
                    IF mMergedId <> 0 THEN
                        SET mCatId = mMergedId;
                    END IF;
                
                    INSERT INTO categories_merchants
                        (category_id, merchant_id) VALUES (mCatId, mMerchantId);
                
                END IF;
                
                /* Here we have to create relation between sites and newly added merchant*/
                IF (SELECT Count(*) FROM temp) > 0 THEN
                        INSERT INTO merchants_sites (site_id, merchant_id) 
                                    SELECT site_id, mMerchantId FROM temp;
                END IF;
                /* END */
            
            END IF;
        
        END IF;

        -- Mark Record as Processed
        UPDATE aodbadvertisers SET processed = 1 WHERE odbid = mAdvertiserId AND processed = 0;
    
    END LOOP;

    Close Advertiser;
END




$$

$$
DELIMITER ;


-- -----------------------------------------------------
-- procedure AdilityODBGetImportedCategories
-- -----------------------------------------------------
DELIMITER $$
CREATE PROCEDURE `AdilityODBGetImportedCategories`(mSites VARCHAR(255))

BEGIN
/*

	Denovo Voucher Script
	Copyright (c) 2007-2011 Computed Synergy, http://www.computedsynergy.com
	Website: http://www.voucherscript.com
	Support: http://talk.voucherscript.com
	Email: support@voucherscript.com
	The DVS License (http://www.voucherscript.com/license.html)

*** THIS IS A COMMERCIAL PRODUCT ***
*** FOR PERSONAL USE ONLY, REDISTRIBUTION PROHIBITED IN ANY FORM AND/OR MANNER ***

*/

/**
 *  STORED PROCEDURE : AdilityODBGetImportedCategories
 *  DESCRIPTION      : This SP transfer all imported Categories From Adility to Live db (also creates association with default sites).
 */
    
    
    DECLARE done INT DEFAULT 0;     -- flag for no more records
    DECLARE mCatName VARCHAR(255);  -- for category name    
    DECLARE mCatId VARCHAR(100);    -- category id
    DECLARE mExistingCatId INT;     -- used for existing category id
    DECLARE mAutoUpdate BOOLEAN;    -- used for existing category autoupdate flag
    
    -- Declaring cursor and Handler
    DECLARE category CURSOR FOR 
        SELECT  odbid, title
                FROM aodbcategories
                WHERE processed = 0;
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;
    
    -- following procedure creates a temporary table 
    -- of default site ids for this plugin 
    call splitString(mSites);  
    
    OPEN category;
    
    cat_loop: LOOP
    
        Fetch category INTO mCatId, mCatName;
        
        IF done THEN
            LEAVE cat_loop;
        END IF;
    
        --  IF category name exists then
        --      IF autoupdate IS SET To TRUE then
        --          update category (update category name, insert network id)
        --      ELSE IF autoupdate IS SET To FALSE then
        --          update category (insert network id only)      
        --      ENDIF;
        --  ELSE 
        --      IF category_id exists then
        --          IF autoupdate is SET To TRUE then
        --              update category (name only)
        --          ENDIF;
        --      ELSE
        --          INSERT category 
        --          IF default-sites specified
        --              Create sites category relations
        --          END IF;
        --      ENDIF;
        --  ENDIF;
        

        -- check category name exits
        IF (SELECT Count(*) FROM categories WHERE catname = mCatName) > 0 THEN
        
            SELECT id, autoupdate INTO mExistingCatId, mAutoUpdate  FROM categories WHERE catname =  mCatName;
            -- category name found
            -- check auto update is true
            IF mAutoUpdate = TRUE THEN
            
                -- Update Category name
                UPDATE  categories SET 
                        catname = mCatName,
                        aodb_category_id = mCatId
                        WHERE id = mExistingCatId;
                
            ELSEIF mAutoUpdate = FALSE THEN
            
                -- Update category network id only
                UPDATE  categories SET
                        aodb_category_id = mCatId
                        WHERE id = mExistingCatId;
            
            END IF;
        
        ELSE
            
            -- Category name not found, check for network id of the category
            IF (SELECT Count(*) FROM categories WHERE aodb_category_id = mCatId) > 0 THEN
                
                IF (SELECT autoupdate FROM categories WHERE aodb_category_id = mCatId) = TRUE THEN
                
                    UPDATE  categories SET 
                            catname = mCatName
                            WHERE aodb_category_id = mCatId;
                END IF;
            
            ELSE
                
                INSERT INTO categories
                        (catname, safe_catname, aodb_category_id, source, parent_id, created, modified)
                        VALUES
                        (mCatName, (SELECT createSafeTitle(mCatName)), mCatId, 'AdilityODB', 0, now(), now());
                
                        /* Here we have to create relation between site and newly added category */
                    
                        IF (SELECT Count(*) FROM temp) > 0 THEN
                    
                            INSERT INTO categories_sites (site_id, category_id) 
                                    SELECT site_id, (SELECT id FROM categories WHERE aodb_category_id = mCatId)  
                                    FROM temp;
                        /* END */
                    
                        END IF;
                
            END IF;
            
        END IF;
        
        UPDATE aodbcategories 
            SET processed = 1 
            WHERE odbid = mCatId AND processed = 0;
    
    END LOOP;
    
    CLOSE category;
END



$$

$$
DELIMITER ;


-- -----------------------------------------------------
-- procedure AdilityODBGetImportedOffers
-- -----------------------------------------------------
DELIMITER $$
CREATE PROCEDURE `AdilityODBGetImportedOffers`(mSites VARCHAR(255))
BEGIN
/*

	Denovo Voucher Script
	Copyright (c) 2007-2011 Computed Synergy, http://www.computedsynergy.com
	Website: http://www.voucherscript.com
	Support: http://talk.voucherscript.com
	Email: support@voucherscript.com
	The DVS License (http://www.voucherscript.com/license.html)

*** THIS IS A COMMERCIAL PRODUCT ***
*** FOR PERSONAL USE ONLY, REDISTRIBUTION PROHIBITED IN ANY FORM AND/OR MANNER ***

*/

/**
 *  STORED PROCEDURE : AdilityODBGetImportedOffers
 *  DESCRIPTION      : This SP inserts and Updates Offers from dump table to middle dump table.
 */

    -- Declare Variables 
    DECLARE done INT DEFAULT 0;             -- flag for no more records
    DECLARE mOfferAodbId VARCHAR(100);      -- for aodbid offer id    
    DECLARE mSKU VARCHAR(100);              -- for sku
    DECLARE mTitle VARCHAR(255);            -- for title
    DECLARE mPrice DOUBLE;                  -- for price
    DECLARE mCValue DOUBLE;                  -- for value
    DECLARE mQuantity INT;                  -- for quantity
    DECLARE mCType VARCHAR(45);              -- for type
    DECLARE mDiscountType VARCHAR(45);      -- for discounttype
    DECLARE mDiscountValue DOUBLE;          -- for discountvalue
    DECLARE mCheckInsRequired INT;          -- for checkinsrequired
    DECLARE mFinePrint TEXT;                -- for fineprint
    DECLARE mDescription TEXT;              -- for offer description
    DECLARE mItems TEXT;                    -- for items
    DECLARE mStartDate DATETIME;            -- for startdate
    DECLARE mEndDate DATETIME;              -- for enddate
    DECLARE mExpirationDate DATETIME;       -- for expirationdate
    DECLARE mAdvertiserName VARCHAR(255);   -- for advertisername
    DECLARE mAdvertiserId VARCHAR(100);     -- for advertiserid
    DECLARE mIllustrationURL VARCHAR(1024); -- for illustrationurl
    DECLARE mRevenue DOUBLE;                -- for revenue
    DECLARE mPublishedAt DATETIME;          -- for publishedat
    DECLARE mUpdatedAt DATETIME;            -- for updatedat
    DECLARE mSoldoutAt DATETIME;            -- for soldoutat
    
    -- Declaring cursor and Handler
    DECLARE Offers CURSOR FOR 
    SELECT  aodbid, sku, title, price, cvalue, quantity, ctype,
            discounttype, discountvalue, checkinsrequired, fineprint,
            description, items, startdate, enddate, expirationdate, 
            advertisername, advertiserid, illustrationurl, revenue,
            publishedat, updatedat, soldoutat
            FROM aodboffers
            WHERE processed = 0;
    
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;

    -- following procedure creates a temporary table 
    -- of default site ids for this plugin 
    call splitString(mSites);

    OPEN Offers;
    
    Offers_Loop: LOOP
    
        Fetch Offers INTO 
            
            mOfferAodbId, mSKU, mTitle, mPrice, mCValue, mQuantity, mCType, 
            mDiscountType, mDiscountValue, mCheckInsRequired, mFinePrint,
            mDescription, mItems, mStartDate, mEndDate, mExpirationDate,
            mAdvertiserName, mAdvertiserId, mIllustrationURL, mRevenue, 
            mPublishedAt, mUpdatedAt, mSoldoutAt; 
            
        IF done THEN
            Leave Offers_Loop;
        END IF;
        
        
        -- Check if Offer exists
        --      UPDATE Offer Details
        -- ELSE 
        --      INSERT Offer Details
        
        IF(SELECT Count(*) FROM cods WHERE aodb_id = mOfferAodbId AND source = 'AdilityODB') = 0 THEN
        
            IF (SELECT Count(*) FROM merchants WHERE aodb_advertiser_id = mAdvertiserId) > 0 THEN
            
                INSERT INTO cods 
                    (merchant_id, cod_type, source, aodb_id, title, safe_title, description, start_date, expiry_date, 
                    sku, price, cvalue, quantity, discounttype, discountvalue, checkinsrequired, fineprint, 
                    illustrationurl, revenue, publishedat, updatedat, soldoutat, created, modified)
                    VALUES
                    ((SELECT id FROM merchants WHERE aodb_advertiser_id = mAdvertiserId), mCType, 
                    'AdilityODB', mOfferAodbId, mTitle, (SELECT createSafeTitle(mTitle)),mDescription, mStartDate, mEndDate, mSKU, mPrice, 
                    mCValue, mQuantity, mDiscountType, mDiscountValue, mCheckInsRequired, mFinePrint,  
                    mIllustrationURL, mRevenue, mPublishedAt, mUpdatedAt, mSoldoutAt, now(), now());
        
            
                    /* Here we have to create relation between site and newly added category */         
                    IF (SELECT Count(*) FROM temp) > 0 THEN
                                
                            INSERT INTO cods_sites (site_id, cod_id) 
                                            SELECT site_id, (SELECT id FROM cods WHERE aodb_id = mOfferAodbId)  
                                            FROM temp;
                    END IF;
                    /* END */
            
            END IF;
            
        ELSEIF (SELECT Count(*) FROM cods WHERE aodb_id = mOfferAodbId AND source = 'AdilityODB') > 0 THEN
        
            UPDATE cods SET
                    sku = mSKU, 
                    title = mTitle, 
                    price = mPrice, 
                    cvalue = mCValue, 
                    quantity = mQuantity,
                    discounttype = mDiscountType, 
                    discountvalue = mDiscountValue, 
                    checkinsrequired = mCheckInsRequired, 
                    fineprint = mFinePrint, 
                    description = mDescription, 
                    start_date = mStartDate,
                    expiry_date = mEndDate,
                    illustrationurl = mIllustrationURL,
                    revenue = mRevenue,
                    publishedat = mPublishedAt,
                    updatedat = mUpdatedAt,
                    soldoutat = mSoldoutAt,
                    modified = now()
                    
                    WHERE aodb_id = mOfferAodbId AND source = 'AdilityODB';
        END IF;
        
        UPDATE aodboffers SET processed = 1 WHERE aodbid = mOfferAodbId AND processed = 0;
    
    END LOOP;
    
    CLOSE Offers;

END



$$

$$
DELIMITER ;


-- -----------------------------------------------------
-- procedure AdilityODBCopyLocationsFromDump
-- -----------------------------------------------------
DELIMITER $$
CREATE PROCEDURE `AdilityODBCopyLocationsFromDump`()

BEGIN
/*

	Denovo Voucher Script
	Copyright (c) 2007-2011 Computed Synergy, http://www.computedsynergy.com
	Website: http://www.voucherscript.com
	Support: http://talk.voucherscript.com
	Email: support@voucherscript.com
	The DVS License (http://www.voucherscript.com/license.html)

*** THIS IS A COMMERCIAL PRODUCT ***
*** FOR PERSONAL USE ONLY, REDISTRIBUTION PROHIBITED IN ANY FORM AND/OR MANNER ***

*/

/**
 *       STORED PROCEDURE : AdilityODBCopyLocationsFromDump
 *       DESCRIPTION      : This SP inserts and Updates Redemption locations from dump table to middle dump table.
 */

    -- Declare Variables 
    DECLARE done INT DEFAULT 0;             -- flag for no more records
    DECLARE mOfferAodbId VARCHAR(100);      -- for aodbid offer id    
    DECLARE mAdvertiserId VARCHAR(100);     -- for advertiserid
    DECLARE mAddress1 VARCHAR(255);         -- for address1
    DECLARE mAddress2 VARCHAR(255);         -- for address2
    DECLARE mCity VARCHAR(100);             -- for city
    DECLARE mState VARCHAR(45);             -- for state
    DECLARE mZipCode  VARCHAR(45);          -- for zipcode
    DECLARE mLatitude DOUBLE;               -- for lat
    DECLARE mLongitude DOUBLE;              -- for lng
    DECLARE mCountryCode VARCHAR(45);       -- for country_code
    DECLARE mComments TEXT;                 -- for comments
    
    -- Declaring cursor and Handler
    DECLARE LocationsDump CURSOR FOR 
    SELECT  advertiser_id, aodboffer_id, address1, address2, city, state, 
            zipcode, lat, lng, country_code, comments
            
            FROM aodbadvertiserlocationsdumps;
    
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;

    
    OPEN LocationsDump;
    
    Locations_Loop: LOOP
    
        Fetch LocationsDump INTO 
            
            mAdvertiserId, mOfferAodbId, mAddress1, mAddress2, mCity, mState, 
            mZipCode, mLatitude, mLongitude, mCountryCode, mComments; 
            
        IF done THEN
            Leave Locations_Loop;
        END IF;
        
        
        -- Check if location exists
        --      UPDATE location Details
        -- ELSE 
        --      INSERT location Details
        
        IF (SELECT Count(*) 
                FROM    aodbadvertiserlocations 
                WHERE   advertiser_id = mAdvertiserId
                        AND 
                        aodboffer_id = mOfferAodbId) = 0 
                
            THEN
        
            INSERT INTO aodbadvertiserlocations 
                (
                    advertiser_id, aodboffer_id, address1, address2, city, state, 
                    zipcode, lat, lng, country_code, comments,  processed, created, modified
                )
                VALUES
                (
                    mAdvertiserId, mOfferAodbId, mAddress1, mAddress2, mCity, mState, 
                    mZipCode, mLatitude, mLongitude, mCountryCode, mComments, 0, now(), now()
                );
        
        ELSEIF (SELECT Count(*) 
                FROM    aodbadvertiserlocations 
                WHERE   advertiser_id = mAdvertiserId
                        AND 
                        aodboffer_id = mOfferAodbId) > 0 
                
            THEN
        
            UPDATE aodbadvertiserlocations 
                    SET
                        address1 = mAddress1, 
                        address2 = mAddress2, 
                        city = mCity, 
                        state = mState, 
                        zipcode = mZipCode,
                        lat = mLatitude, 
                        lng = mLongitude, 
                        country_code = mCountryCode,
                        comments = mComments, 
                        processed = 0, 
                        modefied = now() 
                        
                    WHERE   
                        advertiser_id = mAdvertiserId AND aodboffer_id = mOfferAodbId;
        END IF;
    
    END LOOP;
    
    CLOSE LocationsDump;

END



$$

$$
DELIMITER ;


-- -----------------------------------------------------
-- procedure AdilityODBGetImportedLocations
-- -----------------------------------------------------
DELIMITER $$
CREATE PROCEDURE `AdilityODBGetImportedLocations`()

BEGIN
/*

	Denovo Voucher Script
	Copyright (c) 2007-2011 Computed Synergy, http://www.computedsynergy.com
	Website: http://www.voucherscript.com
	Support: http://talk.voucherscript.com
	Email: support@voucherscript.com
	The DVS License (http://www.voucherscript.com/license.html)

*** THIS IS A COMMERCIAL PRODUCT ***
*** FOR PERSONAL USE ONLY, REDISTRIBUTION PROHIBITED IN ANY FORM AND/OR MANNER ***

*/

/**
 *       STORED PROCEDURE : AdilityODBGetImportedLocations
 *       DESCRIPTION      : This Stored Procedure Copies Redemption locations to live db.
 */

    -- Declare Variables 
    DECLARE done INT DEFAULT 0;             -- flag for no more records
    DECLARE mOfferAodbId VARCHAR(100);      -- for aodbid offer id    
    DECLARE mAdvertiserId VARCHAR(100);     -- for advertiserid
    DECLARE mAddress1 VARCHAR(255);         -- for address1
    DECLARE mAddress2 VARCHAR(255);         -- for address2
    DECLARE mCity VARCHAR(100);             -- for city
    DECLARE mState VARCHAR(45);             -- for state
    DECLARE mZipCode  VARCHAR(45);          -- for zipcode
    DECLARE mLatitude DOUBLE;               -- for lat
    DECLARE mLongitude DOUBLE;              -- for lng
    DECLARE mCountryCode VARCHAR(45);       -- for country_code
    DECLARE mComments TEXT;                 -- for comments
    
    DECLARE mCodId INT; -- for primery key of cod
    DECLARE mMerchantId INT; -- for primery key of merchant
    DECLARE mLocationId INT; -- for primery key of location
    
    -- Declaring cursor and Handler
    DECLARE Locations CURSOR FOR 
    SELECT  
        advertiser_id, aodboffer_id, address1, address2, city, state, 
        zipcode, lat, lng, country_code, comments
        
        FROM    
            aodbadvertiserlocations 
        
        WHERE   
            processed = 0;
    
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;

    OPEN Locations;
    
    Locations_Loop: LOOP
    
        Fetch Locations INTO 
            
            mAdvertiserId, mOfferAodbId, mAddress1, mAddress2, mCity, mState, 
            mZipCode, mLatitude, mLongitude, mCountryCode, mComments; 
            
        IF done THEN
            Leave Locations_Loop;
        END IF;
        
        
        --  Check if location exists YES
        --      Update cods relation
        --      update location details
        --
        --  ELSE NO
        --      Check if merchant exists
        --          get merchant_id;
        --          Check if cod exists
        --              get cod_id
        --
        --              insert location.
        --              create cod relation.
        --          end cod Check;
        --      end Merchant Check;
        --  END location check;
        --  Mark Record as Processed.
        --  END;
        
        -- get merchant id if exists
        SET mMerchantId = 0;
        IF(SELECT Count(0) 
                FROM  merchants 
                WHERE aodb_advertiser_id = mAdvertiserId) > 0 THEN
            
            SET mMerchantId = (SELECT id 
                                FROM  merchants 
                                WHERE aodb_advertiser_id = mAdvertiserId);
        END IF;
  
  
        -- get cod id if exists
        SET mCodId = 0;
        IF(SELECT Count(0)
                FROM  cods 
                WHERE aodb_id = mOfferAodbId) > 0 THEN
            
            SET mCodId = (SELECT id 
                            FROM  cods 
                            WHERE aodb_id = mOfferAodbId);
        END IF;
        
        -- check location exists
        IF (SELECT Count(0) 
                FROM    locations
                WHERE   city = mCity AND
                        state = mstate AND
                        lat = mLatitude AND
                        lng = mLongitude AND
                        merchant_id = mMerchantId
                ) > 0 
            
            THEN
            
            -- Location Exists
                IF mCodId > 0 AND mMerchantId > 0 THEN
                                
                    SET mLocationId = (SELECT id 
                                        FROM  locations 
                                        WHERE city = mCity AND 
                                              state = mstate AND 
                                              lat = mLatitude AND 
                                              lng = mLongitude AND
                                              merchant_id = mMerchantId); 
                    
                    -- check if cod and location relation does not exists insert it
                    IF(SELECT Count(0) 
                            FROM    cods_locations 
                            WHERE   location_id = mLocationId AND
                                    cod_id = mCodId) = 0
                        THEN
                    
                        INSERT INTO cods_locations
                                (cod_id, location_id)
                                VALUES
                                (mCodId, mLocationId);
                    END IF;
                
                    UPDATE locations
                            SET
                                address1 = mAddress1,
                                address2 = mAddress2,
                                city = mCity,
                                state = mState,
                                zipcode = mZipCode,
                                lat = mLatitude,
                                lng = mLongitude,
                                countrycode = mCountryCode,
                                comments = mComments
                            WHERE
                                id = mLocationId;
                END IF;
                
            -- END IF Part
        ELSEIF (SELECT Count(0) 
                FROM    locations
                WHERE   city = mCity AND
                        state = mstate AND
                        lat = mLatitude AND
                        lng = mLongitude AND 
                        merchant_id = mMerchantId) = 0 
                
            THEN
            
            -- Location does not exist
                IF mCodId > 0 AND mMerchantId > 0 THEN
                    
                    -- insert location
                    INSERT INTO locations
                            (merchant_id, address1, address2, city, state, zipcode, 
                            lat, lng, countrycode, comments, created, modified)
                            VALUES
                            (mMerchantId, mAddress1, mAddress2, mCity, mState, mZipCode,
                            mLatitude, mLongitude, mCountryCode, mComments, now(), now());
            
                    -- create relation
                    INSERT INTO cods_locations
                            (cod_id, location_id)
                            VALUES
                            (mCodId, (SELECT id FROM locations WHERE merchant_id = mMerchantId AND lat = mLatitude AND lng = mLongitude));
                    
                END IF;
            
            -- END ELSEIF PART
        
        END IF;
        
        -- Mark Location as processed in middle dump table
        UPDATE aodbadvertiserlocations
                SET 
                    processed = 1
                WHERE
                    lat = mLatitude AND
                    lng = mLongitude AND
                    advertiser_id = mAdvertiserId;
                    
    END LOOP;
    
    CLOSE Locations;

END



$$

$$
DELIMITER ;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;


INSERT INTO `pluginsconfigurations` (`plugintype`,`pluginid`, `pluginname`, `datakey`, `dataval`) VALUES
('configurable','a73c2d1e-eb51-495d-af3e-959b9df093f0', 'dvs4adilityodb', 'subscriptionkey', 'not configured'),
('configurable','a73c2d1e-eb51-495d-af3e-959b9df093f0', 'dvs4adilityodb', 'city', 'boston'),
('configurable','a73c2d1e-eb51-495d-af3e-959b9df093f0', 'dvs4adilityodb', 'state_code', 'ma'),
('configurable','a73c2d1e-eb51-495d-af3e-959b9df093f0', 'dvs4adilityodb', 'radius', '20'),
('configurable','a73c2d1e-eb51-495d-af3e-959b9df093f0', 'dvs4adilityodb', 'types', 'deal,coupon'),
('configurable','a73c2d1e-eb51-495d-af3e-959b9df093f0', 'dvs4adilityodb', 'category_import', 'no'),
('configurable','a73c2d1e-eb51-495d-af3e-959b9df093f0', 'dvs4adilityodb', 'offers_import_page', 'eof'),
('configurable','a73c2d1e-eb51-495d-af3e-959b9df093f0', 'dvs4adilityodb', 'offers_import_items_per_page', '100'),
('configurable','a73c2d1e-eb51-495d-af3e-959b9df093f0', 'dvs4adilityodb', 'default-sites', ''),
('configurable','a73c2d1e-eb51-495d-af3e-959b9df093f0', 'dvs4adilityodb', 'last_run_time', '1970-01-01 00:00:00'),
('configurable','a73c2d1e-eb51-495d-af3e-959b9df093f0', 'dvs4adilityodb', 'second_level_import', 'no');
