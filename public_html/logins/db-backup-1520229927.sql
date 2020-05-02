DROP TABLE tbl_auth;

CREATE TABLE `tbl_auth` (
  `auth_id` int(11) NOT NULL AUTO_INCREMENT,
  `profile_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `type` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`auth_id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

INSERT INTO tbl_auth VALUES("1","0","Administrator","admin@gmail.com","YWRtaW5AMTIz","ADMIN","2018-02-19 15:38:19");
INSERT INTO tbl_auth VALUES("2","1","Pramod batodiya","p.batodiya@gmail.com","cHJhbW9kXzEy","CLIENT","2018-02-19 17:36:46");
INSERT INTO tbl_auth VALUES("3","1","Manager","batodiya.pramod@gmail.com","MnYweHBmNGRxNA==","MANAGER","2018-02-19 17:40:15");
INSERT INTO tbl_auth VALUES("5","1","pramod","p.batodiya@gmail.com","c250YnQ1dzhmZA==","CANDIDATE","2018-02-19 17:57:13");
INSERT INTO tbl_auth VALUES("6","2","James Bond","p.batodiya@gmail.com","c3Z1aHptNzhuNQ==","CANDIDATE","2018-02-19 18:20:01");
INSERT INTO tbl_auth VALUES("7","3","P lowanshi Batodiya","p.batodiya@gmail.com","bmYweDJ1ZTM0NA==","CANDIDATE","2018-02-19 19:13:32");
INSERT INTO tbl_auth VALUES("8","3","Debri","debri@ahonline.co","MTIzNDU=","CLIENT","2018-02-19 19:19:32");
INSERT INTO tbl_auth VALUES("9","4","Debri van Wyk","debri@ahonline.co","YmF4bXc0cnEyMw==","CANDIDATE","2018-02-19 19:25:11");
INSERT INTO tbl_auth VALUES("10","5","Debri van Wyk","debri@ahonline.co","dWJ0dXZqbWEwZQ==","CANDIDATE","2018-02-19 19:26:01");
INSERT INTO tbl_auth VALUES("11","6","Testing ts","test@ahonline.co","Z25vbnIwdmV2aA==","CANDIDATE","2018-02-19 19:31:22");
INSERT INTO tbl_auth VALUES("12","7","debri van","van@ahonline.co","eXBndnBubjNzNg==","CANDIDATE","2018-02-19 19:33:40");
INSERT INTO tbl_auth VALUES("13","8","Test test","test@ahonline.co","ZG4yMHp2ajRtbg==","CANDIDATE","2018-02-19 19:35:23");
INSERT INTO tbl_auth VALUES("14","2","John Small","john@ahonline.co","MTIzNDU=","MANAGER","2018-02-19 19:42:50");
INSERT INTO tbl_auth VALUES("15","9","Leanda Strydom","leanda@ahonline.co","ODI3NG1yNzg0OA==","CANDIDATE","2018-02-20 09:51:16");
INSERT INTO tbl_auth VALUES("16","4","Debri van Wyk","dvanwyk@ih.co.za","cndnYnZ4czcwNQ==","CLIENT","2018-02-21 12:04:39");
INSERT INTO tbl_auth VALUES("17","10","Candice Norton","candicen@renault.co.za","M2loNWcydWd0aw==","CANDIDATE","2018-02-21 12:07:18");
INSERT INTO tbl_auth VALUES("18","11","Debri van wyk","debri@hctalent.co.za","cW5nenNldm01cQ==","CANDIDATE","2018-02-21 12:11:15");
INSERT INTO tbl_auth VALUES("19","12","debri vam wyk","debri@ahonline.co","OHZ0ZGI1bjA1Zg==","CANDIDATE","2018-02-21 12:53:19");
INSERT INTO tbl_auth VALUES("21","3","test","test@gmail.com","MGc3a2h5YjR4OA==","MANAGER","2018-02-21 13:11:00");
INSERT INTO tbl_auth VALUES("22","13","test","test1@gmail.com","OGNkdGU1bmF4cA==","CANDIDATE","2018-02-21 13:11:45");
INSERT INTO tbl_auth VALUES("23","14","pankaj savani","pcsavani@gmail.com","bno3dzV2eXFoaw==","CANDIDATE","2018-02-21 13:55:10");
INSERT INTO tbl_auth VALUES("24","4","kc savani","kcsavani1990@gmail.com","d3hhc2Q3ajVqcA==","MANAGER","2018-02-21 13:57:01");
INSERT INTO tbl_auth VALUES("25","15","James Bond-00007","p.batodiya@gmail.com","b2JiOHlvMGdlaQ==","CANDIDATE","2018-02-21 16:41:38");
INSERT INTO tbl_auth VALUES("26","16","Pramod  batodiya","p.batodiya@gmail.com","ZDRjN2NvcmNjag==","CANDIDATE","2018-02-22 11:13:44");
INSERT INTO tbl_auth VALUES("27","17","Maxine Adams","maxine.adams@hrst.co.za","aXY2MGpib3VvcQ==","CANDIDATE","2018-02-22 16:31:37");
INSERT INTO tbl_auth VALUES("28","18","John Smit","john@ahonline.co","MHl1amNjMHB3NQ==","CANDIDATE","2018-02-22 16:31:37");
INSERT INTO tbl_auth VALUES("29","19","P batodiya ","p.batodiya@gmail.com","Y25vcGpydWtkbw==","CANDIDATE","2018-02-22 17:54:53");
INSERT INTO tbl_auth VALUES("30","20","facbook","p.batodiya@gmail.com","a3QzNm1qZnFldA==","CANDIDATE","2018-02-22 17:57:16");
INSERT INTO tbl_auth VALUES("34","21","Debri van Wyk","dvanwyk@ih.co.za","c2JibTV6aW1uNw==","CANDIDATE","2018-02-22 20:13:19");
INSERT INTO tbl_auth VALUES("35","9","Candice Norton","candicen@renault.co.za","Mzd5NnY4MDgyMw==","CLIENT","2018-02-23 14:01:12");
INSERT INTO tbl_auth VALUES("36","22","James Bond","p.batodiya@gmail.com","bWVjcnprdWllaA==","CANDIDATE","2018-02-23 16:16:03");
INSERT INTO tbl_auth VALUES("37","23","pramod bATODIYA","p.batodiya@gmail.com","MzZ6NnM1YWZiMw==","CANDIDATE","2018-02-23 16:29:56");
INSERT INTO tbl_auth VALUES("38","24","Test User","p.batodiya@gmail.com","cHR4bXR4cjh5YQ==","CANDIDATE","2018-02-25 07:59:03");
INSERT INTO tbl_auth VALUES("39","10","Client Test","client@ahonline.co","cTh3ZzNiMDV0bg==","CLIENT","2018-02-25 15:50:37");
INSERT INTO tbl_auth VALUES("40","5","Manager Test","manager@ahonline.co","NGRxa3BoM2Jleg==","MANAGER","2018-02-25 15:56:04");
INSERT INTO tbl_auth VALUES("41","25","Candidate Test","candidate@ahonline.co","Y29pZ3VpeHpxYg==","CANDIDATE","2018-02-25 15:56:40");
INSERT INTO tbl_auth VALUES("42","26","James Bond","p.batodiya@gmail.com","ZXBpMm1ra2R5NA==","CANDIDATE","2018-02-27 14:09:43");
INSERT INTO tbl_auth VALUES("43","27","Candice Norton","CandiceN@renault.co.za","aThycW04aHY1Mw==","CANDIDATE","2018-03-02 13:14:21");



DROP TABLE tbl_candidate;

CREATE TABLE `tbl_candidate` (
  `candidate_id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` text NOT NULL,
  `phone` varchar(15) NOT NULL,
  `image` text NOT NULL,
  `id` text NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(15) NOT NULL,
  `age` int(11) NOT NULL,
  `nationality` text NOT NULL,
  `ethnicity` text NOT NULL,
  `highest_education` text NOT NULL,
  `marital_status` text NOT NULL,
  `employeement_status` text NOT NULL,
  `home_language` text NOT NULL,
  `current_job_level` text NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`candidate_id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

INSERT INTO tbl_candidate VALUES("1","2","pramod","Batodiya","p.batodiya@gmail.com","12121212","","123456789","2018-02-19","male","20","ZAF","white","high_school","single_never_married","employed_full_time","other","administration/entry_level","1","2018-02-19 17:57:13");
INSERT INTO tbl_candidate VALUES("2","2","James","Bond","p.batodiya@gmail.com","21121212121","","1212121","2018-02-12","male","20","ZAF","white","high_school","single_never_married","employed_full_time","other","administration/entry_level","1","2018-02-19 18:20:01");
INSERT INTO tbl_candidate VALUES("3","2","P lowanshi","Batodiya","p.batodiya@gmail.com","212121","","212121","2018-02-19","male","20","ZAF","white","high_school","single_never_married","employed_full_time","other","administration/entry_level","1","2018-02-19 19:13:32");
INSERT INTO tbl_candidate VALUES("4","8","Debri","van Wyk","debri@ahonline.co","000000","","00000","1979-01-17","male","39","ZAF","white","high_school","single_never_married","employed_full_time","other","administration/entry_level","1","2018-02-19 19:25:11");
INSERT INTO tbl_candidate VALUES("5","8","Debri","van Wyk","debri@ahonline.co","00000","","000000","2010-03-10","male","7","ZAF","white","high_school","single_never_married","employed_full_time","other","administration/entry_level","1","2018-02-19 19:26:01");
INSERT INTO tbl_candidate VALUES("6","8","Testing","ts","test@ahonline.co","00000","","000000","1979-01-01","male","39","ZAF","white","high_school","single_never_married","employed_full_time","other","administration/entry_level","1","2018-02-19 19:31:22");
INSERT INTO tbl_candidate VALUES("7","8","debri","van","van@ahonline.co","0000","","00000","2015-07-08","male","2","ZAF","white","high_school","single_never_married","employed_full_time","other","administration/entry_level","1","2018-02-19 19:33:40");
INSERT INTO tbl_candidate VALUES("8","8","Test","test","test@ahonline.co","0000","","0000","2013-07-10","male","4","ZAF","white","high_school","single_never_married","employed_full_time","other","administration/entry_level","1","2018-02-19 19:35:23");
INSERT INTO tbl_candidate VALUES("9","8","Leanda","Strydom","leanda@ahonline.co","0000","","00000","0000-00-00","female","76","ZAF","white","high_school","single_never_married","employed_full_time","other","administration/entry_level","1","2018-02-20 09:51:16");
INSERT INTO tbl_candidate VALUES("10","16","Candice","Norton","candicen@renault.co.za","0722462641","","8202050240088","0000-00-00","female","36","ZAF","coloured","high_school","single_never_married","employed_full_time","english","administration/entry_level","1","2018-02-21 12:07:18");
INSERT INTO tbl_candidate VALUES("11","16","Debri","van wyk","debri@hctalent.co.za","0000","","0000","0000-00-00","male","2","ZAF","white","high_school","single_never_married","employed_full_time","other","administration/entry_level","1","2018-02-21 12:11:15");
INSERT INTO tbl_candidate VALUES("12","16","debri","vam wyk","debri@ahonline.co","00000","","00000","0000-00-00","male","10","ZAF","white","high_school","single_never_married","employed_full_time","other","administration/entry_level","1","2018-02-21 12:53:19");
INSERT INTO tbl_candidate VALUES("13","20","test","","test1@gmail.com","","","","0000-00-00","","0","","","","","","","","0","2018-02-21 13:11:45");
INSERT INTO tbl_candidate VALUES("14","20","pankaj","savani","pcsavani@gmail.com","9033945303","","601078379966926","0000-00-00","male","9","ZAF","white","high_school","single_never_married","employed_full_time","english","administration/entry_level","1","2018-02-21 13:55:10");
INSERT INTO tbl_candidate VALUES("15","2","James","Bond-00007","p.batodiya@gmail.com","12121212","","21212","0000-00-00","male","12","ZAF","white","high_school","single_never_married","employed_full_time","other","administration/entry_level","1","2018-02-21 16:41:38");
INSERT INTO tbl_candidate VALUES("16","2","Pramod","batodiya","p.batodiya@gmail.com","12233","","1233","0000-00-00","male","28","ZAF","white","high_school","single_never_married","employed_full_time","other","administration/entry_level","1","2018-02-22 11:13:44");
INSERT INTO tbl_candidate VALUES("17","16","Maxine","Adams","maxine.adams@hrst.co.za","","","","0000-00-00","","0","","","","","","","","0","2018-02-22 16:31:37");
INSERT INTO tbl_candidate VALUES("18","16","John","Smit","john@ahonline.co","","","","0000-00-00","","0","","","","","","","","0","2018-02-22 16:31:37");
INSERT INTO tbl_candidate VALUES("19","2","P","batodiya","p.batodiya@gmail.com","12323356959","","1223444544","0000-00-00","male","19","ZAF","white","high_school","single_never_married","employed_full_time","other","administration/entry_level","1","2018-02-22 17:54:53");
INSERT INTO tbl_candidate VALUES("20","2","facbook","ID","p.batodiya@gmail.com","2121212","","212121","0000-00-00","male","20","ZAF","white","high_school","single_never_married","employed_full_time","other","administration/entry_level","1","2018-02-22 17:57:16");
INSERT INTO tbl_candidate VALUES("21","16","Debri","van Wyk","dvanwyk@ih.co.za","000","","00000","0000-00-00","male","3","ZAF","white","high_school","single_never_married","employed_full_time","other","administration/entry_level","1","2018-02-22 20:13:19");
INSERT INTO tbl_candidate VALUES("22","2","James","Bond","p.batodiya@gmail.com","21212121","","21212","0000-00-00","male","20","ZAF","white","high_school","single_never_married","employed_full_time","other","administration/entry_level","1","2018-02-23 16:16:03");
INSERT INTO tbl_candidate VALUES("23","2","pramod","bATODIYA","p.batodiya@gmail.com","9993755651","","1218141478297331","0000-00-00","male","26","ZAF","white","high_school","single_never_married","employed_full_time","other","administration/entry_level","1","2018-02-23 16:29:56");
INSERT INTO tbl_candidate VALUES("24","2","Test","User","p.batodiya@gmail.com","1233212","","453667248160658","0000-00-00","male","10","ZAF","white","high_school","single_never_married","employed_full_time","other","administration/entry_level","1","2018-02-25 07:59:03");
INSERT INTO tbl_candidate VALUES("25","39","Candidate","Test","candidate@ahonline.co","0000","","00000","0000-00-00","male","38","ZAF","white","high_school","single_never_married","employed_full_time","other","administration/entry_level","1","2018-02-25 15:56:40");
INSERT INTO tbl_candidate VALUES("26","2","James","Bond","p.batodiya@gmail.com","1234556","","453667248160658","0000-00-00","male","20","ZAF","white","high_school","single_never_married","employed_full_time","other","administration/entry_level","1","2018-02-27 14:09:43");
INSERT INTO tbl_candidate VALUES("27","39","Candice","Norton","CandiceN@renault.co.za","","","","0000-00-00","","0","","","","","","","","0","2018-03-02 13:14:21");



DROP TABLE tbl_client;

CREATE TABLE `tbl_client` (
  `client_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) NOT NULL,
  `client` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` text NOT NULL,
  `credits` varchar(50) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

INSERT INTO tbl_client VALUES("1","1","Vox Rein","Pramod batodiya","p.batodiya@gmail.com","123456","Address","20","1","2018-02-19 17:36:46");
INSERT INTO tbl_client VALUES("3","1","AssessmentHouse","Debri","debri@ahonline.co","0000000","adres","90","1","2018-02-19 19:19:32");
INSERT INTO tbl_client VALUES("4","1","Renault","Debri van Wyk","dvanwyk@ih.co.za","000","Address","95","1","2018-02-21 12:04:39");
INSERT INTO tbl_client VALUES("9","1","Renault Bedfordview","Candice Norton","candicen@renault.co.za","0000000","Address","100","1","2018-02-23 14:01:12");
INSERT INTO tbl_client VALUES("10","1","AssessmentHouse Home","Client Test","client@ahonline.co","000","000","95","1","2018-02-25 15:50:37");



DROP TABLE tbl_countries;

CREATE TABLE `tbl_countries` (
  `num_code` int(3) NOT NULL DEFAULT '0',
  `alpha_2_code` varchar(2) DEFAULT NULL,
  `alpha_3_code` varchar(3) DEFAULT NULL,
  `en_short_name` varchar(52) DEFAULT NULL,
  `nationality` varchar(39) DEFAULT NULL,
  PRIMARY KEY (`num_code`),
  UNIQUE KEY `alpha_2_code` (`alpha_2_code`),
  UNIQUE KEY `alpha_3_code` (`alpha_3_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO tbl_countries VALUES("4","AF","AFG","Afghanistan","Afghan");
INSERT INTO tbl_countries VALUES("8","AL","ALB","Albania","Albanian");
INSERT INTO tbl_countries VALUES("10","AQ","ATA","Antarctica","Antarctic");
INSERT INTO tbl_countries VALUES("12","DZ","DZA","Algeria","Algerian");
INSERT INTO tbl_countries VALUES("16","AS","ASM","American Samoa","American Samoan");
INSERT INTO tbl_countries VALUES("20","AD","AND","Andorra","Andorran");
INSERT INTO tbl_countries VALUES("24","AO","AGO","Angola","Angolan");
INSERT INTO tbl_countries VALUES("28","AG","ATG","Antigua and Barbuda","Antiguan or Barbudan");
INSERT INTO tbl_countries VALUES("31","AZ","AZE","Azerbaijan","Azerbaijani, Azeri");
INSERT INTO tbl_countries VALUES("32","AR","ARG","Argentina","Argentine");
INSERT INTO tbl_countries VALUES("36","AU","AUS","Australia","Australian");
INSERT INTO tbl_countries VALUES("40","AT","AUT","Austria","Austrian");
INSERT INTO tbl_countries VALUES("44","BS","BHS","Bahamas","Bahamian");
INSERT INTO tbl_countries VALUES("48","BH","BHR","Bahrain","Bahraini");
INSERT INTO tbl_countries VALUES("50","BD","BGD","Bangladesh","Bangladeshi");
INSERT INTO tbl_countries VALUES("51","AM","ARM","Armenia","Armenian");
INSERT INTO tbl_countries VALUES("52","BB","BRB","Barbados","Barbadian");
INSERT INTO tbl_countries VALUES("56","BE","BEL","Belgium","Belgian");
INSERT INTO tbl_countries VALUES("60","BM","BMU","Bermuda","Bermudian, Bermudan");
INSERT INTO tbl_countries VALUES("64","BT","BTN","Bhutan","Bhutanese");
INSERT INTO tbl_countries VALUES("68","BO","BOL","Bolivia (Plurinational State of)","Bolivian");
INSERT INTO tbl_countries VALUES("70","BA","BIH","Bosnia and Herzegovina","Bosnian or Herzegovinian");
INSERT INTO tbl_countries VALUES("72","BW","BWA","Botswana","Motswana, Botswanan");
INSERT INTO tbl_countries VALUES("74","BV","BVT","Bouvet Island","Bouvet Island");
INSERT INTO tbl_countries VALUES("76","BR","BRA","Brazil","Brazilian");
INSERT INTO tbl_countries VALUES("84","BZ","BLZ","Belize","Belizean");
INSERT INTO tbl_countries VALUES("86","IO","IOT","British Indian Ocean Territory","BIOT");
INSERT INTO tbl_countries VALUES("90","SB","SLB","Solomon Islands","Solomon Island");
INSERT INTO tbl_countries VALUES("92","VG","VGB","Virgin Islands (British)","British Virgin Island");
INSERT INTO tbl_countries VALUES("96","BN","BRN","Brunei Darussalam","Bruneian");
INSERT INTO tbl_countries VALUES("100","BG","BGR","Bulgaria","Bulgarian");
INSERT INTO tbl_countries VALUES("104","MM","MMR","Myanmar","Burmese");
INSERT INTO tbl_countries VALUES("108","BI","BDI","Burundi","Burundian");
INSERT INTO tbl_countries VALUES("112","BY","BLR","Belarus","Belarusian");
INSERT INTO tbl_countries VALUES("116","KH","KHM","Cambodia","Cambodian");
INSERT INTO tbl_countries VALUES("120","CM","CMR","Cameroon","Cameroonian");
INSERT INTO tbl_countries VALUES("124","CA","CAN","Canada","Canadian");
INSERT INTO tbl_countries VALUES("132","CV","CPV","Cabo Verde","Cabo Verdean");
INSERT INTO tbl_countries VALUES("136","KY","CYM","Cayman Islands","Caymanian");
INSERT INTO tbl_countries VALUES("140","CF","CAF","Central African Republic","Central African");
INSERT INTO tbl_countries VALUES("144","LK","LKA","Sri Lanka","Sri Lankan");
INSERT INTO tbl_countries VALUES("148","TD","TCD","Chad","Chadian");
INSERT INTO tbl_countries VALUES("152","CL","CHL","Chile","Chilean");
INSERT INTO tbl_countries VALUES("156","CN","CHN","China","Chinese");
INSERT INTO tbl_countries VALUES("158","TW","TWN","Taiwan, Province of China","Chinese, Taiwanese");
INSERT INTO tbl_countries VALUES("162","CX","CXR","Christmas Island","Christmas Island");
INSERT INTO tbl_countries VALUES("166","CC","CCK","Cocos (Keeling) Islands","Cocos Island");
INSERT INTO tbl_countries VALUES("170","CO","COL","Colombia","Colombian");
INSERT INTO tbl_countries VALUES("174","KM","COM","Comoros","Comoran, Comorian");
INSERT INTO tbl_countries VALUES("175","YT","MYT","Mayotte","Mahoran");
INSERT INTO tbl_countries VALUES("178","CG","COG","Congo (Republic of the)","Congolese");
INSERT INTO tbl_countries VALUES("180","CD","COD","Congo (Democratic Republic of the)","Congolese");
INSERT INTO tbl_countries VALUES("184","CK","COK","Cook Islands","Cook Island");
INSERT INTO tbl_countries VALUES("188","CR","CRI","Costa Rica","Costa Rican");
INSERT INTO tbl_countries VALUES("191","HR","HRV","Croatia","Croatian");
INSERT INTO tbl_countries VALUES("192","CU","CUB","Cuba","Cuban");
INSERT INTO tbl_countries VALUES("196","CY","CYP","Cyprus","Cypriot");
INSERT INTO tbl_countries VALUES("203","CZ","CZE","Czech Republic","Czech");
INSERT INTO tbl_countries VALUES("204","BJ","BEN","Benin","Beninese, Beninois");
INSERT INTO tbl_countries VALUES("208","DK","DNK","Denmark","Danish");
INSERT INTO tbl_countries VALUES("212","DM","DMA","Dominica","Dominican");
INSERT INTO tbl_countries VALUES("214","DO","DOM","Dominican Republic","Dominican");
INSERT INTO tbl_countries VALUES("218","EC","ECU","Ecuador","Ecuadorian");
INSERT INTO tbl_countries VALUES("222","SV","SLV","El Salvador","Salvadoran");
INSERT INTO tbl_countries VALUES("226","GQ","GNQ","Equatorial Guinea","Equatorial Guinean, Equatoguinean");
INSERT INTO tbl_countries VALUES("231","ET","ETH","Ethiopia","Ethiopian");
INSERT INTO tbl_countries VALUES("232","ER","ERI","Eritrea","Eritrean");
INSERT INTO tbl_countries VALUES("233","EE","EST","Estonia","Estonian");
INSERT INTO tbl_countries VALUES("234","FO","FRO","Faroe Islands","Faroese");
INSERT INTO tbl_countries VALUES("238","FK","FLK","Falkland Islands (Malvinas)","Falkland Island");
INSERT INTO tbl_countries VALUES("239","GS","SGS","South Georgia and the South Sandwich Islands","South Georgia or South Sandwich Islands");
INSERT INTO tbl_countries VALUES("242","FJ","FJI","Fiji","Fijian");
INSERT INTO tbl_countries VALUES("246","FI","FIN","Finland","Finnish");
INSERT INTO tbl_countries VALUES("248","AX","ALA","Åland Islands","Åland Island");
INSERT INTO tbl_countries VALUES("250","FR","FRA","France","French");
INSERT INTO tbl_countries VALUES("254","GF","GUF","French Guiana","French Guianese");
INSERT INTO tbl_countries VALUES("258","PF","PYF","French Polynesia","French Polynesian");
INSERT INTO tbl_countries VALUES("260","TF","ATF","French Southern Territories","French Southern Territories");
INSERT INTO tbl_countries VALUES("262","DJ","DJI","Djibouti","Djiboutian");
INSERT INTO tbl_countries VALUES("266","GA","GAB","Gabon","Gabonese");
INSERT INTO tbl_countries VALUES("268","GE","GEO","Georgia","Georgian");
INSERT INTO tbl_countries VALUES("270","GM","GMB","Gambia","Gambian");
INSERT INTO tbl_countries VALUES("275","PS","PSE","Palestine, State of","Palestinian");
INSERT INTO tbl_countries VALUES("276","DE","DEU","Germany","German");
INSERT INTO tbl_countries VALUES("288","GH","GHA","Ghana","Ghanaian");
INSERT INTO tbl_countries VALUES("292","GI","GIB","Gibraltar","Gibraltar");
INSERT INTO tbl_countries VALUES("296","KI","KIR","Kiribati","I-Kiribati");
INSERT INTO tbl_countries VALUES("300","GR","GRC","Greece","Greek, Hellenic");
INSERT INTO tbl_countries VALUES("304","GL","GRL","Greenland","Greenlandic");
INSERT INTO tbl_countries VALUES("308","GD","GRD","Grenada","Grenadian");
INSERT INTO tbl_countries VALUES("312","GP","GLP","Guadeloupe","Guadeloupe");
INSERT INTO tbl_countries VALUES("316","GU","GUM","Guam","Guamanian, Guambat");
INSERT INTO tbl_countries VALUES("320","GT","GTM","Guatemala","Guatemalan");
INSERT INTO tbl_countries VALUES("324","GN","GIN","Guinea","Guinean");
INSERT INTO tbl_countries VALUES("328","GY","GUY","Guyana","Guyanese");
INSERT INTO tbl_countries VALUES("332","HT","HTI","Haiti","Haitian");
INSERT INTO tbl_countries VALUES("334","HM","HMD","Heard Island and McDonald Islands","Heard Island or McDonald Islands");
INSERT INTO tbl_countries VALUES("336","VA","VAT","Vatican City State","Vatican");
INSERT INTO tbl_countries VALUES("340","HN","HND","Honduras","Honduran");
INSERT INTO tbl_countries VALUES("344","HK","HKG","Hong Kong","Hong Kong, Hong Kongese");
INSERT INTO tbl_countries VALUES("348","HU","HUN","Hungary","Hungarian, Magyar");
INSERT INTO tbl_countries VALUES("352","IS","ISL","Iceland","Icelandic");
INSERT INTO tbl_countries VALUES("356","IN","IND","India","Indian");
INSERT INTO tbl_countries VALUES("360","ID","IDN","Indonesia","Indonesian");
INSERT INTO tbl_countries VALUES("364","IR","IRN","Iran","Iranian, Persian");
INSERT INTO tbl_countries VALUES("368","IQ","IRQ","Iraq","Iraqi");
INSERT INTO tbl_countries VALUES("372","IE","IRL","Ireland","Irish");
INSERT INTO tbl_countries VALUES("376","IL","ISR","Israel","Israeli");
INSERT INTO tbl_countries VALUES("380","IT","ITA","Italy","Italian");
INSERT INTO tbl_countries VALUES("384","CI","CIV","Côte d\'Ivoire","Ivorian");
INSERT INTO tbl_countries VALUES("388","JM","JAM","Jamaica","Jamaican");
INSERT INTO tbl_countries VALUES("392","JP","JPN","Japan","Japanese");
INSERT INTO tbl_countries VALUES("398","KZ","KAZ","Kazakhstan","Kazakhstani, Kazakh");
INSERT INTO tbl_countries VALUES("400","JO","JOR","Jordan","Jordanian");
INSERT INTO tbl_countries VALUES("404","KE","KEN","Kenya","Kenyan");
INSERT INTO tbl_countries VALUES("408","KP","PRK","Korea (Democratic People\'s Republic of)","North Korean");
INSERT INTO tbl_countries VALUES("410","KR","KOR","Korea (Republic of)","South Korean");
INSERT INTO tbl_countries VALUES("414","KW","KWT","Kuwait","Kuwaiti");
INSERT INTO tbl_countries VALUES("417","KG","KGZ","Kyrgyzstan","Kyrgyzstani, Kyrgyz, Kirgiz, Kirghiz");
INSERT INTO tbl_countries VALUES("418","LA","LAO","Lao People\'s Democratic Republic","Lao, Laotian");
INSERT INTO tbl_countries VALUES("422","LB","LBN","Lebanon","Lebanese");
INSERT INTO tbl_countries VALUES("426","LS","LSO","Lesotho","Basotho");
INSERT INTO tbl_countries VALUES("428","LV","LVA","Latvia","Latvian");
INSERT INTO tbl_countries VALUES("430","LR","LBR","Liberia","Liberian");
INSERT INTO tbl_countries VALUES("434","LY","LBY","Libya","Libyan");
INSERT INTO tbl_countries VALUES("438","LI","LIE","Liechtenstein","Liechtenstein");
INSERT INTO tbl_countries VALUES("440","LT","LTU","Lithuania","Lithuanian");
INSERT INTO tbl_countries VALUES("442","LU","LUX","Luxembourg","Luxembourg, Luxembourgish");
INSERT INTO tbl_countries VALUES("446","MO","MAC","Macao","Macanese, Chinese");
INSERT INTO tbl_countries VALUES("450","MG","MDG","Madagascar","Malagasy");
INSERT INTO tbl_countries VALUES("454","MW","MWI","Malawi","Malawian");
INSERT INTO tbl_countries VALUES("458","MY","MYS","Malaysia","Malaysian");
INSERT INTO tbl_countries VALUES("462","MV","MDV","Maldives","Maldivian");
INSERT INTO tbl_countries VALUES("466","ML","MLI","Mali","Malian, Malinese");
INSERT INTO tbl_countries VALUES("470","MT","MLT","Malta","Maltese");
INSERT INTO tbl_countries VALUES("474","MQ","MTQ","Martinique","Martiniquais, Martinican");
INSERT INTO tbl_countries VALUES("478","MR","MRT","Mauritania","Mauritanian");
INSERT INTO tbl_countries VALUES("480","MU","MUS","Mauritius","Mauritian");
INSERT INTO tbl_countries VALUES("484","MX","MEX","Mexico","Mexican");
INSERT INTO tbl_countries VALUES("492","MC","MCO","Monaco","Monégasque, Monacan");
INSERT INTO tbl_countries VALUES("496","MN","MNG","Mongolia","Mongolian");
INSERT INTO tbl_countries VALUES("498","MD","MDA","Moldova (Republic of)","Moldovan");
INSERT INTO tbl_countries VALUES("499","ME","MNE","Montenegro","Montenegrin");
INSERT INTO tbl_countries VALUES("500","MS","MSR","Montserrat","Montserratian");
INSERT INTO tbl_countries VALUES("504","MA","MAR","Morocco","Moroccan");
INSERT INTO tbl_countries VALUES("508","MZ","MOZ","Mozambique","Mozambican");
INSERT INTO tbl_countries VALUES("512","OM","OMN","Oman","Omani");
INSERT INTO tbl_countries VALUES("516","NA","NAM","Namibia","Namibian");
INSERT INTO tbl_countries VALUES("520","NR","NRU","Nauru","Nauruan");
INSERT INTO tbl_countries VALUES("524","NP","NPL","Nepal","Nepali, Nepalese");
INSERT INTO tbl_countries VALUES("528","NL","NLD","Netherlands","Dutch, Netherlandic");
INSERT INTO tbl_countries VALUES("531","CW","CUW","Curaçao","Curaçaoan");
INSERT INTO tbl_countries VALUES("533","AW","ABW","Aruba","Aruban");
INSERT INTO tbl_countries VALUES("534","SX","SXM","Sint Maarten (Dutch part)","Sint Maarten");
INSERT INTO tbl_countries VALUES("535","BQ","BES","Bonaire, Sint Eustatius and Saba","Bonaire");
INSERT INTO tbl_countries VALUES("540","NC","NCL","New Caledonia","New Caledonian");
INSERT INTO tbl_countries VALUES("548","VU","VUT","Vanuatu","Ni-Vanuatu, Vanuatuan");
INSERT INTO tbl_countries VALUES("554","NZ","NZL","New Zealand","New Zealand, NZ");
INSERT INTO tbl_countries VALUES("558","NI","NIC","Nicaragua","Nicaraguan");
INSERT INTO tbl_countries VALUES("562","NE","NER","Niger","Nigerien");
INSERT INTO tbl_countries VALUES("566","NG","NGA","Nigeria","Nigerian");
INSERT INTO tbl_countries VALUES("570","NU","NIU","Niue","Niuean");
INSERT INTO tbl_countries VALUES("574","NF","NFK","Norfolk Island","Norfolk Island");
INSERT INTO tbl_countries VALUES("578","NO","NOR","Norway","Norwegian");
INSERT INTO tbl_countries VALUES("580","MP","MNP","Northern Mariana Islands","Northern Marianan");
INSERT INTO tbl_countries VALUES("581","UM","UMI","United States Minor Outlying Islands","American");
INSERT INTO tbl_countries VALUES("583","FM","FSM","Micronesia (Federated States of)","Micronesian");
INSERT INTO tbl_countries VALUES("584","MH","MHL","Marshall Islands","Marshallese");
INSERT INTO tbl_countries VALUES("585","PW","PLW","Palau","Palauan");
INSERT INTO tbl_countries VALUES("586","PK","PAK","Pakistan","Pakistani");
INSERT INTO tbl_countries VALUES("591","PA","PAN","Panama","Panamanian");
INSERT INTO tbl_countries VALUES("598","PG","PNG","Papua New Guinea","Papua New Guinean, Papuan");
INSERT INTO tbl_countries VALUES("600","PY","PRY","Paraguay","Paraguayan");
INSERT INTO tbl_countries VALUES("604","PE","PER","Peru","Peruvian");
INSERT INTO tbl_countries VALUES("608","PH","PHL","Philippines","Philippine, Filipino");
INSERT INTO tbl_countries VALUES("612","PN","PCN","Pitcairn","Pitcairn Island");
INSERT INTO tbl_countries VALUES("616","PL","POL","Poland","Polish");
INSERT INTO tbl_countries VALUES("620","PT","PRT","Portugal","Portuguese");
INSERT INTO tbl_countries VALUES("624","GW","GNB","Guinea-Bissau","Bissau-Guinean");
INSERT INTO tbl_countries VALUES("626","TL","TLS","Timor-Leste","Timorese");
INSERT INTO tbl_countries VALUES("630","PR","PRI","Puerto Rico","Puerto Rican");
INSERT INTO tbl_countries VALUES("634","QA","QAT","Qatar","Qatari");
INSERT INTO tbl_countries VALUES("638","RE","REU","Réunion","Réunionese, Réunionnais");
INSERT INTO tbl_countries VALUES("642","RO","ROU","Romania","Romanian");
INSERT INTO tbl_countries VALUES("643","RU","RUS","Russian Federation","Russian");
INSERT INTO tbl_countries VALUES("646","RW","RWA","Rwanda","Rwandan");
INSERT INTO tbl_countries VALUES("652","BL","BLM","Saint Barthélemy","Barthélemois");
INSERT INTO tbl_countries VALUES("654","SH","SHN","Saint Helena, Ascension and Tristan da Cunha","Saint Helenian");
INSERT INTO tbl_countries VALUES("659","KN","KNA","Saint Kitts and Nevis","Kittitian or Nevisian");
INSERT INTO tbl_countries VALUES("660","AI","AIA","Anguilla","Anguillan");
INSERT INTO tbl_countries VALUES("662","LC","LCA","Saint Lucia","Saint Lucian");
INSERT INTO tbl_countries VALUES("663","MF","MAF","Saint Martin (French part)","Saint-Martinoise");
INSERT INTO tbl_countries VALUES("666","PM","SPM","Saint Pierre and Miquelon","Saint-Pierrais or Miquelonnais");
INSERT INTO tbl_countries VALUES("670","VC","VCT","Saint Vincent and the Grenadines","Saint Vincentian, Vincentian");
INSERT INTO tbl_countries VALUES("674","SM","SMR","San Marino","Sammarinese");
INSERT INTO tbl_countries VALUES("678","ST","STP","Sao Tome and Principe","São Toméan");
INSERT INTO tbl_countries VALUES("682","SA","SAU","Saudi Arabia","Saudi, Saudi Arabian");
INSERT INTO tbl_countries VALUES("686","SN","SEN","Senegal","Senegalese");
INSERT INTO tbl_countries VALUES("688","RS","SRB","Serbia","Serbian");
INSERT INTO tbl_countries VALUES("690","SC","SYC","Seychelles","Seychellois");
INSERT INTO tbl_countries VALUES("694","SL","SLE","Sierra Leone","Sierra Leonean");
INSERT INTO tbl_countries VALUES("702","SG","SGP","Singapore","Singaporean");
INSERT INTO tbl_countries VALUES("703","SK","SVK","Slovakia","Slovak");
INSERT INTO tbl_countries VALUES("704","VN","VNM","Vietnam","Vietnamese");
INSERT INTO tbl_countries VALUES("705","SI","SVN","Slovenia","Slovenian, Slovene");
INSERT INTO tbl_countries VALUES("706","SO","SOM","Somalia","Somali, Somalian");
INSERT INTO tbl_countries VALUES("710","ZA","ZAF","South Africa","South African");
INSERT INTO tbl_countries VALUES("716","ZW","ZWE","Zimbabwe","Zimbabwean");
INSERT INTO tbl_countries VALUES("724","ES","ESP","Spain","Spanish");
INSERT INTO tbl_countries VALUES("728","SS","SSD","South Sudan","South Sudanese");
INSERT INTO tbl_countries VALUES("729","SD","SDN","Sudan","Sudanese");
INSERT INTO tbl_countries VALUES("732","EH","ESH","Western Sahara","Sahrawi, Sahrawian, Sahraouian");
INSERT INTO tbl_countries VALUES("740","SR","SUR","Suriname","Surinamese");
INSERT INTO tbl_countries VALUES("744","SJ","SJM","Svalbard and Jan Mayen","Svalbard");
INSERT INTO tbl_countries VALUES("748","SZ","SWZ","Swaziland","Swazi");
INSERT INTO tbl_countries VALUES("752","SE","SWE","Sweden","Swedish");
INSERT INTO tbl_countries VALUES("756","CH","CHE","Switzerland","Swiss");
INSERT INTO tbl_countries VALUES("760","SY","SYR","Syrian Arab Republic","Syrian");
INSERT INTO tbl_countries VALUES("762","TJ","TJK","Tajikistan","Tajikistani");
INSERT INTO tbl_countries VALUES("764","TH","THA","Thailand","Thai");
INSERT INTO tbl_countries VALUES("768","TG","TGO","Togo","Togolese");
INSERT INTO tbl_countries VALUES("772","TK","TKL","Tokelau","Tokelauan");
INSERT INTO tbl_countries VALUES("776","TO","TON","Tonga","Tongan");
INSERT INTO tbl_countries VALUES("780","TT","TTO","Trinidad and Tobago","Trinidadian or Tobagonian");
INSERT INTO tbl_countries VALUES("784","AE","ARE","United Arab Emirates","Emirati, Emirian, Emiri");
INSERT INTO tbl_countries VALUES("788","TN","TUN","Tunisia","Tunisian");
INSERT INTO tbl_countries VALUES("792","TR","TUR","Turkey","Turkish");
INSERT INTO tbl_countries VALUES("795","TM","TKM","Turkmenistan","Turkmen");
INSERT INTO tbl_countries VALUES("796","TC","TCA","Turks and Caicos Islands","Turks and Caicos Island");
INSERT INTO tbl_countries VALUES("798","TV","TUV","Tuvalu","Tuvaluan");
INSERT INTO tbl_countries VALUES("800","UG","UGA","Uganda","Ugandan");
INSERT INTO tbl_countries VALUES("804","UA","UKR","Ukraine","Ukrainian");
INSERT INTO tbl_countries VALUES("807","MK","MKD","Macedonia (the former Yugoslav Republic of)","Macedonian");
INSERT INTO tbl_countries VALUES("818","EG","EGY","Egypt","Egyptian");
INSERT INTO tbl_countries VALUES("826","GB","GBR","United Kingdom of Great Britain and Northern Ireland","British, UK");
INSERT INTO tbl_countries VALUES("831","GG","GGY","Guernsey","Channel Island");
INSERT INTO tbl_countries VALUES("832","JE","JEY","Jersey","Channel Island");
INSERT INTO tbl_countries VALUES("833","IM","IMN","Isle of Man","Manx");
INSERT INTO tbl_countries VALUES("834","TZ","TZA","Tanzania, United Republic of","Tanzanian");
INSERT INTO tbl_countries VALUES("840","US","USA","United States of America","American");
INSERT INTO tbl_countries VALUES("850","VI","VIR","Virgin Islands (U.S.)","U.S. Virgin Island");
INSERT INTO tbl_countries VALUES("854","BF","BFA","Burkina Faso","Burkinabé");
INSERT INTO tbl_countries VALUES("858","UY","URY","Uruguay","Uruguayan");
INSERT INTO tbl_countries VALUES("860","UZ","UZB","Uzbekistan","Uzbekistani, Uzbek");
INSERT INTO tbl_countries VALUES("862","VE","VEN","Venezuela (Bolivarian Republic of)","Venezuelan");
INSERT INTO tbl_countries VALUES("876","WF","WLF","Wallis and Futuna","Wallis and Futuna, Wallisian or Futunan");
INSERT INTO tbl_countries VALUES("882","WS","WSM","Samoa","Samoan");
INSERT INTO tbl_countries VALUES("887","YE","YEM","Yemen","Yemeni");
INSERT INTO tbl_countries VALUES("894","ZM","ZMB","Zambia","Zambian");



DROP TABLE tbl_credit;

CREATE TABLE `tbl_credit` (
  `id` int(250) NOT NULL AUTO_INCREMENT,
  `credit` varchar(50) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO tbl_credit VALUES("1","1","2018-02-26 13:26:02");



DROP TABLE tbl_credit_request;

CREATE TABLE `tbl_credit_request` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fk_user_id` int(11) DEFAULT NULL,
  `fk_request_to_user_id` int(11) unsigned DEFAULT NULL,
  `credit_request` varchar(20) DEFAULT NULL,
  `credit_approved` varchar(20) DEFAULT NULL,
  `status` enum('active','inactive','deleted','declined','approved') NOT NULL DEFAULT 'active',
  `last_updated_by` int(11) unsigned DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO tbl_credit_request VALUES("1","3","1","100","","active","","2018-02-19 19:42:31","2018-02-19 19:42:31");
INSERT INTO tbl_credit_request VALUES("2","1","1","10","10","approved","0","2018-02-22 18:11:11","2018-02-22 18:17:35");
INSERT INTO tbl_credit_request VALUES("3","1","1","10","10","approved","0","2018-02-22 18:13:20","2018-02-22 18:17:42");



DROP TABLE tbl_interview;

CREATE TABLE `tbl_interview` (
  `interview_id` int(11) NOT NULL AUTO_INCREMENT,
  `invite_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `candidate_id` varchar(50) NOT NULL,
  `start` text NOT NULL,
  `end` text NOT NULL,
  `path` text NOT NULL,
  `status` varchar(50) NOT NULL,
  `is_credited` int(1) NOT NULL DEFAULT '0',
  `manager_eva_rating` varchar(20) DEFAULT NULL,
  `manager_eva_comment` text,
  `client_eva_rating` varchar(20) DEFAULT NULL,
  `client_eva_comment` text,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`interview_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

INSERT INTO tbl_interview VALUES("2","2","1","2","19/2/2018 23:6:16","19/2/2018 23:6:34","RecordRTC-2018119-12cbvcg1o61urw86akah.webm","1","1","","","3","","2018-02-19 19:05:27");
INSERT INTO tbl_interview VALUES("3","5","2","5","19/2/2018 19:27:49","19/2/2018 19:28:20","RecordRTC-2018119-zai060rc2og.webm","1","1","3","","1","Don\'t recommend","2018-02-19 19:28:21");
INSERT INTO tbl_interview VALUES("4","6","2","6","19/2/2018 19:32:14","19/2/2018 19:32:31","RecordRTC-2018119-mouh4ig7uif.wav","1","0","1","","1","Recommend","2018-02-19 19:32:31");
INSERT INTO tbl_interview VALUES("5","7","2","7","19/2/2018 19:33:58","19/2/2018 19:34:18","RecordRTC-2018119-25dfgd5y303.webm","1","0","2","","3","Ciao\n","2018-02-19 19:34:19");
INSERT INTO tbl_interview VALUES("7","10","3","10","21/2/2018 12:41:50","21/2/2018 12:43:21","RecordRTC-2018121-c2pftlnzj16.webm","1","1","","","1","don\'t think she can sell ice to an Eskimo ","2018-02-21 12:43:25");
INSERT INTO tbl_interview VALUES("8","15","1","15","21/2/2018 20:46:7","","RecordRTC-2018121-4lzy18yfh9.wav","1","0","","","2","","2018-02-21 16:45:05");
INSERT INTO tbl_interview VALUES("9","20","1","20","22/2/2018 22:10:30","22/2/2018 22:10:46","RecordRTC-2018122-aqar71x3zmk.webm","1","0","","","2","This Is test What do you think","2018-02-22 18:09:18");
INSERT INTO tbl_interview VALUES("11","26","5","26","27/2/2018 17:41:8","27/2/2018 17:41:21","RecordRTC-2018127-67cjuxr7gb6.webm","1","0","","","","","2018-02-27 14:11:26");



DROP TABLE tbl_invite_interview;

CREATE TABLE `tbl_invite_interview` (
  `invite_id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `candidate_id` int(11) NOT NULL,
  `note` text NOT NULL,
  `start_status` int(11) NOT NULL DEFAULT '0',
  `end_status` int(11) NOT NULL DEFAULT '0',
  `status` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`invite_id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

INSERT INTO tbl_invite_interview VALUES("1","1","1","","0","0","pending","2018-02-19 17:57:13");
INSERT INTO tbl_invite_interview VALUES("2","1","2","","1","1","complete","2018-02-19 18:20:01");
INSERT INTO tbl_invite_interview VALUES("3","1","3","","1","0","cancel","2018-02-19 19:13:32");
INSERT INTO tbl_invite_interview VALUES("4","2","4","","1","0","cancel","2018-02-19 19:25:11");
INSERT INTO tbl_invite_interview VALUES("5","2","5","","1","1","complete","2018-02-19 19:26:01");
INSERT INTO tbl_invite_interview VALUES("6","2","6","","1","1","complete","2018-02-19 19:31:22");
INSERT INTO tbl_invite_interview VALUES("7","2","7","","1","1","complete","2018-02-19 19:33:40");
INSERT INTO tbl_invite_interview VALUES("8","2","8","","0","0","pending","2018-02-19 19:35:23");
INSERT INTO tbl_invite_interview VALUES("9","2","9","","0","0","pending","2018-02-20 09:51:16");
INSERT INTO tbl_invite_interview VALUES("10","3","10","","1","1","complete","2018-02-21 12:07:18");
INSERT INTO tbl_invite_interview VALUES("11","3","11","","1","0","cancel","2018-02-21 12:11:16");
INSERT INTO tbl_invite_interview VALUES("12","3","12","","1","0","cancel","2018-02-21 12:53:19");
INSERT INTO tbl_invite_interview VALUES("13","4","13","","0","0","pending","2018-02-21 13:11:45");
INSERT INTO tbl_invite_interview VALUES("14","4","14","","0","0","pending","2018-02-21 13:55:10");
INSERT INTO tbl_invite_interview VALUES("15","1","15","","1","1","complete","2018-02-21 16:41:38");
INSERT INTO tbl_invite_interview VALUES("16","1","16","","0","0","pending","2018-02-22 11:13:44");
INSERT INTO tbl_invite_interview VALUES("17","3","17","","0","0","pending","2018-02-22 16:31:37");
INSERT INTO tbl_invite_interview VALUES("18","3","18","","0","0","pending","2018-02-22 16:31:37");
INSERT INTO tbl_invite_interview VALUES("19","1","19","","0","0","pending","2018-02-22 17:54:53");
INSERT INTO tbl_invite_interview VALUES("20","1","20","","1","1","complete","2018-02-22 17:57:16");
INSERT INTO tbl_invite_interview VALUES("21","3","21","","0","0","pending","2018-02-22 20:13:19");
INSERT INTO tbl_invite_interview VALUES("22","5","22","","0","0","pending","2018-02-23 16:16:04");
INSERT INTO tbl_invite_interview VALUES("23","5","23","","1","0","cancel","2018-02-23 16:29:56");
INSERT INTO tbl_invite_interview VALUES("24","5","24","","0","0","pending","2018-02-25 07:59:03");
INSERT INTO tbl_invite_interview VALUES("25","6","25","","0","0","pending","2018-02-25 15:56:41");
INSERT INTO tbl_invite_interview VALUES("26","5","26","","1","1","complete","2018-02-27 14:09:43");
INSERT INTO tbl_invite_interview VALUES("27","6","27","","0","0","pending","2018-03-02 13:14:21");



DROP TABLE tbl_job_profile;

CREATE TABLE `tbl_job_profile` (
  `job_profile_id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `title` varchar(50) CHARACTER SET utf8 NOT NULL,
  `role_title` varchar(50) NOT NULL,
  `question_list` longtext NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`job_profile_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

INSERT INTO tbl_job_profile VALUES("3","16","Sales Cadet Program","Sales Cadet Interview","[{\"question\":\"How would you approach a new client\",\"expire\":\"60\"},{\"question\":\"How does social media play a role in finding potential leads\",\"expire\":\"60\"},{\"question\":\"Why do you want to join Renault\",\"expire\":\"30\"}]","2018-02-21 12:06:40");
INSERT INTO tbl_job_profile VALUES("4","20","profile 1","SALES","[{\"question\":\"Q 1 ? \",\"expire\":\"10\"},{\"question\":\"Q 2 ?\",\"expire\":\"15\"}]","2018-02-21 13:11:27");
INSERT INTO tbl_job_profile VALUES("6","2","Hr Manager","Profile Role Title","[{\"question\":\"Tell me about yourself?\",\"expire\":\"30\"},{\"question\":\"Why are you interested in this job?\",\"expire\":\"30\"},{\"question\":\"What would you say are your greatest strengths? \",\"expire\":\"30\"},{\"question\":\"What do you think are your biggest weaknesses?\",\"expire\":\"30\"},{\"question\":\"Where do you see yourself in five years?\",\"expire\":\"30\"}]","2018-02-23 16:15:20");
INSERT INTO tbl_job_profile VALUES("7","39","Recruitment of Sales Executives","New Sales Executives","[{\"question\":\"How will you sell a car\",\"expire\":\"60\"},{\"question\":\"How will you approach a new client\",\"expire\":\"60\"},{\"question\":\"How do you use social media\",\"expire\":\"60\"}]","2018-02-25 15:54:58");



DROP TABLE tbl_manager;

CREATE TABLE `tbl_manager` (
  `manager_id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`manager_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO tbl_manager VALUES("1","2","Manager","batodiya.pramod@gmail.com","2018-02-19 17:40:15");
INSERT INTO tbl_manager VALUES("2","8","John Small","john@ahonline.co","2018-02-19 19:42:50");
INSERT INTO tbl_manager VALUES("3","20","test","test@gmail.com","2018-02-21 13:11:00");
INSERT INTO tbl_manager VALUES("4","20","kc savani","kcsavani1990@gmail.com","2018-02-21 13:57:01");
INSERT INTO tbl_manager VALUES("5","39","Manager Test","manager@ahonline.co","2018-02-25 15:56:04");



DROP TABLE tbl_project;

CREATE TABLE `tbl_project` (
  `project_id` int(11) NOT NULL AUTO_INCREMENT,
  `project_name` varchar(50) NOT NULL,
  `project_code` text NOT NULL,
  `profile_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `manager_id` int(11) NOT NULL,
  `candidate_id` text,
  `project_type` varchar(20) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `notification` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`project_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

INSERT INTO tbl_project VALUES("3","Renault Sales Graduate Program","mec3rk2frira6gan","3","16","0","[10,11,12,17,18,21]","open","2018-02-21","0000-00-00","on","launch","2018-02-21 12:07:18");
INSERT INTO tbl_project VALUES("4","Project 1","cj5fc5sdf5unie48","4","20","4","[13,14]","open","2018-02-21","0000-00-00","on","launch","2018-02-21 13:11:45");
INSERT INTO tbl_project VALUES("5","Vox Rein","wjwymnaowiun8vs3","6","2","1","[22,23,24,26]","open","2018-02-23","0000-00-00","on","launch","2018-02-23 16:16:04");
INSERT INTO tbl_project VALUES("6","New Sales Executives","mrozvtkbdfa26mhb","7","39","5","[25,27]","open","2018-02-25","0000-00-00","on","launch","2018-02-25 15:56:40");



