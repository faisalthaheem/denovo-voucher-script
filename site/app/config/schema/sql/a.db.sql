SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';


-- -----------------------------------------------------
-- Table `networks`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `networks` ;

CREATE  TABLE IF NOT EXISTS `networks` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) NOT NULL ,
  `report_row_format` VARCHAR(1024) NULL ,
  `url` VARCHAR(255) NULL ,
  `logo` VARCHAR(1024) NULL ,
  `status_confirmed` VARCHAR(255) NULL ,
  `status_pending` VARCHAR(255) NULL ,
  `status_declined` VARCHAR(255) NULL ,
  `lasrt_report_upload` DATETIME NULL ,
  `created` DATETIME NULL ,
  `modified` DATETIME NULL ,
  PRIMARY KEY (`id`) )
ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table `pluginsconfigurations`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pluginsconfigurations` ;

CREATE  TABLE IF NOT EXISTS `pluginsconfigurations` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `plugintype` VARCHAR(100) NOT NULL COMMENT 'there are only two type \'configurable\' and \'nonconfigurable\'' ,
  `pluginid` VARCHAR(36) NOT NULL ,
  `pluginname` VARCHAR(100) NOT NULL ,
  `datakey` VARCHAR(100) NOT NULL ,
  `dataval` VARCHAR(255) NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `plugintype_index` (`plugintype` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `syslogs`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `syslogs` ;

CREATE  TABLE IF NOT EXISTS `syslogs` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `srcid` VARCHAR(36) NOT NULL ,
  `srcname` VARCHAR(100) NOT NULL ,
  `logmsg` LONGTEXT NOT NULL ,
  `created` DATETIME NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `subscriptions`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `subscriptions` ;

CREATE  TABLE IF NOT EXISTS `subscriptions` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `email` VARCHAR(1024) NOT NULL ,
  `created` DATETIME NULL ,
  `modified` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `index_email` (`email` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sites`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sites` ;

CREATE  TABLE IF NOT EXISTS `sites` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `fqdn` VARCHAR(255) NOT NULL DEFAULT 'fully qualified domain name, www.site.com' ,
  `notes` TEXT NULL ,
  `active` VARCHAR(45) NULL ,
  `fbappid` VARCHAR(255) NULL ,
  `fbapikey` VARCHAR(1024) NULL ,
  `fbsecret` VARCHAR(1024) NULL ,
  `twitterusername` VARCHAR(255) NULL ,
  `twitterpassword` VARCHAR(255) NULL ,
  `fblikecode` TEXT NULL ,
  `fbpagename` VARCHAR(255) NULL ,
  `headerinserts` TEXT NULL ,
  `footerinserts` TEXT NULL ,
  `logopath` VARCHAR(1024) NULL ,
  `theme` VARCHAR(255) NULL ,
  `ctr` TINYINT NOT NULL DEFAULT '1' ,
  `emailnoreply` VARCHAR(255) NULL ,
  `emailinfo` VARCHAR(255) NULL ,
  `emailcontact` VARCHAR(255) NULL ,
  `created` DATETIME NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `categories`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `categories` ;

CREATE  TABLE IF NOT EXISTS `categories` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `parent_id` INT NOT NULL ,
  `catname` VARCHAR(255) NOT NULL ,
  `safe_catname` VARCHAR(255) NOT NULL ,
  `source` VARCHAR(100) NOT NULL ,
  `viewcount` INT NOT NULL DEFAULT 0 ,
  `icodesuk_category_id` VARCHAR(100) NULL ,
  `icodesus_category_id` VARCHAR(100) NULL DEFAULT NULL ,
  `affili_category_id` VARCHAR(100) NULL DEFAULT NULL ,
  `aodb_category_id` VARCHAR(100) NULL DEFAULT NULL ,
  `autoupdate` TINYINT(1) NOT NULL DEFAULT 1 COMMENT 'if 0, imports should not override the catname and other columns.' ,
  `merged_in` INT NOT NULL DEFAULT 0 ,
  `lastviewed` DATETIME NULL ,
  `metakw` TEXT NULL ,
  `metadesc` TEXT NULL ,
  `metatitle` TEXT NULL ,
  `created` DATETIME NULL DEFAULT NULL ,
  `modified` DATETIME NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `parent_id_index` (`parent_id` ASC) ,
  INDEX `catname_index` (`catname` ASC) ,
  INDEX `icodesus_id_index` (`icodesus_category_id` ASC) ,
  INDEX `affili_categoryid_index` (`affili_category_id` ASC) ,
  INDEX `aodb_categoryid_index` (`aodb_category_id` ASC) ,
  INDEX `source_index` (`source` ASC) ,
  UNIQUE INDEX `unique_safe_catname` (`safe_catname` ASC) ,
  INDEX `index_safe_catname` (`safe_catname` ASC) ,
  INDEX `icodesuk_id_index` (`icodesuk_category_id` ASC) ,
  INDEX `merged_index` (`merged_in` ASC) ,
  INDEX `autoupdate_index` (`autoupdate` ASC) ,
  INDEX `cat_index_lastviewed` (`lastviewed` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `categories_sites`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `categories_sites` ;

CREATE  TABLE IF NOT EXISTS `categories_sites` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `category_id` INT NOT NULL ,
  `site_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_categories_sites_sites` (`site_id` ASC) ,
  INDEX `fk_categories_sites_categories` (`category_id` ASC) ,
  UNIQUE INDEX `unq_entry` (`category_id` ASC, `site_id` ASC) ,
  CONSTRAINT `fk_categories_sites_sites1`
    FOREIGN KEY (`site_id` )
    REFERENCES `sites` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_categories_sites_categories1`
    FOREIGN KEY (`category_id` )
    REFERENCES `categories` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `merchants`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `merchants` ;

