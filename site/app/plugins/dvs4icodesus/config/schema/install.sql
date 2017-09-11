SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';


-- -----------------------------------------------------
-- Table `icodesus_categories`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `icodesus_categories` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `icodes_name` VARCHAR(255) NOT NULL ,
  `icodes_id` INT(11) NOT NULL ,
  `processed` TINYINT NULL DEFAULT 0 ,
  `created` DATETIME NULL DEFAULT NULL ,
  `modified` DATETIME NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `icodes_name_index` (`icodes_name` ASC) ,
  INDEX `icodes_id_index` (`icodes_id` ASC) ,
  INDEX `processed_index` (`processed` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `icodesus_codes`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `icodesus_codes` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `icid` VARCHAR(100) NULL DEFAULT NULL ,
  `merchant_icid` VARCHAR(100) NULL DEFAULT NULL ,
  `title` VARCHAR(255) NULL DEFAULT NULL ,
  `description` VARCHAR(512) NULL DEFAULT NULL ,
  `merchant` VARCHAR(255) NULL DEFAULT NULL ,
  `merchant_logo_url` VARCHAR(1024) NULL DEFAULT NULL ,
  `network` VARCHAR(255) NULL DEFAULT NULL ,
  `vouchercode` VARCHAR(255) NULL DEFAULT NULL ,
  `excode` VARCHAR(255) NULL DEFAULT NULL ,
  `start_date` DATETIME NULL DEFAULT NULL ,
  `expiry_date` DATETIME NULL DEFAULT NULL ,
  `affiliate_url` VARCHAR(1024) NULL DEFAULT NULL ,
  `merchant_url` VARCHAR(1024) NULL DEFAULT NULL ,
  `categoryid` VARCHAR(100) NULL DEFAULT NULL ,
  `category` VARCHAR(255) NULL DEFAULT NULL ,
  `processed` TINYINT NULL DEFAULT 0 ,
  `created` DATETIME NULL DEFAULT NULL ,
  `modified` DATETIME NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `icid_index` (`icid` ASC) ,
  INDEX `merchant_icid` (`merchant_icid` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `icodesus_codes_dumps`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `icodesus_codes_dumps` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `icid` VARCHAR(100) NULL DEFAULT NULL ,
  `merchant_icid` VARCHAR(100) NULL DEFAULT NULL ,
  `title` VARCHAR(255) NULL DEFAULT NULL ,
  `description` VARCHAR(1024) NULL DEFAULT NULL ,
  `merchant` VARCHAR(255) NULL DEFAULT NULL ,
  `merchant_logo_url` VARCHAR(1024) NULL DEFAULT NULL ,
  `network` VARCHAR(255) NULL DEFAULT NULL ,
  `vouchercode` VARCHAR(255) NULL DEFAULT NULL ,
  `excode` VARCHAR(255) NULL DEFAULT NULL ,
  `start_date` DATETIME NULL DEFAULT NULL ,
  `expiry_date` DATETIME NULL DEFAULT NULL ,
  `affiliate_url` VARCHAR(1024) NULL DEFAULT NULL ,
  `merchant_url` VARCHAR(1024) NULL DEFAULT NULL ,
  `categoryid` VARCHAR(100) NULL DEFAULT NULL ,
  `category` VARCHAR(255) NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `icidindex` (`icid` ASC) )
ENGINE = InnoDB
AUTO_INCREMENT = 201
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `icodesus_merchants`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `icodesus_merchants` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `icid` VARCHAR(100) NULL DEFAULT NULL ,
  `merchant` VARCHAR(255) NULL DEFAULT NULL ,
  `merchant_logo_url` VARCHAR(1024) NULL DEFAULT NULL ,
  `total_offers` VARCHAR(100) NULL DEFAULT NULL ,
  `affiliate_url` VARCHAR(1024) NULL DEFAULT NULL ,
  `merchant_url` VARCHAR(1024) NULL DEFAULT NULL ,
  `category` VARCHAR(100) NULL ,
  `processed` TINYINT NULL DEFAULT 0 ,
  `created` DATETIME NULL DEFAULT NULL ,
  `modified` DATETIME NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `icid_index` (`icid` ASC) ,
  INDEX `category_index` (`category` ASC) ,
  INDEX `processed_index` (`processed` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `icodesus_merchants_dumps`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `icodesus_merchants_dumps` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `icid` VARCHAR(100) NULL DEFAULT NULL ,
  `merchant` VARCHAR(255) NULL DEFAULT NULL ,
  `merchant_logo_url` VARCHAR(1024) NULL DEFAULT NULL ,
  `total_offers` VARCHAR(100) NULL DEFAULT NULL ,
  `affiliate_url` VARCHAR(1024) NULL DEFAULT NULL ,
  `merchant_url` VARCHAR(1024) NULL DEFAULT NULL ,
  `category` VARCHAR(100) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 128
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `icodesus_offers`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `icodesus_offers` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `icid` VARCHAR(100) NULL DEFAULT NULL ,
  `merchant_icid` VARCHAR(100) NULL DEFAULT NULL ,
  `title` VARCHAR(255) NULL DEFAULT NULL ,
  `description` TEXT NULL DEFAULT NULL ,
  `merchant` VARCHAR(255) NULL DEFAULT NULL ,
  `merchant_logo_url` VARCHAR(1024) NULL DEFAULT NULL ,
  `network` VARCHAR(255) NULL DEFAULT NULL ,
  `start_date` DATETIME NULL DEFAULT NULL ,
  `expiry_date` DATETIME NULL DEFAULT NULL ,
  `affiliate_url` VARCHAR(1024) NULL DEFAULT NULL ,
  `merchant_url` VARCHAR(1024) NULL DEFAULT NULL ,
  `categoryid` VARCHAR(100) NULL DEFAULT NULL ,
  `category` VARCHAR(255) NULL DEFAULT NULL ,
  `processed` TINYINT NULL DEFAULT 0 ,
  `created` DATETIME NULL DEFAULT NULL ,
  `modified` DATETIME NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `icid_index` (`icid` ASC) ,
  INDEX `merchant_icid_index` (`merchant_icid` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `icodesus_offers_dumps`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `icodesus_offers_dumps` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `icid` VARCHAR(100) NULL DEFAULT NULL ,
  `merchant_icid` VARCHAR(100) NULL DEFAULT NULL ,
  `title` VARCHAR(255) NULL DEFAULT NULL ,
  `description` TEXT NULL DEFAULT NULL ,
  `merchant` VARCHAR(255) NULL DEFAULT NULL ,
  `merchant_logo_url` VARCHAR(1024) NULL DEFAULT NULL ,
  `network` VARCHAR(255) NULL DEFAULT NULL ,
  `start_date` DATETIME NULL DEFAULT NULL ,
  `expiry_date` DATETIME NULL DEFAULT NULL ,
  `affiliate_url` VARCHAR(1024) NULL DEFAULT NULL ,
  `merchant_url` VARCHAR(1024) NULL DEFAULT NULL ,
  `categoryid` VARCHAR(100) NULL DEFAULT NULL ,
  `category` VARCHAR(255) NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `icidindex` (`icid` ASC) )
ENGINE = InnoDB
AUTO_INCREMENT = 201
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `icodesus_categories_dumps`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `icodesus_categories_dumps` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `icodes_name` VARCHAR(255) NULL ,
  `icodes_id` INT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `icodesuscategorymerchantdumps`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `icodesuscategorymerchantdumps` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `merchant_icid` VARCHAR(45) NULL ,
  `merchant_name` VARCHAR(255) NULL ,
  `category_id` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `icodesuscategorymerchants`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `icodesuscategorymerchants` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `merchant_icid` VARCHAR(45) NULL ,
  `merchant_name` VARCHAR(255) NULL ,
  `category_id` VARCHAR(45) NULL ,
  `processed` TINYINT NULL DEFAULT 0 ,
  `created` DATETIME NULL ,
  `modified` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `merchant_icid_index` (`merchant_icid` ASC) ,
  INDEX `merchant_name_index` (`merchant_name` ASC) ,
  INDEX `category_id_index` (`category_id` ASC) ,
  INDEX `processed_index` (`processed` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- procedure IcodesusCopyMerchantsFromDump
-- -----------------------------------------------------
DELIMITER $$
CREATE PROCEDURE `IcodesusCopyMerchantsFromDump`()

BEGIN

/**
 * The DVS License (http://www.voucherscript.com/license.html)
 * Denovo Voucher Script (DVS): The Instant Voucher Site (http://www.voucherscript.com)
 * Copyright 2009-2011, Computed Synergy (http://www.computedsynergy.com)
 *
 * Permission is hereby granted to:
 *
 * 1] Use this software free of charge for both personal and commercial purposes.
 * 2] Modify the script to customize it as needed.
 *
 *
 * Provided you agree to the following terms:
 *
 * 1] You may NOT redistribute, repost, resell any part of this script, or works deriving
 *    from this script, or works that enahance or add more features to this script. Redistribution
 *    is defined as re-offering our script for download/distribution in any manner, anywhere.
 * 2] You will not remove or modify any copyright notice and/or credits without written permission
 *    except where allowed (such as the "Powered by DVS" at the bottom of all pages, except the backoffice pages).
 * 3] You will not use this software for illegal purposes.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
 * FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER
 * DEALINGS IN THE SOFTWARE.
 * 
 */

/**
 *        STORED PROCEDURE : IcodesusCopyMerchantsFromDump
 *       DESCRIPTION      : This SP copies all merchants from dump table.
 */

    -- Declare Variables
    DECLARE done INT DEFAULT 0;                 -- flag for no more records
    DECLARE mICID VARCHAR(100);                 -- for merchant_icid
    DECLARE mMerchant VARCHAR(255);             -- for merchant (merchant name);
    DECLARE mMerchantLogoURL VARCHAR(1024);     -- for merchant_logo_url
    DECLARE mAffiliateURL VARCHAR(1024);        -- affiliate_url
    DECLARE mMerchantURL VARCHAR(1024);         -- merchant_url
    DECLARE mTotalOffers VARCHAR(255);          -- for total_offers

    -- Declare Cursor and Handler
    DECLARE MerchantDump CURSOR FOR 
        SELECT  icid, merchant, merchant_logo_url, 
                total_offers, affiliate_url, merchant_url 
                FROM icodesus_merchants_dumps;
    
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;

    
    OPEN MerchantDump;

    Merchant_Records: LOOP
    
        FETCH MerchantDump INTO 
            mICID, mMerchant, mMerchantLogoURL, 
            mTotalOffers, mAffiliateURL, mMerchantURL;  
    
        IF done THEN
            Leave Merchant_Records;
        END IF;
        
        -- Check if Merchant Exists
        --      Update merchant details
        -- ELSE 
        --      Insert Merchant
        IF (SELECT Count(*) FROM icodesus_merchants WHERE icid = mICID) = 0 THEN
        
            INSERT INTO icodesus_merchants
                    
                    (icid, merchant, merchant_logo_url, total_offers, 
                    affiliate_url, merchant_url, processed, created, modified)
                    
                    VALUES
                    
                    (mICID, mMerchant, mMerchantLogoURL, mTotalOffers, 
                    mAffiliateURL, mMerchantURL, 0, now(), now());
    
    
        ELSEIF (SELECT Count(*) FROM icodesus_merchants WHERE icid = mICID) > 0 THEN
        
            UPDATE icodesus_merchants SET
                
                merchant = mMerchant, 
                merchant_logo_url = mMerchantLogoURL, 
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
-- procedure IcodesusCopyOffersFromDump
-- -----------------------------------------------------
DELIMITER $$
CREATE PROCEDURE `IcodesusCopyOffersFromDump`()

BEGIN

/**
 * The DVS License (http://www.voucherscript.com/license.html)
 * Denovo Voucher Script (DVS): The Instant Voucher Site (http://www.voucherscript.com)
 * Copyright 2009-2011, Computed Synergy (http://www.computedsynergy.com)
 *
 * Permission is hereby granted to:
 *
 * 1] Use this software free of charge for both personal and commercial purposes.
 * 2] Modify the script to customize it as needed.
 *
 *
 * Provided you agree to the following terms:
 *
 * 1] You may NOT redistribute, repost, resell any part of this script, or works deriving
 *    from this script, or works that enahance or add more features to this script. Redistribution
 *    is defined as re-offering our script for download/distribution in any manner, anywhere.
 * 2] You will not remove or modify any copyright notice and/or credits without written permission
 *    except where allowed (such as the "Powered by DVS" at the bottom of all pages, except the backoffice pages).
 * 3] You will not use this software for illegal purposes.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
 * FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER
 * DEALINGS IN THE SOFTWARE.
 * 
 */

/**
 * STORED PROCEDURE : IcodesusCopyOffersFromDump
 * DESCRIPTION      : This SP inserts and Updates Voucher Codes from codes dump table.
 */

    -- Declare Variables 
    DECLARE done INT DEFAULT 0;             -- flag for no more records
    DECLARE mICID VARCHAR(100);             -- for icid    
    DECLARE mMerchantICID VARCHAR(100);     -- for merchant_icid
    DECLARE mTitle VARCHAR(255);            -- for voucher title
    DECLARE mDescription TEXT;              -- for voucher description
    DECLARE mMerchant VARCHAR(255);         -- for merchant
    DECLARE mMerchantLogoURL VARCHAR(1024); -- for merchant_logo_url
    DECLARE mNetwork VARCHAR(255);          -- for network
    DECLARE mStartDate DATETIME;            -- for start_date
    DECLARE mExpiryDate DATETIME;           -- for expiry_date
    DECLARE mAffiliateURL VARCHAR(1024);    -- for affiliate_url
    DECLARE mMerchantURL VARCHAR(1024);     -- for merchant_url
    DECLARE mCategoryId VARCHAR(100);       -- for categoryid
    DECLARE mCategory VARCHAR(255);         -- for category
    
        
    -- Declaring cursor and Handler
    DECLARE OffersDump CURSOR FOR 
    SELECT  icid,merchant_icid,title,description, merchant, 
            merchant_logo_url, network, start_date, expiry_date, 
            affiliate_url, merchant_url, categoryid, category
            FROM icodesus_offers_dumps;
    
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;

    
    OPEN OffersDump;
    
    Offers_Loop: LOOP
    
        Fetch OffersDump INTO 
            
            mICID, mMerchantICID, mTitle, mDescription, mMerchant, mMerchantLogoURL, 
            mNetwork, mStartDate, mExpiryDate, mAffiliateURL, mMerchantURL, mCategoryId, 
            mCategory;
            
        IF done THEN
            Leave Offers_Loop;
        END IF;
        
        
        -- Check if Voucher exists
        --      UPDATE Voucher Details
        -- ELSE 
        --      INSERT Voucher Details
        
        IF(SELECT Count(*) FROM icodesus_offers WHERE icid = mICID) = 0 THEN
        
            INSERT INTO icodesus_offers 
                            
                            (icid, merchant_icid, title, description, merchant, merchant_logo_url, network, 
                            start_date, expiry_date, affiliate_url, merchant_url, categoryid, category, 
                            processed, created, modified)
                            
                            VALUES
                            
                            (mICID, mMerchantICID, mTitle, mDescription, mMerchant, mMerchantLogoURL, mNetwork, 
                            mStartDate, mExpiryDate, mAffiliateURL, mMerchantURL, mCategoryId, mCategory, 0, 
                            now(), now());
        
        ELSEIF (SELECT Count(*) FROM icodesus_offers WHERE icid = mICID) > 0 THEN
        
            UPDATE icodesus_offers SET
            
                            title = mTitle, 
                            description = mDescription, 
                            merchant_logo_url = mMerchantLogoURL, 
                            network = mNetwork, 
                            start_date = mStartDate, 
                            expiry_date = mExpiryDate, 
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
-- procedure IcodesusCopyCodesFromDump
-- -----------------------------------------------------
DELIMITER $$
CREATE PROCEDURE `IcodesusCopyCodesFromDump`()

BEGIN

/**
 * The DVS License (http://www.voucherscript.com/license.html)
 * Denovo Voucher Script (DVS): The Instant Voucher Site (http://www.voucherscript.com)
 * Copyright 2009-2011, Computed Synergy (http://www.computedsynergy.com)
 *
 * Permission is hereby granted to:
 *
 * 1] Use this software free of charge for both personal and commercial purposes.
 * 2] Modify the script to customize it as needed.
 *
 *
 * Provided you agree to the following terms:
 *
 * 1] You may NOT redistribute, repost, resell any part of this script, or works deriving
 *    from this script, or works that enahance or add more features to this script. Redistribution
 *    is defined as re-offering our script for download/distribution in any manner, anywhere.
 * 2] You will not remove or modify any copyright notice and/or credits without written permission
 *    except where allowed (such as the "Powered by DVS" at the bottom of all pages, except the backoffice pages).
 * 3] You will not use this software for illegal purposes.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
 * FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER
 * DEALINGS IN THE SOFTWARE.
 * 
 */

/**
 * STORED PROCEDURE : IcodesusCopyCodesFromDump
 * DESCRIPTION      : This SP inserts and Updates Voucher Codes from codes dump table.
 */

    -- Declare Variables 
    DECLARE done INT DEFAULT 0;             -- flag for no more records
    DECLARE mICID VARCHAR(100);             -- for icid    
    DECLARE mMerchantICID VARCHAR(100);     -- for merchant_icid
    DECLARE mTitle VARCHAR(255);            -- for voucher title
    DECLARE mDescription TEXT;              -- for voucher description
    DECLARE mMerchant VARCHAR(255);         -- for merchant
    DECLARE mMerchantLogoURL VARCHAR(1024); -- for merchant_logo_url
    DECLARE mNetwork VARCHAR(255);          -- for network
    DECLARE mVoucherCode VARCHAR(255);      -- for vouchercode
    DECLARE mExCode VARCHAR(255);           -- for excode
    DECLARE mStartDate DATETIME;            -- for start_date
    DECLARE mExpiryDate DATETIME;           -- for expiry_date
    DECLARE mAffiliateURL VARCHAR(1024);    -- for affiliate_url
    DECLARE mMerchantURL VARCHAR(1024);     -- for merchant_url
    DECLARE mCategoryId VARCHAR(100);       -- for categoryid
    DECLARE mCategory VARCHAR(255);         -- for category
    
        
    -- Declaring cursor and Handler
    DECLARE CodesDump CURSOR FOR 
    SELECT  icid,merchant_icid,title,description, merchant, 
            merchant_logo_url, network, vouchercode, excode, 
            start_date, expiry_date, affiliate_url, merchant_url, 
            categoryid, category
            FROM icodesus_codes_dumps;
    
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;

    
    OPEN CodesDump;
    
    Codes_Loop: LOOP
    
        Fetch CodesDump INTO 
            
            mICID, mMerchantICID, mTitle, mDescription, mMerchant, mMerchantLogoURL, 
            mNetwork, mVoucherCode, mExCode, mStartDate, mExpiryDate, mAffiliateURL, 
            mMerchantURL, mCategoryId, mCategory;
            
        IF done THEN
            Leave Codes_Loop;
        END IF;
        
        
        -- Check if Voucher exists
        --      UPDATE Voucher Details
        -- ELSE 
        --      INSERT Voucher Details
        
        IF(SELECT Count(*) FROM icodesus_codes WHERE icid = mICID) = 0 THEN
        
            INSERT INTO icodesus_codes 
                            
                            (icid, merchant_icid, title, description, merchant, merchant_logo_url, network, 
                            vouchercode, excode, start_date, expiry_date, affiliate_url, merchant_url, categoryid, 
                            category, processed, created, modified)
                            
                            VALUES
                            
                            (mICID, mMerchantICID, mTitle, mDescription, mMerchant, mMerchantLogoURL, mNetwork, 
                            mVoucherCode, mExCode, mStartDate, mExpiryDate, mAffiliateURL, mMerchantURL, mCategoryId, 
                            mCategory, 0, now(), now());
        
        ELSEIF (SELECT Count(*) FROM icodesus_codes WHERE icid = mICID) > 0 THEN
        
            UPDATE icodesus_codes SET
            
                            title = mTitle, 
                            description = mDescription, 
                            merchant_logo_url = mMerchantLogoURL, 
                            network = mNetwork, 
                            vouchercode = mVoucherCode, 
                            excode = mExCode, 
                            start_date = mStartDate, 
                            expiry_date = mExpiryDate, 
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
-- procedure IcodesusCopyCategoryMerchantJoins
-- -----------------------------------------------------
DELIMITER $$
CREATE PROCEDURE `IcodesusCopyCategoryMerchantJoins`()

BEGIN

/**
 * The DVS License (http://www.voucherscript.com/license.html)
 * Denovo Voucher Script (DVS): The Instant Voucher Site (http://www.voucherscript.com)
 * Copyright 2009-2011, Computed Synergy (http://www.computedsynergy.com)
 *
 * Permission is hereby granted to:
 *
 * 1] Use this software free of charge for both personal and commercial purposes.
 * 2] Modify the script to customize it as needed.
 *
 *
 * Provided you agree to the following terms:
 *
 * 1] You may NOT redistribute, repost, resell any part of this script, or works deriving
 *    from this script, or works that enahance or add more features to this script. Redistribution
 *    is defined as re-offering our script for download/distribution in any manner, anywhere.
 * 2] You will not remove or modify any copyright notice and/or credits without written permission
 *    except where allowed (such as the "Powered by DVS" at the bottom of all pages, except the backoffice pages).
 * 3] You will not use this software for illegal purposes.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
 * FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER
 * DEALINGS IN THE SOFTWARE.
 * 
 */

/**
 *      STORED PROCEDURE : IcodesusCopyCategoryMerchantJoins
 *       DESCRIPTION      : This SP Copies category and merchant relation from dump.
 */

    -- Declare Variables

    DECLARE done INT DEFAULT 0;         -- flag for no more records
    DECLARE mMerchantId VARCHAR(100);   -- for merchant_icid    
    DECLARE mMerchantName VARCHAR(255); -- for merchant_name
    DECLARE mCategoryId VARCHAR(100);   -- for category_id

    
    -- Declaring cursor and Handler
    DECLARE CategoryMerchantDump CURSOR FOR SELECT merchant_icid, merchant_name, category_id  FROM icodesuscategorymerchantdumps;
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;

    OPEN CategoryMerchantDump;
    
    cmLoop: LOOP
    
        FETCH CategoryMerchantDump INTO mMerchantId, mMerchantName, mCategoryId;
        
        IF done THEN
            LEAVE cmLoop;
        END IF;


        -- Check if Relation does not exist
        -- Create it
        
        IF (SELECT Count(*) FROM icodesuscategorymerchants WHERE merchant_icid = mMerchantId AND category_id = mCategoryId) = 0 THEN

            INSERT INTO icodesuscategorymerchants       
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
-- procedure IcodesusCopyCategoriesFromDump
-- -----------------------------------------------------
DELIMITER $$
CREATE PROCEDURE `IcodesusCopyCategoriesFromDump`()

BEGIN

/**
 * The DVS License (http://www.voucherscript.com/license.html)
 * Denovo Voucher Script (DVS): The Instant Voucher Site (http://www.voucherscript.com)
 * Copyright 2009-2011, Computed Synergy (http://www.computedsynergy.com)
 *
 * Permission is hereby granted to:
 *
 * 1] Use this software free of charge for both personal and commercial purposes.
 * 2] Modify the script to customize it as needed.
 *
 *
 * Provided you agree to the following terms:
 *
 * 1] You may NOT redistribute, repost, resell any part of this script, or works deriving
 *    from this script, or works that enahance or add more features to this script. Redistribution
 *    is defined as re-offering our script for download/distribution in any manner, anywhere.
 * 2] You will not remove or modify any copyright notice and/or credits without written permission
 *    except where allowed (such as the "Powered by DVS" at the bottom of all pages, except the backoffice pages).
 * 3] You will not use this software for illegal purposes.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
 * FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER
 * DEALINGS IN THE SOFTWARE.
 * 
 */

/**
 *       STORED PROCEDURE : IcodesusCopyCategoriesFromDump
 *       DESCRIPTION      : This SP inserts and Updates categories from categories dump table.
 */
    
    DECLARE done INT DEFAULT 0;     -- flag for no more records
    DECLARE cat_name VARCHAR(255);  -- for category name    
    DECLARE cat_id VARCHAR(100);    -- category id
    
    -- Declaring cursor and Handler
    DECLARE catDump CURSOR FOR 
        SELECT  icodes_name, icodes_id  
                FROM icodesus_categories_dumps;
    
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
        
        IF (SELECT COUNT(*) FROM icodesus_categories WHERE icodes_id = cat_id) > 0 THEN
        
            /* UPDATE if Category already exists */
            UPDATE icodesus_categories SET icodes_name = cat_name WHERE icodes_id = cat_id;
        
        
        ELSEIF (SELECT COUNT(*) FROM icodesus_categories WHERE icodes_id = cat_id) = 0 THEN
        
            /* INSERT category if does not exits */
            INSERT INTO icodesus_categories
                    
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
-- procedure IcodesusGetImportedCategories
-- -----------------------------------------------------
DELIMITER $$
CREATE PROCEDURE `IcodesusGetImportedCategories`(mSites VARCHAR(255))
BEGIN

/**
 * The DVS License (http://www.voucherscript.com/license.html)
 * Denovo Voucher Script (DVS): The Instant Voucher Site (http://www.voucherscript.com)
 * Copyright 2009-2011, Computed Synergy (http://www.computedsynergy.com)
 *
 * Permission is hereby granted to:
 *
 * 1] Use this software free of charge for both personal and commercial purposes.
 * 2] Modify the script to customize it as needed.
 *
 *
 * Provided you agree to the following terms:
 *
 * 1] You may NOT redistribute, repost, resell any part of this script, or works deriving
 *    from this script, or works that enahance or add more features to this script. Redistribution
 *    is defined as re-offering our script for download/distribution in any manner, anywhere.
 * 2] You will not remove or modify any copyright notice and/or credits without written permission
 *    except where allowed (such as the "Powered by DVS" at the bottom of all pages, except the backoffice pages).
 * 3] You will not use this software for illegal purposes.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
 * FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER
 * DEALINGS IN THE SOFTWARE.
 * 
 */

/**
 *  STORED PROCEDURE : IcodesusGetImportedCategories
 *  DESCRIPTION      : This SP transfer all imported Categories to Live db.
 */
    
    
    DECLARE done INT DEFAULT 0;     -- flag for no more records
    DECLARE mCatName VARCHAR(255);  -- for category name    
    DECLARE mCatId VARCHAR(100);    -- category id
    DECLARE mExistingCatId INT;     -- used for existing category id
    DECLARE mAutoUpdate BOOLEAN;    -- used for existing category autoupdate flag
    
    -- Declaring cursor and Handler
    DECLARE category CURSOR FOR 
        SELECT  icodes_name, icodes_id  
                FROM icodesus_categories
                WHERE processed = 0;
                
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;

    -- following procedure creates a temporary table 
    -- of default site ids for this plugin 
    call splitString(mSites);  
    
    OPEN category;
    
    cat_loop: LOOP
    
        FETCH category INTO mCatName, mCatId;
        
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
                        icodesus_category_id = mCatId
                        WHERE id = mExistingCatId;
                
            ELSEIF mAutoUpdate = FALSE THEN
            
                -- Update category network id only
                UPDATE  categories SET
                        icodesus_category_id = mCatId
                        WHERE id = mExistingCatId;
            
            END IF;
        
        ELSE
            
            -- Category name not found, check for network id of the category
            IF (SELECT Count(*) FROM categories WHERE icodesus_category_id = mCatId) > 0 THEN
                
                IF (SELECT autoupdate FROM categories WHERE icodesus_category_id = mCatId) = TRUE THEN
                
                    UPDATE  categories SET 
                            catname = mCatName
                            WHERE icodesus_category_id = mCatId;
                END IF;
                
            ELSE
                
                INSERT INTO categories
                        (catname, safe_catname, icodesus_category_id, source, parent_id, created, modified)
                        VALUES
                        (mCatName, (SELECT createSafeTitle(mCatName)), mCatId, 'IcodesUS', 0, now(), now());
                
                /* Here we have to create relation between site and newly added category */
                    
                IF (SELECT Count(*) FROM temp) > 0 THEN
                    
                    INSERT INTO categories_sites (site_id, category_id) 
                                    SELECT site_id, (SELECT id FROM categories WHERE icodesus_category_id = mCatId)  
                                    FROM temp;
                /* END */
                    
                END IF;
                
            END IF;
            
        END IF;
        
        UPDATE icodesus_categories SET processed = 1 WHERE icodes_id = mCatId AND processed =  0;
    
    END LOOP;
    
    CLOSE category;
END

$$

$$
DELIMITER ;


-- -----------------------------------------------------
-- procedure IcodesusGetImportedMerchants
-- -----------------------------------------------------
DELIMITER $$
CREATE PROCEDURE `IcodesusGetImportedMerchants`(mSites VARCHAR(255))
BEGIN

/**
 * The DVS License (http://www.voucherscript.com/license.html)
 * Denovo Voucher Script (DVS): The Instant Voucher Site (http://www.voucherscript.com)
 * Copyright 2009-2011, Computed Synergy (http://www.computedsynergy.com)
 *
 * Permission is hereby granted to:
 *
 * 1] Use this software free of charge for both personal and commercial purposes.
 * 2] Modify the script to customize it as needed.
 *
 *
 * Provided you agree to the following terms:
 *
 * 1] You may NOT redistribute, repost, resell any part of this script, or works deriving
 *    from this script, or works that enahance or add more features to this script. Redistribution
 *    is defined as re-offering our script for download/distribution in any manner, anywhere.
 * 2] You will not remove or modify any copyright notice and/or credits without written permission
 *    except where allowed (such as the "Powered by DVS" at the bottom of all pages, except the backoffice pages).
 * 3] You will not use this software for illegal purposes.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
 * FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER
 * DEALINGS IN THE SOFTWARE.
 * 
 */

/**
 * STORED PROCEDURE : IcodesusGetImportedMerchants
 * DESCRIPTION      : This SP get all merchants imported from icodesus to our live merchants table.
 */

    -- Declare Variables
    DECLARE done INT DEFAULT 0;                 -- flag for no more records
    DECLARE mICID VARCHAR(100);                 -- for merchant_icid
    DECLARE mMerchant VARCHAR(255);             -- for merchant (merchant name);
    DECLARE mMerchantLogoURL VARCHAR(1024);     -- for merchant_logo_url
    DECLARE mAffiliateURL VARCHAR(1024);        -- affiliate_url
    DECLARE mMerchantURL VARCHAR(1024);         -- merchant_url
    DECLARE mTotalOffers VARCHAR(255);          -- for total_offers

    DECLARE mMerchantIdPK INT;                    -- Merchant primery key

    -- Declare Cursor and Handler
    DECLARE Merchants CURSOR FOR 
        SELECT  icid, merchant, merchant_logo_url, total_offers, 
                affiliate_url, merchant_url
                FROM icodesus_merchants
                WHERE processed = 0;
    
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;

    -- following procedure creates a temporary table 
    -- of default site ids for this plugin 
    call splitString(mSites);

    OPEN Merchants;

    Merchant: LOOP
    
        FETCH Merchants INTO 
            mICID, mMerchant, mMerchantLogoURL,
            mTotalOffers, mAffiliateURL, mMerchantURL;  
    
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
                
                    icodesus_merchant_id = mICID, 
                    logo_url = mMerchantLogoURL,
                    site_url = mMerchantURL,
                    total_offers = mTotalOffers,                
                    affiliate_url = mAffiliateURL, 
                    modified = now()
               
                    WHERE merchant_name = mMerchant;
            ELSE
                
                UPDATE merchants SET
                    icodesus_merchant_id = mICID 
                    WHERE merchant_name = mMerchant;
            END IF;
        
        ELSE 
        
            -- merchant name not found check for icodes id
            IF (SELECT Count(*) FROM merchants WHERE icodesus_merchant_id = mICID) > 0 THEN
                
                -- merchant id found
                IF (SELECT Count(*) FROM merchants WHERE icodesus_merchant_id = mICID AND autoupdate = 1) THEN
                    
                UPDATE merchants SET
                
                    merchant_name = mMerchant, 
                    logo_url = mMerchantLogoURL,
                    site_url = mMerchantURL,
                    total_offers = mTotalOffers,                
                    affiliate_url = mAffiliateURL, 
                    modified = now()
               
                    WHERE icodesus_merchant_id = mICID;
                
                END IF;
            
            ELSE
                
                -- id not found now insert merchant
                INSERT INTO merchants
                    (source, merchant_name, safe_merchant_name, icodesus_merchant_id, logo_url, site_url, 
                    total_offers, affiliate_url, created, modified)
                    VALUES
                    ('IcodesUS', mMerchant, (SELECT createSafeTitle(mMerchant)), mICID, mMerchantLogoURL, mMerchantURL, 
                    mTotalOffers, mAffiliateURL,  now(), now());
                
                SELECT id INTO mMerchantIdPK FROM merchants WHERE icodesus_merchant_id = mICID;
                
                /* Here we have to create relation between sites and newly added merchant*/
                IF (SELECT Count(*) FROM temp) > 0 THEN
                        INSERT INTO merchants_sites (site_id, merchant_id) 
                                    SELECT site_id, mMerchantIdPK FROM temp;
                END IF;
                /* END */
            
            END IF;
            
        END IF;
        
        -- Mark Record as Processed
        UPDATE icodesus_merchants SET processed = 1 WHERE icid = mICID AND processed = 0;
    
    END LOOP;

    Close Merchants;
END

$$

$$
DELIMITER ;


-- -----------------------------------------------------
-- procedure IcodesusGetCategoryMerchantJoins
-- -----------------------------------------------------
DELIMITER $$
CREATE PROCEDURE `IcodesusGetCategoryMerchantJoins`()
BEGIN

/**
 * The DVS License (http://www.voucherscript.com/license.html)
 * Denovo Voucher Script (DVS): The Instant Voucher Site (http://www.voucherscript.com)
 * Copyright 2009-2011, Computed Synergy (http://www.computedsynergy.com)
 *
 * Permission is hereby granted to:
 *
 * 1] Use this software free of charge for both personal and commercial purposes.
 * 2] Modify the script to customize it as needed.
 *
 *
 * Provided you agree to the following terms:
 *
 * 1] You may NOT redistribute, repost, resell any part of this script, or works deriving
 *    from this script, or works that enahance or add more features to this script. Redistribution
 *    is defined as re-offering our script for download/distribution in any manner, anywhere.
 * 2] You will not remove or modify any copyright notice and/or credits without written permission
 *    except where allowed (such as the "Powered by DVS" at the bottom of all pages, except the backoffice pages).
 * 3] You will not use this software for illegal purposes.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
 * FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER
 * DEALINGS IN THE SOFTWARE.
 * 
 */

/**
 *  STORED PROCEDURE : IcodesusGetCategoryMerchantJoins
 *  DESCRIPTION      : This SP creates relation between category and merchant via imported joins from icodesUK.
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
                FROM icodesuscategorymerchants
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
        IF  (SELECT Count(*) FROM categories WHERE icodesus_category_id = mCategoryId) > 0 
            AND 
            (SELECT Count(*) FROM merchants WHERE icodesus_merchant_id = mMerchantId) > 0
        THEN
                
            SELECT id INTO mMerchantIdPK FROM merchants WHERE icodesus_merchant_id = mMerchantId;
            SELECT id, merged_in INTO mCatId, mMergedId FROM categories WHERE icodesus_category_id = mCategoryId;
                    
            IF mMergedId <> 0 THEN
                SET mCatId = mMergedId;
            END IF;
            
            IF (SELECT Count(*) FROM categories_merchants WHERE category_id = mCatId AND merchant_id = mMerchantIdPK) = 0 THEN
            
                INSERT INTO categories_merchants
                    (category_id, merchant_id) VALUES (mCatId, mMerchantIdPK);
            
            END IF;
            
            -- Mark Record as Processed
            UPDATE  icodesuscategorymerchants 
                    SET     processed = 1 
                    WHERE   merchant_icid = mMerchantId 
                            AND category_id = mCategoryId;
        
        END IF;
        
    END LOOP;
    
    CLOSE CategoryMerchant;
END
$$

$$
DELIMITER ;


-- -----------------------------------------------------
-- procedure IcodesusGetImportedCodes
-- -----------------------------------------------------
DELIMITER $$
CREATE PROCEDURE `IcodesusGetImportedCodes`(mSites VARCHAR(255))
BEGIN

/**
 * The DVS License (http://www.voucherscript.com/license.html)
 * Denovo Voucher Script (DVS): The Instant Voucher Site (http://www.voucherscript.com)
 * Copyright 2009-2011, Computed Synergy (http://www.computedsynergy.com)
 *
 * Permission is hereby granted to:
 *
 * 1] Use this software free of charge for both personal and commercial purposes.
 * 2] Modify the script to customize it as needed.
 *
 *
 * Provided you agree to the following terms:
 *
 * 1] You may NOT redistribute, repost, resell any part of this script, or works deriving
 *    from this script, or works that enahance or add more features to this script. Redistribution
 *    is defined as re-offering our script for download/distribution in any manner, anywhere.
 * 2] You will not remove or modify any copyright notice and/or credits without written permission
 *    except where allowed (such as the "Powered by DVS" at the bottom of all pages, except the backoffice pages).
 * 3] You will not use this software for illegal purposes.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
 * FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER
 * DEALINGS IN THE SOFTWARE.
 * 
 */

/**
 * STORED PROCEDURE : IcodesusGetImportedCodes
 * DESCRIPTION      : This SP gets all voucher codes imported from icodes uk.
 */

    -- Declare Variables 
    DECLARE done INT DEFAULT 0;             -- flag for no more records
    DECLARE mICID VARCHAR(100);             -- for icid    
    DECLARE mMerchantICID VARCHAR(100);     -- for merchant_icid
    DECLARE mTitle VARCHAR(255);            -- for voucher title
    DECLARE mDescription TEXT;              -- for voucher description
    DECLARE mMerchant VARCHAR(255);         -- for merchant
    DECLARE mMerchantLogoURL VARCHAR(1024); -- for merchant_logo_url
    DECLARE mNetwork VARCHAR(255);          -- for network
    DECLARE mVoucherCode VARCHAR(255);      -- for vouchercode
    DECLARE mExCode VARCHAR(255);           -- for excode
    DECLARE mStartDate DATETIME;            -- for start_date
    DECLARE mExpiryDate DATETIME;           -- for expiry_date
    DECLARE mAffiliateURL VARCHAR(1024);    -- for affiliate_url
    DECLARE mMerchantURL VARCHAR(1024);     -- for merchant_url
    
        
    -- Declaring cursor and Handler
    DECLARE Codes CURSOR FOR 
    SELECT  icid, merchant_icid, title, description, merchant, 
            merchant_logo_url, network, vouchercode, excode, 
            start_date, expiry_date, affiliate_url, merchant_url
            FROM icodesus_codes
            WHERE processed = 0;
    
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;

    -- following procedure creates a temporary table 
    -- of default site ids for this plugin 
    call splitString(mSites);
    
    OPEN Codes;
    
    Codes_Loop: LOOP
    
        Fetch Codes INTO 
            
            mICID, mMerchantICID, mTitle, mDescription, mMerchant, mMerchantLogoURL, 
            mNetwork, mVoucherCode, mExCode, mStartDate, mExpiryDate, mAffiliateURL, 
            mMerchantURL;
            
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
                    WHERE icodesus_merchant_id = mMerchantICID) > 0 THEN
                            
            -- IF Merchant Exist we will proceed further.
            IF
                (SELECT Count(*) FROM cods 
                        WHERE   source = 'IcodesUS' 
                                AND cod_type = 'voucher' 
                                AND icodesus_id = mICID) = 0 THEN
            
            
                -- IF Voucher does not exist Then INSERT
                
                INSERT INTO cods
                                
                                (merchant_id, cod_type, source, icodesus_id, title, safe_title, description, vouchercode, 
                                start_date, expiry_date, merchant_logo_url, network, excode, affiliate_url, 
                                merchant_url, created, modified)
                                
                                VALUES
                                
                                ((SELECT id FROM merchants WHERE icodesus_merchant_id = mMerchantICID),
                                'voucher', 'IcodesUS', mICID, mTitle, (SELECT createSafeTitle(mTitle)),mDescription, mVoucherCode, mStartDate, 
                                mExpiryDate, mMerchantLogoURL, mNetwork,  mExCode,  mAffiliateURL, mMerchantURL, 
                                now(), now());
            
                /* Here we have to create relation between site and newly added category */         
                IF (SELECT Count(*) FROM temp) > 0 THEN
                            
                        INSERT INTO cods_sites (site_id, cod_id) 
                                        SELECT site_id, (SELECT id FROM cods WHERE icodesus_id = mICID)  
                                        FROM temp;
                END IF;
                /* END */
            
            ELSEIF 
                (SELECT Count(*) FROM cods 
                        WHERE   source = 'IcodesUS' 
                                AND cod_type = 'voucher' 
                                AND icodesus_id = mICID) > 0 THEN
            
                -- IF Voucher exists Then UPDATE 
                UPDATE cods SET
                
                                title = mTitle, 
                                description = mDescription, 
                                merchant_logo_url = mMerchantLogoURL, 
                                network = mNetwork, 
                                vouchercode = mVoucherCode, 
                                excode = mExCode, 
                                start_date = mStartDate, 
                                expiry_date = mExpiryDate, 
                                affiliate_url = mAffiliateURL, 
                                merchant_url = mMerchantURL, 
                                modified = now()
                                
                                WHERE icodesus_id = mICID AND source = 'IcodesUS' AND cod_type = 'voucher';
            END IF;
            
            UPDATE icodesus_codes
                SET processed = 1
                    WHERE icid = mICID AND processed = 0;
        
        END IF;-- END IF Merchant Check
        
    END LOOP;
    CLOSE Codes;
END



$$

$$
DELIMITER ;


-- -----------------------------------------------------
-- procedure IcodesusGetImportedOffers
-- -----------------------------------------------------
DELIMITER $$
CREATE PROCEDURE `IcodesusGetImportedOffers`(mSites VARCHAR(255))
BEGIN

/**
 * The DVS License (http://www.voucherscript.com/license.html)
 * Denovo Voucher Script (DVS): The Instant Voucher Site (http://www.voucherscript.com)
 * Copyright 2009-2011, Computed Synergy (http://www.computedsynergy.com)
 *
 * Permission is hereby granted to:
 *
 * 1] Use this software free of charge for both personal and commercial purposes.
 * 2] Modify the script to customize it as needed.
 *
 *
 * Provided you agree to the following terms:
 *
 * 1] You may NOT redistribute, repost, resell any part of this script, or works deriving
 *    from this script, or works that enahance or add more features to this script. Redistribution
 *    is defined as re-offering our script for download/distribution in any manner, anywhere.
 * 2] You will not remove or modify any copyright notice and/or credits without written permission
 *    except where allowed (such as the "Powered by DVS" at the bottom of all pages, except the backoffice pages).
 * 3] You will not use this software for illegal purposes.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
 * FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER
 * DEALINGS IN THE SOFTWARE.
 * 
 */

/**
 *  STORED PROCEDURE : IcodesusGetImportedOffers
 *  DESCRIPTION      : This SP gets all voucher codes imported from icodes uk.
 */

    -- Declare Variables 
    DECLARE done INT DEFAULT 0;             -- flag for no more records
    DECLARE mICID VARCHAR(100);             -- for icid    
    DECLARE mMerchantICID VARCHAR(100);     -- for merchant_icid
    DECLARE mTitle VARCHAR(255);            -- for voucher title
    DECLARE mDescription TEXT;              -- for voucher description
    DECLARE mMerchant VARCHAR(255);         -- for merchant
    DECLARE mMerchantLogoURL VARCHAR(1024); -- for merchant_logo_url
    DECLARE mNetwork VARCHAR(255);          -- for network
    DECLARE mStartDate DATETIME;            -- for start_date
    DECLARE mExpiryDate DATETIME;           -- for expiry_date
    DECLARE mAffiliateURL VARCHAR(1024);    -- for affiliate_url
    DECLARE mMerchantURL VARCHAR(1024);     -- for merchant_url
    
        
    -- Declaring cursor and Handler
    DECLARE Offers CURSOR FOR 
    SELECT  icid, merchant_icid, title, description, merchant, merchant_logo_url, 
            network, start_date, expiry_date, affiliate_url, merchant_url
            FROM icodesus_offers
            WHERE processed = 0;
    
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;

    -- following procedure creates a temporary table 
    -- of default site ids for this plugin 
    call splitString(mSites);

    
    OPEN Offers;
    
    Offers_Loop: LOOP
    
        Fetch Offers INTO 
            
            mICID, mMerchantICID, mTitle, mDescription, mMerchant, mMerchantLogoURL, 
            mNetwork, mStartDate, mExpiryDate, mAffiliateURL, mMerchantURL;
            
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
                    WHERE icodesus_merchant_id = mMerchantICID) > 0 THEN
                            
            -- IF Merchant Exist we will proceed further.
                            
            IF
                (SELECT Count(*) FROM cods 
                        WHERE   source = 'IcodesUS' 
                                AND cod_type = 'offer' 
                                AND icodesus_id = mICID) = 0 THEN
            
            
                -- IF Voucher does not exist Then INSERT
                INSERT INTO cods
                        (merchant_id, cod_type, source, icodesus_id, title, safe_title, description,  start_date, 
                        expiry_date, merchant_logo_url, network, affiliate_url, merchant_url, created, modified)
                        VALUES
                        ((SELECT id FROM merchants WHERE icodesus_merchant_id = mMerchantICID), 'offer', 'IcodesUS', 
                        mICID, mTitle, (SELECT createSafeTitle(mTitle)),mDescription, mStartDate, mExpiryDate, mMerchantLogoURL, mNetwork,  mAffiliateURL, 
                        mMerchantURL, now(), now());
            
                /* Here we have to create relation between site and newly added category */         
                IF (SELECT Count(*) FROM temp) > 0 THEN
                            
                        INSERT INTO cods_sites (site_id, cod_id) 
                                        SELECT site_id, (SELECT id FROM cods WHERE icodesus_id = mICID)  
                                        FROM temp;
                END IF;
                /* END */
            
            ELSEIF 
                
                (SELECT Count(*) FROM cods 
                        WHERE   source = 'IcodesUS' 
                                AND cod_type = 'offer' 
                                AND icodesus_id = mICID) > 0 THEN
            
                -- IF Voucher exists Then UPDATE 
                UPDATE cods SET
                
                                title = mTitle, 
                                description = mDescription, 
                                merchant_logo_url = mMerchantLogoURL, 
                                network = mNetwork, 
                                start_date = mStartDate, 
                                expiry_date = mExpiryDate, 
                                affiliate_url = mAffiliateURL, 
                                merchant_url = mMerchantURL, 
                                modified = now()
                                WHERE icodesus_id = mICID AND source = 'IcodesUS' AND cod_type = 'offer';
            END IF;
        
            UPDATE icodesus_offers
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
('configurable','d850a42c-0422-4190-9211-9a74ebfd1233', 'dvs4icodesus', 'username', 'csynergy'),
('configurable','d850a42c-0422-4190-9211-9a74ebfd1233', 'dvs4icodesus', 'subscriptionid', '0d7de1aca9299fe63f3e0041f02638a3'),
('configurable','d850a42c-0422-4190-9211-9a74ebfd1233', 'dvs4icodesus', 'merchants_import_char', 'eof'),
('configurable','d850a42c-0422-4190-9211-9a74ebfd1233', 'dvs4icodesus', 'merchants_import_page', 'eof'),
('configurable','d850a42c-0422-4190-9211-9a74ebfd1233', 'dvs4icodesus', 'codes_import_page', 'eof'),
('configurable','d850a42c-0422-4190-9211-9a74ebfd1233', 'dvs4icodesus', 'offers_import_page', 'eof'),
('configurable','d850a42c-0422-4190-9211-9a74ebfd1233', 'dvs4icodesus', 'category_import', 'no'),
('configurable','d850a42c-0422-4190-9211-9a74ebfd1233', 'dvs4icodesus', 'default-sites', ''),
('configurable','d850a42c-0422-4190-9211-9a74ebfd1233', 'dvs4icodesus', 'last_run_time', '1970-01-01 00:00:00'),
('configurable','d850a42c-0422-4190-9211-9a74ebfd1233', 'dvs4icodesus', 'second_level_import', 'no');