<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once('application/libraries/nusoap.php');

class Eva extends CI_Controller {

    /**
     * WSDL url for routeX2
     * @var string
     */
    private $url = 'https://www.mcmobilecash.com/devofc/FinChannelServices/routeX2.php?wsdl';

    public function cashin(){

        if ($this->input->server('REQUEST_METHOD') !== 'POST') {
            exit('Unauthorized access!');
        }

        $url=$this->url;
        $client = new nusoap_client($url,true);
        $data=array(
            "userName" => $this->input->post('userName') != FALSE ? $this->input->post('userName') : '',
            "signature" => $this->input->post('signature') != FALSE ? $this->input->post('signature') : '',
            "productCode" => $this->input->post('productCode') != FALSE ? $this->input->post('productCode') : '',
            "merchantCode" => $this->input->post('merchantCode') != FALSE ? $this->input->post('merchantCode') : '',
            "terminal" => $this->input->post('terminal') != FALSE ? $this->input->post('terminal') : '',
            "merchantNumber" => $this->input->post('merchantNumber') != FALSE ? $this->input->post('merchantNumber') : '',
            "transactionType" => $this->input->post('transactionType') != FALSE ? $this->input->post('transactionType') : '',
            "recipientNumber" => $this->input->post('recipientNumber') != FALSE ? $this->input->post('recipientNumber') : '',
            "recipientName" => $this->input->post('recipientName') != FALSE ? $this->input->post('recipientName') : '',
            "amount" => $this->input->post('amount') != FALSE ? $this->input->post('amount') : '',
            "feeAmount" => $this->input->post('feeAmount') != FALSE ? $this->input->post('feeAmount') : '',
            "traxId" => $this->input->post('traxId') != FALSE ? $this->input->post('traxId') : '',
            "timeStamp" => $this->input->post('timeStamp') != FALSE ? $this->input->post('timeStamp') : '',
        );
        $result = $client->call('cashin',array('inputCashin' => $data));
        $this->ajax->send($result);
    }

    public function cashout(){

        if ($this->input->server('REQUEST_METHOD') !== 'POST') {
            exit('Unauthorized access!');
        }

        $url=$this->url;
        $client = new nusoap_client($url,true);
        $data=array(
            "userName" => $this->input->post('userName') != FALSE ? $this->input->post('userName') : '',
            "signature" => $this->input->post('signature') != FALSE ? $this->input->post('signature') : '',
            "productCode" => $this->input->post('productCode') != FALSE ? $this->input->post('productCode') : '',
            "merchantCode" => $this->input->post('merchantCode') != FALSE ? $this->input->post('merchantCode') : '',
            "terminal" => $this->input->post('terminal') != FALSE ? $this->input->post('terminal') : '',
            "merchantNumber" => $this->input->post('merchantNumber') != FALSE ? $this->input->post('merchantNumber') : '',
            "transactionType" => $this->input->post('transactionType') != FALSE ? $this->input->post('transactionType') : '',
            "recipientNumber" => $this->input->post('recipientNumber') != FALSE ? $this->input->post('recipientNumber') : '',
            "recipientName" => $this->input->post('recipientName') != FALSE ? $this->input->post('recipientName') : '',
            "amount" => $this->input->post('amount') != FALSE ? $this->input->post('amount') : '',
            "feeAmount" => $this->input->post('feeAmount') != FALSE ? $this->input->post('feeAmount') : '',
            "verifyingCode" => $this->input->post('verifyingCode') != FALSE ? $this->input->post('verifyingCode') : '',
            "traxId" => $this->input->post('traxId') != FALSE ? $this->input->post('traxId') : '',
            "timeStamp" => $this->input->post('timeStamp') != FALSE ? $this->input->post('timeStamp') : '',
        );
        $result = $client->call('cashout',array('inputCashout' => $data));
        $this->ajax->send($result);
    }


