## 2025-05-15 - [Security Hardening]
**Vulnerability:** Session Fixation, missing security headers, and predictable CSRF tokens.
**Learning:** Default CodeIgniter 4 configurations often leave some security filters (like secureheaders) disabled and session regeneration at login must be manually implemented in the authentication controller.
**Prevention:** Always ensure `session()->regenerate()` is called upon successful authentication and enable framework-provided security filters for headers and CSRF token randomization.

## 2025-05-16 - [File Upload RCE Protection]
**Vulnerability:** Potential RCE via MIME type spoofing in file uploads.
**Learning:** CodeIgniter 4's `getRandomName()` preserves the original file extension. Validating only `mime_in` is insufficient because an attacker can spoof the MIME type while keeping a malicious extension (e.g., `.php`), which the framework then retains during storage.
**Prevention:** Always pair `mime_in` with `ext_in` validation rules to ensure both the content type and the file extension are strictly controlled.
