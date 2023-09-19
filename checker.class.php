<?php

/**
 * COPYRIGHT Ⓒ 2023 NEVILSOFT - ALL RIGHTS RESERVED.
 * DO NOT EDIT OR MODIFY FROM THE ORIGINAL WITHOUT PERMISSION. PUNISHABLE BY LAW
 * 
 * TERMS AND CONDITIONS:
 * 1. THE USE OF THIS CODE IS PERMITTED WITHOUT MODIFICATION OR MODIFICATION.
 * 2. THIS CODE IS STRICTLY PROHIBITED TO BE SOLD OR PART OF OTHER PRODUCTS. WITHOUT PRIOR PERMISSION FROM NEVILSOFT
 * 3. DO NOT INFRINGE COPYRIGHT OF NEVILSOFT
 * 
 * FACE RESPONSIBILITIES:
 * THE AUTHOR HAS LEFT THAT MUST BE USED EVERY TIME OR THERE IS A PROBLEM FROM THIS CODE.
 * THE AUTHOR MUST COMPENSATE OR REIMBURSE ANY ARISING FROM THE USE OF THIS CODE
 * 
 * ABOUT US
 * WEBSITE: HTTPS://NEVILSOFT.COM
 * EMAIL: CONTACT@NEVILSOFT.COM
 * FACEBOOK: HTTPS://FACEBOOK.COM/NEVILSOFT
 * 
 * Version: 1.4.10.230919282
 */

class ApiChecker
{
    private $path = __DIR__; // don't edit
    private $filename = "/proxies.txt";
    private $ApiKey = "4d3ec81204565a30877c533827c0ca1af1b2aa282651b2b7f6fcfb1a9d5a822a"; // Edit your api key
    private $Token; // don't edit
    private $BaseUrl = "https://rt20.midlery.com/api"; // don't edit
    private $version = "1.4.10.230919282"; // don't edit

    /** Stage status to start server:
     * 
     * - "dev", for start server without graceful shutdown
     * - "prod", for start server with graceful shutdown
     */
    private $STAGE_STATUS = "dev";

    const COLLOECTION_SKINS = "skins"; // don't edit
    const COLLOECTION_SPRAY = "sprays"; // don't edit
    const COLLOECTION_PLAYERCARD = "playercards"; // don't edit

    function __construct($Token)
    {
        $this->Token = $Token;
        if ($this->STAGE_STATUS == "dev") {
            $this->BaseUrl = "http://0.0.0.0:8080/api";
        }
        if ($version = !$this->CheckApiVersion()["update"]) {
            echo $version;
        }
    }

    /** this function using to call api by default
     * 
     * - Method default "GET"
     * - Url default "null"
     * - Data default "null"
     */
    private function Call($method = "GET", $url = null, $data = null, $header = null)
    {
        /**
         * Check proxy is null or not. Need to send Proxy only, null is not allowed. 
         * Define proxies in the proxies.txt file, one line per proxy
         */
        // $proxie = $this->GetProxy();
        // if ($proxie !== null) {
        //     $data["proxy"] = $proxie;
        // } else {
        //     return "proxie is null";
        // }

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => $header,
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        if ($response != null) {
            $result = json_decode($response, true);
            return $result;
        } else {
            return array(
                "error" => true,
                "msg" => "server down",
            );
        }
    }

    /**  Check your valorant game account using your Username and Password.
     *
     * Status Code 
     * - 1100 : PERMANENT_BAN
     * - 4015 : auth_failure
     * - 1202 : 2FA Auth Enabled
     * - 1440 : "Api Key Expired"
     */
    public function CheckBan($username, $password)
    {
        $url = $this->BaseUrl . "/v1/checkban";
        $header = array(
            'Content-Type: application/json',
            'Authorization: Bearer ' . $this->Token,
            'X-SDK-VERSION: sdk-php/' . $this->version,
            'X-API-KEY:' . $this->ApiKey
        );
        $data = array(
            "username" => $username,
            "password" => $password
        );
        return $this->Call("POST", $url, $data, $header);
    }

    /** Coming soon, please keep an eye out for updates from us.
     * 
     */
    public function GetNumberOfSkin(): int
    {
        return 0;
    }

    /** Get collection in account 
     *  
     * type
     * - COLLECTION_SKIN                = skins
     * - COLLECTION_SSPRAY              = sprays
     * - COLLECTION_AGENT               = agents
     * - COLLOECTION_TYPE_PLAYERCARD    = playercard
     */
    public function GetCollection($username, $password, $type): array
    {
        $url = $this->BaseUrl . "/v1/collection?type=" . $type;
        $header = array(
            'Content-Type: application/json',
            'Authorization: Bearer ' . $this->Token,
            'X-API-KEY:' . $this->ApiKey,
            'X-SDK-VERSION: sdk-php/' . $this->version,
        );
        $data = array(
            "username" => $username,
            "password" => $password
        );
        return $this->Call("POST", $url, $data, $header);
    }

