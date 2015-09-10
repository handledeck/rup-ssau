<?php namespace Est;

use Exception;

class Emax
{
    public $host;
    public $username;
    public $password;

    public function __construct($host,$username,$password){
        $this->host=$host;
        if(!isset($_COOKIE['__ses'])){
            $code=Emax::RequestToUrl('POST',$host.'/accounts/Login','login='.$username.'&psw='.$password.'&remeber=off&hideAnsw=on');
            if($code)
            {
                $val = explode('=', explode(';', $code['Set-Cookie'])[0]);
                if(count($val)){
                    $this->password=$password;
                    $this->ses  = $val[1];
                    $this->username=$username;
                    setcookie($username = '__ses', $value = $val[1], time() + 60 * 60 * 24, '/');
                }
            }
            else return false;
        }
    }

    public function GetPasport($Id){
        $url=$this->host.'/services/ClientModelElectroService/ClientModelElectroContract/ReadPassportChannelLink?'.
            json_encode(array(
                'Id'=>$Id));
        return Emax::RequestToUrl('GET',$url,array(),$this->getHeader());
    }

    public function GetInstantValues(){
        return Emax::RequestToUrl('GET',$this->host.'/services/ClientModelElectroService/ClientModelElectroContract/ReadImAll?{\'Tags\':[0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15],\'PageNum\':0,\'PageSize\':20}',array(),$this->getHeader());
    }
    
    public function ReadCurrentUser(){
        $code=Emax::RequestToUrl('GET',$this->host.'/services/DiagnosticsSrv/DiagnosticsPortContract/ReadCurrentUser',array(),$this->getHeader());
        if($code){
            $code=Emax::RequestToUrl('GET',$this->host.'/services/AuthManSrv/AuthManPortContract/GetUserById?'.json_encode(array("Id"=>$code->UserID)),array(),$this->getHeader());
            if($code)
                return $code->Result;
            else return false;
        }
        else return false;
    }

    public function ReadDataChannel($channelId=array(),$start,$end,$count,$uchet=array(0,1,2,3),$mode=1){

        $data=array();
        $ch_int=$this->ReadChildNode($channelId);
        if(!$ch_int) return false;
        foreach($ch_int as $item){
            $js=json_encode(array('ChannelId'=>array('IdInt'=>$item),
                'StartTime'=>array('T'=>$start),
                'EndTime'=>array('T'=>$end),
                'Count'=>$count,
                'Energy'=>$uchet,
                'Mode'=>$mode,
                'StartTimeStep'=>array('T'=>$start),
                'Step'=>$mode==1?1:-1));
            $code=Emax::RequestToUrl('GET',$this->host.'/services/ClientModelElectroService/ClientModelElectroContract/ReadDataEnergy?'.$js,array(),$this->getHeader());
            if($code)
                array_push($data,$code->Results);
        }
        return $data;
    }



    public function ReadChildNode($nodeId=array()){
        $nodesIds=array();
        foreach($nodeId as $item){
            $url_get=$this->host.'/services/NodeEditorSrv/NodeEditorPortContract/ReadChildNode?'.json_encode(array('ParentId'=>array('IdInt'=>$item),'PageNum'=>0,'PageSize'=>1,'ByOrdinal'=>false));
            $code=Emax::RequestToUrl("GET",$url_get,array(),$this->getHeader());
            if($code)
            {
                array_push($nodesIds,$code->Values[0]->Id->IdInt);

            }
            else return false;
        }
        return $nodesIds;
    }

    public function GetBalance($partOfPath,$dateFrom){
        $data=json_encode(array(
            'PartOfPath'=>$partOfPath,
            'SelectDate'=>array('T'=>$dateFrom),
            'Items'=>array(),
            'sign'=>3));
        $code=Emax::RequestToUrl("POST",$this->host.'/services/ClientModelVitRegAscueService/ClientModelVitRegAscueServiceContract/GetBalanceStation',$data,Emax::getHeader());
        if($code)
            return $code->Balance;
        else return false;
    }


    public function GetTableData($partOfPath,$dateFrom){
        $data=json_encode(array(
            'PartOfPath'=>$partOfPath,
            'SelectDate'=>array('T'=>$dateFrom),
            'Items'=>array(),
            'sign'=>3));
        $code=Emax::RequestToUrl("POST",$this->host.'/services/ClientModelVitRegAscueService/ClientModelVitRegAscueServiceContract/GetTableData',$data,Emax::getHeader());
        if($code)
            return $code;
        else return false;
    }