CREATE  TABLE IF NOT EXISTS `merchants` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `source` VARCHAR(100) NOT NULL ,
  `merchant_name` VARCHAR(255) NOT NULL ,
  `safe_merchant_name` VARCHAR(255) NOT NULL ,
  `icodesuk_merchant_id` VARCHAR(100) NULL DEFAULT NULL COMMENT 'icodes UK/US merchant id' ,
  `icodesus_merchant_id` VARCHAR(100) NULL DEFAULT NULL ,
  `programid` VARCHAR(100) NULL DEFAULT NULL ,
  `affili_shop_id` VARCHAR(100) NULL DEFAULT NULL COMMENT 'affilinet merchant id' ,
  `aodb_advertiser_id` VARCHAR(100) NULL DEFAULT NULL COMMENT 'AdilityOffersDB merchant id' ,
  `description` TEXT NULL DEFAULT NULL ,
  `logo_url` VARCHAR(1024) NULL DEFAULT NULL ,
  `site_url` VARCHAR(1024) NULL DEFAULT NULL ,
  `relationship` VARCHAR(255) NULL DEFAULT NULL ,
  `total_offers` VARCHAR(100) NULL DEFAULT NULL ,
  `affiliate_url` VARCHAR(1024) NULL DEFAULT NULL ,
  `lastupdate` DATETIME NULL DEFAULT NULL ,
  `contact_phone` VARCHAR(45) NULL DEFAULT NULL ,
  `likes` INT NOT NULL DEFAULT 0 ,
  `viewcount` INT NOT NULL DEFAULT 0 ,
  `autoupdate` TINYINT(1) NOT NULL DEFAULT 1 COMMENT 'if 0, imports must not update merchant_name and urls' ,
  `istop` TINYINT NOT NULL DEFAULT 0 ,
  `fbsharecount` INT NOT NULL DEFAULT 0 ,
  `tweetcount` INT NOT NULL DEFAULT 0 ,
  `lastviewed` DATETIME NULL ,
  `metakw` TEXT NULL ,
  `metadesc` TEXT NULL ,
  `metatitle` TEXT NULL ,
  `address1` TEXT NULL ,
  `address2` TEXT NULL ,
  `phone1` VARCHAR(45) NULL ,
  `phone2` VARCHAR(45) NULL ,
  `phone3` VARCHAR(45) NULL ,
  `cbtype` ENUM('fixed','percentage') NOT NULL ,
  `cbvalue` DECIMAL(10,2) NOT NULL DEFAULT 0.0 ,
  `created` DATETIME NULL DEFAULT NULL ,
  `modified` DATETIME NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `icodesuk_id_index` (`icodesuk_merchant_id` ASC) ,
  INDEX `shopid_index` (`affili_shop_id` ASC) ,
  INDEX `aodbid_index` (`aodb_advertiser_id` ASC) ,
  INDEX `merchantname_index` (`merchant_name` ASC) ,
  INDEX `source_index` (`source` ASC) ,
  UNIQUE INDEX `unique_safe_merchant_name` (`safe_merchant_name` ASC) ,
  INDEX `index_safe_merchant_name` (`safe_merchant_name` ASC) ,
  INDEX `icodesus_id_index` (`icodesus_merchant_id` ASC) ,
  INDEX `istop_index` (`istop` ASC) ,
  INDEX `merchant_index_lastviewed` (`lastviewed` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `categories_merchants`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `categories_merchants` ;

CREATE  TABLE IF NOT EXISTS `categories_merchants` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `category_id` INT NOT NULL ,
  `merchant_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_categories_merchants_merchants` (`merchant_id` ASC) ,
  INDEX `fk_categories_merchants_categories` (`category_id` ASC) ,
  CONSTRAINT `fk_categories_merchants_merchants1`
    FOREIGN KEY (`merchant_id` )
    REFERENCES `merchants` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_categories_merchants_categories1`
    FOREIGN KEY (`category_id` )
    REFERENCES `categories` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sites_subscriptions`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sites_subscriptions` ;

CREATE  TABLE IF NOT EXISTS `sites_subscriptions` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `site_id` INT NOT NULL ,
  `subscription_id` INT NOT NULL ,
  `subscribed` INT NOT NULL DEFAULT 1 ,
  `created` DATETIME NULL ,
  `optoutdate` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_sites_subscriptions_sites` (`site_id` ASC) ,
  INDEX `fk_sites_subscriptions_subscriptions` (`subscription_id` ASC) ,
  CONSTRAINT `fk_sites_subscriptions_sites1`
    FOREIGN KEY (`site_id` )
    REFERENCES `sites` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_sites_subscriptions_subscriptions1`
    FOREIGN KEY (`subscription_id` )
    REFERENCES `subscriptions` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `groups`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `groups` ;

CREATE  TABLE IF NOT EXISTS `groups` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `groupdesc` VARCHAR(45) NOT NULL ,
  `created` DATETIME NULL DEFAULT NULL ,
  `modified` DATETIME NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `users` ;

CREATE  TABLE IF NOT EXISTS `users` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `group_id` INT NOT NULL ,
  `fullname` VARCHAR(50) NOT NULL ,
  `email` VARCHAR(255) NOT NULL ,
  `pass` VARCHAR(255) NOT NULL ,
  `nationality` VARCHAR(45) NULL DEFAULT NULL ,
  `dob` DATE NULL DEFAULT NULL ,
  `gender` VARCHAR(45) NULL DEFAULT 'Male' ,
  `fax` VARCHAR(45) NULL DEFAULT NULL ,
  `address` VARCHAR(1024) NULL DEFAULT NULL ,
  `addressvisible` TINYINT(1) NOT NULL DEFAULT 0 ,
  `phone` VARCHAR(45) NULL DEFAULT NULL ,
  `phonevisible` TINYINT(1) NOT NULL DEFAULT 0 ,
  `webaddress` VARCHAR(1024) NULL DEFAULT NULL ,
  `webvisible` TINYINT(1) NOT NULL DEFAULT 0 ,
  `blogaddress` VARCHAR(1024) NULL DEFAULT NULL ,
  `blogvisible` TINYINT(1) NOT NULL DEFAULT 0 ,
  `facebookurl` VARCHAR(1024) NULL DEFAULT NULL ,
  `facebookvisible` TINYINT(1) NOT NULL DEFAULT 0 ,
  `myspaceurl` VARCHAR(1024) NULL DEFAULT NULL ,
  `myspacevisible` TINYINT(1) NOT NULL DEFAULT 0 ,
  `twitterurl` VARCHAR(1024) NULL DEFAULT NULL ,
  `twittervisible` TINYINT(1) NOT NULL DEFAULT 0 ,
  `orkuturl` VARCHAR(1024) NULL DEFAULT NULL ,
  `orkutvisible` TINYINT(1) NOT NULL DEFAULT 0 ,
  `profilemail` VARCHAR(255) NULL DEFAULT NULL ,
  `profilemailvisible` TINYINT(1) NOT NULL DEFAULT 0 ,
  `company` VARCHAR(255) NULL DEFAULT NULL ,
  `education` VARCHAR(512) NULL DEFAULT NULL ,
  `hobbies` VARCHAR(512) NULL DEFAULT NULL ,
  `languages` VARCHAR(512) NULL DEFAULT NULL ,
  `setupstatus` TINYINT(1) NOT NULL DEFAULT 0 ,
  `tokenhash` VARCHAR(120) NULL DEFAULT NULL ,
  `active` TINYINT(1) NOT NULL DEFAULT 0 ,
  `usertype` VARCHAR(45) NOT NULL DEFAULT 'user' COMMENT 'can be user, manager, admin' ,
  `fbid` BIGINT NULL DEFAULT 0 ,
  `fbpass` VARCHAR(255) NULL ,
  `lastloginip` VARCHAR(45) NULL DEFAULT NULL ,
  `lastlogintime` DATETIME NULL DEFAULT NULL ,
  `created` DATETIME NULL DEFAULT NULL ,
  `modified` DATETIME NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_users_groups` (`group_id` ASC) ,
  INDEX `index_email` (`email` ASC) ,
  INDEX `index_fullname` (`fullname` ASC) ,
  INDEX `index_fb_id` (`fbid` ASC) ,
  CONSTRAINT `fk_users_groups10`
    FOREIGN KEY (`group_id` )
    REFERENCES `groups` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `abuse_reports`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `abuse_reports` ;

CREATE  TABLE IF NOT EXISTS `abuse_reports` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `user_id` INT NOT NULL ,
  `reporter_id` INT NOT NULL ,
  `type` VARCHAR(45) NOT NULL COMMENT 'can be profile, picture etc' ,
  `data` VARCHAR(512) NULL DEFAULT NULL COMMENT 'can contain remarks, numbers etc\n' ,
  `status` INT NOT NULL DEFAULT 0 COMMENT '0 = unresolved, 1 = resolved' ,
  `created` DATETIME NULL DEFAULT NULL ,
  `modified` DATETIME NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_abuses_users` (`user_id` ASC) ,
  CONSTRAINT `fk_abuses_users10`
    FOREIGN KEY (`user_id` )
    REFERENCES `users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `conversations`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `conversations` ;

CREATE  TABLE IF NOT EXISTS `conversations` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `user_id` INT NOT NULL ,
  `sender_id` INT NOT NULL ,
  `subject` VARCHAR(512) NULL DEFAULT NULL ,
  `deleted` INT NOT NULL DEFAULT 0 ,
  `created` DATETIME NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_conversations_users` (`user_id` ASC) ,
  CONSTRAINT `fk_conversations_users10`
    FOREIGN KEY (`user_id` )
    REFERENCES `users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `messages`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `messages` ;

CREATE  TABLE IF NOT EXISTS `messages` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `conversation_id` INT NOT NULL ,
  `user_id` INT NOT NULL ,
  `messagebody` TEXT NULL DEFAULT NULL ,
  `deleted` TINYINT(1) NOT NULL DEFAULT 0 ,
  `created` DATETIME NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_messages_users` (`user_id` ASC) ,
  INDEX `fk_messages_conversations` (`conversation_id` ASC) ,
  CONSTRAINT `fk_messages_users10`
    FOREIGN KEY (`user_id` )
    REFERENCES `users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_messages_conversations10`
    FOREIGN KEY (`conversation_id` )
    REFERENCES `conversations` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `reviews`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `reviews` ;

CREATE  TABLE IF NOT EXISTS `reviews` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `user_id` INT NOT NULL ,
  `reviewed_id` INT NOT NULL ,
  `professional` TINYINT(1) NOT NULL DEFAULT 0 COMMENT 'copied from person reviewing' ,
  `rating` INT NOT NULL DEFAULT 0 ,
  `created` DATETIME NULL DEFAULT NULL ,
  `modified` DATETIME NULL DEFAULT NULL ,
  INDEX `fk_table1_users` (`user_id` ASC) ,
  PRIMARY KEY (`id`) ,
  CONSTRAINT `fk_table1_users10`
    FOREIGN KEY (`user_id` )
    REFERENCES `users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pictures`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pictures` ;

CREATE  TABLE IF NOT EXISTS `pictures` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `user_id` INT NOT NULL COMMENT 'who this picture belongs to.' ,
  `uuidtag` VARCHAR(255) NOT NULL ,
  `title` VARCHAR(255) NOT NULL ,
  `filename` VARCHAR(255) NOT NULL ,
  `pathtofile` VARCHAR(1024) NOT NULL ,
  `picindex` INT NOT NULL DEFAULT -1 COMMENT 'can range from 0 to 8 for artists and services providers. index 0 pictures are considered display pictures and appropriate thumbnails are generated for those.' ,
  `approved` TINYINT(1) NOT NULL DEFAULT 0 ,
  `processed` TINYINT(1) NOT NULL DEFAULT 0 ,
  `tag` VARCHAR(255) NULL COMMENT 'internal, used to differentiate between profile photos,display pictures, scripts etc.' ,
  `tag2` VARCHAR(255) NULL ,
  `deleted` TINYINT(1) NOT NULL DEFAULT 0 ,
  `created` DATETIME NULL DEFAULT NULL ,
  `modified` DATETIME NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_pictures_users` (`user_id` ASC) ,
  INDEX `index_uuidtag` (`uuidtag` ASC) ,
  CONSTRAINT `fk_pictures_users10`
    FOREIGN KEY (`user_id` )
    REFERENCES `users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `favorites`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `favorites` ;

CREATE  TABLE IF NOT EXISTS `favorites` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `user_id` INT NOT NULL ,
  `favorite_id` INT NOT NULL ,
  `deleted` TINYINT(1) NULL DEFAULT NULL ,
  `created` DATETIME NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_favorites_users` (`user_id` ASC) ,
  CONSTRAINT `fk_favorites_users10`
    FOREIGN KEY (`user_id` )
    REFERENCES `users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `shouts`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `shouts` ;

CREATE  TABLE IF NOT EXISTS `shouts` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `user_id` INT NOT NULL ,
  `shout` VARCHAR(512) NOT NULL ,
  `deleted` TINYINT NOT NULL DEFAULT 0 ,
  `created` DATETIME NULL DEFAULT NULL ,
  `modified` DATETIME NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_shouts_users` (`user_id` ASC) ,
  CONSTRAINT `fk_shouts_users10`
    FOREIGN KEY (`user_id` )
    REFERENCES `users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sites_users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sites_users` ;

CREATE  TABLE IF NOT EXISTS `sites_users` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `site_id` INT NOT NULL ,
  `user_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_sites_users_sites` (`site_id` ASC) ,
  INDEX `fk_sites_users_users` (`user_id` ASC) ,
  CONSTRAINT `fk_sites_users_sites1`
    FOREIGN KEY (`site_id` )
    REFERENCES `sites` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_sites_users_users1`
    FOREIGN KEY (`user_id` )
    REFERENCES `users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `merchants_sites`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `merchants_sites` ;

CREATE  TABLE IF NOT EXISTS `merchants_sites` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `merchant_id` INT NOT NULL ,
  `site_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_merchants_sites_sites` (`site_id` ASC) ,
  INDEX `fk_merchants_sites_merchants` (`merchant_id` ASC) ,
  UNIQUE INDEX `unq_entry` (`merchant_id` ASC, `site_id` ASC) ,
  CONSTRAINT `fk_merchants_sites_sites1`
    FOREIGN KEY (`site_id` )
    REFERENCES `sites` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_merchants_sites_merchants1`
    FOREIGN KEY (`merchant_id` )
    REFERENCES `merchants` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cods`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cods` ;

CREATE  TABLE IF NOT EXISTS `cods` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `merchant_id` INT NOT NULL ,
  `cod_type` VARCHAR(45) NOT NULL ,
  `source` VARCHAR(100) NOT NULL ,
  `icodesuk_id` VARCHAR(100) NULL ,
  `icodesus_id` VARCHAR(100) NULL DEFAULT NULL ,
  `aodb_id` VARCHAR(100) NULL DEFAULT NULL ,
  `affili_voucher_id` VARCHAR(100) NULL DEFAULT NULL ,
  `programid` VARCHAR(100) NULL DEFAULT NULL COMMENT 'common in affilinet and icodes' ,
  `title` VARCHAR(255) NULL DEFAULT NULL ,
  `safe_title` VARCHAR(512) NOT NULL ,
  `description` TEXT NULL DEFAULT NULL ,
  `vouchercode` VARCHAR(255) NULL DEFAULT NULL ,
  `start_date` DATETIME NULL DEFAULT NULL ,
  `expiry_date` DATETIME NULL DEFAULT NULL ,
  `relationship` VARCHAR(45) NULL DEFAULT NULL ,
  `merchant_logo_url` VARCHAR(1024) NULL DEFAULT NULL ,
  `network` VARCHAR(255) NULL DEFAULT NULL ,
  `excode` VARCHAR(255) NULL DEFAULT NULL ,
  `deep_link` VARCHAR(1024) NULL DEFAULT NULL ,
  `affiliate_url` VARCHAR(1024) NULL DEFAULT NULL ,
  `merchant_url` VARCHAR(1024) NULL DEFAULT NULL ,
  `sku` VARCHAR(100) NULL DEFAULT NULL ,
  `price` DOUBLE NULL DEFAULT NULL COMMENT 'divide by 100 to get value in dollars.' ,
  `cvalue` DOUBLE NULL DEFAULT NULL COMMENT 'divide by 100 to get value in dollars.' ,
  `quantity` INT NULL DEFAULT -1 COMMENT '0 quantity mean unlimited.' ,
  `discounttype` VARCHAR(45) NULL DEFAULT NULL ,
  `discountvalue` DOUBLE NULL DEFAULT NULL ,
  `checkinsrequired` INT NULL DEFAULT NULL COMMENT 'required for coupons only.' ,
  `fineprint` TEXT NULL DEFAULT NULL ,
  `illustrationurl` VARCHAR(1024) NULL DEFAULT NULL ,
  `revenue` DOUBLE NULL DEFAULT NULL ,
  `publishedat` DATETIME NULL DEFAULT NULL ,
  `updatedat` DATETIME NULL DEFAULT NULL ,
  `soldoutat` DATETIME NULL DEFAULT NULL ,
  `integrationcode` VARCHAR(1024) NULL DEFAULT NULL ,
  `likes` INT NOT NULL DEFAULT 0 ,
  `viewcount` INT NOT NULL DEFAULT 0 ,
  `fbsharecount` INT NOT NULL DEFAULT 0 ,
  `tweetcount` INT NOT NULL DEFAULT 0 ,
  `lastviewed` DATETIME NULL ,
  `istop` TINYINT NOT NULL DEFAULT 0 ,
  `isprintable` TINYINT NOT NULL DEFAULT 0 ,
  `exclusive` TINYINT NOT NULL DEFAULT 0 ,
  `printtemplate` VARCHAR(255) NULL DEFAULT '' ,
  `custom_cod_img_url` VARCHAR(1024) NULL ,
  `generic_print_1` TEXT NULL ,
  `generic_print_2` TEXT NULL ,
  `generic_print_3` TEXT NULL ,
  `tag` VARCHAR(255) NULL ,
  `cbtype` ENUM('fixed','percentage') NOT NULL DEFAULT 'fixed' ,
  `cbvalue` DECIMAL(10,2) NOT NULL DEFAULT 0.0 ,
  `created` DATE NULL DEFAULT NULL ,
  `modified` DATE NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `icodesus_id_index` (`icodesus_id` ASC) ,
  INDEX `cod_type_index` (`cod_type` ASC) ,
  INDEX `source_index` (`source` ASC) ,
  INDEX `aodbid_id` (`aodb_id` ASC) ,
  INDEX `voucherid_index` (`affili_voucher_id` ASC) ,
  INDEX `startdate_index` (`start_date` ASC) ,
  INDEX `enddate_index` (`expiry_date` ASC) ,
  INDEX `fk_cods_merchants` (`merchant_id` ASC) ,
  INDEX `icodesuk_id_index` (`icodesuk_id` ASC) ,
  INDEX `cods_index_lastviewed` (`lastviewed` ASC) ,
  INDEX `index_cods_title` (`title` ASC) ,
  INDEX `index_cods_istop` (`istop` ASC) ,
  INDEX `index_isprintable` (`isprintable` ASC) ,
  INDEX `index_safetitle` (`safe_title` ASC) ,
  INDEX `index_exclusive` (`exclusive` ASC) ,
  INDEX `index_tag` (`tag` ASC) ,
  CONSTRAINT `fk_cods_merchants1`
    FOREIGN KEY (`merchant_id` )
    REFERENCES `merchants` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cods_sites`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cods_sites` ;

CREATE  TABLE IF NOT EXISTS `cods_sites` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `cod_id` INT NOT NULL ,
  `site_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_sites_vouchers_sites` (`site_id` ASC) ,
  INDEX `fk_sites_vouchers_cods` (`cod_id` ASC) ,
  UNIQUE INDEX `unq_entry` (`cod_id` ASC, `site_id` ASC) ,
  CONSTRAINT `fk_sites_vouchers_sites1`
    FOREIGN KEY (`site_id` )
    REFERENCES `sites` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_sites_vouchers_cods1`
    FOREIGN KEY (`cod_id` )
    REFERENCES `cods` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `news`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `news` ;

CREATE  TABLE IF NOT EXISTS `news` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `title` VARCHAR(512) NOT NULL ,
  `description` TEXT NOT NULL ,
  `deleted` TINYINT(1) NOT NULL DEFAULT 0 ,
  `created` DATETIME NULL DEFAULT NULL ,
  `modified` DATETIME NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `news_sites`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `news_sites` ;

CREATE  TABLE IF NOT EXISTS `news_sites` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `news_id` INT NOT NULL ,
  `site_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_news_sites_sites` (`site_id` ASC) ,
  INDEX `fk_news_sites_news` (`news_id` ASC) ,
  CONSTRAINT `fk_news_sites_sites1`
    FOREIGN KEY (`site_id` )
    REFERENCES `sites` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_news_sites_news1`
    FOREIGN KEY (`news_id` )
    REFERENCES `news` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `locations`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `locations` ;

CREATE  TABLE IF NOT EXISTS `locations` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `merchant_id` INT NOT NULL ,
  `lat` DOUBLE NULL DEFAULT NULL ,
  `lng` DOUBLE NULL DEFAULT NULL ,
  `address1` VARCHAR(512) NULL DEFAULT NULL ,
  `address2` VARCHAR(512) NULL DEFAULT NULL ,
  `town` VARCHAR(255) NULL DEFAULT NULL ,
  `city` VARCHAR(255) NULL DEFAULT NULL ,
  `state` VARCHAR(255) NULL DEFAULT NULL ,
  `zipcode` VARCHAR(45) NULL DEFAULT NULL ,
  `countrycode` VARCHAR(5) NULL DEFAULT NULL ,
  `country` VARCHAR(255) NULL DEFAULT NULL ,
  `comments` TEXT NULL DEFAULT NULL ,
  `custom1` TEXT NULL ,
  `custom2` TEXT NULL ,
  `custom3` TEXT NULL ,
  `custom4` TEXT NULL ,
  `custom5` TEXT NULL ,
  `created` DATETIME NULL DEFAULT NULL ,
  `modified` DATETIME NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `id_index` (`id` ASC) ,
  INDEX `fk_locations_merchants_idx` (`merchant_id` ASC) ,
  INDEX `countrycode_index` (`countrycode` ASC) ,
  INDEX `state_index` (`state` ASC) ,
  INDEX `city_index` (`city` ASC) ,
  INDEX `zipcode_index` (`zipcode` ASC) ,
  INDEX `lat_index` (`lat` ASC) ,
  INDEX `lng_index` (`lng` ASC) ,
  INDEX `country_index` (`country` ASC) ,
  CONSTRAINT `fk_locations_merchants`
    FOREIGN KEY (`merchant_id` )
    REFERENCES `merchants` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cods_locations`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cods_locations` ;

CREATE  TABLE IF NOT EXISTS `cods_locations` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `cod_id` INT NOT NULL ,
  `location_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_locations_has_cods_cods_idx` (`cod_id` ASC) ,
  INDEX `fk_locations_has_cods_locations_idx` (`location_id` ASC) ,
  CONSTRAINT `fk_locations_has_cods_locations`
    FOREIGN KEY (`location_id` )
    REFERENCES `locations` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_locations_has_cods_cods`
    FOREIGN KEY (`cod_id` )
    REFERENCES `cods` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `usage_histories`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `usage_histories` ;

CREATE  TABLE IF NOT EXISTS `usage_histories` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `site_id` INT NOT NULL ,
  `user_id` INT NULL ,
  `url` VARCHAR(1024) NOT NULL ,
  `created` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_usagehistory_sites` (`site_id` ASC) ,
  INDEX `fk_usagehistory_users` (`user_id` ASC) ,
  INDEX `index_usagehistory_url` (`url` ASC) ,
  CONSTRAINT `fk_usagehistory_sites1`
    FOREIGN KEY (`site_id` )
    REFERENCES `sites` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usagehistory_users1`
    FOREIGN KEY (`user_id` )
    REFERENCES `users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `friends`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `friends` ;

CREATE  TABLE IF NOT EXISTS `friends` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `user_id` INT NOT NULL ,
  `friend_id` INT NOT NULL DEFAULT 0 ,
  `initiated_by` INT NOT NULL DEFAULT 0 ,
  `confirmed` INT NOT NULL DEFAULT 0 ,
  `created` DATETIME NOT NULL ,
  `modified` DATETIME NOT NULL ,
  INDEX `fk_table1_users` (`user_id` ASC) ,
  PRIMARY KEY (`id`) ,
  INDEX `index_friend_id` (`friend_id` ASC) ,
  CONSTRAINT `fk_table1_users1`
    FOREIGN KEY (`user_id` )
    REFERENCES `users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pages`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pages` ;

CREATE  TABLE IF NOT EXISTS `pages` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `site_id` INT NOT NULL ,
  `pagename` VARCHAR(512) NOT NULL ,
  `linkname` VARCHAR(512) NOT NULL ,
  `metatitle` TEXT NULL ,
  `metadesc` TEXT NULL ,
  `metakws` TEXT NULL ,
  `layout` VARCHAR(512) NOT NULL DEFAULT 'default' ,
  `pagecontent` TEXT NULL ,
  `created` DATETIME NULL ,
  `modified` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `linkname_index` (`linkname`(255) ASC) ,
  INDEX `fk_pages_sites` (`site_id` ASC) ,
  INDEX `unique_page_site` (`linkname` ASC, `site_id` ASC) ,
  CONSTRAINT `fk_pages_sites1`
    FOREIGN KEY (`site_id` )
    REFERENCES `sites` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `banners`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `banners` ;

CREATE  TABLE IF NOT EXISTS `banners` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `picture_id` INT NULL ,
  `site_id` INT NOT NULL ,
  `tag` VARCHAR(255) NULL COMMENT 'Tag can be, h-large, s-left, s-right' ,
  `url` VARCHAR(1024) NULL ,
  `accountingmethod` VARCHAR(45) NULL COMMENT 'Accounting can be, clicks, impressions, date' ,
  `maximpressions` INT NULL DEFAULT 0 ,
  `impressionsdone` TINYINT NULL DEFAULT 0 ,
  `maxclicks` INT NULL DEFAULT 0 ,
  `clicksdone` TINYINT NULL DEFAULT 0 ,
  `active` TINYINT NOT NULL DEFAULT 0 ,
  `created` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `tag_index` (`tag` ASC) ,
  INDEX `active_index` (`active` ASC) ,
  INDEX `fk_banners_sites` (`site_id` ASC) ,
  INDEX `fk_banners_pictures` (`picture_id` ASC) ,
  CONSTRAINT `fk_banners_sites1`
    FOREIGN KEY (`site_id` )
    REFERENCES `sites` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_banners_pictures1`
    FOREIGN KEY (`picture_id` )
    REFERENCES `pictures` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sysconfigurations`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sysconfigurations` ;

CREATE  TABLE IF NOT EXISTS `sysconfigurations` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `datakey` VARCHAR(255) NOT NULL ,
  `dataval` VARCHAR(255) NOT NULL ,
  `editable` TINYINT NOT NULL DEFAULT 0 ,
  `created` DATETIME NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `merchants_networks`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `merchants_networks` ;

CREATE  TABLE IF NOT EXISTS `merchants_networks` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `merchant_id` INT NOT NULL ,
  `network_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_merchants_networks_merchants1_idx` (`merchant_id` ASC) ,
  INDEX `fk_merchants_networks_networks1_idx` (`network_id` ASC) )
ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table `clicks`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `clicks` ;

