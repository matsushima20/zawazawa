<?php
//include 'config.php';
//include 'function.php';
require_once('../config.php');

/* 
セッション時に月と日とユーザーネームを取る 
ユーザーネームからユーザーidを抽出
postで結果表示画面に月日とユーザーidとユーザーネームを送ること-->
///0724にやるべきこと　jsからcountとlogarrayを取って確定ボタンを押したらデータ挿入を行うものを作る
*/
?>


<!DOCTYPE html>

<html lang="ja">
<head>
<h1 class="title">摂取カロリー登録画面</h1>
<meta charset="UTF-8">
<script src="MA_pushdata.js"></script>
<!-- <script src="ME_pushdata.js"></script>
<script src="OT_pushdata.js"></script> --> 
<link href="http://localhost/test/styleform.css" rel="stylesheet">
<link href="http://localhost/test/inputmaterial.css" rel="stylesheet">
<link href="http://localhost/test/inputmenu.css" rel="stylesheet">
<link href="http://localhost/test/inputother.css" rel="stylesheet">
<link href="http://localhost/test/registdata.css" rel="stylesheet">
<link href="http://localhost/test/jumpsite.css" rel="stylesheet">
</head>
<body>
</body>
 <!----------------------------------食品名のブロック----------------------------------->                                  
<div style="float:left;" class="inputformat">
<br>
<label for="name" class="MA_biglabel">  食品名  </label> 
<p><label for="name" class="MA_selectnamelabel">食品名選択</label> </p>



<!-- 食品名のプルダウン作成 -->
<?php
// DB接続しSQLを発行してデータを取得
$sql= "select * from materials";
$stmt = $pdo -> prepare($sql);
$stmt->execute(); 

//プルダウン作成+
echo "<form method='post'>";
echo "<select id='MA_name' name='MA_name' class='MA_selectnamebox'>";
while($res = $stmt->fetch(PDO::FETCH_ASSOC)){  // 実行結果から1レコード取ってくる
  	$names=$res['materials'];
  	$kcal=$res['calories'];
  	echo "<option value='$names'>$names</option>";
}	
  echo "</select>"; 
  echo "<input type='text' id='MA_num' name='MA_Num'placeholder='個'class='MA_numbox'>";
  echo "<button class='MA_registbutton'type='button' name='MA_add' value='ボタン' onclick='MA_clickgo()'>決定</button>";

  echo "</form>";
?>

<form method="post">
<p><label for="name"class="MA_numlabel">個数</label>
<label for="name"class="MA_attention">(※肉類は100gで1個として扱います)</label>
</p>

<!-- <input type="button" class="MA_registbutton"  name="MA_add" value="決定!" onclick="MA_clickgo()"><br> -->
</form>




 <!----------------------------------料理名のブロック----------------------------------->                                  
</div>
<div style="float:left;" class="inputformat">
<br>
<form method="post">
<label for="name" class="ME_biglabel">  料理名  </label>   
<p><label for="name" class="ME_selectnamelabel">料理名選択</label> </p>
</p>
<p><label for="name" class="ME_numlabel">個数</label>
<input id="ME_num"type="text" name="ME_Num" class="ME_numbox"placeholder="個">
</form>
<!-- 料理名のプルダウン作成 -->
<?php

$sql= "select * from dishes";
$stmt = $pdo -> prepare($sql);
$stmt->execute();
echo "<form method='post'>";
echo "<select id='ME_name' name='ME_Name' class='ME_selectnamebox'>";
while($res=$stmt->fetch(PDO::FETCH_ASSOC)){  // 実行結果から1レコード取ってくる
	  $names=$res['dishes'];
   	  $kcal=$res['calories'];
	echo "<option value='$names'>$names</option>";
}	
   echo "</select>";
   echo "</form>";
?>

</p>
<!-- <input type="button" class="ME_registbutton"  name="add" value="決定!" onclick="ME_clickgo()"><br> -->
<button class="ME_registbutton"type="submit" name="ME_add" value="決定！" onclick="ME_clickgo()">決定</button> 
</form>


 <!----------------------------------その他のブロック----------------------------------->                                  

