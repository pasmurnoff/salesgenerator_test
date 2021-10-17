<?php
$subdomain = 'elenasg77';
$link = 'https://' . $subdomain . '.amocrm.ru/api/v2/account';

$access_token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImE2MGZiNzY0NjQyMTYyYWVjMjEyN2Y4MDE5NjhmOTAyN2ZjMzg5MDIzYTA0ZWI2MTE4MmYzN2Y0NDc1OWZkYjI4YzcwM2EyZGNjZTkyNzI3In0.eyJhdWQiOiJhYzYwZGVmOS05YjQ4LTQwNTctYWI4ZS1hOGQ4OWJkODg3NTciLCJqdGkiOiJhNjBmYjc2NDY0MjE2MmFlYzIxMjdmODAxOTY4ZjkwMjdmYzM4OTAyM2EwNGViNjExODJmMzdmNDQ3NTlmZGIyOGM3MDNhMmRjY2U5MjcyNyIsImlhdCI6MTYzNDQxMTkxNSwibmJmIjoxNjM0NDExOTE1LCJleHAiOjE2MzQ0OTgzMTUsInN1YiI6Ijc1MTI4ODYiLCJhY2NvdW50X2lkIjoyOTc0NDUzNiwic2NvcGVzIjpbInB1c2hfbm90aWZpY2F0aW9ucyIsImNybSIsIm5vdGlmaWNhdGlvbnMiXX0.rabYZsJWihT7IcI8VM4-c4MX6u9nS6NGo_cAeu2U0chi2uCs9I1XsHyWNXAJlRgbLPjYWCQWioC3SjTixTWIJBGtIfNRLTxA3ULJ1UkG0PLkmprzPa4oM5LO83qwJMUvx1LvoZOL5RlX6VEUKuPfKOmkRzh_Ek0O0PSXESVbqP6Kz_uSsa0zxmChUoC-cJaFN0HINMdbyCC8v_rk1Q5LukIWMMyjjHDAJfi4rsXSwyO2s10JA9GlHKgYfflNBJcP7_bXyvVzBAQP8MuDI8R0xf3q8GrwEC1y0NAMVLx9Vsqa-ZsaT6BqnBQfPIm8OGsC5xKjjbc5eVPBrb1Fa3g-yw';

$refresh = 'def50200a63aacbb37d464f85c4363851311ca80094fa81e7af9ffa1a0e1e21f64295b0e1cc239dfa6f25480118f45c81cf38922d5522f0b6ee67a1fee9473d72d9654a26f65934fef022f6ce52a6116a62ee793c47de72e02d1606227844090b8effcffa86c02297c678be7ab79fad728a1fca6f0bc022a161862d7bef0b3e59cd69225263456f473f882cb4a2da3678f8ddc34e41cb932905f57d0f61290aa992a7397e195e1edfbf1772fd69c7c9c7816d3cc9af5c5512b5ba5ccfd1b956a3aaeae4fbf20cdd73bbc9ef22a8aee215bdfd9fecf18f9117e914595a573c81d409f72cfeda82451282bc8252d3ffe5a29a1de64c35ff59a22e2729ae0a898838b7fbea9371c573e3b69a97bf71beda77fe2afae2c08a8b9d66f50fb98a013359865ff11922633a6cd3529a6db0431ba7c89e9b12049a563c0fc0c6dba45c5376d3923a24528c1af6dd7ab45f1effced7a1acf68a10fefa07ba9919a037baf8174e07f45c052c8e33431429627bec9940c769b2022ead4be6b3ddbc45cb212b60f75d78006165cc09bdbf518cc6e2776c8e36bbed5e582579bb5e7e9bd75b084d6d1317b0c6c877a9b84ca92d01915b8a193aba24939ea9c40d2b4901f64f94147db33a8327d497c77d0';
$headers = [
    'Authorization: Bearer ' . $access_token
];

$curl = curl_init();

curl_setopt($curl,CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl,CURLOPT_USERAGENT,'amoCRM-oAuth-client/1.0');
curl_setopt($curl,CURLOPT_URL, $link);
curl_setopt($curl,CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl,CURLOPT_HEADER, false);
curl_setopt($curl,CURLOPT_SSL_VERIFYPEER, 1);
curl_setopt($curl,CURLOPT_SSL_VERIFYHOST, 2);
$out = curl_exec($curl);
$code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
curl_close($curl);

$code = (int)$code;
$errors = [
    400 => 'Bad request',
    401 => 'Unauthorized',
    403 => 'Forbidden',
    404 => 'Not found',
    500 => 'Internal server error',
    502 => 'Bad gateway',
    503 => 'Service unavailable',
];

try
{
    if ($code < 200 || $code > 204) {
        throw new Exception(isset($errors[$code]) ? $errors[$code] : 'Undefined error', $code);
    }
}
catch(\Exception $e)
{
    die('Ошибка: ' . $e->getMessage() . PHP_EOL . 'Код ошибки: ' . $e->getCode());
}

$arrContactParams = [

    "PRODUCT" => [
        "namePerson"	=> "Заявка Пасмурнов",
        "phonePerson"	=> $_POST['phone'],
        "emailPerson"	=> $_POST['email'],
    ],

    "CONTACT" => [
        "namePerson"	=> "Пасмурнов Александр",
        "phonePerson"	=> $_POST['phone'],
        "emailPerson"	=> $_POST['email'],
    ]
];

