<?php
namespace App\Http\Controllers;
use App\Common\Auth\JwtAuth;
use App\Http\Response\ResponseJson;
use Illuminate\Http\Request;
class JwtController extends BaseController
{
    use ResponseJson;
    public function login()
    {
        $username = Request()->input('username');
        $password = Request()->input('password');

        //数据库获取或者缓存获取 用户信息的uid
        $uid = 1;
        $jwtAuth = JwtAuth::getInstance();
        $token = $jwtAuth->setUid($uid)->encode()->getToken();
        return $this->josnSuccessData(['token'=>$token]);

    }

    public function info()
    {
        $data = [
            'name'=>'admin',
            'uid'=>'1111111'
        ];
        return $this->josnSuccessData($data);
    }

}
