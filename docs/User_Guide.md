# Warung Soto Vokasi — User & Administrator Guide

**Product:** Warung Soto Vokasi — Online menu, sales and order management system
**Version:** 1.0 (Laravel 12)
**Audience:** Store owners, administrators, technicians and developers

---

## Table of Contents

1. Introduction
2. Key Features
3. System Requirements
4. Installation
5. Initial Configuration
6. Admin Setup
7. User Management
8. Roles and Permissions
9. Module Guides
10. Business Workflows
11. Notifications
12. Reports
13. File Management
14. Email Configuration
15. Cron Configuration
16. Queue Configuration
17. Backup
18. Updates
19. Troubleshooting
20. FAQ
21. Security Recommendations
22. Support Information

---

## 1. Introduction

Warung Soto Vokasi is a complete web application for a food business that wants to:

- Present its **menu catalogue** online with photos, prices, halal information and descriptions.
- Receive and manage **customer orders** through an online checkout.
- Collect **online payments** securely using the Midtrans payment gateway (bank transfer, e-wallet and credit/debit card depending on the gateway configuration).
- Manage **testimonials, FAQs and customer enquiries** from one admin panel.

There are **two separate areas** in the application:

| Area | URL | Who uses it |
|---|---|---|
| Public storefront | `/` (e.g. `https://your-domain.com/`) | Everyone (visitors, customers) |
| Customer account area | `/login`, `/profile`, `/checkout`, `/orders` | Registered customers |
| Admin panel | `/admin/login` (e.g. `https://your-domain.com/admin/login`) | Store staff, administrators |

**For non-technical readers:** everything you need to run the store day-to-day is in Sections 6–11. Sections 3–5 (installation) and 14–18 should be handled by a technician.

---

## 2. Key Features

### Public storefront
- **Home page** — featured menu items, testimonials and FAQ highlights.
- **About page** — information about the business.
- **Menu catalogue** — searchable product list with category filters, photos and prices.
- **Product detail pages** — full description, ingredients and halal badge.
- **Contact form** — visitors can send messages that arrive in the admin inbox.
- **Testimonial wall** — customer reviews that appear **only after admin approval**.
- **FAQ** — commonly asked questions.

### Customer accounts
- Registration, login and logout.
- Profile with name, e-mail, phone, address and avatar photo.
- **Checkout** — an order is created on the server using official product prices (quantities are revalidated server-side).
- **Online payment** via the Midtrans **Snap** pop-up.
- Order history and a success screen after payment.

### Admin panel
- **Dashboard** — today's orders, total orders, pending payments, total revenue, newest transactions, daily order chart and monthly revenue chart.
- **Contact inbox** — view and manage customer messages.
- **Testimonial moderation** — approve or reject reviews.
- **Product management** — create, edit, delete products and categories.
- **FAQ management** — create, edit, order and delete FAQs.
- **Order management** — view orders and update their status.
- **User management** — create, edit, delete customer accounts.
- **Admin management** (superadmin only) — create admin staff and roles.

---

## 3. System Requirements

### Server (production)
| Resource | Minimum | Recommended |
|---|---|---|
| Web server | Apache or Nginx | Nginx |
| PHP | 8.2 | 8.3 |
| Database | MySQL 8.0 / MariaDB 10.4+ | MySQL 8.0 |
| Memory | 512 MB | 1 GB+ |
| Disk | 2 GB | 10 GB (photos grow over time) |
| HTTPS certificate | Required | Let's Encrypt / managed certificate |
| Composer | 2.x | 2.x |
| Node.js (build only) | 18+ | 20+ |

### Local development (Windows/macOS/Linux)
- PHP 8.2+ (with extensions: `openssl`, `pdo_mysql`, `mbstring`, `tokenizer`, `xml`, `ctype`, `json`, `curl`)
- MySQL 8.0 or compatible (e.g. Laragon/XAMPP/Homebrew MySQL)
- Composer
- Node.js 18+
- An editor (VS Code recommended) and Git

