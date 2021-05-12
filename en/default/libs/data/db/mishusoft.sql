--
-- Table structure for table `{DB_PREFIX}admin_menu`
--

CREATE TABLE IF NOT EXISTS `{DB_PREFIX}admin_menu`
(
    `am_id`    int(10) NOT NULL AUTO_INCREMENT,
    `am_name`  varchar(60) DEFAULT NULL,
    `am_title` varchar(40) DEFAULT NULL,
    `am_url`   varchar(40) DEFAULT NULL,
    `am_icon`  varchar(40) DEFAULT NULL,
    PRIMARY KEY (`am_id`)
)
    ENGINE = InnoDB
    DEFAULT CHARSET = utf8mb4;

--
-- Dumping data for table `{DB_PREFIX}admin_menu`
--

INSERT INTO `{DB_PREFIX}admin_menu` (`am_id`, `am_name`, `am_title`, `am_url`, `am_icon`)
VALUES (null, 'Permissions', 'Permissions', 'permissions', 'fas fa-check-square'),
       (null, 'Roles', 'Roles', 'roles', 'fas fa-user'),
       (null, 'Users', 'Users', 'users', 'fas fa-users'),
       (null, 'Branches', 'Branches', 'branches', 'fas fa-code-branch');

-- --------------------------------------------------------

--
-- Table structure for table `{DB_PREFIX}apps`
--

CREATE TABLE IF NOT EXISTS `{DB_PREFIX}apps`
(
    `app_id`      int(10)                     NOT NULL AUTO_INCREMENT,
    `app_name`    varchar(40)                          DEFAULT NULL,
    `app_url`     varchar(40)                          DEFAULT NULL,
    `app_icon`    varchar(30)                          DEFAULT NULL,
    `app_status`  enum ('active', 'deactive') NOT NULL DEFAULT 'deactive',
    `c_status`    varchar(100)                NOT NULL,
    `quickAccess` enum ('enable', 'disable')  NOT NULL DEFAULT 'disable',
    PRIMARY KEY (`app_id`)
)
    ENGINE = InnoDB
    DEFAULT CHARSET = utf8mb4;

-- --------------------------------------------------------


--
-- Table structure for table `{DB_PREFIX}block_list`
--

CREATE TABLE IF NOT EXISTS `{DB_PREFIX}block_list`
(
    `id`       int(10) NOT NULL AUTO_INCREMENT,
    `name`     varchar(80) DEFAULT NULL,
    `username` varchar(80) DEFAULT NULL,
    `ip`       varchar(20) DEFAULT NULL,
    PRIMARY KEY (`id`)
)
    ENGINE = InnoDB
    DEFAULT CHARSET = utf8mb4;

-- --------------------------------------------------------
--
-- Table structure for table `{DB_PREFIX}brands`
--

CREATE TABLE IF NOT EXISTS `{DB_PREFIX}brands`
(
    `id`                  int(11)      NOT NULL AUTO_INCREMENT,
    `name`                varchar(150) NOT NULL,
    `CreatedUserID`       int(11)      NOT NULL,
    `CreatedUserUsername` varchar(100) NOT NULL,
    `CreatedUserFullName` varchar(100) NOT NULL,
    `CreatedTime`         varchar(40)  NOT NULL,
    PRIMARY KEY (`id`)
)
    ENGINE = InnoDB
    DEFAULT CHARSET = utf8mb4;

-- --------------------------------------------------------
--
-- Table structure for table `{DB_PREFIX}branches`
--

CREATE TABLE IF NOT EXISTS `{DB_PREFIX}branches`
(
    `id`       int(11)                  NOT NULL AUTO_INCREMENT,
    `name`     varchar(100)             NOT NULL,
    `status`   enum ('opened','closed') NOT NULL DEFAULT 'closed',
    `location` text                     NOT NULL,
    PRIMARY KEY (`id`)
)
    ENGINE = InnoDB
    DEFAULT CHARSET = utf8mb4;

-- --------------------------------------------------------
--
-- Table structure for table `{DB_PREFIX}branch_user`
--