CREATE  TABLE IF NOT EXISTS `clicks` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `cod_id` INT NULL ,
  `merchant_id` INT NULL ,
  `user_id` INT NOT NULL ,
  `cbtype` ENUM('fixed','percentage') NOT NULL DEFAULT 'fixed' ,
  `cbvalue` DECIMAL(10,2) NOT NULL DEFAULT 0.0 ,
  `created` DATETIME NULL ,
  `modified` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_clicks_users1_idx` (`user_id` ASC) ,
  INDEX `fk_clicks_cods1_idx` (`cod_id` ASC) ,
  INDEX `fk_clicks_merchants1_idx` (`merchant_id` ASC) )
ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table `payout_methods`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `payout_methods` ;

CREATE  TABLE IF NOT EXISTS `payout_methods` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `method` VARCHAR(255) NOT NULL ,
  `requirements` TEXT NOT NULL ,
  `status` ENUM('active','inactive') NOT NULL DEFAULT 'active' ,
  `created` DATETIME NULL ,
  `modified` DATETIME NULL ,
  PRIMARY KEY (`id`) )
ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table `transactions`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `transactions` ;

CREATE  TABLE IF NOT EXISTS `transactions` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `click_id` INT NULL ,
  `network_id` INT NULL ,
  `payout_method_id` INT NULL ,
  `user_id` INT NULL ,
  `type` VARCHAR(45) NOT NULL ,
  `txnid` VARCHAR(45) NOT NULL ,
  `payout_method_details` TEXT NULL ,
  `amount` DECIMAL(10,2) NOT NULL ,
  `txnstatus` VARCHAR(45) NOT NULL ,
  `programid` VARCHAR(50) NULL ,
  `txnamount` DECIMAL(10,2) NOT NULL DEFAULT 0.0 ,
  `txncommission` DECIMAL(10,2) NOT NULL DEFAULT 0.0 ,
  `rowstatus` VARCHAR(512) NULL ,
  `created` DATETIME NULL ,
  `modified` DATETIME NULL ,
  `updated` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_transactions_clicks1_idx` (`click_id` ASC) ,
  INDEX `fk_transactions_networks1_idx` (`network_id` ASC) ,
  INDEX `fk_transactions_users1_idx` (`user_id` ASC) ,
  INDEX `fk_transactions_payment_methods1_idx` (`payout_method_id` ASC) ,
  INDEX `indx_txnid` (`txnid` ASC) )