> **For non-developers:** if you are not a developer, ask your hosting provider to create an environment that meets the requirements above before continuing to Section 4.

---

## 4. Installation

The steps below assume a Linux-style server or a local machine with a terminal. Commands are shown for macOS/Linux (bash) and, where different, for Windows PowerShell.

> ![Screenshot: project files in a code editor](docs/screenshots/placeholder-01-editor.png)
> *Placeholder — replace with a screenshot of the project folder being opened in your editor.*

### 4.1 Obtain the source code

Clone the repository:

```bash
git clone https://github.com/kuncooroo/warung-soto-vokasi.git
cd warung-soto-vokasi
```

### 4.2 Install dependencies

```bash
composer install
npm install
```

On Windows PowerShell the commands are the same. If you encounter memory errors with `npm install`, run:

```bash
npm install --no-audit --no-fund
```

### 4.3 Configure environment

```bash
cp .env.example .env
```

On Windows:

```powershell
Copy-Item .env.example .env
```

Open the `.env` file and set:

```ini
APP_NAME="Warung Soto Vokasi"
APP_ENV=local
APP_URL=http://localhost        # or http://warung-soto-vokasi.test
APP_KEY=                        # leave empty; generated in next step

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=warung_soto_vokasi
DB_USERNAME=root
DB_PASSWORD=
```

> **Important:** the `.env` file contains secrets (database passwords, payment keys). It is automatically excluded from Git — never commit it, never e-mail it, and never paste it into a public chat.

Generate the application key (required — the app will not run without it):

```bash
php artisan key:generate
```

### 4.4 Create the database

Create an empty database named `warung_soto_vokasi` using your database tool (phpMyAdmin, MySQL Workbench, or the MySQL command line):

```sql
CREATE DATABASE warung_soto_vokasi CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 4.5 Run migrations and seeders

Migrations create all tables. Seeders populate default data:

```bash
php artisan migrate --seed
```

This creates:
- Admin accounts (see Section 6).
- Organisational/administrative settings and empty catalogues.

### 4.6 Build front-end assets

```bash
npm run build
```

During development you can instead use the live-reload watcher with the development servers:

```bash
composer run dev
```

This starts PHP, the queue worker, the log tail and Vite together.

### 4.7 Create the storage link

Avatars and uploaded images are served through a symbolic link:

```bash
php artisan storage:link
```

> ![Screenshot: storage linked](docs/screenshots/placeholder-02-storage-link.png)
> *Placeholder — screenshot of the command output.*

### 4.8 Open the application

- Storefront: `http://localhost/`
- Admin panel: `http://localhost/admin/login`

---

## 5. Initial Configuration

After installation, review and set the following before going live.

### 5.1 Application settings (`.env`)

| Setting | Value | Explanation |
|---|---|---|
| `APP_NAME` | Warung Soto Vokasi | Shown in the browser title and e-mails |
| `APP_ENV` | `production` (live) | Never `local` on a live server |
| `APP_DEBUG` | `false` (live) | When `true`, technical error pages are visible to visitors — **do not enable on a live site** |
| `APP_URL` | `https://your-domain.com` | Must match the real domain; is used in generated links |
| `SESSION_LIFETIME` | `120` | Minutes a login stays active without activity |
| `SESSION_SECURE_COOKIE` | `true` (live) | Sends session cookies only over HTTPS |

### 5.2 Admin accounts

The project seeds two admin accounts. **Change the passwords immediately** (see Section 8.4).

| Role | E-mail | Initial password |
|---|---|---|
| Superadmin | `superadmin@warung-soto.com` | `password123` |
| Admin | `admin@warung-soto.com` | `password123` |

> ![Screenshot: admin login screen](docs/screenshots/placeholder-03-admin-login.png)
> *Placeholder — screenshot of the admin login form.*

### 5.3 Online payments (Midtrans)

Warung Soto Vokasi processes payments through **Midtrans**.

