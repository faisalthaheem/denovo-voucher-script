SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';


-- -----------------------------------------------------
-- Table `affilinet_categories`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `affilinet_categories` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `affilinetcategory_id` VARCHAR(100) NULL ,
  `category_title` VARCHAR(255) NULL ,
  `parent_category_id` VARCHAR(100) NULL ,
  `category_path` VARCHAR(255) NULL ,
  `processed` TINYINT NULL DEFAULT 0 ,
  `created` DATETIME NULL ,
  `modified` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `affilinet_category_id_index` (`affilinetcategory_id` ASC) ,
  INDEX `processed_index` (`processed` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `affilinet_shops_dumps`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `affilinet_shops_dumps` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `shop_id` VARCHAR(100) NULL ,
  `program_id` VARCHAR(100) NULL ,
  `title` VARCHAR(255) NULL ,
  `last_update` DATETIME NULL ,
  `logo_url` VARCHAR(1024) NULL ,
  `products` VARCHAR(45) NULL ,
  `shop_processed` TINYINT NULL DEFAULT 0 ,
  `program_processed` TINYINT NULL DEFAULT 0 ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `affilinet_shops`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `affilinet_shops` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `shopid` VARCHAR(100) NULL ,
  `shoptitle` VARCHAR(255) NULL ,
  `programid` VARCHAR(100) NULL ,
  `lastupdate` DATETIME NULL ,
  `logo` VARCHAR(1024) NULL ,
  `processed` TINYINT NULL DEFAULT 0 ,
  `created` DATETIME NULL ,
  `modified` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `shop_id_index` (`shopid` ASC) ,
  INDEX `processed_index` (`processed` ASC) ,
  INDEX `program_id` (`programid` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `affilinet_codes_dumps`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `affilinet_codes_dumps` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `vouchercode_id` VARCHAR(100) NULL ,
  `program_id` VARCHAR(100) NULL ,
  `code` VARCHAR(255) NULL ,
  `description` VARCHAR(1024) NULL ,
  `start_date` DATETIME NULL ,
  `end_date` DATETIME NULL ,
  `active_partnership` TINYINT NULL DEFAULT '0' ,
  `integration_code` VARCHAR(1024) NULL ,
  `is_restricted` TINYINT NULL DEFAULT '0' ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `affilinet_codes`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `affilinet_codes` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `voucherid` VARCHAR(100) NULL ,
  `programid` VARCHAR(100) NULL ,
  `vouchercode` VARCHAR(255) NULL ,
  `description` VARCHAR(1024) NULL ,
  `startdate` DATETIME NULL ,
  `expiredate` DATETIME NULL ,
  `integrationcode` VARCHAR(1024) NULL ,
  `processed` TINYINT NULL DEFAULT 0 ,
  `created` DATETIME NULL ,
  `modified` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `voucher_id_index` (`voucherid` ASC) ,
  INDEX `program_id` (`programid` ASC) ,
  INDEX `processed_index` (`processed` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `affilinet_categories_shops_dumps`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `affilinet_categories_shops_dumps` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `shop_id` VARCHAR(100) NULL ,
  `affilinetcategory_id` VARCHAR(100) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `affilinet_categories_dumps`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `affilinet_categories_dumps` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `affilinet_category_id` VARCHAR(100) NULL ,
  `category_title` VARCHAR(255) NULL ,
  `parent_id` VARCHAR(100) NULL ,
  `category_path` VARCHAR(255) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `affilinet_categories_shops`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `affilinet_categories_shops` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `shop_id` VARCHAR(100) NULL ,
  `affilinet_category_id` VARCHAR(100) NULL ,
  `processed` TINYINT NULL DEFAULT 0 ,
  PRIMARY KEY (`id`) ,
  INDEX `shop_id_index` (`shop_id` ASC) ,
  INDEX `category_id_index` (`affilinet_category_id` ASC) ,
  INDEX `processed_index` (`processed` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- procedure AffilinetCategoryShopRelationFromDump
-- -----------------------------------------------------
DELIMITER $$
CREATE PROCEDURE `AffilinetCategoryShopRelationFromDump`()

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
 *
 * STORED PROCEDURE : AffilinetCategoryShopRelationFromDump
 * DESCRIPTION      : This SP Copies category and merchant relation from dump to middle dump.
 *
 */

    -- Declare Variables

    DECLARE done INT DEFAULT 0;         -- flag for no more records
    DECLARE mShopId VARCHAR(100);       -- for shop id    
    DECLARE mCategoryId VARCHAR(100);   -- for category id

    
    -- Declaring cursor and Handler
    DECLARE CategoryShopDump CURSOR FOR
    
        SELECT  shop_id, affilinetcategory_id  
                FROM affilinet_categories_shops_dumps;
    
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;

    OPEN CategoryShopDump;
    
    cmLoop: LOOP
    
        FETCH CategoryShopDump INTO mShopId, mCategoryId;
        
        IF done THEN
            LEAVE cmLoop;
        END IF;


        -- Check if Relation does not exist
        -- Create it
        
        IF (SELECT Count(*) FROM affilinet_categories_shops WHERE shop_id = mShopId AND affilinet_category_id = mCategoryId) = 0 THEN

            INSERT INTO affilinet_categories_shops       
                
                (shop_id, affilinet_category_id, processed)
                
                VALUES
                
                (mShopId, mCategoryId, 0);
            
        END IF;
    
    END LOOP;

    CLOSE CategoryShopDump;

END






$$

$$
DELIMITER ;


-- -----------------------------------------------------
-- procedure AffilinetCopyCategoriesFromDump
-- -----------------------------------------------------
DELIMITER $$
CREATE PROCEDURE `AffilinetCopyCategoriesFromDump`()

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
 *  STORED PROCEDURE : AffilinetCopyCategoriesFromDump
 *  DESCRIPTION      : This SP inserts and Updates categories from categories dump table.
 */
    
    
    DECLARE done INT DEFAULT 0;     -- flag for no more records
    DECLARE cat_name VARCHAR(255);  -- for category name    
    DECLARE cat_id VARCHAR(100);    -- category id
    DECLARE mCount INT;             -- used in loop
    
    -- Declaring cursor and Handler
    DECLARE catDump CURSOR FOR 
        SELECT  affilinet_category_id, category_title
                FROM affilinet_categories_dumps;
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
        
        
        SET mCount = (SELECT COUNT(*) FROM affilinet_categories WHERE affilinetcategory_id = cat_id AND processed = 0); 
        
        IF mCount > 0 THEN
        
            /* UPDATE if Category already exists */
            UPDATE affilinet_categories SET category_title = cat_name WHERE affilinetcategory_id = cat_id AND processed = 0;
        
        
        ELSEIF mCount = 0 THEN
        
            /* INSERT category if does not exits */
            INSERT INTO affilinet_categories
                    
                (category_title, affilinetcategory_id, processed, created, modified)
                
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
-- procedure AffilinetCopyCodesFromDump
-- -----------------------------------------------------
DELIMITER $$
CREATE PROCEDURE `AffilinetCopyCodesFromDump`()

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
 *        STORED PROCEDURE : AffilinetCopyCodesFromDump
 *        DESCRIPTION      : This SP inserts and Updates all Voucher Codes of affilinet from codes dump table to middle dump table.
 */

    -- Declare Variables 
    DECLARE done INT DEFAULT 0;             -- flag for no more records
    DECLARE mVoucherId VARCHAR(100);        -- for vouchercode_id
    DECLARE mProgramId VARCHAR(100);        -- for program_id
    DECLARE mCode VARCHAR(255);             -- for voucher code
    DECLARE mDescription TEXT;              -- for voucher description
    DECLARE mStartDate DATETIME;            -- for start_date
    DECLARE mEndDate DATETIME;              -- for end_date
    DECLARE mActivePartnership TINYINT;     -- for active_partnership
    DECLARE mIntegrationCode VARCHAR(1024); -- for integration_code
    DECLARE mIsRestricted TINYINT;          -- for is restricted
    DECLARE mCount INT;                     -- used in loop
        
    -- Declaring cursor and Handler
    DECLARE CodesDump CURSOR FOR 
    SELECT  vouchercode_id, program_id, code, description, start_date,
            end_date, active_partnership, integration_code, is_restricted
            FROM affilinet_codes_dumps;
    
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;

    
    OPEN CodesDump;
    
    Codes_Loop: LOOP
    
        Fetch CodesDump INTO 
            
            mVoucherId, mProgramId, mCode, mDescription, mStartDate, mEndDate,
            mActivePartnership, mIntegrationCode, mIsRestricted;
            
        IF done THEN
            Leave Codes_Loop;
        END IF;
        
        
        -- Check if Voucher exists
        --      UPDATE Voucher Details
        -- ELSE 
        --      INSERT Voucher Details
        
        SET mCount = (SELECT Count(*) FROM affilinet_codes WHERE voucherid = mVoucherId AND processed = 0);
        
        IF mCount = 0 THEN
        
            INSERT INTO affilinet_codes 
                            
                            (voucherid, programid, vouchercode, description, startdate, expiredate, 
                            integrationcode, processed, created, modified)
                            
                            VALUES
                            
                            (mVoucherId, mProgramId, mCode, mDescription, mStartDate, mEndDate,
                            mIntegrationCode, 0, now(), now());
        
        ELSEIF mCount > 0 THEN
        
            UPDATE affilinet_codes 
            
                    SET
                        vouchercode = mCode, 
                        description = mDescription, 
                        startdate = mStartDate, 
                        expiredate = mEndDate, 
                        integrationcode = mIntegrationCode
                        
                    WHERE voucherid = mVoucherId AND processed = 0;
        END IF;
    
    END LOOP;
    
    CLOSE CodesDump;
END

$$

$$
DELIMITER ;


-- -----------------------------------------------------
-- procedure AffilinetCopyShopsFromDump
-- -----------------------------------------------------
DELIMITER $$
CREATE PROCEDURE `AffilinetCopyShopsFromDump`()

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
 *  STORED PROCEDURE : AffilinetCopyShopsFromDump
 *  DESCRIPTION      : This SP copies all merchants from dump table.
 */

    -- Declare Variables
    DECLARE done INT DEFAULT 0;                 -- flag for no more records
    DECLARE mShopId VARCHAR(100);               -- for merchant_icid
    DECLARE mProgramId VARCHAR(100);            -- for program id
    DECLARE mShopTitle VARCHAR(255);            -- for shop title
    DECLARE mLastUpdate DATETIME;               -- for last updated
    DECLARE mLogoURL VARCHAR(1024);             -- for logo url
    DECLARE mCount INT;                         -- used in loop
    -- Declare Cursor and Handler
    DECLARE MerchantDump CURSOR FOR 
        SELECT  shop_id, program_id, title, last_update, logo_url 
                FROM affilinet_shops_dumps;
    
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;

    
    OPEN MerchantDump;

    Merchant_Records: LOOP
    
        FETCH MerchantDump INTO 
            mShopId, mProgramId, mShopTitle, 
            mLastUpdate, mLogoURL;  
    
        IF done THEN
            Leave Merchant_Records;
        END IF;
        
        -- Check if Merchant Exists
        --      Update merchant details
        -- ELSE 
        --      Insert Merchant
        SET mCount = (SELECT Count(*) FROM affilinet_shops WHERE shopid = mShopId AND processed = 0);
        IF mCount = 0 THEN
        
            INSERT INTO affilinet_shops
                    
                    (shopid, shoptitle, programid, lastupdate, logo, processed, created, modified)
                    
                    VALUES
                    
                    (mShopId, mShopTitle, mProgramId, mLastUpdate, mLogoURL, 0, now(), now());
    
    
        ELSEIF mCount > 0 THEN
        
            UPDATE affilinet_shops SET
                
                shoptitle = mShopTitle, 
                lastupdate = mLastUpdate,
                logo = mLogoURL
                
                WHERE shopid = mShopId AND processed = 0;
        
        END IF;
    
    END LOOP;

END
$$

$$
DELIMITER ;


-- -----------------------------------------------------
-- procedure AffilinetGetCategories
-- -----------------------------------------------------
DELIMITER $$
CREATE PROCEDURE `AffilinetGetCategories`(mSites VARCHAR(255))
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
 *        STORED PROCEDURE : AffilinetGetCategories
 *        DESCRIPTION      : This SP inserts and Updates categories from categories middle dump table.
 */
    
    
    DECLARE done INT DEFAULT 0;     -- flag for no more records
    DECLARE mCatName VARCHAR(255);  -- for category name    
    DECLARE mCatId VARCHAR(100);    -- category id
    DECLARE mExistingCatId INT;     -- used for existing category id
    DECLARE mAutoUpdate BOOLEAN;    -- used for existing category autoupdate flag
    
    -- Declaring cursor and Handler
    DECLARE category CURSOR FOR 
        SELECT  affilinetcategory_id, category_title
                FROM affilinet_categories WHERE processed = 0;
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;

    -- following procedure creates a temporary table 
    -- of default site ids for this plugin 
    call splitString(mSites);
    
    OPEN category;

    cat_loop: LOOP
        
        FETCH category INTO mCatId, mCatName;
        
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
                        affili_category_id = mCatId
                        WHERE id = mExistingCatId;
                
            ELSEIF mAutoUpdate = FALSE THEN
            
                -- Update category network id only
                UPDATE  categories SET
                        affili_category_id = mCatId
                        WHERE id = mExistingCatId;
            
            END IF;
        
        ELSE
            
            -- Category name not found, check for network id of the category
            IF (SELECT Count(*) FROM categories WHERE affili_category_id = mCatId) > 0 THEN
                
                IF (SELECT autoupdate FROM categories WHERE affili_category_id = mCatId) = TRUE THEN
                
                    UPDATE  categories SET 
                            catname = mCatName
                            WHERE affili_category_id = mCatId;
                END IF;
                
            ELSE
                
                INSERT INTO categories
                        (catname, safe_catname, affili_category_id, source, parent_id, created, modified)
                        VALUES
                        (mCatName, (SELECT createSafeTitle(mCatName)), mCatId, 'Affilinet', 0, now(), now());
                
                /* Here we have to create relation between site and newly added category */
                    
                IF (SELECT Count(*) FROM temp) > 0 THEN
                    
                    INSERT INTO categories_sites (site_id, category_id) 
                                    SELECT site_id, (SELECT id FROM categories WHERE affili_category_id = mCatId)  
                                    FROM temp;
                /* END */
                    
                END IF;
                
            END IF;
            
        END IF;
        
        UPDATE affilinet_categories 
            SET processed = 1 
            WHERE affilinetcategory_id = mCatId AND processed = 0;
        
    END LOOP;

    CLOSE category;
    
END
$$

$$
DELIMITER ;


-- -----------------------------------------------------
-- procedure AffilinetGetCategoryShopRelation
-- -----------------------------------------------------
DELIMITER $$
CREATE PROCEDURE `AffilinetGetCategoryShopRelation`()
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
 *       STORED PROCEDURE : AffilinetGetCategoryShopRelation
 *       DESCRIPTION      : This SP creates relation between category and merchant via imported joins from Affilinet.
 */

    -- Declare Variables

    DECLARE done INT DEFAULT 0;         -- flag for no more records
    DECLARE mMerchantId VARCHAR(100);   -- for merchant_icid    
    DECLARE mCategoryId VARCHAR(100);   -- for category_id
    
    DECLARE mCatId INT;                 -- category primery key
    DECLARE mMergedId INT;              -- merged in category id
    DECLARE mMerchantIdPK INT;            -- Merchant primery key
    
    -- Declaring cursor and Handler
    DECLARE CategoryMerchant CURSOR FOR 
        SELECT  shop_id, affilinet_category_id  
                FROM affilinet_categories_shops
                WHERE processed = 0;
                
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;

    OPEN CategoryMerchant;
    
    cmLoop: LOOP
    
        FETCH CategoryMerchant INTO mMerchantId, mCategoryId;
        
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
        --      Create relation
        --  END IF;
        
        -- check for merchant category
        IF  (SELECT Count(*) FROM categories WHERE affili_category_id = mCategoryId) > 0 
            AND 
            (SELECT Count(*) FROM merchants WHERE affili_shop_id = mMerchantId) > 0 THEN
        
            SELECT id INTO mMerchantIdPK FROM merchants WHERE affili_shop_id = mMerchantId; -- get mechant id
            SELECT id, merged_in INTO mCatId, mMergedId FROM categories WHERE affili_category_id = mCategoryId; -- get category id
                    
            IF mMergedId <> 0 THEN
                SET mCatId = mMergedId;
            END IF;
             
            IF (SELECT Count(*) FROM categories_merchants WHERE category_id = mCatId AND merchant_id = mMerchantIdPK) = 0 THEN
                INSERT INTO categories_merchants
                    (category_id, merchant_id) VALUES (mCatId, mMerchantIdPK);
            END IF;
            
        END IF;
        
        UPDATE affilinet_categories_shops SET processed = 1 WHERE shop_id = mMerchantId AND affilinet_category_id = mCategoryId;
        
    
    END LOOP;
    
    CLOSE CategoryMerchant;
END
$$

$$
DELIMITER ;


-- -----------------------------------------------------
-- procedure AffilinetGetImportedCodes
-- -----------------------------------------------------
DELIMITER $$
CREATE PROCEDURE `AffilinetGetImportedCodes`(mSites VARCHAR(255))
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
 *       STORED PROCEDURE : AffilinetGetImportedCodes
 *       DESCRIPTION      : This SP gets all voucher codes imported from affilinet.
 */

    -- Declare Variables 
    DECLARE done INT DEFAULT 0;             -- flag for no more records
    DECLARE mVoucherId VARCHAR(100);        -- for voucherid
    DECLARE mProgramId VARCHAR(100);        -- for programid
    DECLARE mVoucherCode VARCHAR(255);      -- for voucher code
    DECLARE mDescription TEXT;              -- for voucher description
    DECLARE mStartDate DATETIME;            -- for start_date
    DECLARE mExpiryDate DATETIME;           -- for expiry_date
    DECLARE mIntegrationCode VARCHAR(1024);  -- for integrationcode
    
        
    -- Declaring cursor and Handler
    DECLARE Codes CURSOR FOR 
    SELECT  voucherid, programid, vouchercode, description,
            startdate, expiredate, integrationcode 
            FROM affilinet_codes
            WHERE processed = 0;
    
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;

    -- following procedure creates a temporary table 
    -- of default site ids for this plugin 
    call splitString(mSites);

    
    OPEN Codes;
    
    Codes_Loop: LOOP
    
        Fetch Codes INTO 
            
            mVoucherId, mProgramId, mVoucherCode, mDescription, 
            mStartDate, mExpiryDate, mIntegrationCode;
            
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
                    WHERE programid = mProgramId) > 0 THEN
                            
            -- IF Merchant Exist we will proceed further.
                            
            IF
                (SELECT Count(*) FROM cods 
                        WHERE   source = 'Affilinet' 
                                AND cod_type = 'voucher' 
                                AND affili_voucher_id = mVoucherId) = 0 THEN
            
            
                -- IF Voucher does not exist Then INSERT
                INSERT INTO cods
                                
                                (merchant_id, cod_type, source, affili_voucher_id, programid, title, safe_title, description, vouchercode, 
                                start_date, expiry_date, integrationcode, created, modified)
                                
                                VALUES
                                
                                ((SELECT id FROM merchants WHERE programid = mProgramId),
                                'voucher', 'Affilinet', mVoucherId, mProgramId, '', (SELECT createSafeTitle(mDescription)), mDescription, mVoucherCode, mStartDate, 
                                mExpiryDate, mIntegrationCode, now(), now());
            
            
                /* Here we have to create relation between site and newly added category */         
                IF (SELECT Count(*) FROM temp) > 0 THEN
                            
                        INSERT INTO cods_sites (site_id, cod_id) 
                                        SELECT site_id, (SELECT id FROM cods WHERE affili_voucher_id = mVoucherId)  
                                        FROM temp;
                END IF;
                /* END */
            
            ELSEIF 
                
                (SELECT Count(*) FROM cods 
                        WHERE   source = 'Affilinet' 
                                AND cod_type = 'voucher' 
                                AND affili_voucher_id = mVoucherId) > 0 THEN
            
                -- IF Voucher exists Then UPDATE 
                UPDATE cods SET
                
                                title = "", 
                                description = mDescription, 
                                programid = mProgramId,
                                vouchercode = mVoucherCode, 
                                start_date = mStartDate, 
                                expiry_date = mExpiryDate, 
                                integrationcode = mIntegrationCode,
                                modified = now()
                                WHERE   affili_voucher_id = mVoucherId 
                                        AND source = 'Affilinet' 
                                        AND cod_type = 'voucher';
            END IF;
        
            
            UPDATE affilinet_codes
                
                SET processed = 1
                    WHERE voucherid = mVoucherId AND processed = 0;
                    
    END IF; -- END IF Merchant Check
    
    END LOOP;
    
    CLOSE Codes;
END





$$

$$
DELIMITER ;


-- -----------------------------------------------------
-- procedure AffilinetGetImportedShops
-- -----------------------------------------------------
DELIMITER $$
CREATE PROCEDURE `AffilinetGetImportedShops`(mSites VARCHAR(255))
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
 *   STORED PROCEDURE : AffilinetGetImportedShops
 *   DESCRIPTION      : This SP copies all merchants from middle dump table.
 */

    -- Declare Variables
    DECLARE done INT DEFAULT 0;                 -- flag for no more records
    DECLARE mShopId VARCHAR(100);               -- for merchant_icid
    DECLARE mProgramId VARCHAR(100);            -- for program id
    DECLARE mShopTitle VARCHAR(255);            -- for shop title
    DECLARE mLastUpdate DATETIME;               -- for last updated
    DECLARE mLogoURL VARCHAR(1024);             -- for logo url
    
    DECLARE mMerchantId INT;                    -- Merchant primery key

    -- Declare Cursor and Handler
    DECLARE Merchants CURSOR FOR 
        SELECT  shopid, programid, shoptitle, lastupdate, logo 
                FROM affilinet_shops
                WHERE processed = 0;
    
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;

    -- following procedure creates a temporary table 
    -- of default site ids for this plugin 
    call splitString(mSites);
    
    OPEN Merchants;

    Merchant_Records: LOOP
    
        FETCH Merchants INTO 
            mShopId, mProgramId, mShopTitle, 
            mLastUpdate, mLogoURL;  
    
        IF done THEN
            Leave Merchant_Records;
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

        IF (SELECT Count(*) FROM merchants WHERE merchant_name = mShopTitle) > 0 THEN
        
            -- merchant name found
            IF (SELECT Count(*) FROM merchants WHERE merchant_name = mShopTitle AND autoupdate = 1) THEN
                                
                UPDATE merchants SET
                    affili_shop_id = mShopId, 
                    logo_url = mLogoURL,
                    lastupdate = mLastUpdate,
                    modified = now()
                    WHERE merchant_name = mShopTitle;
            ELSE
                
                UPDATE merchants SET
                    affili_shop_id = mShopId 
                    WHERE merchant_name = mShopTitle;
            END IF;
        
        ELSE 
        
            -- merchant name not found check for aodbId
            IF (SELECT Count(*) FROM merchants WHERE affili_shop_id = mShopId) > 0 THEN
                
                -- merchant id found
                IF (SELECT Count(*) FROM merchants WHERE affili_shop_id = mShopId AND autoupdate = 1) THEN
                    
                    UPDATE merchants SET
                        merchant_name = mShopTitle, 
                        logo_url = mLogoURL,
                        lastupdate = mLastUpdate,
                        modified = now()
                        WHERE affili_shop_id = mShopId;
                
                END IF;
            
            ELSE
                
                -- id not found now insert merchant
                INSERT INTO merchants
                    (source, merchant_name, safe_merchant_name, programid, affili_shop_id, logo_url, lastupdate, created, modified)
                    VALUES
                    ('Affilinet', mShopTitle, (SELECT createSafeTitle(mShopTitle)), mProgramId, mShopId, mLogoURL, mLastUpdate, now(), now());
                
                SELECT id INTO mMerchantId FROM merchants WHERE affili_shop_id = mShopId;
                
                /* Here we have to create relation between sites and newly added merchant*/
                IF (SELECT Count(*) FROM temp) > 0 THEN
                        INSERT INTO merchants_sites (site_id, merchant_id) 
                                    SELECT site_id, mMerchantId FROM temp;
                END IF;
                /* END */
            
            END IF;
            
        END IF;
        
        UPDATE affilinet_shops 
            SET processed = 1
            WHERE shopid = mShopId AND processed = 0;
    
    END LOOP;
    
    CLOSE Merchants;
END
$$

$$
DELIMITER ;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

/* Affilinet Plugin Default Inserts */
INSERT INTO `pluginsconfigurations` (plugintype,pluginid,pluginname,datakey,dataval) VALUES ('configurable','6a1aa6d1-e4c9-4b56-98d2-f0d64c37e3ba','dvs4affilinet','password','csynergy');
INSERT INTO `pluginsconfigurations` (plugintype,pluginid,pluginname,datakey,dataval) VALUES ('configurable','6a1aa6d1-e4c9-4b56-98d2-f0d64c37e3ba','dvs4affilinet','publisherid','403233');
INSERT INTO `pluginsconfigurations` (plugintype,pluginid,pluginname,datakey,dataval) VALUES ('configurable','6a1aa6d1-e4c9-4b56-98d2-f0d64c37e3ba','dvs4affilinet','userid','Users.1.2124');
INSERT INTO `pluginsconfigurations` (plugintype,pluginid,pluginname,datakey,dataval) VALUES ('configurable','6a1aa6d1-e4c9-4b56-98d2-f0d64c37e3ba','dvs4affilinet','isShopImportComplete','no');
INSERT INTO `pluginsconfigurations` (plugintype,pluginid,pluginname,datakey,dataval) VALUES ('configurable','6a1aa6d1-e4c9-4b56-98d2-f0d64c37e3ba','dvs4affilinet','isCategoryImportComplete','no');
INSERT INTO `pluginsconfigurations` (plugintype,pluginid,pluginname,datakey,dataval) VALUES ('configurable','6a1aa6d1-e4c9-4b56-98d2-f0d64c37e3ba','dvs4affilinet','isVoucherImportComplete','no');
INSERT INTO `pluginsconfigurations` (plugintype,pluginid,pluginname,datakey,dataval) VALUES ('configurable','6a1aa6d1-e4c9-4b56-98d2-f0d64c37e3ba','dvs4affilinet','default-sites','');
INSERT INTO `pluginsconfigurations` (plugintype,pluginid,pluginname,datakey,dataval) VALUES ('configurable','6a1aa6d1-e4c9-4b56-98d2-f0d64c37e3ba','dvs4affilinet','last_run_time','1970-05-27 17:00:30');
INSERT INTO `pluginsconfigurations` (plugintype,pluginid,pluginname,datakey,dataval) VALUES ('configurable','6a1aa6d1-e4c9-4b56-98d2-f0d64c37e3ba','dvs4affilinet','second_level_import','no');
