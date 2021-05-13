<?php
declare (strict_types=1);

class Request
{
    /**
     * @var string
     */
    private $url = "";

    /**
     * Request constructor.
     * @param string $url
     */
    public function __construct(string $url)

    {
        $this->url = $url;
    }


    public function post($data,$ip)
    {
        //parse_str($data,$post);
        \Swlib\SaberGM::post($this->url,$data,[
            'bind_address'=>$ip
        ]);
    }


    /**
     * GET请求
     */
    public function get($ip)
    {
        \Swlib\SaberGM::get($this->url,[
            'bind_address'=>$ip
        ]);
    }
}