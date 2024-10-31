<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}


class prostorsms_gateway {

    public function sms_send($login, $password, $to, $text, $sender = '') {
        $response = $this->remote_request('http://api.prostor-sms.ru/messages/v2/send/', 'GET', array(
            'headers' => array(
                'Authorization' => 'Basic ' . base64_encode( $login . ':' . $password )
            ),
            'body' => array(
                "phone"		=>	$this->clear_phone($to),
                "text"		=>	$text,
                "sender"    =>	$sender
            )
        ));
        return $response['body'];
    }

    public function clear_phone($phone) {
        $original = array('(', ')', '-', ' ');
        $replace = array('','','','');
        return str_replace($original, $replace, $phone);
    }

    public function get_balance($login = '', $password = '') {
        $response = $this->remote_request('http://api.prostor-sms.ru/messages/v2/balance/', 'GET', array(
            'headers' => array(
                'Authorization' => 'Basic ' . base64_encode( $login . ':' . $password )
            )
        ));
        $del = explode(';', $response['body']);
        if (isset($del[1])) {
            return $del[1]." р.";
        }
        return false;
    }

    public function get_senders($login = '', $password = '') {
        $response = $this->remote_request('http://api.prostor-sms.ru/messages/v2/senders/', 'GET', array(
            'headers' => array(
                'Authorization' => 'Basic ' . base64_encode( $login . ':' . $password )
            )
        ));
        $response = explode("\n", $response['body']);
        $senders = array();

        foreach ($response as $sender) {
            $arr = explode(';', $sender);
            $senders[] = $arr[0];
        }
        if ($senders[0] == 'error authorization') {
            return false;
        }
        return $senders;
    }

    private function remote_request($url, $method, $args) {
        $args2 = $args;
        $args2 ['method'] = $method;
        return wp_remote_request($url, $args2);
    }
}
