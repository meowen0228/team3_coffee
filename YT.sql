
use team3;
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

CREATE TABLE `products`(
`id` INT  PRIMARY KEY AUTO_INCREMENT,
`p_name` VARCHAR(20) NOT NULL,
`price` INT NOT NULL,
`content` VARCHAR(1000) NOT NULL,
`status` boolean NOT NULL,
`fk_product_types` INT(20) NOT NULL,
`fk_product_photos_id`  INT NOT NULL,
foreign KEY (fk_product_types) references product_types(id),
foreign KEY (fk_product_types) references product_types(id)
);
select*from products;
INSERT INTO `products`( `p_name`, `price`, `content`,`status`,`fk_product_types`,`fk_product_photos_id`)
VALUES
('肯亞AA TOP(半磅)','499','產地:非洲 <br>

處理法:水洗<br>

風味:黑梅/李子/葡萄<br>

AA TOP最高等級的肯亞咖啡豆其濃郁的黑梅香氣,口感豐富且尾韻悠長,轉化為肯亞特有的甜,一入口紅酒般的餘韻在口中揮之不去','1','3','1'),
('耶加雪菲(半磅)','380','產地:衣索比亞<br>

處理法:水洗<br>

風味:核果/可可/花香味/柑橘<br>

花神具有非常愉悅優雅花香主體的風味,酸性柔和且以巧克力般的風味尾韻作結,整體口感乾淨且明亮','1','4','3'),
('瓜地馬拉花神(半磅)','400','產地:瓜地馬拉<br>

處理法:日曬<br>

風味:莓果/蜜桃<br>

日曬耶加雪菲具有濃郁奔放的水果香,柔和綿長的蜜桃莓果酸卻不刺激,風味甜度高酸度明亮且細膩','1','5','4'),
('模範生(半磅)','420','產地:哥倫比亞<br>

處理法:水洗<br>


風味:柑橘/可可/奶油<br>


具有豐富的芳香水果酸氣迷人,且帶有柑橘的明亮甜感,巧克力的餘韻油脂感特佳','1','2','6'),
('曼巴(半磅)','300','產地:印尼/巴西<br>

處理法:半水洗<br>

風味:可可韻/奶油/草本香韻<br>

口感厚實甘醇的曼特寧搭配核果香氣絕佳的巴西咖啡豆,奶油的質感與明顯的可可味搭配後清雅的回甘口感一直會讓人回味無窮','1','1','7'),
('黃金曼巴(半磅)','380','產地:印尼/巴西<br>
處理法:半水洗<br>

風味:可可韻味/草本香韻/奶油<br>

口感厚實甘醇的頂級黃金曼特寧搭配核果香氣絕佳的巴西咖啡豆,完美平衡呈現奶油的質感與明顯的可可味','1','1','8'),
('瓜地馬拉花神(半磅)','400','產地:瓜地馬拉<br>

處理法:日曬<br>

風味:莓果/蜜桃<br>

日曬耶加雪菲具有濃郁奔放的水果香,柔和綿長的蜜桃莓果酸卻不刺激,風味甜度高酸度明亮且細膩','1','5','2'),
('藍湖 黃金曼特寧(半磅)','390','產地:哥倫比亞<br>

處理法:日曬<br>

風味:黑松露乾香氣、奶油、桃子、巧克力、牛奶仙草蜜<br>

極品莊園咖啡的經典熱銷款，具有焦糖經典風味，同時能感受到榛果、堅果、肉桂與柔酸味譜，彷彿嚐一口戀愛的滋味，屬於滑順微酸的咖啡。','1','2','9'),
('伊莎米 精選招牌特調(半磅)','500','產地:肯亞<br>

處理法:日曬<br>

風味:黑巧克力/榛果<br>

中南美洲咖啡的整體風味以平衡而著稱，咖啡風味也非常豐富。普遍使用濕法處理生豆也是中南美洲咖啡的特色之一，豆型

相較於非洲咖啡大而更加均勻，好的加工過程也使得瑕疵率較其他產區也更低。','1','3','8'),
('瓜地馬拉花神(半磅)','400','產地:瓜地馬拉<br>

處理法:日曬<br>

風味:堅果/核果/焦糖/巧克力<br>

日曬耶加雪菲具有濃郁奔放的水果香,柔和綿長的蜜桃莓果酸卻不刺激,風味甜度高酸度明亮且細膩','1','5','3'),
('費洛索莊園(半磅)','390','產地:巴西<br>

處理法:日曬<br>

風味:莓果/蜜桃<br>

日曬耶加雪菲具有濃郁奔放的水果香,柔和綿長的蜜桃莓果酸卻不刺激,風味甜度高酸度明亮且細膩','1','1','2'),
('西達摩桃可可(半磅)','490','產地:衣索比亞<br>

處理法:日曬<br>

風味:莓果/桃子/佛手柑/橘皮/花香/蜂蜜<br>

一入口即可感受到桃子、草莓與橘汁的酸甜風味，隨後浮現橙花、佛手柑、白葡萄與紅茶，結尾是優雅花香與桃子餘韻，果汁般的甜美風味相當迷人','1','6','1');



CREATE TABLE `product_photos`(
  `id` INT  PRIMARY KEY AUTO_INCREMENT,
  `fk_product_id` INT NOT NULL,
  `url` VARCHAR(225) NOT NULL,
  foreign KEY (fk_product_id) references products(id)
);
INSERT INTO `product_photos`( `fk_product_id`,`url`)
VALUES
('9','/img/shop/coffee_bean.jpeg'),
('2','/img/shop/dog8.jpg'),
('3','/img/shop/dog7.jpg'),
('4','/img/shop/dog6.jpg'),
('5','/img/shop/dog5.jpg'),
('6','/img/shop/dog4.jpg'),
('7','/img/shop/dog3.jpg'),
('8','/img/shop/dog2.jpg'),
('1','/img/shop/dog1.jpg');

show warnings;

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
('2','0','0','1'),
('3','0','1','4'),
('4','0','0','2'),
('5','1','1','1'),
('6','1','0','3'),
('7','0','1','4'),
('8','1','0','2'),
('9','1','1','3'),
('10','0','0','2');

-- 商品訂單_詳細
CREATE TABLE `order_detail`(
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `fk_order_id` INT NOT NULL,
  `fk_product_id` INT NOT NULL,
  `fk_users_id` INT NOT NULL,
  `fk_condition_id`  INT NOT NULL,
  `qty` INT NOT NULL,
  foreign KEY (fk_order_id) references orders(id),
  foreign KEY (fk_product_id) references products(id),
  foreign KEY (fk_condition_id) references order_condition(id),
  foreign KEY (fk_users_id) references users(id)
);
INSERT INTO `order_detail`(`fk_order_id`,`fk_product_id`,`fk_users_id`,`fk_condition_id`,`qty`)
VALUES('3','1','1','1','1'),
('10','1','2','2','1'),
('4','2','3','3','2'),
('5','4','5','3','1'),
('6','6','6','4','3'),
('7','7','8','2','1'),
('9','9','14','1','2'),
('8','10','18','3','1');
show warnings;

select*
from order_detail
join users on users.id = order_detail.fk_users_id
join order_condition on order_condition.id = order_detail.fk_condition_id
join products on products.id = order_detail.fk_product_id
join orders on orders.id = order_detail.fk_order_id;

SELECT *
from products
join product_types on product_types.id = products.fk_product_types
join product_photos on product_photos.id = fk_product_photos_id;

SELECT id AS od_id
FROM order_detail;