ENGINE = MyISAM;




SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `networks`
-- -----------------------------------------------------
START TRANSACTION;
INSERT INTO `networks` (`id`, `name`, `report_row_format`, `url`, `logo`, `status_confirmed`, `status_pending`, `status_declined`, `lasrt_report_upload`, `created`, `modified`) VALUES (1, 'Commission Junction', '\"18-Aug-2012 09:30 PDT\",\"18-Aug-2012 00:43 PDT\",\"Paying User\",{TRANSACTIONID},\"sim_sale\",\"CLICK\",{STATUS},\"No\",{AMOUNT},\"0.00\",{COMMISSION},\"5547279\",\"ch\",\"10931009\",\"2509123\",\"Rebtel\",{TRACKINGID},\"payment_17025809\",\"\",\"322480\",{PROGRAMID}', 'http://www.cj.com/', '/img/networks/cj.gif', 'closed', 'extended|new|locked', 'declined', NULL, '2012-09-13 :00:00:00', '2012-09-13 :00:00:00');

COMMIT;

-- -----------------------------------------------------
-- Data for table `sites`
-- -----------------------------------------------------
START TRANSACTION;
INSERT INTO `sites` (`id`, `fqdn`, `notes`, `active`, `fbappid`, `fbapikey`, `fbsecret`, `twitterusername`, `twitterpassword`, `fblikecode`, `fbpagename`, `headerinserts`, `footerinserts`, `logopath`, `theme`, `ctr`, `emailnoreply`, `emailinfo`, `emailcontact`, `created`) VALUES (1, 's1.dvs.com', 'test site', '1', '156980577702237', '6a113316fcd0d45505596ea6aba583f8', '85f8391f7f0d01dc489a6ce010fda37b', 'voucherscript', NULL, '<iframe src=\"http://www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwww.facebook.com%2Fpages%2FVoucher-Script%2F114934511873248&amp;layout=standard&amp;show_faces=true&amp;width=450&amp;action=like&amp;colorscheme=light&amp;height=80\" scrolling=\"no\" frameborder=\"0\" style=\"border:none; overflow:hidden; width:450px; height:80px;\" allowTransparency=\"true\"></iframe> ', 'http://www.facebook.com/pages/Voucher-Script/114934511873248', '	<meta property=\"og:title\" content=\"Voucher Script\"/> ', '', 'logo.png', 'factory', 1, NULL, NULL, NULL, '2011-04-13 19:00:00');

