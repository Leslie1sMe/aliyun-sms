<?php

namespace Leslie\AliyunSms;

use Leslie\Sms\Core\DefaultAcsClient;
use Leslie\Sms\Core\Profile\DefaultProfile;
use Leslie\Sms\Core\Config;
use Leslie\Sms\Core\Regions\EndpointConfig;
use Leslie\Sms\Request\V20170525\QueryInterSmsIsoInfoRequest;
use Leslie\Sms\Request\V20170525\QuerySendDetailsRequest;
use Leslie\Sms\Request\V20170525\SendBatchSmsRequest;
use Leslie\Sms\Request\V20170525\SendInterSmsRequest;
use Leslie\Sms\Request\V20170525\SendSmsRequest;
use Leslie\Sms\Core\Regions\EndpointProvider;
use Leslie\Sms\Core\Regions\Endpoint;

/**
 * Class AliyunIot
 * @package Leslie\AliyunIot
 */
Config::load();

class AliyunSms
{
    private $_accessKey = '';
    private $_accessSecret = '';
    private $_client = '';


    /**
     * AliyunIot constructor.
     * @param $accessKey
     * @param $accessSecret
     */
    public function __construct($accessKeyId, $accessSecret)
    {
        $this->_accessKey = $accessKeyId;
        $this->_accessSecret = $accessSecret;
        $iClientProfile = DefaultProfile::getProfile("cn-hangzhou", $this->_accessKey, $this->_accessSecret);
        DefaultProfile::addEndpoint("cn-hangzhou", "cn-hangzhou", "Dysmsapi", "dysmsapi.aliyuncs.com");
        $this->_client = new DefaultAcsClient($iClientProfile);
    }

    public function sendSms($templateCode, $phoneNumbers, $signName, $resourceOwnerAccount = null, $templateParam = null, $resourceOwnerId = null, $smsUpExtendCode = null)
    {
        $request = new SendSmsRequest();
        $request->setTemplateCode($templateCode);
        $request->setPhoneNumbers($phoneNumbers);
        $request->setSignName($signName);
        $request->setResourceOwnerAccount($resourceOwnerAccount);
        $request->setTemplateParam(json_encode(array(  // 短信模板中字段的值
            "code" => rand(10000, 99999),
        ), JSON_UNESCAPED_UNICODE));
        $request->setResourceOwnerId($resourceOwnerId);
        $request->setSmsUpExtendCode($smsUpExtendCode);
        return $this->_client->getAcsResponse($request);

    }
    

}
