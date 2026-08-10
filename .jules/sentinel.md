## 2025-05-15 - [Security Hardening]
**Vulnerability:** Session Fixation, missing security headers, and predictable CSRF tokens.
**Learning:** Default CodeIgniter 4 configurations often leave some security filters (like secureheaders) disabled and session regeneration at login must be manually implemented in the authentication controller.
**Prevention:** Always ensure `session()->regenerate()` is called upon successful authentication and enable framework-provided security filters for headers and CSRF token randomization.

## 2026-06-29 - [CSRF and RCE Hardening]
**Vulnerability:** CSRF on administrative state-changing routes and potential RCE via file extension spoofing.
**Learning:** State-changing actions like database migrations must use POST with CSRF tokens. Additionally, `mime_in` validation in CodeIgniter 4 is insufficient when `getRandomName()` is used because it preserves the original file extension; `ext_in` must also be used.
**Prevention:** Convert all administrative GET routes that perform actions (delete, migrate, etc.) to POST and always include `ext_in` validation for file uploads to ensure extension-based security.
