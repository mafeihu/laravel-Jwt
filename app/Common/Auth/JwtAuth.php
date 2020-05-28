<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/5/26
 * Time: 14:32
 * 单例一次请求中所有出现的使用jwt的地方都是一个用户
 */
namespace App\Common\Auth;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\ValidationData;

class JwtAuth
{


    //单例模式 jwtAuth句柄
    private static $instance;

    //加密后的token
    private $token;
    //解析JWT得到的token
    private $decodeToken;
    //用户ID
    private $uid;
    //jwt密钥
    private $secrect = 'cSWI7BXwInlDsvdSxSQjAXcE32STE6kD';

    // jwt参数
    private $iss = 'http://example.com';//该JWT的签发者
    private $aud = 'http://example.org';//配置听众
    private $id = '4f1g23a12aa';//配置ID（JTI声明）


    /**
     *获取token
     *@return string
     */
    public function getToken()
    {
        return (string)$this->token;
    }

    /**
     * 设置类内部 $token的值
     * @param $token
     * @return $this
     */
    public function setToken($token)
    {
        $this->token = $token;
        return $this;
    }


    /**
     * 设置uid
     * @param $uid
     * @return $this
     */
    public function setUid($uid)
    {
        $this->uid = $uid;
        return $this;
    }

    /**
     * 得到 解密过后的 uid
     * @return mixed
     */
    public function getUid()
    {
        return $this->uid;
    }

    /**
     * 加密jwt
     * @return $this
     */
    public function encode()
    {
        $time = time();
        $this->token = (new Builder())->setHeader('alg','HS256')
             ->setIssuer($this->iss)//Configures the issuer (iss claim)
             ->setAudience($this->aud)// Configures the audience (aud claim)
             ->setId($this->id,true)// Configures the id (jti claim), replicating as a header item
            ->setIssuedAt($time)// Configures the time that the token was issued (iat claim)
            ->setNotBefore($time + 60)// Configures the time that the token can be used (nbf claim)
            ->setExpiration($time + 3600)// Configures the expiration time of the token (exp claim)
            ->set('uid', $this->uid)// Configures a new claim, called "uid"
            ->sign(new Sha256(), $this->secrect)// creates a signature using secrect as key
            ->getToken(); // Retrieves the generated token
        return $this;
    }


    /**
     * 解密token
     * @return \Lcobucci\JWT\Token
     */
    public function decode()
    {
        if(!$this->decodeToken)
        {
            $this->decodeToken = (new Parser())->parse((string)$this->token);
            $this->uid = $this->decodeToken->getClaim('uid');
        }
        return $this->decodeToken;
    }

    /**
     * 验证令牌是否有效
     * @return bool
     */
    public function validate()
    {
        $data = new ValidationData();
        $data->setAudience($this->aud);
        $data->setIssuer($this->iss);
        $data->setId($this->id);
        return $this->decode()->validate($data);
    }


    /**
     * 验证令牌在生成后是否被修改
     * @return bool
     */
    public function verify()
    {
        $res = $this->decode()->verify(new Sha256(), $this->secrect);
        return $res;
    }

    //=======================================================单例模式 jwtAuth句柄===============================================================//
    //单例模式 jwtAuth句柄
    public static function getInstance()
    {
        if(is_null(self::$instance))
        {
            self::$instance = new self();
        }
        return self::$instance;
    }
    /**
    * 单例模式 禁止该类在外部被new
    * JwtAuth constructor.
    */
    private function __construct()
    {

    }
    /**
     * 单例模式 禁止外部克隆
     */
    private function __clone()
    {
        // TODO: Implement __clone() method.
    }


}