    /** Coming soon, please keep an eye out for updates from us.
     * 
     */
    public function GenerateSkinImages(): array
    {
        return [];
    }

    /** Coming soon, please keep an eye out for updates from us.
     * 
     */
    public function GetDailyshop(): array
    {
        return [];
    }

    /** Coming soon, please keep an eye out for updates from us.
     * 
     */
    public function GetNightMarket(): array
    {
        return [];
    }

    /** Get User Info
     * 
     */
    public function GetUserInfo($username, $password): array
    {
        $url = $this->BaseUrl . "/v1/userinfo";
        $header = array(
            'Content-Type: application/json',
            'Authorization: Bearer ' . $this->Token,
            'X-API-KEY:' . $this->ApiKey,
            'X-Sdk-Version: ' . $this->version,
        );
        $data = array(
            "username" => $username,
            "password" => $password
        );
        return $this->Call("POST", $url, $data, $header);
    }

    /** Get Match History
     * 
     * return:
     *  
     */
    public function GetMatchHistory($username, $password): array
    {
        $url = $this->BaseUrl . "/v1/match-history";
        $header = array(
            'Content-Type: application/json',
            'Authorization: Bearer ' . $this->Token,
            'X-API-KEY:' . $this->ApiKey,
            'X-Sdk-Version: ' . $this->version
        );
        $data = array(
            "username" => $username,
            "password" => $password
        );
        return $this->Call("POST", $url, $data, $header);
    }

    /** Coming soon, please keep an eye out for updates from us.
     *
     */
    public function GetMatchDetail($username, $password, $matchID): array
    {
        $url = $this->BaseUrl . "/v1/match-details/" . $matchID;
        $header = array(
            'Content-Type: application/json',
            'Authorization: Bearer ' . $this->Token,
            'X-SDK-VERSION: sdk-php/' . $this->version,
            'X-API-KEY:' . $this->ApiKey,
        );
        $data = array(
            "username" => $username,
            "password" => $password
        );
        return $this->Call("POST", $url, $data, $header);
    }

    /** Coming soon, please keep an eye out for updates from us.
     * 
     * return started, expired
     */
    public function GetApiKeyInfo(): string
    {
        return "";
    }

    /** Coming soon, please keep an eye out for updates from us.
     *
     */
    private function CheckApiVersion(): array
    {
        $url = $this->BaseUrl . "/v1/version";
        $header = array(
            'Content-Type: application/json',
            'X-SDK-VERSION: sdk-php/' . $this->version,
            'X-API-KEY:' . $this->ApiKey
        );
        return $this->Call("GET", $url, null, $header);
    }

    /** Coming soon, please keep an eye out for updates from us.
     *
     */
    private function UpdateSystem()
    {
        $opts = [
            "http" => [
                "method" => "GET",
                "header" => array(
                    'X-SDK-VERSION: sdk-php/' . $this->version,
                )
            ]
        ];
        $file_url = $this->BaseUrl . '/v1/update?sdk=php';
        $save_path = './checker.class.php';
        $context = stream_context_create($opts);
        $file_content = file_get_contents($file_url, false, $context);
        if ($file_content !== false) {
            $save_result = file_put_contents($save_path, $file_content);

            if ($save_result !== false) {
                echo "ดาวน์โหลดไฟล์และอัพเดทเรียบร้อยแล้ว";
            } else {
                echo "ไม่สามารถอัพเดทไฟล์ได้";
            }
        } else {
            echo "ไม่สามารถดาวน์โหลดไฟล์ได้";
        }
    }

    /** Get Proxy from file path ./proxies.txt Define proxies in the proxies.txt file, one line per proxy
     * 
     * Format proxy username:password@host:post 
     */
    private function GetProxy()
    {
        if (file_exists($this->path . $this->filename)) {
            $rows = file($this->path . $this->filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

            if (count($rows) > 0) {
                $randomRow = $rows[array_rand($rows)];

                return $randomRow;
            } else {
                return null;
            }
        } else {
            return null;
        }
    }

    /** Coming soon, please keep an eye out for updates from us.
     *
     */
    private function CheckAndCreate()
    {
        if (!file_exists($this->path . $this->filename)) {
            $file = fopen($this->path . $this->filename, 'w');
            if ($file) {
                fclose($file);
            }
        }
    }
}
