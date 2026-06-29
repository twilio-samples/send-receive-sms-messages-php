# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Commands

```bash
# Install dependencies
composer install

# Start the web server (serves public/ on port 8080)
composer serve

# Send a one-off SMS
php send-sms.php
```

## Architecture

Two independent entry points:

- **`send-sms.php`** — CLI script.
  Loads _.env_, validates required vars, creates a Twilio `Client`, and sends a single hard-coded SMS.
  Run once and exits.

- **`public/index.php`** — A Slim 4 web app.
  Exposes two POST webhook endpoints that Twilio calls when an SMS arrives at your Twilio number:
  - `POST /receive/no-response` — acknowledges the SMS with an empty TwiML `<Response/>` (no reply sent)
  - `POST /receive/with-response` — reads the `Body` parameter from the parsed POST body and replies with a TwiML `<Message>`.
    If the body is "never gonna", it picks a random Rick Astley lyric; otherwise it sends a default message.

Both files use [vlucas/phpdotenv][phpdotenv] to load _.env_.
The web app uses PHP-DI via [php-di/slim-bridge][slim-bridge] for dependency injection.

## Environment Variables

Copy _.env.example_ to _.env_, and populate all four values before running either entry point:

| Variable             | Description                                                  |
| -------------------- | ------------------------------------------------------------ |
| `TWILIO_ACCOUNT_SID` | Twilio Account SID from the console                          |
| `TWILIO_AUTH_TOKEN`  | Twilio Auth Token from the console                           |
| `SENDER`             | Your Twilio phone number (E.164 format, e.g. `+15551234567`) |
| `RECIPIENT`          | Destination phone number for outbound SMS (E.164 format)     |

## Receiving SMS Locally

The webhook server must be publicly reachable.
Use ngrok:

```bash
ngrok http 8080
```

Set the ngrok forwarding URL as the webhook in the Twilio Console under the phone number's Messaging Configuration, appending either `/receive/no-response` or `/receive/with-response`.

[phpdotenv]: https://github.com/vlucas/phpdotenv
[slim-bridge]: https://github.com/PHP-DI/Slim-Bridge