COMMIT;

-- -----------------------------------------------------
-- Data for table `groups`
-- -----------------------------------------------------
START TRANSACTION;
INSERT INTO `groups` (`id`, `groupdesc`, `created`, `modified`) VALUES (1, 'Site Administrators', '2011-05-20', '2011-05-20');
INSERT INTO `groups` (`id`, `groupdesc`, `created`, `modified`) VALUES (2, 'Managers', '2011-06-08', '2011-06-08');
INSERT INTO `groups` (`id`, `groupdesc`, `created`, `modified`) VALUES (3, 'users', '2011-06-08', '2011-06-08');

COMMIT;

-- -----------------------------------------------------
-- Data for table `users`
-- -----------------------------------------------------
START TRANSACTION;
INSERT INTO `users` (`id`, `group_id`, `fullname`, `email`, `pass`, `nationality`, `dob`, `gender`, `fax`, `address`, `addressvisible`, `phone`, `phonevisible`, `webaddress`, `webvisible`, `blogaddress`, `blogvisible`, `facebookurl`, `facebookvisible`, `myspaceurl`, `myspacevisible`, `twitterurl`, `twittervisible`, `orkuturl`, `orkutvisible`, `profilemail`, `profilemailvisible`, `company`, `education`, `hobbies`, `languages`, `setupstatus`, `tokenhash`, `active`, `usertype`, `fbid`, `fbpass`, `lastloginip`, `lastlogintime`, `created`, `modified`) VALUES (1, 1, 'Hive Admin', 'admin@voucherscript.com', '7e0a53bcc9f27efa316aaa06a2da14430bd1dd63', 'Pakistani', NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 1, NULL, 1, 'admin', NULL, NULL, NULL, NULL, '2011-05-20', '2011-05-20');