</div>
<div style="float:left;"class="inputformat">

<br>

<label for="name" class="OT_biglabel">  その他  </label>   
<p><label for="name" class="OT_selectnamelabel">品目名選択</label> </p>
<label for="name" class="OT_label1">登録場所</label>
<label for="name" class="OT_label2">登録名</label>
<label for="name" class="OT_label3">カロリー</label>

<?php
$sql= "select * from foods";
$stmt = $pdo -> prepare($sql);
$stmt->execute();

 // 取得した内容を表示する
echo "<form method='post'>";
echo "</p><p><label for='name' class='OT_numlabel'>個数</label>";
echo "<input id='OT_dnum' type='text' name='OT_Num' class='OT_numbox' placeholder='個'>";
echo "</p><button class='OT_registbutton' type='button' name='OT_add' value='決定！' onclick='OT_clickgo()' >決定</button>";

echo "</form>";
//  --------- その他のプルダウン作成 ----------
echo "<select id='OT_dname' name='OT_Name' class='OT_selectnamebox'>";
while( $res = $stmt->fetch(PDO::FETCH_ASSOC) ){  // 実行結果から1レコード取ってくる
   $names    = $res['foods'];
   $kcal    = $res['calories'];
   echo "<option value='$names'>$names</option>";
 }	
   echo "</select>";
?>

<form method="post">
</p>
<p><label for="name" class="OT_numlabel">個数</label>
<input id="OT_dnum" type="text" name="OT_Num" class="OT_numbox"placeholder="個">
</p>

<button class="OT_registbutton"type="button" name="OT_add" value="決定！" onclick="OT_clickgo()" >決定</button>
<label for="name" class="OT_label1">登録場所</label>
<label for="name" class="OT_label2">登録名</label>
<label for="name" class="OT_label3">カロリー</label>
</form>

<form method="post">
<p class = OT_ppos>
<input type="radio" name="OT_radio" value="1" checked>食品名<br>
<input type="radio" name="OT_radio" value="2" checked>料理名<br>
<input type="radio" name="OT_radio" value="3" checked>その他<br>
</p>
<input id="OT_registname"type="text" name="OT_name" class="OT_box1"placeholder="名前">
<input id="OT_registkcal"type="text" name="OT_kcal" class="OT_box2"placeholder="kcal">
<button class="OT_dataregistbutton"type="submit" name="dataregist" value="ボタン" onclick="window.location.reload(true);" >新規登録</button>
</form>


</div>
<div style="float:left;"class="displayformat">
<!-- <div class="registbox">登録情報</div> -->
<input type="text" id="registfield" name="regist" class="registbox" placeholder="登録情報">

<input type="button" class="backbutton"  name="back" value="データを1つ取り消す" onclick="clickback()"><br>

<?php
//新規登録処理
	if(isset($_POST['dataregist'])) {//新規登録のボタンが押された時
		 $checkradio=$_POST['OT_radio'];
		 $checkname=$_POST['OT_name'];
		 $checkkcal=$_POST['OT_kcal'];
		 $repeat=false;//重複チェック変数
		
			if(!empty($checkname) && !empty($checkkcal)){
			//空白データのチェック
				switch ($checkradio){
	 			//テーブル名の選択、変数を用いて後で代入する予定でしたが、うまくいかなかったので許してください
					case 1:
						$sql="SELECT * FROM materials WHERE materials = :names limit 1";//重複データチェック　結合時namesを正しいカラム名に変更すること
						$stmt = $pdo -> prepare($sql);
						$stmt->bindParam(':names', $checkname, PDO::PARAM_STR,30);
						$stmt->execute();
						$result = $stmt->fetch(PDO::FETCH_ASSOC);
						if($result > 0){//重複データが1つ以上あるならばフラグを建てる
							$repeat=true;
						break;
						}
						$sql= "INSERT INTO materials(materials,calories) VALUES(?,?)";
						break;
					case 2:
						$sql="SELECT * FROM dishes WHERE dishes = :names limit 1";//重複データチェック
						$stmt = $pdo -> prepare($sql);
						$stmt->bindParam(':names', $checkname, PDO::PARAM_STR,30);
						$stmt->execute();
						$result = $stmt->fetch(PDO::FETCH_ASSOC);
						if($result > 0){
							$repeat=true;
						break;
						}
						$sql= "INSERT INTO dishes(dishes,calories) VALUES(?,?)";
						break;
					case 3:
						$sql="SELECT * FROM foods WHERE foods = :names limit 1";//重複データチェック
						$stmt = $pdo -> prepare($sql);
						$stmt->bindParam(':names', $checkname, PDO::PARAM_STR,30);
						$stmt->execute();
						$result = $stmt->fetch(PDO::FETCH_ASSOC);
						if($result > 0){
							$repeat=true;
						break;
						}
						$sql= "INSERT INTO foods(foods,calories) VALUES(?,?)";
						break;
					default:
						echo "ラジオボタンに変な値はいってる";

				}
				if($repeat==false){//データの重複がなければデータを追加する
					$stmt = $pdo -> prepare($sql);
					$stmt->execute([$checkname,$checkkcal]);
				while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
					// echo $result['names'].'<br>';
					// echo $result['kacal'].'<br>';
				}
			}
			 	
			
		}
	}


