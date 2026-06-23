## 2025-05-15 - [Security Hardening]
**Vulnerability:** Session Fixation, missing security headers, and predictable CSRF tokens.
**Learning:** Default CodeIgniter 4 configurations often leave some security filters (like secureheaders) disabled and session regeneration at login must be manually implemented in the authentication controller.
**Prevention:** Always ensure `session()->regenerate()` is called upon successful authentication and enable framework-provided security filters for headers and CSRF token randomization.

## 2025-05-16 - [SQL Injection and Account Deactivation]
**Vulnerability:** SQL injection risk in administrative dashboard and missing status check during login.
**Learning:** Even if data is sourced from configuration files (like database names), using string interpolation in SQL queries is a bad practice. Additionally, account deactivation logic must be explicitly checked during the authentication process.
**Prevention:** Always use parameterized queries for all database operations and ensure account status (e.g., `is_active`) is verified immediately after password validation to prevent unauthorized access by disabled accounts.
