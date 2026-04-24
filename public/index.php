<?php

declare(strict_types=1);

use Psr\Http\Message\{ResponseInterface,ServerRequestInterface};
use Slim\Factory\AppFactory;
use Twilio\TwiML\MessagingResponse;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();

/**
 * Do not reply to the received SMS
 *
 * This endpoint sends an, effectively, empty response back to Twilio after
 * receiving an SMS. As the TwiML does not contain instructions, Twilio will
 * take no further action.
 *
 * Here is the TwiML that will be sent as the body of the response:
 *
 * ```xml
 * <?xml version="1.0" encoding="UTF-8"?>
 * <Response/>
 * ```
 *
 * @see https://www.twilio.com/docs/messaging/twiml/message
 */
$app->post('/receive/no-response', function (
    ServerRequestInterface $request,
    ResponseInterface $response,
    array $args
) {
    // Set the response's content-type to "application/xml", so that the client processes it correctly
    $response->withHeader('Content-Type', 'application/xml');

    // Send an, effectively, empty response, telling Twilio not to send a reply to the sender
    $response->getBody()->write(new MessagingResponse()->asXML());

    // Return the response to Twilio
    return $response;
});

/**
 * Reply to the received SMS
 *
 * This endpoint sends TwiML back to Twilio after receiving an SMS. The TwiML
 * instructs Twilio to send a reply back to the customer who sent the SMS.
 *
 * Here is the TwiML that will be send as the body of the response, formatted for readability.
 *
 * ```xml
 * <?xml version="1.0" encoding="UTF-8"?>
 * <Response>
 *     <Message>I just wanna tell you how I'm feeling Gotta make you understand</Message>
 * <Response/>
 * ```
 *
 * @see https://www.twilio.com/docs/messaging/twiml/message
 */
$app->post('/receive/with-response', function (
    ServerRequestInterface $request,
    ResponseInterface $response,
    array $args
) {
    // Retrieve the body of the received SMS
    $body = $request->getParsedBody()['Body'];

    // Create a set of potential responses, along with a default response
    $default = "I just wanna tell you how I'm feeling - Gotta make you understand";
    $options = [
        "give you up",
        "let you down",
        "run around and desert you",
        "make you cry",
        "say goodbye",
        "tell a lie, and hurt you"
    ];

    $twimlResponse = new MessagingResponse();

    // Create a random message to send back to the sender, based on the contents of the received SMS
    if (strtolower($body) == 'never gonna') {
        $twimlResponse->message($options[array_rand($options)]);
    } else {
        $twimlResponse->message($default);
    }

    // Set the response's content-type to "application/xml", so that the client processes it correctly
    $response->withHeader('Content-Type', 'application/xml');

    // Set the body of the response to the generated TwiML
    $response->getBody()->write($twimlResponse->asXML());

    // Return the response to Twilio
    return $response;
});

$app->run();
