/*MYSQL için gerekli olan kodlar aşağıdadır..


*/
select id, name, lastname, level FROM users
/* users tablosu için gerekli olan create */
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(255) NOT NULL AUTO_INCREMENT,
  
  `robotname` varchar(50) NOT NULL,
  `robotid` int(11) NOT NULL,
  `axisno` tinyint(1) NOT NULL,
  `value` int(11) NOT NULL,
  `interval` datetime NOT NULL,
  PRIMARY KEY (`id`)
)  DEFAULT CHARSET=utf8;