# LevianthQuestionaire

**LevianthQuestionaire** là một website nhỏ tạo phần hỏi/trả lời theo câu hỏi cho sẵn dựa trên ngôn ngữ lập trình web PHP.

Phần hỏi sẽ được thực hiện theo chế độ mỗi câu sẽ có một mức thời gian nhất định, và có thời gian bắt đầu/thời hạn của phần hỏi.

Website này được mình làm ra trong vòng 3 ngày (từ 26/4/2021 - 28/4/2021) và được làm 100% bằng điện thoại (do lúc đó mình không được sử dụng máy tính :<) nên nó có thể sẽ không hoạt động tốt trên máy tính.

Website này chỉ sử dụng PHP, không hề sử dụng hệ Quản trị dữ liệu (như MySQL hay PostgreSQL) nào, vì vậy nên nó có thể hoạt động trên mọi máy chủ web có hỗ trợ PHP. Nó cũng có thể hoạt động khoảng 50-60% tính năng nếu không bật JavaScript.

## Tại sao mình lại làm website này?

Trước đây, mình có ý định làm một website để hỗ trợ cho các QTV của một máy chủ trên Discord mở một đợt ứng tuyển, vì vậy nên mình đã ngồi... bấm điện thoại suốt 3 ngày để tạo ra trang web này. Và kết quả là...

![image1](https://uphinh.vn/images/2021/07/16/402eef8f9c18ccfbd07ff097462145e3.png)

Thế nên, mình đã quyết định open-source cái website này, coi như là mình làm chỉ để cho vui thôi =))

## Cách cài đặt và sử dụng:

* Đầu tiên, cho cả thư mục website đã tải xuống vào máy chủ PHP của bạn. Nên để website ở thư mục gốc của máy chủ để tránh có lỗi xảy ra.

* Sau đó, mở tệp tin `config.php` lên và cài đặt thời gian bắt đầu/kết thúc bằng 2 biến:

```php
$startTime = 1234567890; // Thời gian bắt đầu phần hỏi (tính bằng timestamp - tổng số giây kể từ ngày 1/1/1970)
$endTime = 1234567890 // Thời hạn kết thúc phần trả lời (tính bằng timestamp - tổng số giây kể từ ngày 1/1/1970)
```

* Các người dùng mặc định được lưu ở thư mục `users_d341a906`, mỗi tệp tin PHP là một người dùng, với mã truy cập là tên tệp tin PHP đó. Để tạo một người dùng mới, chỉ cần tạo một tệp tin PHP với tên tệp là mã truy cập của người dùng và nhập nội dung sau:

```php
$tempUser->id = 12345; // ID người dùng (nhớ không được trùng với các người dùng khác)
$tempUser->name = "Tên hiển thị người dùng";
$tempUser->isTestUser = true; // Có phải là người dùng thử nghiệm? (true = Có / false = Không)
$tempUser->isAdmin = true; // Có phải là quản trị viên? (true = Có / false = Không)
```

Bạn cũng có thể tạo một người dùng trong bảng điều khiển của Quản trị viên.

* Dữ liệu câu hỏi thử nghiệm được lưu ở tệp tin `demoQuestions.json` và dữ liệu câu hỏi chính thức được lưu ở tệp tin `questions_d139e542.json`, dưới dạng JSON. Để thêm một câu hỏi vào dữ liệu, chỉ cần thêm một object có những phần tử sau vào mảng câu hỏi questionData:

| Tên phần tử | Loại phần tử | Mô tả |
| --- | --- | --- |
| timeLimit | số (number) | Giới hạn thời gian cho câu hỏi |
| minCharacters | số (number) | Số kí tự tối thiểu cần có cho câu trả lời |
| type | xâu (string) | Loại câu hỏi (select = Lựa chọn / text = Tự luận / number = Nhập số) |
| selectContent | mảng (xâu) - array(string) | Danh sách các lựa chọn (chỉ hỗ trợ khi type = "select") |
| maxNumber | số (number) | Số lớn nhất có thể trong câu trả lời (chỉ hỗ trợ khi type = "number") |
| content | xâu (string) | Nội dung câu hỏi |

* Dữ liệu câu trả lời thử nghiệm được lưu ở tệp tin `testAnswerList.json` và câu trả lời chính thức được lưu ở thư mục `answerData_e61534`.

## Sự khác nhau giữa Người dùng thử nghiệm và Người dùng chính thức?

Người dùng thử nghiệm sẽ được thử nghiệm tính năng hỏi/trả lời ngay cả khi chưa đến thời gian bắt đầu. Người dùng thử nghiệm sẽ có một bộ câu hỏi riêng và câu trả lời tạm thời sẽ được lưu vào bộ nhớ tạm của thiết bị chứ không được lưu trên máy chủ. Sẽ không thể truy cập được vào tài khoản thử nghiệm khi thời gian đã bắt đầu.

Thông tin cá nhân của người trả lời cũng sẽ không được gửi.

## Lưu ý:

* Do mình chỉ làm trong vòng 3 ngày và hoàn toàn bằng điện thoại nên mình không chắc chắn về tính bảo mật của bộ câu hỏi. KHÔNG NÊN dùng website này nếu như bộ câu hỏi của bạn cần được **bảo mật tuyệt đối**.

-----------------------------

Made with <3 by Nico Levianth since 2021.4.26.
