# TryHackMe SecureShop – Vulnerable Web App & Walkthrough

This repository contains both:
- A **custom-built vulnerable e-commerce web application (SecureShop)**
- A **detailed walkthrough** demonstrating exploitation of OWASP Top 10 web vulnerabilities

The project was designed for **educational and ethical security testing** purposes.

---

## 📌 Project Overview
SecureShop is a deliberately vulnerable web application developed using PHP and MySQL to simulate real-world web security flaws.  
The application was later used as the basis for a **TryHackMe-style CTF challenge**, where common vulnerabilities are identified, exploited, and remediated.

---

## 🧩 Vulnerabilities Implemented
- **SQL Injection** – Authentication bypass via unparameterized queries  
- **Broken Access Control (IDOR)** – Unauthorized access to user profiles  
- **Stored Cross-Site Scripting (XSS)** – Unsanitized user input execution  
- **Sensitive Data Exposure** – Publicly accessible backup files  

All vulnerabilities are mapped to **OWASP Top 10 (2021)** categories.

---

## 🛠 Technology Stack
- Backend: PHP  
- Database: MySQL  
- Web Server: Apache  
- Frontend: HTML, CSS, JavaScript  
- Hosting: InfinityFree  

---

## 🧪 Skills Demonstrated
- Secure & insecure web application development
- OWASP Top 10 vulnerability implementation
- Manual web application penetration testing
- CTF-style lab design
- Security documentation & walkthrough writing
- Impact analysis and remediation strategies

---

## 📄 Walkthrough Documentation
- A complete step-by-step walkthrough is provided in the included PDF:
  **SecureShop Walkthrough.pdf**

---

## 🔗 TryHackMe Room
- SecureShop Room: https://tryhackme.com/jr/secureshop79

---

## ⚠️ Disclaimer
This project is created **strictly for educational purposes**.  
All vulnerabilities were intentionally introduced in a controlled environment to demonstrate common web security risks.
