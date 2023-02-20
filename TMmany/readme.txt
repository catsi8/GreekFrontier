程式名稱：TMmany 線上傳訊
程式版本：1.2.3
程式作者：TurtleMan
作者電郵：turtlemn@pchome.com.tw
安裝方式：
	修改第一行之perl路徑，通常提供主機的首頁FAQ或常見問題裡會有說明
	大部分的設定為  #!/usr/local/bin/perl  或  #!/usr/bin/perl

	$datafile='many.txt';##紀錄資料的檔案位址
　　　	　　紀錄訪客的資料檔，為避免訪客直接檢視此資料檔的內容，建議自行
	　　更改成不容易被猜到的檔名。
	$cycle=300;##自動reload的週期(單位：秒)
	　　程式必須藉由重新讀取以獲得更新後的資料，預設值是300秒，即每
	　　5分鐘會自動重新讀取。
	$bgcolor='F0FFF0';##背景顏色
	　　頁面的背景顏色
	$cgiurl='many.cgi';##主程式檔名
	$usehtmlpass='~!123!~';##(使用HTML的密碼)
	　　此功能是專為版主設計的，正常情況下程式會自動過濾html語法，目
	　　的是為了防止壞人使用html語法攻擊線上的人，一旦版主發現線上有
	　　壞人，就可以用語法把它踢下站了。
	　　使用方法是在發送的訊息前端加入這個密碼。
	　　例如發送「<font color=red>測試</font>」時，只要改成
	　　「~!123!~<font color=red>測試</font>」就會顯示語法了。
	　　注意：設定必須為7個半形字元《置於兩個單引號中》
	$listcolor='darkslateblue';##線上人數選單文字顏色
	$listbgcolor='f0fff0';##線上人數選單背景顏色
	　　即下拉式選單第一行的背景顏色。
	$cmdlistcolor='red';##系統命令選單文字顏色
	　　前面加「★」號即為系統命令選單。
	　　前面加「◎」號者代表自己。
	$cmdlistbgcolor='aliceblue';##系統命令選單背景顏色
	$onlistcolor='green';##線上人名選單文字顏色
	$onlistbgcolor='lightcyan';##線上人名選單背景顏色
	$nickcount=14;##設定暱稱可輸入的最多字元數(全形字一字佔2字元)
	　　建議不要超過14個半形字元。


上傳檔案：
	將many.cgi和many.txt上傳到同一個目錄裡，屬性設定如下：
	　　many.cgi	755
	　　many.txt	666

補充說明：
	程式中另外提供了一般訪客使用html語法的功能，但僅限程式使用說明
	中所列出的部分功能。
	查詢詳細資料功能中的主機名稱轉換，不是每一個空間都可以使用，如
	果不支援就會直接以ip代替主機名稱，另外如果該ip查詢不到主機名稱
	也會直接以ip取代主機名稱。
