CREATE database `house_coffee`;
-- drop database`house_coffee`;
use house_coffee;
-- 標籤
CREATE TABLE `tags`(
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `tag_name` VARCHAR(20) NOT NULL
);
INSERT INTO `tags`(`tag_name`)
VALUES
('#咖啡House'),
('#美味咖啡'),
('#名人專欄篇'),
('#大神好帥'),
('#咖啡地圖');


-- 文章類別
CREATE TABLE `blog_types`(
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `types_name` VARCHAR(20) NOT NULL);
  INSERT INTO `blog_types`(`types_name`)
VALUES
('咖啡篇'),
('沖煮篇'),
('咖啡豆篇'),
('名人專欄篇'),
('好物分享篇');
  
  -- 文章
CREATE TABLE `blogs`(
	`id` INT AUTO_INCREMENT PRIMARY KEY,
	`fk_type_id` INT NOT NULL,
	`title` VARCHAR(200) NOT NULL,
	`content` TEXT NOT NULL,
	`fk_tag_id` INT NOT NULL,
	`CREATEd_at` TIMESTAMP DEFAULT NOW(),
  FOREIGN KEY(`fk_type_id`) REFERENCES blog_types(id),
   FOREIGN KEY(`fk_tag_id`) REFERENCES tags(id)
);
INSERT INTO `blogs`(`fk_type_id`,`title`,`content`,`fk_tag_id`)
VALUES
('1','你聽過白咖啡嗎？跟拿鐵、卡布奇諾、瑪奇朵有什麼不同？','屬於義式濃縮咖啡一員的白咖啡，主要是以蒸汽牛奶搭配濃縮咖啡、最後再鋪上一層細緻奶泡而製成的義式花式咖啡，與拿鐵、卡布奇諾、瑪奇朵等牛奶咖啡屬同一家族，雖然主成分皆是以濃縮咖啡與牛奶沖調而成的咖啡飲品，但各款咖啡的調配都有不同的比例，稍有誤差可能就會製成另一款牛奶咖啡。

白咖啡的起源
白咖啡的起源
關於白咖啡的起源眾說紛紜，目前大致可依循的方向分別是緣起於「澳大利亞和紐西蘭」以及「馬來西亞」的白咖啡。馥芮白 Flat White，又稱為白咖啡、小白咖啡、平白咖啡，來自於紐澳一代，有一說是於1985年，由一家雪梨的咖啡館所研發；另一說則是在1989年，威靈頓的一家咖啡館因沖煮出錯誤比例的卡布奇諾奶泡，而藉此創新並為其命名。其實，不論是發跡於澳大利亞或是紐西蘭，這個來自南太平洋的馥芮白 Flat White，都為全球咖啡愛好者開啟了嶄新的味蕾饗宴。

第二個白咖啡的起源則來自馬來西亞，白咖啡 White Coffee，是馬來西亞主要的出口產品，起源於英屬馬來亞時期，會出現白咖啡的原因在於英國統治馬來半島時，常會雇用馬來西亞人作為家中管事，當英國雇主想喝黑咖啡時，管家便會送上沒加奶的純黑咖啡，而若是想來點富含奶香的咖啡，管家則會遞上加了牛奶的白咖啡，也因為有過這一段服務英國雇主的經驗，馬來西亞人不但對於咖啡知識有了更進一步的了解，也學習到豐富的義式咖啡製法。白咖啡的第一代創辦人曹運廷先生，就是運用過去受僱於英國人學習到的咖啡經驗，再結合當時於華人社會最火紅的焦糖黑咖啡，經多次調配測試，終於製成專屬華人口味的白咖啡 White Coffee，隨後並將此發揚光大，也成為馬來西亞最知名的名產之一。

白咖啡、拿鐵、卡布奇諾、瑪奇朵的牛奶和咖啡比例
白咖啡與拿鐵的差別？
▍白咖啡
濃縮咖啡：1～2份
奶泡＋牛奶：共約130ml，由絲滑綿密的細緻奶泡、香濃的蒸汽熱牛奶組成
▍拿鐵
濃縮咖啡：1～2份

奶泡＋牛奶：共約210ml，由絲滑綿密的細緻奶泡、香濃的蒸汽熱牛奶組成

( 推薦閱讀：「精品拿鐵」vs「一般拿鐵」怎麼選？ 最熱門的花式咖啡介紹 )

▍卡布奇諾
濃縮咖啡：1份
奶泡＋牛奶：共約150ml，由飽滿挺立的粗奶泡、香濃的蒸汽熱牛奶組成
▍瑪奇朵
濃縮咖啡：1份
奶泡：共約1～2匙的微量絲滑綿密的細緻奶泡
關於奶泡和牛奶，一般來說會分成最底層的香濃蒸汽熱牛奶、中上層的絲滑綿密細緻奶泡、最頂層的飽滿挺立粗奶泡，其中，白咖啡、拿鐵、卡布奇諾這三種咖啡，是最容易搞混的咖啡款式，三者皆是由濃縮咖啡、奶泡、牛奶所組成，不同之處在於奶泡打發的細緻度、以及調配比例的多寡。

而白咖啡的咖啡豆，多以中輕度低溫烘培至出現焦糖香氣而製成，沖調時再搭配絲滑綿密的細緻奶泡、以及香濃的蒸汽熱牛奶，入口油脂飽滿且富含焦糖甜香，整體滑順回甘、風味輕柔，在世界各地皆擁有一票白咖啡的忠實愛好者，從獨立咖啡店到各大連鎖咖啡廳都能見到其蹤跡，絕對是一款香醇又非常順口的咖啡選擇！', '1'),


('2','手沖咖啡，不同溫度對於咖啡風味的感受有何不同？','因為很重要，所以提及咖啡沖煮，不厭其煩地都會一再被講者、書籍、影片叮嚀，咖啡在沖煮時，最重要的沖煮變因是咖啡粉量、研磨粗細、沖煮時間，以及沖煮水溫。萃取與研磨之間的變化效應，通常緊接在四大沖煮變因之後，坊間針對萃取與研磨開設的課程更是不可計數。

那麼溫度呢？由於水溫會直接影響咖啡的萃取狀況，也會影響飲用者的飲用狀況，所有仰賴水作為介質的嗜好品，無一不重視水質與溫度，今天就讓我們來好好談談適宜沖煮的溫度，以及合適飲用的溫度吧！

手沖咖啡溫度
水溫與萃取率
通常情況下，我們知道沖泡紅茶的時候，適合95度以上的高溫，沖泡烏龍茶的時候，適合88至90度左右的中高溫，而沖泡日本茶的時候，則適合80至85度這樣略低的水溫。可是為什麼呢？與製作過程有關，紅茶的發酵狀態完全且焙火較深，需要較高的水溫刺激茶葉溶出風味物質、增加其萃取率，烏龍茶相較紅茶的發酵狀態淺，需要的水溫略低一些，而日本茶因為多屬蒸製，不若台灣與中國習慣炒焙茶葉，其細嫩的茶苗遇水，即開始釋放風味分子，除了水溫不宜太高、以免破壞芳香分子之外，也不適合如紅茶或烏龍茶般得以一再回沖。

回到咖啡亦然，水作為介質，會溶出咖啡內含的奎寧酸、氨基酸、咖啡因與單寧酸等物質，在不同階段的沖煮過程中，會產生不同反應、溶出不同的風味分子。以感官曲線來看，酸質會在最一開始被萃取出來，接著是甜感，最後是苦韻。

水的溫度越高，萃取物質的速度就會越快，儘管如此，也可能會將負面的味道壓榨出來。義式咖啡剛在台灣萌芽的初期，業內人士追求帶有「虎斑紋」的義式濃縮咖啡，實際上卻是高溫將極細的咖啡粉末迅速焦化，使得蛋白質變性的結果。而越低的水溫，由於無法完整地進行萃取，故而容易產生不同于單寧澀感的負面酸澀，或是猶如未熟穀物的噁心感。

( 推薦閱讀：沖出好咖啡關鍵要素「手沖咖啡萃取原理」介紹 )

因式制宜的水溫控制
不過上述的沖煮溫度討論，也不是一招打天下，雖然適用於義式沖煮、手沖等沖煮方式，不過因應不同的沖煮方式，也有各自不同的溫度選擇。比如延長水與咖啡粉作用時間的冷萃咖啡與冰滴咖啡，由於萃取時間較長，就不適合以高水溫進行萃取，否則會造成咖啡粉在時間與溫度均在高萃取狀況的極端狀態。

以低水溫進行萃取的咖啡，因為不是處在高溫環境，使得部分物質未溶出，避免了許多苦韻與雜味，讓滑順質地成為低水溫咖啡的特性，風味表現上以淡雅的果酸調性與甜感為主，接近水果茶的滋味相當討喜，在大眾市場很受青睞。

但是相同的萃取概念回到義式咖啡則不適用，即使延長萃取時間、調整研磨度也無法補償水溫過低造成物質未釋出的窘境。儘管酸質會是最早被釋出的物質，然後沒有油脂的析出，就無法溶出後段的甜感與苦韻，致使咖啡產生口感不平衡的結果。因此因應不同的沖煮方式，配合參數與萃取概念，挑選正確的水溫，是相當重要的事情。

虹吸咖啡沖煮
適宜的沖煮與恰當的飲用
除了把關沖煮上的水溫控制，提供給飲用者的溫度留意也不能小覷。熱飲溫杯、冰飲冰杯，以防製作好的液體置入盛裝容器時有過大的溫度變化，影響飲用者的飲用感受。

以熱拿鐵為例，萃取義式濃縮咖啡的溫度通常落在92至93度之間，萃取出的60ml液體，接著以蒸氣蒸打牛奶到55至65度，在不過度破壞乳蛋白的情況下、保留牛奶的甜度。兩者融合完成，溫度約莫落在50至55度之間，上層奶泡的溫度通常較底下液體的溫度再來得更低一點，飲用者入口時能感受到綿密口感、牛奶與咖啡交織的平衡感受，不至於燙口。

手沖咖啡一般來說會使用88至92度的水溫，由於沖煮過程中，水溫會不斷下降，將沖煮好的咖啡液體倒入預熱好的杯皿中，飲用者實際啜飲到的溫度約莫在65度左右。多數的咖啡沖煮方式，在沖煮過程中，水溫都是持續下降，唯有虹吸咖啡是採取完全不同的萃取方式，水溫持續攀升，因而虹吸咖啡的出杯溫度，通常會在80度左右，一般搭配大口徑的杯皿協助散熱。' , '2'),


('3','養豆重要嗎？為什麼咖啡烘焙完後，還需要養豆？','養豆，可以說是一個讓咖啡豆盡情呼吸的美妙過程，回溯咖啡的一生，大約可從咖啡果實談起，生命歷程則可分成三個階段，第一階段為生豆孕育期 – 採摘、篩豆、加工處理、包裝、販售生豆；第二階段為咖啡豆黃金期 – 烘豆、養豆、包裝、販售咖啡豆；第三階段為咖啡粉享受期 – 磨粉、沖煮、最後品飲，咖啡的生命週期就如同人類的日常般，隨著吸取空氣中的氧氣、以及釋放出二氧化碳的過程，全力演繹從青春到年邁的精彩時刻，這便是咖啡看似平凡卻讓人回味無窮的一生啊！

有經驗的烘豆者都知道慢工出細活、驚豔的咖啡豆值得等待，在烘焙的過程中，咖啡豆會釋放出大量的二氧化碳氣體，且會有微量的氣體直至烘焙完成後依然留存於咖啡豆中，滯留的時間不等、需隨著等待放置期慢慢流逝，至少約數天到一個月內，才能顯現咖啡原始的風味，口感上也更能品嚐出豐富的層次；若是在咖啡豆熱騰騰烘焙完成後就直接磨粉沖煮，喝到的多是因二氧化碳殘留而產生的酸澀、苦燥、悶雜味，會大大影響品飲者的味蕾感受！

而所謂的「等待放置期」，就是養豆，也有人稱之為排氣、醒豆、熟成，可以說是一個二氧化碳氣體釋放的過程，當烘豆開始時，生豆中所含有的水分和濕氣皆會快速蒸發，而隨著烘豆溫度逐漸升高，水分和高壓會產生化學反應，使油脂漸漸被帶入咖啡豆的細微毛孔中，也讓咖啡本身所富含的物質、香氣、和所釋放出的二氧化碳氣體被包覆留存於細胞之中。

咖啡養豆的方式
養豆的方法
關於養豆，是讓烘焙完成的咖啡豆放置於一個完全密閉、氣體只出不進的環境中，經由數天的時間，讓咖啡豆自然地排放氣體，最終才會獲得一份香醇順口的咖啡。目前最常被使用的養豆環境是單向排氣閥咖啡容器，其次也有人以氧氣填充容器來確保咖啡的新鮮度：

▍單向排氣閥容器
為防止咖啡豆碰到氧氣而造成變質，且又能同時排放出多餘的二氧化碳氣體，使用具有單向排氣閥的咖啡專用容器，就能有效避免氧氣、水氣、雜質等外來物質的進入，以及確保二氧化碳成功的釋放，促使養豆的過程更加順利。

▍氮氣填充容器
此方式主要是杜絕氧氣的干擾，避免咖啡豆腐敗變質，以利延長賞味期限。

咖啡新鮮度與最佳賞味期
咖啡豆的新鮮度以及最佳賞味期
咖啡豆是一個精細度極高的飲品，稍有因素微調就會影響其風味，雖然從生長環境和加工處理法等過程，就已確立其風味和特色的走向，但也確實會因為烘焙程度、養豆過程、沖煮方式等變因，而使得最後所品飲到的風味有所差異，為了讓咖啡豆最終可以順利將其風味和特色發揮出來，故盡可能地層層把關，將變因降至最低，而其中針對養豆所需要的等待放置期，並沒有一個制式的時間，主要還是會根據烘焙程度的不同，以及融合咖啡師過往的經驗，歸納出一個大概的通則：

義式咖啡豆：約需21天
極淺烘焙咖啡豆：約需12-14天
淺烘焙咖啡豆：約需10-12天
中淺烘焙咖啡豆：約需7-9天
中烘焙咖啡豆：約需5-8天
中深烘焙咖啡豆：約需4-6天
深烘焙咖啡豆：約需3天
在養豆的過程中，二氧化碳的存在也代表著咖啡豆新鮮的程度，隨著二氧化碳的釋放，咖啡豆也會根據不同烘焙程度所需養豆的天數來到風味高峰，爾後，最佳風味度也會與二氧化碳的留存一同漸漸減少，基本上大約在烘豆完成後一個月左右的時間，二氧化碳就會完全被排放，此時的咖啡風味也已經完全流逝，故若未沖氮保存咖啡豆，最佳賞味期限通常都不會超過一個月。

一般標榜新鮮烘焙的咖啡豆，皆會標明開始烘焙的日期，而部分沒有明顯標示的咖啡豆，則可根據香氣是否飽滿濃郁；咖啡豆是否過度出油；磨粉沖煮時悶蒸的膨脹度是否足夠等細節，來判斷咖啡豆的新鮮程度，此外，針對已開封但尚未品飲完畢的咖啡豆，通常直接存放於室內陰涼處保鮮即可，冷藏或冷凍容易因水氣和雜味而影響咖啡本身的風味，留存越久的咖啡豆，因二氧化碳的排氣狀況已大幅減少，故能被熱水萃取出的物質也相對增加，當磨粉沖煮時，拿捏也需更加精確小心！' , '3'),

('4','賴昱權 烘出咖啡的千百風情','賴昱權說：「第一次感覺到身為咖啡師的自己如此重要。因為，一杯咖啡可能是某個人的命運，溫暖，或是愛情。」

一個四歲就被診斷出有口吃的小孩，成績總是家族中唯一例外，更是高中時班上唯一落榜的人，自從大學時期到咖啡館當打工仔後，就此墜入令人驚艷的濃醇香。賴昱權笑稱自己是追著咖啡夢的浪漫傻瓜，每天窩在三坪大的烘豆室，四百多度高溫的烘焙鍋爐旁，從早上待到凌晨，烘十幾鍋、逾百公斤的咖啡豆，藉著不停的練習精進自己的烘豆技巧。

偶然間品嘗到一批咖啡豆，發現自己烘不出來如此「奔放的風味」，便辭去了工作，花盡積蓄飛往美國拜師、終獲歐美咖啡認證。


賴昱權 WCE 冠軍
Photo Credit：賴昱權
2014年，代表台灣前往義大利參加WCE世界盃咖啡烘豆大賽，從拿到大會提供的生豆起，參賽者必須憑藉著多年的經驗，先寫出一份生豆分析報告書，當中必須清楚說明拿到的生豆是否有瑕疵、好壞豆的比例、豆子水分飽和度⋯⋯等。

依據此寫出一份烘豆企劃書，從拿到豆子後一路研究分析，直到比賽的第三天才能真正站上烘焙機開始烘豆。三天的比賽是努力十四年的縮影，一身沾滿了咖啡燻香味的賴昱權說：「如果你沒有愛，你無法在這件事情登峰造極，因為你不夠瘋狂，便無法百分之百地投入。」

科技儀器挑戰人類專業
獲獎後的賴昱權依然不改初衷，堅持再忙也要陪客人喝一杯咖啡，他覺得只有透過與客人間的互動，才能真正掌握消費者需求，適時提供最好對味的咖啡給客人。因此在他店內，幾乎人人都有機會可看見金牌冠軍的身影。

「你覺得這杯咖啡濃嗎？」「挺爽口的，應該不算濃吧！」

arrow_forward_ios前往頁面
Powered by GliaStudio
「濃或不濃，不是我們說了算？」賴昱權邊說邊從手提箱中拿出一組精密的儀器，抽取了一些咖啡液體，滴到儀器上偵測的金屬片上。沒多久，顯示器跳出了1.8%的數字。他微皺了一下眉頭「這杯咖啡煮太濃了，我再親自煮一杯」

賴昱權 咖啡師
Photo Credit：賴昱權
這番場景在賴昱權店內常出現，也是他手下咖啡師最害怕的事情，但就因為有一個總是堅持用「科學」的方式，來挑戰大家咖啡功力的老闆，所以也讓每個店員都有能力考到國際咖啡證照。

那麼，你喝過為你特製的咖啡嗎?

賴昱權曾烘製過一款名為「Dear J.」的咖啡，以核果甜度為主軸，後段帶出熟梅果味，微酸卻糅和著甜味。它的誕生緣起於一個男孩向賴昱權「要幸福」的故事，賴昱權說：「因為這個特殊的要求，才讓他知道原來咖啡可以不只是咖啡，第一次感覺到身為咖啡師的自己如此重要。因為，一杯咖啡可能是某個人的命運，溫暖，或是愛情。」


咖啡職人的「一生懸命」

賴昱權與咖啡命定的相遇，打造出了不凡的人生態度。他說：「人可以不完美，但一定要特別。」別人看他是瘋子，因為他全心全意地投入；別人笑他是傻子，因為他堅持不放手；別人說他野心大，但他只是將咖啡化作生命的信仰，往夢想奔近。' , '4'),


('5','濾掛咖啡包推薦！錐形、方形各種類濾掛咖啡包評比','濾掛咖啡包的出現，受到許多上班族的推薦與喜愛，竄紅的主因為現代都市生活型態的步調非常快速。濾掛咖啡包起源於日本 – 山中產業株式會社，以茶包的沖泡概念運用於咖啡，進而發明了濾掛咖啡包，同時並申請專利，但因設計尚未純熟，濾掛咖啡包無法成功乘載咖啡粉與水的重量，故而沒有商業化量產，直到1998年大紀商社成功改良，才藉由行銷推薦給消費者、讓濾掛咖啡包發揚出去，也成為行程滿檔、沒有多餘時間等待者的新選擇，濾掛咖啡包更因此受到非常多人的推薦！

濾掛咖啡包，英文稱為Instant Drip Coffee Bag或是Drip Coffee Bag，有著即刻、迅速、方便之意，因其便利且極快速的特性，在亞洲市場一砲而紅，規模相當可觀！隨著濾掛咖啡包的技術不斷地改良和精進，可藉由添加真空氮氣充填技術，隔絕外界的空氣，維持咖啡的品質和新鮮度，讓濾掛咖啡包邁向可以媲美現磨手沖咖啡的完美口感之路。

市售的濾掛咖啡包，常見使用方形濾掛包呈現，因咖啡粉層分佈較為一致、且非專業手沖咖啡會使用的濾紙形狀，故較無法顯現特殊風味；反觀，由 iDrip 所推出的濾掛咖啡包，不但以錐形濾掛包呈現，且是專業手沖咖啡會使用的濾紙造型，同時更使用數十位世界冠軍咖啡大師所製作出的咖啡風味，並藉由悶蒸、沖煮等手法，完整還原咖啡大師的獨特手法，不用出國就能喝到一杯完美的精品咖啡，自2018年發表以來，受到各界人士的推薦！

iDrip錐形濾掛咖啡包
iDrip – 錐形濾掛咖啡包
| 簡介 |
市面最新型模擬咖啡師所普遍使用的錐形濾杯造型濾紙，除了設計能固定錐形的狀態，同時也因為流速較慢，可以同時利用浸泡以及沖泡的手法，讓咖啡師以均勻水柱沖煮咖啡粉層的手法得以完整保留。

| 特色 |
不織布材質製作
專業手沖濾紙造型
粉層呈現錐形分佈，經過悶蒸、沖煮等過程，即可萃取出一杯完整表現前、中、後段風味調性的精品咖啡
流速較慢，可同時利用浸泡與沖煮的優點
真空氮氣充填技術，完整封存咖啡的新鮮度與完美風味，撕開咖啡包瞬間就能感受到撲鼻香氣！

方形濾掛咖啡包
市售 – 方形濾掛咖啡包
| 簡介 |
市面上最常見到的濾掛咖啡包造型，可於咖啡各大廠牌所推出的濾掛咖啡包產品找到蹤跡。

| 特色 |
不織布材質製作
濾掛包底部幾乎與上方口徑同寬，呈現方型狀
因粉層分佈統一，故較無法將全部的風味都表現出來 (調性較單一)
由於濾掛包形狀的關係，如未能把握好沖煮的時間、水流速度等，較容易因浸泡而過度萃取
此濾掛包非專業手沖咖啡會使用的濾紙款式/形狀
浸泡式濾掛咖啡包
市售 – 浸泡式濾掛咖啡包
| 簡介 |
懶人沖煮法，可以熱水浸泡，亦可使用冷水沖泡後，放入冰箱長時間萃取。

| 特色 |
不織布材質製作
類似茶包的浸泡形式，因無需撕開沖煮，故沒有口徑問題
不論使用冷或熱水，都是直接浸泡，故風味調性較單一
由於濾掛包形狀以及懸掛方式的關係，咖啡包多半浸泡在咖啡杯中，如未能把握好沖煮的時間、水流速度等，較容易因浸泡而過度萃取
此濾掛包非專業手沖咖啡會使用的方式
濾掛咖啡包種類 – 綜合比較表

選擇濾掛咖啡包的好處
無需自行測量咖啡粉量
無需購買整包咖啡豆/粉，隨時可以喝到新鮮且不同產地、品種、風味的咖啡
方便、快速、可隨身攜帶，想喝時即可沖煮
沖煮時間短，幾乎不用等待
如選擇 iDrip濾掛咖啡包，可喝到由數十位咖啡冠軍、大師所製作出的精品咖啡風味
如搭配使用 iDrip Da Vinci S 智能職人手沖咖啡機，便可直接還原冠軍咖啡大師所沖煮出的完美精品咖啡風味
如果，可以近距離喝到一杯世界冠軍咖啡大師從咖啡產地選購、進行烘焙研磨、最後以獨特的手沖手法，沖煮出一杯稀有的世界冠軍咖啡，誰又會想要自己沖煮呢？然而，不可能隨時因為想喝世界冠軍大師的咖啡而每天坐飛機，許多人更是沒有多餘的時間深入研究精品咖啡，因此，直接選用 iDrip 的濾掛咖啡包，變成為最被推薦選用的方式！從選豆、製作、到品管，只有1/100的咖啡豆能成就最原始風味細節，也只有通過精品咖啡協會(SCA) 特選杯測分數80分以上的精品咖啡豆，可以入選 iDrip 濾掛咖啡包的名單，並與專業世界冠軍咖啡大師們合作，協力還原世界冠軍咖啡的完美風味。

不亞於手沖咖啡的濾掛咖啡包，有了世界冠軍咖啡大師的把關、iDrip 的獨家設計、以及各界人士的強力推薦，更讓 iDrip 濾掛咖啡包成為生活新品味，隨時隨地都能擁有一杯完美的精品好咖啡！' ,'5');




-- 文章照片
CREATE TABLE `blog_photos`(
  `id` INT AUTO_INCREMENT PRIMARY KEY, 
  `fk_blog_id` INT NOT NULL,
  `url` TEXT NOT NULL,
  `photo_alt` VARCHAR(20),
  FOREIGN KEY(fk_blog_id) REFERENCES blogs(id)
  );
INSERT INTO`blog_photos`(`fk_blog_id`,`url`,`photo_alt`)
VALUES
('1','./img/1coffee10001.jpg','coffee-photo001'),
('2','./img/2pourover20001.jpg','pourover-photo001'),
('3','./img/3beans30001.jpg','beans-photo001'),
('4','./img/4celebrity40001.jpg','celebrity-photo001'),
('5','./img/5share50001.jpg','share-photo001'),


('1','./img/1coffee10002.jpg','coffee-photo002'),
('2','./img/2pourover20002.jpg','pourover-photo002'),
('3','./img/3beans30002.jpg','beans-photo002'),
('4','./img/4celebrity40002.jpg','celebrity-photo002'),
('5','./img/5share50001.jpg','share-photo002'),




('1','./img/1coffee10003.jpg','coffee-photo003'),
('2','./img/2pourover20003.jpg','pourover-photo003'),
('3','./img/3beans30003.jpg','beans-photo003'),
('4','./img/4celebrity40003.jpg','celebrity-photo003'),
('5','./img/5share50003.jpg','share-photo003'),




('1','./img/1coffee10004.jpg','coffee-photo004'),
('2','./img/2pourover20004.jpg','pourover-photo004'),
('3','./img/3beans30004.jpg','beans-photo004'),
('4','./img/4celebrity40004.jpg','celebrity-photo004'),
('5','./img/5share50004.jpg','share-photo004'),


('1','./img/1coffee10005.jpg','coffee-photo005'),
('2','./img/2pourover20005.jpg','pourover-photo005'),
('3','./img/3beans30005.jpg','beans-photo005'),
('4','./img/4celebrity40005.jpg','celebrity-photo005'),
('5','./img/5share50005.jpg','share-photo005'),


('3','./img/3beans30006.jpg','beans-photo006');


SELECT
blogs.id as id,
fk_type_id,
types_name,
title,
CREATEd_at,
content
FROM blogs
left join blog_types on blog_types.id = blogs.fk_type_id WHERE blogs.id;


-- 文章列表
SELECT blogs.id, url, title,CREATEd_at
 FROM  blog_photos
 JOIN  blogs
 ON blogs.id = blog_photos.fk_blog_id ;
-- SELECT blogs.id, url, title,CREATEd_at
-- FROM  blog_photos
-- JOIN  blogs
-- ON blogs.id = blog_photos.fk_blog_id  DESC  LIMIT  %s, %s ;

