<?php
	class SenderEmails
	{
		private $email;
		private $error;

		function __construct($name, $phone, $email, $massege)
		{
			$this->email['to_email'] = "shaman1861@mail.ru";//$parametrEmail['to_email'];upgreat@55.ru
			$this->email['header'] = 'Readium.pro: "Тест-проверка связи ау"';
			$this->email['message'] = $massege;
			$this->email['additional_params'] = "From: name $name; phone $phone; email $email; \r\n";
		}

		function send()
		{
			$this->error = mail($this->email['to_email'], $this->email['header'],
                $this->email['additional_params']." ".$this->email['message']
                , $this->email['additional_params']) ? 0 : 1;
		}

		function get_result()
		{
			return $this->error; 
		}
	}
?>