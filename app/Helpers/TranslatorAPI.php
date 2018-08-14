<?php

namespace App\Helpers;

/**
 * Class TranslatorAPI.
 */
class TranslatorAPI
{
    protected $key;
    protected $api_host;
    protected $end_point;

    /**
     * Default class constructor 
     */
    public function  __construct() {
        $this->key = config('app.microsoft_translator_api_key');
        $this->api_host = config('app.microsoft_translator_api_host');
        $this->end_point = config('app.microsoft_translator_api_endpoint');
    }

    /**
     * translate()
     * 
     * Translate provided text into requested language using Microsoft Translator V3 API
     * @param string $params
     * @param array $requestBody
     * @return stdClass Object
     */
    public function translate($params = '', $requestBody = '') {
        $paramStr = '';
        foreach ($params['to'] as $param) {
            $paramStr .= "&to=$param";
        }
        $paramStr .= '&textType=html';

        $content = json_encode($requestBody);

        try {
            $result = $this->processTranslation($this->api_host, $this->end_point, $this->key, $paramStr, $content);
            
            return json_decode($result, true);
        } catch (\Exception $e) {
            return \Response::json(array(
                'code'       =>  $e->getCode(),
                'message'   =>  $e->getMessage()
            ), 500);
        }
    }
    
    /**
     * 
     */
    private function processTranslation ($host, $path, $key, $params, $content) {
        $headers = "Content-type: application/json\r\n" .
            "Content-length: " . strlen($content) . "\r\n" .
            "Ocp-Apim-Subscription-Key: " . $this->key . "\r\n" .
            "X-ClientTraceId: " . com_create_guid() . "\r\n";
        // NOTE: Use the key 'http' even if you are making an HTTPS request. See:
        // http://php.net/manual/en/function.stream-context-create.php
        $options = array (
            'http' => array (
                'header' => $headers,
                'method' => 'POST',
                'content' => $content
            )
        );
        $context  = stream_context_create ($options);
        $result = file_get_contents ($host . $path . $params, false, $context);

        return $result;
    }        
}
