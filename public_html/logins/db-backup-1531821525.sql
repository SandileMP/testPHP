
CREATE TABLE `tbl_account_manager` (
  `account_manager_id` int(11) NOT NULL AUTO_INCREMENT,
  `distributor_id` int(11) NOT NULL,
  `account_manager` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` text NOT NULL,
  `credits` varchar(100) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`account_manager_id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

INSERT INTO tbl_account_manager VALUES("5","174","AssessmentHouse","Account Manager","am@ahonline.co","0000","adres","66","1","2018-04-03 12:34:20");
INSERT INTO tbl_account_manager VALUES("11","174","AssessmentHouse v3","Assess House3","ah3@ahonline.co","00000","address","108","1","2018-04-06 10:22:59");
INSERT INTO tbl_account_manager VALUES("15","179","Account Manager 2","James Bond","p.batodiya@gmail.com","1212121212121","Address","198","1","2018-04-10 10:48:36");
INSERT INTO tbl_account_manager VALUES("17","179","test","test test","test2@mailinator.com","99999999","sdsada","200","1","2018-04-10 11:31:48");
INSERT INTO tbl_account_manager VALUES("18","185","Imperial Holdings","John Smith","johnimp@ahonline.co","000","address","49","1","2018-04-10 12:17:30");
INSERT INTO tbl_account_manager VALUES("19","179","test","tes","test3@mailinator.com","99999999","sdfsdf","15","1","2018-04-10 13:12:48");
INSERT INTO tbl_account_manager VALUES("21","185","Client2","Client Two","cl2@ahonline.co","000","Address","15","1","2018-04-11 08:49:42");
INSERT INTO tbl_account_manager VALUES("22","218","Client 1","James Bond","batodiya.pramod@gmail.com","1212121212121","Address","8","1","2018-04-11 11:15:41");
INSERT INTO tbl_account_manager VALUES("23","194","Big Bang Theory","Sheldon Cooper","drscooper@qims.co.za","0000000000","2311 North Los Robles Avenue,
\nPasadena,
\nCalifornia","8","1","2018-04-15 16:04:35");
INSERT INTO tbl_account_manager VALUES("31","185","Client Two","Client Two","client22@ahonline.co","00","00","10","1","2018-07-04 17:58:10");
INSERT INTO tbl_account_manager VALUES("32","302","Landman Consulting","Rentia Landman","rentia@landmanconsulting.co.za","0718988286","9 Popham Street","91","1","2018-07-04 21:44:13");
INSERT INTO tbl_account_manager VALUES("33","302","Outerbox Thinking","Jane Moors","jane@outerboxthinking.com","+27 (0)21 974 6","Regus Office Park
\n39 Carl Cronje Drive
\nTygervalley
\nBellville
\nWestern Cape
\n7530
\n","10","1","2018-07-04 21:55:04");
INSERT INTO tbl_account_manager VALUES("34","302","Benedict Associates Ltd","Burgert van Jaarsveldt","burgert@benedict.bm","+1 (441) 295 20","Benedict Associates Ltd
\nThe Emporium Building 69 Front Street Hamilton, HM12 Bermuda
\n","10","1","2018-07-04 21:56:35");




CREATE TABLE `tbl_auth` (
  `auth_id` int(11) NOT NULL AUTO_INCREMENT,
  `profile_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `type` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`auth_id`)
) ENGINE=InnoDB AUTO_INCREMENT=374 DEFAULT CHARSET=latin1;

INSERT INTO tbl_auth VALUES("1","0","administrator","admin@gmail.com","YWRtaW5AMTIz","ADMIN","2018-03-29 07:50:01");
INSERT INTO tbl_auth VALUES("23","6","Manager One","managerone@ahonline.co","eXFlY3B1YnNubQ==","MANAGER","2018-03-30 07:45:28");
INSERT INTO tbl_auth VALUES("24","7","Manager Two","managertwo@ahonline.co","dG04cGUweGFqYg==","MANAGER","2018-03-30 07:45:44");
INSERT INTO tbl_auth VALUES("25","8","Manager Three","managerthree@ahonline.co","Y3FobzM0dm0yYg==","MANAGER","2018-03-30 07:46:02");
INSERT INTO tbl_auth VALUES("26","7","Alpha Rater","alpha@ahonline.co","aWNxb242eGFlNQ==","RATER","2018-03-30 07:47:06");
INSERT INTO tbl_auth VALUES("27","8","Beta Rater","beta@ahonline.co","cHpndWJ4djUzcA==","RATER","2018-03-30 07:47:15");
INSERT INTO tbl_auth VALUES("28","9","Charlie Rater","charlie@ahonline.co","cGt5cGQ3dXl1Yg==","RATER","2018-03-30 07:47:24");
INSERT INTO tbl_auth VALUES("29","10","Delta Rater","delta@ahonline.co","Z3pxY3N1NjB0NQ==","RATER","2018-03-30 07:47:33");
INSERT INTO tbl_auth VALUES("30","11","Echo Rater","echo@ahonline.co","ZjdvdDJyNjVoeA==","RATER","2018-03-30 07:47:54");
INSERT INTO tbl_auth VALUES("31","6","Candidate One","candidate1@ahonline.co","cWNxa3lybWcydQ==","CANDIDATE","2018-03-30 07:54:04");
INSERT INTO tbl_auth VALUES("32","7","Candidate Two","candidate2@ahonline.co","cXhrZnN1M2VxZQ==","CANDIDATE","2018-03-30 07:54:04");
INSERT INTO tbl_auth VALUES("33","8","Candidate Three","candidate3@ahonline.co","cW40YnB3NHJtbg==","CANDIDATE","2018-03-30 07:54:36");
INSERT INTO tbl_auth VALUES("34","9","Candidate Four","candidate4@ahonline.co","c2Z2eXMyZ3o0eA==","CANDIDATE","2018-03-30 07:54:36");
INSERT INTO tbl_auth VALUES("36","9","Debri van Wyk","debri@ahonline.co","dW94bnRibWg4cw==","MANAGER","2018-03-30 09:37:48");
INSERT INTO tbl_auth VALUES("38","10","Ciska van Aswegen","ciska@assessmenthouse.com","NHd6amVlajAzag==","MANAGER","2018-03-30 09:58:27");
INSERT INTO tbl_auth VALUES("39","13","Foxtrot Rater","foxtrot@ahonline.co","MzhrbnBnYW1hNg==","RATER","2018-03-30 11:56:22");
INSERT INTO tbl_auth VALUES("40","14","Elon Musk","boringco@earth.com","aGRkNGVtbnM3Zg==","RATER","2018-04-01 12:06:26");
INSERT INTO tbl_auth VALUES("41","15","Einstein","relativity@physics.co.za","bW0yeXlweW0wMg==","RATER","2018-04-01 12:06:42");
INSERT INTO tbl_auth VALUES("42","5","Account Manager","am@ahonline.co","bmVldGp5NXNjZA==","ACCOUNT MANAGER","2018-04-03 12:34:20");
INSERT INTO tbl_auth VALUES("43","11","Ciska van Aswegen v2","cvanaswegen@ih.co.za","Q2lza2Ex","MANAGER","2018-04-03 12:37:10");
INSERT INTO tbl_auth VALUES("44","12","Debri van Wyk","dvanwyk@ahonline.co","YWN0ZnVxNGtiNQ==","MANAGER","2018-04-03 12:37:27");
INSERT INTO tbl_auth VALUES("45","16","Alpha Rater","alpharater@ahonline.co","M2F3M2o2bW1zMA==","RATER","2018-04-03 12:39:55");
INSERT INTO tbl_auth VALUES("46","17","Beta Rater","betarater@ahonline.co","YnA4NnR4MnYyNQ==","RATER","2018-04-03 12:40:04");
INSERT INTO tbl_auth VALUES("47","18","Charlie Rater","charlierater@ahonline.co","dHA3aXd5M3liOA==","RATER","2018-04-03 12:40:15");
INSERT INTO tbl_auth VALUES("48","19","Delta Rater","deltarater@ahonline.co","cG8wdWU0a3h3eA==","RATER","2018-04-03 12:40:34");
INSERT INTO tbl_auth VALUES("49","20","Echo Rater","echorater@ahonline.co","enZvZHlvZ3J6MA==","RATER","2018-04-03 12:40:52");
INSERT INTO tbl_auth VALUES("53","11","Candidate Alpha","canalpha@ahonline.co","aW11YXlzNmg3eA==","CANDIDATE","2018-04-03 12:47:48");
INSERT INTO tbl_auth VALUES("55","13","John van Wyk","john@ahonline.co","cnMzYzhoajVqNA==","CANDIDATE","2018-04-03 13:00:39");
INSERT INTO tbl_auth VALUES("57","15","Ciska van Aswegen","cvanaswegen@ih.co.za","M3Z4Z2hzb29ydw==","CANDIDATE","2018-04-03 15:45:44");
INSERT INTO tbl_auth VALUES("58","13","John Smith","smith@ahonline.co","YXdmeXNrN2F6cA==","MANAGER","2018-04-03 20:54:53");
INSERT INTO tbl_auth VALUES("59","16","Sue Smith","ssmith@ahonline.co","dWUyMzg2bjN5Mg==","CANDIDATE","2018-04-03 21:00:55");
INSERT INTO tbl_auth VALUES("73","25","Merida","ciska@assessmenthouse.com","eG11emRwN3lwaA==","CANDIDATE","2018-04-04 21:31:05");
INSERT INTO tbl_auth VALUES("77","29","Jasmine","ciskavaswegen@gmail.com","YjJ1Z2dkaDN5Zg==","CANDIDATE","2018-04-05 08:17:19");
INSERT INTO tbl_auth VALUES("78","30","Sleeping Beauty","training.assess@gmail.com","b3hoN2t2aWMzcw==","CANDIDATE","2018-04-05 08:17:19");
INSERT INTO tbl_auth VALUES("79","31","Debri van Wyk","dvanwyk@ih.co.za","cHhzcGJybzZ3Mw==","CANDIDATE","2018-04-05 08:57:33");
INSERT INTO tbl_auth VALUES("80","32","Test test","cvanaswegen@ih.co.za","d3BjdWtzMDNrcg==","CANDIDATE","2018-04-05 09:29:47");
INSERT INTO tbl_auth VALUES("81","33","Test test","training.assess@gmail.com","bWU2NXlqemc2aA==","CANDIDATE","2018-04-05 09:30:30");
INSERT INTO tbl_auth VALUES("82","34","Travis Yates","hykoju227@gmail.com","dmdtcXdzN2t2Nw==","CANDIDATE","2018-04-05 09:42:43");
INSERT INTO tbl_auth VALUES("83","35","Marco Meyer","marco@eastvaal.co.za","NW01eWFocmZyYw==","CANDIDATE","2018-04-05 10:47:37");
INSERT INTO tbl_auth VALUES("84","36","Yvonne Mtshali","ymtshali@um.co.za","N3MwcDdrNzdtYg==","CANDIDATE","2018-04-05 10:48:46");
INSERT INTO tbl_auth VALUES("85","37","Yvonne Mtshali","training.assess@gmail.com","MnBydjY4djVkcA==","CANDIDATE","2018-04-05 10:54:46");
INSERT INTO tbl_auth VALUES("86","38","Johannes Gerhardus van Vuuren","evanvuuren@imperialrenault.co.za","eTZ5a3Q3czNkNA==","CANDIDATE","2018-04-05 12:54:12");
INSERT INTO tbl_auth VALUES("87","39","Dale Skinner","dales@renaultroute24.co.za","NW5tazB6ZWRzbw==","CANDIDATE","2018-04-05 12:56:44");
INSERT INTO tbl_auth VALUES("127","19","Nitesh Nitz","nitesh.iosdev@gmail.com","Zm11MGVmNnlzYQ==","MANAGER","2018-04-06 08:18:10");
INSERT INTO tbl_auth VALUES("129","73","renay litsili","renayl@multifranchise.co.za","ajZwdnJtMm5uOA==","CANDIDATE","2018-04-06 08:44:11");
INSERT INTO tbl_auth VALUES("133","77","Christo Saidt","christosa@cmh.co.za","dXZuNTVycWN6cA==","CANDIDATE","2018-04-06 08:54:08");
INSERT INTO tbl_auth VALUES("134","20","John Smith","js@ahonline.co","eHFiYmJzajVnaA==","MANAGER","2018-04-06 08:58:28");
INSERT INTO tbl_auth VALUES("135","78","test test","test@mailinator.com","dGF3eWh2Yml3Yg==","CANDIDATE","2018-04-06 08:59:58");
INSERT INTO tbl_auth VALUES("136","79","test test2","test@mailinator.com","bWhzZTMzODM2Mg==","CANDIDATE","2018-04-06 08:59:58");
INSERT INTO tbl_auth VALUES("137","80","test test3","test@mailinator.com","ZmltdXVrcm9mdg==","CANDIDATE","2018-04-06 08:59:58");
INSERT INTO tbl_auth VALUES("138","81","test test4","test@mailinator.com","MmNhbmVvODNoag==","CANDIDATE","2018-04-06 08:59:58");
INSERT INTO tbl_auth VALUES("139","82","Gary Naidoo","garyn@tangawizi.co.za","dHJoeGJuN3FzdA==","CANDIDATE","2018-04-06 09:00:11");
INSERT INTO tbl_auth VALUES("141","84","Gabi Morris","gabithemorris@gmail.com","dnFoMDducm0wYQ==","CANDIDATE","2018-04-06 09:29:54");
INSERT INTO tbl_auth VALUES("142","85","Debri van Wyk","renault@ahonline.co","eTg3Nm43a2F5bw==","CANDIDATE","2018-04-06 10:06:27");
INSERT INTO tbl_auth VALUES("143","11","Assess House3","ah3@ahonline.co","dzhoa21vNDM2Mw==","ACCOUNT MANAGER","2018-04-06 10:22:59");
INSERT INTO tbl_auth VALUES("144","21","Assess Man3","am3@ahonline.co","MDM3M2IwZGRvZA==","MANAGER","2018-04-06 10:25:41");
INSERT INTO tbl_auth VALUES("145","22","Assess House4","am4@ahonline.co","MjIzdGJyNHB6bw==","MANAGER","2018-04-06 10:26:16");
INSERT INTO tbl_auth VALUES("146","26","Asses3 Rater1","ar31@ahonline.co","ZmU1ZmdkOGdyNw==","RATER","2018-04-06 10:28:00");
INSERT INTO tbl_auth VALUES("147","27","Asses3 Rater2","ar32@ahonline.co","NDVjNmZibzVlcg==","RATER","2018-04-06 10:28:27");
INSERT INTO tbl_auth VALUES("148","28","Asses3 Rater3","ar33@ahonline.co","bnV0cGZzem1jag==","RATER","2018-04-06 10:28:48");
INSERT INTO tbl_auth VALUES("149","29","Asses3 Rater4","ar34@ahonline.co","anA2anN1dG5xaw==","RATER","2018-04-06 10:29:05");
INSERT INTO tbl_auth VALUES("150","86","Candidate Three Myself","can3@ahonline.co","M29mMnAzNzJ3Yg==","CANDIDATE","2018-04-06 10:31:37");
INSERT INTO tbl_auth VALUES("151","87","Candidate Four","can4@ahonline.co","ZXZ2cTJobmptdw==","CANDIDATE","2018-04-06 10:31:37");
INSERT INTO tbl_auth VALUES("152","88","Candidate Five","can5@ahonline.co","N3J6dWlrb2lqbw==","CANDIDATE","2018-04-06 10:31:37");
INSERT INTO tbl_auth VALUES("153","89","Gary Naidoo","garyn@tangawizi.co.za","NWEyN21iNzdjYQ==","CANDIDATE","2018-04-06 10:46:56");
INSERT INTO tbl_auth VALUES("154","90","Christo Saidt","christosa@cmh.co.za","amdqNzZ3dW1pOA==","CANDIDATE","2018-04-06 10:47:01");
INSERT INTO tbl_auth VALUES("155","91","renay litsili","renayl@multifranchise.co.za","Z2Rod3U4cnE4MA==","CANDIDATE","2018-04-06 10:47:56");
INSERT INTO tbl_auth VALUES("156","92","John Andrew Smith","jas@ahonline.co","NmtrMnNocWo1NA==","CANDIDATE","2018-04-06 10:56:49");
INSERT INTO tbl_auth VALUES("159","93","Penny","penny@qims.co.za","YXhhc29oazd0eA==","CANDIDATE","2018-04-06 11:43:12");
INSERT INTO tbl_auth VALUES("160","94","Amy Farrah Fowler","aff@qims.co.za","ZHZmMG0waXZhNA==","CANDIDATE","2018-04-06 11:43:12");
INSERT INTO tbl_auth VALUES("161","32","Sheldon Cooper","sheldon@qims.co.za","NXZxb3Q4dmJjMA==","RATER","2018-04-06 11:44:36");
INSERT INTO tbl_auth VALUES("162","33","Leonard Hofstadter","leonardh@qims.co.za","ODI2ODAyZ2lwdQ==","RATER","2018-04-06 11:44:47");
INSERT INTO tbl_auth VALUES("163","95","Shaun Hamilton","shaun@renaultnorthcliff.co.za","dGlzYTJ0aWgwaQ==","CANDIDATE","2018-04-06 13:03:14");
INSERT INTO tbl_auth VALUES("165","96","Bernadette","bernie@qims.co.za","bzd5Ym93ZTdmZw==","CANDIDATE","2018-04-06 14:18:12");
INSERT INTO tbl_auth VALUES("166","97","Sunday Testing Again","sunday@ahonline.co","dnc4dDhwbzIwOA==","CANDIDATE","2018-04-08 17:08:26");
INSERT INTO tbl_auth VALUES("167","98","Sunday Testing Too","sundaytoo@ahonline.co","NTQ2cTJ2ZnkyZg==","CANDIDATE","2018-04-08 17:11:49");
INSERT INTO tbl_auth VALUES("171","99","Keona","blossomsoflove@hotmail.com","Y2QybmJtM2dhOA==","CANDIDATE","2018-04-08 22:20:05");
INSERT INTO tbl_auth VALUES("172","100","Keona","blossomsoflove@hotmail.com","cnR1NG42ZDJtdQ==","CANDIDATE","2018-04-08 22:24:30");
INSERT INTO tbl_auth VALUES("179","8","Pramod Batodiya","p.batodiya@gmail.com","eTVkNGNlYTZ1eA==","DISTRIBUTOR","2018-04-09 16:32:10");
INSERT INTO tbl_auth VALUES("180","13","Account Manager","iinspectionid@gmail.com","aXBoYjgyczhnbQ==","ACCOUNT MANAGER","2018-04-09 16:35:37");
INSERT INTO tbl_auth VALUES("182","15","James Bond","p.batodiya@gmail.com","anZ0Z3lwMnh1Mg==","ACCOUNT MANAGER","2018-04-10 10:48:36");
INSERT INTO tbl_auth VALUES("184","17","test test","test2@mailinator.com","NTZuYzQ1ZzYydg==","ACCOUNT MANAGER","2018-04-10 11:31:48");
INSERT INTO tbl_auth VALUES("185","9","Debri van Wyk","debri@ahonline.co","cnFzZ3NvNWlkdQ==","DISTRIBUTOR","2018-04-10 12:07:02");
INSERT INTO tbl_auth VALUES("186","18","John Smith","johnimp@ahonline.co","b293b3F5dDgyag==","ACCOUNT MANAGER","2018-04-10 12:17:30");
INSERT INTO tbl_auth VALUES("187","24","Ciska van Aswegen","ciska@ahonline.co","dGl6eWoyamR3Mg==","MANAGER","2018-04-10 12:21:44");
INSERT INTO tbl_auth VALUES("188","25","Sue Sample","suesample@ahonline.co","bmZvdjZvZ290dA==","MANAGER","2018-04-10 12:22:03");
INSERT INTO tbl_auth VALUES("189","36","Rat One","rat1@ahonline.co","c3BycnYzb212cw==","RATER","2018-04-10 12:23:15");
INSERT INTO tbl_auth VALUES("190","37","Rat 2","rat2@ahonline.co","Z2s3dXRqNHNpdA==","RATER","2018-04-10 12:23:35");
INSERT INTO tbl_auth VALUES("191","38","Rat three","rat3@ahonline.co","NHc0aWR1MHMyNw==","RATER","2018-04-10 12:23:50");
INSERT INTO tbl_auth VALUES("192","39","Rat 4","rat4@ahonline.co","cGV2NTBjdXI4NA==","RATER","2018-04-10 12:24:02");
INSERT INTO tbl_auth VALUES("193","101","Can me","canme@ahonline.co","anBuMzd1dG5tNw==","CANDIDATE","2018-04-10 12:26:27");
INSERT INTO tbl_auth VALUES("194","10","Ciska van Aswegen","ciska@qims.co.za","Y0lTS0Ex","DISTRIBUTOR","2018-04-10 12:46:28");
INSERT INTO tbl_auth VALUES("195","19","tes","test3@mailinator.com","aTRpMHUzYzdlMg==","ACCOUNT MANAGER","2018-04-10 13:12:48");
INSERT INTO tbl_auth VALUES("196","26","test manager","test@mailinator.com","dWg2aGZka2Jpdw==","MANAGER","2018-04-10 13:29:54");
INSERT INTO tbl_auth VALUES("197","40","Rater 1","rater1@mailinator.com","aW9lc2cybnMyZw==","RATER","2018-04-10 13:33:55");
INSERT INTO tbl_auth VALUES("198","41","Rater 2","rater2@mailinator.com","Z2dnd3NwZW5xdg==","RATER","2018-04-10 13:34:07");
INSERT INTO tbl_auth VALUES("199","102","test candidate","candidate@mailinator.com","YnFxdm5odGY2aw==","CANDIDATE","2018-04-10 13:35:58");
INSERT INTO tbl_auth VALUES("200","103","test candidate 2","candidate2@mailinator.com","dWN0NW5mbW8zMg==","CANDIDATE","2018-04-10 13:46:33");
INSERT INTO tbl_auth VALUES("202","104","Willem Fourie","willem@renaultbryanston.co.za","NHJ4NzJzdmlnYQ==","CANDIDATE","2018-04-11 08:38:54");
INSERT INTO tbl_auth VALUES("203","21","Client Two","cl2@ahonline.co","d3BybXNyNmhzNA==","ACCOUNT MANAGER","2018-04-11 08:49:42");
INSERT INTO tbl_auth VALUES("204","27","Manager Ex","manex@ahonline.co","N2RxbjVnMDhodg==","MANAGER","2018-04-11 08:52:30");
INSERT INTO tbl_auth VALUES("205","105","Kamil Sarup","kamil@renaultrandburg.co.za","MjV3aDU1eHlzcA==","CANDIDATE","2018-04-11 08:57:06");
INSERT INTO tbl_auth VALUES("206","106","Phumi Masinga","phumim@hyundai.co.za","c2VqNzZ1ZGs0Mg==","CANDIDATE","2018-04-11 08:58:41");
INSERT INTO tbl_auth VALUES("207","11","Distributor Three","dt3@ahonline.co","emk0dmE2ZW84Yw==","DISTRIBUTOR","2018-04-11 09:01:32");
INSERT INTO tbl_auth VALUES("208","42","Masenyane Molefe","masenyanem@hyundai.co.za","N29memVzcGZpNw==","RATER","2018-04-11 09:01:38");
INSERT INTO tbl_auth VALUES("210","107","abbie legodi","abbie@renaultfourways.co.za","MnFpYmkwdjRpcg==","CANDIDATE","2018-04-11 09:02:28");
INSERT INTO tbl_auth VALUES("211","44","Phumi Masinga","phumim@hyundai.co.za","YndhMjRkcjhuYQ==","RATER","2018-04-11 09:03:06");
INSERT INTO tbl_auth VALUES("212","108","Phumi Masinga","phumim@qims.co.za","eW1xajI4dzRobg==","CANDIDATE","2018-04-11 09:03:34");
INSERT INTO tbl_auth VALUES("213","109","Evert Breedt","evert@renaulteeastrand.co.za","cmppaGo1ZjNnZQ==","CANDIDATE","2018-04-11 09:10:09");
INSERT INTO tbl_auth VALUES("214","110","test test","test@mailinator.com","cjhmd3Q1NnJndA==","CANDIDATE","2018-04-11 10:45:33");
INSERT INTO tbl_auth VALUES("218","15","Pramod Batodiya","batodiya.pramod@gmail.com","cWlyaWR0djA2YQ==","DISTRIBUTOR","2018-04-11 11:13:16");
INSERT INTO tbl_auth VALUES("219","22","James Bond","batodiya.pramod@gmail.com","a21vZzg0ZW44MA==","ACCOUNT MANAGER","2018-04-11 11:15:41");
INSERT INTO tbl_auth VALUES("223","31","Pramod Batodiya","p.batodiya@gmail.com","Y2JhZzNqdDQ3OA==","MANAGER","2018-04-11 12:08:03");
INSERT INTO tbl_auth VALUES("224","32","James Bond","iinspectionid@gmail.com","M2twajQ4NHVkNA==","MANAGER","2018-04-11 12:09:31");
INSERT INTO tbl_auth VALUES("225","45","Rater 1","rater111@mailinator.com","Y2FzNGVmcHloeg==","RATER","2018-04-11 12:10:53");
INSERT INTO tbl_auth VALUES("226","111","pbatodiya","p.batodiya@gmail.com","bzVuN293cWU2ag==","CANDIDATE","2018-04-11 12:11:49");
INSERT INTO tbl_auth VALUES("227","16","Da da","dada@ahonline.co","M3VvcWo4MHM3Yg==","DISTRIBUTOR","2018-04-11 12:31:48");
INSERT INTO tbl_auth VALUES("228","112","sdasd","dd@ahonline.co","eTJ5NXdhcmMycQ==","CANDIDATE","2018-04-11 12:33:20");
INSERT INTO tbl_auth VALUES("230","23","Sheldon Cooper","drscooper@qims.co.za","ZmFqNXowd2Zudg==","ACCOUNT MANAGER","2018-04-15 16:04:35");
INSERT INTO tbl_auth VALUES("232","33","Amy Farrah Fowler","amyff@qims.co.za","QW15MQ==","MANAGER","2018-04-15 16:11:48");
INSERT INTO tbl_auth VALUES("234","46","Leonard Hofstadter","drleonardh@qims.co.za","TGVvbmFyZDE=","RATER","2018-04-15 16:16:45");
INSERT INTO tbl_auth VALUES("235","47","Penny","penny@qims.co.za","UGVubnkx","RATER","2018-04-15 16:17:07");
INSERT INTO tbl_auth VALUES("236","113","Stuart Bloom","comics@qims.co.za","U3R1YXJ0MQ==","CANDIDATE","2018-04-15 16:23:49");
INSERT INTO tbl_auth VALUES("237","114","Leslie Winkle","leslie@qims.co.za","TGVzbGllMQ==","CANDIDATE","2018-04-15 16:23:49");
INSERT INTO tbl_auth VALUES("240","36","Vaughn Mosher","vmosher@ibl.bm","bmozYmgycnk1dg==","MANAGER","2018-04-16 20:35:15");
INSERT INTO tbl_auth VALUES("241","48","Helen Orchard","helen@benedict.bm","ODQzdG9jdnhhYg==","RATER","2018-04-16 20:35:41");
INSERT INTO tbl_auth VALUES("242","49","Marthinus Pagel","thinus1979@yahoo.co.uk","eWdueWtlb3Ywdw==","RATER","2018-04-16 20:36:25");
INSERT INTO tbl_auth VALUES("243","115","test test","test@ahonline.co","ZnAwczZlbWE3Mw==","CANDIDATE","2018-04-16 20:39:44");
INSERT INTO tbl_auth VALUES("246","51","Vaughn Mosher","vmosher@ibl.bm","eDQwZmRuZ2MwNw==","RATER","2018-04-16 21:33:37");
INSERT INTO tbl_auth VALUES("247","117","Marikje Jakobsen","marikje@firedisaster.co.za","aHNyZWJqeWs0ZA==","CANDIDATE","2018-04-16 21:50:30");
INSERT INTO tbl_auth VALUES("249","18","Ciska van Aswegen","cvanaswegen@ih.co.za","b2NtajZlZ211Zw==","DISTRIBUTOR","2018-04-18 10:30:25");
INSERT INTO tbl_auth VALUES("250","19","Maxine Adams-Leite","maxine.adams@hrst.co.za","dXZ0YXk2aDNpYQ==","DISTRIBUTOR","2018-04-18 13:59:09");
INSERT INTO tbl_auth VALUES("255","120","Test yest","test@hctalent.co.za","NnliZ3dha2ltYw==","CANDIDATE","2018-04-25 11:36:16");
INSERT INTO tbl_auth VALUES("260","123","Leanie Terblance","strydomleanie@yahoo.com","cW9hdTMyNWhzZA==","CANDIDATE","2018-04-28 19:08:38");
INSERT INTO tbl_auth VALUES("261","124","Alexandra Hund","Alexandra.Hund@gmx.de","b3V2Z3BzaW52ZQ==","CANDIDATE","2018-05-02 17:57:50");
INSERT INTO tbl_auth VALUES("262","125","min yu","develop.minyu@gmail.com","cHJyNXUzZjB3dg==","CANDIDATE","2018-05-04 17:10:46");
INSERT INTO tbl_auth VALUES("263","126","hi kk","yayzooyama@gmail.com","MmZ2cmVtMzdpeA==","CANDIDATE","2018-05-04 17:12:29");
INSERT INTO tbl_auth VALUES("264","127","a a","a@a.com","dnIzcjRkazh3cw==","CANDIDATE","2018-05-04 17:18:00");
INSERT INTO tbl_auth VALUES("265","128","testing tesitng","devasda@gmail.com","bnZuend2Nm5keQ==","CANDIDATE","2018-05-04 17:19:01");
INSERT INTO tbl_auth VALUES("266","129","YinFeng Piao","beautistar1112@gmail.com","N3R5cXd1aGswYw==","CANDIDATE","2018-05-04 17:21:09");
INSERT INTO tbl_auth VALUES("267","130","aa bb","suns880110@yandex.com","ZnJ3NW53OHptZQ==","CANDIDATE","2018-05-04 17:21:17");
INSERT INTO tbl_auth VALUES("268","131","Zui en","sarlongda514@gmail.com","aGh5N3EyMmVhZg==","CANDIDATE","2018-05-04 17:22:09");
INSERT INTO tbl_auth VALUES("269","132","Zui en","sarlongda514@gmail.com","ejd3eXpoY3EyMA==","CANDIDATE","2018-05-04 17:26:05");
INSERT INTO tbl_auth VALUES("270","133","Sharribu Tsener","bristalback47@mail.ru","dW5rNWlmajRtOA==","CANDIDATE","2018-05-04 17:27:07");
INSERT INTO tbl_auth VALUES("271","134","Vladimir Marenchuk","vladimir.marenchuk211@gmail.com","aHUyc3lhZ2Eyeg==","CANDIDATE","2018-05-04 17:29:34");
INSERT INTO tbl_auth VALUES("272","135","Zui en","acdedfadaabc@gmail.com","c2s0NGR0aGRoZg==","CANDIDATE","2018-05-04 17:44:54");
INSERT INTO tbl_auth VALUES("273","136","aaa aaa","aaa@aaa.com","cXU3dTI2d2hjdA==","CANDIDATE","2018-05-04 17:51:58");
INSERT INTO tbl_auth VALUES("274","137","cvv jhg","vchouhan@doomshell.com","aDZ4dWl6N2VvNQ==","CANDIDATE","2018-05-04 20:43:58");
INSERT INTO tbl_auth VALUES("275","138","DaoHaung Vue","ihs_1993@outlook.com","cXNwZHNqNnBvYw==","CANDIDATE","2018-05-04 21:05:41");
INSERT INTO tbl_auth VALUES("276","139","Bb bs","alecksey0301@gmail.com","ZzAzY2JneG4wcQ==","CANDIDATE","2018-05-05 03:33:43");
INSERT INTO tbl_auth VALUES("277","140","James Bond","p.batodiya@gmail.com","ZHI1dW1jd3R3Zw==","CANDIDATE","2018-05-06 17:08:20");
INSERT INTO tbl_auth VALUES("278","141","Bryce Dekker","bryce@directiondd.co.za","aXU4cGlpNnNuaA==","CANDIDATE","2018-05-08 08:28:25");
INSERT INTO tbl_auth VALUES("279","142","Jennifer Dutton","Jennifer.Dutton@directaxis.co.za","NTdpc2dkZ281Nw==","CANDIDATE","2018-05-08 20:44:38");
INSERT INTO tbl_auth VALUES("280","143","Leigh-Anne Swartz","Leigh-Anne.Swartz@directaxis.co.za","Nmk2cDI1d2NtMA==","CANDIDATE","2018-05-08 20:44:38");
INSERT INTO tbl_auth VALUES("281","20","Nadine Moodley","nadinem@hrst.co.za","aDY0dHl5Zm13Ng==","DISTRIBUTOR","2018-05-09 08:50:34");
INSERT INTO tbl_auth VALUES("282","144","Zurika Nabbi","Zurika.Nabbi@directaxis.co.za","M3BhM3hnaTd2Nw==","CANDIDATE","2018-05-09 10:48:05");
INSERT INTO tbl_auth VALUES("283","145","Samantha Langeveldt","Samantha.Langeveldt@directaxis.co.za","Z2Z4eGp0MHJhcw==","CANDIDATE","2018-05-09 10:48:05");
INSERT INTO tbl_auth VALUES("284","146","Astrid Ruiters","Astrid@bidvestedge.co.za","NmtoMGszaTZoNg==","CANDIDATE","2018-05-10 20:02:35");
INSERT INTO tbl_auth VALUES("285","147","Elzette Fourie","elzette@elzettefourie.com","aWY4ZWZ4cmphYg==","CANDIDATE","2018-05-30 15:58:47");
INSERT INTO tbl_auth VALUES("287","149","Wea van Heerden","wea@assessmenttoolbox.co.za","dGkzd3hwMmFhNQ==","CANDIDATE","2018-05-31 14:29:56");
INSERT INTO tbl_auth VALUES("288","150","Mrs Vermeulen","michellelindavermeulen@gmail.com","eGtpYnRxb2hvcg==","CANDIDATE","2018-06-19 12:11:11");
INSERT INTO tbl_auth VALUES("290","152","James Bond-2","p.batodiya@gmail.com","Zmg3NzVhanN1aA==","CANDIDATE","2018-06-22 10:42:47");
INSERT INTO tbl_auth VALUES("291","153","Sales Sam","saless@qims.co.za","Z2J0YTRyajg0Ng==","CANDIDATE","2018-06-25 08:15:41");
INSERT INTO tbl_auth VALUES("292","30","Monica Eckermann","monica.eckermann@Weylandtshome.co.za","V2V5bGFuZHRzMjY=","ACCOUNT MANAGER","2018-06-28 05:45:21");
INSERT INTO tbl_auth VALUES("295","52","Colette Wessels","Colette.Wessels@imperiallogistics.com","amR3cDRrZG56NQ==","RATER","2018-07-04 12:54:39");
INSERT INTO tbl_auth VALUES("296","154","Veronica Mthombeni","Veronica.Mthombeni@imperiallogistics.com","YWJxczdlaGFxdA==","CANDIDATE","2018-07-04 12:55:27");
INSERT INTO tbl_auth VALUES("297","155","Colette Wessels","Colette.Wessels@imperiallogistics.com","am1veGluZTY4MA==","CANDIDATE","2018-07-04 12:55:27");
INSERT INTO tbl_auth VALUES("298","156","Ciska van Aswegen","cvanaswegen@ih.co.za","bWFjc3Q1Mzdrdw==","CANDIDATE","2018-07-04 12:56:04");
INSERT INTO tbl_auth VALUES("299","157","Ciska van Aswegen","assessment@ih.co.za","ejhyZG12dTM2NA==","CANDIDATE","2018-07-04 14:47:20");
INSERT INTO tbl_auth VALUES("300","158","Veronica Mthombeni","veronica.mthombeni@imperiallogistics.co.za","NXVwam50MGtmNQ==","CANDIDATE","2018-07-04 15:04:18");
INSERT INTO tbl_auth VALUES("301","53","Veronica Mthombeni","Veronica.Mthombeni@imperiallogistics.com","djhzODZkcnc4Yw==","RATER","2018-07-04 15:05:38");
INSERT INTO tbl_auth VALUES("302","21","Rentia Landman","rentia.landman@stratatech.co.za","UmVudGlhQDIy","DISTRIBUTOR","2018-07-04 17:51:19");
INSERT INTO tbl_auth VALUES("303","31","Client Two","client22@ahonline.co","Y201dGVjZW9pZw==","ACCOUNT MANAGER","2018-07-04 17:58:10");
INSERT INTO tbl_auth VALUES("304","40","Manager One","manone@ahonline.co","ZzJmbWdtd2M1cg==","MANAGER","2018-07-04 17:59:41");
INSERT INTO tbl_auth VALUES("305","32","Rentia Landman","rentia@landmanconsulting.co.za","UmVudGlhQDIy","ACCOUNT MANAGER","2018-07-04 21:44:13");
INSERT INTO tbl_auth VALUES("306","41","Monica Eckermann","monica.eckermann@Weylandtshome.co.za","cmh2eWthMGF0eA==","MANAGER","2018-07-04 21:53:03");
INSERT INTO tbl_auth VALUES("307","33","Jane Moors","jane@outerboxthinking.com","eHFoeHd4dXN5bg==","ACCOUNT MANAGER","2018-07-04 21:55:04");
INSERT INTO tbl_auth VALUES("308","34","Burgert van Jaarsveldt","burgert@benedict.bm","dHN6eXB3eHdxcQ==","ACCOUNT MANAGER","2018-07-04 21:56:35");
INSERT INTO tbl_auth VALUES("309","42","EP Landman","rentia.landman@gmail.com","UmVudGlhQDIy","MANAGER","2018-07-04 22:00:17");
INSERT INTO tbl_auth VALUES("312","159","Leanie Terblanche","strydomleanie@yahoo.com","d2Q3b2Z6czY3cA==","CANDIDATE","2018-07-04 22:13:00");
INSERT INTO tbl_auth VALUES("313","160","Blossoms ","blossomsoflove@hotmail.com","b2htczN0N3F1bw==","CANDIDATE","2018-07-04 22:13:59");
INSERT INTO tbl_auth VALUES("314","161","Daniel Magoro","dmagoro@ihs.za.com","cGgzYjZ3NWt6cw==","CANDIDATE","2018-07-05 15:53:45");
INSERT INTO tbl_auth VALUES("315","162","Bheki Monyakeng","davidmonyakeng@gmail.com","cnJheXp3ZWVqbQ==","CANDIDATE","2018-07-05 16:40:52");
INSERT INTO tbl_auth VALUES("316","163","Nkosinathi Aldrin Baloyi","abaloyi@ihs.za.com","cWRlcWVpNjJjMg==","CANDIDATE","2018-07-05 16:41:35");
INSERT INTO tbl_auth VALUES("317","164","Bheki Monyaken","davidmonyakeng@gmail.com","NGF2NTM4c28zeQ==","CANDIDATE","2018-07-06 08:50:01");
INSERT INTO tbl_auth VALUES("318","165","katlego Manoko Beauty","kmanoko@ihs.za.com","eGdkamRmcTh3OA==","CANDIDATE","2018-07-06 09:21:02");
INSERT INTO tbl_auth VALUES("320","167","Nompumelelo Maseko","namaseko.maseko1@gmail.com","MzVtcTN6YnBhcg==","CANDIDATE","2018-07-09 12:40:30");
INSERT INTO tbl_auth VALUES("321","168","David  van der Walt","davethomaswalt@gmail.com","YWdwNWI4bXVnbg==","CANDIDATE","2018-07-09 12:41:19");
INSERT INTO tbl_auth VALUES("322","169","Silindile Phakathi","slindile@hotmail.com","bWl4eHMzeTNqcQ==","CANDIDATE","2018-07-09 13:08:53");
INSERT INTO tbl_auth VALUES("323","170","Silindile Phakathi","slindile@hotmail.com","cHE4dnlrdTUyYQ==","CANDIDATE","2018-07-09 13:10:52");
INSERT INTO tbl_auth VALUES("324","171","Silindile Phakathi","slindile@hotmail.com","bXN3M2o1ZW1kaQ==","CANDIDATE","2018-07-09 13:15:07");
INSERT INTO tbl_auth VALUES("325","172","Neo Mfundisi","neodianamfundisi@gmail.com","M2ZkOGJhZmYybg==","CANDIDATE","2018-07-09 13:36:54");
INSERT INTO tbl_auth VALUES("326","173","Neo Mfundisi","neodianamfundisi@gmail.com","OHZnZGJqZGJtcg==","CANDIDATE","2018-07-09 13:41:26");
INSERT INTO tbl_auth VALUES("327","174","ZANDILE MAHLANGU","zsarah681@gmail.com","b3A0OHh2M2tmbg==","CANDIDATE","2018-07-09 14:15:36");
INSERT INTO tbl_auth VALUES("328","175","Precious Mangena","preciousmangena4@gmail.com","cjV2czNnbXRyNQ==","CANDIDATE","2018-07-09 14:58:07");
INSERT INTO tbl_auth VALUES("329","176","Thabo Ramorula","ramorulathabo@gmail.com","N2Z6aThrc2Vvag==","CANDIDATE","2018-07-09 16:02:30");
INSERT INTO tbl_auth VALUES("330","177","Ntombizakhe  Ngulube","judyntombi@gmail.com","dWNlZ2h3a3YzZQ==","CANDIDATE","2018-07-09 16:37:49");
INSERT INTO tbl_auth VALUES("331","178","Lerato  Ratshilule","ratshilulel@gmail.com","aThzNDd6ZDI1ZQ==","CANDIDATE","2018-07-09 17:30:41");
INSERT INTO tbl_auth VALUES("332","179","Thandile Titi","tandile.titi@gmail.com","c3V5aXAyZDU1dw==","CANDIDATE","2018-07-10 10:30:45");
INSERT INTO tbl_auth VALUES("333","180","Precious Mangena","preciousmangena4@gmail.com","dTZ5ODIyY3g4Nw==","CANDIDATE","2018-07-10 12:09:10");
INSERT INTO tbl_auth VALUES("334","181","Hillary Barry","Hilla78@live.co.za","YjgyY2JnN213cQ==","CANDIDATE","2018-07-10 12:10:50");
INSERT INTO tbl_auth VALUES("336","183","Charmaine Dlanga","charmainedlanga@gmail.com","YXIwam9xamh4eA==","CANDIDATE","2018-07-10 15:44:35");
INSERT INTO tbl_auth VALUES("337","184","Liz Wolfe","liz.wolfe@weylandtshome.co.za","eGllcTJiaDRhYw==","CANDIDATE","2018-07-10 15:53:24");
INSERT INTO tbl_auth VALUES("338","185","Andisiwe Dyantyi","andisiwedyantyi@gmail.com","aXpueWpjNnMzeA==","CANDIDATE","2018-07-10 15:53:54");
INSERT INTO tbl_auth VALUES("340","187","Samantha Adams","rapcaptree@gmail.com","Y3kyaHBmMHlldw==","CANDIDATE","2018-07-10 16:20:35");
INSERT INTO tbl_auth VALUES("341","188","vuyokazi Tetani","tetanivuvuv@gmail.com","dzZuNzh2OGYzMg==","CANDIDATE","2018-07-10 16:47:21");
INSERT INTO tbl_auth VALUES("342","189","Nelisa  Swartz","nelisaswartz@webmail.co.za","Z2pleWN0eGlldw==","CANDIDATE","2018-07-10 16:51:45");
INSERT INTO tbl_auth VALUES("343","190","Tania Green","officegreen9@gmail.com","bnVzazZnampzeA==","CANDIDATE","2018-07-10 20:08:24");
INSERT INTO tbl_auth VALUES("344","191","Judy Thebus","judythebus@gmail.com","eWRtYXdmM2NreA==","CANDIDATE","2018-07-10 20:43:06");
INSERT INTO tbl_auth VALUES("345","192","Carli du Plessis","carlidlange@gmail.com","bnFkNWt3Njdraw==","CANDIDATE","2018-07-10 22:35:07");
INSERT INTO tbl_auth VALUES("346","193","Justin Russell Pieterse","justin.russellr23@gmail.com","NXl5aHN3c3J2MA==","CANDIDATE","2018-07-10 22:48:06");
INSERT INTO tbl_auth VALUES("347","194","Justin Russell Pieterse","justin.russellr23@gmail.com","amVucXQ2aTRtZg==","CANDIDATE","2018-07-10 23:03:29");
INSERT INTO tbl_auth VALUES("348","195","Khulekani Biyela","khuliewise@gmail.com","bjhlczdieXZ4aw==","CANDIDATE","2018-07-11 00:20:03");
INSERT INTO tbl_auth VALUES("349","196","Najwa  Weinstein","najwein@gmail.com","enE4d25wcGczNw==","CANDIDATE","2018-07-11 08:02:01");
INSERT INTO tbl_auth VALUES("350","197","Naledi Ramokgopa","ramakgopan@gmail.com","NGdodWY0ZzJ0Zw==","CANDIDATE","2018-07-11 09:08:52");
INSERT INTO tbl_auth VALUES("351","198","Naledi Ramokgopa","ramakgopan@gmail.com","ZXFhcHIyY2dnNA==","CANDIDATE","2018-07-11 09:09:53");
INSERT INTO tbl_auth VALUES("352","199","Saafia Williams ","saafiawilliams@gmail.com","M3A4eml2eGEwdQ==","CANDIDATE","2018-07-11 09:14:26");
INSERT INTO tbl_auth VALUES("353","200","Donay O\'Reilly","oreillydonay@gmail.com","c2VidHI0YWRoNQ==","CANDIDATE","2018-07-11 10:45:49");
INSERT INTO tbl_auth VALUES("354","201","Andisiwe  Nomlomo ","gjivauhnmonson@gmail.com","bnhzcXJocm1zdQ==","CANDIDATE","2018-07-11 11:04:43");
INSERT INTO tbl_auth VALUES("355","202","Nokuthula Majova","majovathulaz@yahoo.com","aGhobWg4MnNiNA==","CANDIDATE","2018-07-11 11:34:24");
INSERT INTO tbl_auth VALUES("356","56","Liz Wolf","Liz.Wolf@Weylandtshome.co.za","aXhnaWk3NTZ1ZA==","RATER","2018-07-11 11:43:29");
INSERT INTO tbl_auth VALUES("357","57","Toni August","Toni.August@Weylandtshome.co.za","M3F4dnlqZ2J6cQ==","RATER","2018-07-11 11:44:16");
INSERT INTO tbl_auth VALUES("358","203","NOKUTHULA  MAJOVA ","majovathulaz@yahoo.com","cW8yejBuZXBqeQ==","CANDIDATE","2018-07-11 11:58:31");
INSERT INTO tbl_auth VALUES("359","204","Bianca Savahl","bianca.savahl@gmail.com","Y25rbjV5YjNocA==","CANDIDATE","2018-07-11 13:13:33");
INSERT INTO tbl_auth VALUES("360","205","Craig Haupt","hauptcc@gmail.com","bTdwM3gwdGZwZA==","CANDIDATE","2018-07-11 13:21:12");
INSERT INTO tbl_auth VALUES("361","206","khaanyisa kayo","kayokhanyisa@icloud.com","cHN3dWFlenp0cA==","CANDIDATE","2018-07-11 15:11:29");
INSERT INTO tbl_auth VALUES("362","207","Sphesihle Ntombela ","Ntombelasphesihle@gmail.com","anZtZ2QwbWJtaA==","CANDIDATE","2018-07-11 16:28:29");
INSERT INTO tbl_auth VALUES("363","208","Pascalina  Makganamisha","Pmakganamisha@yahoo.com","aTgzMG44ZzJzaw==","CANDIDATE","2018-07-11 16:37:13");
INSERT INTO tbl_auth VALUES("364","209","Vuyokazi  Molly ","robsonkachepa@gmail.com","MnR4ODRucXBlag==","CANDIDATE","2018-07-11 17:14:17");
INSERT INTO tbl_auth VALUES("365","210","Lyruz Louis","louislyruz@gmail.com","bXF6dGhrcXYzbQ==","CANDIDATE","2018-07-11 18:50:37");
INSERT INTO tbl_auth VALUES("366","211","Zizipho Petu","Ziziphopetu@gmail.com","dGZya3hhM3lzag==","CANDIDATE","2018-07-11 19:59:42");
INSERT INTO tbl_auth VALUES("367","212","SEBABATSO LEHULA","lehulasebabatso@gmail.com","d3NxYTJ5N2J4cA==","CANDIDATE","2018-07-12 08:47:50");
INSERT INTO tbl_auth VALUES("368","213","vuyokazi molly","vuyokazimolly@gmail.com","emdnb3FqNzNuNA==","CANDIDATE","2018-07-12 10:38:23");
INSERT INTO tbl_auth VALUES("369","214","David van der Walt","davethomaswalt@gmail.com","cXR3dmp0YzNidg==","CANDIDATE","2018-07-12 11:19:46");
INSERT INTO tbl_auth VALUES("370","215","Ntombizakhe  Ngulube","judyntombi@gmail.com","Nzh5MzZ0M2l3eg==","CANDIDATE","2018-07-12 12:58:42");
INSERT INTO tbl_auth VALUES("371","216","Lorraine  Luthaga","lkluthaga@gmail.com","NmJoc3c2YWRjNA==","CANDIDATE","2018-07-12 15:32:41");
INSERT INTO tbl_auth VALUES("372","217","Silindile Phakathi","slindile@hotmail.com","eDRoa2pqN253Zw==","CANDIDATE","2018-07-12 17:34:21");
INSERT INTO tbl_auth VALUES("373","218","Zizipho Petu","Ziziphopetu@gmail.com","d21kZHAweXY1dg==","CANDIDATE","2018-07-13 11:33:39");




CREATE TABLE `tbl_candidate` (
  `candidate_id` int(11) NOT NULL AUTO_INCREMENT,
  `manager_id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=219 DEFAULT CHARSET=latin1;

INSERT INTO tbl_candidate VALUES("6","23","Candidate","One","candidate1@ahonline.co","436346","","44334","0000-00-00","male","21","ZAF","white","high_school","single_never_married","employed_full_time","other","administration/entry_level","1","2018-03-30 07:54:04");
INSERT INTO tbl_candidate VALUES("7","23","Candidate","Two","candidate2@ahonline.co","","","","0000-00-00","","0","","","","","","","","0","2018-03-30 07:54:04");
INSERT INTO tbl_candidate VALUES("8","23","Candidate","Three","candidate3@ahonline.co","","","","0000-00-00","","0","","","","","","","","0","2018-03-30 07:54:36");
INSERT INTO tbl_candidate VALUES("9","23","Candidate","Four","candidate4@ahonline.co","0000","","00000","0000-00-00","male","48","ZAF","white","high_school","single_never_married","employed_full_time","tswana","administration/entry_level","1","2018-03-30 07:54:36");
INSERT INTO tbl_candidate VALUES("11","44","Candidate","Alpha","canalpha@ahonline.co","","","","0000-00-00","","0","","","","","","","","1","2018-04-03 12:47:48");
INSERT INTO tbl_candidate VALUES("13","44","John","van","john@ahonline.co","0000","","0000","0000-00-00","male","48","ZAF","white","high_school","single_never_married","employed_full_time","other","administration/entry_level","1","2018-04-03 13:00:39");
INSERT INTO tbl_candidate VALUES("15","43","Ciska","van Aswegen","cvanaswegen@ih.co.za","000","","000","0000-00-00","female","48","ZAF","white","high_school","single_never_married","employed_full_time","other","administration/entry_level","1","2018-04-03 15:45:44");
INSERT INTO tbl_candidate VALUES("16","44","Sue","Smith","ssmith@ahonline.co","000","","0000","0000-00-00","male","38","ZAF","white","high_school","single_never_married","employed_full_time","other","administration/entry_level","1","2018-04-03 21:00:55");
INSERT INTO tbl_candidate VALUES("25","43","Merida","Red","ciska@assessmenthouse.com","00","","000","0000-00-00","male","27","ZAF","white","high_school","single_never_married","employed_full_time","other","administration/entry_level","1","2018-04-04 21:31:05");
INSERT INTO tbl_candidate VALUES("29","43","Jasmine","Aladdin","ciskavaswegen@gmail.com","00","","00","0000-00-00","female","37","ZAF","white","high_school","single_never_married","employed_full_time","other","administration/entry_level","1","2018-04-05 08:17:19");
INSERT INTO tbl_candidate VALUES("30","43","Sleeping"," Beauty","training.assess@gmail.com","00","","00","0000-00-00","female","24","ZAF","white","high_school","single_never_married","employed_full_time","other","administration/entry_level","1","2018-04-05 08:17:19");
INSERT INTO tbl_candidate VALUES("31","43","Debri"," van Wyk","dvanwyk@ih.co.za","44444","","4444","0000-00-00","male","43","ZAF","white","high_school","single_never_married","employed_full_time","other","administration/entry_level","1","2018-04-05 08:57:33");
INSERT INTO tbl_candidate VALUES("32","43","Test","test","cvanaswegen@ih.co.za","00","","00","0000-00-00","female","74","ZAF","white","high_school","single_never_married","employed_full_time","other","administration/entry_level","1","2018-04-05 09:29:47");
INSERT INTO tbl_candidate VALUES("33","43","Test","test","training.assess@gmail.com","000","","000","0000-00-00","male","34","ZAF","white","high_school","single_never_married","employed_full_time","other","administration/entry_level","1","2018-04-05 09:30:30");
INSERT INTO tbl_candidate VALUES("34","43","Travis","Yates","hykoju227@gmail.com","111111111","","11111","0000-00-00","male","25","USA","white","masters_degree","single_never_married","self-employed","english","professional/specialist","1","2018-04-05 09:42:43");
INSERT INTO tbl_candidate VALUES("35","43","Marco","Meyer","marco@eastvaal.co.za","0824430847","","7903055110082","0000-00-00","male","39","ZAF","white","college_certificate","married_or_domestic_partnership","employed_full_time","afrikaans","middle_management","1","2018-04-05 10:47:37");
INSERT INTO tbl_candidate VALUES("36","43","Yvonne","Mtshali","ymtshali@um.co.za","0835684768","","8305120939082","0000-00-00","female","34","ZAF","black_or_african","college_certificate","married_or_domestic_partnership","employed_full_time","english","middle_management","1","2018-04-05 10:48:46");
INSERT INTO tbl_candidate VALUES("37","43","Yvonne"," Mtshali","training.assess@gmail.com","0835684768","","830512093982","0000-00-00","female","34","ZAF","black_or_african","college_certificate","married_or_domestic_partnership","employed_full_time","english","middle_management","1","2018-04-05 10:54:46");
INSERT INTO tbl_candidate VALUES("38","43","Johannes Gerhardus","van Vuuren","evanvuuren@imperialrenault.co.za","0797905880","","8508285171082","0000-00-00","male","32","ZAF","white","high_school","single_never_married","employed_full_time","afrikaans","middle_management","1","2018-04-05 12:54:12");
INSERT INTO tbl_candidate VALUES("39","43","Dale","Skinner","dales@renaultroute24.co.za","0723883194","","8401095122083","0000-00-00","male","33","ZAF","white","high_school","married_or_domestic_partnership","employed_full_time","english","middle_management","1","2018-04-05 12:56:44");
INSERT INTO tbl_candidate VALUES("73","43","renay","litsili","renayl@multifranchise.co.za","0835461950","","6306250064081","0000-00-00","female","54","ZAF","white","high_school","married_or_domestic_partnership","employed_full_time","afrikaans","middle_management","1","2018-04-06 08:44:11");
INSERT INTO tbl_candidate VALUES("77","43","Christo","Saidt","christosa@cmh.co.za","0846408881","","7501265005082","0000-00-00","male","43","ZAF","white","high_school","single_never_married","employed_full_time","afrikaans","middle_management","1","2018-04-06 08:54:08");
INSERT INTO tbl_candidate VALUES("82","43","Gary","Naidoo","garyn@tangawizi.co.za","0835461292","","7310095189086","0000-00-00","male","44","ZAF","asian","high_school","single_never_married","employed_full_time","english","senior_management","1","2018-04-06 09:00:11");
INSERT INTO tbl_candidate VALUES("84","43","Gabi","Morris","gabithemorris@gmail.com","0769892474","","9302250131084","0000-00-00","female","25","ZAF","white","honours_degree","single_never_married","employed_full_time","english","administration/entry_level","1","2018-04-06 09:29:54");
INSERT INTO tbl_candidate VALUES("85","43","Debri","van Wyk","renault@ahonline.co","4444","","00000","0000-00-00","male","38","ZAF","white","high_school","single_never_married","employed_full_time","other","administration/entry_level","1","2018-04-06 10:06:27");
INSERT INTO tbl_candidate VALUES("86","144","Candidate"," Three Myself","can3@ahonline.co","4444","","00000","0000-00-00","male","68","ZAF","white","high_school","single_never_married","employed_full_time","other","administration/entry_level","1","2018-04-06 10:31:37");
INSERT INTO tbl_candidate VALUES("87","144","Candidate"," Four","can4@ahonline.co","4444","","3333","0000-00-00","male","37","ZAF","white","high_school","single_never_married","employed_full_time","other","administration/entry_level","1","2018-04-06 10:31:37");
INSERT INTO tbl_candidate VALUES("88","144","Candidate"," Five","can5@ahonline.co","","","","0000-00-00","","0","","","","","","","","0","2018-04-06 10:31:37");
INSERT INTO tbl_candidate VALUES("89","43","Gary","Naidoo","garyn@tangawizi.co.za","0835461292","","7310095189086","0000-00-00","male","44","ZAF","asian","high_school","single_never_married","employed_full_time","english","junior_management/supervisory","1","2018-04-06 10:46:56");
INSERT INTO tbl_candidate VALUES("90","43","Christo","Saidt","christosa@cmh.co.za","0846408881","","7501265005082","0000-00-00","male","43","ZAF","white","high_school","divorced","employed_full_time","afrikaans","middle_management","1","2018-04-06 10:47:01");
INSERT INTO tbl_candidate VALUES("91","43","renay","litsili","renayl@multifranchise.co.za","0835461950","","6306250064081","0000-00-00","female","54","ZAF","white","high_school","married_or_domestic_partnership","employed_full_time","afrikaans","middle_management","1","2018-04-06 10:47:56");
INSERT INTO tbl_candidate VALUES("92","144","John"," Andrew Smith","jas@ahonline.co","4444","","4444","0000-00-00","male","48","ZAF","white","high_school","single_never_married","employed_full_time","other","administration/entry_level","1","2018-04-06 10:56:49");
INSERT INTO tbl_candidate VALUES("93","43","Penny","Neighbour","penny@qims.co.za","000","","000","0000-00-00","male","34","ZAF","white","high_school","single_never_married","employed_full_time","other","administration/entry_level","1","2018-04-06 11:43:12");
INSERT INTO tbl_candidate VALUES("94","43","Amy"," Farrah Fowler","aff@qims.co.za","00","","00","0000-00-00","male","44","ZAF","white","high_school","single_never_married","employed_full_time","other","administration/entry_level","1","2018-04-06 11:43:12");
INSERT INTO tbl_candidate VALUES("95","43","Shaun","Hamilton","shaun@renaultnorthcliff.co.za","0797348567","","7405145155085","1974-05-14","male","43","ZAF","white","high_school","single_never_married","employed_full_time","english","middle_management","1","2018-04-06 13:03:14");
INSERT INTO tbl_candidate VALUES("96","43","Bernadette","","bernie@qims.co.za","","","","0000-00-00","","0","","","","","","","","0","2018-04-06 14:18:12");
INSERT INTO tbl_candidate VALUES("97","44","Sunday","Testing Again","sunday@ahonline.co","0000","","0000","0000-00-00","male","49","ZAF","white","high_school","single_never_married","employed_full_time","other","administration/entry_level","1","2018-04-08 17:08:26");
INSERT INTO tbl_candidate VALUES("98","44","Sunday","Testing Too","sundaytoo@ahonline.co","555","","0000","0000-00-00","male","38","ZAF","white","high_school","single_never_married","employed_full_time","other","administration/entry_level","1","2018-04-08 17:11:49");
INSERT INTO tbl_candidate VALUES("99","168","Keona","","blossomsoflove@hotmail.com","","","","0000-00-00","","0","","","","","","","","0","2018-04-08 22:20:05");
INSERT INTO tbl_candidate VALUES("100","168","Keona","","blossomsoflove@hotmail.com","","","","0000-00-00","","0","","","","","","","","0","2018-04-08 22:24:30");
INSERT INTO tbl_candidate VALUES("101","187","Can"," me agin","canme@ahonline.co","333","","4444","0000-00-00","male","48","ZAF","white","high_school","single_never_married","employed_full_time","other","administration/entry_level","1","2018-04-10 12:26:27");
INSERT INTO tbl_candidate VALUES("102","196","test"," candidate","candidate@mailinator.com","2165484","","kkjwd","0000-00-00","male","9","ZAF","white","high_school","single_never_married","employed_full_time","other","administration/entry_level","1","2018-04-10 13:35:58");
INSERT INTO tbl_candidate VALUES("103","196","test"," candidate 2","candidate2@mailinator.com","265498556184","","ddfhtrht","0000-00-00","male","9","ZAF","white","high_school","single_never_married","employed_full_time","other","administration/entry_level","1","2018-04-10 13:46:33");
INSERT INTO tbl_candidate VALUES("104","43","Willem","Fourie","willem@renaultbryanston.co.za","0117079000","","0822904551","0000-00-00","male","51","ZAF","white","college_certificate","married_or_domestic_partnership","employed_full_time","afrikaans","middle_management","1","2018-04-11 08:38:54");
INSERT INTO tbl_candidate VALUES("105","43","Kamil","Sarup","kamil@renaultrandburg.co.za","0833166919","","8503205159085","0000-00-00","male","33","ZAF","asian","high_school","married_or_domestic_partnership","employed_full_time","english","middle_management","1","2018-04-11 08:57:06");
INSERT INTO tbl_candidate VALUES("106","43","Phumi"," Masinga","phumim@hyundai.co.za","","","","0000-00-00","","0","","","","","","","","0","2018-04-11 08:58:41");
INSERT INTO tbl_candidate VALUES("107","43","abbie","legodi","abbie@renaultfourways.co.za","0720581383","","8811195219086","0000-00-00","male","29","ZAF","black_or_african","college_diploma","married_or_domestic_partnership","employed_full_time","sotho","executive_management","1","2018-04-11 09:02:28");
INSERT INTO tbl_candidate VALUES("108","43","Phumi"," Masinga","phumim@qims.co.za","0817672348","","8512280723087","0000-00-00","female","32","ZAF","black_or_african","college_diploma","single_never_married","employed_full_time","zulu","junior_management/supervisory","1","2018-04-11 09:03:34");
INSERT INTO tbl_candidate VALUES("109","43","Evert","Breedt","evert@renaulteeastrand.co.za","08345436874","","7011205246085","1970-11-20","male","47","ZAF","white","college_diploma","married_or_domestic_partnership","employed_full_time","afrikaans","middle_management","1","2018-04-11 09:10:09");
INSERT INTO tbl_candidate VALUES("110","196","test"," test","test@mailinator.com","","","","0000-00-00","","0","","","","","","","","0","2018-04-11 10:45:33");
INSERT INTO tbl_candidate VALUES("111","223","pbatodiya","","p.batodiya@gmail.com","","","","0000-00-00","","0","","","","","","","","0","2018-04-11 12:11:49");
INSERT INTO tbl_candidate VALUES("112","44","sdasd","","dd@ahonline.co","","","","0000-00-00","","0","","","","","","","","0","2018-04-11 12:33:20");
INSERT INTO tbl_candidate VALUES("113","232","Stuart"," Bloom","comics@qims.co.za","0000","","000000","0000-00-00","male","47","ZAF","white","high_school","single_never_married","employed_full_time","other","administration/entry_level","1","2018-04-15 16:23:49");
INSERT INTO tbl_candidate VALUES("114","232","Leslie"," Winkle","leslie@qims.co.za","0000","","0000","0000-00-00","male","53","ZAF","white","high_school","single_never_married","employed_full_time","other","administration/entry_level","1","2018-04-15 16:23:49");
INSERT INTO tbl_candidate VALUES("115","44","test","test","test@ahonline.co","0000","","0000","0000-00-00","male","-1","ZAF","white","high_school","single_never_married","employed_full_time","other","administration/entry_level","1","2018-04-16 20:39:44");
INSERT INTO tbl_candidate VALUES("117","239","Marikje"," Jakobsen","marikje@firedisaster.co.za","","","","0000-00-00","","0","","","","","","","","0","2018-04-16 21:50:30");
INSERT INTO tbl_candidate VALUES("120","44","Test","yest","test@hctalent.co.za","000","","0000","0000-00-00","male","58","ZAF","white","high_school","single_never_married","employed_full_time","other","administration/entry_level","1","2018-04-25 11:36:16");
INSERT INTO tbl_candidate VALUES("123","168","Leanie"," Terblance","strydomleanie@yahoo.com","","","","0000-00-00","","0","","","","","","","","0","2018-04-28 19:08:38");
INSERT INTO tbl_candidate VALUES("124","168","Alexandra"," Hund","Alexandra.Hund@gmx.de","491637187142","","983409854","0000-00-00","male","46","ZAF","white","high_school","single_never_married","employed_full_time","other","administration/entry_level","1","2018-05-02 17:57:50");
INSERT INTO tbl_candidate VALUES("125","44","min","yu","develop.minyu@gmail.com","1","","816554411748126","0000-00-00","male","43","ZAF","white","high_school","single_never_married","employed_full_time","other","administration/entry_level","1","2018-05-04 17:10:46");
INSERT INTO tbl_candidate VALUES("126","44","hi","kk","yayzooyama@gmail.com","8754567843","","aa","0000-00-00","male","-1","ZAF","white","high_school","single_never_married","employed_full_time","other","administration/entry_level","1","2018-05-04 17:12:29");
INSERT INTO tbl_candidate VALUES("127","44","a","a","a@a.com","7777777","","1156132424461812","0000-00-00","male","20","ZAF","white","high_school","single_never_married","employed_full_time","other","administration/entry_level","1","2018-05-04 17:18:00");
INSERT INTO tbl_candidate VALUES("128","44","testing","tesitng","devasda@gmail.com","01684556512","","490013213213","0000-00-00","male","18","ZAF","white","high_school","single_never_married","employed_full_time","other","junior_management/supervisory","1","2018-05-04 17:19:01");
INSERT INTO tbl_candidate VALUES("129","44","YinFeng","Piao","beautistar1112@gmail.com","8617189765309","","Abc123","1989-03-27","female","29","CHN","asian","high_school","single_never_married","employed_full_time","chinese","senior_management","1","2018-05-04 17:21:09");
INSERT INTO tbl_candidate VALUES("130","44","aa","bb","suns880110@yandex.com","13223840283","","G13830788","0000-00-00","male","31","CHN","white","high_school","single_never_married","employed_full_time","chinese","professional/specialist","1","2018-05-04 17:21:16");
INSERT INTO tbl_candidate VALUES("131","44","Zui","en","sarlongda514@gmail.com","8562091823951","","adfd","0000-00-00","male","-1","ZAF","white","high_school","single_never_married","employed_full_time","other","administration/entry_level","1","2018-05-04 17:22:09");
INSERT INTO tbl_candidate VALUES("132","44","Zui","en","sarlongda514@gmail.com","8562091823951","","adfd","0000-00-00","male","-1","ZAF","white","high_school","single_never_married","employed_full_time","other","administration/entry_level","1","2018-05-04 17:26:05");
INSERT INTO tbl_candidate VALUES("133","44","Sharribu","Tsener","bristalback47@mail.ru","78527845985","","Bris","1989-11-24","male","28","ZAF","white","high_school","single_never_married","employed_full_time","other","administration/entry_level","1","2018-05-04 17:27:07");
INSERT INTO tbl_candidate VALUES("134","44","Vladimir","Marenchuk","vladimir.marenchuk211@gmail.com","9996186239","","8600011632","1986-04-09","male","32","ZAF","white","high_school","single_never_married","employed_full_time","other","administration/entry_level","1","2018-05-04 17:29:34");
INSERT INTO tbl_candidate VALUES("135","44","Zui","en","acdedfadaabc@gmail.com","8562091823951","","adfdasf","0000-00-00","male","23","ZAF","white","high_school","single_never_married","employed_full_time","other","administration/entry_level","1","2018-05-04 17:44:54");
INSERT INTO tbl_candidate VALUES("136","44","aaa","aaa","aaa@aaa.com","8562091823951","","aaa","0000-00-00","male","21","ZAF","white","high_school","single_never_married","employed_full_time","other","administration/entry_level","1","2018-05-04 17:51:58");
INSERT INTO tbl_candidate VALUES("137","44","cvv","jhg","vchouhan@doomshell.com","9460528470","","cdc","0000-00-00","male","29","IND","white","high_school","single_never_married","employed_full_time","english","executive_management","1","2018-05-04 20:43:58");
INSERT INTO tbl_candidate VALUES("138","44","DaoHaung","Vue","ihs_1993@outlook.com","213456456","","ihs_1993@outlook.com","1993-05-28","male","24","ZAF","white","high_school","single_never_married","employed_full_time","other","administration/entry_level","1","2018-05-04 21:05:41");
INSERT INTO tbl_candidate VALUES("139","44","Bb","bs","alecksey0301@gmail.com","73334224567","","123","0000-00-00","male","23","ZAF","white","high_school","single_never_married","employed_full_time","other","administration/entry_level","1","2018-05-05 03:33:43");
INSERT INTO tbl_candidate VALUES("140","223","James"," Bond","p.batodiya@gmail.com","1234567","","23355","0000-00-00","male","20","ZAF","white","high_school","single_never_married","employed_full_time","other","administration/entry_level","1","2018-05-06 17:08:20");
INSERT INTO tbl_candidate VALUES("141","168","Bryce"," Dekker","bryce@directiondd.co.za","","","","0000-00-00","","0","","","","","","","","0","2018-05-08 08:28:25");
INSERT INTO tbl_candidate VALUES("142","168","Jennifer"," Dutton","Jennifer.Dutton@directaxis.co.za","","","","0000-00-00","","0","","","","","","","","0","2018-05-08 20:44:38");
INSERT INTO tbl_candidate VALUES("143","168","Leigh-Anne"," Swartz","Leigh-Anne.Swartz@directaxis.co.za","","","","0000-00-00","","0","","","","","","","","0","2018-05-08 20:44:38");
INSERT INTO tbl_candidate VALUES("144","168","Zurika"," Nabbi","Zurika.Nabbi@directaxis.co.za","","","","0000-00-00","","0","","","","","","","","0","2018-05-09 10:48:05");
INSERT INTO tbl_candidate VALUES("145","168","Samantha"," Langeveldt","Samantha.Langeveldt@directaxis.co.za","","","","0000-00-00","","0","","","","","","","","0","2018-05-09 10:48:05");
INSERT INTO tbl_candidate VALUES("146","168","Astrid"," Ruiters","Astrid@bidvestedge.co.za","","","","0000-00-00","","0","","","","","","","","0","2018-05-10 20:02:35");
INSERT INTO tbl_candidate VALUES("147","168","Elzette"," Fourie","elzette@elzettefourie.com","0741039228","","8009100146086","0000-00-00","female","37","ZAF","white","college_diploma","single_never_married","self-employed","english","professional/specialist","1","2018-05-30 15:58:47");
INSERT INTO tbl_candidate VALUES("149","168","Wea"," van Heerden","wea@assessmenttoolbox.co.za","","","","0000-00-00","","0","","","","","","","","0","2018-05-31 14:29:56");
INSERT INTO tbl_candidate VALUES("150","168","Mrs"," Vermeulen","michellelindavermeulen@gmail.com","0837421904","","8107080191088","0000-00-00","female","36","ZAF","white","bachelors_degree","married_or_domestic_partnership","employed_full_time","english","senior_management","1","2018-06-19 12:11:11");
INSERT INTO tbl_candidate VALUES("152","223","James"," Bond-2","p.batodiya@gmail.com","555","","816554411748126","0000-00-00","male","10","ZAF","white","high_school","single_never_married","employed_full_time","other","administration/entry_level","1","2018-06-22 10:42:47");
INSERT INTO tbl_candidate VALUES("153","43","Sales"," Sam","saless@qims.co.za","0000000000","","0000000000000","0000-00-00","male","1","ZAF","white","high_school","single_never_married","employed_full_time","other","administration/entry_level","1","2018-06-25 08:15:41");
INSERT INTO tbl_candidate VALUES("154","43","Veronica"," Mthombeni","Veronica.Mthombeni@imperiallogistics.com","0126214642","","7811280405088","0000-00-00","female","39","ZAF","black_or_african","college_diploma","married_or_domestic_partnership","employed_full_time","tswana","middle_management","1","2018-07-04 12:55:27");
INSERT INTO tbl_candidate VALUES("155","43","Colette"," Wessels","Colette.Wessels@imperiallogistics.com","","","","0000-00-00","","0","","","","","","","","0","2018-07-04 12:55:27");
INSERT INTO tbl_candidate VALUES("156","43","Ciska"," van Aswegen","cvanaswegen@ih.co.za","0000000000","","0000000000000","0000-00-00","male","25","ZAF","white","high_school","single_never_married","employed_full_time","other","administration/entry_level","1","2018-07-04 12:56:04");
INSERT INTO tbl_candidate VALUES("157","43","Ciska","van Aswegen","assessment@ih.co.za","0000000000","","0000000000000","0000-00-00","male","25","ZAF","white","high_school","single_never_married","employed_full_time","other","administration/entry_level","1","2018-07-04 14:47:20");
INSERT INTO tbl_candidate VALUES("158","43","Veronica","Mthombeni","veronica.mthombeni@imperiallogistics.co.za","0126214300","","666624680067334","0000-00-00","female","40","ZAF","black_or_african","high_school","single_never_married","employed_full_time","zulu","administration/entry_level","1","2018-07-04 15:04:18");
INSERT INTO tbl_candidate VALUES("159","309","Leanie"," Terblanche","strydomleanie@yahoo.com","","","","0000-00-00","","0","","","","","","","","0","2018-07-04 22:13:00");
INSERT INTO tbl_candidate VALUES("160","309","Blossoms"," ","blossomsoflove@hotmail.com","","","","0000-00-00","","0","","","","","","","","0","2018-07-04 22:13:59");
INSERT INTO tbl_candidate VALUES("161","43","Daniel","Magoro","dmagoro@ihs.za.com","0723854829","","8902185929089","0000-00-00","male","29","ZAF","black_or_african","high_school","single_never_married","employed_full_time","northern_sotho","administration/entry_level","1","2018-07-05 15:53:45");
INSERT INTO tbl_candidate VALUES("162","43","Bheki","Monyakeng","davidmonyakeng@gmail.com","0623225750","","9004306209084","1990-04-30","male","28","ZAF","black_or_african","high_school","single_never_married","employed_part_time","zulu","administration/entry_level","1","2018-07-05 16:40:52");
INSERT INTO tbl_candidate VALUES("163","43","Nkosinathi Aldrin","Baloyi","abaloyi@ihs.za.com","0730302097","","9003286116087","0000-00-00","male","28","ZAF","black_or_african","college_diploma","single_never_married","employed_full_time","tsonga","administration/entry_level","1","2018-07-05 16:41:35");
INSERT INTO tbl_candidate VALUES("164","43","Bheki","Monyaken","davidmonyakeng@gmail.com","0623225750","","9004306209084","1990-04-30","male","28","ZAF","black_or_african","high_school","single_never_married","employed_full_time","zulu","administration/entry_level","1","2018-07-06 08:50:01");
INSERT INTO tbl_candidate VALUES("165","43","katlego Manoko","Beauty","kmanoko@ihs.za.com","0719698945","","8808181086081","0000-00-00","female","29","ZAF","black_or_african","high_school","single_never_married","employed_full_time","english","administration/entry_level","1","2018-07-06 09:21:02");
INSERT INTO tbl_candidate VALUES("167","306","Nompumelelo","Maseko","namaseko.maseko1@gmail.com","0534781214","","8311090655088","0000-00-00","male","34","ZAF","white","high_school","single_never_married","employed_full_time","other","middle_management","1","2018-07-09 12:40:30");
INSERT INTO tbl_candidate VALUES("168","306","David ","van der Walt","davethomaswalt@gmail.com","0826606386","","9102075015086","0000-00-00","male","27","ZAF","white","high_school","single_never_married","out_of_work_and_looking_for_work","english","middle_management","1","2018-07-09 12:41:19");
INSERT INTO tbl_candidate VALUES("169","306","Silindile","Phakathi","slindile@hotmail.com","0608401451","","9209081438085","0000-00-00","female","25","ZAF","black_or_african","high_school","single_never_married","employed_full_time","zulu","junior_management/supervisory","1","2018-07-09 13:08:53");
INSERT INTO tbl_candidate VALUES("170","306","Silindile","Phakathi","slindile@hotmail.com","0608401451","","9209081438085","0000-00-00","male","25","ZAF","white","high_school","single_never_married","employed_full_time","zulu","administration/entry_level","1","2018-07-09 13:10:52");
INSERT INTO tbl_candidate VALUES("171","306","Silindile","Phakathi","slindile@hotmail.com","0608401451","","9209081438085","0000-00-00","male","25","ZAF","black_or_african","high_school","single_never_married","employed_full_time","zulu","administration/entry_level","1","2018-07-09 13:15:07");
INSERT INTO tbl_candidate VALUES("172","306","Neo","Mfundisi","neodianamfundisi@gmail.com","0622920044","","9505290272086","0000-00-00","female","23","ZAF","black_or_african","high_school","single_never_married","employed_full_time","zulu","administration/entry_level","1","2018-07-09 13:36:54");
INSERT INTO tbl_candidate VALUES("173","306","Neo","Mfundisi","neodianamfundisi@gmail.com","0622920044","","9505290272086","0000-00-00","male","23","ZAF","white","high_school","single_never_married","employed_full_time","other","administration/entry_level","1","2018-07-09 13:41:26");
INSERT INTO tbl_candidate VALUES("174","306","ZANDILE","MAHLANGU","zsarah681@gmail.com","0846646963","","9707180521081","0000-00-00","female","20","ZAF","black_or_african","high_school","single_never_married","employed_full_time","zulu","administration/entry_level","1","2018-07-09 14:15:36");
INSERT INTO tbl_candidate VALUES("175","306","Precious","Mangena","preciousmangena4@gmail.com","0790743110","","9202160637081","0000-00-00","female","26","ZAF","black_or_african","college_diploma","single_never_married","employed_full_time","northern_sotho","administration/entry_level","1","2018-07-09 14:58:07");
INSERT INTO tbl_candidate VALUES("176","306","Thabo","Ramorula","ramorulathabo@gmail.com","0782519359","","8309035763082","0000-00-00","male","34","ZAF","black_or_african","high_school","single_never_married","out_of_work_and_looking_for_work","tswana","middle_management","1","2018-07-09 16:02:30");
INSERT INTO tbl_candidate VALUES("177","306","Ntombizakhe ","Ngulube","judyntombi@gmail.com","0788475613","","8211261060086","0000-00-00","female","35","ZAF","black_or_african","high_school","single_never_married","employed_full_time","zulu","middle_management","1","2018-07-09 16:37:49");
INSERT INTO tbl_candidate VALUES("178","306","Lerato ","Ratshilule","ratshilulel@gmail.com","817590487","","9608250578086","1996-08-25","female","21","ZAF","black_or_african","high_school","single_never_married","employed_full_time","tsonga","middle_management","1","2018-07-09 17:30:41");
INSERT INTO tbl_candidate VALUES("179","306","Thandile","Titi","tandile.titi@gmail.com","0734283852","","8607315920086","0000-00-00","male","32","ZAF","black_or_african","high_school","single_never_married","out_of_work_and_looking_for_work","xhosa","administration/entry_level","1","2018-07-10 10:30:45");
INSERT INTO tbl_candidate VALUES("180","306","Precious","Mangena","preciousmangena4@gmail.com","790743110","","9202160637081","0000-00-00","female","26","ZAF","black_or_african","college_diploma","single_never_married","employed_full_time","northern_sotho","administration/entry_level","1","2018-07-10 12:09:10");
INSERT INTO tbl_candidate VALUES("181","306","Hillary","Barry","Hilla78@live.co.za","0724937540","","7810150188089","0000-00-00","female","39","ZAF","coloured","high_school","divorced","out_of_work_and_looking_for_work","afrikaans","middle_management","1","2018-07-10 12:10:50");
INSERT INTO tbl_candidate VALUES("183","306","Charmaine","Dlanga","charmainedlanga@gmail.com","082 719 3591","","8710190969085","0000-00-00","female","30","ZAF","black_or_african","high_school","single_never_married","employed_full_time","xhosa","administration/entry_level","1","2018-07-10 15:44:35");
INSERT INTO tbl_candidate VALUES("184","306","Liz","Wolfe","liz.wolfe@weylandtshome.co.za","0219141433","","1701271150141554","0000-00-00","male","97","ZAF","white","masters_degree","single_never_married","employed_full_time","spanish","professional/specialist","1","2018-07-10 15:53:24");
INSERT INTO tbl_candidate VALUES("185","306","Andisiwe","Dyantyi","andisiwedyantyi@gmail.com","0784160190","","9204071117088","0000-00-00","female","26","ZAF","black_or_african","college_diploma","single_never_married","employed_part_time","xhosa","administration/entry_level","1","2018-07-10 15:53:54");
INSERT INTO tbl_candidate VALUES("187","306","Samantha","Adams","rapcaptree@gmail.com","0832676369","","8312020246089","0000-00-00","female","34","ZAF","coloured","high_school","divorced","employed_full_time","english","junior_management/supervisory","1","2018-07-10 16:20:35");
INSERT INTO tbl_candidate VALUES("188","306","vuyokazi","Tetani","tetanivuvuv@gmail.com","0786824746","","9209231067081","0000-00-00","male","25","ZAF","black_or_african","college_diploma","single_never_married","out_of_work_and_looking_for_work","xhosa","administration/entry_level","1","2018-07-10 16:47:21");
INSERT INTO tbl_candidate VALUES("189","306","Nelisa ","Swartz","nelisaswartz@webmail.co.za","0735107338","","8706030870087","0000-00-00","female","31","ZAF","black_or_african","college_diploma","single_never_married","employed_full_time","xhosa","junior_management/supervisory","1","2018-07-10 16:51:45");
INSERT INTO tbl_candidate VALUES("190","306","Tania","Green","officegreen9@gmail.com","0827407588","","8302210105088","0000-00-00","female","35","ZAF","white","high_school","married_or_domestic_partnership","out_of_work_and_looking_for_work","afrikaans","administration/entry_level","1","2018-07-10 20:08:24");
INSERT INTO tbl_candidate VALUES("191","306","Judy","Thebus","judythebus@gmail.com","0761725834","","8208250102085","0000-00-00","female","35","ZAF","coloured","college_diploma","divorced","out_of_work_and_looking_for_work","english","administration/entry_level","1","2018-07-10 20:43:06");
INSERT INTO tbl_candidate VALUES("192","306","Carli","du Plessis","carlidlange@gmail.com","0823982854","","8403150115085","0000-00-00","female","34","ZAF","white","high_school","married_or_domestic_partnership","employed_full_time","afrikaans","administration/entry_level","1","2018-07-10 22:35:07");
INSERT INTO tbl_candidate VALUES("193","306","Justin Russell","Pieterse","justin.russellr23@gmail.com","0820532070","","890708513008","0000-00-00","male","29","ZAF","white","bachelors_degree","married_or_domestic_partnership","employed_full_time","english","junior_management/supervisory","1","2018-07-10 22:48:06");
INSERT INTO tbl_candidate VALUES("194","306","Justin Russell","Pieterse","justin.russellr23@gmail.com","0820532070","","890708513008","0000-00-00","male","29","ZAF","white","bachelors_degree","married_or_domestic_partnership","employed_full_time","english","junior_management/supervisory","1","2018-07-10 23:03:29");
INSERT INTO tbl_candidate VALUES("195","306","Khulekani","Biyela","khuliewise@gmail.com","0718056669","","8704045643086","0000-00-00","male","331","ZAF","black_or_african","high_school","single_never_married","employed_full_time","other","junior_management/supervisory","1","2018-07-11 00:20:03");
INSERT INTO tbl_candidate VALUES("196","306","Najwa ","Weinstein","najwein@gmail.com","0729122271","","7702260134089","0000-00-00","female","41","ZAF","coloured","high_school","married_or_domestic_partnership","employed_full_time","english","administration/entry_level","1","2018-07-11 08:02:01");
INSERT INTO tbl_candidate VALUES("197","306","Naledi","Ramokgopa","ramakgopan@gmail.com","0783684959","","8603176076084","0000-00-00","male","32","ZAF","black_or_african","high_school","single_never_married","employed_full_time","sotho","middle_management","1","2018-07-11 09:08:52");
INSERT INTO tbl_candidate VALUES("198","306","Naledi","Ramokgopa","ramakgopan@gmail.com","0783684959","","8603176076084","0000-00-00","male","32","ZAF","white","high_school","single_never_married","employed_full_time","other","administration/entry_level","1","2018-07-11 09:09:53");
INSERT INTO tbl_candidate VALUES("199","306","Saafia","Williams ","saafiawilliams@gmail.com","0842075478","","8709250220082","0000-00-00","male","30","ZAF","white","high_school","single_never_married","employed_full_time","other","administration/entry_level","1","2018-07-11 09:14:26");
INSERT INTO tbl_candidate VALUES("200","306","Donay","O\'Reilly","oreillydonay@gmail.com","0613115699","","9411140200080","0000-00-00","female","23","ZAF","coloured","high_school","single_never_married","employed_full_time","english","administration/entry_level","1","2018-07-11 10:45:49");
INSERT INTO tbl_candidate VALUES("201","306","Andisiwe ","Nomlomo ","gjivauhnmonson@gmail.com","0844538929","","9205021043084","0000-00-00","female","26","ZAF","black_or_african","college_diploma","single_never_married","out_of_work_and_looking_for_work","xhosa","administration/entry_level","1","2018-07-11 11:04:43");
INSERT INTO tbl_candidate VALUES("202","306","Nokuthula","Majova","majovathulaz@yahoo.com","0764387445","","8502030754086","0000-00-00","female","33","ZAF","black_or_african","college_diploma","married_or_domestic_partnership","employed_full_time","xhosa","administration/entry_level","1","2018-07-11 11:34:24");
INSERT INTO tbl_candidate VALUES("203","306","NOKUTHULA ","MAJOVA ","majovathulaz@yahoo.com","0764387445","","8502030754086","0000-00-00","female","33","ZAF","black_or_african","college_diploma","married_or_domestic_partnership","employed_full_time","xhosa","administration/entry_level","1","2018-07-11 11:58:31");
INSERT INTO tbl_candidate VALUES("204","306","Bianca","Savahl","bianca.savahl@gmail.com","0658354753","","8604020047081","0000-00-00","female","32","ZAF","coloured","high_school","married_or_domestic_partnership","employed_full_time","english","administration/entry_level","1","2018-07-11 13:13:33");
INSERT INTO tbl_candidate VALUES("205","306","Craig","Haupt","hauptcc@gmail.com","081","","8105215179085","0000-00-00","male","37","ZAF","coloured","high_school","married_or_domestic_partnership","out_of_work_and_looking_for_work","english","middle_management","1","2018-07-11 13:21:12");
INSERT INTO tbl_candidate VALUES("206","306","khaanyisa","kayo","kayokhanyisa@icloud.com","0651481526","","860420668088","0000-00-00","female","32","ZAF","black_or_african","high_school","single_never_married","employed_full_time","english","senior_management","1","2018-07-11 15:11:29");
INSERT INTO tbl_candidate VALUES("207","306","Sphesihle","Ntombela ","Ntombelasphesihle@gmail.com","0738444581","","8707235383082","0000-00-00","male","30","ZAF","black_or_african","high_school","single_never_married","employed_full_time","zulu","junior_management/supervisory","1","2018-07-11 16:28:29");
INSERT INTO tbl_candidate VALUES("208","306","Pascalina ","Makganamisha","Pmakganamisha@yahoo.com","0848926453","","8711280200084","1987-11-28","female","30","ZAF","black_or_african","high_school","married_or_domestic_partnership","employed_full_time","other","senior_management","1","2018-07-11 16:37:13");
INSERT INTO tbl_candidate VALUES("209","306","Vuyokazi ","Molly ","robsonkachepa@gmail.com","0734222223","","9109281501080","0000-00-00","female","26","ZAF","black_or_african","college_diploma","single_never_married","out_of_work_and_looking_for_work","xhosa","administration/entry_level","1","2018-07-11 17:14:17");
INSERT INTO tbl_candidate VALUES("210","306","Lyruz","Louis","louislyruz@gmail.com","0837867877","","8108030041084","0000-00-00","female","37","ZAF","coloured","high_school","divorced","employed_full_time","english","middle_management","1","2018-07-11 18:50:37");
INSERT INTO tbl_candidate VALUES("211","306","Zizipho","Petu","Ziziphopetu@gmail.com","0659869857","","9503220541084 ","0000-00-00","female","23","ZAF","black_or_african","bachelors_degree","single_never_married","out_of_work_and_looking_for_work","xhosa","administration/entry_level","1","2018-07-11 19:59:42");
INSERT INTO tbl_candidate VALUES("212","306","SEBABATSO","LEHULA","lehulasebabatso@gmail.com","0790337413","","9405240754087","0000-00-00","female","24","ZAF","black_or_african","high_school","single_never_married","employed_full_time","other","administration/entry_level","1","2018-07-12 08:47:50");
INSERT INTO tbl_candidate VALUES("213","306","vuyokazi","molly","vuyokazimolly@gmail.com","0734222223","","9109281501080","1991-09-28","female","26","ZAF","black_or_african","high_school","single_never_married","out_of_work_and_looking_for_work","xhosa","administration/entry_level","1","2018-07-12 10:38:23");
INSERT INTO tbl_candidate VALUES("214","306","David","van der Walt","davethomaswalt@gmail.com","0826606386","","9102075015086","0000-00-00","male","27","ZAF","white","bachelors_degree","single_never_married","out_of_work_and_looking_for_work","english","middle_management","1","2018-07-12 11:19:46");
INSERT INTO tbl_candidate VALUES("215","306","Ntombizakhe ","Ngulube","judyntombi@gmail.com","0788475613","","8211261060086","0000-00-00","female","35","ZAF","white","high_school","single_never_married","employed_full_time","zulu","middle_management","1","2018-07-12 12:58:42");
INSERT INTO tbl_candidate VALUES("216","306","Lorraine ","Luthaga","lkluthaga@gmail.com","0743138999","","8802121222088","0000-00-00","female","30","ZAF","black_or_african","high_school","single_never_married","employed_full_time","zulu","junior_management/supervisory","1","2018-07-12 15:32:41");
INSERT INTO tbl_candidate VALUES("217","306","Silindile","Phakathi","slindile@hotmail.com","0608401451","","9209081438085","1992-09-08","female","25","ZAF","black_or_african","high_school","single_never_married","out_of_work_and_looking_for_work","zulu","junior_management/supervisory","1","2018-07-12 17:34:21");
INSERT INTO tbl_candidate VALUES("218","306","Zizipho","Petu","Ziziphopetu@gmail.com","0659869857","","9503220541084","0000-00-00","female","23","ZAF","black_or_african","bachelors_degree","single_never_married","out_of_work_and_looking_for_work","xhosa","administration/entry_level","1","2018-07-13 11:33:39");




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
INSERT INTO tbl_countries VALUES("248","AX","ALA","�land Islands","�land Island");
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
INSERT INTO tbl_countries VALUES("384","CI","CIV","C�te d\'Ivoire","Ivorian");
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
INSERT INTO tbl_countries VALUES("492","MC","MCO","Monaco","Mon�gasque, Monacan");
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
INSERT INTO tbl_countries VALUES("531","CW","CUW","Cura�ao","Cura�aoan");
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
INSERT INTO tbl_countries VALUES("638","RE","REU","R�union","R�unionese, R�unionnais");
INSERT INTO tbl_countries VALUES("642","RO","ROU","Romania","Romanian");
INSERT INTO tbl_countries VALUES("643","RU","RUS","Russian Federation","Russian");
INSERT INTO tbl_countries VALUES("646","RW","RWA","Rwanda","Rwandan");
INSERT INTO tbl_countries VALUES("652","BL","BLM","Saint Barth�lemy","Barth�lemois");
INSERT INTO tbl_countries VALUES("654","SH","SHN","Saint Helena, Ascension and Tristan da Cunha","Saint Helenian");
INSERT INTO tbl_countries VALUES("659","KN","KNA","Saint Kitts and Nevis","Kittitian or Nevisian");
INSERT INTO tbl_countries VALUES("660","AI","AIA","Anguilla","Anguillan");
INSERT INTO tbl_countries VALUES("662","LC","LCA","Saint Lucia","Saint Lucian");
INSERT INTO tbl_countries VALUES("663","MF","MAF","Saint Martin (French part)","Saint-Martinoise");
INSERT INTO tbl_countries VALUES("666","PM","SPM","Saint Pierre and Miquelon","Saint-Pierrais or Miquelonnais");
INSERT INTO tbl_countries VALUES("670","VC","VCT","Saint Vincent and the Grenadines","Saint Vincentian, Vincentian");
INSERT INTO tbl_countries VALUES("674","SM","SMR","San Marino","Sammarinese");
INSERT INTO tbl_countries VALUES("678","ST","STP","Sao Tome and Principe","S�o Tom�an");
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
INSERT INTO tbl_countries VALUES("854","BF","BFA","Burkina Faso","Burkinab�");
INSERT INTO tbl_countries VALUES("858","UY","URY","Uruguay","Uruguayan");
INSERT INTO tbl_countries VALUES("860","UZ","UZB","Uzbekistan","Uzbekistani, Uzbek");
INSERT INTO tbl_countries VALUES("862","VE","VEN","Venezuela (Bolivarian Republic of)","Venezuelan");
INSERT INTO tbl_countries VALUES("876","WF","WLF","Wallis and Futuna","Wallis and Futuna, Wallisian or Futunan");
INSERT INTO tbl_countries VALUES("882","WS","WSM","Samoa","Samoan");
INSERT INTO tbl_countries VALUES("887","YE","YEM","Yemen","Yemeni");
INSERT INTO tbl_countries VALUES("894","ZM","ZMB","Zambia","Zambian");




CREATE TABLE `tbl_credit` (
  `id` int(250) NOT NULL AUTO_INCREMENT,
  `credit` varchar(50) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO tbl_credit VALUES("1","1","2018-03-30 08:59:09");




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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

INSERT INTO tbl_credit_request VALUES("1","3","174","2","2","approved","1","2018-04-09 15:12:08","2018-04-09 15:12:28");
INSERT INTO tbl_credit_request VALUES("2","1","1","5","2","approved","0","2018-04-09 15:12:53","2018-04-09 15:13:03");
INSERT INTO tbl_credit_request VALUES("3","8","1","5","150","approved","0","2018-04-09 16:34:49","2018-04-10 08:16:36");
INSERT INTO tbl_credit_request VALUES("4","13","179","5","","active","","2018-04-09 16:39:44","2018-04-09 16:39:44");
INSERT INTO tbl_credit_request VALUES("5","14","179","50","5","approved","8","2018-04-10 07:56:10","2018-04-10 08:13:31");
INSERT INTO tbl_credit_request VALUES("6","14","179","10","5","approved","8","2018-04-10 08:14:09","2018-04-10 08:14:30");
INSERT INTO tbl_credit_request VALUES("7","8","1","150","","active","","2018-04-10 11:26:51","2018-04-10 11:26:51");
INSERT INTO tbl_credit_request VALUES("8","14","179","150","100","approved","8","2018-04-10 11:28:42","2018-04-10 11:43:29");
INSERT INTO tbl_credit_request VALUES("9","19","179","20","","active","","2018-04-10 14:48:42","2018-04-10 14:48:42");
INSERT INTO tbl_credit_request VALUES("10","19","179","5","","active","","2018-04-10 14:48:52","2018-04-10 14:48:52");
INSERT INTO tbl_credit_request VALUES("11","9","1","50","","active","","2018-04-11 08:50:12","2018-04-11 08:50:12");
INSERT INTO tbl_credit_request VALUES("12","24","194","10","10","approved","10","2018-04-15 18:39:08","2018-04-15 18:39:41");




CREATE TABLE `tbl_distributor` (
  `distributor_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) NOT NULL,
  `distributor` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` text NOT NULL,
  `credits` varchar(100) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`distributor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

INSERT INTO tbl_distributor VALUES("8","1","Vox Distributor","Pramod Batodiya","p.batodiya@gmail.com","1234567","Distributor","85","1","2018-04-09 16:32:10");
INSERT INTO tbl_distributor VALUES("9","1","AssessmentHouse","Debri van Wyk","debri@ahonline.co","00000","Address","75","1","2018-04-10 12:07:02");
INSERT INTO tbl_distributor VALUES("10","1","Imperial Group","Ciska van Aswegen","ciska@qims.co.za","333","address","10","1","2018-04-10 12:46:28");
INSERT INTO tbl_distributor VALUES("11","1","Distributor Three","Distributor Three","dt3@ahonline.co","0000","address","20","1","2018-04-11 09:01:32");
INSERT INTO tbl_distributor VALUES("15","1","Pmd tech Distributor","Pramod Batodiya","batodiya.pramod@gmail.com","1212121212121","Address","0","1","2018-04-11 11:13:16");
INSERT INTO tbl_distributor VALUES("16","1","Imperial 2","Da da","dada@ahonline.co","000","address","11","1","2018-04-11 12:31:48");
INSERT INTO tbl_distributor VALUES("18","1","Imperial Holdings","Ciska van Aswegen","cvanaswegen@ih.co.za","000","address","100","1","2018-04-18 10:30:25");
INSERT INTO tbl_distributor VALUES("19","1","HRST","Maxine Adams-Leite","maxine.adams@hrst.co.za","00","Address","10","1","2018-04-18 13:59:09");
INSERT INTO tbl_distributor VALUES("20","1","HRST Recruitment","Nadine Moodley","nadinem@hrst.co.za","00","Address","10","1","2018-05-09 08:50:34");
INSERT INTO tbl_distributor VALUES("21","1","Stratatech Cape Town","Rentia Landman","rentia.landman@stratatech.co.za","00","000","880","1","2018-07-04 17:51:19");




CREATE TABLE `tbl_email_template` (
  `template_id` int(11) NOT NULL AUTO_INCREMENT,
  `template_name` varchar(50) NOT NULL,
  `interview_status` varbinary(50) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `email_content` text NOT NULL,
  `client_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`template_id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

INSERT INTO tbl_email_template VALUES("1","Template 1","Invitation","Invitation","<p>Invitation</p>
\n","5","2018-03-29 10:40:12");
INSERT INTO tbl_email_template VALUES("2","Template 2","Rejection","Rejection","<p>Rejection</p>
\n","5","2018-03-29 11:08:27");
INSERT INTO tbl_email_template VALUES("3","Template 3","Reminder","Reminder","<p>Reminder</p>
\n","5","2018-03-29 11:08:49");
INSERT INTO tbl_email_template VALUES("4","test","Rejection","rejected","<p>ec</p>
\n","12","2018-03-29 12:08:47");
INSERT INTO tbl_email_template VALUES("5","Invitation","Invitation","Invitation 1","<p>This is test 1.</p>
\n","17","2018-03-29 12:46:27");
INSERT INTO tbl_email_template VALUES("6","Rejection","Rejection","Rejection 1","<p>This is test 2</p>
\n","17","2018-03-29 12:46:44");
INSERT INTO tbl_email_template VALUES("7","reminder","Reminder","reminder","<p>reminder</p>
\n","12","2018-03-29 13:45:45");
INSERT INTO tbl_email_template VALUES("8","Rejected","Rejection","You were not successfull","<p>Sorry you were not successfull</p>
\n","23","2018-03-30 07:49:58");
INSERT INTO tbl_email_template VALUES("9","Invitation","Invitation","Invited for interview","<p>You are invited to an interview</p>
\n","23","2018-03-30 07:50:22");
INSERT INTO tbl_email_template VALUES("10","Reminder","Reminder","Reminder","<p>Reminder to do assessments</p>
\n","23","2018-03-30 07:50:45");
INSERT INTO tbl_email_template VALUES("11","Project Mars","Invitation","Initial Interview","<p>Good morning,</p>
\n
\n<p>You have been selected as one of the possible candidates to travel to and colonize&nbsp;Mars as a last ditch effort to save humanity.&nbsp;</p>
\n
\n<p>Please answer three short questions that will enable us to evaluate your suitability for Project Mars.</p>
\n
\n<p>Regards,</p>
\n
\n<p>The Optimistic Nihilists&nbsp;</p>
\n","38","2018-04-01 12:17:24");
INSERT INTO tbl_email_template VALUES("12","Rejection letter","Rejection","Rejected","<p>So sorry</p>
\n","44","2018-04-03 12:41:56");
INSERT INTO tbl_email_template VALUES("13","Reminder","Reminder","Reminder","<p>Hurry up</p>
\n","44","2018-04-03 12:42:09");
INSERT INTO tbl_email_template VALUES("14","Invite to meeting","Invitation","Invitiation","<p>Let&#39;s chat</p>
\n","44","2018-04-03 12:42:30");
INSERT INTO tbl_email_template VALUES("15","Initial Interview","Invitation","e-Interview","<p>Dear candidate,</p>
\n
\n<p>You have been selected to complete a 5 minute e-interview to determine your suitability for the Donkey Farmer&#39;s life.</p>
\n
\n<p>Regards,&nbsp;</p>
\n","43","2018-04-03 12:51:59");
INSERT INTO tbl_email_template VALUES("19","Rejection Template","Rejection","Rejection Template","<p>Rejection Template&nbsp;Rejection Template</p>
\n","61","2018-04-04 08:25:02");
INSERT INTO tbl_email_template VALUES("21","Please complete","Invitation","Please complete","<p>Please complete</p>
\n","144","2018-04-06 10:30:29");
INSERT INTO tbl_email_template VALUES("22","Cheers","Rejection","Cheers","<p>Cheers</p>
\n","144","2018-04-06 10:30:39");
INSERT INTO tbl_email_template VALUES("25","Hi","Invitation","See you soon","<p>See you soon</p>
\n","187","2018-04-10 12:25:33");
INSERT INTO tbl_email_template VALUES("26","Cheers","Rejection","Ciao","<p>Ciao</p>
\n","187","2018-04-10 12:25:45");
INSERT INTO tbl_email_template VALUES("27","Huh","Reminder","Maak gou","<p>Maak gou</p>
\n","187","2018-04-10 12:25:56");
INSERT INTO tbl_email_template VALUES("28","Sheldon Survey","Invitation","Survey","<p>Hi,</p>
\n
\n<p>Please complete this short survey on Sheldon&#39;s most annoying habits.&nbsp;</p>
\n
\n<p>We are doing a social experiment and would appreciate your input.&nbsp;</p>
\n
\n<p>Regards,</p>
\n
\n<p>Dr. Amy Farrah Fowler</p>
\n
\n<p>Microbiologist</p>
\n","232","2018-04-15 16:20:38");
INSERT INTO tbl_email_template VALUES("29","Sheldon Survey","Rejection","Survey","<p>Hi,</p>
\n
\n<p>Sorry, you have answered incorrectly and have been removed from the survey.</p>
\n
\n<p>Regards,</p>
\n
\n<p>AFF</p>
\n","232","2018-04-15 16:21:16");
INSERT INTO tbl_email_template VALUES("30","Sheldon Survey","Reminder","Survey","<p>Hi,</p>
\n
\n<p>Please complete the survey.</p>
\n
\n<p>You are failing the social experiment.</p>
\n
\n<p>Regards,</p>
\n
\n<p>AFF</p>
\n","232","2018-04-15 16:22:33");
INSERT INTO tbl_email_template VALUES("31","Interview Initial","Invitation","Clinical Specialist Position","<p>Dear Applicant,</p>
\n
\n<p>Please log into the e-interview system with the details below and complete the questions that appear on the screen.</p>
\n
\n<p>You will have 30 seconds to think about your response and then to start with your response.&nbsp; Each question also has a limited amount of time you can talk.</p>
\n
\n<p>It is best not to overthink your answers, but just to answer from your heart.</p>
\n
\n<p>Have fun!</p>
\n
\n<p>Burgert and team</p>
\n
\n<p>&nbsp;</p>
\n","239","2018-04-16 21:12:43");
INSERT INTO tbl_email_template VALUES("32","Rejection for Therapist Role","Rejection","Your interview with us","<p>We regret to inform you that you are nuts and we will never employ someone as screwed up as you!</p>
\n
\n<p>&nbsp;</p>
\n
\n<p>Cheers mate!</p>
\n","239","2018-04-18 15:31:45");




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
  `account_manager_eva_rating` varchar(20) DEFAULT NULL,
  `account_manager_eva_comment` text,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`interview_id`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=latin1;

INSERT INTO tbl_interview VALUES("9","1","1","1","29/3/2018 12:55:42","29/3/2018 12:55:46","RecordRTC-2018229-8kkj7yllo8i.mp4","1","1","","Manager Comments","","","2018-03-29 09:25:49");
INSERT INTO tbl_interview VALUES("10","2","1","2","29/3/2018 15:14:12","29/3/2018 15:14:52","RecordRTC-2018229-241o1pw1i0s.mp4","1","1","","","","","2018-03-29 11:45:14");
INSERT INTO tbl_interview VALUES("11","3","2","3","29/3/2018 15:34:29","29/3/2018 15:34:40","RecordRTC-2018229-ivz1kuho59j.mp4","1","0","","","","","2018-03-29 12:04:46");
INSERT INTO tbl_interview VALUES("12","4","3","4","29/3/2018 21:42:18","29/3/2018 21:42:42","RecordRTC-2018229-6lypy3wswot.mp4","1","1","1","1233","","","2018-03-29 12:42:49");
INSERT INTO tbl_interview VALUES("13","9","4","9","30/3/2018 7:59:5","30/3/2018 8:0:0","RecordRTC-2018230-vfkkru0syh.mp4","1","1","1","No way","","What the hell?","2018-03-30 08:00:02");
INSERT INTO tbl_interview VALUES("14","10","3","10","30/3/2018 18:55:3","30/3/2018 18:55:13","RecordRTC-2018230-9rg903vtzbn.mp4","1","1","2","123","","","2018-03-30 09:55:15");
INSERT INTO tbl_interview VALUES("17","16","8","16","3/4/2018 21:1:11","3/4/2018 21:1:27","RecordRTC-201833-c42z4bouc8l.mp4","1","1","3","fsdfsdfs","","","2018-04-03 21:01:28");
INSERT INTO tbl_interview VALUES("19","31","13","31","5/4/2018 8:58:39","5/4/2018 8:59:26","RecordRTC-201835-etz4dtzrk49.mp4","1","1","3","asdf","","","2018-04-05 08:59:33");
INSERT INTO tbl_interview VALUES("20","30","13","30","5/4/2018 8:58:44","5/4/2018 9:1:13","RecordRTC-201835-5jz6r035tju.mp4","1","1","2","dfh","","","2018-04-05 09:01:33");
INSERT INTO tbl_interview VALUES("21","29","13","29","5/4/2018 9:3:10","5/4/2018 9:5:51","RecordRTC-201835-61zhf6a2spv.mp4","1","1","1","sdfg","","","2018-04-05 09:06:10");
INSERT INTO tbl_interview VALUES("22","33","14","33","5/4/2018 9:30:55","5/4/2018 9:35:57","RecordRTC-201835-bj5xp8yzv3r.mp4","1","1","","","","","2018-04-05 09:36:34");
INSERT INTO tbl_interview VALUES("23","34","13","34","5/4/2018 15:44:39","5/4/2018 15:45:58","RecordRTC-201835-ip0c3r7rj4i.mp4","1","0","","","","","2018-04-05 09:46:02");
INSERT INTO tbl_interview VALUES("24","35","14","35","5/4/2018 10:52:8","5/4/2018 10:57:38","RecordRTC-201835-2dogngbqsp3.mp4","1","1","","","","","2018-04-05 10:57:11");
INSERT INTO tbl_interview VALUES("25","37","14","37","5/4/2018 11:7:15","5/4/2018 11:11:27","RecordRTC-201835-2x8q87k9dyx.mp4","1","1","","","","","2018-04-05 11:01:40");
INSERT INTO tbl_interview VALUES("26","38","14","38","5/4/2018 12:57:28","5/4/2018 13:2:23","RecordRTC-201835-71ppa9uvnyp.mp4","1","1","","","","","2018-04-05 13:01:48");
INSERT INTO tbl_interview VALUES("27","39","14","39","5/4/2018 13:10:12","5/4/2018 13:15:31","RecordRTC-201835-71m0qin1t2d.mp4","1","1","","","","","2018-04-05 13:05:55");
INSERT INTO tbl_interview VALUES("28","73","14","73","6/4/2018 8:58:21","6/4/2018 9:0:9","RecordRTC-201836-4ggp0widneo.mp4","1","1","","","","","2018-04-06 08:49:55");
INSERT INTO tbl_interview VALUES("29","77","14","77","6/4/2018 8:58:28","6/4/2018 9:2:5","RecordRTC-201836-3xop8vztqfo.mp4","1","1","","","","","2018-04-06 09:01:21");
INSERT INTO tbl_interview VALUES("30","82","14","82","6/4/2018 9:3:33","6/4/2018 9:8:23","RecordRTC-201836-f2ihqbnuiyt.mp4","1","1","","","","","2018-04-06 09:08:52");
INSERT INTO tbl_interview VALUES("31","84","14","84","6/4/2018 9:39:31","6/4/2018 9:45:1","RecordRTC-201836-1uc2b880041.mp4","1","1","","","","","2018-04-06 09:45:52");
INSERT INTO tbl_interview VALUES("32","85","14","85","6/4/2018 10:6:41","6/4/2018 10:7:24","RecordRTC-201836-itmflk61edc.mp4","1","1","","","","","2018-04-06 10:07:28");
INSERT INTO tbl_interview VALUES("33","86","22","86","6/4/2018 10:37:51","6/4/2018 10:38:23","RecordRTC-201836-5p2bpsdoyv7.mp4","1","1","2","bla bla bla","","","2018-04-06 10:38:26");
INSERT INTO tbl_interview VALUES("34","87","22","87","6/4/2018 10:39:2","6/4/2018 10:39:47","RecordRTC-201836-epyg0p3viz.mp4","1","1","1","bla vla cla","","","2018-04-06 10:39:50");
INSERT INTO tbl_interview VALUES("35","90","14","90","6/4/2018 10:47:25","6/4/2018 10:51:8","RecordRTC-201836-59lt75uqs0e.mp4","1","1","","","","","2018-04-06 10:52:06");
INSERT INTO tbl_interview VALUES("36","91","14","91","6/4/2018 10:59:32","6/4/2018 11:1:56","RecordRTC-201836-3p6f28ahqo5.mp4","1","1","","","","","2018-04-06 10:52:14");
INSERT INTO tbl_interview VALUES("37","89","14","89","6/4/2018 10:48:47","6/4/2018 10:54:2","RecordRTC-201836-dgkykulfbss.mp4","1","1","","","","","2018-04-06 10:53:41");
INSERT INTO tbl_interview VALUES("39","95","14","95","6/4/2018 13:7:0","6/4/2018 13:10:55","RecordRTC-201836-en3dabipvgq.mp4","1","1","","","","","2018-04-06 13:11:18");
INSERT INTO tbl_interview VALUES("41","97","8","97","8/4/2018 17:8:38","8/4/2018 17:9:26","RecordRTC-201838-d7upnmdhuqn.mp4","1","0","","","","","2018-04-08 17:09:29");
INSERT INTO tbl_interview VALUES("42","81","21","81","9/4/2018 11:19:18","9/4/2018 11:22:17","RecordRTC-201839-5s9nxq2v78h.mp4","1","1","","","","","2018-04-09 07:52:45");
INSERT INTO tbl_interview VALUES("43","99","27","101","10/4/2018 12:28:56","10/4/2018 12:30:11","RecordRTC-2018310-iysdmqjtlpu.mp4","1","1","2","yes","","","2018-04-10 12:30:14");
INSERT INTO tbl_interview VALUES("44","100","28","102","10/4/2018 17:8:53","10/4/2018 17:9:53","RecordRTC-2018310-1t6c3ikf894.mp4","1","1","","Comments","","","2018-04-10 13:39:58");
INSERT INTO tbl_interview VALUES("45","101","29","103","10/4/2018 17:18:4","10/4/2018 17:19:4","RecordRTC-2018310-2agbvgtwh4r.mp4","1","1","","","","","2018-04-10 13:49:09");
INSERT INTO tbl_interview VALUES("46","102","14","104","11/4/2018 8:46:5","11/4/2018 8:50:25","RecordRTC-2018311-fblbgiw3jsk.mp4","1","1","","","","","2018-04-11 08:49:24");
INSERT INTO tbl_interview VALUES("47","103","14","105","11/4/2018 9:2:37","11/4/2018 9:7:39","RecordRTC-2018311-h967dpcw4eu.mp4","1","1","","","","","2018-04-11 09:07:19");
INSERT INTO tbl_interview VALUES("48","105","14","107","11/4/2018 9:8:29","11/4/2018 9:13:18","RecordRTC-2018311-23txjanrtqk.mp4","1","1","","","","","2018-04-11 09:14:16");
INSERT INTO tbl_interview VALUES("49","107","14","109","11/4/2018 9:15:23","11/4/2018 9:18:33","RecordRTC-2018311-4micb4n4tx.mp4","1","1","","","","","2018-04-11 09:17:32");
INSERT INTO tbl_interview VALUES("50","111","34","113","15/4/2018 16:29:43","15/4/2018 16:32:14","RecordRTC-2018315-b79s72aw6s.mp4","1","1","3","asdf","","","2018-04-15 16:34:26");
INSERT INTO tbl_interview VALUES("51","112","34","114","15/4/2018 17:59:46","15/4/2018 18:2:23","RecordRTC-2018315-gpi1930unth.mp4","1","1","1","ghdrth","","","2018-04-15 18:05:10");
INSERT INTO tbl_interview VALUES("52","116","36","118","17/4/2018 9:55:36","17/4/2018 10:3:30","RecordRTC-2018317-c144yx1990b.mp4","1","1","1","This therapist has no clue what Psychotherapy is all about!  I suggest we end the interview process with him immediately.","","","2018-04-17 15:09:40");
INSERT INTO tbl_interview VALUES("54","127","38","129","4/5/2018 23:28:38","4/5/2018 23:29:58","RecordRTC-201844-160vq67l1iw.mp4","1","1","","","","","2018-05-04 17:30:44");
INSERT INTO tbl_interview VALUES("55","137","38","139","4/5/2018 18:35:20","4/5/2018 18:36:32","RecordRTC-201845-f5jnupnojy.mp4","1","0","","","","","2018-05-05 03:36:34");
INSERT INTO tbl_interview VALUES("56","138","33","140","6/5/2018 20:41:40","6/5/2018 20:42:20","RecordRTC-201846-d7obtws8z9w.mp4","1","1","","","","","2018-05-06 17:12:26");
INSERT INTO tbl_interview VALUES("57","119","37","121","1/6/2018 8:23:30","1/6/2018 8:26:30","RecordRTC-201851-43o42p0igfa.mp4","1","1","3","","","","2018-06-01 08:26:37");
INSERT INTO tbl_interview VALUES("58","145","37","147","4/6/2018 15:35:15","4/6/2018 15:37:8","RecordRTC-201854-6c5vsmhg3o6.mp4","1","1","","","","","2018-06-04 15:37:08");
INSERT INTO tbl_interview VALUES("59","150","33","152","22/6/2018 14:13:55","22/6/2018 14:14:35","RecordRTC-2018522-2shtha934zj.mp4","1","1","","","","","2018-06-22 10:44:46");
INSERT INTO tbl_interview VALUES("60","151","40","153","25/6/2018 8:25:35","25/6/2018 8:28:35","RecordRTC-2018525-fvb92khvzxh.mp4","1","1","","Done","","","2018-06-25 08:28:58");
INSERT INTO tbl_interview VALUES("61","155","41","157","4/7/2018 14:47:36","4/7/2018 14:50:40","RecordRTC-201864-gnpcuc0fu2r.mp4","1","1","1","Struggles with technology","","","2018-07-04 14:50:51");
INSERT INTO tbl_interview VALUES("62","156","41","158","4/7/2018 15:4:40","4/7/2018 15:8:22","RecordRTC-201864-9yzkcumhzig.mp4","1","1","3","Great candidate","","","2018-07-04 15:08:26");
INSERT INTO tbl_interview VALUES("63","159","43","161","5/7/2018 15:56:21","5/7/2018 16:0:26","RecordRTC-201865-a38of4p5yvo.mp4","1","1","","","","","2018-07-05 16:00:35");
INSERT INTO tbl_interview VALUES("64","161","43","163","5/7/2018 16:45:28","5/7/2018 16:49:21","RecordRTC-201865-7s7j7jcxsv7.mp4","1","1","","","","","2018-07-05 16:49:28");
INSERT INTO tbl_interview VALUES("65","162","43","164","6/7/2018 8:52:53","6/7/2018 8:56:46","RecordRTC-201866-348tgtjw76y.mp4","1","1","","","","","2018-07-06 08:56:56");
INSERT INTO tbl_interview VALUES("66","163","43","165","6/7/2018 9:30:1","6/7/2018 9:34:9","RecordRTC-201866-1whcm7wejpi.mp4","1","1","","","","","2018-07-06 09:33:50");
INSERT INTO tbl_interview VALUES("69","181","44","183","10/7/2018 16:0:45","10/7/2018 16:5:8","RecordRTC-2018610-6x2tn023yds.mp4","1","1","2","","","","2018-07-10 16:05:19");
INSERT INTO tbl_interview VALUES("70","182","45","184","10/7/2018 16:4:42","10/7/2018 16:8:3","RecordRTC-2018610-aacgjykil1b.mp4","1","1","2","","","","2018-07-10 16:08:08");
INSERT INTO tbl_interview VALUES("71","191","45","193","10/7/2018 22:55:23","10/7/2018 23:1:2","RecordRTC-2018610-b19opyho1lw.mp4","1","0","","","","","2018-07-10 23:01:14");
INSERT INTO tbl_interview VALUES("72","194","44","196","11/7/2018 8:10:24","11/7/2018 8:14:54","RecordRTC-2018611-dc9j3rqmffs.mp4","1","1","2","","","","2018-07-11 08:15:54");
INSERT INTO tbl_interview VALUES("73","201","44","203","11/7/2018 12:0:26","11/7/2018 12:4:56","RecordRTC-2018611-11ovm9yjuxk.mp4","1","1","1","","","","2018-07-11 12:07:26");
INSERT INTO tbl_interview VALUES("75","208","46","210","11/7/2018 18:53:17","11/7/2018 18:58:57","RecordRTC-2018611-2go38lwauvg.mp4","1","1","1","","","","2018-07-11 19:01:08");
INSERT INTO tbl_interview VALUES("76","187","44","189","12/7/2018 9:11:35","12/7/2018 9:15:55","RecordRTC-2018612-26r8dvq0bkf.mp4","1","1","3","","","","2018-07-12 09:16:18");
INSERT INTO tbl_interview VALUES("77","212","45","214","12/7/2018 11:22:44","12/7/2018 11:28:17","RecordRTC-2018612-54tnavm3oij.mp4","1","1","3","","","","2018-07-12 11:29:44");




CREATE TABLE `tbl_invite_interview` (
  `invite_id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `candidate_id` int(11) NOT NULL,
  `note` text NOT NULL,
  `start_status` int(11) NOT NULL DEFAULT '0',
  `end_status` int(11) NOT NULL DEFAULT '0',
  `status` varchar(50) NOT NULL,
  `email_type` varchar(50) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`invite_id`)
) ENGINE=InnoDB AUTO_INCREMENT=217 DEFAULT CHARSET=latin1;

INSERT INTO tbl_invite_interview VALUES("1","1","1","","1","1","complete","","2018-03-29 08:39:16");
INSERT INTO tbl_invite_interview VALUES("2","1","2","","1","1","complete","","2018-03-29 11:41:24");
INSERT INTO tbl_invite_interview VALUES("3","2","3","","1","1","complete","","2018-03-29 11:58:48");
INSERT INTO tbl_invite_interview VALUES("5","2","5","","0","0","pending","","2018-03-29 14:02:56");
INSERT INTO tbl_invite_interview VALUES("6","6","6","","0","0","pending","","2018-03-30 07:54:04");
INSERT INTO tbl_invite_interview VALUES("7","6","7","","0","0","pending","","2018-03-30 07:54:05");
INSERT INTO tbl_invite_interview VALUES("8","4","8","","0","0","pending","","2018-03-30 07:54:36");
INSERT INTO tbl_invite_interview VALUES("9","4","9","","1","1","complete","","2018-03-30 07:54:37");
INSERT INTO tbl_invite_interview VALUES("11","8","11","","0","0","pending","","2018-04-03 12:47:48");
INSERT INTO tbl_invite_interview VALUES("13","8","13","","1","0","cancel","","2018-04-03 13:00:39");
INSERT INTO tbl_invite_interview VALUES("16","8","16","","1","1","complete","Invitation","2018-04-03 21:00:55");
INSERT INTO tbl_invite_interview VALUES("17","11","17","","0","0","pending","","2018-04-04 07:44:18");
INSERT INTO tbl_invite_interview VALUES("18","11","18","","0","0","pending","","2018-04-04 07:50:22");
INSERT INTO tbl_invite_interview VALUES("24","11","24","","0","0","pending","","2018-04-04 08:24:37");
INSERT INTO tbl_invite_interview VALUES("32","14","32","","0","0","pending","","2018-04-05 09:29:47");
INSERT INTO tbl_invite_interview VALUES("33","14","33","","1","1","complete","","2018-04-05 09:30:30");
INSERT INTO tbl_invite_interview VALUES("35","14","35","","1","1","complete","","2018-04-05 10:47:37");
INSERT INTO tbl_invite_interview VALUES("36","14","36","","0","0","pending","","2018-04-05 10:48:46");
INSERT INTO tbl_invite_interview VALUES("37","14","37","","1","1","complete","","2018-04-05 10:54:46");
INSERT INTO tbl_invite_interview VALUES("38","14","38","","1","1","complete","","2018-04-05 12:54:12");
INSERT INTO tbl_invite_interview VALUES("39","14","39","","1","1","complete","","2018-04-05 12:56:44");
INSERT INTO tbl_invite_interview VALUES("73","14","73","","1","1","complete","","2018-04-06 08:44:11");
INSERT INTO tbl_invite_interview VALUES("77","14","77","","1","1","complete","","2018-04-06 08:54:08");
INSERT INTO tbl_invite_interview VALUES("78","21","78","","0","0","pending","Rejection","2018-04-06 08:59:58");
INSERT INTO tbl_invite_interview VALUES("79","21","79","","0","0","pending","","2018-04-06 08:59:58");
INSERT INTO tbl_invite_interview VALUES("80","21","80","","0","0","pending","","2018-04-06 08:59:58");
INSERT INTO tbl_invite_interview VALUES("81","21","81","","1","1","complete","Invitation","2018-04-06 08:59:58");
INSERT INTO tbl_invite_interview VALUES("82","14","82","","1","1","complete","","2018-04-06 09:00:11");
INSERT INTO tbl_invite_interview VALUES("84","14","84","","1","1","complete","","2018-04-06 09:29:54");
INSERT INTO tbl_invite_interview VALUES("85","14","85","","1","1","complete","","2018-04-06 10:06:27");
INSERT INTO tbl_invite_interview VALUES("86","22","86","","1","1","complete","Rejection","2018-04-06 10:31:37");
INSERT INTO tbl_invite_interview VALUES("87","22","87","","1","1","complete","Rejection","2018-04-06 10:31:37");
INSERT INTO tbl_invite_interview VALUES("88","22","88","","0","0","pending","Rejection","2018-04-06 10:31:37");
INSERT INTO tbl_invite_interview VALUES("89","14","89","","1","1","complete","","2018-04-06 10:46:56");
INSERT INTO tbl_invite_interview VALUES("90","14","90","","1","1","complete","","2018-04-06 10:47:01");
INSERT INTO tbl_invite_interview VALUES("91","14","91","","1","1","complete","","2018-04-06 10:47:56");
INSERT INTO tbl_invite_interview VALUES("92","22","92","","0","0","pending","","2018-04-06 10:56:49");
INSERT INTO tbl_invite_interview VALUES("95","14","95","","1","1","complete","","2018-04-06 13:03:14");
INSERT INTO tbl_invite_interview VALUES("97","8","97","","1","1","complete","Rejection","2018-04-08 17:08:26");
INSERT INTO tbl_invite_interview VALUES("98","8","98","","1","0","cancel","","2018-04-08 17:11:49");
INSERT INTO tbl_invite_interview VALUES("99","27","101","","1","1","complete","Rejection","2018-04-10 12:26:27");
INSERT INTO tbl_invite_interview VALUES("100","28","102","","1","1","complete","","2018-04-10 13:35:58");
INSERT INTO tbl_invite_interview VALUES("101","29","103","","1","1","complete","","2018-04-10 13:46:33");
INSERT INTO tbl_invite_interview VALUES("102","14","104","","1","1","complete","","2018-04-11 08:38:54");
INSERT INTO tbl_invite_interview VALUES("103","14","105","","1","1","complete","","2018-04-11 08:57:06");
INSERT INTO tbl_invite_interview VALUES("105","14","107","","1","1","complete","","2018-04-11 09:02:28");
INSERT INTO tbl_invite_interview VALUES("106","32","108","","1","0","cancel","","2018-04-11 09:03:34");
INSERT INTO tbl_invite_interview VALUES("107","14","109","","1","1","complete","","2018-04-11 09:10:09");
INSERT INTO tbl_invite_interview VALUES("108","28","110","","0","0","pending","","2018-04-11 10:45:33");
INSERT INTO tbl_invite_interview VALUES("109","33","111","","0","0","pending","","2018-04-11 12:11:49");
INSERT INTO tbl_invite_interview VALUES("110","24","112","","0","0","pending","","2018-04-11 12:33:20");
INSERT INTO tbl_invite_interview VALUES("111","34","113","","1","1","complete","","2018-04-15 16:23:49");
INSERT INTO tbl_invite_interview VALUES("112","34","114","","1","1","complete","","2018-04-15 16:23:49");
INSERT INTO tbl_invite_interview VALUES("113","8","115","","0","0","pending","","2018-04-16 20:39:44");
INSERT INTO tbl_invite_interview VALUES("115","36","117","","0","0","pending","","2018-04-16 21:50:57");
INSERT INTO tbl_invite_interview VALUES("116","36","118","","1","1","complete","","2018-04-16 21:50:57");
INSERT INTO tbl_invite_interview VALUES("117","36","119","","0","0","pending","","2018-04-18 14:42:04");
INSERT INTO tbl_invite_interview VALUES("118","8","120","","1","0","cancel","","2018-04-25 11:36:16");
INSERT INTO tbl_invite_interview VALUES("119","37","121","","1","1","complete","","2018-04-25 21:48:23");
INSERT INTO tbl_invite_interview VALUES("120","37","122","","0","0","pending","","2018-04-28 19:08:38");
INSERT INTO tbl_invite_interview VALUES("121","37","123","","0","0","pending","","2018-04-28 19:08:38");
INSERT INTO tbl_invite_interview VALUES("122","37","124","","0","0","pending","","2018-05-02 17:57:50");
INSERT INTO tbl_invite_interview VALUES("123","38","125","","0","0","pending","","2018-05-04 17:10:46");
INSERT INTO tbl_invite_interview VALUES("124","38","126","","0","0","pending","","2018-05-04 17:12:29");
INSERT INTO tbl_invite_interview VALUES("125","38","127","","0","0","pending","","2018-05-04 17:18:00");
INSERT INTO tbl_invite_interview VALUES("126","38","128","","0","0","pending","","2018-05-04 17:19:01");
INSERT INTO tbl_invite_interview VALUES("127","38","129","","1","1","complete","","2018-05-04 17:21:09");
INSERT INTO tbl_invite_interview VALUES("128","38","130","","0","0","pending","","2018-05-04 17:21:17");
INSERT INTO tbl_invite_interview VALUES("129","38","131","","0","0","pending","","2018-05-04 17:22:09");
INSERT INTO tbl_invite_interview VALUES("130","38","132","","0","0","pending","","2018-05-04 17:26:05");
INSERT INTO tbl_invite_interview VALUES("131","38","133","","0","0","pending","","2018-05-04 17:27:07");
INSERT INTO tbl_invite_interview VALUES("132","38","134","","0","0","pending","","2018-05-04 17:29:34");
INSERT INTO tbl_invite_interview VALUES("133","38","135","","0","0","pending","","2018-05-04 17:44:54");
INSERT INTO tbl_invite_interview VALUES("134","38","136","","0","0","pending","","2018-05-04 17:51:58");
INSERT INTO tbl_invite_interview VALUES("135","38","137","","0","0","pending","","2018-05-04 20:43:58");
INSERT INTO tbl_invite_interview VALUES("136","38","138","","0","0","pending","","2018-05-04 21:05:41");
INSERT INTO tbl_invite_interview VALUES("137","38","139","","1","1","complete","","2018-05-05 03:33:43");
INSERT INTO tbl_invite_interview VALUES("138","33","140","","1","1","complete","","2018-05-06 17:08:20");
INSERT INTO tbl_invite_interview VALUES("139","37","141","","0","0","pending","","2018-05-08 08:28:25");
INSERT INTO tbl_invite_interview VALUES("140","37","142","","0","0","pending","","2018-05-08 20:44:38");
INSERT INTO tbl_invite_interview VALUES("141","37","143","","0","0","pending","","2018-05-08 20:44:39");
INSERT INTO tbl_invite_interview VALUES("142","37","144","","0","0","pending","","2018-05-09 10:48:05");
INSERT INTO tbl_invite_interview VALUES("143","37","145","","0","0","pending","","2018-05-09 10:48:05");
INSERT INTO tbl_invite_interview VALUES("144","37","146","","0","0","pending","","2018-05-10 20:02:35");
INSERT INTO tbl_invite_interview VALUES("145","37","147","","1","1","complete","","2018-05-30 15:58:47");
INSERT INTO tbl_invite_interview VALUES("146","37","148","","1","0","cancel","","2018-05-31 09:13:53");
INSERT INTO tbl_invite_interview VALUES("147","37","149","","0","0","pending","","2018-05-31 14:29:57");
INSERT INTO tbl_invite_interview VALUES("148","39","150","","1","0","cancel","","2018-06-19 12:11:11");
INSERT INTO tbl_invite_interview VALUES("149","39","151","","1","0","cancel","","2018-06-19 14:58:32");
INSERT INTO tbl_invite_interview VALUES("150","33","152","","1","1","complete","","2018-06-22 10:42:47");
INSERT INTO tbl_invite_interview VALUES("151","40","153","","1","1","complete","","2018-06-25 08:15:41");
INSERT INTO tbl_invite_interview VALUES("152","41","154","","1","0","cancel","Invitation","2018-07-04 12:55:27");
INSERT INTO tbl_invite_interview VALUES("153","41","155","","0","0","pending","","2018-07-04 12:55:28");
INSERT INTO tbl_invite_interview VALUES("154","41","156","","1","0","cancel","","2018-07-04 12:56:04");
INSERT INTO tbl_invite_interview VALUES("155","41","157","","1","1","complete","","2018-07-04 14:47:20");
INSERT INTO tbl_invite_interview VALUES("156","41","158","","1","1","complete","","2018-07-04 15:04:18");
INSERT INTO tbl_invite_interview VALUES("157","42","159","","0","0","pending","","2018-07-04 22:13:00");
INSERT INTO tbl_invite_interview VALUES("158","42","160","","0","0","pending","","2018-07-04 22:13:59");
INSERT INTO tbl_invite_interview VALUES("159","43","161","","1","1","complete","","2018-07-05 15:53:45");
INSERT INTO tbl_invite_interview VALUES("160","43","162","","0","0","pending","","2018-07-05 16:40:52");
INSERT INTO tbl_invite_interview VALUES("161","43","163","","1","1","complete","","2018-07-05 16:41:35");
INSERT INTO tbl_invite_interview VALUES("162","43","164","","1","1","complete","","2018-07-06 08:50:01");
INSERT INTO tbl_invite_interview VALUES("163","43","165","","1","1","complete","","2018-07-06 09:21:02");
INSERT INTO tbl_invite_interview VALUES("165","45","167","","0","0","pending","","2018-07-09 12:40:30");
INSERT INTO tbl_invite_interview VALUES("166","45","168","","0","0","pending","","2018-07-09 12:41:19");
INSERT INTO tbl_invite_interview VALUES("167","45","169","","0","0","pending","","2018-07-09 13:08:53");
INSERT INTO tbl_invite_interview VALUES("168","45","170","","0","0","pending","","2018-07-09 13:10:52");
INSERT INTO tbl_invite_interview VALUES("169","45","171","","0","0","pending","","2018-07-09 13:15:07");
INSERT INTO tbl_invite_interview VALUES("170","45","172","","0","0","pending","","2018-07-09 13:36:54");
INSERT INTO tbl_invite_interview VALUES("171","45","173","","0","0","pending","","2018-07-09 13:41:26");
INSERT INTO tbl_invite_interview VALUES("172","45","174","","0","0","pending","","2018-07-09 14:15:36");
INSERT INTO tbl_invite_interview VALUES("173","45","175","","0","0","pending","","2018-07-09 14:58:07");
INSERT INTO tbl_invite_interview VALUES("174","45","176","","0","0","pending","","2018-07-09 16:02:30");
INSERT INTO tbl_invite_interview VALUES("175","45","177","","0","0","pending","","2018-07-09 16:37:49");
INSERT INTO tbl_invite_interview VALUES("176","45","178","","0","0","pending","","2018-07-09 17:30:41");
INSERT INTO tbl_invite_interview VALUES("177","45","179","","0","0","pending","","2018-07-10 10:30:45");
INSERT INTO tbl_invite_interview VALUES("178","45","180","","0","0","pending","","2018-07-10 12:09:10");
INSERT INTO tbl_invite_interview VALUES("179","45","181","","0","0","pending","","2018-07-10 12:10:50");
INSERT INTO tbl_invite_interview VALUES("181","44","183","","1","1","complete","","2018-07-10 15:44:35");
INSERT INTO tbl_invite_interview VALUES("182","45","184","","1","1","complete","","2018-07-10 15:53:24");
INSERT INTO tbl_invite_interview VALUES("183","44","185","","0","0","pending","","2018-07-10 15:53:54");
INSERT INTO tbl_invite_interview VALUES("185","44","187","","0","0","pending","","2018-07-10 16:20:35");
INSERT INTO tbl_invite_interview VALUES("186","44","188","","0","0","pending","","2018-07-10 16:47:21");
INSERT INTO tbl_invite_interview VALUES("187","44","189","","1","1","complete","","2018-07-10 16:51:45");
INSERT INTO tbl_invite_interview VALUES("188","44","190","","0","0","pending","","2018-07-10 20:08:24");
INSERT INTO tbl_invite_interview VALUES("189","44","191","","0","0","pending","","2018-07-10 20:43:06");
INSERT INTO tbl_invite_interview VALUES("190","44","192","","0","0","pending","","2018-07-10 22:35:07");
INSERT INTO tbl_invite_interview VALUES("191","45","193","","1","1","complete","","2018-07-10 22:48:06");
INSERT INTO tbl_invite_interview VALUES("192","45","194","","0","0","pending","","2018-07-10 23:03:29");
INSERT INTO tbl_invite_interview VALUES("193","45","195","","0","0","pending","","2018-07-11 00:20:03");
INSERT INTO tbl_invite_interview VALUES("194","44","196","","1","1","complete","","2018-07-11 08:02:01");
INSERT INTO tbl_invite_interview VALUES("195","45","197","","0","0","pending","","2018-07-11 09:08:52");
INSERT INTO tbl_invite_interview VALUES("196","45","198","","0","0","pending","","2018-07-11 09:09:53");
INSERT INTO tbl_invite_interview VALUES("197","44","199","","0","0","pending","","2018-07-11 09:14:26");
INSERT INTO tbl_invite_interview VALUES("198","46","200","","0","0","pending","","2018-07-11 10:45:49");
INSERT INTO tbl_invite_interview VALUES("199","46","201","","0","0","pending","","2018-07-11 11:04:43");
INSERT INTO tbl_invite_interview VALUES("200","44","202","","1","0","cancel","","2018-07-11 11:34:24");
INSERT INTO tbl_invite_interview VALUES("201","44","203","","1","1","complete","","2018-07-11 11:58:31");
INSERT INTO tbl_invite_interview VALUES("202","46","204","","0","0","pending","","2018-07-11 13:13:33");
INSERT INTO tbl_invite_interview VALUES("203","46","205","","0","0","pending","","2018-07-11 13:21:12");
INSERT INTO tbl_invite_interview VALUES("204","45","206","","0","0","pending","","2018-07-11 15:11:29");
INSERT INTO tbl_invite_interview VALUES("205","45","207","","0","0","pending","","2018-07-11 16:28:29");
INSERT INTO tbl_invite_interview VALUES("206","45","208","","0","0","pending","","2018-07-11 16:37:13");
INSERT INTO tbl_invite_interview VALUES("207","46","209","","0","0","pending","","2018-07-11 17:14:17");
INSERT INTO tbl_invite_interview VALUES("208","46","210","","1","1","complete","","2018-07-11 18:50:37");
INSERT INTO tbl_invite_interview VALUES("209","46","211","","0","0","pending","","2018-07-11 19:59:42");
INSERT INTO tbl_invite_interview VALUES("210","46","212","","0","0","pending","","2018-07-12 08:47:50");
INSERT INTO tbl_invite_interview VALUES("211","46","213","","0","0","pending","","2018-07-12 10:38:23");
INSERT INTO tbl_invite_interview VALUES("212","45","214","","1","1","complete","","2018-07-12 11:19:46");
INSERT INTO tbl_invite_interview VALUES("213","45","215","","0","0","pending","","2018-07-12 12:58:42");
INSERT INTO tbl_invite_interview VALUES("214","45","216","","0","0","pending","","2018-07-12 15:32:41");
INSERT INTO tbl_invite_interview VALUES("215","45","217","","0","0","pending","","2018-07-12 17:34:21");
INSERT INTO tbl_invite_interview VALUES("216","46","218","","0","0","pending","","2018-07-13 11:33:39");




CREATE TABLE `tbl_job_profile` (
  `job_profile_id` int(11) NOT NULL AUTO_INCREMENT,
  `manager_id` int(11) NOT NULL,
  `title` varchar(50) CHARACTER SET utf8 NOT NULL,
  `role_title` varchar(50) NOT NULL,
  `question_list` longtext NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`job_profile_id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

INSERT INTO tbl_job_profile VALUES("1","5","Accounting","Accountant","[{\"question\":\"Que 1\",\"expire\":\"10\"}]","2018-03-29 08:36:48");
INSERT INTO tbl_job_profile VALUES("2","12","pt","pt","[{\"question\":\"hi\",\"expire\":\"10\"}]","2018-03-29 11:57:22");
INSERT INTO tbl_job_profile VALUES("3","17","Vox Rein Manager","HR Manager","[{\"question\":\"first\",\"expire\":\"30\"},{\"question\":\"Second\",\"expire\":\"60\"},{\"question\":\"Third\",\"expire\":\"180\"}]","2018-03-29 12:36:05");
INSERT INTO tbl_job_profile VALUES("4","23","Recruitment","HR Assistants","[{\"question\":\"Key strenghts\",\"expire\":\"60\"},{\"question\":\"Key Weaknesses\",\"expire\":\"30\"},{\"question\":\"Sell this pen\",\"expire\":\"60\"}]","2018-03-30 07:48:56");
INSERT INTO tbl_job_profile VALUES("5","23","Development","Marketing Manager","[{\"question\":\"Summarise your CV\",\"expire\":\"60\"}]","2018-03-30 07:49:18");
INSERT INTO tbl_job_profile VALUES("6","38","Project Mars","Survival","[{\"question\":\"What is the answer to life the universe and everything?\",\"expire\":\"42\"},{\"question\":\"How much wood would a woodchuck chuck if a woodchuck could chuck wood\",\"expire\":\"45\"},{\"question\":\"What will be the downfall of humanity\",\"expire\":\"80\"}]","2018-04-01 12:09:01");
INSERT INTO tbl_job_profile VALUES("7","44","Finance Intake","Financial Manager","[{\"question\":\"Question 1\",\"expire\":\"60\"},{\"question\":\"Question 2\",\"expire\":\"20\"}]","2018-04-03 12:41:38");
INSERT INTO tbl_job_profile VALUES("10","61","profile","test","[{\"question\":\"asdfasdf\",\"expire\":\"10\"}]","2018-04-04 07:44:01");
INSERT INTO tbl_job_profile VALUES("12","43","Renault Sales Manager","Renault Sales Manager","[{\"question\":\"What are the 7 Sales Skills that can\'t be taught?\",\"expire\":\"60\"},{\"question\":\"What Sales Technique do you think most people get wrong and why?\",\"expire\":\"60\"},{\"question\":\"How do you deal with people who learn slowly?\",\"expire\":\"30\"},{\"question\":\"In a small room, you have a refrigerator. If you left the door of the fridge open, would the temperature in the room fall or would the temperature in the fridge rise? Why?\",\"expire\":\"60\"}]","2018-04-05 09:25:43");
INSERT INTO tbl_job_profile VALUES("13","44","Financial intake","CA\'s","[{\"question\":\"What is strengths\",\"expire\":\"60\"},{\"question\":\"Sell me this pen\",\"expire\":\"30\"}]","2018-04-06 09:12:28");
INSERT INTO tbl_job_profile VALUES("14","144","Marketing Intake","Marketing Manager","[{\"question\":\"My question 1\",\"expire\":\"30\"},{\"question\":\"My question 2\",\"expire\":\"30\"},{\"question\":\"My question 4\",\"expire\":\"40\"},{\"question\":\"My question 5\",\"expire\":\"25\"}]","2018-04-06 10:30:05");
INSERT INTO tbl_job_profile VALUES("16","168","Test profile","Test","[{\"question\":\"Tell me about yourself\",\"expire\":\"30\"},{\"question\":\"What tell me about your educational background\",\"expire\":\"30\"},{\"question\":\"What are you passionate about\",\"expire\":\"30\"}]","2018-04-08 22:16:34");
INSERT INTO tbl_job_profile VALUES("17","168","Development ","Data Scientist","[{\"question\":\"Your name\",\"expire\":\"10\"},{\"question\":\"Your favourite color\",\"expire\":\"20\"}]","2018-04-08 22:22:52");
INSERT INTO tbl_job_profile VALUES("18","187","Finance intake","CA\'s","[{\"question\":\"Question 1\",\"expire\":\"20\"},{\"question\":\"Question 2\",\"expire\":\"10\"},{\"question\":\"Question 3\",\"expire\":\"5\"}]","2018-04-10 12:24:42");
INSERT INTO tbl_job_profile VALUES("19","187","Marketing","PA Testing","[{\"question\":\"Type 1\",\"expire\":\"10\"},{\"question\":\"Type 2\",\"expire\":\"15\"}]","2018-04-10 12:25:09");
INSERT INTO tbl_job_profile VALUES("20","196","Profile 1","Profile Profile 1","[{\"question\":\"Que 1\",\"expire\":\"30\"}]","2018-04-10 13:34:32");
INSERT INTO tbl_job_profile VALUES("21","43","Hyundai ","Hyundai","[{\"question\":\"What is your favourite Hyundai car and why?\",\"expire\":\"20\"},{\"question\":\"In your opinion, what makes Hyundai great?\",\"expire\":\"30\"},{\"question\":\"How does Hyundai live up to it\'s motto - \\\"New Thinking, New Possibilities\\\"?\",\"expire\":\"60\"}]","2018-04-11 08:57:26");
INSERT INTO tbl_job_profile VALUES("22","223","Vox Rein Manager","HR Manager","[{\"question\":\"Test\",\"expire\":\"10\"}]","2018-04-11 12:11:23");
INSERT INTO tbl_job_profile VALUES("23","232","Sheldon Survey","Sheldon Survey","[{\"question\":\"What is the most annoying thing Sheldon has ever done?\",\"expire\":\"30\"},{\"question\":\"What is the biggest insult Sheldon has ever given you?\",\"expire\":\"20\"},{\"question\":\"What is your favourite fantasy of destroying Sheldon?\",\"expire\":\"30\"}]","2018-04-15 16:19:34");
INSERT INTO tbl_job_profile VALUES("24","239","Therapists","Clinical Specialist & Headspace Chatter Box","[{\"question\":\"What is your theoretical orientation?\",\"expire\":\"120\"},{\"question\":\"How do you stay organized and stay on top of documentation?\",\"expire\":\"120\"},{\"question\":\"What experience have you had with inappropriate boundaries and violations and how have you corrected them?\",\"expire\":\"120\"},{\"question\":\"How do you maintain the confidentiality of clients?\",\"expire\":\"20\"},{\"question\":\"How do you utilize your supervision time?\",\"expire\":\"120\"},{\"question\":\"What experience have you had with crisis interventions and how did you handle it?\",\"expire\":\"120\"},{\"question\":\"What experience do you have with cultural competency and trauma-informed care?\",\"expire\":\"60\"},{\"question\":\"What do you do for self care?\",\"expire\":\"60\"},{\"question\":\"What is your experience with sexuality and gender issues?\",\"expire\":\"30\"}]","2018-04-16 20:52:51");
INSERT INTO tbl_job_profile VALUES("25","44","Testing system usuability","Developer testing","[{\"question\":\"Does this system work in Internet Explorer and Safari\",\"expire\":\"10\"},{\"question\":\"Does this system work on mobile devices like iPhone, Samsung phone etc.\",\"expire\":\"10\"}]","2018-05-04 13:39:24");
INSERT INTO tbl_job_profile VALUES("26","168","Test exam paper","Grade 4 Engligh","[{\"question\":\"Name the factors of 12\",\"expire\":\"30\"},{\"question\":\"How many legs does an elephant have\",\"expire\":\"10\"}]","2018-06-19 12:09:44");
INSERT INTO tbl_job_profile VALUES("27","43","Competency interview","Competency interview","[{\"question\":\"Describe an initiative you took at work without being instructed to do so.\\r\\n- Discuss the process you followed to see the initiative through.\\r\\n- What was the outcome?\",\"expire\":\"60\"},{\"question\":\"Describe an occasion when you willingly assumed responsibility for a key decision at work.\\r\\n- What was the decision you made?\\r\\n- What attributes enabled you to willingly assume the responsibility?\",\"expire\":\"60\"}]","2018-06-25 08:14:55");
INSERT INTO tbl_job_profile VALUES("28","43","OBI Questions","OBI Questions","[{\"question\":\"Discuss a time when you had to take action in order to finish a project or task on time.\\r\\n(Did you carefully consider the advantages and disadvantages of the project before taking action?)\\r\\n(Did you bend any rules in order to meet the specific deadline? Explain)\\r\\n(Did you consider how your actions might affect other people? If so, why?)\",\"expire\":\"60\"},{\"question\":\"Give me an example of where you showed your loyalty to your organisation or a colleague.\\r\\n(Would you say you did more than expected in this situation? Why?)\\r\\n(Do you feel a sense of belonging in your organisation or amongst your colleagues? What would you change?)\",\"expire\":\"60\"},{\"question\":\"Describe a time when you went the extra mile to complete a certain task or project at work.\\r\\n(Why did you feel like you had to do more than expected?)\\r\\n(Did you work after hours to achieve your goals? Why\\/why not?)\\r\\n(How did you remain loyal to the organisation\'s systems, norms and values?)\",\"expire\":\"60\"}]","2018-06-25 14:38:53");
INSERT INTO tbl_job_profile VALUES("29","43","IHS e-interview","IHS e-interview","[{\"question\":\"You receive the following call: \\\"Good morning. My name is Lindie. We have received a delivery from you, but it was not meant for us. How can we resolve this problem?\\\" Please explain how you would address this situation?\",\"expire\":\"30\"},{\"question\":\"You receive the following call: \\\"Hi, it\'s Amos. I\'m very angry. I have been waiting for my order for more than 10 days and all I keep hearing from you is it is on the way. Well, I don\'t believe you. Please give me the name of a manager who can actually help me. \\\" How do you address this situation?\",\"expire\":\"30\"},{\"question\":\"You have received a call from a customer who explaining that he has a problem with his product. you do not completely understand what the problem is and you need clearer specifications, so you must interrupt the customer and ask questions. How do you go about this and which questions do you ask?\",\"expire\":\"60\"},{\"question\":\"A customer is calling to complain about poor service she has received from your company. She would like you to log a complaint against the previous representative that she spoke to. How do you deal with this situation? What do you ask her and what is the process that you follow?\",\"expire\":\"60\"}]","2018-07-04 12:50:02");
INSERT INTO tbl_job_profile VALUES("30","309","Test Profile for Demo purposes","Sample intervie","[{\"question\":\"Tell us about yourself\",\"expire\":\"30\"},{\"question\":\"What makes you truly happy\",\"expire\":\"30\"},{\"question\":\"Name 3 things on your bucket list\",\"expire\":\"15\"},{\"question\":\"List one thing that is a non negotiable for you in choosing an employer \\/ business partner\",\"expire\":\"10\"}]","2018-07-04 22:08:35");
INSERT INTO tbl_job_profile VALUES("31","306","Reception / Admin - HO","Receptionist / Administrator","[{\"question\":\"Tell us about yourself\",\"expire\":\"60\"},{\"question\":\"Why Weylandts\",\"expire\":\"60\"},{\"question\":\"Why should we choose you\",\"expire\":\"60\"}]","2018-07-05 15:55:30");
INSERT INTO tbl_job_profile VALUES("32","306","Sales Consultant","Sandton Sales Consultant","[{\"question\":\"Tell us a little bit about yourself\",\"expire\":\"60\"},{\"question\":\"Tell us about your sales experience within a retail environment\",\"expire\":\"60\"},{\"question\":\"What are your strengths within a sales environment \",\"expire\":\"60\"},{\"question\":\"Why Weylandts\",\"expire\":\"60\"}]","2018-07-09 10:02:04");
INSERT INTO tbl_job_profile VALUES("33","306","Sales Consultant - PE","PE Roles","[{\"question\":\"Tell us a little bit about yourself\",\"expire\":\"60\"},{\"question\":\"Tell us about your sales experience within a retail environment\",\"expire\":\"60\"},{\"question\":\"What are your strengths within a sales environment \",\"expire\":\"60\"},{\"question\":\"Why Weylandts\",\"expire\":\"60\"}]","2018-07-11 10:12:24");




CREATE TABLE `tbl_manager` (
  `manager_id` int(11) NOT NULL AUTO_INCREMENT,
  `account_manager_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `department` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`manager_id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

INSERT INTO tbl_manager VALUES("5","16","Manager 1","HR","batodiya.pramod@gmail.com","1","2018-03-29 12:34:15");
INSERT INTO tbl_manager VALUES("6","22","Manager One","Marketing","managerone@ahonline.co","1","2018-03-30 07:45:28");
INSERT INTO tbl_manager VALUES("7","22","Manager Two","HR","managertwo@ahonline.co","1","2018-03-30 07:45:44");
INSERT INTO tbl_manager VALUES("8","22","Manager Three","Finance","managerthree@ahonline.co","1","2018-03-30 07:46:02");
INSERT INTO tbl_manager VALUES("9","22","Debri van Wyk","Accounts","debri@ahonline.co","1","2018-03-30 09:37:48");
INSERT INTO tbl_manager VALUES("10","22","Ciska van Aswegen","Crazy town","ciska@assessmenthouse.com","1","2018-03-30 09:58:27");
INSERT INTO tbl_manager VALUES("11","42","Ciska van Aswegen","Assessments","cvanaswegen@ih.co.za","1","2018-04-03 12:37:10");
INSERT INTO tbl_manager VALUES("12","42","Debri van Wyk","HR","dvanwyk@ahonline.co","1","2018-04-03 12:37:27");
INSERT INTO tbl_manager VALUES("13","42","John Smith","HR","smith@ahonline.co","1","2018-04-03 20:54:53");
INSERT INTO tbl_manager VALUES("16","16","vox rein","test","p.batodiya@gmail.com","1","2018-04-05 17:21:16");
INSERT INTO tbl_manager VALUES("17","16","vox rain t","1233","iinspectionid@gmail.com","1","2018-04-05 18:39:04");
INSERT INTO tbl_manager VALUES("19","16","Nitesh Nitz","Branch / Department","nitesh.iosdev@gmail.com","1","2018-04-06 08:18:10");
INSERT INTO tbl_manager VALUES("20","42","John Smith","HR","js@ahonline.co","1","2018-04-06 08:58:28");
INSERT INTO tbl_manager VALUES("21","143","Assess Man3","HR","am3@ahonline.co","1","2018-04-06 10:25:41");
INSERT INTO tbl_manager VALUES("22","143","Assess House4","Marketing","am4@ahonline.co","1","2018-04-06 10:26:16");
INSERT INTO tbl_manager VALUES("24","186","Ciska van Aswegen","Assessments","ciska@ahonline.co","1","2018-04-10 12:21:44");
INSERT INTO tbl_manager VALUES("25","186","Sue Sample","HR","suesample@ahonline.co","1","2018-04-10 12:22:03");
INSERT INTO tbl_manager VALUES("26","182","test manager","Manager","test@mailinator.com","1","2018-04-10 13:29:54");
INSERT INTO tbl_manager VALUES("27","203","Manager Ex","HR","manex@ahonline.co","1","2018-04-11 08:52:30");
INSERT INTO tbl_manager VALUES("31","219","Pramod Batodiya","Branch / Department","p.batodiya@gmail.com","1","2018-04-11 12:08:03");
INSERT INTO tbl_manager VALUES("32","219","James Bond","Branch / Department","iinspectionid@gmail.com","1","2018-04-11 12:09:31");
INSERT INTO tbl_manager VALUES("33","230","Amy Farrah Fowler","Neurobiology","amyff@qims.co.za","1","2018-04-15 16:11:48");
INSERT INTO tbl_manager VALUES("36","238","Vaughn Mosher","Wise Guys","vmosher@ibl.bm","1","2018-04-16 20:35:15");
INSERT INTO tbl_manager VALUES("40","303","Manager One","Branc","manone@ahonline.co","1","2018-07-04 17:59:41");
INSERT INTO tbl_manager VALUES("41","305","Monica Eckermann","Weylandts","monica.eckermann@Weylandtshome.co.za","1","2018-07-04 21:53:03");
INSERT INTO tbl_manager VALUES("42","305","EP Landman","Rentia\'s promotional account","rentia.landman@gmail.com","1","2018-07-04 22:00:17");




CREATE TABLE `tbl_project` (
  `project_id` int(11) NOT NULL AUTO_INCREMENT,
  `project_name` varchar(50) NOT NULL,
  `project_code` text NOT NULL,
  `profile_id` int(11) NOT NULL,
  `account_manager_id` int(11) NOT NULL,
  `manager_id` int(11) NOT NULL,
  `rater_id` text NOT NULL,
  `candidate_id` text,
  `project_type` varchar(20) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `notification` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`project_id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;

INSERT INTO tbl_project VALUES("1","Project 404","cyfqncpwqtqr8y2x","1","3","5","[\"1\",\"2\"]","[1,2]","open","2018-03-29","0000-00-00","on","launch","2018-03-29 08:39:16");
INSERT INTO tbl_project VALUES("2","test project","m0efu7r8y66452hu","2","11","12","[\"3\",\"4\"]","[3,5]","open","2018-03-28","0000-00-00","on","launch","2018-03-29 11:58:48");
INSERT INTO tbl_project VALUES("4","HR Assistant","2dzj083zhnny34w4","4","22","23","[\"7\",\"9\"]","[8,9]","expiry","2018-03-30","2018-04-05","on","launch","2018-03-30 07:52:31");
INSERT INTO tbl_project VALUES("5","Marketing development","sk57uyd447y22cu7","5","22","23","[\"8\",\"10\"]","","open","2018-03-30","0000-00-00","off","launch","2018-03-30 07:53:04");
INSERT INTO tbl_project VALUES("6","Finance ","ndy6dnsis4ga8ecc","5","22","23","","[6,7]","expiry","2018-03-30","2018-03-31","on","launch","2018-03-30 07:54:04");
INSERT INTO tbl_project VALUES("8","Selecting HR managers","fzeh22rz5yjkzg0t","7","42","44","[\"16\",\"21\"]","[11,13,16,97,98,115,120]","open","2018-04-03","0000-00-00","on","launch","2018-04-03 12:47:48");
INSERT INTO tbl_project VALUES("11","Project 1","kopv2wdw2i0gr5jf","10","60","61","","[17,18,24]","open","2018-04-04","0000-00-00","on","launch","2018-04-04 07:44:18");
INSERT INTO tbl_project VALUES("14","Renault Sales Manager","0op75q8kbsmh3fo5","12","42","43","","[33,35,36,37,38,39,73,77,82,84,85,89,90,91,95,104,105,107,109]","open","2018-04-05","0000-00-00","on","launch","2018-04-05 09:27:15");
INSERT INTO tbl_project VALUES("22","Marketing","bojcxtwnvvbahq22","14","143","144","[\"26\",\"28\"]","[86,87,88,92]","open","2018-04-06","0000-00-00","off","launch","2018-04-06 10:31:37");
INSERT INTO tbl_project VALUES("24","New Project","o8d8gh34jb66ef6v","13","42","44","","[112]","expiry","2018-04-08","2018-04-11","off","launch","2018-04-08 17:13:06");
INSERT INTO tbl_project VALUES("27","New intake","tam3sgzb8snn5xp3","19","186","187","[\"36\"]","[101]","open","2018-04-10","0000-00-00","on","launch","2018-04-10 12:26:27");
INSERT INTO tbl_project VALUES("28","Project 404","dehyjti0hhjeeuyy","0","182","196","","[102,110]","open","2018-04-10","0000-00-00","on","launch","2018-04-10 13:35:58");
INSERT INTO tbl_project VALUES("29","Project 500","5iko0rsp2gibnrnq","20","182","196","[\"40\",\"41\"]","[103]","open","2018-04-10","0000-00-00","on","launch","2018-04-10 13:46:33");
INSERT INTO tbl_project VALUES("30","Test rater","zgqskmxjukvrhdz2","7","42","44","[\"17\"]","","open","2018-04-11","0000-00-00","on","launch","2018-04-11 08:53:54");
INSERT INTO tbl_project VALUES("32","Hyundai","i2jg25s3djsacji4","21","42","43","[\"42\",\"44\"]","[108]","open","2018-04-11","0000-00-00","on","launch","2018-04-11 09:03:34");
INSERT INTO tbl_project VALUES("33","Test 1","anoz7nmksphkc5t6","22","219","223","","[111,140,152]","open","2018-04-11","0000-00-00","on","launch","2018-04-11 12:11:49");
INSERT INTO tbl_project VALUES("34","Sheldon Survey","sizfctfts2mgduhv","23","230","232","[\"46\",\"47\"]","[113,114]","open","2018-04-15","0000-00-00","on","launch","2018-04-15 16:23:49");
INSERT INTO tbl_project VALUES("36","Growing the Therapist Pool","ffit2y6sn6ptvs7o","24","238","239","[\"48\",\"51\"]","[117,118,119]","expiry","2018-04-16","2018-04-20","on","launch","2018-04-16 21:50:30");
INSERT INTO tbl_project VALUES("37","Test project","srmxdrs0bczcinhd","16","164","168","[\"34\",\"35\"]","[121,122,123,124,141,142,143,144,145,146,147,148,149]","open","2018-04-25","0000-00-00","on","launch","2018-04-25 21:48:23");
INSERT INTO tbl_project VALUES("38","System testing","fvah6b2v0pgj0tsa","25","42","44","","[126,127,128,129,130,131,132,133,134,135,136,137,138,139]","open","2018-05-04","0000-00-00","on","launch","2018-05-04 13:40:03");
INSERT INTO tbl_project VALUES("39","Math exam","7x5tbmxpxt3eh7ys","26","164","168","[\"34\",\"35\"]","[150,151]","open","2018-06-19","0000-00-00","on","launch","2018-06-19 12:11:11");
INSERT INTO tbl_project VALUES("40","Competency interview","772ix6uhzik0vsje","27","42","43","[\"32\",\"33\"]","[153]","open","2018-06-25","0000-00-00","on","launch","2018-06-25 08:15:41");
INSERT INTO tbl_project VALUES("41","IHS e-interview","6gkry2wdnrpdb6pp","29","42","43","[\"52\"]","[154,155,156,157,158]","open","2018-07-04","0000-00-00","on","launch","2018-07-04 12:55:27");
INSERT INTO tbl_project VALUES("42","Test interview for promotional purposes","uj2ddvosksgnssqw","30","305","309","[\"54\",\"55\"]","[159,160]","open","2018-07-04","0000-00-00","on","launch","2018-07-04 22:13:00");
INSERT INTO tbl_project VALUES("43","IHS E-interview 5/7/2018","yed7r4dyebbx354w","29","42","43","[\"52\",\"53\"]","[161,162,163,164,165]","open","2018-07-05","0000-00-00","off","launch","2018-07-05 09:01:38");
INSERT INTO tbl_project VALUES("44","Receptionist / Administrator","7uopeqybv4rxykge","31","305","306","[\"54\"]","[185,187,188,189,190,191,192,196,199,202,203]","expiry","2018-07-09","2018-07-12","on","launch","2018-07-09 10:03:05");
INSERT INTO tbl_project VALUES("45","Sandton Sales Consultant","xbos7osfnxnjyhf0","32","305","306","","[167,168,169,170,171,172,173,174,175,176,177,178,179,180,181,184,193,194,195,197,198,206,207,208,214,215,216,217]","expiry","2018-07-09","2018-07-12","on","create","2018-07-09 11:47:42");
INSERT INTO tbl_project VALUES("46","PE Store Positions","kwwsud6oeweo2x0n","33","305","306","","[201,204,205,209,210,211,212,213,218]","expiry","2018-07-11","2018-07-13","on","create","2018-07-11 10:15:15");




CREATE TABLE `tbl_rater` (
  `rater_id` int(11) NOT NULL AUTO_INCREMENT,
  `account_manager_id` int(11) NOT NULL,
  `manager_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`rater_id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=latin1;

INSERT INTO tbl_rater VALUES("5","16","17","Rater 1","rater123@mailinator.com","1","2018-03-29 12:36:44");
INSERT INTO tbl_rater VALUES("6","16","17","Rater 2","rater1234@mailinator.com","1","2018-03-29 12:37:13");
INSERT INTO tbl_rater VALUES("7","22","23","Alpha Rater","alpha@ahonline.co","1","2018-03-30 07:47:06");
INSERT INTO tbl_rater VALUES("8","22","23","Beta Rater","beta@ahonline.co","1","2018-03-30 07:47:15");
INSERT INTO tbl_rater VALUES("9","22","23","Charlie Rater","charlie@ahonline.co","1","2018-03-30 07:47:24");
INSERT INTO tbl_rater VALUES("10","22","23","Delta Rater","delta@ahonline.co","1","2018-03-30 07:47:33");
INSERT INTO tbl_rater VALUES("11","22","23","Echo Rater","echo@ahonline.co","1","2018-03-30 07:47:54");
INSERT INTO tbl_rater VALUES("12","16","17","Rater 3","rater3@mailinator.com","1","2018-03-30 09:02:36");
INSERT INTO tbl_rater VALUES("13","22","23","Foxtrot Rater","foxtrot@ahonline.co","1","2018-03-30 11:56:22");
INSERT INTO tbl_rater VALUES("14","22","38","Elon Musk","boringco@earth.com","1","2018-04-01 12:06:26");
INSERT INTO tbl_rater VALUES("15","22","38","Einstein","relativity@physics.co.za","1","2018-04-01 12:06:42");
INSERT INTO tbl_rater VALUES("16","42","44","Alpha Rater","alpharater@ahonline.co","1","2018-04-03 12:39:55");
INSERT INTO tbl_rater VALUES("17","42","44","Beta Rater","betarater@ahonline.co","1","2018-04-03 12:40:04");
INSERT INTO tbl_rater VALUES("18","42","44","Charlie Rater","charlierater@ahonline.co","1","2018-04-03 12:40:15");
INSERT INTO tbl_rater VALUES("19","42","44","Delta Rater","deltarater@ahonline.co","1","2018-04-03 12:40:34");
INSERT INTO tbl_rater VALUES("20","42","44","Echo Rater","echorater@ahonline.co","1","2018-04-03 12:40:52");
INSERT INTO tbl_rater VALUES("26","143","144","Asses3 Rater1","ar31@ahonline.co","1","2018-04-06 10:28:00");
INSERT INTO tbl_rater VALUES("27","143","144","Asses3 Rater2","ar32@ahonline.co","1","2018-04-06 10:28:27");
INSERT INTO tbl_rater VALUES("28","143","144","Asses3 Rater3","ar33@ahonline.co","1","2018-04-06 10:28:48");
INSERT INTO tbl_rater VALUES("29","143","144","Asses3 Rater4","ar34@ahonline.co","1","2018-04-06 10:29:05");
INSERT INTO tbl_rater VALUES("32","42","43","Sheldon Cooper","sheldon@qims.co.za","1","2018-04-06 11:44:36");
INSERT INTO tbl_rater VALUES("33","42","43","Leonard Hofstadter","leonardh@qims.co.za","1","2018-04-06 11:44:47");
INSERT INTO tbl_rater VALUES("36","186","187","Rat One","rat1@ahonline.co","1","2018-04-10 12:23:15");
INSERT INTO tbl_rater VALUES("37","186","187","Rat 2","rat2@ahonline.co","1","2018-04-10 12:23:35");
INSERT INTO tbl_rater VALUES("38","186","187","Rat three","rat3@ahonline.co","1","2018-04-10 12:23:50");
INSERT INTO tbl_rater VALUES("39","186","187","Rat 4","rat4@ahonline.co","1","2018-04-10 12:24:02");
INSERT INTO tbl_rater VALUES("40","182","196","Rater 1","rater1@mailinator.com","1","2018-04-10 13:33:55");
INSERT INTO tbl_rater VALUES("41","182","196","Rater 2","rater2@mailinator.com","1","2018-04-10 13:34:07");
INSERT INTO tbl_rater VALUES("42","42","43","Masenyane Molefe","masenyanem@hyundai.co.za","1","2018-04-11 09:01:38");
INSERT INTO tbl_rater VALUES("44","42","43","Phumi Masinga","phumim@hyundai.co.za","1","2018-04-11 09:03:06");
INSERT INTO tbl_rater VALUES("45","219","223","Rater 1","rater111@mailinator.com","1","2018-04-11 12:10:53");
INSERT INTO tbl_rater VALUES("46","230","232","Leonard Hofstadter","drleonardh@qims.co.za","1","2018-04-15 16:16:45");
INSERT INTO tbl_rater VALUES("47","230","232","Penny","penny@qims.co.za","1","2018-04-15 16:17:07");
INSERT INTO tbl_rater VALUES("48","238","239","Helen Orchard","helen@benedict.bm","1","2018-04-16 20:35:41");
INSERT INTO tbl_rater VALUES("49","238","239","Marthinus Pagel","thinus1979@yahoo.co.uk","1","2018-04-16 20:36:25");
INSERT INTO tbl_rater VALUES("51","238","239","Vaughn Mosher","vmosher@ibl.bm","1","2018-04-16 21:33:37");
INSERT INTO tbl_rater VALUES("52","42","43","Colette Wessels","Colette.Wessels@imperiallogistics.com","1","2018-07-04 12:54:39");
INSERT INTO tbl_rater VALUES("53","42","43","Veronica Mthombeni","Veronica.Mthombeni@imperiallogistics.com","1","2018-07-04 15:05:38");
INSERT INTO tbl_rater VALUES("56","305","306","Liz Wolf","Liz.Wolf@Weylandtshome.co.za","1","2018-07-11 11:43:29");
INSERT INTO tbl_rater VALUES("57","305","306","Toni August","Toni.August@Weylandtshome.co.za","1","2018-07-11 11:44:16");




CREATE TABLE `tbl_rater_evaluation` (
  `rater_evaluation_id` int(11) NOT NULL AUTO_INCREMENT,
  `interview_id` int(11) NOT NULL,
  `rater_id` int(11) NOT NULL,
  `rating` varchar(20) DEFAULT NULL,
  `comment` text,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`rater_evaluation_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

INSERT INTO tbl_rater_evaluation VALUES("1","11","3","","mm","0000-00-00 00:00:00");
INSERT INTO tbl_rater_evaluation VALUES("2","12","6","","This is Rater one comment.","0000-00-00 00:00:00");
INSERT INTO tbl_rater_evaluation VALUES("3","13","7","2","","0000-00-00 00:00:00");
INSERT INTO tbl_rater_evaluation VALUES("4","18","25","2","Hmm, doesn\'t seem motivated","0000-00-00 00:00:00");
INSERT INTO tbl_rater_evaluation VALUES("5","19","25","1","dfghsdfg","0000-00-00 00:00:00");
INSERT INTO tbl_rater_evaluation VALUES("6","20","25","2","asdfa","0000-00-00 00:00:00");
INSERT INTO tbl_rater_evaluation VALUES("7","21","25","3","sdf","0000-00-00 00:00:00");
INSERT INTO tbl_rater_evaluation VALUES("8","33","28","1","nannann
\n","0000-00-00 00:00:00");
INSERT INTO tbl_rater_evaluation VALUES("9","34","28","2","yayayaya","0000-00-00 00:00:00");
INSERT INTO tbl_rater_evaluation VALUES("10","33","26","2","ffff","0000-00-00 00:00:00");
INSERT INTO tbl_rater_evaluation VALUES("11","34","26","2","ffffff","0000-00-00 00:00:00");
INSERT INTO tbl_rater_evaluation VALUES("12","38","32","1","no","0000-00-00 00:00:00");
INSERT INTO tbl_rater_evaluation VALUES("13","40","32","3","brilliant","0000-00-00 00:00:00");
INSERT INTO tbl_rater_evaluation VALUES("14","38","33","3","exceptional","0000-00-00 00:00:00");
INSERT INTO tbl_rater_evaluation VALUES("15","40","33","2","allright","0000-00-00 00:00:00");
INSERT INTO tbl_rater_evaluation VALUES("16","43","36","1","no","0000-00-00 00:00:00");
INSERT INTO tbl_rater_evaluation VALUES("17","50","46","2","hgfkg","0000-00-00 00:00:00");
INSERT INTO tbl_rater_evaluation VALUES("18","51","46","3","sdfgsfgh","0000-00-00 00:00:00");
INSERT INTO tbl_rater_evaluation VALUES("19","50","47","1","asdfsdfg","0000-00-00 00:00:00");
INSERT INTO tbl_rater_evaluation VALUES("20","51","47","2","asdf","0000-00-00 00:00:00");
INSERT INTO tbl_rater_evaluation VALUES("21","52","48","1","This would classify as alternative therapy","0000-00-00 00:00:00");



