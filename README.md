# 💙 Lorkut – Fullstack Version (v3.0)

> A nostalgic Orkut-inspired portfolio rebuilt with a full PHP + MySQL architecture.

This repository contains the **dynamic fullstack implementation** of Lorkut, including backend logic, database integration, modular structure, and multilingual support.

Live version:
🔗 [https://lorenaferreira.infinityfree.me](https://lorenaferreira.infinityfree.me)

---

# 📌 General Information

Lorkut is a personal portfolio project inspired by the early 2000s social network aesthetic, redesigned with modern development practices.

Version 3.0 represents the evolution from a static frontend prototype to a structured backend-driven application.

The project demonstrates:

* Server-side rendering with PHP
* MySQL relational database modeling
* Modular architecture
* Internationalization (i18n)
* Real data handling (projects, testimonials, communities, views)

---

# 📚 Table of Contents

* [💡 Project Overview](#-project-overview)
* [🖼 Screenshots](#-screenshots)
* [🛠 Tech Stack](#-tech-stack)
* [🏗 Application Architecture](#-application-architecture)
* [📋 Functional Requirements](#-functional-requirements)
* [⚙️ Running the Project Locally](#-running-the-project-locally)
* [🔎 Code Review Notes](#-code-review-notes)
* [🚀 Future Improvements](#-future-improvements)
* [❓ FAQ](#-faq)
* [👩‍💻 Author](#-author)

---

# 💡 Project Overview

Lorkut v3.0 transforms the original static layout into a dynamic, database-driven application.

Core features include:

* Dynamic project rendering
* Community system
* Profile visit counter
* Testimonials with moderation status
* Multi-language support (EN, PT, ES, CA, FR)
* Modular configuration and bootstrap structure

The goal was to simulate a small real-world fullstack application while maintaining a cohesive visual identity.

---

# 🖼 Screenshots

![Homepage](assets/screenshots/homepage.png)
![Communities Section](assets/screenshots/communities.png)
![Projects Section](assets/screenshots/projects.png)


---

# 🛠 Tech Stack

**Frontend**

* HTML5
* CSS3
* JavaScript (Vanilla ES6+)

**Backend**

* PHP
* MySQL

**Architecture & Tools**

* Modular PHP structure (bootstrap, config, helpers)
* JSON-based translation system
* Git & GitHub
* InfinityFree deployment

---

# 🏗 Application Architecture

The project follows a modular structure:

```
/config
    bootstrap.php
    db_connect.php (ignored in Git)
    config.php (ignored in Git)

/database
    schema.sql

/lang
    en.json
    pt.json
    es.json
    ca.json
    fr.json

/assets
    img/
    screenshots/
```

Key architectural decisions:

* Centralized bootstrap file
* Session-based language handling
* Database separation from business logic
* Environment-specific configuration excluded via `.gitignore`

---

# 📋 Functional Requirements

* Render projects dynamically from database
* Display communities with unique slugs
* Count and store profile views
* Support multilingual navigation
* Responsive layout across devices
* Secure configuration separation

---

# ⚙️ Running the Project Locally

1. Clone the repository:

```bash
git clone https://github.com/yourusername/lorkut-fullstack.git
```

2. Place the project inside your local server directory (e.g., XAMPP `htdocs`).

3. Create a MySQL database named:

```
lorkut
```

4. Import the schema file located in:

```
/database/schema.sql
```

5. Create your own:

```
db_connect.php
config.php
```

(Use the provided example structure in the repository.)

6. Start Apache and MySQL.

7. Visit:

```
http://localhost/lorkut
```

---

# 🔎 Code Review Notes

* Sensitive configuration files are excluded using `.gitignore`.
* Database structure is included without production data.
* The architecture emphasizes clarity over framework complexity.
* The project intentionally avoids frameworks to reinforce core PHP understanding.

---

# 🚀 Future Improvements

* Admin dashboard for content management
* Authentication system
* Pagination system
* Improved validation and sanitization
* REST-style API separation
* Deployment migration to VPS or cloud service

---

# ❓ FAQ

### Is this the same as the static version?

No.
This version includes backend logic and database integration.

The static version is preserved in a separate repository.

---

### Does this repository include production credentials?

No.
Sensitive files are excluded via `.gitignore`.

---

### Why build without a framework?

To deepen understanding of core PHP, architecture structure, and manual routing before adopting frameworks.

---

# 👩‍💻 Author

Fully designed and developed by **Lorena Ferreira**.