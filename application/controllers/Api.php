<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

    /**
     * WSDL url for routeX2
     * @var string
     */
    private $urlMaya = 'https://mcmobilecash.com/devofc/mayaapi/maya/';

    public function __construct(){
        parent::__construct();
        $this->load->model('user_model');
        $this->load->library('form_validation');

        if ($this->input->server('REQUEST_METHOD') !== 'POST') {
            exit('Unauthorized access!');
        }
    }

    public function createProfile(){
        $this->form_validation->set_rules('userName', 'userName', 'required');
        $this->form_validation->set_rules('signature', 'signature', 'required');
        $this->form_validation->set_rules('phoneNo', 'phoneNo', 'required');
        $this->form_validation->set_rules('idNumber', 'idNumber', 'required');
        $this->form_validation->set_rules('accType', 'accType', 'required');
        $this->form_validation->set_rules('cityName', 'cityName', 'required');
        if ($this->form_validation->run() ==  FALSE) {
            echo json_encode(array(
                'status' => 'false', 'message' => 'required field is (userName,signature,phoneNo,idNumber,accType,cityName)'
            ));
            exit();
        }

        // save user
        $user_data = array(
            'userName' => $this->input->post('userName'),
            "signature" => $this->input->post('signature'),
            "phoneNo" => $this->input->post('phoneNo'),
            "idNumber" => $this->input->post('idNumber'),
            "accType" => $this->input->post('accType'),
            "cityName" => $this->input->post('cityName'),
        );
        $save_user = $this->user_model->save_user($user_data);

        // save user in eva server
        if ($save_user) {
            $url = $this->urlMaya.'createProfile';
            $params = array(
                'userName' => $user_data['userName'],
                "signature" => $user_data['signature'],
                "phoneNo" => $user_data['phoneNo'],
                "idNumber" => $user_data['idNumber'],
                "accType" => $user_data['accType'],
                "cityName" => $user_data['cityName'],
            );
            $res = array('status' => 'approved');//json_decode($this->ajax->curl($url,$params));

            if ($res['status'] == 'approved') {
                $this->ajax->send(array(
                    'status' => 'aprroved', 'message' => 'Data saved', 'data' => $params
                ));
            }
            else{
                $this->user_model->delete_user($user_data);
                $this->ajax->send(array('status' => 'false', 'message' => 'error: data unsaved!'));
            }
        }
        else{
            $this->ajax->send(array('status' => 'false', 'message' => 'error: data unsaved!'));
        }
    }

    public function login(){
        $this->form_validation->set_rules('userName', 'userName', 'required');
        $this->form_validation->set_rules('password', 'password', 'required');
        if ($this->form_validation->run() ==  FALSE) {
            echo json_encode(array(
                'status' => 'false', 'message' => 'required field is (userName,password)'
                ));
            exit();
        }

        // login
        $user_data = array(
            'userName' => $this->input->post('userName'),
            "password" => $this->input->post('password'),
        );
        $login_user = $this->user_model->login_user($user_data);
        if (count($login_user) > 0) {
            $this->ajax->send(array('status' => 'aprroved', 'message' => 'User exists', 'data' => $login_user));
        }
        else{
            $this->ajax->send(array('status' => 'false', 'message' => 'User does not exists'));
        }
    }

    public function balance(){
        $url = $this->urlMaya.'balance';
        $params = array(
            'userName' => $this->input->post('userName'),
            "signature" => $this->input->post('signature'),
            "phoneNo" => $this->input->post('phoneNo'),
            "sessionId" => $this->input->post('sessionId'),
        );
        $res = $this->ajax->curl($url,$params);
        echo $res;
    }

    public function debetAccount(){
        $url = $this->url.'debetAccount';
        $params = array(
            'userName' => $this->input->post('userName',
            "signature" => $this->input->post('signature'),
            "description" => $this->input->post('description'),
            "dest1Acc" => $this->input->post('dest1Acc'),
            "dest1Amount" => $this->input->post('dest1Amount'),
            "phoneNo" => $this->input->post('phoneNo'),
            "sessionId" => $this->input->post('sessionId'),
            "source1Acc" => $this->input->post('source1Acc'),
            "source1Amount" => $this->input->post('source1Amount'),
            "transactionType" => $this->input->post('transactionType'),
            "traxId" => $this->input->post('traxId'),
        );
        $res = $this->ajax->curl($url,$params);
        echo $res;
    }
}
