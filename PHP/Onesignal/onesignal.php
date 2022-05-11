<?PHP
class onesignal
{
    public function sendMessage()
    {
        $content = array(
            "en" => 'Prueba',
        );

        $fields = array(
            'app_id' => "e851ce3f-65f4-4745-976e-781b3c36d150",
            'include_external_user_ids' => array("e189baaf-7691-4a5f-8370-a00403443e6c", "9ec6c46b-fc55-400d-a82e-b17ac702f3590", "4153dd5f-90cc-449b-87c6-63f4da532cdd", "87b082f1-2567-4c71-b0b0-c35d7982f126", "05e7d2bd-8c62-46f3-817c-47670d7ffe1c"),
            'channel_for_external_user_ids' => 'push',
            'included_segments' => array('All'),
            'data' => array("foo" => "bar"),
            'contents' => $content,
        );

        $fields = json_encode($fields);
        print("\nJSON sent:\n");
        print($fields);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
            'Authorization: Basic ZGNiMGQwYTQtNGM2Mi00ZTU3LWJiMWEtZjQxYTVlNjJlYzg1'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }
}

$response = new onesignal();

$response = $response->sendMessage();
$return["allresponses"] = $response;
$return = json_encode($return);

print("\n\nJSON received:\n");
print($return);
print("\n");
