<?php
error_reporting(1);
include("config.php");
include("accessTokenHandler.php");
if ($_GET["logout"] == "1") setcookie("LevianthAccessToken", "", time() - 3600);
$dyk = [
  "trang web này không sử dụng bất kì Hệ Quản trị dữ liệu (như MySQL) nào để quản lý dữ liệu của tất cả người dùng?",
  "bạn có thể dùng mã truy cập <b>testuser</b> hoặc <b>testuser2</b> để truy cập vào Chế độ thử nghiệm của trang web?",
  "trang web này được tạo ra 100% bằng điện thoại?",
  "bạn có thể dùng mã truy cập <b>renl</b> trước khi bắt đầu đợt trả lời để truy cập thử vào Bảng điều khiển quản trị?",
  "dữ liệu trả lời câu hỏi của Người dùng thử nghiệm được lưu trên bộ nhớ tạm (Cookies) của thiết bị của bạn chứ không phải là trên máy chủ như các người dùng khác?"
];
?>
<meta name="viewport" content="width=device-width, initial- scale=1">
<title>Trả lời  | LevianthQuestionaire</title>
<link rel="stylesheet" href="./style.css" />
<div style="height: 23px">
<h3 style="float: left; margin: 0"><a href="./">LevianthQuestionaire</a></h3>
<div style="margin-top: 6px; float: right; font-size: 10px">
<?php if ($user) {
echo '<b>Xin chào, ' . $user->name;
if ($user->isAdmin) echo ' (Quản trị viên)';
echo ' | <a href="./logout.php">Đăng xuất</a></b>'; }
else echo '<a href="./accessTokenLogin.php">Đăng nhập bằng Mã truy cập</a>';
?>
</div>
</div>
<hr>
<?php if ($user->isTestUser) echo '<div style="margin: 5px; padding: 5px; border: 1px solid white"><small>Bạn đang ở Chế độ Thử nghiệm. Một số tính năng có thể hoạt động khác với bình thường.</small></div>';
?>
<h2>Trả lời </h2>
<?php
if (time() < $startTime) echo '<p><b>Còn <i id="timeLeft">Không rõ thời gian </i>nữa là bắt đầu phần Trả lời!</b></p>';
else if (time() < $endTime) echo '<p><b>Đợt trả lời đang bắt đầu!<br>Còn <i id="timeLeft">Không rõ thời gian </i>nữa là kết thúc phần Trả lời!</b></p>';
else echo '<p><b>Đợt trả lời đã kết thúc!<br>Bạn có thể xem các câu trả lời đã gửi ở bên dưới.</b></p>';
if ($user->isAdmin) echo '<a href="./adminPanel.php"><div style="text-align: center"><button style="width: 200px; height: 50px; background-color: #2f2f2f; color: white; border: 2px solid white; border-radius: 2px">Đến bảng điều khiển</button></div></a>';
else if ((time() >= $startTime && time() < $endTime) || $user->isTestUser) echo '<a href="./participate.php"><div style="text-align: center"><button style="width: 200px; height: 50px; background-color: #2f2f2f; color: white; border: 2px solid white; border-radius: 2px">Trả lời ngay</button></div></a>';
if (time() > $endTime || $user->isAdmin || $user->isTestUser) echo '<a href="./answerList.php"><div style="text-align: center"><button style="width: 200px; height: 50px; background-color: #2f2f2f; color: white; border: 2px solid white; border-radius: 2px; margin: 5px">Xem câu trả lời</button></div></a>';
?>
<br>
<h2>Thông tin đợt trả lời</h2><br>
<?php require("participationRule.php"); ?>
<div style="border: 1px solid white; padding: 10px; margin: 10px">
<h3>Bạn có biết rằng...</h3>
<p><?php echo $dyk[rand(0, sizeof($dyk) - 1)]; ?></p>
</div>
<hr>
<small style="text-align: center; color: #a8a8a8">Made with <3 by Nico Levianth since 2021.04.26.</small><br><small><a href="./info.php">Thông tin website</a></small>
<script>
<?php
if (time() < $startTime) echo 'timestamp = ' . $startTime . ';';
else if (time() < $endTime) echo 'timestamp = ' . $endTime . ';';
?>
if (timestamp) {
  window.onload = function() {
    setInterval(function() {
      var timeText = document.getElementById("timeLeft");
      var time = timestamp - (new Date()).getTime() / 1000;
      var d = parseInt(time / 86400);
      var h = parseInt((time - d * 86400) / 3600);
      var m = parseInt((time - d * 86400 - h * 3600) / 60);
      var s = parseInt(time - d * 86400 - h * 3600 - m * 60);
      timeText.innerText = "";
      if (d > 0) timeText.innerText += d + " ngày ";
      if (h > 0) timeText.innerText += h + " giờ ";
      if (m > 0) timeText.innerText += m + " phút ";
      if (s > 0) timeText.innerText += s + " giây ";
      if (timestamp - (new Date()).getTime() / 1000 <= 0) window.location.href = "./"
    }, 1000);
  }
}
</script>