function amoAddTask($access_token, $arrContactParams, $contactId=false ) {
    $arrTaskParams = [
        'add' => [
            0 => [
                'name'  => $arrContactParams["PRODUCT"]["namePerson"],
                'price'         => '0',
                'tags'          => [
                    'Тест',
                    $arrContactParams["PRODUCT"]["namePerson"]
                ],
                'contacts_id' => [
                    0 => $contactId
                ],
            ],
        ],
    ];


    $link = "https://elenasg77.amocrm.ru/api/v2/leads";

    $headers = [
        "Accept: application/json",
        'Authorization: Bearer ' . $access_token
    ];
    //var_dump(json_encode($arrTaskParams));
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
    curl_setopt($curl, CURLOPT_USERAGENT, "amoCRM-API-client-
	undefined/2.0");
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($arrTaskParams));
    curl_setopt($curl, CURLOPT_URL, $link);
    curl_setopt($curl, CURLOPT_HEADER,false);
    curl_setopt($curl,CURLOPT_COOKIEFILE,dirname(__FILE__)."/cookie.txt");
    curl_setopt($curl,CURLOPT_COOKIEJAR,dirname(__FILE__)."/cookie.txt");
    $out = curl_exec($curl);
    return curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);
    $result = json_decode($out,TRUE);
    //return curl_getinfo($curl, CURLINFO_HTTP_CODE);
}

function amoAddContact($access_token, $arrContactParams) {
    $contacts['request']['contacts']['add'] = array(
        [
            'name' => $arrContactParams["CONTACT"]["namePerson"],
            'phone_number' => $arrContactParams["CONTACT"]["phonePerson"],
            'email' => $arrContactParams["CONTACT"]["emailPerson"],
            'tags' => 'Тестовое задание',
            'custom_fields'	=> [
                // ТЕЛЕФОН
                [
                    'id'	=> 504775,
                    "values" => [
                        [
                            "value" =>$arrContactParams["CONTACT"]["phonePerson"],
                            "enum" => 'WORK'
                        ]
                    ]
                ],

                // email
                [
                    'id'	=> 504777,
                    "values" => [
                        [
                            "value" =>$arrContactParams["CONTACT"]["emailPerson"],
                            "enum" => 'WORK'
                        ]
                    ]
                ],
            ]
        ]
    );



    $headers = [
        "Accept: application/json",
        'Authorization: Bearer ' . $access_token
    ];

    $link='https://elenasg77.amocrm.ru/private/api/v2/json/contacts/set';

    $curl = curl_init();
    /** Устанавливаем необходимые опции для сеанса cURL  */
    curl_setopt($curl,CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl,CURLOPT_USERAGENT,'amoCRM-oAuth-client/1.0');
    curl_setopt($curl,CURLOPT_URL, $link);
    curl_setopt($curl,CURLOPT_CUSTOMREQUEST,'POST');
    curl_setopt($curl,CURLOPT_POSTFIELDS,json_encode($contacts));
    curl_setopt($curl,CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl,CURLOPT_HEADER, false);
    curl_setopt($curl,CURLOPT_SSL_VERIFYPEER, 1);
    curl_setopt($curl,CURLOPT_SSL_VERIFYHOST, 2);
    $out=curl_exec($curl);
    $code=curl_getinfo($curl,CURLINFO_HTTP_CODE);
    curl_close($curl);
    $Response=json_decode($out,true);
 //   $account=$Response['response']['account'];
// echo '<b>Данные о пользователе:</b>'; echo '<pre>'; print_r($Response); echo '</pre>';
    return $Response["response"]["contacts"]["add"]["0"]["id"];

    //amoAddTask($access_token, $arrContactParams, $Response["response"]["contacts"]["add"]["0"]["id"]);
//    return $Response["response"]["contacts"]["add"]["0"]["id"];
}

$contactid = amoAddContact($access_token, $arrContactParams);

while (true){
    $code = amoAddTask($access_token, $arrContactParams, $contactid);
    if ($code != '400'){
        break;
    }
}
//var_dump(amoAddTask($access_token, $arrContactParams, $contactid));


function sendMail() {
    $to = 'order@salesgenerator.pro';
    $subject = 'Сообщение с сайта';
    $message = '
                <html>
                    <head>
                        <title>Заявка Пасмурнов</title>
                    </head>
                    <body>
                        <p><b>Имя:</b> Пасмурнов Александр </p>  
                        <p><b>Телефон:</b> '.$_POST['phone'].'</p>  
                        <p><b>email:</b> '.$_POST['email'].'</p> 
                    </body>
                </html>';
    $headers  = "Content-type: text/html; charset=utf-8 \r\n";
    $headers .= "From: Site <info@mail.com>\r\n";
    mail($to, $subject, $message, $headers);
}

sendMail();
?>
<html>
<head>
    <title>Тестовое задание</title>
    <meta charset="utf-8">
    <link href="css/styles.css" rel="stylesheet" type="text/css">
</head>
<div class="success-block">
    <img src="images/success.png">
    <h1>Спасибо, ваша заявка отправлена!</h1>
    <a href="/">Вернуться на главную</a>
</div>

