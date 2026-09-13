# E2E Test Plan — Warung Soto Vokasi

## Application Overview

- **Stack**: Laravel 12 + Blade + Alpine.js + Tailwind CSS 3
- **URL**: `http://warung-soto-vokasi.test`
- **Auth**: Dual system — Users via Laravel Breeze (`/login`), Admins via custom session (`/admin/login`)
- **Payment**: Midtrans Snap integration on checkout

## Test Credentials

| Role | Email | Password | Access |
|------|-------|----------|--------|
| User | `test@example.com` | `password` | Profile, checkout, order history |
| Admin | `admin@warung-soto.com` | `password123` | Admin panel (no superadmin) |
| Superadmin | `superadmin@warung-soto.com` | `password123` | Full admin + admin management |

## Test Environment Notes

- Product/Category tables are **empty after seed** — tests must create data via admin CRUD or API
- Orders have no `user_id` column — orders are matched by `customer_email`
- The `check.profile` middleware requires `phone` AND `address` to access `/checkout` and `/orders`
- FAQ seeder is NOT called by `DatabaseSeeder` — FAQs must be created via admin

---

## 1. SMOKE TESTS

| ID | Scenario | Priority | Status |
|----|----------|----------|--------|
| S-01 | Homepage loads (200, correct title, non-empty body) | P0 | ✅ Implemented |
| S-02 | Page returns HTML content type | P1 | — |

## 2. PUBLIC NAVIGATION

| ID | Scenario | Priority | Status |
|----|----------|----------|--------|
| N-01 | Navigate to Home (`/`) — page loads, title contains "Beranda" | P0 | — |
| N-02 | Navigate to About (`/about`) — page loads, title contains "About" | P1 | — |
| N-03 | Navigate to Menu (`/menu`) — page loads, title contains "Menu" | P0 | — |
| N-04 | Navigate to Testimoni (`/testimonial`) — page loads, title contains "Testimoni" | P1 | — |
| N-05 | Navigate to FAQ (`/faq`) — page loads, title contains "FAQ" | P1 | — |
| N-06 | Navigate to Contact (`/contact`) — page loads, title contains "Contact" | P1 | — |
| N-07 | Nav links are visible and clickable on desktop | P1 | — |
| N-08 | All nav links resolve to correct pages | P1 | — |

## 3. USER AUTHENTICATION

| ID | Scenario | Priority | Status |
|----|----------|----------|--------|
| UA-01 | Login page loads with email/password form | P0 | — |
| UA-02 | Successful login with valid credentials redirects to `/` | P0 | — |
| UA-03 | Failed login with wrong password shows error | P0 | — |
| UA-04 | Failed login with nonexistent email shows error | P0 | — |
| UA-05 | Register page loads with name/email/password/confirm form | P1 | — |
| UA-06 | Successful registration creates account and logs in | P1 | — |
| UA-07 | Registration with mismatched passwords shows error | P1 | — |
| UA-08 | Registration with duplicate email shows error | P1 | — |
| UA-09 | Logout clears session and redirects to `/` | P0 | — |
| UA-10 | Logged-in user sees avatar/initial in navbar dropdown | P1 | — |
| UA-11 | Guest sees Login/Register links in navbar | P1 | — |

## 4. ADMIN AUTHENTICATION

| ID | Scenario | Priority | Status |
|----|----------|----------|--------|
| AA-01 | Admin login page loads (`/admin/login`) | P0 | — |
| AA-02 | Successful admin login redirects to `/admin/dashboard` | P0 | — |
| AA-03 | Failed admin login shows error | P0 | — |
| AA-04 | Admin logout flushes session and redirects to login | P0 | — |
| AA-05 | Unauthenticated admin accessing `/admin/dashboard` redirects to login | P1 | — |

## 5. USER PROFILE MANAGEMENT

| ID | Scenario | Priority | Status |
|----|----------|----------|--------|
| PM-01 | Profile page loads when logged in | P1 | — |
| PM-02 | Update profile name successfully | P1 | — |
| PM-03 | Update profile phone and address | P1 | — |
| PM-04 | Profile page redirects to login when not authenticated | P0 | — |
| PM-05 | Change password with correct current password | P1 | — |
| PM-06 | Change password with wrong current password shows error | P1 | — |

## 6. PUBLIC FORMS

### Contact Form
| ID | Scenario | Priority | Status |
|----|----------|----------|--------|
| CF-01 | Contact page loads with form fields | P0 | — |
| CF-02 | Submit contact form with valid data shows success | P0 | — |
| CF-03 | Submit contact form with empty required fields shows validation errors | P0 | — |
| CF-04 | Submit contact form with invalid email shows validation error | P1 | — |

### Testimonial Form
| ID | Scenario | Priority | Status |
|----|----------|----------|--------|
| TF-01 | Testimonial page loads | P1 | — |
| TF-02 | Modal opens when "Kirim Testimoni" is clicked | P1 | — |
| TF-03 | Submit testimonial with valid data shows success | P1 | — |
| TF-04 | Submit testimonial with empty required fields shows validation errors | P1 | — |

## 7. MENU PAGE (Search, Filter, Pagination)

