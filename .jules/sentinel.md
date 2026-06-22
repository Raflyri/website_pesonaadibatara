## 2025-05-15 - [Security Hardening]
**Vulnerability:** Session Fixation, missing security headers, and predictable CSRF tokens.
**Learning:** Default CodeIgniter 4 configurations often leave some security filters (like secureheaders) disabled and session regeneration at login must be manually implemented in the authentication controller.
**Prevention:** Always ensure `session()->regenerate()` is called upon successful authentication and enable framework-provided security filters for headers and CSRF token randomization.

## 2026-06-22 - [Authentication Security Enhancement]
**Vulnerability:** Potential for deactivated accounts to log in and risk of username enumeration.
**Learning:** Checking account status (e.g., `is_active`) before password verification can reveal the existence of a user. Furthermore, failing to check the status at all allows deactivated users to maintain access.
**Prevention:** Always verify user account status *after* successful password validation (`password_verify`) to ensure a consistent response time and prevent unauthorized access by disabled users.
