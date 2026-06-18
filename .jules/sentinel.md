## 2025-05-15 - [Security Hardening]
**Vulnerability:** Session Fixation, missing security headers, and predictable CSRF tokens.
**Learning:** Default CodeIgniter 4 configurations often leave some security filters (like secureheaders) disabled and session regeneration at login must be manually implemented in the authentication controller.
**Prevention:** Always ensure `session()->regenerate()` is called upon successful authentication and enable framework-provided security filters for headers and CSRF token randomization.