| ID | Scenario | Priority | Status |
|----|----------|----------|--------|
| MP-01 | Menu page loads with product grid | P0 | — |
| MP-02 | Search input filters products by name | P1 | — |
| MP-03 | Category button filters products by category | P1 | — |
| MP-04 | "Semua" category button shows all products | P1 | — |
| MP-05 | Empty state shows when no products match search | P1 | — |
| MP-06 | Empty state shows when products table is empty | P1 | — |

## 8. ADMIN CRUD — Products

| ID | Scenario | Priority | Status |
|----|----------|----------|--------|
| AP-01 | Products index page loads | P0 | — |
| AP-02 | Empty state shows when no products exist | P1 | — |
| AP-03 | Create product form loads with fields | P0 | — |
| AP-04 | Create product with valid data and image redirects to index | P0 | — |
| AP-05 | Create product with empty required fields shows validation errors | P0 | — |
| AP-06 | Created product appears in index table | P0 | — |
| AP-07 | Edit product form loads with pre-filled data | P1 | — |
| AP-08 | Update product name and price | P1 | — |
| AP-09 | Delete product with confirmation removes from index | P1 | — |

## 9. ADMIN CRUD — Categories

| ID | Scenario | Priority | Status |
|----|----------|----------|--------|
| AC-01 | Categories index page loads | P0 | — |
| AC-02 | Empty state shows when no categories exist | P1 | — |
| AC-03 | Create category with valid data | P0 | — |
| AC-04 | Create category with empty name shows validation error | P0 | — |
| AC-05 | Category appears in index and product form dropdown | P0 | — |
| AC-06 | Edit category name | P1 | — |
| AC-07 | Delete category with confirmation | P1 | — |

## 10. ADMIN CRUD — Users

| ID | Scenario | Priority | Status |
|----|----------|----------|--------|
| AU-01 | Users index page loads | P0 | — |
| AU-02 | Create user with valid data | P1 | — |
| AU-03 | Create user with empty required fields shows validation errors | P1 | — |
| AU-04 | Edit user information | P1 | — |
| AU-05 | Delete user with confirmation | P1 | — |

## 11. ADMIN CRUD — FAQs

| ID | Scenario | Priority | Status |
|----|----------|----------|--------|
| AF-01 | FAQs index page loads | P1 | — |
| AF-02 | Create FAQ with valid data | P1 | — |
| AF-03 | FAQ appears in public FAQ page | P1 | — |
| AF-04 | Delete FAQ with confirmation | P1 | — |

## 12. ADMIN DASHBOARD

| ID | Scenario | Priority | Status |
|----|----------|----------|--------|
| AD-01 | Dashboard loads with stat cards | P0 | — |
| AD-02 | Stats show correct initial values (0 for empty DB) | P1 | — |
| AD-03 | Latest orders table is visible | P1 | — |

## 13. ADMIN ORDERS

| ID | Scenario | Priority | Status |
|----|----------|----------|--------|
| AO-01 | Orders index page loads | P1 | — |
| AO-02 | Order detail page loads | P1 | — |
| AO-03 | Update order status from detail page | P1 | — |

## 14. ERROR AND EMPTY STATES

| ID | Scenario | Priority | Status |
|----|----------|----------|--------|
| ES-01 | 404 page for nonexistent routes | P2 | — |
| ES-02 | Admin pages show empty state components when tables are empty | P1 | — |
| ES-03 | Product detail page for nonexistent product returns 404 | P1 | — |

## 15. RBAC / PERMISSIONS

| ID | Scenario | Priority | Status |
|----|----------|----------|--------|
| RB-01 | Regular admin cannot access `/admins` (superadmin route) | P1 | — |
| RB-02 | Regular admin can access all admin CRUD routes | P1 | — |
| RB-03 | Unauthenticated user cannot access admin routes | P0 | — |
| RB-04 | User cannot access `/checkout` without phone+address in profile | P1 | — |

## Summary

| Category | Total | P0 | P1 | P2 |
|----------|-------|----|----|-----|
| Smoke | 2 | 1 | 1 | 0 |
| Navigation | 8 | 2 | 6 | 0 |
| User Auth | 11 | 4 | 7 | 0 |
| Admin Auth | 5 | 3 | 2 | 0 |
| Profile | 6 | 1 | 5 | 0 |
| Contact Form | 4 | 2 | 2 | 0 |
| Testimonial | 4 | 0 | 4 | 0 |
| Menu | 6 | 1 | 5 | 0 |
| Products CRUD | 9 | 4 | 5 | 0 |
| Categories CRUD | 7 | 3 | 4 | 0 |
| Users CRUD | 5 | 0 | 5 | 0 |
| FAQs CRUD | 4 | 0 | 4 | 0 |
| Dashboard | 3 | 1 | 2 | 0 |
| Orders | 3 | 0 | 3 | 0 |
| Error/Empty | 3 | 0 | 2 | 1 |
| RBAC | 4 | 1 | 3 | 0 |
| **Total** | **84** | **23** | **60** | **1** |

## Implementation Plan

### Phase 1 — Critical Path (P0)
Smoke, navigation basics, user login/logout, admin login/logout, contact form submit, menu load, product CRUD (create+verify), category CRUD (create+verify).

### Phase 2 — Important (P1)
Registration, profile management, testimonial form, search/filter, edit/delete operations, all remaining CRUD, dashboard, orders, RBAC checks.

### Phase 3 — Edge Cases (P2)
404 handling, empty states, validation edge cases.
