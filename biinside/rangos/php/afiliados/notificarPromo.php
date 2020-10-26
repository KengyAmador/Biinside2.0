<?php
	if(isset($_POST['afiliado'])){

		require_once __DIR__ . '/notificacion.php';
		$notification = new Notification();

		$title = "Promo: " . $_POST['titulo'];
		$message = $_POST['mensaje'];
		$imageUrl = isset($_POST['image_url'])?$_POST['image_url']:'';
		$action = isset($_POST['action'])?$_POST['action']:'';
		
		$actionDestination = isset($_POST['action_destination'])?$_POST['action_destination']:'';

		if($actionDestination ==''){
			$action = '';
		}
		$notification->setTitle($title);
		$notification->setMessage($message);
		$notification->setImage($imageUrl);
		$notification->setAction($action);
		$notification->setActionDestination($actionDestination);

		$firebase_api = "";

		if($_POST['afiliado'] == 'BI0006'){ //FRUTIKA
			$firebase_api = "AAAAGer5E-A:APA91bG3JKDNnUhfwQN25MqNrH8AE-ydz3OiosTNuie_kyPTqs_k8gGZk407TjMQYsRcVJaiWnhozlV9CD6lc-hP0FTni7hJo8rbpH0L_r7bAghAsr6GkvVeC5iSzoS3LWUdZGHAPjHx";
		}
		else if($_POST['afiliado'] == 'BI0001'){ //LA PIAZZA
			$firebase_api = "AAAAH2nuWas:APA91bErGqBkuRcSPtih9oOhlgwJMZAAj_EgL9qQGuXcm-mZzGvaL_kKUtWzua5EwfwDZZlHzqPncpJ2pLZIGjjHDfDPcBbw75n-vXknqx7RcIZqrS12iErBcXdAWfigsVVvOfjy0L9N";
		}
		else if($_POST['afiliado'] == 'BI0004'){ //EXOTHIC NAILS
			$firebase_api = "AAAAq5yTPl0:APA91bFBC0GQHWz1tdAV6Rf3a3xmcHykthsC5fPKqT4u0dPCI3TAOlItSHLX4yHC7WSY-vSPmOQu33G3ZVE2KG4NZbhSrXEKzS4fr-QnJ_-ThmyHU8y8F7xgTwQtH7eOhOFiWENW_0HR";
		}
		else if($_POST['afiliado'] == 'BI0003'){ //DON FRAN
			$firebase_api = "AAAAwiKStJo:APA91bHYv4NAygrHB4oYdCHx1amqUE6Il-Ao1n8fNrlNG8q7iilXhmeqJ7z4IgqvWLVVVjzr-6tDGA0dK-NXXaKcnA1ocysY5m8L4tFnpEsKWcP3oiNaPFHsdf04hlmz3kSQr0TbHuR7";
		}
		else if($_POST['afiliado'] == 'BI0007'){ //ISABELLAS
			$firebase_api = "AAAAGL87pVs:APA91bGmBsldHPMXZ9y5HzvW-i5JcNFugvMQlX-sqzdE6NRavDzrTNjZ6Q4vbXoRmc0TZ-XMMhC0VXwQCUnNmaCqLa3qSp0skuiktEUCzXQbxXqetFFjEGtB950BKk_V6K5J63kON-40";
		}
		else if($_POST['afiliado'] == 'BI0008'){ //Chini-To GO SAN RAMON
			$firebase_api = "AAAA_CUmqxo:APA91bHTGeHenOD7T_RoabF9bGd9vvq3jgXJmQ5z9imD8wUGdBICQqnxUuT5sE1-s92tCaVZkXuZWQaFMBizP3xMAisDVxTQ-6PYs5v5Tot2YKDxfDYTNeO028NN9cPXlqreVtlmYvof";
		}
		else if($_POST['afiliado'] == 'BI0009'){ //Chini-To GO LIBERIA
			$firebase_api = "AAAA_CUmqxo:APA91bHTGeHenOD7T_RoabF9bGd9vvq3jgXJmQ5z9imD8wUGdBICQqnxUuT5sE1-s92tCaVZkXuZWQaFMBizP3xMAisDVxTQ-6PYs5v5Tot2YKDxfDYTNeO028NN9cPXlqreVtlmYvof";
		}
		else if($_POST['afiliado'] == 'BI0010'){ //Chini-To GO PALMARES
			$firebase_api = "AAAA_CUmqxo:APA91bHTGeHenOD7T_RoabF9bGd9vvq3jgXJmQ5z9imD8wUGdBICQqnxUuT5sE1-s92tCaVZkXuZWQaFMBizP3xMAisDVxTQ-6PYs5v5Tot2YKDxfDYTNeO028NN9cPXlqreVtlmYvof";
		}
		
		$requestData = $notification->getNotificatin();

		$fields = array(
			'to' => '/topics/promociones',
			'notification' => $requestData,
		);


		// Set POST variables
		$url = 'https://fcm.googleapis.com/fcm/send';

		$headers = array(
			'Authorization: key=' . $firebase_api,
			'Content-Type: application/json'
		);
		
		// Open connection
		$ch = curl_init();

		// Set the url, number of POST vars, POST data
		curl_setopt($ch, CURLOPT_URL, $url);

		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		// Disabling SSL Certificate support temporarily
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

		// Execute post
		$result = curl_exec($ch);
		$salida = 0;
		if($result === FALSE){
			die('Curl failed: ' . curl_error($ch));
			$salido = 0;
		}
		else{
			$salida = 1;
		}

		// Close connection
		curl_close($ch);
		if($salida===1){
			echo 1;
		}else{
			echo 2;
		}
	}
?>