1. Create a Midtrans account at https://midtrans.com (sandbox and production).
2. Copy the **Server Key** and **Client Key**.
3. Set them in `.env`:

```ini
MIDTRANS_SERVER_KEY=Mid-server-xxxxxxxx
MIDTRANS_CLIENT_KEY=Mid-client-xxxxxxxx
MIDTRANS_IS_PRODUCTION=false   # true when going live
```

4. In the Midtrans dashboard, set the **Payment Notification URL** to:

```
https://your-domain.com/payment-callback
```

5. For initial testing, keep the **sandbox** mode (`MIDTRANS_IS_PRODUCTION=false`) and use Midtrans's sandbox test cards/banks.

> **For developers:** the callback is verified cryptographically — the server compares the SHA-512 signature (`order_id + status_code + gross_amount + ServerKey`) sent by Midtrans and rejects any notification that does not match. Do not disable this check.

> ![Screenshot: Midtrans sandbox dashboard](docs/screenshots/placeholder-04-midtrans.png)
> *Placeholder — screenshot of the Midtrans dashboard configuration page.*

### 5.4 Shop details

Configure the display name and logo/branding. Replace `resources/views/layouts/` header branding and the on-package title in `config/app.php` as desired. E-mail sender details (see Section 14) also belong here.

---

## 6. Admin Setup

### 6.1 First login

1. Open `/admin/login`.
2. Sign in with the superadmin account (Section 5.2).
3. The dashboard is displayed.

> ![Screenshot: admin dashboard](docs/screenshots/placeholder-05-dashboard.png)
> *Placeholder — screenshot of the dashboard with today's figures.*

### 6.2 Change the default passwords

1. This release does not include a "change my password" page in the admin panel by default — password changes are done through the **admin management** module (superadmin) or by a technician:

```bash
php artisan tinker
```

then, on PHP 8.2+ / Laravel 12:

```php
$admin = App\Models\Admin::where('email', 'superadmin@warung-soto.com')->first();
$admin->password = Illuminate\Support\Facades\Hash::make('YourNewStrongPassword!2026');
$admin->save();
```

2. Repeat for the `admin` account. **Keep the passwords in a password manager.**

> **For non-developers:** ask your technician to run the command above, or use Section 8.4 if admin self-service is available in your version.

### 6.3 Admin panel layout

The admin panel contains these menus:

| Menu | Purpose |
|---|---|
| Dashboard | Overview of sales activity |
| Users | Customer accounts |
| Products | Menu items and prices |
| Categories | Product groups |
| FAQs | Frequently asked questions |
| Testimoni | Reviews awaiting approval |
| Contact | Customer messages |
| Orders | Customer orders and statuses |
| Admins (superadmin only) | Staff accounts and roles |

---

## 7. User Management

### 7.1 What is a user?

A "user" is a customer account. Customers can:
- register on the storefront,
- update their profile (name, e-mail, phone, address, avatar),
- place orders, and
- view their order history.

### 7.2 Managing users (admin)

1. Log in to the admin panel → **Users**.
2. The list shows name, e-mail, phone, address and the date the account was created.

**Create a user:**
1. Click **Create** (Add User).
2. Fill in name, e-mail, password and optional phone/address/avatar.
3. Click **Save**.

**Edit a user:**
1. Open the user record.
2. Update the fields. Leave the password field empty to keep the current password.
3. Click **Save**.

**Delete a user:**
1. Open the user record and choose **Delete**.
2. Confirm the deletion. This permanently removes the account and its avatar.

> **For developers:** user management lives in `app/Http/Controllers/Admin/UserController.php`. Deleting a user does **not** delete their past orders — acceptable for this product; delete orders separately if needed (Section 9.6).

---

## 8. Roles and Permissions

The application has two role systems, kept deliberately separate:

### 8.1 Customer roles (storefront)
- **Guest** — browses the catalogue, reads testimonials/FAQ, uses the contact form.
- **Registered customer** — everything a guest can do, plus profile, checkout and order history.

