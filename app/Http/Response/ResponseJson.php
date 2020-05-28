<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/5/27
 * Time: 14:25
 */
namespace App\Http\Response;
trait ResponseJson
{

    /**
     * 当APP接口出现业务异常时返回
     * @param $code
     * @param $msage
     * @param array $data4
     */
    public function jsonData($code,$mssage,$data=[])
    {
        return $this->josnResponse($code,$mssage,$data);
    }

    /**
     * 当APP接口成功是返回
     * @param array $data
     */
    public function josnSuccessData($data=[])
    {
        return $this->josnResponse(0,'success',$data);
    }
    /**
     * 返回一个json
     * @param $code
     * @param $mssage
     * @param $data
     */
    public function josnResponse($code,$mssage,$data)
    {
        $content = [
            'code'=>$code,
            'msssage'=>$mssage,
            'data'=>$data
        ];
        return response()->json($content);
    }

}