//決定を押したときに、リザルトで表示するDBへのデータ挿入
//if(!empty($_POST['MA_add'])||!empty($_POST['ME_add'])||!empty($_POST['OT_add'])) {//決定が押された時！ うまくいかなければそれぞれの結果ボタンの名前をMAとかつけて論理和で結ぶ
if(!empty($_POST['MA_add'])){

	echo "<script>alert('テスト');</script>"; 
	if(!empty($_POST['MA_add'])&&!empty($_POST['MA_name'])){//食品名のとき
	 	$checkradio=1;//id
		$checkname=$_POST['MA_name'];//名前
		$checknum=$_POST['MA_Num'];//個数
		$sql="select calories from materials where materials = :names ";
	 }
	 else if(isset($_POST['ME_add'])&&!empty($_POST['ME_name'])){//料理名のとき
		echo $checkradio=2;//id
	    echo $checkname=$_POST['ME_Name'];//名前
	    echo $checknum=$_POST['ME_Num'];//個数
	    $sql="select calories from dishes where dishes = :names ";
	 }
	else if(isset($_POST['OT_add'])&&!empty($_POST['OT_Name'])){//その他のとき
		echo $checkradio=3;//id
	    echo $checkname=$_POST['OT_Name'];//名前
	    echo $checknum=$_POST['OT_Num'];//個数
	    $sql="select calories from foods where foods = :names ";
	 }

	 if(!empty($checkname)&&!empty($checknum)){
		$stmt = $pdo -> prepare($sql);
		$stmt->bindParam(':names', $dname, PDO::PARAM_STR,30);
		$stmt->execute();
		$hit = $stmt->fetch(PDO::FETCH_ASSOC);
		$resultkcal=$hit*$checknum;//総カロリー
		$sql="INSERT INTO nutritionreg_table(UserID,Date,DetaName,Calorie,WorkTime) VALUE('aaa',2020-07-01,?,?,?)";//　結合時ユーザーIDと日付データも挿入すること正しいカラム名に変更すること
		$stmt = $pdo -> prepare($sql);
		$stmt->execute($checkname,$checknum,$resultkcal);//本来もう少し増える
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
	 }
}

?>

<?php 
//ひとつもどるを押したときに、リザルトで表示するDBへのデータ挿入
if(isset($_POST['back'])) {//modoruが押された時！
	if(empty($_POST['back'])){	 
	}
	else{
		$day=2020-07-01;//本来はユーザーIDと日付をもらう
		$sql="DELETE FROM nutritionreg_table WHERE Date = ? ORDER BY DATE AS DESC LIMIT 1";//　結合時ユーザーIDと日付データも挿入すること正しいカラム名に変更すること
		$stmt = $pdo -> prepare($sql);
		$stmt->execute($day);//本来もう少し増える
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
	}
}
  ?>

<form action="registexercise.php" method="post">
<input type="submit" class="jumpexercise"  name="button" value="運動データ登録へ" ><br>
</form>
</div>
</html>