<?php
	if(isset($_POST['token'])){

		require_once __DIR__ . '/notificacion.php';
		$notification = new Notification();

		$title = "Notificación de Orden";
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
		
		$firebase_token = $_POST['token'];

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
		else if($_POST['afiliado'] == 'BI0011'){ //MEGA PIZZA
			$firebase_api = "AAAA9NO_kxM:APA91bG-ejF7qnMF20n8CjVTPcNHWVER6zpj0jq4t2Me0PWmz_NiIx5BLSUR7JtZsrLPtOT5QAJxgOn5BSeCYS9X_R5meU7qnBduJ9ZBTRzi7uuqQLwn5fzU9JarqoMWFdSEyC8yASm-";
		}
		else if($_POST['afiliado'] == 'BI0012'){ //LA PARRILLA DE CHALO
			$firebase_api = "AAAADB9Pgno:APA91bFQwSFuSJ1NaQh79QdRZm0yYTzpFy5D9gRq-qYbPBHwcOD0xL5UpA9aAc8Z_iJohgtDF5v8njqI8XyHVPuAXStaS5nM6rfgKhXj8_TAXonmppAFI8skXuooGgHkYVRMfFfJguhl";
		}
		else if($_POST['afiliado'] == 'BI0013'){ //IL PIACERI
			$firebase_api = "AAAAN4-rc0I:APA91bGt3W7mde7gXpjOOKkb2Zc6aCL85DgCkWPLjL39PMjsONJD3L5xie8d3tQ1VRko16vPoOi11g4mt2_RfoFralB0T8nT0x45LTxV1vc1EFyiCNmuqagHPLVpvJJnpw-yW3WvCtbJ";
		}
		else if($_POST['afiliado'] == 'BI0014'){ //BARBUDOS
			$firebase_api = "AAAAa2He--Y:APA91bFN2_JdnMomdbDzCTWvbERUU7p_6HhedpPdeLIevxSIDHRRFgXA6XKHbUolkqiyv4HmLri8_Ikp-eOkSWFoPcYy4xIlizPs-6lRxMxtbpebLIXaRF-_2Nk6Q8vky_n9kHYga3um";
		}
		else if($_POST['afiliado'] == 'BI0015'){ //RESTAURANTE CAFE EL PARQUE
			$firebase_api = "AAAABwtbZjQ:APA91bHP6p5BY-cwZJUPWVQLjorEBeF_m7VqnHAOg6UuEXHb95QFmjVKoiRrel-jBdDHrMsTdn2aamDIff9ezHP6H1kUUsOaCfLN3zKAMsbTDScQWaxyqFNjv8JrXjfLp3plnyA8FxOW";
		}
		else if($_POST['afiliado'] == 'BI0016'){ //MINI MARKET BELEN
			$firebase_api = "AAAAT8ae-lI:APA91bFzQfTsO3JZL44nmUI8LXZQFqYaYd3gvm-LQlys24d64b9-2jcjmcZ-kVZmoVHx38I8Es0qqxrvj0AAVnXi6K-d1TGfEm6nHyCvDJLi2JA0YrzcaHkgm4EkYYgIv9L38ZrICo6V";
		}
		else if($_POST['afiliado'] == 'BI0017'){ //PIZZERIA 3 RIOS
			$firebase_api = "AAAAg78pVTU:APA91bEHa0VpA0D75YKaEr0k8Q_fsj4_z8aupypEypcvJ8mzpjonkVl37-bxhxuv4oz2TBpS24uI3FM6pPutDLWlq_krHomwhf7aAT4su2ut9o3SIIf1LlwLx7BNTLHekAqM8MAnoBTR";
		}
		else if($_POST['afiliado'] == 'BI0018'){ //Chini-To GO SAN PEDRO
			$firebase_api = "AAAA_CUmqxo:APA91bHTGeHenOD7T_RoabF9bGd9vvq3jgXJmQ5z9imD8wUGdBICQqnxUuT5sE1-s92tCaVZkXuZWQaFMBizP3xMAisDVxTQ-6PYs5v5Tot2YKDxfDYTNeO028NN9cPXlqreVtlmYvof";
		}
		
		$requestData = $notification->getNotificatin();

		$fields = array(
			'to' => $firebase_token,
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