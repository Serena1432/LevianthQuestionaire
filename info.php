<?php
error_reporting(0);
include("config.php");
include("accessTokenHandler.php");
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
<h2>Thông tin website</h2><br>
<h3>LevianthRecruitment phiên bản <?php echo $version; ?></h3><br>
<small>
Được tạo bởi Nico Levianth vào ngày 26 tháng 4, 2021.<br>
Cập nhật lần cuối vào ngày 29 tháng 4, 2021.<br>
Hiện đang chạy trên PHP phiên bản <?php echo phpversion(); ?>.
<a href="./phpinfo.php">(Thông tin về phiên bản PHP hiện tại)</a><br>
<a href="#" onclick="deleteAllCookies()">Xóa toàn bộ Cookies của trang web</a>
<br>
</small>
<hr>
<small style="text-align: center; color: #a8a8a8">Made with <3 by Nico Levianth since 2021.04.26.</small><br><small><a href="./info.php">Thông tin website</a></small>
<script>
function deleteAllCookies() {
  var cookies = document.cookie.split(";");
  for (var i = 0; i < cookies.length; i++) {
    var cookie = cookies[i];
    var eqPos = cookie.indexOf("=");
    var name = eqPos > -1 ? cookie.substr(0, eqPos) : cookie;
    document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT";
  }
  alert("Xóa toàn bộ Cookies thành công.");
  window.location.reload();
}
</script>