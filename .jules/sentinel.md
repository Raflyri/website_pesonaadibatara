## 2025-05-15 - [Security Hardening]
**Vulnerability:** Session Fixation, missing security headers, and predictable CSRF tokens.
**Learning:** Default CodeIgniter 4 configurations often leave some security filters (like secureheaders) disabled and session regeneration at login must be manually implemented in the authentication controller.
**Prevention:** Always ensure `session()->regenerate()` is called upon successful authentication and enable framework-provided security filters for headers and CSRF token randomization.

## 2025-05-22 - [Admin Panel Security Hardening]
**Vulnerability:** Broken Access Control, SQL Injection, and XSS.
**Learning:** Authenticated admin routes do not automatically enforce role-based access for sensitive operations like database migrations. Also, dynamic content in admin views (like filenames) can be used for XSS if not properly escaped.
**Prevention:** Explicitly check for 'superadmin' role in sensitive controller methods. Use parameterized queries for all SQL operations. Apply CI4's `esc()` helper to all dynamic outputs in views with appropriate contexts.