COMMIT;

-- -----------------------------------------------------
-- Data for table `pages`
-- -----------------------------------------------------
START TRANSACTION;
INSERT INTO `pages` (`id`, `site_id`, `pagename`, `linkname`, `metatitle`, `metadesc`, `metakws`, `layout`, `pagecontent`, `created`, `modified`) VALUES (1, 1, 'About', 'about', NULL, NULL, NULL, '', 'Content for page here.', '2011-06-17', NULL);
INSERT INTO `pages` (`id`, `site_id`, `pagename`, `linkname`, `metatitle`, `metadesc`, `metakws`, `layout`, `pagecontent`, `created`, `modified`) VALUES (2, 1, 'Terms', 'terms-and-conditions', NULL, NULL, NULL, '', 'Content for page here.', '2011-06-17', NULL);
INSERT INTO `pages` (`id`, `site_id`, `pagename`, `linkname`, `metatitle`, `metadesc`, `metakws`, `layout`, `pagecontent`, `created`, `modified`) VALUES (3, 1, 'Privacy', 'privacy-policy', NULL, NULL, NULL, '', 'Content for page here.', '2011-06-17', NULL);

COMMIT;

-- -----------------------------------------------------
-- Data for table `payout_methods`
-- -----------------------------------------------------
START TRANSACTION;
INSERT INTO `payout_methods` (`id`, `method`, `requirements`, `status`, `created`, `modified`) VALUES (1, 'PayPal', 'Please enter your paypal ID.', 'active', '2012-09-13 00:00:00', '2012-09-13 00:00:00');

COMMIT;

-- Default inserts of banners and logo for sites

-- FOR MM
insert into banners(site_id, tag) select id, 'h-large' from sites;
insert into banners(site_id, tag) select id, 's-left' from sites;
insert into banners(site_id, tag) select id, 's-right' from sites;


INSERT INTO `sysconfigurations` (`datakey`,`dataval`,`created`) VALUES('CODS-TAGS','CODS-TAGS','2012-05-24 16:34:00');

COMMIT;



-- -----------------------------------------------------
-- View `vwcategoriesmerchantscodcounts`
-- -----------------------------------------------------

CREATE VIEW `vwcategoriesmerchantscodcounts` AS
SELECT 
    SITE.id AS SITEID, SITE.fqdn,
    Category.id AS CATID, Category.catname, Category.safe_catname, Category.lastviewed AS catlastviewed,
    Merchant.id AS MERID, Merchant.merchant_name, Merchant.safe_merchant_name, Merchant.logo_url, Merchant.site_url, Merchant.affiliate_url, Merchant.istop, Merchant.description,
    (SELECT COUNT(*) FROM cods WHERE merchant_id = Merchant.id AND id IN (SELECT cod_id FROM cods_sites WHERE site_id = SITE.id)) AS cods_count
FROM
    merchants Merchant
        LEFT JOIN categories_merchants CATMERCHANT ON CATMERCHANT.merchant_id = Merchant.id
        LEFT JOIN categories Category ON Category.id = CATMERCHANT.category_id
        RIGHT JOIN merchants_sites MERCHANTSITE ON MERCHANTSITE.merchant_id = Merchant.id
        RIGHT JOIN sites SITE ON SITE.id = MERCHANTSITE.site_id
ORDER BY
    CATID;

-- -----------------------------------------------------
-- View `vwcodssitesmerchants`
-- -----------------------------------------------------
CREATE VIEW `vwcodssitesmerchants` AS
SELECT 
    SITE.id as SITEID, SITE.fqdn,
    MERCHANT.merchant_name, MERCHANT.safe_merchant_name, MERCHANT.description, 
    MERCHANT.logo_url, MERCHANT.site_url, MERCHANT.affiliate_url, MERCHANT.likes,
    MERCHANT.address1, MERCHANT.address2, MERCHANT.phone1, MERCHANT.phone2, MERCHANT.phone3,
    COD.id AS CODID, COD.cod_type, COD.title, COD.description AS codDescription, 
    COD.vouchercode, COD.start_date, COD.expiry_date, COD.merchant_logo_url, 
    COD.affiliate_url AS codAffiliateURL, COD.likes AS codLikes, COD.fbsharecount, 
    COD.viewcount, COD.created AS CODCREATED, COD.lastviewed, COD.istop, COD.isprintable, 
    COD.printtemplate, COD.exclusive, COD.tweetcount, COD.custom_cod_img_url, COD.safe_title,
    COD.generic_print_1, COD.generic_print_2, COD.generic_print_3, COD.tag
