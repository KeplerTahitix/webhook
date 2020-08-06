<?php 

$method = $_SERVER['REQUEST_METHOD'];

// Process only when method is POST
if($method == 'POST'){
	$requestBody = file_get_contents('php://input');
	$json = json_decode($requestBody);

	$text = $json->result->parameters->text;

	switch ($text) {
		case '{
  "responseId": "57d4afcf-cec1-48a8-b236-a7f6869c1619-0820055c",
  "queryResult": {
    "queryText": "hi",
    "parameters": {
      "text": "hi"
    },
    "allRequiredParamsPresent": true,
    "fulfillmentMessages": [
      {
        "text": {
          "text": [
            ""
          ]
        }
      }
    ],
    "webhookSource": "webhook",
    "intent": {
      "name": "projects/webhook-wtff/agent/intents/266f4206-b95c-49d5-ae7b-16ac6cc6d826",
      "displayName": "General"
    },
    "intentDetectionConfidence": 0.3,
    "diagnosticInfo": {
      "webhook_latency_ms": 289
    },
    "languageCode": "en"
  },
  "webhookStatus": {
    "message": "Webhook execution successful"
  }
}':
			$speech = "Hi, Nice to meet you";
			break;

		case 'bye':
			$speech = "Bye, good night";
			break;

		case 'anything':
			$speech = "Yes, you can type anything here.";
			break;
		
		default:
			$speech = "Sorry, I didnt get that. Please ask me something else.";
			break;
	}

	$response = new \stdClass();
	$response->speech = $speech;
	$response->displayText = $speech;
	$response->source = "webhook";
	echo json_encode($response);
}
else
{
	echo "Method not allowed";
}

?>