    //'Р“Р­РЎ\Р”РѕРєС€РёС†РєРёР№ Р Р­РЎ\Р”РѕРєС€РёС†С‹\Р’РІРѕРґ_10РєР’_Рў1'
    public function GetChannelByPartName($partname,$pagenum=0,$pagesize=5){
        $code=Emax::RequestToUrl("POST",$this->host.'/services/ClientModelVitRegAscueService/ClientModelVitRegAscueServiceContract/GetChannelsByPartName',
            $data=json_encode(array(
                'PartOfPath'=>$partname,
                'PageNum'=>$pagenum,
                'PageSize'=>$pagesize))
            ,Emax::getHeader());
        return $code;
    }

    private function WriteResolve($code){
        echo '<pre>';
        echo $code;
        echo '</pre>';
    }
    //'Р”РѕРєС€РёС†С‹',0,50
    public function ReadFilterChannel($searchname,$pagenum=0,$pagesize=5){
        $url=$this->host.'/services/ClientModelCommonService/ClientModelCommonContract/GetChannels?'.
            json_encode(array(
                'PageNum'=>$pagenum,
                'PageSize'=>$pagesize,
                'AccountEnum'=>0,
                'Filter'=>null,
                'UserFilter'=>array('DisplayName'=>$searchname)
            ));
        return Emax::RequestToUrl('GET',$url,array(),$this->getHeader());
    }
    function getHeader(){
        $head=array('X-Requested-With'=>'XMLHttpRequest');
        if(isset($_COOKIE['__ses']))
            $head['Cookie']='__ses='.$_COOKIE['__ses'];
        return $head;
    }


    public function GetSyncDateTime(){
        //http://10.32.18.32:8181/services/ClientModelCommonService/ClientModelCommonContract/ReadMistimingWithDevice?{%22PageNum%22:2,%22PageSize%22:50}
        $url=$this->host.'/services/ClientModelCommonService/ClientModelCommonContract/ReadMistimingWithDevice?'.
            json_encode(array(
                'PageNum'=>0,
                'PageSize'=>500
            ));
        return Emax::RequestToUrl('GET',$url,array(),$this->getHeader());
    }



    public static function RequestToUrl($method, $uri, $data=null, array $headers=null, $timeout = null, $userAgent = null)
    {
        try{
            // Create the stream context options array with the required method offset.
            $options = array('method' => strtoupper($method));

            // If data exists let's encode it and make sure our Content-type header is set.
            if (isset($data))
            {
                // If the data is a scalar value simply add it to the stream context options.
                if (is_scalar($data))
                {
                    $options['content'] = $data;
                }
                // Otherwise we need to encode the value first.
                else
                {
                    $options['content'] = http_build_query($data);
                }

                if (!isset($headers['Content-type']))
                {
                    $headers['Content-type'] = 'application/x-www-form-urlencoded';
                }
                $headers['Connection'] = 'Keep-Alive';
                //$headers['X-Requested-With']='XMLHttpRequest';
                $headers['Content-length'] = strlen($options['content']);

            }

            // Build the headers string for the request.
            $headerString = null;
            if (isset($headers))
            {
                foreach ($headers as $key => $value)
                {
                    $headerString .= $key . ': ' . $value . "\r\n";
                }

                // Add the headers string into the stream context options array.
                $options['header'] = trim($headerString, "\r\n");
            }

            // If an explicit timeout is given user it.
            if (isset($timeout))
            {
                $options['timeout'] = (int) $timeout;
            }

            // If an explicit user agent is given use it.
            if (isset($userAgent))
            {
                $options['user_agent'] = $userAgent;
            }

            // Ignore HTTP errors so that we can capture them.
            $options['ignore_errors'] = 1;

            // Create the stream context for the request.
            $context = stream_context_create(array('http' => $options));

            // Open the stream for reading.

            $stream = fopen( $uri, 'r', false, $context);
            if(!$stream){
                return Emax::ResolveResult(array('headers'=>null,'code'=>503,'value'=>'Сервис по указанному адресу недоступен'));
            }
            $metadata = stream_get_meta_data($stream);
            preg_match('/[0-9]{3}/', array_shift($metadata['wrapper_data']), $matches);
            $headval= Emax::parseMetaData($metadata['wrapper_data']);
            $reader=null;
            if($headval['Content-Length']!=0)
            {
                $reader=stream_get_contents($stream,$headval['Content-Length']);
            }
            fclose($stream);
            
            return Emax::ResolveResult(array('headers'=>$headval,'code'=>$matches[0],'value'=>$reader));
        }
        catch(Exception $e){
            return Emax::ResolveResult(array('headers'=>$headval,'code'=>$e->getCode(),'value'=>$e->getMessage()));
        }
    }

    static function ResolveResult($code){
        if(!empty($code['code'])){
            if($code['code']!=200)
                return false;
            if(empty($code['value']))
                return $code['headers'];
            else return json_decode($code['value']);
        }
        else return false;
    }

    static function parseMetaData($metadata){
        $lst=array();
        foreach($metadata as $value){
            list($key,$val)= explode(':',$value);
            $lst[$key]=$val;
        }
        return $lst;
    }
}
