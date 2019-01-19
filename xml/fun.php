<?php
/**
* function：XMLWriter寫XML文件
* date：2018.12.28
**/
phpinfo();
die();
$study = array();

$study[] = array('EshopId' => '205', 'OPMode' => 'A', 'EshopOrderNo' => '20181228001', 'ShopperName' => 'TEST11');
$study[] = array('EshopId' => '205', 'OPMode' => 'A', 'EshopOrderNo' => '20181228002', 'ShopperName' => 'TEST22');
$study[] = array('EshopId' => '205', 'OPMode' => 'A', 'EshopOrderNo' => '20181228003', 'ShopperName' => 'TEST33');

// print_r($study);
// exit();
 
//XML標籤配置
$xmlTag = array(
    'EshopId',
    'OPMode',
    'EshopOrderNo',
    'ShopperName'
);

$filename = '824205'.date("Ymd").'13';
$docno = '2018122812341234';
$docdate = '2018-12-28';
$parentid = '824';

$xml = new XMLWriter();
$xml->openUri($filename);
$xml->setIndentString(' ');//設定縮排格式化使用的符號
$xml->setIndent(true);
$xml->startDocument('1.0', 'big5');
$xml->startElement('OrderDoc');
$xml->startElement('DocHead');
$xml->startElement('DocNo');
$xml->text($docno);
$xml->endElement();
$xml->startElement('DocDate');
$xml->text($docdate);
$xml->endElement();
$xml->startElement('ParentId');
$xml->text($parentid);
$xml->endElement();
$xml->endElement();
$xml->startElement('DocContent');
foreach($study as $s) {
    $xml->startElement('Order');
    foreach($xmlTag as $x) {
        $xml->startElement($x);
        $xml->text($s[$x]);
        $xml->endElement();
    }
    $xml->endElement();
}
$xml->endElement();
$xml->endElement();
$xml->endDocument();
$xml->flush();

?>