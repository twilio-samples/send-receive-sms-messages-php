# AGENTS.md

Welcome to the Send and receive SMS messages repository.
This file contains the main points for new contributors.

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
├── composer.json                     # The Composer configuration file
├── composer.lock                     # Composer's lock file
├── public/
│   └── index.php                     # A small PHP app that shows how to reply to an SMS
├── README.md                         # Main landing page with table of contents
└── send-sms.php                      # A small PHP script that shows how to send an SMS
```

### Tech stack

- PHP 8.3 or above

## Commands you can use

**Lint the documentation:** `composer cs-check`
**Run the test suite:** `composer test`
**Run the code:**

- Run the reply to SMS app: `composer serve`
- Run the send SMS script: `php send-sms.php`

## Boundaries

- ✅ **Always do:** Follow the style examples, run `composer cs-check` for PHP source files
- ⚠️ **Ask first:** Before modifying existing documents in a major way
- 🚫 **Never do:** Modify code in `src/`, edit config files, commit secrets

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

[php-cs-fixer]: https://github.com/PHP-CS-Fixer/PHP-CS-Fixer
