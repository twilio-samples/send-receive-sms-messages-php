# GitHub Copilot Instructions

This file provides guidance to GitHub Copilot when working with code in this repository.

## Project Overview

**Send & receive SMS messages** is a project that shows how to send and receive SMS with Twilio.

## Repository overview

- **Source code**: `/` contains the implementation.
- **Documentation**: README.md contains the project's documentation.
- **PR template**: `.github/PULL_REQUEST_TEMPLATE/pull_request_template.md` describes the information every PR must include.

## Project knowledge

### Repository structure

When suggesting file paths or navigation, follow this structure:

```bash
send-receive-sms-messages-php/
.
├── .env.example                      # An example .env file with all of the available environment variables
├── .github/
│   ├── ISSUE_TEMPLATE/
│   │   ├── bug_report.md             # A GitHub template for reporting bugs
│   │   ├── feature_request.md        # A GitHub template for requesting new features
│   │   └── question.md               # A GitHub template for asking questions about the project
│   ├── PULL_REQUEST_TEMPLATE/
│   │   └── pull_request_template.md  # A GitHub template for creating pull requests
    └── copilot-instructions.md       # This file
├── AGENTS.md                         # Project guidance for most Agents, except for Claude and Copilot
├── CLAUDE.md                         # Project guidance for Claude Code
├── CONTRIBUTING.md                   # Instructions for contributing to the project
├── LICENSE.md                        # The project's license (MIT)
├── composer.json                     # The Composer configuration file
├── composer.lock                     # Composer's lock file
├── public/
│   └── index.php                     # A small PHP app that shows how to reply to an SMS
├── README.md                         # Main landing page with table of contents
└── send-sms.php                      # A small PHP script that shows how to send an SMS
```

### Tech stack

- PHP 8.3 or above

## Prerequisites

To run the app, the following is required:

- PHP 8.3 or later
- [Composer][composer]
- An [ngrok][ngrok] account
- A [Twilio account][twilio_signup] with an active phone number that can send SMS

## Set up instructions

1. Rename the `.env.example` file to `.env`
1. Go to the [Twilio Console][twilio_console] and find your **Account SID**, **Auth Token**, and Twilio phone number.
1. Copy and paste those values into the placeholders in the `.env` file `TWILIO_ACCOUNT_SID`, `TWILIO_AUTH_TOKEN`, and `SENDER`, respectively.
1. Set your phone number, in [E.164 format][e164_format] as the value of `RECIPIENT` in _.env_
   Save the file.

### Send an SMS

To send an SMS, run the following command.

```bash
php send-sms.php
```

### Receive an SMS

Before you can receive an SMS, you need to complete a few further steps.

1. Start ngrok listening for HTTP requests on port 8080:

   ```bash
   ngrok http 8080
   ```

1. Go to the [Active numbers][active_numbers] page in the Twilio Console.
1. Click your Twilio phone number.
1. Go to the **Configure** tab and find the **Messaging Configuration** section.
1. In the **A call comes in** row, select the **Webhook** option.
1. Paste your ngrok **Forwarding** URL in the **URL** field followed by "/receive/".
   For example, if your ngrok console shows Forwarding "<https://1aaa-123-45-678-910.ngrok-free.app>", enter "<https://1aaa-123-45-678-910.ngrok-free.app/receive/>".
   - To receive an SMS **without** responding to it, append "no-response" to the URL
   - To receive an SMS and respond to it, append "with-response" to the URL
1. Click **Save configuration**.
1. Start the PHP app

   ```bash
   composer serve
   ```

## Commands you can use

**Lint the documentation:** `markdownlint-cli2 README.md`
**Run the test suite:** `composer test`
**Run the code:**

- Run the "reply to SMS" app: `composer serve`
- Run the "send SMS" script: `php send-sms.php`

## Boundaries

- ✅ **Always do:** Follow the style examples, run `composer cs-check` for PHP source files
- ⚠️ **Ask first:** Before modifying existing documents in a major way
- 🚫 **Never do:** Modify code in `src/`, edit config files, commit secrets

## Code Style Guidelines

The code style for this project follows the [Laminas Coding Standard][laminas-coding-standard].

## Commit Messages and Pull Requests

- Follow [the Chris Beams style of commit messages][chris-beams-commit-message].
  Commit messages should be concise and written in the imperative mood.
  Small, focused commits are preferred.

### Pull request expectations

PRs should use the template located at `.github/PULL_REQUEST_TEMPLATE/pull_request_template.md`.
Provide a summary, test plan and issue number if applicable, then check that:

- Every pull request answers:
  - What changed?
  - Why?
  - What are the breaking changes?
  - What is the server PR (if the change requires a coordinated server update)?
- New tests are added when needed.
- Documentation is updated.
- The full test suite passes.
- Comments should be complete sentences and end with a period.

## Pull request expectations

PRs should use the template located at `.github/PULL_REQUEST_TEMPLATE/pull_request_template.md`.
Provide a summary, test plan and issue number if applicable, then check that:

- New tests are added when needed.
- Documentation is updated.
- The full test suite passes.

Commit messages should be concise and written in the imperative mood.
Small, focused commits are preferred.

## What reviewers look for

- Tests covering new behaviour.
- Consistent style: code formatted with [PHP-CS-Fixer][php-cs-fixer] and use statements sorted.
- Clear documentation for any public API changes.
- Clean history and a helpful PR description.

[active_numbers]: https://console.twilio.com/us1/develop/phone-numbers/manage/incoming
[chris-beams-commit-message]: http://chris.beams.io/posts/git-commit/
[composer]: https://getcomposer.org
[e164_format]: https://www.twilio.com/docs/glossary/what-e164
[laminas-coding-standard]: https://docs.laminas.dev/laminas-coding-standard/
[ngrok]: https://ngrok.com/
[php-cs-fixer]: https://github.com/PHP-CS-Fixer/PHP-CS-Fixer
[twilio_console]: https://console.twilio.com
[twilio_signup]: https://www.twilio.com/try-twilio
