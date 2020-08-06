<?php 

$method = $_SERVER['REQUEST_METHOD'];

// Process only when method is POST
if($method == 'POST'){
	$requestBody = file_get_contents('php://input');
	$json = json_decode($requestBody);

	$text = $json->result->parameters->text;

	switch ($text) {
		case '{
  "responseId": "b4fd6713-efd0-452a-98ce-35be3b779593-0820055c",
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
    "outputContexts": [
      {
        "name": "projects/webhook-wtff/agent/sessions/e2a51ad9-4bbe-ce4e-0300-530d0efebe17/contexts/__system_counters__",
        "parameters": {
          "no-input": 0,
          "no-match": 0,
          "text": "hi",
          "text.original": "hi"
        }
      }
    ],
    "intent": {
      "name": "projects/webhook-wtff/agent/intents/266f4206-b95c-49d5-ae7b-16ac6cc6d826",
      "displayName": "General"
    },
    "intentDetectionConfidence": 0.3,
    "languageCode": "en"
  },
  "originalDetectIntentRequest": {
    "payload": {}
  },
  "session": "projects/webhook-wtff/agent/sessions/e2a51ad9-4bbe-ce4e-0300-530d0efebe17"
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
