# Send & receive SMS messages

Learn how to send and receive SMS with Twilio using this PHP code sample.

## Environment Variables

Copy `.env.example` to `.env`. Never commit `.env`.

```bash
cp .env.example .env
```

| Variable             | Where to find                                                                                                                  | Format                               |
| -------------------- | ------------------------------------------------------------------------------------------------------------------------------ | ------------------------------------ |
| `RECIPIENT`          | Your personal phone number for testing                                                                                         | E.164 format: `+15551234567`         |
| `SENDER`             | Console → Phone Numbers → Manage → Active Numbers                                                                              | E.164 format: `+15551234567`         |
| `TWILIO_ACCOUNT_SID` | Console homepage or Admin dropdown (top right) → Account Management → Keys & Credentials → API Keys & Tokens                   | Starts with `AC`                     |
| `TWILIO_AUTH_TOKEN`  | Console homepage or Admin dropdown (top right) → Account Management → Keys & Credentials → API Keys & Tokens → click to reveal | 32-char string. Treat as a password. |

## Commands

```bash
# Install
composer install

# Send an SMS
php send-sms.php

# Run the webhook server (to receive SMS)
composer serve

# Expose webhooks locally
# Requires ngrok — install and authenticate at https://ngrok.com before running
ngrok http 8080
# Set the resulting URL + /receive/no-response or /receive/with-response as the webhook in Twilio Console
```

## Project Structure

- `send-sms.php` — sends an outbound SMS using the Twilio REST API
- `public/index.php` — Slim app with two webhook routes: `/receive/no-response` and `/receive/with-response`
- `.env.example` — template for required credentials
- `composer.json` — PHP dependencies and the `composer serve` script

## Agent Boundaries

**Always:**

- Confirm `.env` is configured before running any command
- Use the Environment Variables section to guide the user to each credential — don't ask them to find values without direction
- Confirm the app is running before asking the user to test it

**Never:**

- Run the app with missing or placeholder credentials
- Hardcode credentials or phone numbers in source files
- Skip the `cp .env.example .env` step

## Verify It's Working

**Send:** Run `php send-sms.php` — the phone number set in `RECIPIENT` should receive a text message.

**Receive:** With `composer serve` and ngrok running, configure your Twilio number's messaging webhook to `https://<ngrok-url>/receive/with-response`, then send the text "never gonna" to the number in `SENDER` — you should receive a reply SMS.

## Twilio Resources

- [Twilio Console](https://console.twilio.com) — credentials, phone numbers, webhook configuration
- [Twilio Messaging docs](https://www.twilio.com/docs/messaging) — SMS API reference
- [TwiML for Messaging](https://www.twilio.com/docs/messaging/twiml) — TwiML reference for SMS responses
- [Twilio PHP SDK](https://www.twilio.com/docs/libraries/php) — PHP helper library reference