FROM
    cods COD
    LEFT JOIN merchants MERCHANT ON COD.merchant_id = MERCHANT.id
    RIGHT JOIN cods_sites CODSITES ON CODSITES.cod_id = COD.id
        RIGHT JOIN sites SITE ON SITE.ID = CODSITES.site_id;

-- -----------------------------------------------------
-- View `vwcategoriesbrowse`
-- -----------------------------------------------------
CREATE VIEW `vwcategoriesbrowse` AS
SELECT 
    site.id AS SITEID, site.fqdn AS fqdn, cat.id AS id, cat.parent_id AS parent_id,
    cat.catname AS catname, cat.safe_catname AS safe_catname, cat.viewcount AS viewcount,
    cat.source AS source, cat.merged_in AS merged_in,
    (SELECT count(0) 
        FROM merchants 
        WHERE merchants.id IN 
            (SELECT categories_merchants.merchant_id 
                FROM categories_merchants 
                WHERE (categories_merchants.category_id = cat.id)
                )
        ) AS countMerchants,
        0 AS countCODs
FROM 
    categories cat 
        LEFT JOIN categories_sites catsite ON (catsite.category_id = cat.id)
            LEFT JOIN sites site ON site.id = catsite.site_id
WHERE 
    (catsite.site_id IS NOT NULL);

-- -----------------------------------------------------
-- View `vwsitesmerchantscodcounts`
-- -----------------------------------------------------
CREATE VIEW `vwsitesmerchantscodcounts` AS
SELECT 
    SITE.id AS SITEID, SITE.fqdn,
    Merchant.id AS MERID, Merchant.merchant_name, Merchant.safe_merchant_name, Merchant.logo_url, Merchant.site_url, 
    Merchant.affiliate_url, Merchant.istop, Merchant.viewcount,    
    (SELECT COUNT(*) FROM cods WHERE merchant_id = Merchant.id AND start_date <= now() AND expiry_date > now()) AS cods_count, 
    Merchant.lastviewed, Merchant.description, Merchant.metakw, Merchant.metadesc, Merchant.metatitle
FROM
    merchants Merchant
        RIGHT JOIN merchants_sites MERCHANTSITE ON MERCHANTSITE.merchant_id = Merchant.id
        RIGHT JOIN sites SITE ON SITE.id = MERCHANTSITE.site_id;

-- -----------------------------------------------------
-- View `vwallcategoriesbrowse`
-- -----------------------------------------------------
CREATE VIEW `vwallcategoriesbrowse` AS
SELECT 
    cat.id AS id, cat.parent_id AS parent_id, cat.catname AS catname, cat.safe_catname AS safe_catname, 
    cat.viewcount AS viewcount, cat.source AS source, cat.merged_in AS merged_in,
    (SELECT count(merchants.id) 
        FROM merchants 
        WHERE merchants.id IN 
            (SELECT categories_merchants.merchant_id AS merchant_id 
                FROM categories_merchants 
                WHERE (categories_merchants.category_id = cat.id)
                )
    ) AS countMerchants 

FROM 
    categories cat;

-- -----------------------------------------------------
-- View `vwmerchantsbrowse`
-- -----------------------------------------------------
CREATE VIEW `vwmerchantsbrowse` AS
SELECT 
    Mer.id AS id, Mer.source AS source, Mer.merchant_name AS merchant_name,
    Mer.safe_merchant_name AS safe_merchant_name, Mer.description AS description,
    Mer.logo_url AS logo_url, Mer.site_url AS site_url, Mer.affiliate_url AS affiliate_url,
    Mer.likes AS likes, Mer.viewcount AS viewcount, Mer.istop AS istop, Mer.fbsharecount AS fbsharecount,
    Mer.tweetcount AS tweetcount, 
    (SELECT COUNT(0) 
        FROM cods 
        WHERE merchant_id = Mer.id
    ) AS countCODs
    ,(SELECT COUNT(0)
        FROM locations
        WHERE merchant_id = Mer.id
    ) AS countLocations
FROM 
    merchants Mer;
;

-- -----------------------------------------------------
-- View `vwsitemerchantsbrowse`
-- -----------------------------------------------------
CREATE VIEW `vwsitemerchantsbrowse` AS
SELECT  
    site.id AS SITEID, site.fqdn AS fqdn, Mer.id AS id, Mer.source AS source, 
    Mer.merchant_name AS merchant_name, Mer.safe_merchant_name AS safe_merchant_name, 
    Mer.description AS description, Mer.logo_url AS logo_url, Mer.site_url AS site_url, 
    Mer.affiliate_url AS affiliate_url, Mer.likes AS likes, Mer.viewcount AS viewcount, 
    Mer.istop AS istop, Mer.fbsharecount AS fbsharecount, Mer.tweetcount AS tweetcount, 
    (SELECT COUNT(0) 
        FROM cods 
        WHERE merchant_id = Mer.id
    ) AS countCODs
    ,(SELECT COUNT(0)
        FROM locations
        WHERE merchant_id = Mer.id
    ) AS countLocations
    
FROM    
    merchants Mer 
    LEFT JOIN (merchants_sites mersite 
                LEFT JOIN sites site 
                ON((mersite.site_id = site.id))) 
                ON((Mer.id = mersite.merchant_id)) 
WHERE (mersite.site_id IS NOT NULL);
;

-- -----------------------------------------------------
-- View `vwcodsbrowse`
-- -----------------------------------------------------
CREATE VIEW `vwcodsbrowse` AS
SELECT  
    Mer.merchant_name AS merchant_name, Mer.safe_merchant_name AS safe_merchant_name, Mer.logo_url AS logo_url,
    COD.id AS id, COD.merchant_id AS merchant_id, COD.cod_type AS cod_type, COD.source AS source, 
    COD.title AS title, COD.description AS description, COD.vouchercode AS vouchercode, 
    COD.start_date AS start_date, COD.expiry_date AS expiry_date, COD.likes AS likes,
    COD.viewcount AS viewcount, COD.fbsharecount AS fbsharecount, COD.tweetcount AS tweetcount, 
    COD.istop AS cods_istop, COD.exclusive AS exclusive, COD.created AS created

FROM 
    cods COD 
    LEFT JOIN merchants Mer
    ON COD.merchant_id = Mer.id;

-- -----------------------------------------------------
-- View `vwsitecodsbrowse`
-- -----------------------------------------------------
CREATE VIEW `vwsitecodsbrowse` AS
SELECT
    SITE.id AS SITEID, SITE.fqdn,
    Mer.merchant_name AS merchant_name, Mer.safe_merchant_name AS safe_merchant_name, Mer.logo_url AS logo_url,
    COD.id AS id, COD.merchant_id AS merchant_id, COD.cod_type AS cod_type, COD.source AS source, 
    COD.title AS title, COD.description AS description, COD.vouchercode AS vouchercode, COD.start_date AS start_date, 
    COD.expiry_date AS expiry_date, COD.likes AS likes, COD.viewcount AS viewcount, COD.fbsharecount AS fbsharecount, 
    COD.istop AS cods_istop, COD.exclusive AS exclusive, COD.created AS created, COD.tweetcount
FROM 
    cods COD 
    LEFT JOIN merchants Mer ON COD.merchant_id = Mer.id
    LEFT JOIN cods_sites CODSITES ON CODSITES.cod_id = COD.id
    LEFT JOIN sites SITE ON SITE.id = CODSITES.site_id;