    public function billpayment(){

        if ($this->input->server('REQUEST_METHOD') !== 'POST') {
            exit('Unauthorized access!');
        }

        $url=$this->url;
        $client = new nusoap_client($url,true);
        $data=array(
            "userName" => $this->input->post('userName') != FALSE ? $this->input->post('userName') : '',
            "signature" => $this->input->post('signature') != FALSE ? $this->input->post('signature') : '',
            "productCode" => $this->input->post('productCode') != FALSE ? $this->input->post('productCode') : '',
            "merchantCode" => $this->input->post('merchantCode') != FALSE ? $this->input->post('merchantCode') : '',
            "terminal" => $this->input->post('terminal') != FALSE ? $this->input->post('terminal') : '',
            "merchantNumber" => $this->input->post('merchantNumber') != FALSE ? $this->input->post('merchantNumber') : '',
            "transactionType" => $this->input->post('transactionType') != FALSE ? $this->input->post('transactionType') : '',
            "billNumber" => $this->input->post('billNumber') != FALSE ? $this->input->post('billNumber') : '',
            "amount" => $this->input->post('amount') != FALSE ? $this->input->post('amount') : '',
            "feeAmount" => $this->input->post('feeAmount') != FALSE ? $this->input->post('feeAmount') : '',
            "bit61" => $this->input->post('bit61') != FALSE ? $this->input->post('bit61') : '',
            "traxId" => $this->input->post('traxId') != FALSE ? $this->input->post('traxId') : '',
            "timeStamp" => $this->input->post('timeStamp') != FALSE ? $this->input->post('timeStamp') : '',
            "mcNoHP" => $this->input->post('mcNoHP') != FALSE ? $this->input->post('mcNoHP') : '',
            "mcNoeVA" => $this->input->post('mcNoeVA') != FALSE ? $this->input->post('mcNoeVA') : '',
            "pin" => $this->input->post('pin') != FALSE ? $this->input->post('pin') : '',
            "changePN" => $this->input->post('changePN') != FALSE ? $this->input->post('changePN') : '',
            "changeAmount" => $this->input->post('changeAmount') != FALSE ? $this->input->post('changeAmount') : '',
        );
        $result = $client->call('billpayment',array('inputBillPayment' => $data));
        $this->ajax->send($result);
    }

     public function remittance(){
        if ($this->input->server('REQUEST_METHOD') !== 'POST') {
            exit('Unauthorized access!');
        }

        $url=$this->url;
        $client = new nusoap_client($url,true);
        $data=array(
            "userName" => $this->input->post('userName') != FALSE ? $this->input->post('userName') : '',
            "signature" => $this->input->post('signature') != FALSE ? $this->input->post('signature') : '',
            "productCode" => $this->input->post('productCode') != FALSE ? $this->input->post('productCode') : '',
            "merchantCode" => $this->input->post('merchantCode') != FALSE ? $this->input->post('merchantCode') : '',
            "terminal" => $this->input->post('terminal') != FALSE ? $this->input->post('terminal') : '',
            "merchantNumber" => $this->input->post('merchantNumber') != FALSE ? $this->input->post('merchantNumber') : '',
            "destBankAcc" => $this->input->post('destBankAcc') != FALSE ? $this->input->post('destBankAcc') : '',
            "destAmount" => $this->input->post('destAmount') != FALSE ? $this->input->post('destAmount') : '',
            "transactionType" => $this->input->post('transactionType') != FALSE ? $this->input->post('transactionType') : '',
            "senderName" => $this->input->post('senderName') != FALSE ? $this->input->post('senderName') : '',
            "senderAddress" => $this->input->post('senderAddress') != FALSE ? $this->input->post('senderAddress') : '',
            "senderID" => $this->input->post('senderID') != FALSE ? $this->input->post('senderID') : '',
            "senderPhone" => $this->input->post('senderPhone') != FALSE ? $this->input->post('senderPhone') : '',
            "senderCity" => $this->input->post('senderCity') != FALSE ? $this->input->post('senderCity') : '',
            "senderCountry" => $this->input->post('senderCountry') != FALSE ? $this->input->post('senderCountry') : '',
            "recipientName" => $this->input->post('recipientName') != FALSE ? $this->input->post('recipientName') : '',
            "recipientPhone" => $this->input->post('recipientPhone') != FALSE ? $this->input->post('recipientPhone') : '',
            "recipientAddress" => $this->input->post('recipientAddress') != FALSE ? $this->input->post('recipientAddress') : '',
            "recipientCity" => $this->input->post('recipientCity') != FALSE ? $this->input->post('recipientCity') : '',
            "recipientCountry" => $this->input->post('recipientCountry') != FALSE ? $this->input->post('recipientCountry') : '',
            "description" => $this->input->post('description') != FALSE ? $this->input->post('description') : '',
            "traxId" => $this->input->post('traxId') != FALSE ? $this->input->post('traxId') : '',
            "feeAmount" => $this->input->post('feeAmount') != FALSE ? $this->input->post('feeAmount') : '',
            "refCode" => $this->input->post('refCode') != FALSE ? $this->input->post('refCode') : '',
            "payCode" => $this->input->post('payCode') != FALSE ? $this->input->post('payCode') : '',
            "recepientId" => $this->input->post('recepientId') != FALSE ? $this->input->post('recepientId') : '',
            "recepientProvince" => $this->input->post('recepientProvince') != FALSE ? $this->input->post('recepientProvince') : '',
            "timeStamp" => $this->input->post('timeStamp') != FALSE ? $this->input->post('timeStamp') : '',
        );
        $result = $client->call('remittance',array('inputRemittance' => $data));
        $this->ajax->send($result);
    }

