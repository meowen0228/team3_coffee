create database team;
use team;
--  drop database shopFake;
-- 使用者
CREATE TABLE `users`(
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `user_name` VARCHAR(50) NOT NULL,
  `user_password` VARCHAR(20) NOT NULL,
  `user_birth` date NOT NULL,
  `user_mail` VARCHAR(255) NOT NULL UNIQUE,
  `user_mail2` VARCHAR(255) ,
  `user_address` VARCHAR(100) NOT NULL,
  `user_address_2` VARCHAR(100) ,
  `user_address_3` VARCHAR(100) ,
  `user_phone` VARCHAR(10) NOT NULL UNIQUE,
  `user_nick` VARCHAR(20),
  `CREATEd_at` TIMESTAMP DEFAULT NOW()
);
INSERT INTO `users`( `user_name`, `user_birth`,`user_mail`,`user_mail2`,`user_address`,`user_address_2`,`user_address_3`, `user_password`,`user_phone`,`user_nick`)
VALUES
('糾結倫','1997-01-01','jaychou@gmail.com','jaychouchou@gmail.com','台北市中正區北平西路3號','台中市中區台灣大道一段1號','高雄市三民區建國二路318號','abc123456','0912345699','內湖周杰倫'),
('裸志祥','1999-06-07','show@gmail.com','','時空之間','','','abc123456','0912345670','時間管理大師'),
('路易斯 漢米爾頓','1985-01-07','lh44@gmail.com','','英國倫敦','摩納哥','','abc123456','091234579','7次世界冠軍'),
('喬治 羅素','1998-02-05','gr63@gmail.com','','英國','摩納哥','','abc123456','0912345678','未來世界冠軍'),
('馬克思 維斯塔潘','1997-09-30','mv33@gmail.com','','荷蘭','摩納哥','','abc123456','0912345677','水冠世界冠軍'),
('塞吉歐 佩瑞茲','1990-01-26','sp11@gmail.com','','墨西哥','摩納哥','','abc123456','0912345676','墨西哥阿湯哥'),
('夏爾 勒克萊爾','1997-10-16','cl16@gmail.com','','摩納哥','','','abc123456','0912345675','法拉利未來之星'),
('卡洛斯 塞恩斯','1994-09-01','cs55@gmail.com','','西班牙','','','abc123456','0912345674','麥拉倫好基友A'),
('丹尼爾 里卡多','1989-07-01','dr03@gmail.com','','澳大利亞','摩納哥','','abc123456','0912345673','平頭哥'),
('蘭多 諾里斯','1999-11-13','ln04@gmail.com','','英國','','','abc123456','0912345672','麥拉倫好基友B'),
('費南多 阿隆索','1981-7-29','fa14@gmail.com','','西班牙','','','abc123456','0912345671','龍嫂'),
('埃斯特班 奧康','1996-09-17','eo31@gmail.com','','法國','','','abc123456','0912345660',''),
('皮埃爾 蓋斯利','1996-02-07','pg10@gmail.com','','法國','','','abc123456','0912345669','小牛王'),
('角田 裕毅','2000-05-11','yt22@gmail.com','','日本','','','abc123456','0912345668','角田小朋友'),
('塞巴斯蒂安 維特爾','1987-07-03','sv05@gmail.com','','德國','','','abc123456','0912345667','德國老農'),
('蘭斯 斯托爾','1998-10-29','ls18@gmail.com','','加拿大','','','abc123456','0912345666','太子哥'),
('尼古拉斯 拉提菲','1995-06-29','nl06@gmail.com','','加拿大','','','abc123456','0912345665',''),
('亞歷山大 阿邦','1996-03-23','aa23@gmail.com','','泰國','英國','','abc123456','0912345664',''),
('周 冠宇','1999-5-30','gz24@gmail.com','','西台灣','赤匪地區','','abc123456','0912345663',''),
('維爾特利 鮑達斯','1989-08-28','vb77@gmail.com','','芬蘭','','','abc123456','0912345662','老漢僚機'),
('凱文 馬格努森','1992-10-5','km20@gmail.com','','丹麥','','','abc123456','0912345661',''),
('米克 舒馬赫','1999-03-22','ms47@gmail.com','','德國','','','abc123456','0912345650','車神之子'),
('尼可 羅斯堡','1985-06-27','nr06@gmail.com','','德國','','','abc123456','0912345659','辣個男人'),
('馬克 舒馬赫','1969-01-03','rgms@gmail.com','','德國','','','abc123456','0912345658','7冠車神'),
('艾爾頓 洗拿','1960-03-21','rgas@gmail.com','','巴西','','','abc123456','0912345657','永遠的車神');