CREATE TABLE IF NOT EXISTS `{DB_PREFIX}branch_user`
(
    `id`     int(11) NOT NULL AUTO_INCREMENT,
    `branch` int(11) NOT NULL,
    `user`   int(11) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

-- --------------------------------------------------------
--
-- Table structure for table `{DB_PREFIX}chatMessages`
--

CREATE TABLE IF NOT EXISTS `{DB_PREFIX}chatMessages`
(
    `id`         int(11)                         NOT NULL AUTO_INCREMENT,
    `senderID`   int(255)                        NOT NULL,
    `receiverID` int(255)                        NOT NULL,
    `message`    text COLLATE utf8mb4_unicode_ci NOT NULL,
    `time`       int(20)                         NOT NULL,
    PRIMARY KEY (`id`)
)
    ENGINE = InnoDB
    DEFAULT CHARSET = utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `{DB_PREFIX}clients`
--

CREATE TABLE IF NOT EXISTS `{DB_PREFIX}clients`
(
    `clntId`                  int(11)      NOT NULL AUTO_INCREMENT,
    `name`                    varchar(100) NOT NULL,
    `mobile_number`           varchar(100) NOT NULL,
    `address`                 varchar(200) NOT NULL,
    `clntCreatedUserID`       int(11)      NOT NULL,
    `clntCreatedUserUsername` varchar(100) NOT NULL,
    `clntCreatedUserFullName` varchar(100) NOT NULL,
    `clntCreatedTime`         varchar(40)  NOT NULL,
    PRIMARY KEY (`clntId`)
)
    ENGINE = InnoDB
    DEFAULT CHARSET = utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `{DB_PREFIX}invoices`
--

CREATE TABLE IF NOT EXISTS `{DB_PREFIX}invoices`
(
    `invId`                  int(11)      NOT NULL AUTO_INCREMENT,
    `branch`                 int(11)      NOT NULL,
    `inv_no`                 varchar(100) NOT NULL,
    `client`                 int(11)      NOT NULL,
    `sales_man`              int(11)      NOT NULL,
    `invCreatedUserID`       int(11)      NOT NULL,
    `invCreatedUserUsername` varchar(100) NOT NULL,
    `invCreatedUserFullName` varchar(100) NOT NULL,
    `invCreatedTime`         varchar(40)  NOT NULL,
    PRIMARY KEY (`invId`)
)
    ENGINE = InnoDB
    DEFAULT CHARSET = utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `{DB_PREFIX}invoice_bill`
--

CREATE TABLE IF NOT EXISTS `{DB_PREFIX}invoice_bill`
(
    `billId`                  int(11)      NOT NULL AUTO_INCREMENT,
    `branch`                  int(11)      NOT NULL,
    `invoiceId`               int(11)      NOT NULL,
    `clientId`                int(11)      NOT NULL,
    `totalBill`               int(11)      NOT NULL,
    `billCreatedUserID`       int(11)      NOT NULL,
    `billCreatedUserUsername` varchar(100) NOT NULL,
    `billCreatedUserFullName` varchar(100) NOT NULL,
    `billCreatedTime`         varchar(40)  NOT NULL,
    PRIMARY KEY (`billId`)
)
    ENGINE = InnoDB
    DEFAULT CHARSET = utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `{DB_PREFIX}sold_items`
--

CREATE TABLE IF NOT EXISTS `{DB_PREFIX}sold_items`
(
    `slditmId`                  int(11)      NOT NULL AUTO_INCREMENT,
    `slditmBranch`              int(11)      NOT NULL,
    `slditmInvoiceId`           int(11)      NOT NULL,
    `slditmClientId`            int(11)      NOT NULL,
    `slditmItemId`              int(11)      NOT NULL,
    `slditmBrandId`             int(11)      NOT NULL,
    `slditmModel`               varchar(100) NOT NULL,
    `slditmSerialNumber`        varchar(100) NOT NULL,
    `slditmWarrantyTime`        int(11)      NOT NULL,
    `slditmUnitPrice`           int(11)      NOT NULL,
    `slditmQuantity`            int(11)      NOT NULL,
    `slditmTotalPrice`          int(11)      NOT NULL,
    `slditmOdrN`                int(11)      NOT NULL,
    `sldItmCreatedUserID`       int(11)      NOT NULL,
    `sldItmCreatedUserUsername` varchar(100) NOT NULL,
    `sldItmCreatedUserFullName` varchar(100) NOT NULL,
    `sldItmCreatedTime`         varchar(40)  NOT NULL,
    PRIMARY KEY (`slditmId`)
)
    ENGINE = InnoDB
    DEFAULT CHARSET = utf8mb4;

-- --------------------------------------------------------


--
-- Table structure for table `{DB_PREFIX}items`
--

CREATE TABLE IF NOT EXISTS `{DB_PREFIX}items`
(
    `id`                  int(11)                           NOT NULL AUTO_INCREMENT,
    `name`                varchar(150)                      NOT NULL,
    `c_status`            enum ('available', 'unavailable') NOT NULL,
    `CreatedUserID`       int(11)                           NOT NULL,
    `CreatedUserUsername` varchar(100)                      NOT NULL,
    `CreatedUserFullName` varchar(100)                      NOT NULL,
    `CreatedTime`         varchar(40)                       NOT NULL,
    PRIMARY KEY (`id`)
)
    ENGINE = InnoDB
    DEFAULT CHARSET = utf8mb4;

-- --------------------------------------------------------
--
-- Table structure for table `{DB_PREFIX}menuconfig`
--

CREATE TABLE IF NOT EXISTS `{DB_PREFIX}menuconfig`
(
    `position` varchar(40)  NOT NULL,
    `show`     varchar(100) NOT NULL,
    `hide`     varchar(100) NOT NULL,
    UNIQUE KEY `position` (`position`, `show`, `hide`)
)
    ENGINE = InnoDB
    DEFAULT CHARSET = utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `{DB_PREFIX}menus`
--

CREATE TABLE IF NOT EXISTS `{DB_PREFIX}menus`
(
    `id`         varchar(40) DEFAULT NULL,
    `title`      varchar(40)                             NOT NULL,
    `url`        varchar(100)                            NOT NULL,
    `icon`       varchar(20)                             NOT NULL,
    `position`   enum ('header','footer','left','right') NOT NULL,
    `permission` varchar(20)                             NOT NULL,
    UNIQUE KEY `id` (`id`, `title`, `url`, `icon`, `position`, `permission`)
)
    ENGINE = InnoDB
    DEFAULT CHARSET = utf8mb4;

--
-- Dumping data for table `{DB_PREFIX}menus`
--

INSERT INTO `{DB_PREFIX}menus` (`id`, `title`, `url`, `icon`, `position`, `permission`)
VALUES ('Accessories', 'Accessories', 'Accessories', '', 'header', ''),
       ('Audio/Video', 'Audio/Video', 'Audio/Video', '', 'header', ''),
       ('desktop', 'Desktop', 'desktop', '', 'header', ''),
       ('desktop_component', 'Desktop Component', 'desktop_component', '', 'header', ''),
       ('monitor', 'Monitor', 'monitor', '', 'header', ''),
       ('Network', 'Network', 'Network', '', 'header', ''),
       ('notebook', 'NoteBook', 'notebook', 'fas fa-notebook', 'header', ''),
       ('Office Equipment', 'Office Equipment', 'Office Equipment', '', 'header', ''),
       ('Photography', 'Photography', 'Photography', '', 'header', ''),
       ('Printer', 'Printer', 'Printer', '', 'header', ''),
       ('Scanner', 'Scanner', 'Scanner', '', 'header', ''),
       ('server', 'Server', 'server', '', 'header', ''),
       ('software', 'Software', 'software', '', 'header', ''),
       ('storage', 'Storage', 'storage', '', 'header', ''),
       ('tablet', 'Tablet', 'tablet', '', 'header', '');


-- --------------------------------------------------------

--
-- Table structure for table `{DB_PREFIX}modules`
--

CREATE TABLE IF NOT EXISTS `{DB_PREFIX}modules`
(
    `md_id`     int(10) unsigned NOT NULL AUTO_INCREMENT,
    `md_name`   varchar(40)      NOT NULL,
    `md_status` enum ('enable', 'disable') DEFAULT 'disable',
    PRIMARY KEY (`md_id`, `md_name`)
)
    ENGINE = InnoDB
    DEFAULT CHARSET = utf8mb4;

--
-- Dumping data for table `{DB_PREFIX}modules`
--

INSERT INTO `{DB_PREFIX}modules` (`md_id`, `md_name`, `md_status`)
VALUES (null, 'core', 'enable'),
       (null, 'office', 'enable'),
       (null, 'services', 'enable');

-- --------------------------------------------------------

--
-- Table structure for table `{DB_PREFIX}permissions`
--

CREATE TABLE IF NOT EXISTS `{DB_PREFIX}permissions`
(
    `id_permission` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `permission`    varchar(100)     NOT NULL,
    `key`           varchar(50)      NOT NULL,
    `PKID`          varchar(10)      NOT NULL,
    PRIMARY KEY (`id_permission`)
)
    ENGINE = InnoDB
    DEFAULT CHARSET = utf8mb4;

--
-- Dumping data for table `{DB_PREFIX}permissions`
--

INSERT INTO `{DB_PREFIX}permissions` (`id_permission`, `permission`, `key`, `PKID`)
VALUES (null, 'Super User', 'root_access', 'PKRTACSS'),
       (null, 'Administration', 'admin_access', 'PKADMNAC'),
       (null, 'Add new site content', 'new_content', 'PKADNCNT'),
       (null, 'Edit site content', 'edit_content', 'PKEDTCNT'),
       (null, 'Delete site content', 'delete_content', 'PKDLTCNT'),
       (null, 'Add New Permission', 'new_permission', 'PKADNPRM'),
       (null, 'Delete permission', 'delete_permission', 'PKDLTPRM'),
       (null, 'Add new role', 'new_role', 'PKADNRLE'),
       (null, 'Edit role', 'edit_role', 'PKEDTRLE'),
       (null, 'Delete role', 'delete_role', 'PKDLTRLE'),
       (null, 'Add new User', 'new_user', 'PKADNUSR'),
       (null, 'Manage users', 'mangage_users', 'PKMNGUSR'),
       (null, 'System Security', 'S_S', 'PKSYSSEC'),
       (null, 'System Update', 'system_update', 'PKSYUPDT'),
       (null, 'System access', 'system_access', 'PKSYSACC'),
       (null, 'Add Product Item', 'add_product_item', 'PKADPDIT'),
       (null, 'Get Product Item', 'get_product_item', 'PKGTPDIT'),
       (null, 'Edit Product Item', 'edit_product_item', 'PKEDPDIT'),
       (null, 'Delete Product Item', 'delete_product_item', 'PKDLPDIT'),
       (null, 'Add Product Brand', 'add_product_brand', 'PKADPDBR'),
       (null, 'Get Product Brand', 'get_product_brand', 'PKGTPDBR'),
       (null, 'Edit Product Brand', 'edit_product_brand', 'PKEDPDBR'),
       (null, 'Delete Product Brand', 'delete_product_brand', 'PKDLPDBR'),
       (null, 'Add Product Details', 'add_product_details', 'PKADPRDT'),
       (null, 'Get Product Details', 'get_product_details', 'PKGTPRDT'),
       (null, 'Edit Product Details', 'edit_product_details', 'PKEDPRDT'),
       (null, 'Delete Product Details', 'delete_product_details', 'PKDLPRDT'),
       (null, 'Add Clients Invoice', 'add_clients_invoice', 'PKADCLIN'),
       (null, 'Get Clients Invoice', 'get_clients_invoice', 'PKGTCLIN'),
       (null, 'Edit Clients Invoice', 'edit_clients_invoice', 'PKEDCLIN'),
       (null, 'Delete Clients Invoice', 'delete_clients_invoice', 'PKDLCLIN');

-- --------------------------------------------------------

--
-- Table structure for table `{DB_PREFIX}permissions_role`
--

CREATE TABLE IF NOT EXISTS `{DB_PREFIX}permissions_role`
(
    `role`       int(10)    NOT NULL,
    `permission` int(11)    NOT NULL,
    `value`      tinyint(4) NOT NULL,
    PRIMARY KEY (`role`, `permission`)
)
    ENGINE = InnoDB
    DEFAULT CHARSET = utf8mb4;

--
-- Dumping data for table `{DB_PREFIX}permissions_role`
--

INSERT INTO `{DB_PREFIX}permissions_role` (`role`, `permission`, `value`)
VALUES (1, 1, 1),
       (1, 2, 1),
       (1, 3, 1),
       (1, 4, 1),
       (1, 5, 1),
       (1, 6, 1),
       (1, 7, 1),
       (1, 8, 1),
       (1, 9, 1),
       (1, 10, 1),
       (1, 11, 1),
       (1, 12, 1),
       (1, 13, 1),
       (1, 14, 1),
       (2, 1, 0),
       (2, 2, 1),
       (2, 3, 1),
       (2, 4, 1),
       (2, 5, 1),
       (2, 6, 1),
       (2, 7, 1),
       (2, 8, 1),
       (2, 9, 1),
       (2, 10, 1),
       (2, 12, 1),
       (2, 13, 1),
       (2, 14, 1),
       (4, 1, 0),
       (4, 2, 0),
       (4, 3, 1),
       (4, 4, 1),
       (4, 5, 1),
       (5, 1, 0),
       (5, 2, 0),
       (5, 6, 1),
       (5, 7, 1),
       (5, 8, 1),
       (1, 15, 1),
       (1, 16, 1),
       (1, 17, 1),
       (2, 15, 1),
       (2, 16, 1),
       (2, 17, 1),
       (1, 18, 1),
       (1, 20, 1),
       (1, 19, 1),
       (2, 18, 1),
       (2, 19, 1),
       (2, 20, 1),
       (2, 21, 1),
       (1, 21, 1),
       (2, 22, 1),
       (2, 23, 1),
       (1, 22, 1),
       (1, 23, 1),
       (2, 32, 1),
       (1, 26, 1),
       (1, 27, 1),
       (1, 28, 1),
       (2, 26, 1),
       (2, 27, 1),
       (2, 28, 1),
       (1, 24, 1),
       (1, 29, 1),
       (1, 30, 1),
       (1, 31, 1),
       (2, 31, 1),
       (2, 30, 1),
       (2, 29, 1),
       (2, 24, 1),
       (3, 31, 1),
       (3, 30, 1),
       (3, 28, 1),
       (3, 27, 1),
       (3, 26, 1),
       (3, 29, 1),
       (3, 24, 1),
       (3, 23, 1),
       (3, 22, 1),
       (3, 21, 1),
       (2, 25, 1);

-- --------------------------------------------------------

--
-- Table structure for table `{DB_PREFIX}permissions_user`
--

CREATE TABLE IF NOT EXISTS `{DB_PREFIX}permissions_user`
(
    `user`       int(10)    NOT NULL AUTO_INCREMENT,
    `permission` int(11)    NOT NULL,
    `value`      tinyint(4) NOT NULL,
    PRIMARY KEY (`user`, `permission`)
)
    ENGINE = InnoDB
    DEFAULT CHARSET = utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `{DB_PREFIX}productdetails`
--

CREATE TABLE IF NOT EXISTS `{DB_PREFIX}productdetails`
(
    `id`                  int(11)                           NOT NULL AUTO_INCREMENT,
    `branch`              int(11)                           NOT NULL,
    `item`                int(11)                           NOT NULL,
    `brand`               int(11)                           NOT NULL,
    `model`               varchar(100)                      NOT NULL,
    `serial`              varchar(100)                      NOT NULL,
    `price`               int(11)                           NOT NULL,
    `warranty`            varchar(100)                      NOT NULL,
    `ability`             enum ('available', 'unavailable') NOT NULL,
    `CreatedUserID`       int(11)                           NOT NULL,
    `CreatedUserUsername` varchar(100)                      NOT NULL,
    `CreatedUserFullName` varchar(100)                      NOT NULL,
    `CreatedTime`         varchar(40)                       NOT NULL,
    PRIMARY KEY (`id`)
)
    ENGINE = InnoDB
    DEFAULT CHARSET = utf8mb4;

-- --------------------------------------------------------
--
-- Table structure for table `{DB_PREFIX}roles`
--

CREATE TABLE IF NOT EXISTS `{DB_PREFIX}roles`
(
    `id_role` int(10)      NOT NULL AUTO_INCREMENT,
    `role`    varchar(100) NOT NULL,
    PRIMARY KEY (`id_role`)
)
    ENGINE = InnoDB
    DEFAULT CHARSET = utf8mb4;

--
-- Dumping data for table `{DB_PREFIX}roles`
--

INSERT INTO `{DB_PREFIX}roles` (`id_role`, `role`)
VALUES (null, 'Super User'),
       (null, 'Administrator'),
       (null, 'Stuff'),
       (null, 'Client');

-- --------------------------------------------------------

--
-- Table structure for table `{DB_PREFIX}webapp`
--

CREATE TABLE IF NOT EXISTS `{DB_PREFIX}webapp`
(
    `id`             int(10)      NOT NULL AUTO_INCREMENT,
    `name`           text         NOT NULL,
    `description`    text         NOT NULL,
    `company`        text         NOT NULL,
    `doc_root`       text         NOT NULL,
    `http_host_name` VARCHAR(200) NOT NULL,
    `http_host_add`  text         NOT NULL,
    `http_host_ip`   text         NOT NULL,
    `default_home`   text         NOT NULL,
    `default_layout` varchar(50)  NOT NULL,
    `icon_dir`       text         NOT NULL,
    `favicon`        varchar(50)  NOT NULL,
    PRIMARY KEY (`id`)
)
    ENGINE = InnoDB
    DEFAULT CHARSET = utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `{DB_PREFIX}themes`
--

CREATE TABLE IF NOT EXISTS `{DB_PREFIX}themes`
(
    `id`       int(11)                           NOT NULL AUTO_INCREMENT,
    `name`     varchar(20) CHARACTER SET utf8mb4 NOT NULL,
    `status`   enum ('enable', 'disable')        NOT NULL,
    `ins_time` datetime                          NOT NULL,
    PRIMARY KEY (`id`)
)
    ENGINE = InnoDB
    DEFAULT CHARSET = utf8mb4;

--
-- Dumping data for table `{DB_PREFIX}themes`
--

INSERT INTO `{DB_PREFIX}themes` (`id`, `name`, `status`, `ins_time`)
VALUES (null, 'default', 'enable', now());

-- -----------------------------------------------------

--
-- table structure for table tools
--

CREATE TABLE IF NOT EXISTS `{DB_PREFIX}tools`
(
    `id`    int(11)                                 NOT NULL AUTO_INCREMENT,
    `name`  varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
    `title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
    `url`   varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
    PRIMARY KEY (`id`)
)
    ENGINE = InnoDB
    DEFAULT CHARSET = utf8mb4;

-- -----------------------------------------------------

--
-- table structure for table {DB_PREFIX}trackActivities
--

CREATE TABLE IF NOT EXISTS `{DB_PREFIX}trackActivities`
(
    `id`           int(11)                                 NOT NULL AUTO_INCREMENT,
    `author`       varchar(40) COLLATE utf8mb4_unicode_ci  NOT NULL,
    `ip`           varchar(40) COLLATE utf8mb4_unicode_ci  NOT NULL,
    `country`      varchar(60) COLLATE utf8mb4_unicode_ci  NOT NULL,
    `location`     text COLLATE utf8mb4_unicode_ci         NOT NULL,
    `OS`           varchar(60) COLLATE utf8mb4_unicode_ci  NOT NULL,
    `browser`      varchar(40) COLLATE utf8mb4_unicode_ci  NOT NULL,
    `vstatus`      varchar(30) COLLATE utf8mb4_unicode_ci  NOT NULL,
    `message_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
    `message`      text COLLATE utf8mb4_unicode_ci         NOT NULL,
    `page`         text COLLATE utf8mb4_unicode_ci         NOT NULL,
    `page_title`   text COLLATE utf8mb4_unicode_ci         NOT NULL,
    `time`         varchar(40) COLLATE utf8mb4_unicode_ci  NOT NULL,
    `status`       int(11)                                 NOT NULL,
    PRIMARY KEY (`id`)
)
    ENGINE = InnoDB
    DEFAULT CHARSET = utf8mb4;

-- ---------------------------------------------------------

--
-- Table structure for table `{DB_PREFIX}trackSystemUpdate`
--

CREATE TABLE IF NOT EXISTS `{DB_PREFIX}trackSystemUpdate`
(
    `id`      int(11)                                NOT NULL AUTO_INCREMENT,
    `name`    varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
    `message` text COLLATE utf8mb4_unicode_ci        NOT NULL,
    `file`    text COLLATE utf8mb4_unicode_ci        NOT NULL,
    `time`    varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
    PRIMARY KEY (`id`)
)
    ENGINE = InnoDB
    DEFAULT CHARSET = utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `{DB_PREFIX}visitor`
--

CREATE TABLE IF NOT EXISTS `{DB_PREFIX}trackVisitors`
(
    `vIP`        varchar(30) NOT NULL,
    `vTotalHits` varchar(100) DEFAULT NULL,
    PRIMARY KEY (`vIP`)
)
    ENGINE = InnoDB
    DEFAULT CHARSET = utf8mb4;

-- ----------------------------------------------------------

--
-- table structure for table users log details
--

CREATE TABLE IF NOT EXISTS `{DB_PREFIX}userslog_details`
(
    `id`         int(11)           NOT NULL AUTO_INCREMENT,
    `userID`     int(11)           NOT NULL,
    `lastLogIn`  varchar(20) CHARACTER SET utf8mb4
        COLLATE utf8mb4_unicode_ci NOT NULL,
    `lastLogOut` varchar(20) CHARACTER SET utf8mb4
        COLLATE utf8mb4_unicode_ci NOT NULL,
    PRIMARY KEY (`id`)
)
    ENGINE = InnoDB
    DEFAULT CHARSET = utf8mb4;

-- --------------------------------------------------------