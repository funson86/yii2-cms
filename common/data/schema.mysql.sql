create table `auth_rule`
(
  `name` varchar(64) not null,
  `data` text,
  `created_at` integer,
  `updated_at` integer,
  primary key (`name`)
) engine InnoDB;

create table `auth_item`
(
  `name` varchar(64) not null,
  `type` integer not null,
  `description` text,
  `rule_name` varchar(64),
  `data` text,
  `created_at` integer,
  `updated_at` integer,
  primary key (`name`),
  foreign key (`rule_name`) references `auth_rule` (`name`) on delete set null on update cascade,
  key `type` (`type`)
) engine InnoDB;

create table `auth_item_child`
(
  `parent` varchar(64) not null,
  `child` varchar(64) not null,
  primary key (`parent`, `child`),
  foreign key (`parent`) references `auth_item` (`name`) on delete cascade on update cascade,
  foreign key (`child`) references `auth_item` (`name`) on delete cascade on update cascade
) engine InnoDB;

create table `auth_assignment`
(
  `item_name` varchar(64) not null,
  `user_id` varchar(64) not null,
  `created_at` integer,
  primary key (`item_name`, `user_id`),
  foreign key (`item_name`) references `auth_item` (`name`) on delete cascade on update cascade
) engine InnoDB;

CREATE TABLE `region` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT '名称',
  `parent_id` int(10) unsigned NOT NULL COMMENT '上级名称',
  `postcode` varchar(10) NOT NULL COMMENT '邮编',
  `sort_order` int(11) NOT NULL DEFAULT '100' COMMENT '排序',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='地区表' AUTO_INCREMENT=1;
