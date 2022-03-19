use house_coffee;

-- 使用者
CREATE TABLE `users`(
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `user_name` VARCHAR(50) NOT NULL,
  `user_password` VARCHAR(20) NOT NULL,
  `user_birth` date NOT NULL,
  `user_mail` VARCHAR(255) NOT NULL UNIQUE,
  `user_mail2` VARCHAR(255) NOT NULL UNIQUE,
  `user_address` VARCHAR(100) NOT NULL,
  `user_phone` VARCHAR(10) NOT NULL UNIQUE,
  `user_nick` VARCHAR(20),
  `CREATEd_at` TIMESTAMP DEFAULT NOW()
);
-- 使用者地址
CREATE TABLE `user_address`(
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `fk_user_id` INT NOT NULL,
  address VARCHAR(100) ,
  foreign KEY (`fk_user_id`) references users(id),
);
--會員提問
CREATE TABLE `user_ask`(
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `fk_user_id` INT NOT NULL,
  `ask` VARCHAR(200) NOT NULL,
  `ans` VARCHAR(200)
);

----------------------------------------------------------------
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
`status` boolean NOT NULL,
`fk_product_types` INT(20) NOT NULL,
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

一入口即可感受到桃子、草莓與橘汁的酸甜風味，隨後浮現橙花、佛手柑、白葡萄與紅茶，結尾是優雅花香與桃子餘韻，果汁般的甜美風味相當迷人','1','6');


--商品照片
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

--商品狀態
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
  foreign KEY (fk_user_id) references users(id)
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

----------------------------------------------------------------
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
-- 店家營業時間
CREATE TABLE `store_time`(
  `id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  `fk_store_id` INT UNSIGNED,
  `dow` VARCHAR(20) NOT NULL,
  `status` enum('營業', '休息') NOT NULL,
  `star_time` TIME default '08:00:00', -- hh:mm:ss
  `end_time` TIME default '22:00:00', -- hh:mm:ss
  FOREIGN KEY(fk_store_id) REFERENCES store(id)
);
-- 店家服務圖示
CREATE TABLE `store_serve_icon`(
  `id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  `serve_name` VARCHAR(40) NOT NULL,
  `serve_EN_name` VARCHAR(40) NOT NULL,
  `icon` VARCHAR(100) NOT NULL
);
-- 店家服務
CREATE TABLE `store_serve`(
  `id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  `fk_store_id` INT UNSIGNED,
  `fk_serve_id` INT UNSIGNED,
  `serve_status` boolean NOT NULL,
  FOREIGN KEY(fk_store_id) REFERENCES store(id),
  FOREIGN KEY(fk_serve_id) REFERENCES store_serve_icon(id)
);

INSERT INTO `store_serve_icon`( `serve_name`, `serve_EN_name`, `icon`)
VALUES
('無障礙廁所', 'freeman', '<i class="fa-solid fa-wheelchair"></i>'),
('無線網路', 'wifi','<i class="fa-solid fa-wifi"></i>'),
('寵物友善', 'pet','<i class="fa-solid fa-paw"></i>'),
('哺乳室', 'babyroom', '<i class="fa-solid fa-baby"></i>');

INSERT INTO `store`(`store_name`, `city`, `address`, `phone`)
VALUES
('新店店', '新北市', '新店區中央路159號4F', '02-412-8869'),
('前金店', '高雄市', '前金區中正四路233號', '07-215-3233'),
('中正店', '高雄市', '新興區中正二路162號', '07-225-0973');

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

INSERT INTO `store_time`(`fk_store_id`, `dow`, `status`, `star_time`, `end_time`)
VALUES
('1', '星期一', '休息', '', ''),
('1', '星期二', '營業', '080000', '220000'),
('1', '星期三', '營業', '080000', '220000'),
('1', '星期四', '營業', '080000', '220000'),
('1', '星期五', '營業', '080000', '220000'),
('1', '星期六', '營業', '080000', '220000'),
('1', '星期日', '營業', '080000', '220000'),

('2', '星期一', '休息', '', ''),
('2', '星期二', '營業', '080000', '220000'),
('2', '星期三', '營業', '080000', '220000'),
('2', '星期四', '營業', '080000', '220000'),
('2', '星期五', '營業', '080000', '220000'),
('2', '星期六', '營業', '080000', '220000'),
('2', '星期日', '營業', '080000', '220000'),

('3', '星期一', '休息', '', ''),
('3', '星期二', '營業', '080000', '220000'),
('3', '星期三', '營業', '080000', '220000'),
('3', '星期四', '營業', '080000', '220000'),
('3', '星期五', '營業', '080000', '220000'),
('3', '星期六', '營業', '080000', '220000'),
('3', '星期日', '營業', '080000', '220000');

INSERT INTO `store_serve`(`fk_store_id`, `fk_serve_id`, `serve_status`)
VALUES
('1', '1', '1'),
('1', '2', '1'),
('1', '3', '0'),
('1', '4', '0'),

('2', '1', '1'),
('2', '2', '1'),
('2', '3', '0'),
('2', '4', '1'),

('3', '1', '0'),
('3', '2', '0'),
('3', '3', '0'),
('3', '4', '1');
----------------------------------------------------------------


-- 首頁橫幅
CREATE TABLE `banner`(
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `photo` VARCHAR(200) NOT NULL,
  `title` VARCHAR(20) NOT NULL,
  `status` boolen NOT NULL
)
-- 首頁消息
CREATE TABLE `news`(
  `id` INT  AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(50) NOT NULL,
  `contents` VARCHAR(225),
  `CREATEd_at` TIMESTAMP DEFAULT NOW()
);
-- 優惠活動
CREATE TABLE `activity`(
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(50) NOT NULL,
  `star_time` DATETIME NOT NULL,
  `end_time` DATETIME NOT NULL,
  `discount` VARCHAR(10) NOT NULL,
  `contents` VARCHAR(225),
  `status` boolen NOT NULL,
  `CREATEd_at` TIMESTAMP DEFAULT NOW()
);

----------------------------------------------------------------
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
  FOREIGN KEY(fk_blog_id) REFERENCES blogs(id),
);
-- 文章照片
CREATE TABLE `blog_photos`(
  `id` INT AUTO_INCREMENT PRIMARY KEY, 
  `fk_blog_id` INT NOT NULL,
  `url` VARCHAR(200) NOT NULL,
  `photo_alt` VARCHAR(20),
  FOREIGN KEY(fk_blog_id) REFERENCES blogs(id)
);


----------------------------------------------------------------
-- 菜單
CREATE TABLE `drink_menu`(
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `drink_name` VARCHAR(20) NOT NULL,
  `url` VARCHAR(200) NOT NULL,
  `price` INT NOT NULL,
  `content` VARCHAR(200) NOT NULL,
  
  `status` boolen NOT NULL
);
-- 訂餐管理
CREATE TABLE `drink_order`(
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `fk_user_id` ,
  `pay` VARCHAR(20) NOT NULL,
  `fk_store_id` ,
  `status` boolen NOT NULL,
  FOREIGN KEY(fk_user_id) REFERENCES users(id),
  FOREIGN KEY(fk_store_id) REFERENCES store(id)
);
-- 訂餐管理詳細
CREATE TABLE `drink_order_detail`(
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `fk_drink_order_id` INT,
  `fk_drink_menu_id` INT,
  `qty` INT NOT NULL,
  FOREIGN KEY(fk_drink_order_id) REFERENCES drink_order(id),
  FOREIGN KEY(fk_drink_menu_id) REFERENCES drink_menu(id)
);