### 8.2 Administrator roles (admin panel)

| Capability | Admin | Superadmin |
|---|---|---|
| View dashboard | ✅ | ✅ |
| Manage products & categories | ✅ | ✅ |
| Manage FAQs | ✅ | ✅ |
| Moderate testimonials | ✅ | ✅ |
| Manage contact inbox | ✅ | ✅ |
| Manage orders | ✅ | ✅ |
| Manage customer users | ✅ | ✅ |
| Manage admin accounts & assign roles | ❌ | ✅ |
| Delete admin accounts | ❌ | ✅ |

A normal **Admin** cannot access the **Admins** section (a "Hanya superadmin" error is shown if attempted).

### 8.3 Changing an admin's role
1. Log in as **superadmin**.
2. Go to **Admins** → edit the target administrator.
3. Set the role to **Admin** or **Superadmin** and save.

Keep the number of superadmins as small as possible.

### 8.4 Changing an admin password (admin self-service)
If you manage administrators via the **Admins** module:
1. Open the administrator record.
2. Enter a new password in the provided field (leave empty to keep the current password).
3. Save.

> **For developers:** role checks are enforced in two places — the `admin` middleware (`app/Http/Middleware/AdminMiddleware.php`) guards all admin routes, and controller-level superadmin checks enforce the higher role.

---

## 9. Module Guides

### 9.1 Products (menu items)

**Create a product**
1. Admin panel → **Products** → **Tambah Produk / Create**.
2. Fill in:
   - **Name**
   - **Category** (choose from existing)
   - **Description**
   - **Price**
   - **Ingredients** (optional)
   - **Halal** (badge shown on the product card)
   - **Image** (JPG/PNG/GIF, max 2 MB)
3. Click **Save**. A URL-friendly "slug" is generated automatically from the name.

**Edit / delete** — use the corresponding buttons on the product list. Deleting a product also removes its sales-history links (order items) — delete only when sure.

> ![Screenshot: product create form](docs/screenshots/placeholder-06-product.png)
> *Placeholder — screenshot of the product create/edit form.*

### 9.2 Categories

Categories group products for the menu filter. Create, rename and delete from **Categories**. Deleting a category does **not** delete its products — first move products to another category to keep the catalogue tidy.

### 9.3 FAQs

1. Admin panel → **FAQs** → **Create**.
2. Enter **Question** and **Answer**.
3. The **Order** number controls where the FAQ appears on the public page.

### 9.4 Testimonials (moderation)

Customers can submit reviews with a rating (1–5) and optional photo. Reviews are **not shown publicly until approved**.

1. Admin panel → **Testimoni**.
2. Review the pending item.
3. Click **Approve** to publish, or **Reject** to remove it.

> ![Screenshot: testimonial moderation list](docs/screenshots/placeholder-07-testimonial.png)
> *Placeholder — screenshot of the testimonial moderation screen.*

### 9.5 Contact inbox

Messages sent from the public contact form arrive here.

- **View** a message to see name, e-mail, phone, subject and body; the message is automatically marked as read.
- **Delete** a message after it has been handled.

### 9.6 Orders

The order list shows all customer orders with customer details, items, totals and payment status.

**Order statuses**
- `pending` — waiting for payment or processing.
- `completed` — paid/settled.
- `failed` — payment failed, expired or cancelled.

**Update an order**
1. Open the order.
2. Choose the new order status (and payment status when appropriate).
3. Save.

> **For developers:** the dashboard's total revenue reads orders with payment status of "paid"; the system stores "completed" — confirm the status vocabulary with the store owner and align in one place (`app/Http/Controllers/Admin/DashboardController.php` and `app/Http/Controllers/Admin/OrderController.php`) if the chart shows zero.

### 9.7 Online payment flow (Midtrans Snap)

1. Customer fills the checkout form.
2. The server creates the order with **official prices** and returns a secure **Snap token**.
3. The Midtrans Snap pop-up opens for payment.
4. Midtrans sends a callback to `/payment-callback`.
5. The server verifies the callback signature and amount, then marks the order `completed` and records the transaction in **payment history**.
6. The customer receives a payment-success e-mail.