-- -----------------------------------------------------
-- View `vwusersbrowse`
-- -----------------------------------------------------
CREATE VIEW `vwusersbrowse` AS
SELECT
    User.id AS id, User.fullname AS fullname, User.email AS email, User.gender AS gender, 
    User.nationality AS nationality, (YEAR(CURDATE())-YEAR(User.dob)) AS age, User.active as active, 
    User.usertype AS usertype, User.created AS created,
    
    (SELECT filename FROM pictures profilePic 
        WHERE (profilePic.user_id = User.id) AND (profilePic.tag = 'profile-view-picture') AND (profilePic.deleted = 0)
    ) AS profilePicture,
    
    (SELECT Count(0) FROM conversations conv 
        WHERE conv.sender_id = User.id
    ) AS convCount,
    
    (SELECT Count(0) FROM abuse_reports abusedCov
        WHERE (abusedCov.user_id = User.id) AND (abusedCov.type = 'conversation')
    ) AS fconvCount,
    
    (SELECT Count(0) FROM pictures pics
        WHERE (pics.user_id = User.id) AND (pics.deleted = 0)
    ) AS pictureCount,
    
    (SELECT Count(0) FROM abuse_reports abusedPic
        WHERE (abusedPic.user_id = User.id) AND (abusedPic.type = 'picture') AND (abusedPic.status = 0)
    ) AS fpictureCount

FROM users User 
WHERE User.usertype = 'user'
ORDER by User.fullname;

-- -----------------------------------------------------
-- View `vwlocaloffers`
-- -----------------------------------------------------
CREATE VIEW `vwlocaloffers` AS
select 
    Cod.id CODID, Cod.merchant_id, Cod.cod_type, Cod.source, Cod.icodesuk_id, Cod.icodesus_id, Cod.aodb_id, Cod.affili_voucher_id, Cod.programid, Cod.title, Cod.safe_title, Cod.description, Cod.vouchercode, Cod.start_date, Cod.expiry_date, Cod.relationship, Cod.merchant_logo_url, Cod.network, Cod.excode, Cod.deep_link, Cod.affiliate_url, Cod.merchant_url, Cod.sku, Cod.price, Cod.cvalue, Cod.quantity, Cod.discounttype, Cod.discountvalue, Cod.checkinsrequired, Cod.fineprint, Cod.illustrationurl, Cod.revenue, Cod.publishedat, Cod.updatedat, Cod.soldoutat, Cod.integrationcode, Cod.likes, Cod.viewcount, Cod.fbsharecount, Cod.tweetcount, Cod.lastviewed, Cod.istop, Cod.isprintable, Cod.exclusive, Cod.printtemplate, Cod.custom_cod_img_url, Cod.generic_print_1, Cod.generic_print_2, Cod.generic_print_3, Cod.tag, Cod.created CODCREATED,
    Location.id LOCATIONID, Location.lat, Location.lng, Location.address1, Location.address2, Location.town, Location.city, Location.state, Location.zipcode, Location.countrycode, Location.country, Location.comments, Location.custom1, Location.custom2, Location.custom3, Location.custom4, Location.custom5,
    Site.id SITEID, Site.fqdn, Site.active, Site.ctr,
    Merchant.merchant_name, Merchant.safe_merchant_name, Merchant.logo_url MERCHANTLOGOURL, Merchant.affiliate_url MERCHANTAFFILIATEURL
FROM
    cods Cod 
    LEFT JOIN 
        cods_locations COLOC ON COLOC.cod_id = Cod.id
            RIGHT JOIN    
            locations Location ON Location.id = COLOC.location_id
    LEFT JOIN
        merchants Merchant ON Merchant.id = Cod.merchant_id
    LEFT JOIN
        cods_sites CODSITE ON CODSITE.cod_id = Cod.id
        RIGHT JOIN 
        sites Site ON Site.id = CODSITE.site_id
WHERE
    Cod.start_date <= now()
AND
    Cod.expiry_date >= now()    
    ;

-- -----------------------------------------------------
-- View `vwbrowse`
-- -----------------------------------------------------
CREATE VIEW `vwbrowse` AS
SELECT
    Site.id SITEID, Site.fqdn,  Site.ctr,
    Category.id CATID, Category.parent_id, Category.catname, Category.safe_catname, Category.viewcount CATVIEWS, Category.lastviewed CATLASTVIEWED, Category.metakw CATMETAKW, Category.metadesc CATMETADESC, Category.metatitle CATMETATITLE, Category.created CATCREATED, Category.modified CATMODIFIED,
    Merchant.id MERID, Merchant.merchant_name, Merchant.safe_merchant_name, Merchant.description MERDESC, Merchant.logo_url, Merchant.site_url, Merchant.total_offers, Merchant.affiliate_url MERAFFILIATEURL, Merchant.lastupdate, Merchant.contact_phone, Merchant.likes MERLIKES, Merchant.viewcount MERVIEWS, Merchant.autoupdate, Merchant.istop MERISTOP, Merchant.fbsharecount MERFBSHARECOUNT, Merchant.tweetcount MERTWEETCOUNT, Merchant.lastviewed MERLASTVIEWED, Merchant.metakw MERMETAKW, Merchant.metadesc MERMETADESC, Merchant.metatitle MERMETATITLE, Merchant.address1, Merchant.address2, Merchant.phone1, Merchant.phone2, Merchant.phone3, Merchant.cbtype MERCBTYPE, Merchant.cbvalue MERCBVALUE, Merchant.created MERCREATED, Merchant.modified MERMODIFIED,
    Cod.id CODID, Cod.merchant_id, Cod.cod_type, Cod.programid, Cod.title, Cod.safe_title, Cod.description CODDESC, Cod.vouchercode, Cod.start_date, Cod.expiry_date, Cod.merchant_logo_url,  Cod.deep_link, Cod.affiliate_url CODAFFILIATEURL, Cod.merchant_url, Cod.sku, Cod.price, Cod.cvalue, Cod.quantity, Cod.discounttype, Cod.discountvalue, Cod.checkinsrequired, Cod.fineprint, Cod.illustrationurl, Cod.revenue, Cod.publishedat, Cod.updatedat, Cod.soldoutat, Cod.integrationcode, Cod.likes CODLIKES, Cod.viewcount CODVIEWS, Cod.fbsharecount CODFBSHARECOUNT, Cod.lastviewed CODLASTVIEWED, Cod.istop CODISTOP, Cod.exclusive, Cod.isprintable, Cod.printtemplate, Cod.tweetcount CODTWEETCOUNT, Cod.custom_cod_img_url, Cod.generic_print_1, Cod.generic_print_2, Cod.generic_print_3, Cod.tag, Cod.created CODCREATED, Cod.cbtype CODCBTYPE, Cod.cbvalue CODCBVALUE, Cod.modified CODMODIFIED
FROM
    sites Site
    LEFT OUTER JOIN categories_sites CatSite ON CatSite.site_id = Site.id
    INNER JOIN categories Category ON (Category.id = CatSite.category_id AND Category.merged_in = 0)
    INNER JOIN categories_merchants CatMer ON CatMer.category_id = Category.id
    LEFT OUTER JOIN merchants_sites MerSite ON MerSite.site_id = Site.id
    INNER JOIN merchants Merchant ON (MerSite.merchant_id = Merchant.id AND Merchant.id = CatMer.merchant_id)
    INNER JOIN cods Cod ON (Cod.merchant_id = Merchant.id);



