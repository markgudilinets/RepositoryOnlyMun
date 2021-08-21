$siteList = Local\Project\Site::getList('UF_IBLOCK', ['filter' => ['UF_ACTIVE' => true], 'order'=>["ID"=>"ASC"]]);
$bDate = date("d.m.Y H:i:s", mktime(0, 0, 0, date("m"), date("d")));

$providers = Local\Hlblock\Provider::getList(
    'UF_XML_ID',
        ['filter'=>
       
            ["UF_ACTIVE" => 1,
                "LOGIC"=>"OR",
                [
                    "<UF_DATE_UPDATE"=>$bDate
                ],
                [
                    "UF_DATE_UPDATE"=>false
                ]                      

            ],
         'select'=>['ID','UF_XML_ID'],
         'order'=>["UF_SORT_ID"=>"ASC"]
        ]
     );
$arResult['COPY_ITEMS'] = Local\Hlblock\CopyElement::getList('UF_PRODUCT_ID', [/*'limit'=> 50,*/'order'=>["ID"=>"DESC"]]);

$arCopy = [];
$arOrigin = [];
foreach ($arResult['COPY_ITEMS'] as $key => $value) {
    if(in_array($key, $arCopy) == false){
            $arOrigin[] = $key;
            foreach ($value as $val) {
            $arCopy[] = $val;
        }
    }
}