> ![Screenshot: Midtrans Snap payment pop-up](docs/screenshots/placeholder-08-snap.png)
> *Placeholder — screenshot of the Snap payment dialog.*

---

## 10. Business Workflows

### Workflow 1 — From order to delivery

```
Customer browses menu
        │
        ▼
Adds items to cart (checkout page)
        │
        ▼
Fills shipping details (name, e-mail, phone, address)
        │
        ▼
Server creates order (status: pending payment)
        │
        ▼
Customer pays via Midtrans Snap
        │
        ▼
Midtrans callback → signature verified → order = completed
        │
        ▼
Confirmation + payment-success e-mails sent
        │
        ▼
Kitchen prepares and delivers
```

**Step-by-step (store side):**
1. Keep an eye on the **Dashboard → Newest Transactions** and the **Orders** module.
2. When an order is `completed`, prepare the items using the order detail (name, address, notes).
3. After fulfilment, optionally update the order status to reflect delivery.

> **For non-developers:** orders only count as paid when the official payment notification arrives from Midtrans. A customer cannot "fake" a payment through the checkout page.

### Workflow 2 — Customer review (testimonial)

1. Customer submits a review with rating and photo.
2. It appears in **Admin → Testimoni** as unapproved.
3. Admin approves → published on the public page.
4. Admin rejects → removed.

### Workflow 3 — Contact enquiry

1. Visitor submits the contact form.
2. Admin receives the message in **Contact** (and an e-mail notification if configured — Section 14).
3. Admin reads the message (marked as read) and replies externally.
4. Admin deletes the message once resolved.

---

## 11. Notifications

### 11.1 E-mail notifications

| Notification | Recipient | When |
|---|---|---|
| Order confirmation | Customer | Immediately after placing an order |
| Payment success | Customer | When Midtrans confirms the payment (settlement) |
| New contact message | Site mailbox (`MAIL_FROM_ADDRESS`) | When a visitor sends a message |

E-mails require a working **email configuration** (Section 14). In the current release notification e-mails are sent using the application's mail settings; a queue system can be enabled (Section 16) to avoid any impact on page speed.

### 11.2 In-app notifications (for developers)

Laravel's `notifications` table is installed. A `NewOrderNotification` class (`app/Notifications/NewOrderNotification.php`) is provided for wiring administrators' in-app/on-demand new-order alerts into the dashboard layout. If the dashboard does not yet show a notification bell, this hook is intentionally left for the next release — email remains the active channel.

---

## 12. Reports

The **Dashboard** provides the following at a glance:

| Metric | Description |
|---|---|
| Today's Orders | Orders created today |
| Total Orders | All orders |
| Total Users | Registered customer accounts |
| Pending Payments | Orders waiting for payment |
| Total Revenue | Sum of paid orders |
| Total Products / Testimonials / Messages | Current catalogue size, reviews and inbox depth |
| Newest Transactions | The 7 most recent orders |
| Daily Orders (7-day chart) | Orders per day for the last week |
| Monthly Revenue (6-month chart) | Revenue per month for the last half-year |

> ![Screenshot: dashboard charts](docs/screenshots/placeholder-09-charts.png)
> *Placeholder — screenshot of the daily-orders and monthly-revenue charts.*

**Export/print:** there is no built-in Excel export. Use the browser's **Print → Save as PDF** on the dashboard (or the Orders page) for simple reporting, or ask a developer to add an export.

---

## 13. File Management

The application stores files of three kinds:

| Type | Location on server | How it is served |
|---|---|---|
| Product images | `public/images/products/` | Directly by the web server |
| Testimonial images | `public/images/testimonials/` | Directly by the web server |
| User avatars | `storage/app/public/avatars/` | Through the `public/storage` link |