-- 使用者地址
-- CREATE TABLE `user_address`(
--   `id` INT PRIMARY KEY AUTO_INCREMENT,
--   `fk_user_id` INT NOT NULL,
--   address VARCHAR(100) ,
--   foreign KEY (`fk_user_id`) references users(id),
-- );
-- 會員提問
CREATE TABLE `user_ask`(
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `fk_user_id` INT NOT NULL,
  `ask` VARCHAR(200) NOT NULL,
  `ans` VARCHAR(200),
  foreign KEY (`fk_user_id`) references users(id)
);
INSERT INTO `user_ask`(`fk_user_id`,`ask`,`ans`)
VALUES
('1','請問買一送一要同品項嗎?',''),
('1','請問合計運費會因為重量增加而改變運費，還是單次運費就是固定的呢?','不會喔，單筆若一起寄送，運費都是固定的，不會因為重量增加而改變，但有可能體積超出寄送規定，而分開寄出，若發生此問題，客服會主動向您聯絡'),
('2','咖啡豆有分大小包嗎?',''),
('3','我是不是最強的車手?','是，你是'),
('4','今年會在哪個車隊','Mercedes-AMG Petronas F1 Team'),
('5','Max不是真的世界冠軍','沒錯他不是'),
('6','Max不是真的世界冠軍','沒錯他不是'),
('7','Max不是真的世界冠軍','沒錯他不是'),
('8','Max不是真的世界冠軍','沒錯他不是'),
('9','Max不是的世界冠軍','沒錯他不是'),
('10','Max不是真的世界冠軍','沒錯他不是'),
('11','Max不是真的世界冠軍',''),
('12','Max不是真的世界冠軍','沒錯他不是'),
('13','Max不是真的世界冠軍','沒錯他不是'),
('14','Max不是真的世界冠軍','沒錯他不是'),
('15','Max不是真的世界冠軍','沒錯他不是'),
('16','Max不是真的世界冠軍',''),
('17','Max不是真的世界冠軍','沒錯他不是'),
('18','Max不是真的世界冠軍','沒錯他不是'),
('19','Max不是真的世界冠軍','沒錯他不是'),
('20','Max不是真的世界冠軍',''),
('21','我爸是不是擁有最多世界冠軍的車手',''),
('22','世界冠軍買咖啡有打折嗎?',''),
('23','我想代言你們品牌方便嗎?',''),
('24','有賣試用包嗎?','');



--------------------------------------------------------------------------------------------------------------------------------
-- 商品類別
CREATE TABLE `product_types`(
`id` INT PRIMARY KEY AUTO_INCREMENT,
`type_name` VARCHAR(20) NOT NULL
);
INSERT INTO `product_types`( `type_name`)
VALUES
('巴西'),
('哥倫比亞'),
('肯亞'),
('衣索比亞'),
('瓜地馬拉'),
('其他');

