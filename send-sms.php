<?php

declare(strict_types=1);

require_once("vendor/autoload.php");

use Twilio\Rest\Client;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);

// Load environment variables from variables defined in .env
$dotenv->load();

// Mark the following variables as being required and not allowed to be empty
$dotenv
    ->required(
        [
            'RECIPIENT',
            'SENDER',
            'TWILIO_ACCOUNT_SID',
            'TWILIO_AUTH_TOKEN'
        ]
    )
    ->notEmpty();

// Register a new Twilio (Rest) Client for interacting with Twilio's APIs
$twilio = new Client(
    $_SERVER["TWILIO_ACCOUNT_SID"],
    $_SERVER["TWILIO_AUTH_TOKEN"]
);

// Send an SMS to the recipient from the sender
$message = $twilio
    ->messages
    ->create(
        $_SERVER["RECIPIENT"],
        [
            "body" => "This is the ship that made the Kessel Run in fourteen parsecs?",
            "from" => $_SERVER["SENDER"]
        ]
    );