Rules applied to uploads:
- Allowed formats: JPG, JPEG, PNG, GIF.
- Maximum size per file: **2 MB**.
- File names are randomised server-side (the client's file name is never used for the stored file).

**Housekeeping recommendations**
- Place the template/static images that ship with the product under `public/images/seed/` and keep it read-only.
- Regularly copy `public/images/` to your backup (Section 17).
- If the storage link is missing, avatars show broken images — restore it with:

```bash
php artisan storage:link
```

---

## 14. Email Configuration

### 14.1 Choose a mail provider

Set these values in `.env`:

| Variable | Example | Meaning |
|---|---|---|
| `MAIL_MAILER` | `smtp` | Mail driver |
| `MAIL_HOST` | `smtp.yourprovider.com` | SMTP server |
| `MAIL_PORT` | `587` | Port (587 for TLS) |
| `MAIL_USERNAME` | `no-reply@your-domain.com` | Login |
| `MAIL_PASSWORD` | `************` | Login / app password |
| `MAIL_FROM_ADDRESS` | `no-reply@your-domain.com` | The "from" address customers see |
| `MAIL_FROM_NAME` | `"Warung Soto Vokasi"` | Sender display name |

**Local development** uses a development mailbox:

```ini
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=<mailtrap-username>
MAIL_PASSWORD=<mailtrap-password>
```

**Testing without a mail server:**

```ini
MAIL_MAILER=log
```

With `log`, e-mails are written to `storage/logs/laravel.log` instead of being sent.

### 14.2 Send a test

No built-in test button exists. To verify end-to-end, place an order (you will receive the order-confirmation e-mail) or send the contact form.

> **For developers:** mail is configured in `config/mail.php`. The mail classes are `app/Mail/OrderConfirmationMail.php`, `app/Mail/PaymentSuccessMail.php` and `app/Mail/ContactNotification.php`.

---

## 15. Cron Configuration

### 15.1 The scheduler

Laravel uses a single cron job that runs every minute and delegates to application tasks.

**For Linux servers** — open the crontab for the web user:

```bash
crontab -e
```

Add the line (adjust the path to your installation):

```bash
* * * * * cd /home/user/warung-soto-vokasi && php artisan schedule:run >> /dev/null 2>&1
```

With **Laragon/Windows** under development, no cron is required — tasks run manually:

```bash
php artisan schedule:run
```

### 15.2 Tasks scheduled by the application

The application schedules the demo/miscellaneous maintenance tasks (e.g. hourly reset in demo installs). On a normal production install the scheduler is optional but recommended so scheduled maintenance can run unattended.

**Verify the schedule is registered:**

```bash
php artisan schedule:list
```

---

## 16. Queue Configuration

### 16.1 Why queues

Tasks such as sending e-mails and heavy processing are pushed to a **queue** so the website answers quickly. Warung Soto Vokasi ships with the **database** queue driver.

| Variable | Recommended value |
|---|---|
| `QUEUE_CONNECTION` | `database` (used by default) |

### 16.2 Run the queue worker

**During development**, start the worker in a terminal:

```bash
php artisan queue:work
```

To restart it after code changes during development: `php artisan queue:restart`.

**On production**, a supervisor-like process keeps the worker alive. Example systemd/supervisor command:

```bash
php artisan queue:work --tries=3
```

### 16.3 Control the worker with the Laravel Scheduler

To keep the worker running from cron (alternative to supervisor):

1. Enable `withoutOverlapping()` in a scheduled job or simply run the worker under a process manager.
2. A simple cron approach for small setups:

```bash
* * * * * cd /path/to/app && php artisan queue:work --once --stop-when-empty >> /dev/null 2>&1
```

> **For non-developers:** queues are an optimisation. If you do not see slow page loads, no queue worker is required — the application still works because e-mails and notifications currently run **synchronously**.

### 16.4 Processing queue jobs

There are no app-specific queueable jobs in this release; the queue infrastructure is ready for future use. If `QUEUE_CONNECTION=database`, the `jobs` and `failed_jobs` tables are already migrated.

---

## 17. Backup

A complete backup has **three parts**:

1. **Database** — all data (products, orders, users, messages).
2. **Uploaded files** — `public/images/` and `storage/app/public/`.
3. **Configuration** — `.env` (contains keys — store it encrypted).

### 17.1 Backup the database

**MySQL command line:**

```bash
mysqldump -u USER -p warung_soto_vokasi > warung_soto_backup_$(date +%F).sql
```

**Windows (PowerShell):**

```powershell
mysqldump -u root -p warung_soto_vokasi | Out-File warung_soto_backup_$(Get-Date -Format yyyy-MM-dd).sql -Encoding utf8
```

### 17.2 Backup files

```bash
tar -czf warung_soto_files_backup.tar.gz public/images storage/app/public storage/logs/laravel.log
```

### 17.3 Restore

```bash
mysql -u USER -p warung_soto_vokasi < warung_soto_backup_YYYY-MM-DD.sql
```

Then unpack the files backup:

```bash
tar -xzf warung_soto_files_backup.tar.gz
```

### 17.4 Backup policy (recommended)

- **Daily** database backup (automate with cron).
- **On every change** of products/prices.
- Store backups **off-site** (different server or object storage) for at least 30 days.
- Test a restore at least once a quarter.

> **Important:** database dumps contain customer personal data. Secure them like passwords (encrypted storage, restricted access).

---

## 18. Updates

Plan updates during low-traffic periods. Always back up first (Section 17).

### 18.1 Update the application code

```bash
git pull
composer install --no-dev --optimize-autoloader   # production
npm install
npm run build
```

### 18.2 Run migrations

```bash
php artisan migrate --force
```

### 18.3 Refresh caches

```bash
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### 18.4 Restart the queue worker

```bash
php artisan queue:restart
```

### 18.5 Check for vulnerable dependencies (developers)

```bash
composer audit
npm audit
```

---

## 19. Troubleshooting

| Symptom | Probable cause | Solution |
|---|---|---|
| White page / "APP_KEY missing" | `.env` key not generated | `php artisan key:generate` |
| Error page shows code traces to visitors | `APP_DEBUG=true` | Set `APP_DEBUG=false`, then `php artisan config:cache` |
| Login page returns "419 Page Expired" | CSRF token expired (long form idle) | Reload the page and log in again; extend `SESSION_LIFETIME` if needed |
| Admin login: "Email atau password salah" | Wrong credentials, or account locked after 5 failed attempts (per e-mail+IP) | Wait 1 minute or use the correct account |
| Avatars broken / 404 on `/storage/...` | Storage link missing | `php artisan storage:link` |
| Checkout shows no payment pop-up | Midtrans keys invalid, or account not in sandbox | Verify `MIDTRANS_SERVER_KEY`/`MIDTRANS_CLIENT_KEY` and `MIDTRANS_IS_PRODUCTION`; check the Midtrans dashboard |
| Orders never become "completed" after payment | Callback URL not set on Midtrans, or domain mismatch | Set the Payment Notification URL to `https://your-domain.com/payment-callback` |
| Payment success e-mail not received | Mail settings, spam folder, or `MAIL_MAILER=log` | Check `storage/logs/laravel.log`; test with a real mailbox |
| Dashboard revenue shows 0 | Status-vocabulary mismatch ("paid" vs "completed") | See Section 9.6 note for developers |
| Slowly loading product grid images | Large photos | Re-export images ≤ 2 MB and re-upload |
| "Class not found" after an update | Composer autoload outdated | `composer dump-autoload` |
| Vite assets missing (unstyled page) | Assets not built | `npm install` then `npm run build` |

---

## 20. FAQ

**Can I change menus and prices myself?**
Yes — login to the admin panel, go to **Products**, and create/edit items. Prices take effect immediately.

**How do customers pay?**
Through the Midtrans **Snap** payment pop-up (bank transfer, e-wallet, cards, depending on your Midtrans configuration).

**How do I switch from test payments to real ones?**
1. Subscribe/verify your Midtrans production account.
2. Set `MIDTRANS_IS_PRODUCTION=true` and the production keys in `.env`.
3. Update the Payment Notification URL for production.
4. Run `php artisan optimize:clear`.

**Why isn't my testimonial visible immediately?**
All testimonials are moderated. An administrator must approve them in **Admin → Testimoni**.

**What are the maximum image sizes?**
2 MB per file, formats JPG/PNG/GIF. Larger files are rejected by the form.

**How long does a login session last?**
`SESSION_LIFETIME` (default 120 minutes) of inactivity. The value is in `.env`.

**Can customers order without an account?**
No — checkout requires a registered account with a phone number and address filled in (the "check.profile" rule).

**Is the payment callback secure?**
Yes. The server cryptographically verifies each Midtrans notification (SHA-512 signature and amount) before changing any order status.

**Where are uploaded files stored?**
`public/images/products/`, `public/images/testimonials/`, and `storage/app/public/avatars/` (Section 13).

**Do I need to run a queue worker?**
Not for the current release — e-mails are sent synchronously. The infrastructure is ready for future use.

---

## 21. Security Recommendations

Follow these for a commercial deployment:

1. **Keep `APP_DEBUG=false`** and `APP_ENV=production` on live servers.
2. **Use HTTPS everywhere** — the application already forces it in production; keep the certificate renewed.
3. **Change default passwords immediately** (superadmin + admin) and use strong, unique passwords.
4. **Limit superadmins** to the minimum necessary.
5. **Never commit `.env`** — it holds database and payment secrets. It is already in `.gitignore`.
6. **Rotate the Midtrans Server Key** if it has been exposed anywhere; keep the Client Key public (it is meant to be) — the Server Key must stay private.
7. **Keep the payment callback verification intact** — never disable signature/amount checks.
8. **Do not allow `.env` overrides** in production (the technician configures `config/bootstrap` accordingly).
9. **Session hardening on live deployments:**

```ini
SESSION_SECURE_COOKIE=true
SESSION_HTTP_ONLY=true
SESSION_SAME_SITE=lax
```

10. **Rate limits are active** on customer login (5 attempts per e-mail+IP) and admin login (5 attempts). Keep them.
11. **Run dependency audits** during updates: `composer audit` and `npm audit`.
12. **Keep backups** of the database and files, off-site and encrypted (Section 17).
13. **Publish and review** the reports regularly — a sudden rise in "pending" orders can indicate payment-attempt failures.
14. If you operate a **public demo**, enable `DEMO_MODE` so destructive actions are blocked and data resets hourly (see the product's demo-mode companion guide).

---

## 22. Support Information

**Product:** Warung Soto Vokasi
**License:** MIT (open source)

| Channel | Details |
|---|---|
| Repository | https://github.com/kuncooroo/warung-soto-vokasi |
| Issues (bugs & feature requests) | https://github.com/kuncooroo/warung-soto-vokasi/issues |
| Payment gateway | Midtrans — https://midtrans.com (their support handles gateway outages and account issues) |
| Development stack help | https://laravel.com/docs — official Laravel documentation |

**When reporting a problem, always include:**
1. The page/URL and the exact steps to reproduce.
2. What you expected to happen vs. what happened.
3. Browser name/version, device and operating system.
4. A screenshot if the issue is visual.
5. For technical issues: `php artisan --version`, the PHP version, and the relevant part of `storage/logs/laravel.log`.

**Escalation path:**
1. **Store owner** — check the FAQ (Section 20) and troubleshooting (Section 19) first.
2. **Your technician / hosting provider** — server-level issues (domain, HTTPS, cron, queues, mail).
3. **Midtrans support** — payment outages, account, or callback problems that meet their guidelines.
4. **Project maintainers (via GitHub Issues)** — application bugs with clear reproduction steps.

---

*End of guide — Warung Soto Vokasi v1.0.*