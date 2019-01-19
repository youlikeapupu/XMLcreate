//針對7.net需要的XML格式產生
function gen_xml()
    {

        //sin log 檔
        //$log = 'D:/source/log/seven/sin'.date("Y-m-d").'.log';

        $xml_arr = array();
        $xml_arr[] = array(
            'EshopId' => '205',
            'OPMode' => 'A',
            'EshopOrderNo' => '20190119010',
            'EshopOrderDate' => '2019-01-15',
            'ServiceType' => '1',
            'ShopperName' => '七七七',
            'ShopperPhone' => '',
            'ShopperMobilPhone' => '',
            'ShopperEmail' => '',
            'ReceiverName' => '七七七',
            'ReceiverPhone' => '',
            'ReceiverMobilPhone' => '0927556600',
            'ReceiverEmail' => 'kim.chiu0@devilcase.com.tw',
            'ReceiverIDNumber' => '',
            'OrderAmount' => '199',
            'OrderDetail' => array('ProductId' => '',
                                   'ProductName' => '',
                                   'Quantity' => '',
                                   'Unit' => '',
                                   'UnitPrice' => ''),
            'ShipmentDetail' => array('ShipmentNo' => '74901021',
                                      'ShipDate' => '2019-01-19',
                                      'ReturnDate' => '2019-01-26',
                                      'LastShipment' => 'N',
                                      'ShipmentAmount' => '199',
                                      'StoreId' => '965150',
                                      'EshopType' => '04')
                            );
        $xml_arr[] = array(
            'EshopId' => '205',
            'OPMode' => 'A',
            'EshopOrderNo' => '20190119011',
            'EshopOrderDate' => '2019-01-15',
            'ServiceType' => '1',
            'ShopperName' => '八八八',
            'ShopperPhone' => '',
            'ShopperMobilPhone' => '',
            'ShopperEmail' => '',
            'ReceiverName' => '八八八',
            'ReceiverPhone' => '',
            'ReceiverMobilPhone' => '0927556600',
            'ReceiverEmail' => 'kim.chiu0@devilcase.com.tw',
            'ReceiverIDNumber' => '',
            'OrderAmount' => '299',
            'OrderDetail' => array('ProductId' => '',
                                   'ProductName' => '',
                                   'Quantity' => '',
                                   'Unit' => '',
                                   'UnitPrice' => ''),
            'ShipmentDetail' => array('ShipmentNo' => '74901022',
                                      'ShipDate' => '2019-01-19',
                                      'ReturnDate' => '2019-01-26',
                                      'LastShipment' => 'N',
                                      'ShipmentAmount' => '299',
                                      'StoreId' => '965150',
                                      'EshopType' => '04')
                            );

        //dd($xml_arr);

        //$filename = '../resources/AAA'.date("Ymd").'13A';
        $docno = '2019011900001235';
        $docdate = '2019-01-19';
        $parentid = '824';

        $xml = new XMLWriter();

        //$xml->openUri($filename);
        $xml->openMemory();
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

        foreach($xml_arr as $s => $sv) {
            $xml->startElement('Order');
            foreach ($sv as $ok => $ov) {
                if (count($ov)> 1) {
                    $xml->startElement($ok);
                    foreach ($ov as $de => $det) {
                        $xml->startElement($de);
                        $xml->text($det);
                        $xml->endElement();
                    }
                    $xml->endElement();
                }else{
                    $xml->startElement($ok);
                    $xml->text($ov);
                    $xml->endElement();
                }
            }
            $xml->endElement();
        }
        $xml->endElement();
        $xml->endElement();
        $xml->endDocument();
        $r = $xml->flush();
        // echo $r;
        //SIN xml檔名
        $filename = '824205'.date("Ymd").'002'.'.xml';
        //新增xml檔
        $supName = 'D:/source/resources/'.$filename;
        $fp = fopen($supName,"w");
        $txt = $r;
        fwrite($fp, $txt);
        //關閉檔案
        fclose($fp);
        //上傳至7.net主機
        $target = 'SIN';
        $this->seven_upload($filename, $target);
        //產生SIN log
        //$this->seven_log($filename,'sin');

    }
