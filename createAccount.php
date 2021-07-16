<?php
error_reporting(0);
include("config.php");
include("accessTokenHandler.php");
if (!$user->isAdmin) header("Location: ./");
$exist = false; $isAdmin= false; $isTestUser = false; $testUsers = 0;
if ($_POST["submit"]) {
  if ($_POST["id"]) {
    foreach (scandir("./users_d341a906/") as $file) {
      if ($file != "." && $file != "..") {
        $tempUser = new stdClass();
        require("./users_d341a906/" . $file);
        if ($_POST["id"] == $tempUser->id) { $exist = true; break; }
      }
    }
    if ($exist) $createError = "ID này đã tồn tại!";
    else $id = $_POST["id"];
  }
  else $id = rand(100000000, 999999999);
  if (!$_POST["name"]) $createError = "Vui lòng nhập tên tài khoản!";
  if ($_POST["isAdmin"]) $isAdmin = true;
  foreach (scandir("./users_d341a906/") as $file) {
    if ($file != "." && $file != "..") {
      $tempUser = new stdClass();
      require("./users_d341a906/" . $file);
      if ($tempUser->isTestUser) $testUsers++;
    }
  }
  if ($_POST["isTestUser"] || $user->isTestUser) {
    if ($testUsers < 10) $isTestUser = true;
    else $createError = "Đã có quá nhiều tài khoản thử nghiệm.";
  }
  if (!$createError) {
    $token = md5(rand(0, 999999));
    if (!createAccount($id, $token, $_POST["name"], $isTestUser, $isAdmin)) $createError = "Không thể tạo tài khoản! Vui lòng thử lại!";
    else header("Location: ./createAccount.php?success=true&id=" . $id . "&token=" . $token . "&name=" . urlencode($_POST["name"]));
  }
}
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
<h2>Tạo tài khoản mới</h2>
<?php if (!$_GET["success"]) {
echo '
<p>Bạn có thể tạo một tài khoản mới có cùng hoặc dưới đặc quyền hiện tại của bạn.</p>
<form method="POST">
<input type="number" name="id" placeholder="ID tài khoản (bỏ trống để tạo ngẫu nhiên)" /><br>
<input name="name" placeholder="Nhập tên tài khoản" /><br>
<input type="checkbox" style="width: 15px; height: 15px; margin: 2px; margin-left: 10px" name="isAdmin" value="true" /> Quản trị viên<br>
<input type="checkbox" style="width: 15px; height: 15px; margin: 2px; margin-left: 10px" name="isTestUser" value="true"';
if ($user->isTestUser) echo 'checked="checked" disabled="disabled"';
echo ' /> Tài khoản thử nghiệm';
if ($user->isTestUser) echo ' <a href="#" onclick="alert(\'Bạn chỉ tạo được các tài khoản thử nghiệm trong Chế độ Thử nghiệm. Ngoài ra, trang web này chỉ cho phép tối đa 10 tài khoản thử nghiệm được tạo.\')"><small>(Tại sao không thể thay đổi tùy chọn này?)</small></a>';
echo '<br>';
if ($createError) echo '<br><b>' . $createError . '</b><br>';
echo '<input type="submit" name="submit" style="width: 100px" value="Tạo" />
</form>';
}
else echo '
<p>Đã tạo tài khoản mới thành công.</p>
<p>Mã truy cập tài khoản <b>' . $_GET["name"] . '</b> (ID: ' . $_GET["id"] . ') của bạn là: <b>' . $_GET["token"] . '</b>.</p>
<p>Hãy nhớ mã truy cập này để có thể truy cập vào tài khoản của bạn.</p>
';
?>
<hr>
<small style="text-align: center; color: #a8a8a8">Made with <3 by Nico Levianth since 2021.04.26.</small><br><small><a href="./info.php">Thông tin website</a></small>