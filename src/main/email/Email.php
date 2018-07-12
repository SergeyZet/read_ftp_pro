<?php

require_once ('../database/DataBase.php');
class Email
{
    private $email;
    private $error;
    private $db;
    private $data;
    function __construct($name, $phone, $email, $message)
    {
        $this->data['name'] = $name;
        $this->data['phone'] = $phone;
        $this->data['email'] = $email;
        $this->data['message'] = $message;
        $this->email['to_email'] = "shaman1861@mail.ru,readium.pro@gmail.com ";//$parametrEmail['to_email'];upgreat@55.ru
        $this->email['header'] = 'Readium.pro: "Тест-проверка связи ау"';
        $this->email['message'] = $message;
        $this->email['additional_params'] = "From: name $name; phone $phone; email $email; \r\n";
        $this->db = new DataBase();
    }
    function send()
    {
        $this->error = mail($this->email['to_email'], $this->email['header'],
            $this->email['additional_params']." ".$this->email['message']
            , $this->email['additional_params']) ? 0 : 1;
    }
    function send_database(){
        $sql = "INSERT INTO `table_toemail` (`id`,`name`,`phone`,`email`,`message`)
                VALUES (NULL ,
                '".$this->data['name']."',
                '".$this->data['phone']."',
                '".$this->data['email']."',
                '".$this->data['message']."');";
        mysqli_query( $this->db->getDb(),$sql);
    }
    function get_result()
    {
        return $this->error;
    }
}