-- 商品
CREATE TABLE `products`(
`id` INT  PRIMARY KEY AUTO_INCREMENT,
`p_name` VARCHAR(20) NOT NULL,
`price` INT NOT NULL,
`content` VARCHAR(1000) NOT NULL,
`status` TINYINT NOT NULL,
`fk_product_types` INT NOT NULL,
foreign KEY (fk_product_types) references product_types(id)
);
INSERT INTO `products`( `p_name`, `price`, `content`,`status`,`fk_product_types`)
VALUES
('肯亞AA TOP(半磅)','499','產地:非洲 <br>

處理法:水洗<br>

風味:黑梅/李子/葡萄<br>

AA TOP最高等級的肯亞咖啡豆其濃郁的黑梅香氣,口感豐富且尾韻悠長,轉化為肯亞特有的甜,一入口紅酒般的餘韻在口中揮之不去','1','3'),
('耶加雪菲(半磅)','380','產地:衣索比亞<br>

處理法:水洗<br>

風味:核果/可可/花香味/柑橘<br>

花神具有非常愉悅優雅花香主體的風味,酸性柔和且以巧克力般的風味尾韻作結,整體口感乾淨且明亮','1','4'),
('瓜地馬拉花神(半磅)','400','產地:瓜地馬拉<br>

處理法:日曬<br>

風味:莓果/蜜桃<br>

日曬耶加雪菲具有濃郁奔放的水果香,柔和綿長的蜜桃莓果酸卻不刺激,風味甜度高酸度明亮且細膩','1','5'),
('模範生(半磅)','420','產地:哥倫比亞<br>

處理法:水洗<br>


風味:柑橘/可可/奶油<br>


具有豐富的芳香水果酸氣迷人,且帶有柑橘的明亮甜感,巧克力的餘韻油脂感特佳','1','2'),
('曼巴(半磅)','300','產地:印尼/巴西<br>

處理法:半水洗<br>

風味:可可韻/奶油/草本香韻<br>

口感厚實甘醇的曼特寧搭配核果香氣絕佳的巴西咖啡豆,奶油的質感與明顯的可可味搭配後清雅的回甘口感一直會讓人回味無窮','1','1'),
('黃金曼巴(半磅)','380','產地:印尼/巴西<br>
處理法:半水洗<br>

風味:可可韻味/草本香韻/奶油<br>

口感厚實甘醇的頂級黃金曼特寧搭配核果香氣絕佳的巴西咖啡豆,完美平衡呈現奶油的質感與明顯的可可味','1','1'),
('瓜地馬拉花神(半磅)','400','產地:瓜地馬拉<br>

處理法:日曬<br>

風味:莓果/蜜桃<br>

日曬耶加雪菲具有濃郁奔放的水果香,柔和綿長的蜜桃莓果酸卻不刺激,風味甜度高酸度明亮且細膩','1','5'),
('藍湖 黃金曼特寧(半磅)','390','產地:哥倫比亞<br>

處理法:日曬<br>

風味:黑松露乾香氣、奶油、桃子、巧克力、牛奶仙草蜜<br>

極品莊園咖啡的經典熱銷款，具有焦糖經典風味，同時能感受到榛果、堅果、肉桂與柔酸味譜，彷彿嚐一口戀愛的滋味，屬於滑順微酸的咖啡。','1','2'),
('伊莎米 精選招牌特調(半磅)','500','產地:肯亞<br>

處理法:日曬<br>

風味:黑巧克力/榛果<br>

中南美洲咖啡的整體風味以平衡而著稱，咖啡風味也非常豐富。普遍使用濕法處理生豆也是中南美洲咖啡的特色之一，豆型

相較於非洲咖啡大而更加均勻，好的加工過程也使得瑕疵率較其他產區也更低。','1','3'),
('瓜地馬拉花神(半磅)','400','產地:瓜地馬拉<br>

處理法:日曬<br>

風味:堅果/核果/焦糖/巧克力<br>

日曬耶加雪菲具有濃郁奔放的水果香,柔和綿長的蜜桃莓果酸卻不刺激,風味甜度高酸度明亮且細膩','1','5'),
('費洛索莊園(半磅)','390','產地:巴西<br>

處理法:日曬<br>

風味:莓果/蜜桃<br>

日曬耶加雪菲具有濃郁奔放的水果香,柔和綿長的蜜桃莓果酸卻不刺激,風味甜度高酸度明亮且細膩','1','1'),
('西達摩桃可可(半磅)','490','產地:衣索比亞<br>

處理法:日曬<br>

風味:莓果/桃子/佛手柑/橘皮/花香/蜂蜜<br>

一入口即可感受到桃子、草莓與橘汁的酸甜風味，隨後浮現橙花、佛手柑、白葡萄與紅茶，結尾是優雅花香與桃子餘韻，果汁般的甜美風味相當迷人','1','4');

-- 商品照片
CREATE TABLE `product_photos`(
  `id` INT  PRIMARY KEY AUTO_INCREMENT,
  `fk_product_id` INT NOT NULL,
  `url` VARCHAR(225) NOT NULL,
  foreign KEY (fk_product_id) references products(id)
);
INSERT INTO `product_photos`( `fk_product_id`,`url`)
VALUES
('1','/img/img/coffee_bean.jpeg'),
('2','/img/img/dog1'),
('3','/img/img/dog2'),
('4','/img/img/dog3'),
('5','/img/img/dog4'),
('6','/img/img/dog5'),
('7','/img/img/dog6'),
('8','/img/img/dog7'),
('9','/img/img/dog8');

-- 商品狀態
CREATE TABLE `order_condition`(
`id` INT PRIMARY KEY AUTO_INCREMENT,
`conditon` VARCHAR(20) NOT NULL
);
INSERT INTO `order_condition`(`conditon`)
VALUES
('未出貨'),
('已出貨'),
('完成訂單'),
('取消出貨');

-- 商品訂單
CREATE TABLE `orders`(
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `fk_user_id` INT NOT NULL,
  `pay` boolean NOT NULL,
  `shipment` boolean NOT NULL,
  `fk_condition_id`  INT NOT NULL,
  `CREATEd_at` TIMESTAMP DEFAULT NOW(),
  foreign KEY (fk_user_id) references users(id),
  foreign KEY (fk_condition_id) references order_condition(id)
);
INSERT INTO `orders`( `fk_user_id`,`pay`,`shipment`,`fk_condition_id`)
VALUES
('1','1','1','2'),
('2','2','2','1'),
('3','2','1','4'),
('4','1','2','2'),
('5','1','1','1'),
('6','1','2','3'),
('7','2','1','4'),
('8','1','2','2'),
('9','1','1','3'),
('10','1','2','2');

-- 商品訂單_詳細
CREATE TABLE `order_detail`(
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `fk_order_id` INT NOT NULL,
  `fk_product_id` INT NOT NULL,
  `qty` INT NOT NULL,
  foreign KEY (fk_order_id) references orders(id),
  foreign KEY (fk_product_id) references products(id)
);
INSERT INTO `order_detail`(`fk_order_id`,`fk_product_id`,`qty`)
VALUES('1','1','1'),
('1','1','1'),
('1','2','2'),
('1','4','1'),
('1','6','3'),
('1','7','1'),
('1','9','2'),
('1','10','1');



--------------------------------------------------------------------------------------------------------------------------------
-- 店家服務圖示
CREATE TABLE `store_serve_icon`(
  `id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  `serve_name` VARCHAR(40) NOT NULL,
  `icon` VARCHAR(100) NOT NULL
);
INSERT INTO `store_serve_icon`( `serve_name`, `serve_EN_name`, `icon`)
VALUES
('無障礙廁所', '<i class="fa-solid fa-wheelchair"></i>'),
('無線網路', '<i class="fa-solid fa-wifi"></i>'),
('寵物友善', '<i class="fa-solid fa-paw"></i>'),
('哺乳室', '<i class="fa-solid fa-baby"></i>');

-- 店家門市
CREATE TABLE `store`(
  `id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  `store_name` VARCHAR(20) NOT NULL UNIQUE, -- 不重複
  `city` VARCHAR(20) NOT NULL,
  `address` VARCHAR(50) NOT NULL,
  `phone` VARCHAR(20) NOT NULL UNIQUE, -- 不重複
  `photo` VARCHAR(200),
  `CREATEd_at` TIMESTAMP DEFAULT NOW()
);
INSERT INTO `store`(`store_name`, `city`, `address`, `phone`)
VALUES
('新店店', '新北市', '新店區中央路159號4F', '02-412-8869'),
('前金店', '高雄市', '前金區中正四路233號', '07-215-3233'),
('中正店', '高雄市', '新興區中正二路162號', '07-225-0973'),
('七賢店', '高雄市', '新興區七賢一路293號', '07-236-3743'),
('廣林店', '高雄市', '苓雅區廣州一街149-1號', '07-227-1360'),
('大順店', '高雄市', '三民區民族一路427號1F', '07-395-3647'),
('楠梓店', '高雄市', '楠梓區楠梓新路225號', '07-352-6213'),
('藍昌店', '高雄市', '楠梓區藍昌路480號', '07-352-6222'),
('府榮店', '台南市', '東區長榮路一段181號', '06-200-4907'),
('長榮店', '台南市', '東區長榮路三段139號', '06-200-5550'),
('永康店', '台南市', '永康區中華路157號', '06-311-3148'),
('湖美店', '台南市', '中西區中華西路二段865號', '06-358-1011'),
('垂楊店', '嘉義市', '東區垂楊路537號1樓', '05-283-2501');

-- 店家營業時間
CREATE TABLE `store_time`(
  `id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  `fk_store_id` INT UNSIGNED,
  `dow` VARCHAR(20) NOT NULL,
  `status` TINYINT NOT NULL,
  `status_name` VARCHAR(20) NOT NULL,
  `start_time` TIME, -- hh:mm:ss
  `end_time` TIME, -- hh:mm:ss
  FOREIGN KEY(fk_store_id) REFERENCES store(id)
);
INSERT INTO `store_time`(`fk_store_id`, `dow`, `status`, `status_name`, `start_time`, `end_time`)
VALUES
('1', '星期一', '0', '休息', '', ''),
('1', '星期二', '1', '營業', '080000', '220000'),
('1', '星期三', '1', '營業', '080000', '220000'),
('1', '星期四', '1', '營業', '080000', '220000'),
('1', '星期五', '1', '營業', '080000', '220000'),
('1', '星期六', '1', '營業', '080000', '220000'),
('1', '星期日', '1', '營業', '080000', '220000'),
('2', '星期一', '0', '休息', '', ''),
('2', '星期二', '1', '營業', '080000', '220000'),
('2', '星期三', '1', '營業', '080000', '220000'),
('2', '星期四', '1', '營業', '080000', '220000'),
('2', '星期五', '0', '休息', '', ''),
('2', '星期六', '1', '營業', '080000', '220000'),
('2', '星期日', '1', '營業', '080000', '220000'),
('3', '星期一', '1', '營業', '080000', '220000'),
('3', '星期二', '1', '營業', '080000', '220000'),
('3', '星期三', '1', '營業', '080000', '220000'),
('3', '星期四', '1', '營業', '080000', '220000'),
('3', '星期五', '1', '營業', '080000', '220000'),
('3', '星期六', '0', '休息', '', ''),
('3', '星期日', '0', '休息', '', ''),
('4', '星期一', '0', '休息', '', ''),
('4', '星期二', '1', '營業', '080000', '220000'),
('4', '星期三', '1', '營業', '080000', '220000'),
('4', '星期四', '1', '營業', '080000', '220000'),
('4', '星期五', '1', '營業', '080000', '220000'),
('4', '星期六', '1', '營業', '080000', '220000'),
('4', '星期日', '1', '營業', '080000', '220000'),
('5', '星期一', '0', '休息', '', ''),
('5', '星期二', '0', '休息', '', ''),
('5', '星期三', '1', '營業', '080000', '220000'),
('5', '星期四', '1', '營業', '080000', '220000'),
('5', '星期五', '1', '營業', '080000', '220000'),
('5', '星期六', '1', '營業', '080000', '220000'),
('5', '星期日', '1', '營業', '080000', '220000'),
('6', '星期一', '0', '休息', '', ''),
('6', '星期二', '0', '休息', '', ''),
('6', '星期三', '1', '營業', '080000', '220000'),
('6', '星期四', '1', '營業', '080000', '220000'),
('6', '星期五', '1', '營業', '080000', '220000'),
('6', '星期六', '1', '營業', '080000', '220000'),
('6', '星期日', '1', '營業', '080000', '220000'),
('7', '星期一', '0', '休息', '', ''),
('7', '星期二', '0', '休息', '', ''),
('7', '星期三', '1', '營業', '080000', '220000'),
('7', '星期四', '1', '營業', '080000', '220000'),
('7', '星期五', '1', '營業', '080000', '220000'),
('7', '星期六', '1', '營業', '080000', '220000'),
('7', '星期日', '1', '營業', '080000', '220000'),
('8', '星期一', '0', '休息', '', ''),
('8', '星期二', '0', '休息', '', ''),
('8', '星期三', '1', '營業', '080000', '220000'),
('8', '星期四', '1', '營業', '080000', '220000'),
('8', '星期五', '1', '營業', '080000', '220000'),
('8', '星期六', '1', '營業', '080000', '220000'),
('8', '星期日', '1', '營業', '080000', '220000'),
('9', '星期一', '0', '休息', '', ''),
('9', '星期二', '0', '休息', '', ''),
('9', '星期三', '1', '營業', '080000', '220000'),
('9', '星期四', '1', '營業', '080000', '220000'),
('9', '星期五', '1', '營業', '080000', '220000'),
('9', '星期六', '1', '營業', '080000', '220000'),
('9', '星期日', '1', '營業', '080000', '220000'),
('10', '星期一', '0', '休息', '', ''),
('10', '星期二', '0', '休息', '', ''),
('10', '星期三', '1', '營業', '080000', '220000'),
('10', '星期四', '1', '營業', '080000', '220000'),
('10', '星期五', '1', '營業', '080000', '220000'),
('10', '星期六', '1', '營業', '080000', '220000'),
('10', '星期日', '1', '營業', '080000', '220000'),
('11', '星期一', '0', '休息', '', ''),
('11', '星期二', '0', '休息', '', ''),
('11', '星期三', '1', '營業', '080000', '220000'),
('11', '星期四', '1', '營業', '080000', '220000'),
('11', '星期五', '1', '營業', '080000', '220000'),
('11', '星期六', '1', '營業', '080000', '220000'),
('11', '星期日', '1', '營業', '080000', '220000'),
('12', '星期一', '0', '休息', '', ''),
('12', '星期二', '0', '休息', '', ''),
('12', '星期三', '1', '營業', '080000', '220000'),
('12', '星期四', '1', '營業', '080000', '220000'),
('12', '星期五', '1', '營業', '080000', '220000'),
('12', '星期六', '1', '營業', '080000', '220000'),
('12', '星期日', '1', '營業', '080000', '220000'),
('13', '星期一', '0', '休息', '', ''),
('13', '星期二', '0', '休息', '', ''),
('13', '星期三', '1', '營業', '080000', '220000'),
('13', '星期四', '1', '營業', '080000', '220000'),
('13', '星期五', '1', '營業', '080000', '220000'),
('13', '星期六', '1', '營業', '080000', '220000'),
('13', '星期日', '1', '營業', '080000', '220000');


-- 店家服務
CREATE TABLE `store_serve`(
  `id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  `fk_store_id` INT UNSIGNED,
  `fk_serve_id` INT UNSIGNED,
  `serve_status` boolean NOT NULL,
  FOREIGN KEY(fk_store_id) REFERENCES store(id),
  FOREIGN KEY(fk_serve_id) REFERENCES store_serve_icon(id)
);
INSERT INTO `store_serve`(`fk_store_id`, `fk_serve_id`, `serve_status`)
VALUES
('1', '1', '1'),('1', '2', '1'),('1', '3', '0'),('1', '4', '0'),
('2', '1', '1'),('2', '2', '1'),('2', '3', '0'),('2', '4', '1'),
('3', '1', '0'),('3', '2', '0'),('3', '3', '0'),('3', '4', '1'),
('4', '1', '1'),('4', '2', '1'),('4', '3', '1'),('4', '4', '1'),
('5', '1', '1'),('5', '2', '1'),('5', '3', '1'),('5', '4', '1'),
('6', '1', '1'),('6', '2', '1'),('6', '3', '1'),('6', '4', '1'),
('7', '1', '1'),('7', '2', '1'),('7', '3', '1'),('7', '4', '1'),
('8', '1', '1'),('8', '2', '1'),('8', '3', '1'),('8', '4', '1'),
('9', '1', '1'),('9', '2', '1'),('9', '3', '1'),('9', '4', '1'),
('10', '1', '1'),('10', '2', '1'),('10', '3', '1'),('10', '4', '1'),
('11', '1', '1'),('11', '2', '1'),('11', '3', '1'),('11', '4', '1'),
('12', '1', '1'),('12', '2', '1'),('12', '3', '1'),('12', '4', '1'),
('13', '1', '1'),('13', '2', '1'),('13', '3', '1'),('13', '4', '1');



--------------------------------------------------------------------------------------------------------------------------------
-- 菜單
CREATE TABLE `drink_menu`(
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `drink_name` VARCHAR(100) NOT NULL,
  `url` VARCHAR(200) NOT NULL,
  `price` INT NOT NULL,
  `content` VARCHAR(200) NOT NULL,
  `status` boolean NULL
);
INSERT INTO drink_menu(drink_name, url, price, content, status)
VALUES
('美式咖啡 Caffè Americano','./img/美式咖啡.jpg','110','以歐洲方式調製，結合經典濃縮咖啡及熱水，帶來濃郁豐富的咖啡滋味。','1'),
('冰美式咖啡 Iced Caffè Americano','./img/冰美式咖啡.jpg','110','以歐洲方式調製，帶來濃郁豐富的咖啡滋味。','0'),
('那堤','./img/那堤.jpg','100','濃郁醇厚的濃縮咖啡，搭配新鮮蒸煮的優質鮮奶，覆上綿密細緻的奶泡','1'),
('濃縮咖啡 Espresso','./img/濃縮咖啡.jpg','80','濃郁豐厚的濃縮咖啡是咖啡的靈魂，它醇厚的口感、綿長香氣及焦糖般的甜味，豐富而令人難忘。','1'),
('焦糖瑪奇朵 Caramel Macchiato','./img/焦糖瑪奇朵.jpg','155','融合新鮮蒸奶及香草風味糖漿後，倒入濃縮咖啡並在奶泡上覆以香甜焦糖醬，呈現多層次風味，是深受歡迎的飲料。','1'),
('冰焦糖瑪奇朵 Iced Caramel Macchiato','./img/冰焦糖瑪奇朵.jpg','100','加糖加奶精','1'),
('可可綿雲瑪奇朵 Cocoa Cloud Macchiato','./img/可可綿雲瑪奇朵.jpg','155','輕柔的雲朵泡沫結合經典濃縮咖啡與濃醇的巧克力，尾韻帶有些微香草甜美，豐富的層次帶給您多重的味蕾享受。','0'),
('冰可可綿雲瑪奇朵 Iced Cocoa Cloud Macchiato','./img/冰可可綿雲瑪奇朵.jpg','155','輕柔的雲朵泡沫結合經典濃縮咖啡與濃醇的巧克力，尾韻帶有些微香草甜美，豐富的層次帶給您多重的味蕾享受。','1'),
('可可瑪奇朵 Cocoa Macchiato','./img/可可瑪奇朵.jpg','155','第一口綿密香醇的奶泡混合著香甜可可的糖醬滋味，搭配經典義式濃縮咖啡，層次堆疊滿足味蕾的享受。感受猶如奶油般柔滑口感及細緻可可香氣。','0'),
('冰可可瑪奇朵 Iced Cocoa Macchiato','./img/冰可可瑪奇朵.jpg','155','第一口綿密香醇的奶泡混合著香甜可可的糖醬滋味，搭配經典義式濃縮咖啡，層次堆疊滿足味蕾的享受。感受猶如奶油般柔滑口感及細緻可可香氣。','1'),
('雲朵冰搖濃縮咖啡 Cold Foam Iced Espresso','./img/雲朵冰搖濃縮咖啡.jpg','145','創新的現煮義式飲品!滿足咖啡饕客的咖啡味蕾。綿滑香柔的雲朵(冰奶泡)是由低脂牛奶打製而成，倒入杯中後再添加手工搖製，濃郁香醇的冰搖濃縮咖啡，在冰鎮清爽的滋味中，品嘗兩者交織出的驚喜風味！','0'),
('摩卡 Caffè Mocha','./img/摩卡.jpg','150','由濃縮咖啡、摩卡醬及新鮮蒸奶調製，覆上輕盈柔細的鮮奶油，帶來香濃的巧克力及咖啡風味。','1'),
('冰摩卡 Iced Caffè Mocha','./img/冰摩卡.jpg','150','由濃縮咖啡、摩卡醬及新鮮蒸奶調製，覆上輕盈柔細的鮮奶油，帶來香濃的巧克力及咖啡風味。','1'),
('卡布奇諾 Cappuccino','./img/卡布奇諾.jpg','135','融合濃縮咖啡及現蒸牛奶，加上豐厚細緻的奶泡，呈現醇厚咖啡風味。','1'),
('特選馥郁那堤 Espresso Choice Extra Shot Latte','./img/特選馥郁那堤.jpg','160','精心為您挑選來自不同產區的濃縮咖啡，並選擇使用較多份的濃縮咖啡增加濃醇度，搭配牛奶凸顯咖啡甜感，帶給您多元的牛奶咖啡風味。','1'),
('冰特選馥郁那堤 Espresso Choice Extra Shot Iced Latte','./img/冰特選馥郁那堤.jpg','160','精心為您挑選來自不同產區的濃縮咖啡，並選擇使用較多份的濃縮咖啡增加濃醇度，搭配牛奶凸顯咖啡甜感，帶給您多元的牛奶咖啡風味。','0'),
('馥列白 Flat White','./img/馥列白.jpg','150','此款咖啡源由自與亞洲相鄰，精品咖啡文化紮實的澳洲，在濃縮咖啡與牛奶的比例上，選擇使用較多份的ristretto shots 短濃縮增加咖啡濃醇度的同時並凸顯咖啡甜感，由漂亮的圓點結束，完成一杯風味較濃郁且平衡的牛奶咖啡。','1'),
('冰馥列白 Iced Flat White','./img/冰馥列白.jpg','150','此款咖啡源由自與亞洲相鄰，精品咖啡文化紮實的澳洲，在濃縮咖啡與牛奶的比例上，選擇使用較多份的ristretto shots 短濃縮增加咖啡濃醇度的同時並凸顯咖啡甜感，由漂亮的圓點結束，完成一杯風味較濃郁且平衡的牛奶咖啡。','0');

-- 訂餐管理
CREATE TABLE `drink_order`(
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `fk_user_id` INT NOT NULL,
  `pay` VARCHAR(20) NOT NULL,
  `fk_store_id` INT UNSIGNED NOT NULL,
  `status` TINYINT NOT NULL,
   `CREATEd_at` TIMESTAMP DEFAULT NOW(),
  FOREIGN KEY(fk_user_id) REFERENCES users(id),
  FOREIGN KEY(fk_store_id) REFERENCES store(id)
);
INSERT INTO drink_order(fk_user_id, pay, fk_store_id, status)
VALUES
('1','信用卡','1','1'),
('1','現金','2','1'),
('1','信用卡','3','1'),
('2','APPLE PAY','4','1'),
('2','現金','5','1'),
('6','信用卡','6','1'),
('7','信用卡','7','0'),
('4','信用卡','8','1'),
('4','現金','9','1'),
('10','信用卡','10','1'),
('11','信用卡','11','1'),
('12','信用卡','12','0'),
('13','現金','9','1'),
('14','現金','9','1'),
('15','信用卡','7','1'),
('16','現金','12','0'),
('17','現金','13','1'),
('18','APPLE PAY','1','1'),
('19','信用卡','3','0'),
('20','信用卡','9','1'),
('21','APPLE PAY','6','1'),
('22','信用卡','5','1'),
('23','信用卡','11','0'),
('24','信用卡','13','1');

-- select users.id as users_id,
--  drink_order.id as drink_order_id,
--  pay, store_name, drink_order.`status`,
--  drink_order.CREATEd_at,
--  drink_order_detail.id as drink_order_detail_id,
--  drink_menu.id as drink_menu_id, drink_menu.drink_name,
--  drink_order_detail.qty, drink_menu.price,fk_drink_order_id
-- from drink_order
-- left join  users
-- on users.id = drink_order.fk_user_id
-- left join store
-- on store.id = drink_order.fk_store_id
-- left join drink_order_detail
-- on drink_order.id = drink_order_detail.id
-- left join drink_menu
-- on drink_order_detail.fk_drink_menu_id = drink_menu.id


-- select drink_order_detail.id, drink_menu.id as coffee_id, drink_menu.drink_name, drink_order_detail.qty, drink_menu.price
--  from drink_order_detail
-- join drink_order
-- on drink_order.id = drink_order_detail.id
-- join drink_menu
-- on drink_order_detail.fk_drink_menu_id = drink_menu.id

-- select users.id ,drink_order.id
-- from drink_order
-- join users
-- on  users.id = drink_order.fk_user_id 
-- join(
-- select fk_drink_menu_id, drink_name
-- from drink_menu
-- join drink_order_detail
-- on drink_menu.id = drink_order_detail.fk_drink_menu_id
-- )  as total
-- on drink_order.id = drink_order_detail.fk_drink_order_id





-- 訂餐管理詳細
CREATE TABLE `drink_order_detail`(
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `fk_drink_order_id` INT,
  `fk_drink_menu_id` INT,
  `qty` INT NOT NULL,
  FOREIGN KEY(fk_drink_order_id) REFERENCES drink_order(id),
  FOREIGN KEY(fk_drink_menu_id) REFERENCES drink_menu(id)
);
INSERT INTO drink_order_detail(fk_drink_order_id, fk_drink_menu_id, qty)
VALUES
('1','12','1'),
('1','10','1'),
('2','10','1'),
('2','10','1'),
('3','10','1'),
('4','10','1'),
('4','10','1'),
('4','10','1'),
('5','10','1'),
('5','10','1'),
('6','10','1'),
('6','10','1'),
('7','10','1'),
('8','10','1'),
('9','10','1'),
('10','11','2'),
('10','9','2'),
('11','5','3'),
('11','1','2'),
('12','2','2'),
('13','1','2'),
('14','4','2'),
('14','8','1'),
('15','1','2'),
('16','1','1'),
('17','9','1'),
('18','11','1'),
('19','1','2'),
('20','13','2'),
('21','12','1'),
('22','1','1'),
('23','11','2'),
('24','1','1');



--------------------------------------------------------------------------------------------------------------------------------
-- 首頁橫幅
CREATE TABLE `banner`(
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `photo` varchar(200),
  `title` VARCHAR(50) NOT NULL,
  `status` tinyint NOT NULL
);
INSERT INTO `banner`(`photo`,`title`,`status`)
VALUES
('./image/banner1.jpg','咖啡店室內環境1','0'),
('./image/banner2.jpg','咖啡店室內環境2','0'),
('./image/banner3.jpg','咖啡店室內環境3','0'),
('./image/banner4.jpg','咖啡店室內環境4','0'),
('./image/banner5.jpg','咖啡店室內環境5','0'),
('./image/banner6.jpg','咖啡店室內環境6','0');
-- 首頁消息
CREATE TABLE `news`(
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(50) NOT NULL,
  `contents` VARCHAR(225),
  `CREATEd_at` DATE NOT NULL
);
INSERT INTO `news`(`title`,`contents`,`CREATED_at`)
VALUES
('高雄總店公休公告','高雄總店將於2022年10月10日公休，因店內裝修故閉店一天，敬請見諒。','2022-10-09'),
('台北店公休公告','台北店將於2022年10月10日公休，因店內裝修故閉店一天，敬請見諒。','2022-10-09'),
('桃園店公休公告','桃園店將於2022年10月10日公休，因店內裝修故閉店一天，敬請見諒。','2022-10-09'),
('台中店公休公告','台中店將於2022年10月10日公休，因店內裝修故閉店一天，敬請見諒。','2022-10-09'),
('嘉義店公休公告','嘉義店將於2022年10月10日公休，因店內裝修故閉店一天，敬請見諒。','2022-10-09'),
('台南店公休公告','台南店將於2022年10月10日公休，因店內裝修故閉店一天，敬請見諒。','2022-10-09');
-- 優惠活動
CREATE TABLE `activity`(
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(50) NOT NULL,
  `start_time` DATE NOT NULL,
  `end_time` DATE NOT NULL,
  `discount` VARCHAR(50) NOT NULL,
  `contents` VARCHAR(225),
  `status` tinyint NOT NULL, 
  `CREATEd_at` DATE NOT NULL
);
INSERT INTO `activity`(`title`,`start_time`,`end_time`,`discount`,`contents`,`status`,`CREATED_at`)
VALUES
('八五折活動','2021-12-25','2021-12-31','15OFF','為了歡慶新年，從12月25日至12月31日推出黑咖啡系列指定組合優惠價，皆可使用「八五折優惠」,超佛價格一起團購起來！','0','2021-12-24'),
('八折活動','2022-01-25','2022-01-31','20OFF','為了歡慶新年，從1月25日至1月31日推出黑咖啡系列指定組合優惠價，皆可使用「八折優惠」,超佛價格一起團購起來！','0','2022-1-24'),
('五折活動','2022-02-25','2022-02-28','50OFF','為了歡慶新年，從2月25日至2月31日推出黑咖啡系列指定組合優惠價，皆可使用「五折優惠」,超佛價格一起團購起來！','0','2022-2-24'),
('七五折活動','2022-03-25','2022-03-31','25OFF','為了歡慶新年，從3月25日至3月31日推出黑咖啡系列指定組合優惠價，皆可使用「七五折優惠」,超佛價格一起團購起來！','0','2022-3-24'),
('八八折活動','2022-04-25','2022-04-30','12OFF','為了歡慶新年，從4月25日至4月31日推出黑咖啡系列指定組合優惠價，皆可使用「八八折優惠」，超佛價格一起團購起來！','0','2022-4-24'),
('七折活動','2022-05-25','2022-05-31','30OFF','為了歡慶新年，從5月25日至5月31日推出黑咖啡系列指定組合優惠價，皆可使用「七折優惠」，超佛價格一起團購起來！','0','2022-5-24'),
('九折活動','2022-06-25','2022-06-30','10OFF','為了歡慶新年，從6月25日至6月31日推出黑咖啡系列指定組合優惠價，皆可使用「九折優惠」，超佛價格一起團購起來！','0','2022-6-24');



--------------------------------------------------------------------------------------------------------------------------------
-- 標籤
CREATE TABLE `tags`(
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `tag_name` VARCHAR(20) NOT NULL
);
-- 文章類別
CREATE TABLE `blog_types`(
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `types_name` VARCHAR(20) NOT NULL
);
-- 文章
CREATE TABLE `blogs`(
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `fk_type_id` INT NOT NULL,
  `title` VARCHAR(100) NOT NULL,
  `content` VARCHAR(1000) NOT NULL,
  `fk_tag_id` INT NOT NULL,
  `CREATEd_at` TIMESTAMP DEFAULT NOW(),
  FOREIGN KEY(`fk_type_id`) REFERENCES blog_types(id),
  FOREIGN KEY(`fk_tag_id`) REFERENCES tags(id)
);
-- 文章外來連結
CREATE TABLE `blog_url`(
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `fk_blog_id` INT NOT NULL,
  `url` VARCHAR(200) NOT NULL,
  FOREIGN KEY(fk_blog_id) REFERENCES blogs(id)
);
-- 文章照片
CREATE TABLE `blog_photos`(
  `id` INT AUTO_INCREMENT PRIMARY KEY, 
  `fk_blog_id` INT NOT NULL,
  `url` VARCHAR(200) NOT NULL,
  `photo_alt` VARCHAR(20),
  FOREIGN KEY(fk_blog_id) REFERENCES blogs(id)
);
show tables;
