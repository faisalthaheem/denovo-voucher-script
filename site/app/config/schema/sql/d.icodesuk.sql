SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';


-- -----------------------------------------------------
-- Table `icodesuk_categories`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `icodesuk_categories` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `icodes_name` VARCHAR(255) NOT NULL ,
  `icodes_id` VARCHAR(100) NOT NULL ,
  `processed` TINYINT NULL DEFAULT 0 ,
  `created` DATETIME NULL ,
  `modified` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `icodes_name_index` (`icodes_name` ASC) ,
  INDEX `icodes_id_index` (`icodes_id` ASC) ,
  INDEX `icodes_processed_index` (`processed` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `icodesuk_merchants_dumps`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `icodesuk_merchants_dumps` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `icid` VARCHAR(100) NULL ,
  `merchant` VARCHAR(255) NULL ,
  `relationship` VARCHAR(255) NULL ,
  `merchant_logo_url` VARCHAR(1024) NULL ,
  `merchantid` VARCHAR(255) NULL ,
  `programid` VARCHAR(255) NULL ,
  `total_offers` VARCHAR(255) NULL ,
  `affiliate_url` VARCHAR(1024) NULL ,
  `merchant_url` VARCHAR(1024) NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `icidindex` (`icid` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `icodesuk_merchants`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `icodesuk_merchants` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `icid` VARCHAR(100) NULL ,
  `merchant` VARCHAR(255) NULL ,
  `relationship` VARCHAR(255) NULL ,
  `merchant_logo_url` VARCHAR(1024) NULL ,
  `merchantid` VARCHAR(100) NULL ,
  `programid` VARCHAR(100) NULL ,
  `affiliate_url` VARCHAR(1024) NULL ,
  `merchant_url` VARCHAR(1024) NULL ,
  `total_offers` VARCHAR(100) NULL ,
  `processed` TINYINT NULL DEFAULT 0 ,
  `created` DATETIME NULL ,
  `modified` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `icid_index` (`icid` ASC) ,
  INDEX `merchant_index` (`merchant` ASC) ,
  INDEX `processed_index` (`processed` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `icodesuk_codes_dumps`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `icodesuk_codes_dumps` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `icid` VARCHAR(100) NULL ,
  `merchant_icid` VARCHAR(100) NULL ,
  `title` VARCHAR(255) NULL ,
  `description` TEXT NULL ,
  `merchant` VARCHAR(255) NULL ,
  `relationship` VARCHAR(45) NULL ,
  `merchant_logo_url` VARCHAR(1024) NULL ,
  `merchantid` VARCHAR(100) NULL ,
  `programid` VARCHAR(100) NULL ,
  `network` VARCHAR(255) NULL ,
  `vouchercode` VARCHAR(255) NULL ,
  `excode` VARCHAR(255) NULL ,
  `start_date` DATETIME NULL ,
  `expiry_date` DATETIME NULL ,
  `deep_link` VARCHAR(1024) NULL ,
  `affiliate_url` VARCHAR(1024) NULL ,
  `merchant_url` VARCHAR(1024) NULL ,
  `categoryid` VARCHAR(100) NULL ,
  `category` VARCHAR(255) NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `icidindex` (`icid` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `icodesuk_offers_dumps`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `icodesuk_offers_dumps` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `icid` VARCHAR(100) NULL ,
  `merchant_icid` VARCHAR(100) NULL ,
  `merchantid` VARCHAR(100) NULL ,
  `programid` VARCHAR(100) NULL ,
  `title` VARCHAR(255) NULL ,
  `description` VARCHAR(1024) NULL ,
  `merchant` VARCHAR(255) NULL ,
  `relationship` VARCHAR(45) NULL ,
  `merchant_logo_url` VARCHAR(1024) NULL ,
  `network` VARCHAR(255) NULL ,
  `start_date` DATETIME NULL ,
  `expiry_date` DATETIME NULL ,
  `deep_link` VARCHAR(1024) NULL ,
  `affiliate_url` VARCHAR(1024) NULL ,
  `merchant_url` VARCHAR(1024) NULL ,
  `categoryid` VARCHAR(100) NULL ,
  `category` VARCHAR(255) NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `icidindex` (`icid` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `icodesuk_codes`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `icodesuk_codes` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `icid` VARCHAR(100) NULL ,
  `merchant_icid` VARCHAR(100) NULL ,
  `title` VARCHAR(255) NULL ,
  `description` TEXT NULL ,
  `merchant` VARCHAR(255) NULL ,
  `relationship` VARCHAR(45) NULL ,
  `merchant_logo_url` VARCHAR(1024) NULL ,
  `merchantid` VARCHAR(100) NULL ,
  `programid` VARCHAR(100) NULL ,
  `network` VARCHAR(255) NULL ,
  `vouchercode` VARCHAR(255) NULL ,
  `excode` VARCHAR(255) NULL ,
  `start_date` DATETIME NULL ,
  `expiry_date` DATETIME NULL ,
  `deep_link` VARCHAR(1024) NULL ,
  `affiliate_url` VARCHAR(1024) NULL ,
  `merchant_url` VARCHAR(1024) NULL ,
  `categoryid` VARCHAR(100) NULL ,
  `category` VARCHAR(255) NULL ,
  `processed` TINYINT NULL DEFAULT 0 ,
  `created` DATETIME NULL ,
  `modified` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `icid_index` (`icid` ASC) ,
  INDEX `merchant_icid_index` (`merchant_icid` ASC) ,
  INDEX `merchant_index` (`merchant` ASC) ,
  INDEX `processed_index` (`processed` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `icodesuk_offers`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `icodesuk_offers` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `icid` VARCHAR(100) NULL ,
  `merchant_icid` VARCHAR(100) NULL ,
  `merchantid` VARCHAR(100) NULL ,
  `programid` VARCHAR(100) NULL ,
  `title` VARCHAR(255) NULL ,
  `description` TEXT NULL ,
  `merchant` VARCHAR(255) NULL ,
  `relationship` VARCHAR(45) NULL ,
  `merchant_logo_url` VARCHAR(1024) NULL ,
  `network` VARCHAR(255) NULL ,
  `start_date` DATETIME NULL ,
  `expiry_date` DATETIME NULL ,
  `deep_link` VARCHAR(1024) NULL ,
  `affiliate_url` VARCHAR(1024) NULL ,
  `merchant_url` VARCHAR(1024) NULL ,
  `categoryid` VARCHAR(100) NULL ,
  `category` VARCHAR(255) NULL ,
  `processed` TINYINT NULL DEFAULT 0 ,
  `created` DATETIME NULL ,
  `modified` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `icidindex` (`icid` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `icodesukcategorymerchantdumps`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `icodesukcategorymerchantdumps` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `merchant_icid` VARCHAR(100) NULL ,
  `merchant_name` VARCHAR(255) NULL ,
  `category_id` VARCHAR(100) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `icodesukcategorymerchants`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `icodesukcategorymerchants` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `merchant_icid` VARCHAR(100) NULL ,
  `merchant_name` VARCHAR(255) NULL ,
  `category_id` VARCHAR(100) NULL ,
  `processed` TINYINT NULL DEFAULT 0 ,
  `created` DATETIME NULL ,
  `modified` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `merchant_id_index` (`merchant_icid` ASC) ,
  INDEX `category_id_index` (`category_id` ASC) ,
  INDEX `processed_index` (`processed` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `icodesuk_categories_dumps`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `icodesuk_categories_dumps` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `icodes_name` VARCHAR(255) NULL ,
  `icodes_id` VARCHAR(100) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- procedure IcodesukCopyMerchantsFromDump
-- -----------------------------------------------------
DELIMITER $$
CREATE PROCEDURE `IcodesukCopyMerchantsFromDump`()

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
 *        STORED PROCEDURE : IcodesukCopyMerchantsFromDump
 *        DESCRIPTION      : This SP copies all merchants from dump table.
 */

    -- Declare Variables
    DECLARE done INT DEFAULT 0;                 -- flag for no more records
    DECLARE mICID VARCHAR(100);                 -- for merchant_icid
    DECLARE mMerchant VARCHAR(255);             -- for merchant (merchant name);
    DECLARE mRelationship VARCHAR(255);         -- for relationship
    DECLARE mMerchantLogoURL VARCHAR(1024);     -- for merchant_logo_url
    DECLARE mMerchantId VARCHAR(100);           -- merchantid (sometimes have domain name of merchant)
    DECLARE mProgramId VARCHAR(1024);           -- programid
    DECLARE mAffiliateURL VARCHAR(1024);        -- affiliate_url
    DECLARE mMerchantURL VARCHAR(1024);         -- merchant_url
    DECLARE mTotalOffers VARCHAR(255);          -- for total_offers

    -- Declare Cursor and Handler
    DECLARE MerchantDump CURSOR FOR 
        SELECT  icid, merchant, relationship, merchant_logo_url, merchantid, 
                programid, total_offers, affiliate_url, merchant_url 
                FROM icodesuk_merchants_dumps;
    
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;

    
    OPEN MerchantDump;

    Merchant_Records: LOOP
    
        FETCH MerchantDump INTO 
            mICID, mMerchant, mRelationship, 
            mMerchantLogoURL, mMerchantId, 
            mProgramId, mTotalOffers, 
            mAffiliateURL, mMerchantURL;  
    
        IF done THEN
            Leave Merchant_Records;
        END IF;
        
        -- Check if Merchant Exists
        --      Update merchant details
        -- ELSE 
        --      Insert Merchant
        IF (SELECT Count(*) FROM icodesuk_merchants WHERE icid = mICID) = 0 THEN
        
            INSERT INTO icodesuk_merchants
                    
                    (icid, merchant, relationship, merchant_logo_url, merchantid, programid, 
                    total_offers, affiliate_url, merchant_url, processed, created, modified)
                    
                    VALUES
                    
                    (mICID, mMerchant, mRelationship, mMerchantLogoURL, mMerchantId, mProgramId,
                    mTotalOffers, mAffiliateURL, mMerchantURL, 0, now(), now());
    
    
        ELSEIF (SELECT Count(*) FROM icodesuk_merchants WHERE icid = mICID) > 0 THEN
        
            UPDATE icodesuk_merchants SET
                
                merchant = mMerchant, 
                relationship = mRelationship,
                merchant_logo_url = mMerchantLogoURL, 
                merchantid = mMerchantId, 
                programid = mProgramId, 
                total_offers = mTotalOffers,                
                affiliate_url = mAffiliateURL, 
                merchant_url = mMerchantURL 
                
                WHERE icid = mICID AND processed = 0;
        
        END IF;
    
    END LOOP;

    CLOSE MerchantDump;
END








$$

$$
DELIMITER ;


-- -----------------------------------------------------
-- procedure IcodesukCopyOffersFromDump
-- -----------------------------------------------------
DELIMITER $$
CREATE PROCEDURE `IcodesukCopyOffersFromDump`()

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
 *        STORED PROCEDURE : IcodesukCopyOffersFromDump
 *        DESCRIPTION      : This SP inserts and Updates Offers from codes dump table.
 */

    -- Declare Variables 
    DECLARE done INT DEFAULT 0;             -- flag for no more records
    DECLARE mICID VARCHAR(100);             -- for icid    
    DECLARE mMerchantICID VARCHAR(100);     -- for merchant_icid
    DECLARE mTitle VARCHAR(255);            -- for Offer title
    DECLARE mDescription TEXT;              -- for offer description
    DECLARE mMerchant VARCHAR(255);         -- for merchant
    DECLARE mRelationship VARCHAR(45);      -- for relationship
    DECLARE mMerchantLogoURL VARCHAR(1024); -- for merchant_logo_url
    DECLARE mMerchantId VARCHAR(100);       -- for merchantid
    DECLARE mProgramId VARCHAR(100);        -- for programid
    DECLARE mNetwork VARCHAR(255);          -- for network
    DECLARE mStartDate DATETIME;            -- for start_date
    DECLARE mExpiryDate DATETIME;           -- for expiry_date
    DECLARE mDeepLink VARCHAR(1024);        -- for deep_link
    DECLARE mAffiliateURL VARCHAR(1024);    -- for affiliate_url
    DECLARE mMerchantURL VARCHAR(1024);     -- for merchant_url
    DECLARE mCategoryId VARCHAR(100);       -- for categoryid
    DECLARE mCategory VARCHAR(255);         -- for category
    
        
    -- Declaring cursor and Handler
    DECLARE OffersDump CURSOR FOR 
    SELECT  icid, merchant_icid, title, description,
            merchant, relationship, merchant_logo_url, merchantid,
            programid, network, start_date, expiry_date, deep_link,
            affiliate_url, merchant_url, categoryid, category
            FROM icodesuk_offers_dumps;
    
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;

    
    OPEN OffersDump;
    
    Offers_Loop: LOOP
    
        Fetch OffersDump INTO 
            
            mICID, mMerchantICID, mTitle, mDescription, mMerchant, mRelationship,
            mMerchantLogoURL, mMerchantId, mProgramId, mNetwork, mStartDate, mExpiryDate, 
            mDeepLink, mAffiliateURL, mMerchantURL, mCategoryId, mCategory;
            
        IF done THEN
            Leave Offers_Loop;
        END IF;
        
        
        -- Check if Offer exists
        --      UPDATE Offer Details
        -- ELSE 
        --      INSERT Offer Details
        
        IF(SELECT Count(*) FROM icodesuk_offers WHERE icid = mICID) = 0 THEN
        
            INSERT INTO icodesuk_offers 
                            
                            (icid, merchant_icid, title, description, merchant, relationship, merchant_logo_url, merchantid, programid,
                            network, start_date, expiry_date, deep_link, affiliate_url, merchant_url, categoryid, category, processed, 
                            created, modified)
                            
                            VALUES
                            
                            (mICID, mMerchantICID, mTitle, mDescription, mMerchant, mRelationship, mMerchantLogoURL, 
                            mMerchantId, mProgramId, mNetwork, mStartDate, mExpiryDate, mDeepLink, 
                            mAffiliateURL, mMerchantURL, mCategoryId, mCategory, 0, now(), now());
        
        ELSEIF (SELECT Count(*) FROM icodesuk_offers WHERE icid = mICID) > 0 THEN
        
            UPDATE icodesuk_offers SET
            
                            title = mTitle, 
                            description = mDescription, 
                            merchant_logo_url = mMerchantLogoURL, 
                            merchantid = mMerchantId, 
                            programid = mProgramId,
                            network = mNetwork, 
                            start_date = mStartDate, 
                            expiry_date = mExpiryDate, 
                            deep_link = mDeepLink, 
                            affiliate_url = mAffiliateURL, 
                            merchant_url = mMerchantURL, 
                            categoryid = mCategoryId, 
                            category = mCategory
                                    
                            WHERE icid = mICID AND processed = 0;
        END IF;
    
    END LOOP;
    
    CLOSE OffersDump;
END





$$

$$
DELIMITER ;


-- -----------------------------------------------------
-- procedure IcodesukCopyCodesFromDump
-- -----------------------------------------------------
DELIMITER $$
CREATE PROCEDURE `IcodesukCopyCodesFromDump`()

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
 
 /*
 *  STORED PROCEDURE : IcodesukCopyCodesFromDump
 *  DESCRIPTION      : This SP inserts and Updates Voucher Codes from codes dump table.
 */

    -- Declare Variables 
    DECLARE done INT DEFAULT 0;             -- flag for no more records
    DECLARE mICID VARCHAR(100);             -- for icid    
    DECLARE mMerchantICID VARCHAR(100);     -- for merchant_icid
    DECLARE mTitle VARCHAR(255);            -- for voucher title
    DECLARE mDescription TEXT;              -- for voucher description
    DECLARE mMerchant VARCHAR(255);         -- for merchant
    DECLARE mRelationship VARCHAR(45);      -- for relationship
    DECLARE mMerchantLogoURL VARCHAR(1024); -- for merchant_logo_url
    DECLARE mMerchantId VARCHAR(100);       -- for merchantid
    DECLARE mProgramId VARCHAR(100);        -- for programid
    DECLARE mNetwork VARCHAR(255);          -- for network
    DECLARE mVoucherCode VARCHAR(255);      -- for vouchercode
    DECLARE mExCode VARCHAR(255);           -- for excode
    DECLARE mStartDate DATETIME;            -- for start_date
    DECLARE mExpiryDate DATETIME;           -- for expiry_date
    DECLARE mDeepLink VARCHAR(1024);        -- for deep_link
    DECLARE mAffiliateURL VARCHAR(1024);    -- for affiliate_url
    DECLARE mMerchantURL VARCHAR(1024);     -- for merchant_url
    DECLARE mCategoryId VARCHAR(100);       -- for categoryid
    DECLARE mCategory VARCHAR(255);         -- for category
    
        
    -- Declaring cursor and Handler
    DECLARE CodesDump CURSOR FOR 
    SELECT  icid,merchant_icid,title,description,
            merchant,relationship,merchant_logo_url,merchantid,
            programid,network,vouchercode,excode,start_date,expiry_date,
            deep_link,affiliate_url,merchant_url,categoryid,category
            FROM icodesuk_codes_dumps;
    
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;

    
    OPEN CodesDump;
    
    Codes_Loop: LOOP
    
        Fetch CodesDump INTO 
            
            mICID, mMerchantICID, mTitle, mDescription, mMerchant, mRelationship,
            mMerchantLogoURL, mMerchantId, mProgramId, mNetwork, mVoucherCode, mExCode,
            mStartDate, mExpiryDate, mDeepLink, mAffiliateURL, mMerchantURL, mCategoryId, mCategory;
            
        IF done THEN
            Leave Codes_Loop;
        END IF;
        
        
        -- Check if Voucher exists
        --      UPDATE Voucher Details
        -- ELSE 
        --      INSERT Voucher Details
        
        IF(SELECT Count(*) FROM icodesuk_codes WHERE icid = mICID) = 0 THEN
        
            INSERT INTO icodesuk_codes 
                            
                            (icid, merchant_icid, title, description, merchant, relationship, merchant_logo_url, merchantid, programid,
                            network, vouchercode, excode, start_date, expiry_date, deep_link, affiliate_url, merchant_url, 
                            categoryid, category, processed, created, modified)
                            
                            VALUES
                            
                            (mICID, mMerchantICID, mTitle, mDescription, mMerchant, mRelationship, mMerchantLogoURL, 
                            mMerchantId, mProgramId, mNetwork, mVoucherCode, mExCode, mStartDate, mExpiryDate, mDeepLink, 
                            mAffiliateURL, mMerchantURL, mCategoryId, mCategory, 0, now(), now());
        
        ELSEIF (SELECT Count(*) FROM icodesuk_codes WHERE icid = mICID) > 0 THEN
        
            UPDATE icodesuk_codes SET
            
                            title = mTitle, 
                            description = mDescription, 
                            merchant_logo_url = mMerchantLogoURL, 
                            merchantid = mMerchantId, 
                            programid = mProgramId,
                            network = mNetwork, 
                            vouchercode = mVoucherCode, 
                            excode = mExCode, 
                            start_date = mStartDate, 
                            expiry_date = mExpiryDate, 
                            deep_link = mDeepLink, 
                            affiliate_url = mAffiliateURL, 
                            merchant_url = mMerchantURL, 
                            categoryid = mCategoryId, 
                            category = mCategory
                                    
                            WHERE icid = mICID AND processed = 0;
        END IF;
    
    END LOOP;
    
    CLOSE CodesDump;
END







$$

$$
DELIMITER ;


-- -----------------------------------------------------
-- procedure IcodesukCopyCategoryMerchantJoins
-- -----------------------------------------------------
DELIMITER $$
CREATE PROCEDURE `IcodesukCopyCategoryMerchantJoins`()

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
 *  STORED PROCEDURE : IcodesukCopyCategoryMerchantJoins
 *  DESCRIPTION      : This SP Copies category and merchant relation from dump.
 */

    -- Declare Variables

    DECLARE done INT DEFAULT 0;         -- flag for no more records
    DECLARE mMerchantId VARCHAR(100);   -- for merchant_icid    
    DECLARE mMerchantName VARCHAR(255); -- for merchant_name
    DECLARE mCategoryId VARCHAR(100);   -- for category_id

    
    -- Declaring cursor and Handler
    DECLARE CategoryMerchantDump CURSOR FOR 
        SELECT  merchant_icid, merchant_name, category_id  
                FROM icodesukcategorymerchantdumps;
    
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;

    OPEN CategoryMerchantDump;
    
    cmLoop: LOOP
    
        FETCH CategoryMerchantDump INTO mMerchantId, mMerchantName, mCategoryId;
        
        IF done THEN
            LEAVE cmLoop;
        END IF;


        -- Check if Relation does not exist
        -- Create it
        
        IF (SELECT Count(*) FROM icodesukcategorymerchants WHERE merchant_icid = mMerchantId AND category_id = mCategoryId) = 0 THEN

            INSERT INTO icodesukcategorymerchants       
                (merchant_icid, merchant_name, category_id, processed, created, modified)
                VALUES
                (mMerchantId, mMerchantName, mCategoryId, 0, now(), now());
            
        END IF;
    
    END LOOP;
    
    CLOSE CategoryMerchantDump;
END








$$

$$
DELIMITER ;


-- -----------------------------------------------------
-- procedure IcodesukCopyCategoriesFromDump
-- -----------------------------------------------------
DELIMITER $$
CREATE PROCEDURE `IcodesukCopyCategoriesFromDump`()

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
 *       STORED PROCEDURE : IcodesukCopyCategoriesFromDump
 *       DESCRIPTION      : This SP inserts and Updates categories from categories dump table.
 */
    
    
    DECLARE done INT DEFAULT 0;     -- flag for no more records
    DECLARE cat_name VARCHAR(255);  -- for category name    
    DECLARE cat_id VARCHAR(100);    -- category id
    
    -- Declaring cursor and Handler
    DECLARE catDump CURSOR FOR SELECT icodes_name, icodes_id  FROM icodesuk_categories_dumps;
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;

    OPEN catDump;

    categry: LOOP
        
        FETCH catDump INTO cat_name, cat_id;
        
        IF done THEN
            
            LEAVE categry;
        
        END IF;
        
        
        -- Check if category exist 
        --  Update it
        -- Else 
        --  Insert it
        
        IF (SELECT COUNT(*) FROM icodesuk_categories WHERE icodes_id = cat_id) > 0 THEN
        
            /* UPDATE if Category already exists */
            UPDATE icodesuk_categories SET icodes_name = cat_name WHERE icodes_id = cat_id AND processed = 0;
        
        
        ELSEIF (SELECT COUNT(*) FROM icodesuk_categories WHERE icodes_id = cat_id) = 0 THEN
        
            /* INSERT category if does not exits */
            INSERT INTO icodesuk_categories
                    
                (icodes_name, icodes_id, processed, created, modified)
                
                VALUES
                
                (cat_name, cat_id, 0, now(), now());
        
        END IF;  
        
    END LOOP;

    CLOSE catDump;
       
END






$$

$$
DELIMITER ;


-- -----------------------------------------------------
-- procedure IcodesukGetImportedCategories
-- -----------------------------------------------------
DELIMITER $$
CREATE PROCEDURE `IcodesukGetImportedCategories`(mSites VARCHAR(255))
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
 *        STORED PROCEDURE : IcodesukGetImportedCategories
 *        DESCRIPTION      : This SP transfer all imported Categories to Live db.
 */
    
    
    DECLARE done INT DEFAULT 0;     -- flag for no more records
    DECLARE mCatName VARCHAR(255);  -- for category name    
    DECLARE mCatId VARCHAR(100);    -- category id
    DECLARE mExistingCatId INT;     -- used for existing category id
    DECLARE mAutoUpdate BOOLEAN;    -- used for existing category autoupdate flag
    
    -- Declaring cursor and Handler
    DECLARE category CURSOR FOR 
        SELECT  icodes_name, icodes_id  
                FROM icodesuk_categories
                WHERE processed = 0;
                
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;

    -- following procedure creates a temporary table 
    -- of default site ids for this plugin 
    call splitString(mSites);
    
    -- Replace the underscores in imported categories with spaces
    UPDATE
        icodesuk_categories
    SET
        icodes_name = REPLACE(icodes_name, '_', ' ');
    
    
    OPEN category;
    
    cat_loop: LOOP
    
        Fetch category INTO mCatName, mCatId;
        
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
                        icodesuk_category_id = mCatId
                        WHERE id = mExistingCatId;
                
            ELSEIF mAutoUpdate = FALSE THEN
            
                -- Update category network id only
                UPDATE  categories SET
                        icodesuk_category_id = mCatId
                        WHERE id = mExistingCatId;
            
            END IF;
        
        ELSE
            
            -- Category name not found, check for network id of the category
            IF (SELECT Count(*) FROM categories WHERE icodesuk_category_id = mCatId) > 0 THEN
                
                IF (SELECT autoupdate FROM categories WHERE icodesuk_category_id = mCatId) = TRUE THEN
                
                    UPDATE  categories SET 
                            catname = mCatName
                            WHERE icodesuk_category_id = mCatId;
                END IF;
            
            ELSE
                
                INSERT INTO categories
                        (catname, safe_catname, icodesuk_category_id, source, parent_id, created, modified)
                        VALUES
                        (mCatName, (SELECT createSafeTitle(mCatName)), mCatId, 'IcodesUK', 0, now(), now());
                
                /* Here we have to create relation between site and newly added category */
                    
                IF (SELECT Count(*) FROM temp) > 0 THEN
                    
                    INSERT INTO categories_sites (site_id, category_id) 
                                SELECT site_id, (SELECT id FROM categories WHERE icodesuk_category_id = mCatId)  
                                    FROM temp;
                /* END */
                    
                END IF;
                
            END IF;
            
        END IF;
        
        UPDATE icodesuk_categories SET processed = 1 WHERE icodes_id = mCatId AND processed = 0;
    
    END LOOP;
    
    CLOSE category;

END





$$

$$
DELIMITER ;


-- -----------------------------------------------------
-- procedure IcodesukGetImportedMerchants
-- -----------------------------------------------------
DELIMITER $$
CREATE PROCEDURE `IcodesukGetImportedMerchants`(mSites VARCHAR(255))
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
 *       STORED PROCEDURE : IcodesukGetImportedMerchants
 *       DESCRIPTION      : This SP copies all merchants imported from icodesuk to our live merchants table.
 */

    -- Declare Variables
    DECLARE done INT DEFAULT 0;                 -- flag for no more records
    DECLARE mICID VARCHAR(100);                 -- for merchant_icid
    DECLARE mMerchant VARCHAR(255);             -- for merchant (merchant name);
    DECLARE mRelationship VARCHAR(255);         -- for relationship
    DECLARE mMerchantLogoURL VARCHAR(1024);     -- for merchant_logo_url
    DECLARE mMerchantId VARCHAR(100);           -- merchantid (sometimes have domain name of merchant)
    DECLARE mProgramId VARCHAR(1024);           -- programid
    DECLARE mAffiliateURL VARCHAR(1024);        -- affiliate_url
    DECLARE mMerchantURL VARCHAR(1024);         -- merchant_url
    DECLARE mTotalOffers VARCHAR(255);          -- for total_offers

    DECLARE mMerchantIdPK INT;                    -- Merchant primery key

    -- Declare Cursor and Handler
    DECLARE Merchants CURSOR FOR 
        SELECT  icid, merchant, relationship, merchant_logo_url, merchantid, 
                programid, total_offers, affiliate_url, merchant_url
                FROM icodesuk_merchants
                WHERE processed = 0;
    
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;

    -- following procedure creates a temporary table 
    -- of default site ids for this plugin 
    call splitString(mSites);
    
    OPEN Merchants;

    Merchant: LOOP
    
        FETCH Merchants INTO 
            mICID, mMerchant, mRelationship, 
            mMerchantLogoURL, mMerchantId, 
            mProgramId, mTotalOffers, 
            mAffiliateURL, mMerchantURL;  
    
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


        IF (SELECT Count(*) FROM merchants WHERE merchant_name = mMerchant) > 0 THEN
        
            -- merchant name found
            IF (SELECT Count(*) FROM merchants WHERE merchant_name = mMerchant AND autoupdate = 1) THEN
               
                UPDATE merchants SET
                
                    icodesuk_merchant_id = mICID, 
                    programid = mProgramId,
                    logo_url = mMerchantLogoURL,
                    site_url = mMerchantURL,
                    relationship = mRelationship,
                    total_offers = mTotalOffers,                
                    affiliate_url = mAffiliateURL, 
                    modified = now()
               
                    WHERE merchant_name = mMerchant;
            ELSE
                
                UPDATE merchants SET
                    icodesuk_merchant_id = mICID 
                    WHERE merchant_name = mMerchant;
            END IF;
        
        ELSE 

            -- merchant name not found check for icodes id
            IF (SELECT Count(*) FROM merchants WHERE icodesuk_merchant_id = mICID) > 0 THEN
                
                -- merchant id found
                IF (SELECT Count(*) FROM merchants WHERE icodesuk_merchant_id = mICID AND autoupdate = 1) THEN
                    
                UPDATE merchants SET
                
                    merchant_name = mMerchant, 
                    programid = mProgramId,
                    logo_url = mMerchantLogoURL,
                    site_url = mMerchantURL,
                    relationship = mRelationship,
                    total_offers = mTotalOffers,                
                    affiliate_url = mAffiliateURL, 
                    modified = now()
               
                    WHERE icodesuk_merchant_id = mICID;
                
                END IF;
            
            ELSE
                
                -- id not found now insert merchant
                INSERT INTO merchants
                    (source, merchant_name, safe_merchant_name, icodesuk_merchant_id, programid, logo_url, site_url, 
                    relationship, total_offers, affiliate_url, created, modified)
                    VALUES
                    ('IcodesUK', mMerchant, (SELECT createSafeTitle(mMerchant)), mICID, mProgramId, mMerchantLogoURL, mMerchantURL, 
                    mRelationship, mTotalOffers, mAffiliateURL,  now(), now());
                
                SELECT id INTO mMerchantIdPK FROM merchants WHERE icodesuk_merchant_id = mICID;
                
                /* Here we have to create relation between sites and newly added merchant*/
                IF (SELECT Count(*) FROM temp) > 0 THEN
                        INSERT INTO merchants_sites (site_id, merchant_id) 
                                    SELECT site_id, mMerchantIdPK FROM temp;
                END IF;
                /* END */
            
            END IF;
            
        END IF;


        -- Mark Record as Processed
        UPDATE icodesuk_merchants SET processed = 1 WHERE icid = mICID AND processed = 0;
    
    END LOOP;

    Close Merchants;
END





$$

$$
DELIMITER ;


-- -----------------------------------------------------
-- procedure IcodesukGetCategoryMerchantJoins
-- -----------------------------------------------------
DELIMITER $$
CREATE PROCEDURE `IcodesukGetCategoryMerchantJoins`()

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
 *        STORED PROCEDURE : IcodesukGetCategoryMerchantJoins
 *        DESCRIPTION      : This SP creates relation between category and merchant via imported joins from icodesUK.
 */

    -- Declare Variables

    DECLARE done INT DEFAULT 0;         -- flag for no more records
    DECLARE mMerchantId VARCHAR(100);   -- for merchant_icid    
    DECLARE mMerchantName VARCHAR(255); -- for merchant_name
    DECLARE mCategoryId VARCHAR(100);   -- for category_id
    
    DECLARE mCatId INT;                 -- category primery key
    DECLARE mMergedId INT;              -- merged in category id
    DECLARE mMerchantIdPK INT;          -- Merchant primery key
    
    -- Declaring cursor and Handler
    DECLARE CategoryMerchant CURSOR FOR 
        SELECT  merchant_icid, merchant_name, category_id  
                FROM icodesukcategorymerchants
                WHERE processed = 0;
                
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;

    OPEN CategoryMerchant;
    
    cmLoop: LOOP
    
        FETCH CategoryMerchant INTO mMerchantId, mMerchantName, mCategoryId;
        
        IF done THEN
            LEAVE cmLoop;
        END IF;



        --  IF Category Exists
        --      IF merged
        --          get id of merged category
        --      ELSE 
        --          get id of category
        --      END IF;
        --      
        --      Create relation if does not exist
        --  END IF;
        
        -- check for merchant category
        IF  (SELECT Count(*) FROM categories WHERE icodesuk_category_id = mCategoryId) > 0 
            AND 
            (SELECT Count(*) FROM merchants WHERE icodesuk_merchant_id = mMerchantId) > 0
            THEN
                    
            SELECT id, merged_in INTO mCatId, mMergedId FROM categories WHERE icodesuk_category_id = mCategoryId;
            SELECT id INTO mMerchantIdPK FROM merchants WHERE icodesuk_merchant_id = mMerchantId;
                    
            IF mMergedId <> 0 THEN
                SET mCatId = mMergedId;
            END IF;
            
            IF (SELECT Count(*) FROM categories_merchants WHERE category_id = mCatId AND merchant_id = mMerchantIdPK) = 0 THEN
            
                INSERT INTO categories_merchants
                    (category_id, merchant_id) VALUES (mCatId, mMerchantIdPK);
            
            END IF;
            
            UPDATE icodesukcategorymerchants SET processed = 1 WHERE merchant_icid = mMerchantId AND category_id = mCategoryId;
        
        END IF;
        
    END LOOP;
    
    CLOSE CategoryMerchant;
END




$$

$$
DELIMITER ;


-- -----------------------------------------------------
-- procedure IcodesukGetImportedCodes
-- -----------------------------------------------------
DELIMITER $$
CREATE PROCEDURE `IcodesukGetImportedCodes`(mSites VARCHAR(255))
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
 *        STORED PROCEDURE : IcodesukGetImportedCodes
 *        DESCRIPTION      : This SP gets all voucher codes imported from icodes uk.
 */

    -- Declare Variables 
    DECLARE done INT DEFAULT 0;             -- flag for no more records
    DECLARE mICID VARCHAR(100);             -- for icid    
    DECLARE mMerchantICID VARCHAR(100);     -- for merchant_icid
    DECLARE mTitle VARCHAR(255);            -- for voucher title
    DECLARE mDescription TEXT;              -- for voucher description
    DECLARE mMerchant VARCHAR(255);         -- for merchant
    DECLARE mRelationship VARCHAR(45);      -- for relationship
    DECLARE mMerchantLogoURL VARCHAR(1024); -- for merchant_logo_url
    DECLARE mMerchantId VARCHAR(100);       -- for merchantid
    DECLARE mProgramId VARCHAR(100);        -- for programid
    DECLARE mNetwork VARCHAR(255);          -- for network
    DECLARE mVoucherCode VARCHAR(255);      -- for vouchercode
    DECLARE mExCode VARCHAR(255);           -- for excode
    DECLARE mStartDate DATETIME;            -- for start_date
    DECLARE mExpiryDate DATETIME;           -- for expiry_date
    DECLARE mDeepLink VARCHAR(1024);        -- for deep_link
    DECLARE mAffiliateURL VARCHAR(1024);    -- for affiliate_url
    DECLARE mMerchantURL VARCHAR(1024);     -- for merchant_url
    
        
    -- Declaring cursor and Handler
    DECLARE Codes CURSOR FOR 
    SELECT  icid, merchant_icid, title, description,
            merchant, relationship, merchant_logo_url, merchantid,
            programid, network, vouchercode, excode, start_date, expiry_date,
            deep_link, affiliate_url, merchant_url
            FROM icodesuk_codes
            WHERE processed = 0;
    
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;

    -- following procedure creates a temporary table 
    -- of default site ids for this plugin 
    call splitString(mSites);
    
    OPEN Codes;
    
    Codes_Loop: LOOP
    
        Fetch Codes INTO 
            
            mICID, mMerchantICID, mTitle, mDescription, mMerchant, mRelationship,
            mMerchantLogoURL, mMerchantId, mProgramId, mNetwork, mVoucherCode, mExCode,
            mStartDate, mExpiryDate, mDeepLink, mAffiliateURL, mMerchantURL;
            
        IF done THEN
            Leave Codes_Loop;
        END IF;
        
        -- IF Merchant EXISTS
        --      IF Voucher EXISTS
        --          UPDATE Voucher Details
        --      ELSE 
        --          INSERT Voucher Details
        --      END IF
        -- END IF
        IF (SELECT Count(*) FROM merchants
                    WHERE icodesuk_merchant_id = mMerchantICID) > 0 THEN
                            
            -- IF Merchant Exist we will proceed further.
                            
            IF  (SELECT Count(*) FROM cods WHERE   
                                source = 'IcodesUK' AND 
                                cod_type = 'voucher' AND 
                                icodesuk_id = mICID) = 0 THEN
                
                -- IF Voucher does not exist Then INSERT
                INSERT INTO cods
                                
                                (merchant_id, cod_type, source, icodesuk_id, programid, title, safe_title,description, vouchercode, 
                                start_date, expiry_date, relationship, merchant_logo_url, network, excode, deep_link, 
                                affiliate_url, merchant_url, created, modified)
                                
                                VALUES
                                
                                ((SELECT id FROM merchants WHERE icodesuk_merchant_id = mMerchantICID),
                                'voucher', 'IcodesUK', mICID, mProgramId, mTitle, (SELECT createSafeTitle(mTitle)),mDescription, mVoucherCode, mStartDate, 
                                mExpiryDate, mRelationship, mMerchantLogoURL, mNetwork,  mExCode,  mDeepLink, mAffiliateURL, 
                                mMerchantURL, now(), now());
            
                
                /* Here we have to create relation between site and newly added category */         
                IF (SELECT Count(*) FROM temp) > 0 THEN
                            
                        INSERT INTO cods_sites (site_id, cod_id) 
                                        SELECT site_id, (SELECT id FROM cods WHERE icodesuk_id = mICID)  
                                        FROM temp;
                END IF;
                /* END */
            
            ELSEIF 
                
                (SELECT Count(*) FROM cods 
                        WHERE   source = 'IcodesUK' 
                                AND cod_type = 'voucher' 
                                AND icodesuk_id = mICID) > 0 THEN
            
                -- IF Voucher exists Then UPDATE 
                UPDATE cods SET
                
                                title = mTitle, 
                                description = mDescription, 
                                merchant_logo_url = mMerchantLogoURL, 
                                programid = mProgramId,
                                network = mNetwork, 
                                vouchercode = mVoucherCode, 
                                excode = mExCode, 
                                start_date = mStartDate, 
                                expiry_date = mExpiryDate, 
                                deep_link = mDeepLink, 
                                affiliate_url = mAffiliateURL, 
                                merchant_url = mMerchantURL, 
                                modified = now()
                                WHERE icodesuk_id = mICID AND source = 'IcodesUK' AND cod_type = 'voucher';
            END IF;
                    
            UPDATE icodesuk_codes
                
                SET processed = 1
                    WHERE icid = mICID AND processed = 0;
                    
    END IF; -- END IF Merchant Check
    
    END LOOP;
    
    CLOSE Codes;
END







$$

$$
DELIMITER ;


-- -----------------------------------------------------
-- procedure IcodesukGetImportedOffers
-- -----------------------------------------------------
DELIMITER $$
CREATE PROCEDURE `IcodesukGetImportedOffers`(mSites VARCHAR(255))
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
 *       STORED PROCEDURE : IcodesukGetImportedOffers
 *       DESCRIPTION      : This SP gets all voucher codes imported from icodes uk.
 */

    -- Declare Variables 
    DECLARE done INT DEFAULT 0;             -- flag for no more records
    DECLARE mICID VARCHAR(100);             -- for icid    
    DECLARE mMerchantICID VARCHAR(100);     -- for merchant_icid
    DECLARE mTitle VARCHAR(255);            -- for voucher title
    DECLARE mDescription TEXT;              -- for voucher description
    DECLARE mMerchant VARCHAR(255);         -- for merchant
    DECLARE mRelationship VARCHAR(45);      -- for relationship
    DECLARE mMerchantLogoURL VARCHAR(1024); -- for merchant_logo_url
    DECLARE mMerchantId VARCHAR(100);       -- for merchantid
    DECLARE mProgramId VARCHAR(100);        -- for programid
    DECLARE mNetwork VARCHAR(255);          -- for network
    DECLARE mStartDate DATETIME;            -- for start_date
    DECLARE mExpiryDate DATETIME;           -- for expiry_date
    DECLARE mDeepLink VARCHAR(1024);        -- for deep_link
    DECLARE mAffiliateURL VARCHAR(1024);    -- for affiliate_url
    DECLARE mMerchantURL VARCHAR(1024);     -- for merchant_url
    
        
    -- Declaring cursor and Handler
    DECLARE Offers CURSOR FOR 
    SELECT  icid, merchant_icid, title, description, merchant, relationship, 
            merchant_logo_url, merchantid, programid, network, start_date, 
            expiry_date, deep_link, affiliate_url, merchant_url
            FROM icodesuk_offers
            WHERE processed = 0;
    
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;

    -- following procedure creates a temporary table 
    -- of default site ids for this plugin 
    call splitString(mSites);
    
    OPEN Offers;
    
    Offers_Loop: LOOP
    
        Fetch Offers INTO 
            
            mICID, mMerchantICID, mTitle, mDescription, mMerchant, mRelationship,
            mMerchantLogoURL, mMerchantId, mProgramId, mNetwork, mStartDate, 
            mExpiryDate, mDeepLink, mAffiliateURL, mMerchantURL;
            
        IF done THEN
            Leave Offers_Loop;
        END IF;
        
        -- IF Merchant EXISTS
        --      IF Voucher EXISTS
        --          UPDATE Voucher Details
        --      ELSE 
        --          INSERT Voucher Details
        --      END IF
        -- END IF
        IF (SELECT Count(*) FROM merchants
                    WHERE icodesuk_merchant_id = mMerchantICID) > 0 THEN
                            
            -- IF Merchant Exist we will proceed further.
                            
            IF
                (SELECT Count(*) FROM cods 
                        WHERE   source = 'IcodesUK' 
                                AND cod_type = 'offer' 
                                AND icodesuk_id = mICID) = 0 THEN
            
            
                -- IF Voucher does not exist Then INSERT
                INSERT INTO cods
                            (merchant_id, cod_type, source, icodesuk_id, programid, title, safe_title, description,  start_date, 
                            expiry_date, relationship, merchant_logo_url, network, deep_link, affiliate_url, 
                            merchant_url, created, modified)
                            VALUES
                            ((SELECT id FROM merchants WHERE icodesuk_merchant_id = mMerchantICID), 'offer', 'IcodesUK', 
                            mICID, mProgramId, mTitle, (SELECT createSafeTitle(mTitle)), mDescription, mStartDate, mExpiryDate, mRelationship, mMerchantLogoURL, 
                            mNetwork,  mDeepLink, mAffiliateURL, mMerchantURL, now(), now());
            
                /* Here we have to create relation between site and newly added category */         
                IF (SELECT Count(*) FROM temp) > 0 THEN
                            
                        INSERT INTO cods_sites (site_id, cod_id) 
                                        SELECT site_id, (SELECT id FROM cods WHERE icodesuk_id = mICID)  
                                        FROM temp;
                END IF;
                /* END */
            
            ELSEIF 
                
                (SELECT Count(*) FROM cods 
                        WHERE   source = 'IcodesUK' 
                                AND cod_type = 'offer' 
                                AND icodesuk_id = mICID) > 0 THEN
            
                -- IF Voucher exists Then UPDATE 
                UPDATE cods SET
                            title = mTitle, 
                            description = mDescription, 
                            merchant_logo_url = mMerchantLogoURL, 
                            programid = mProgramId,
                            network = mNetwork, 
                            start_date = mStartDate, 
                            expiry_date = mExpiryDate, 
                            deep_link = mDeepLink, 
                            affiliate_url = mAffiliateURL, 
                            merchant_url = mMerchantURL, 
                            modified = now()
                            WHERE icodesuk_id = mICID AND source = 'IcodesUK' AND cod_type = 'offer';
            END IF;
        
            UPDATE icodesuk_offers
                SET processed = 1
                    WHERE icid = mICID AND processed = 0;
                    
    END IF; -- END IF Merchant Check
    
    END LOOP;
    CLOSE Offers;
END







$$

$$
DELIMITER ;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;



INSERT INTO `pluginsconfigurations` (`plugintype`,`pluginid`, `pluginname`, `datakey`, `dataval`) VALUES
('configurable','87d9dba5-2168-4bf7-bb13-fc12ff3dc030', 'dvs4icodesuk', 'username', 'not configured'),
('configurable','87d9dba5-2168-4bf7-bb13-fc12ff3dc030', 'dvs4icodesuk', 'subscriptionid', 'not configured'),
('configurable','87d9dba5-2168-4bf7-bb13-fc12ff3dc030', 'dvs4icodesuk', 'merchants_import_char', 'eof'),
('configurable','87d9dba5-2168-4bf7-bb13-fc12ff3dc030', 'dvs4icodesuk', 'merchants_import_page', 'eof'),
('configurable','87d9dba5-2168-4bf7-bb13-fc12ff3dc030', 'dvs4icodesuk', 'codes_import_page', 'eof'),
('configurable','87d9dba5-2168-4bf7-bb13-fc12ff3dc030', 'dvs4icodesuk', 'offers_import_page', 'eof'),
('configurable','87d9dba5-2168-4bf7-bb13-fc12ff3dc030', 'dvs4icodesuk', 'category_import', 'no'),
('configurable','87d9dba5-2168-4bf7-bb13-fc12ff3dc030', 'dvs4icodesuk', 'default-sites', ''),
('configurable','87d9dba5-2168-4bf7-bb13-fc12ff3dc030', 'dvs4icodesuk', 'last_run_time', '1970-01-01 00:00:00'),
('configurable','87d9dba5-2168-4bf7-bb13-fc12ff3dc030', 'dvs4icodesuk', 'second_level_import', 'no');