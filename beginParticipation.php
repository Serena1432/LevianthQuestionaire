<?php

if ($verify == "renlevianth") {
$index = sizeof($data->answerData);
$q = $question->questionData[$index];
if ($question->additionalDescription) echo '<div style="border: 1px solid white; margin: 5px; padding: 5px"><small>' . $question->additionalDescription . '</small></div>';
echo '<p style="text-align: right">Thời gian còn lại cho câu hỏi này: <b id="timeLeft" style="font-size: 16pt">00:00</b></p>
<p><b style="font-size: 14pt">Câu hỏi số ' . ($index + 1) . ': </b><br>' . $q->content;
if ($q->type != "select") {
  echo '<br>Vui lòng trả lời trên ' . $q->minCharacters . ' ký tự.</p><p style="text-align: right" id="chars">0/' . $q->minCharacters . '</p>';
}
echo '<form method="POST" onsubmit="check(event)">';
if ($q->type == "select") {
  echo '<select name="answer">';
  foreach ($q->selectContent as $option) echo '<option value="' . $option . '">' . $option . '</option>';
  echo '</select>';
}
else if ($q->type == "text") {
  echo '<textarea name="answer" style="height: 300px" oninput="chars()"></textarea>';
}
else if ($q->type == "number") {
  echo '<input type="number" name="answer" max="' . $q->maxNumber . '" oninput="chars()" />';
}
echo '<br><div id="error">';
if ($_POST["submit"] && strlen($_POST["answer"]) < $q->minCharacters) echo '<b>Vui lòng trả lời trên ' . $q->minCharacters . ' ký tự!</b><br>';
else if ($answer_error) echo '<b>' . $answer_error . '</b>';
echo '</div><input type="submit" name="submit" value="Trả lời" style="width: 100px; font-weight: bold" />
</form><script>
if (' . $data->limitTime . ' - parseInt((new Date()).getTime() / 1000) < 0) window.location.reload();
setInterval(function() {
  var time = ' . $data->limitTime . ' - parseInt((new Date()).getTime() / 1000);
  var m = parseInt(time / 60);
  var s = time - m * 60;
  var timeLeft = document.getElementById("timeLeft");
  timeLeft.innerText = "";
  if (m < 10) timeLeft.innerText += "0";
  timeLeft.innerText += m + ":";
  if (s < 10) timeLeft.innerText += "0";
  timeLeft.innerText += s;
  if (s < 0) {
    alert("Bạn đã trả lời quá thời gian quy định. Vui lòng tham gia lại vào đợt trả lời sau.");
    timeLeft.innerText = "00:00";
    window.location.href = "./";
  }
}, 1000);
var minChars = ' . $q->minCharacters . ';
function check(e) {
  if (document.getElementsByName("answer")[0].value.length < minChars) { document.getElementById("error").innerHTML = "<b>Vui lòng trả lời trên " + minChars + " ký tự!</b>"; e.returnValue = false; }
  else { document.getElementById("error").innerHTML = ""; e.returnValue = true }
}';
if ($q->type != "select") echo '
function chars() {
  document.getElementById("chars").innerText = document.getElementsByName("answer")[0].value.length + "/" + minChars
}
';
echo '</script>
';
fclose($questionFile);

}
else http_response_code(404);
?>