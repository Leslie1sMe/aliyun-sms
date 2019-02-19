# aliyun-sms
2018最新sdk封装composer包


使用方法：引入项目文件

use \Leslie\AliyunSms\AliyunSms;

$iot = new AliyunSms('accessKey','accessSecret');

发送短信：

$iot->sendSms('code','templateCode','phoneNumbers','signName');


...
