<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    require_once ('application/libraries/NuSOAP.php');


    final class Danra extends CI_Controller 
    {

        /**
         * WSDL URL routeX2         : provided by Finnet Indonesia
         * @var $finchannel_url String
         */
        private $finchannel_url     = 'https://www.mcmobilecash.com/devofc/FinChannelServices/routeX2.php?wsdl';
        private $soap_return        = TRUE;


        protected function check_method($req_method = 'POST')
        {

            if ($req_method !== 'POST') 
            {
                $result             = array(
                            'resultCode'        => 'DANRA.001',
                            'resultDesc'        => 'Metode request harus HTTP POST'
                    );

                # $this->ajax->send($result);
                echo json_encode($result);
                
                exit(0);
            }

        }


        public function airtimerefill()
        {

            $this->check_method(trim($_SERVER['REQUEST_METHOD'])); # $this->input->server('REQUEST_METHOD')


            $client             = new nusoap_client($this->finchannel_url, $this->soap_return);


            if($this->input->post('transactionMethod') != NULL 
                && $this->input->post('transactionMethod') == 'TransactionAirtimePayment')
            {

                /** Prepared FUSION parameters [server initiated] for hitting to FINNET WSDL Service */
                $userName       = 'devlunari';
                $password       = 'devlunari';
                $merchantCode   = 'FNN778';
                $merchantNumber = '+6281000111001';
                $transactionType= '50';
                $amount         = '10000';
                $feeAmount      = '1000';
                $bit61          = '20160122130315';
                $traxId         = '20160122130315';
                $timeStamp      = date('d-m-Y H:i:s') . '000000'; # date('d-m-Y H:i:s')
                $mcNoHP         = '';
                $mcNoeVA        = '';
                $pin            = '';
                $changePN       = '';
                $changeAmount   = '';


                /** Received FUSION parameters [from frontends] for hitting to FINNET WSDL Service */
                $productCode    = ($this->input->post('productCode') != NULL) ? $this->input->post('productCode') : '';
                $terminal       = ($this->input->post('terminal') != NULL) ? $this->input->post('terminal') : '';
                $billNumber     = ($this->input->post('billNumber') != NULL) ? $this->input->post('billNumber') : '';


                /** Set signature by FUSION for hitting to FINNET WSDL Service */
                $signature      = @ hash('sha1', 
                            $userName . md5($password) . $productCode . $merchantCode . $terminal . $merchantNumber . $transactionType . 
                            $billNumber . $amount . $feeAmount . $bit61 . $traxId . $timeStamp);


                $data           = array
                        (
                            "userName"          => $userName,
                            "signature"         => $signature,
                            "productCode"       => $productCode,
                            "merchantCode"      => $merchantCode,
                            "terminal"          => $terminal,
                            "merchantNumber"    => $merchantNumber,
                            "transactionType"   => $transactionType,
                            "billNumber"        => $billNumber,
                            "amount"            => $amount,
                            "feeAmount"         => $feeAmount,
                            "bit61"             => $bit61,
                            "traxId"            => $traxId,
                            "timeStamp"         => $timeStamp,
                            "mcNoHP"            => $mcNoHP,
                            "mcNoeVA"           => $mcNoeVA,
                            "pin"               => $pin,
                            "changePN"          => $changePN,
                            "changeAmount"      => $changeAmount
                        );

            }
            else
            {

                

            }


            $result             = $client->call('billpayment', array('inputBillPayment' => $data));
            $this->ajax->send($result);

        }


        public function banktransfer()
        {

            $this->check_method(trim($_SERVER['REQUEST_METHOD']));


            $client             = new nusoap_client($this->finchannel_url, $this->soap_return);


            if($this->input->post('transactionMethod') != NULL 
                && $this->input->post('transactionMethod') == 'TransactionBankTransferPayment')
            {

                /** Prepared FUSION parameters [server initiated] for hitting to FINNET WSDL Service */
                $userName       = 'devlunari';
                $password       = 'devlunari';
                $merchantCode   = 'FNN778';
                $merchantNumber = '+6281000111001';
                $transactionType= '42';
                $traxId         = '20160122142415';
                $timeStamp      = date('d-m-Y H:i:s') . '000000'; # date('d-m-Y H:i:s')
                $productCode    = '007004'; # ($this->input->post('productCode') != NULL) ? $this->input->post('productCode') : '';


                /** Received FUSION parameters [from frontends] for hitting to FINNET WSDL Service */
                $terminal       = ($this->input->post('terminal') != NULL) ? $this->input->post('terminal') : '';
                $destBank       = ($this->input->post('destBank') != NULL) ? $this->input->post('destBank') : '';
                $destBankAcc    = ($this->input->post('destBankAcc') != NULL) ? $this->input->post('destBankAcc') : '';
                $destAmount     = ($this->input->post('destAmount') != NULL) ? $this->input->post('destAmount') : '';
                $senderName     = ($this->input->post('senderName') != NULL) ? $this->input->post('senderName') : '';
                $senderAddr     = ($this->input->post('senderAddress') != NULL) ? $this->input->post('senderAddress') : '';
                $senderID       = ($this->input->post('senderID') != NULL) ? $this->input->post('senderID') : '';
                $senderPhone    = ($this->input->post('senderPhone') != NULL) ? $this->input->post('senderPhone') : '';
                $senderCity     = ($this->input->post('senderCity') != NULL) ? $this->input->post('senderCity') : '';
                $senderCountry  = ($this->input->post('senderCountry') != NULL) ? $this->input->post('senderCountry') : '';
                $recvName       = ($this->input->post('recipientName') != NULL) ? $this->input->post('recipientName') : '';
                $recvPhone      = ($this->input->post('recipientPhone') != NULL) ? $this->input->post('recipientPhone') : '';
                $recvAddr       = ($this->input->post('recipientAddress') != NULL) ? $this->input->post('recipientAddress') : '';
                $recvCity       = ($this->input->post('recipientCity') != NULL) ? $this->input->post('recipientCity') : '';
                $recvCountry    = ($this->input->post('recipientCountry') != NULL) ? $this->input->post('recipientCountry') : '';
                $description    = ($this->input->post('description') != NULL) ? $this->input->post('description') : '';


                /** Received FUSION parameters [from FINNET] for hitting to FINNET WSDL Service */
                $feeAmount      = '1000';
                $refCode        = '1234567890';


                $recvAccount    = $destBank . str_pad($destBankAcc, 20, ' ', STR_PAD_LEFT);
                
                
                /** Set signature by FUSION for hitting to FINNET WSDL Service */
                $signature      = @ hash('sha1', 
                            $userName . md5($password) . $productCode . $merchantCode . $terminal . $merchantNumber . $recvAccount . 
                            $destAmount . $transactionType . $senderName . $senderAddr . $senderID . $senderPhone . $senderCity . 
                            $senderCountry . $recvName . $recvPhone . $recvAddr . $recvCity . $recvCountry . $description . 
                            $traxId . $feeAmount . $refCode . $timeStamp);


                $data           = array
                        (
                            "userName"          => $userName,
                            "signature"         => $signature,
                            "productCode"       => $productCode,
                            "merchantCode"      => $merchantCode,
                            "terminal"          => $terminal,
                            "merchantNumber"    => $merchantNumber,
                            "destBankAcc"       => $recvAccount,
                            "destAmount"        => $destAmount,
                            "transactionType"   => $transactionType,
                            "senderName"        => $senderName,
                            "senderAddress"     => $senderAddr,
                            "senderID"          => $senderID,
                            "senderPhone"       => $senderPhone,
                            "senderCity"        => $senderCity,
                            "senderCountry"     => $senderCountry,
                            "recipientName"     => $recvName,
                            "recipientPhone"    => $recvPhone,
                            "recipientAddress"  => $recvAddr,
                            "recipientCity"     => $recvCity,
                            "recipientCountry"  => $recvCountry,
                            "description"       => $description,
                            "traxId"            => $traxId,
                            "timeStamp"         => $timeStamp
                        );

            }
            else
            {

                /** Prepared FUSION parameters [server initiated] for hitting to FINNET WSDL Service */
                $userName       = 'devlunari';
                $password       = 'devlunari';
                $merchantCode   = 'FNN778';
                $merchantNumber = '+6281000111001';
                $transactionType= '41';
                $traxId         = '20160122142415';
                $timeStamp      = date('d-m-Y H:i:s') . '000000'; # date('d-m-Y H:i:s')
                $productCode    = '007004'; # ($this->input->post('productCode') != NULL) ? $this->input->post('productCode') : '';


                /** Received FUSION parameters [from frontends] for hitting to FINNET WSDL Service */
                $terminal       = ($this->input->post('terminal') != NULL) ? $this->input->post('terminal') : '';
                $destBank       = ($this->input->post('destBank') != NULL) ? $this->input->post('destBank') : '';
                $destBankAcc    = ($this->input->post('destBankAcc') != NULL) ? $this->input->post('destBankAcc') : '';
                $destAmount     = ($this->input->post('destAmount') != NULL) ? $this->input->post('destAmount') : '';
                $senderName     = ($this->input->post('senderName') != NULL) ? $this->input->post('senderName') : '';
                $senderAddr     = ($this->input->post('senderAddress') != NULL) ? $this->input->post('senderAddress') : '';
                $senderID       = ($this->input->post('senderID') != NULL) ? $this->input->post('senderID') : '';
                $senderPhone    = ($this->input->post('senderPhone') != NULL) ? $this->input->post('senderPhone') : '';
                $senderCity     = ($this->input->post('senderCity') != NULL) ? $this->input->post('senderCity') : '';
                $senderCountry  = ($this->input->post('senderCountry') != NULL) ? $this->input->post('senderCountry') : '';
                $recvName       = ($this->input->post('recipientName') != NULL) ? $this->input->post('recipientName') : '';
                $recvPhone      = ($this->input->post('recipientPhone') != NULL) ? $this->input->post('recipientPhone') : '';
                $recvAddr       = ($this->input->post('recipientAddress') != NULL) ? $this->input->post('recipientAddress') : '';
                $recvCity       = ($this->input->post('recipientCity') != NULL) ? $this->input->post('recipientCity') : '';
                $recvCountry    = ($this->input->post('recipientCountry') != NULL) ? $this->input->post('recipientCountry') : '';
                $description    = ($this->input->post('description') != NULL) ? $this->input->post('description') : '';


                $recvAccount    = $destBank . str_pad($destBankAcc, 20, ' ', STR_PAD_LEFT);


                /** Set signature by FUSION for hitting to FINNET WSDL Service */
                $signature      = @ hash('sha1', 
                            $userName . md5($password) . $productCode . $merchantCode . $terminal . $merchantNumber . $recvAccount . 
                            $destAmount . $transactionType . $senderName . $senderAddr . $senderID . $senderPhone . $senderCity . 
                            $senderCountry . $recvName . $recvPhone . $recvAddr . $recvCity . $recvCountry . $description . 
                            $traxId . $timeStamp);


                $data           = array
                        (
                            "userName"          => $userName,
                            "signature"         => $signature,
                            "productCode"       => $productCode,
                            "merchantCode"      => $merchantCode,
                            "terminal"          => $terminal,
                            "merchantNumber"    => $merchantNumber,
                            "destBankAcc"       => $recvAccount,
                            "destAmount"        => $destAmount,
                            "transactionType"   => $transactionType,
                            "senderName"        => $senderName,
                            "senderAddress"     => $senderAddr,
                            "senderID"          => $senderID,
                            "senderPhone"       => $senderPhone,
                            "senderCity"        => $senderCity,
                            "senderCountry"     => $senderCountry,
                            "recipientName"     => $recvName,
                            "recipientPhone"    => $recvPhone,
                            "recipientAddress"  => $recvAddr,
                            "recipientCity"     => $recvCity,
                            "recipientCountry"  => $recvCountry,
                            "description"       => $description,
                            "traxId"            => $traxId,
                            "timeStamp"         => $timeStamp
                        );

            }


            $result             = $client->call('remittance', array('inputRemittance' => $data));
            $this->ajax->send($result);

        }


        public function billpayment()
        {

            $this->check_method(trim($_SERVER['REQUEST_METHOD']));


            $client             = new nusoap_client($this->finchannel_url, $this->soap_return);


            if($this->input->post('transactionMethod') != NULL 
                && $this->input->post('transactionMethod') == 'TransactionBillingPayment')
            {

                /** Prepared FUSION parameters [server initiated] for hitting to FINNET WSDL Service */
                $userName       = 'devlunari';
                $password       = 'devlunari';
                $merchantCode   = 'FNN778';
                $merchantNumber = '+6281000111001';
                $transactionType= '50';
                $amount         = '000000000000';
                $feeAmount      = '0';
                $bit61          = '20160122130415';
                $traxId         = '20160122130415';
                $timeStamp      = date('d-m-Y H:i:s') . '000000'; # date('d-m-Y H:i:s')
                $mcNoHP         = '';
                $mcNoeVA        = '';
                $pin            = '';
                $changePN       = '';
                $changeAmount   = '';


                /** Received FUSION parameters [from frontends] for hitting to FINNET WSDL Service */
                $productCode    = ($this->input->post('productCode') != NULL) ? $this->input->post('productCode') : '';
                $terminal       = ($this->input->post('terminal') != NULL) ? $this->input->post('terminal') : '';
                $billNumber     = ($this->input->post('billNumber') != NULL) ? $this->input->post('billNumber') : '';


                /** Set signature by FUSION for hitting to FINNET WSDL Service */
                $signature      = @ hash('sha1', 
                            $userName . md5($password) . $productCode . $merchantCode . $terminal . $merchantNumber . $transactionType . 
                            $billNumber . $amount . $feeAmount . $bit61 . $traxId . $timeStamp);


                $data           = array
                        (
                            "userName"          => $userName,
                            "signature"         => $signature,
                            "productCode"       => $productCode,
                            "merchantCode"      => $merchantCode,
                            "terminal"          => $terminal,
                            "merchantNumber"    => $merchantNumber,
                            "transactionType"   => $transactionType,
                            "billNumber"        => $billNumber,
                            "amount"            => $amount,
                            "feeAmount"         => $feeAmount,
                            "bit61"             => $bit61,
                            "traxId"            => $traxId,
                            "timeStamp"         => $timeStamp,
                            "mcNoHP"            => $mcNoHP,
                            "mcNoeVA"           => $mcNoeVA,
                            "pin"               => $pin,
                            "changePN"          => $changePN,
                            "changeAmount"      => $changeAmount
                        );

            }
            else
            {

                /** Prepared FUSION parameters [server initiated] for hitting to FINNET WSDL Service */
                $userName       = 'devlunari';
                $password       = 'devlunari';
                $merchantCode   = 'FNN778';
                $merchantNumber = '+6281000111001';
                $transactionType= '38';
                $bit61          = '20160122130415';
                $traxId         = '20160122130415';
                $timeStamp      = date('d-m-Y H:i:s') . '000000'; # date('d-m-Y H:i:s')


                /** Received FUSION parameters [from frontends] for hitting to FINNET WSDL Service */
                $productCode    = ($this->input->post('productCode') != NULL) ? $this->input->post('productCode') : '';
                $terminal       = ($this->input->post('terminal') != NULL) ? $this->input->post('terminal') : '';
                $billNumber     = ($this->input->post('billNumber') != NULL) ? $this->input->post('billNumber') : '';


                /** Set signature by FUSION for hitting to FINNET WSDL Service */
                $signature      = @ hash('sha1', 
                            $userName . md5($password) . $productCode . $merchantCode . $terminal . $merchantNumber . $transactionType . 
                            $billNumber . $bit61 . $traxId . $timeStamp);


                $data           = array
                        (
                            "userName"          => $userName,
                            "signature"         => $signature,
                            "productCode"       => $productCode,
                            "merchantCode"      => $merchantCode,
                            "terminal"          => $terminal,
                            "merchantNumber"    => $merchantNumber,
                            "transactionType"   => $transactionType,
                            "billNumber"        => $billNumber,
                            "bit61"             => $bit61,
                            "traxId"            => $traxId,
                            "timeStamp"         => $timeStamp
                        );

            }


            $result             = $client->call('billpayment', array('inputBillPayment' => $data));
            $this->ajax->send($result);

        }


        public function cashin()
        {

            $this->check_method(trim($_SERVER['REQUEST_METHOD']));


            $client             = new nusoap_client($this->finchannel_url, $this->soap_return);


            $data               = array
                        (
                            "userName"          => $this->input->post('userName') != NULL ? $this->input->post('userName') : '',
                            "signature"         => $this->input->post('signature') != NULL ? $this->input->post('signature') : '',
                            "productCode"       => $this->input->post('productCode') != NULL ? $this->input->post('productCode') : '',
                            "merchantCode"      => $this->input->post('merchantCode') != NULL ? $this->input->post('merchantCode') : '',
                            "terminal"          => $this->input->post('terminal') != NULL ? $this->input->post('terminal') : '',
                            "merchantNumber"    => $this->input->post('merchantNumber') != NULL ? $this->input->post('merchantNumber') : '',
                            "transactionType"   => $this->input->post('transactionType') != NULL ? $this->input->post('transactionType') : '',
                            "recipientNumber"   => $this->input->post('recipientNumber') != NULL ? $this->input->post('recipientNumber') : '',
                            "recipientName"     => $this->input->post('recipientName') != NULL ? $this->input->post('recipientName') : '',
                            "amount"            => $this->input->post('amount') != NULL ? $this->input->post('amount') : '',
                            "feeAmount"         => $this->input->post('feeAmount') != NULL ? $this->input->post('feeAmount') : '',
                            "traxId"            => $this->input->post('traxId') != NULL ? $this->input->post('traxId') : '',
                            "timeStamp"         => $this->input->post('timeStamp') != NULL ? $this->input->post('timeStamp') : '',
                        );

            $result             = $client->call('cashin', array('inputCashin' => $data));
            $this->ajax->send($result);

        }


        public function cashout()
        {

            $this->check_method(trim($_SERVER['REQUEST_METHOD']));


            $client             = new nusoap_client($this->finchannel_url, $this->soap_return);


            $data               = array
                        (
                            "userName"          => $this->input->post('userName') != NULL ? $this->input->post('userName') : '',
                            "signature"         => $this->input->post('signature') != NULL ? $this->input->post('signature') : '',
                            "productCode"       => $this->input->post('productCode') != NULL ? $this->input->post('productCode') : '',
                            "merchantCode"      => $this->input->post('merchantCode') != NULL ? $this->input->post('merchantCode') : '',
                            "terminal"          => $this->input->post('terminal') != NULL ? $this->input->post('terminal') : '',
                            "merchantNumber"    => $this->input->post('merchantNumber') != NULL ? $this->input->post('merchantNumber') : '',
                            "transactionType"   => $this->input->post('transactionType') != NULL ? $this->input->post('transactionType') : '',
                            "recipientNumber"   => $this->input->post('recipientNumber') != NULL ? $this->input->post('recipientNumber') : '',
                            "recipientName"     => $this->input->post('recipientName') != NULL ? $this->input->post('recipientName') : '',
                            "amount"            => $this->input->post('amount') != NULL ? $this->input->post('amount') : '',
                            "feeAmount"         => $this->input->post('feeAmount') != NULL ? $this->input->post('feeAmount') : '',
                            "verifyingCode"     => $this->input->post('verifyingCode') != NULL ? $this->input->post('verifyingCode') : '',
                            "traxId"            => $this->input->post('traxId') != NULL ? $this->input->post('traxId') : '',
                            "timeStamp"         => $this->input->post('timeStamp') != NULL ? $this->input->post('timeStamp') : '',
                        );


            $result             = $client->call('cashout', array('inputCashout' => $data));
            $this->ajax->send($result);

        }


        public function check_balance()
        {

            $this->check_method(trim($_SERVER['REQUEST_METHOD']));


            $client             = new nusoap_client($this->finchannel_url, $this->soap_return);


            /** Prepared FUSION parameters [server initiated] for hitting to FINNET WSDL Service */
            $userName       = 'devlunari';
            $password       = 'devlunari';
            $merchantCode   = 'FNN778';
            $merchantNumber = '+6281000111001';
            $transactionType= '61';
            $traxId         = '20160122134900';
            $timeStamp      = date('d-m-Y H:i:s') . '000000'; # date('d-m-Y H:i:s')


            /** Received FUSION parameters [from frontends] for hitting to FINNET WSDL Service */
            $productCode    = ($this->input->post('productCode') != NULL) ? $this->input->post('productCode') : '';
            $terminal       = ($this->input->post('terminal') != NULL) ? $this->input->post('terminal') : '';


            /** Set signature by FUSION for hitting to FINNET WSDL Service */
            $signature      = @ hash('sha1', 
                        $userName . md5($password) . $productCode . $merchantCode . $terminal . $merchantNumber . $transactionType . 
                        $bit61 . $traxId . $timeStamp);


            $data               = array
                        (
                            "userName"          => $userName,
                            "signature"         => $signature,
                            "productCode"       => $productCode,
                            "merchantCode"      => $merchantCode,
                            "terminal"          => $terminal,
                            "merchantNumber"    => $merchantNumber,
                            "transactionType"   => $transactionType,
                            "traxId"            => $traxId,
                            "timeStamp"         => $timeStamp
                        );


            $result             = $client->call('saldoCheck', array('inputSaldo' => $data));
            $this->ajax->send($result);

        }
        

        public function debet_account()
        {

            $this->check_method(trim($_SERVER['REQUEST_METHOD']));


            $client             = new nusoap_client($this->finchannel_url, $this->soap_return);


            /** Prepared FUSION parameters [server initiated] for hitting to FINNET WSDL Service */
            $userName       = 'devlunari';
            $password       = 'devlunari';
            $merchantCode   = '';
            $merchantNumber = '';
            $transactionType= '50';
            $recipientNumber= '';
            $eVANum         = '';
            $amount         = '';
            $trxDesc        = '';
            $traxId         = '';
            $timeStamp      = ''; # date('d-m-Y H:i:s')
            $pin            = '';


            /** Received FUSION parameters [from frontends] for hitting to FINNET WSDL Service */
            $productCode    = ($this->input->post('productCode') != NULL) ? $this->input->post('productCode') : '';
            $terminal       = ($this->input->post('terminal') != NULL) ? $this->input->post('terminal') : '';


            /** Set signature by FUSION for hitting to FINNET WSDL Service */
            $signature      = @ hash('sha1', 
                        $userName . md5($password) . $productCode . $merchantCode . $terminal . $merchantNumber . $transactionType . 
                        $bit61 . $traxId . $timeStamp);


            $data               = array
                        (
                            "userName"          => $userName,
                            "signature"         => $signature,
                            "productCode"       => $productCode,
                            "merchantCode"      => $merchantCode,
                            "terminal"          => $terminal,
                            "merchantNumber"    => $merchantNumber,
                            "transactionType"   => $transactionType,
                            "recipientNumber"   => $recipientNumber,
                            "eVANum"            => $eVANum,
                            "amount"            => $amount,
                            "trxDesc"           => $trxDesc,
                            "traxId"            => $traxId,
                            "timeStamp"         => $timeStamp,
                            "pin"               => $pin
                        );


            $result             = $client->call('debetAccount', array('inputDebetAccount' => $data));
            $this->ajax->send($result);

        }


        public function donasi()
        {

            $this->check_method(trim($_SERVER['REQUEST_METHOD']));


            $client             = new nusoap_client($this->finchannel_url, $this->soap_return);


            /** Prepared FUSION parameters [server initiated] for hitting to FINNET WSDL Service */
            $userName       = 'devlunari';
            $password       = 'devlunari';
            $merchantCode   = 'FNN778';
            $merchantNumber = '+6281000111001';
            $transactionType= '60';
            $traxId         = '20160122130517';
            $timeStamp      = date('d-m-Y H:i:s') . '000000'; # date('d-m-Y H:i:s')


            /** Received FUSION parameters [from frontends] for hitting to FINNET WSDL Service */
            $productCode    = ($this->input->post('productCode') != NULL) ? $this->input->post('productCode') : '';
            $terminal       = ($this->input->post('terminal') != NULL) ? $this->input->post('terminal') : '';
            $senderName     = ($this->input->post('senderName') != NULL) ? $this->input->post('senderName') : '';
            $senderAddress  = ($this->input->post('senderAddress') != NULL) ? $this->input->post('senderAddress') : '';
            $senderPhone    = ($this->input->post('senderPhone') != NULL) ? $this->input->post('senderPhone') : '';
            $amount         = ($this->input->post('amount') != NULL) ? $this->input->post('amount') : '';


            /** Set signature by FUSION for hitting to FINNET WSDL Service */
            $signature      = @ hash('sha1', 
                        $userName . md5($password) . $productCode . $merchantCode . $terminal . $merchantNumber . $transactionType . 
                        $senderName . $senderAddress . $senderPhone . $amount . $traxId . $timeStamp);


            $data               = array
                        (
                            "userName"          => $userName,
                            "signature"         => $signature,
                            "productCode"       => $productCode,
                            "merchantCode"      => $merchantCode,
                            "terminal"          => $terminal,
                            "merchantNumber"    => $merchantNumber,
                            "transactionType"   => $transactionType,
                            "senderName"        => $senderName,
                            "senderAddress"     => $senderAddress,
                            "senderPhone"       => $senderPhone,
                            "amount"            => $amount,
                            "traxId"            => $traxId,
                            "timeStamp"         => $timeStamp,
                        );


            $result             = $client->call('donasi', array('inputDonasi' => $data));
            $this->ajax->send($result);

        }


        public function remittance()
        {

            $this->check_method(trim($_SERVER['REQUEST_METHOD']));


            $client             = new nusoap_client($this->finchannel_url, $this->soap_return);


            $data               = array
                        (
                            "userName"          => $this->input->post('userName') != NULL ? $this->input->post('userName') : '',
                            "signature"         => $this->input->post('signature') != NULL ? $this->input->post('signature') : '',
                            "productCode"       => $this->input->post('productCode') != NULL ? $this->input->post('productCode') : '',
                            "merchantCode"      => $this->input->post('merchantCode') != NULL ? $this->input->post('merchantCode') : '',
                            "terminal"          => $this->input->post('terminal') != NULL ? $this->input->post('terminal') : '',
                            "merchantNumber"    => $this->input->post('merchantNumber') != NULL ? $this->input->post('merchantNumber') : '',
                            "destBankAcc"       => $this->input->post('destBankAcc') != NULL ? $this->input->post('destBankAcc') : '',
                            "destAmount"        => $this->input->post('destAmount') != NULL ? $this->input->post('destAmount') : '',
                            "transactionType"   => $this->input->post('transactionType') != NULL ? $this->input->post('transactionType') : '',
                            "senderName"        => $this->input->post('senderName') != NULL ? $this->input->post('senderName') : '',
                            "senderAddress"     => $this->input->post('senderAddress') != NULL ? $this->input->post('senderAddress') : '',
                            "senderID"          => $this->input->post('senderID') != NULL ? $this->input->post('senderID') : '',
                            "senderPhone"       => $this->input->post('senderPhone') != NULL ? $this->input->post('senderPhone') : '',
                            "senderCity"        => $this->input->post('senderCity') != NULL ? $this->input->post('senderCity') : '',
                            "senderCountry"     => $this->input->post('senderCountry') != NULL ? $this->input->post('senderCountry') : '',
                            "recipientName"     => $this->input->post('recipientName') != NULL ? $this->input->post('recipientName') : '',
                            "recipientPhone"    => $this->input->post('recipientPhone') != NULL ? $this->input->post('recipientPhone') : '',
                            "recipientAddress"  => $this->input->post('recipientAddress') != NULL ? $this->input->post('recipientAddress') : '',
                            "recipientCity"     => $this->input->post('recipientCity') != NULL ? $this->input->post('recipientCity') : '',
                            "recipientCountry"  => $this->input->post('recipientCountry') != NULL ? $this->input->post('recipientCountry') : '',
                            "description"       => $this->input->post('description') != NULL ? $this->input->post('description') : '',
                            "traxId"            => $this->input->post('traxId') != NULL ? $this->input->post('traxId') : '',
                            "feeAmount"         => $this->input->post('feeAmount') != NULL ? $this->input->post('feeAmount') : '',
                            "refCode"           => $this->input->post('refCode') != NULL ? $this->input->post('refCode') : '',
                            "payCode"           => $this->input->post('payCode') != NULL ? $this->input->post('payCode') : '',
                            "recepientId"       => $this->input->post('recepientId') != NULL ? $this->input->post('recepientId') : '',
                            "recepientProvince" => $this->input->post('recepientProvince') != NULL ? $this->input->post('recepientProvince') : '',
                            "timeStamp"         => $this->input->post('timeStamp') != NULL ? $this->input->post('timeStamp') : '',
                        );

            $result             = $client->call('remittance', array('inputRemittance' => $data));
            $this->ajax->send($result);

        }


        /** public function reserve()
        {

            $this->check_method(trim($_SERVER['REQUEST_METHOD']));


            $client             = new nusoap_client($this->finchannel_url, $this->soap_return);


            $data               = array
                        (
                            "userName"          => $this->input->post('userName') != NULL ? $this->input->post('userName') : '',
                            "signature"         => $this->input->post('signature') != NULL ? $this->input->post('signature') : '',
                            "productCode"       => $this->input->post('productCode') != NULL ? $this->input->post('productCode') : '',
                            "merchantCode"      => $this->input->post('merchantCode') != NULL ? $this->input->post('merchantCode') : '',
                            "terminal"          => $this->input->post('terminal') != NULL ? $this->input->post('terminal') : '',
                            "merchantNumber"    => $this->input->post('merchantNumber') != NULL ? $this->input->post('merchantNumber') : '',
                            "transactionType"   => $this->input->post('transactionType') != NULL ? $this->input->post('transactionType') : '',
                            "amount"            => $this->input->post('amount') != NULL ? $this->input->post('amount') : '',
                            "traxId"            => $this->input->post('traxId') != NULL ? $this->input->post('traxId') : '',
                            "timeStamp"         => $this->input->post('timeStamp') != NULL ? $this->input->post('timeStamp') : '',
                        );

            $result             = $client->call('reserve', array('inputReserve' => $data));
            $this->ajax->send($result);

        }

        public function creator()
        {

            $this->check_method(trim($_SERVER['REQUEST_METHOD']));


            $client             = new nusoap_client($this->finchannel_url, $this->soap_return);


            $data               = array();
            $result             = $client->call('Creator');

            $this->ajax->send($result);

        }


        public function mcpay()
        {

            $this->check_method(trim($_SERVER['REQUEST_METHOD']));


            $client             = new nusoap_client($this->finchannel_url, $this->soap_return);


            $data               = array
                        (
                            "userName"          => $this->input->post('userName') != NULL ? $this->input->post('userName') : '',
                            "signature"         => $this->input->post('signature') != NULL ? $this->input->post('signature') : '',
                            "productCode"       => $this->input->post('productCode') != NULL ? $this->input->post('productCode') : '',
                            "merchantCode"      => $this->input->post('merchantCode') != NULL ? $this->input->post('merchantCode') : '',
                            "terminal"          => $this->input->post('terminal') != NULL ? $this->input->post('terminal') : '',
                            "merchantNumber"    => $this->input->post('merchantNumber') != NULL ? $this->input->post('merchantNumber') : '',
                            "transactionType"   => $this->input->post('transactionType') != NULL ? $this->input->post('transactionType') : '',
                            "recipientNumber"   => $this->input->post('recipientNumber') != NULL ? $this->input->post('recipientNumber') : '',
                            "amount"            => $this->input->post('amount') != NULL ? $this->input->post('amount') : '',
                            "traxId"            => $this->input->post('traxId') != NULL ? $this->input->post('traxId') : '',
                            "timeStamp"         => $this->input->post('timeStamp') != NULL ? $this->input->post('timeStamp') : '',
                            "counterCode"       => $this->input->post('counterCode') != NULL ? $this->input->post('counterCode') : '',
                            "verCode"           => $this->input->post('verCode') != NULL ? $this->input->post('verCode') : '',
                        );

            $result             = $client->call('MCPay', array('input' => $data));
            $this->ajax->send($result);

        } */

    }