     public function donasi(){

        if ($this->input->server('REQUEST_METHOD') !== 'POST') {
            exit('Unauthorized access!');
        }

        $url=$this->url;
        $client = new nusoap_client($url,true);
        $data=array(
            "userName" => $this->input->post('userName') != FALSE ? $this->input->post('userName') : '',
            "signature" => $this->input->post('signature') != FALSE ? $this->input->post('signature') : '',
            "productCode" => $this->input->post('productCode') != FALSE ? $this->input->post('productCode') : '',
            "merchantCode" => $this->input->post('merchantCode') != FALSE ? $this->input->post('merchantCode') : '',
            "terminal" => $this->input->post('terminal') != FALSE ? $this->input->post('terminal') : '',
            "merchantNumber" => $this->input->post('merchantNumber') != FALSE ? $this->input->post('merchantNumber') : '',
            "transactionType" => $this->input->post('transactionType') != FALSE ? $this->input->post('transactionType') : '',
            "senderName" => $this->input->post('senderName') != FALSE ? $this->input->post('senderName') : '',
            "senderAddress" => $this->input->post('senderAddress') != FALSE ? $this->input->post('senderAddress') : '',
            "senderPhone" => $this->input->post('senderPhone') != FALSE ? $this->input->post('senderPhone') : '',
            "amount" => $this->input->post('amount') != FALSE ? $this->input->post('amount') : '',
            "traxId" => $this->input->post('traxId') != FALSE ? $this->input->post('traxId') : '',
            "timeStamp" => $this->input->post('timeStamp') != FALSE ? $this->input->post('timeStamp') : '',
        );
        $result = $client->call('donasi',array('inputDonasi' => $data));
        $this->ajax->send($result);
    }


    public function saldo_check(){

        if ($this->input->server('REQUEST_METHOD') !== 'POST') {
            exit('Unauthorized access!');
        }

        $url=$this->url;
        $client = new nusoap_client($url,true);
        $data = array(
            "userName" => $this->input->post('userName') != FALSE ? $this->input->post('userName') : '',
            "signature" => $this->input->post('signature') != FALSE ? $this->input->post('signature') : '',
            "productCode" => $this->input->post('productCode') != FALSE ? $this->input->post('productCode') : '',
            "merchantCode" => $this->input->post('merchantCode') != FALSE ? $this->input->post('merchantCode') : '',
            "terminal" => $this->input->post('terminal') != FALSE ? $this->input->post('terminal') : '',
            "merchantNumber" => $this->input->post('merchantNumber') != FALSE ? $this->input->post('merchantNumber') : '',
            "transactionType" => $this->input->post('transactionType') != FALSE ? $this->input->post('transactionType') : '',
            "traxId" => $this->input->post('traxId') != FALSE ? $this->input->post('traxId') : '',
            "timeStamp" => $this->input->post('timeStamp') != FALSE ? $this->input->post('timeStamp') : '',
        );
        $result = $client->call('saldoCheck',array('inputSaldo' => $data));
        $this->ajax->send($result);
    }

    public function reserve(){

        if ($this->input->server('REQUEST_METHOD') !== 'POST') {
            exit('Unauthorized access!');
        }

        $url=$this->url;
        $client = new nusoap_client($url,true);
        $data = array(
            "userName" => $this->input->post('userName') != FALSE ? $this->input->post('userName') : '',
            "signature" => $this->input->post('signature') != FALSE ? $this->input->post('signature') : '',
            "productCode" => $this->input->post('productCode') != FALSE ? $this->input->post('productCode') : '',
            "merchantCode" => $this->input->post('merchantCode') != FALSE ? $this->input->post('merchantCode') : '',
            "terminal" => $this->input->post('terminal') != FALSE ? $this->input->post('terminal') : '',
            "merchantNumber" => $this->input->post('merchantNumber') != FALSE ? $this->input->post('merchantNumber') : '',
            "transactionType" => $this->input->post('transactionType') != FALSE ? $this->input->post('transactionType') : '',
            "amount" => $this->input->post('amount') != FALSE ? $this->input->post('amount') : '',
            "traxId" => $this->input->post('traxId') != FALSE ? $this->input->post('traxId') : '',
            "timeStamp" => $this->input->post('timeStamp') != FALSE ? $this->input->post('timeStamp') : '',
        );
        $result = $client->call('reserve',array('inputReserve' => $data));
        $this->ajax->send($result);
    }

