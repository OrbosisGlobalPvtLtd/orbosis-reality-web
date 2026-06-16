# Orbosis Reality

A Laravel-based real estate website designed for property listing, property details, frontend pages, and admin management.

## Tech Stack
- **Framework:** Laravel (PHP)
- **Database:** MySQL
- **Frontend / Templating:** Blade, Bootstrap, CSS, JavaScript

---

## Setup Steps

Follow these steps to set up the project locally:

1. **Clone the repository:**
   ```bash
   git clone <repository-url>
   cd orbosis-reality-web
   ```

2. **Environment Configuration:**
   Copy the example environment file to create your local `.env`:
   ```bash
   cp .env.example .env
   ```

3. **Configure Database:**
   Open the `.env` file and configure your database settings:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database_name
   DB_USERNAME=your_database_username
   DB_PASSWORD=your_database_password
   ```

4. **Install Dependencies:**
   Run composer to install PHP dependencies:
   ```bash
   composer install
   ```

5. **Generate Application Key:**
   ```bash
   php artisan key:generate
   ```

6. **Database Migrations:**
   Run migrations *only if required*:
   ```bash
   php artisan migrate
   ```

7. **Clear Cache/Optimize:**
   ```bash
   php artisan optimize:clear
   ```

8. **Directory Permissions:**
   Ensure proper write permissions are set for `storage` and `bootstrap/cache` directories:
   ```bash
   chmod -R 775 storage bootstrap/cache
   ```

---

## Deployment Notes (Hostinger)

When deploying to Hostinger, keep the following guidelines in mind:
* **Environment Files:** Keep the `.env` file only on the production server. Never commit it.
* **No Direct Live Editing:** Do not edit files directly on the live server.
* **Version Control:** Always use the GitHub repository for version control.
* **Code Review:** Deploy reviewed and tested code only.
* **Credential Rotation:** Change FTP, SSH, and admin panel passwords regularly (especially after cleanups).

---

## Security Notes

To maintain a secure production environment:
* **No Arbitrary Uploads:** Do not upload random or untrusted PHP files inside the `public` folder.
* **File Manager Scripts:** Do not leave file manager scripts (e.g., cPanel/Hostinger file managers or web-based file managers) active on the server.
* **No Backups in Repo:** Do not commit database dumps (`.sql`), compressed archives (`.zip`, `.tar.gz`), or system backups to the repository.
* **Code Auditing:** Always review file changes and diffs thoroughly before deployment.

---

## Maintainer
**Orbosis Global Pvt Ltd**