    public function debet_account(){

        if ($this->input->server('REQUEST_METHOD') !== 'POST') {
            exit('Unauthorized access!');
        }

        $url=$this->url;
        $client = new nusoap_client($url,true);
        $data = array(
            "userName" => $this->input->post('userName') != FALSE ? $this->input->post('userName') : '',
            "signature" => $this->input->post('signature') != FALSE ? $this->input->post('signature') : '',
            "productCode" => $this->input->post('productCode') != FALSE ? $this->input->post('productCode') : '',
            "merchantCode" => $this->input->post('merchantCode') != FALSE ? $this->input->post('merchantCode') : '',
            "terminal" => $this->input->post('terminal') != FALSE ? $this->input->post('terminal') : '',
            "merchantNumber" => $this->input->post('merchantNumber') != FALSE ? $this->input->post('merchantNumber') : '',
            "transactionType" => $this->input->post('transactionType') != FALSE ? $this->input->post('transactionType') : '',
            "recipientNumber" => $this->input->post('recipientNumber') != FALSE ? $this->input->post('recipientNumber') : '',
            "eVANum" => $this->input->post('eVANum') != FALSE ? $this->input->post('eVANum') : '',
            "amount" => $this->input->post('amount') != FALSE ? $this->input->post('amount') : '',
            "trxDesc" => $this->input->post('trxDesc') != FALSE ? $this->input->post('trxDesc') : '',
            "traxId" => $this->input->post('traxId') != FALSE ? $this->input->post('traxId') : '',
            "timeStamp" => $this->input->post('timeStamp') != FALSE ? $this->input->post('timeStamp') : '',
            "pin" => $this->input->post('pin') != FALSE ? $this->input->post('pin') : '',
        );
        $result = $client->call('debetAccount',array('inputDebetAccount' => $data));
        $this->ajax->send($result);
    }

    public function creator(){

        if ($this->input->server('REQUEST_METHOD') !== 'POST') {
            exit('Unauthorized access!');
        }

        $url=$this->url;
        $client = new nusoap_client($url,true);
        $data = array();
        $result = $client->call('Creator');
        $this->ajax->send($result);
    }

    public function mcpay(){

        if ($this->input->server('REQUEST_METHOD') !== 'POST') {
            exit('Unauthorized access!');
        }

        $url=$this->url;
        $client = new nusoap_client($url,true);
        $data = array(
            "userName" => $this->input->post('userName') != FALSE ? $this->input->post('userName') : '',
            "signature" => $this->input->post('signature') != FALSE ? $this->input->post('signature') : '',
            "productCode" => $this->input->post('productCode') != FALSE ? $this->input->post('productCode') : '',
            "merchantCode" => $this->input->post('merchantCode') != FALSE ? $this->input->post('merchantCode') : '',
            "terminal" => $this->input->post('terminal') != FALSE ? $this->input->post('terminal') : '',
            "merchantNumber" => $this->input->post('merchantNumber') != FALSE ? $this->input->post('merchantNumber') : '',
            "transactionType" => $this->input->post('transactionType') != FALSE ? $this->input->post('transactionType') : '',
            "recipientNumber" => $this->input->post('recipientNumber') != FALSE ? $this->input->post('recipientNumber') : '',
            "amount" => $this->input->post('amount') != FALSE ? $this->input->post('amount') : '',
            "traxId" => $this->input->post('traxId') != FALSE ? $this->input->post('traxId') : '',
            "timeStamp" => $this->input->post('timeStamp') != FALSE ? $this->input->post('timeStamp') : '',
            "counterCode" => $this->input->post('counterCode') != FALSE ? $this->input->post('counterCode') : '',
            "verCode" => $this->input->post('verCode') != FALSE ? $this->input->post('verCode') : '',
        );
        $result = $client->call('MCPay',array('input' => $data));
        $this->ajax->send($result);
    }

}
