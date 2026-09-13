import { test, expect } from '@playwright/test';
import { loginAdmin, uniqueName, uniqueEmail } from './helpers';

test.describe('Admin Products CRUD', () => {
  test('AP-01: products index page loads', async ({ page }) => {
    await loginAdmin(page);
    await page.goto('/admin/products');
    await expect(page).toHaveTitle(/produk/i);
    await expect(page.getByText('Kelola Produk')).toBeVisible();
  });

  test('AP-02: empty state shows when no products', async ({ page }) => {
    await loginAdmin(page);
    await page.goto('/admin/products');
    await expect(page.locator('text=Belum ada produk').first()).toBeVisible({ timeout: 5000 });
  });

  test('AP-03: create product form loads', async ({ page }) => {
    await loginAdmin(page);
    await page.goto('/admin/products/create');
    await expect(page.getByText('Tambah Produk Baru')).toBeVisible();
    await expect(page.locator('input[name="name"]')).toBeVisible();
    await expect(page.locator('select[name="category_id"]')).toBeVisible();
    await expect(page.locator('textarea[name="description"]')).toBeVisible();
    await expect(page.locator('input[name="price"]')).toBeVisible();
  });
});

test.describe('Admin Categories CRUD', () => {
  test('AC-01: categories index page loads', async ({ page }) => {
    await loginAdmin(page);
    await page.goto('/admin/categories');
    await expect(page).toHaveTitle(/kategori/i);
    await expect(page.getByText('Kelola Kategori')).toBeVisible();
  });

  test('AC-02: empty state shows when no categories', async ({ page }) => {
    await loginAdmin(page);
    await page.goto('/admin/categories');
    await expect(page.locator('text=Belum ada kategori').first()).toBeVisible({ timeout: 5000 });
  });

  test('AC-03: create category with valid data', async ({ page }) => {
    await loginAdmin(page);
    await page.goto('/admin/categories/create');

    const catName = uniqueName('E2E-Kategori');
    await page.fill('input[name="name"]', catName);
    await page.fill('textarea[name="description"]', 'Deskripsi kategori E2E');
    await page.getByRole('button', { name: 'Simpan Kategori' }).click();

    await page.waitForURL('**/admin/categories', { timeout: 10000 });
    await expect(page.getByText(catName)).toBeVisible({ timeout: 10000 });
  });

  test('AC-04: create category with empty name shows error', async ({ page }) => {
    await loginAdmin(page);
    await page.goto('/admin/categories/create');
    await page.getByRole('button', { name: 'Simpan Kategori' }).click();

    await expect(page).toHaveURL(/\/admin\/categories\/create/);
    await expect(page.locator('.bg-red-50, .text-red-500, .text-red-600, [class*="red"]').first()).toBeVisible({ timeout: 10000 });
  });

  test('AC-05: created category appears in index', async ({ page }) => {
    await loginAdmin(page);
    const catName = uniqueName('E2E-Visible');
    await page.goto('/admin/categories/create');
    await page.fill('input[name="name"]', catName);
    await page.getByRole('button', { name: 'Simpan Kategori' }).click();
    await page.waitForURL('**/admin/categories', { timeout: 10000 });
    await expect(page.getByText(catName)).toBeVisible({ timeout: 10000 });
  });
});

test.describe('Admin Users CRUD', () => {
  test('AU-01: users index page loads', async ({ page }) => {
    await loginAdmin(page);
    await page.goto('/admin/users');
    await expect(page).toHaveTitle(/user/i);
    await expect(page.getByText('Kelola User')).toBeVisible();
  });

  test('AU-02: create user with valid data', async ({ page }) => {
    await loginAdmin(page);
    await page.goto('/admin/users/create');

    const userName = uniqueName('E2E-User');
    const userEmail = uniqueEmail('e2e-admin-user');
    await page.fill('input[name="name"]', userName);
    await page.fill('input[name="email"]', userEmail);
    await page.fill('input[name="password"]', 'Password123!');
    await page.getByRole('button', { name: 'Simpan User' }).click();

    await page.waitForURL('**/admin/users', { timeout: 10000 });
    await expect(page.getByText(userName)).toBeVisible({ timeout: 10000 });
  });

  test('AU-03: create user with empty required fields shows errors', async ({ page }) => {
    await loginAdmin(page);
    await page.goto('/admin/users/create');
    await page.getByRole('button', { name: 'Simpan User' }).click();

    await expect(page).toHaveURL(/\/admin\/users\/create/);
    await expect(page.locator('.bg-red-50, .text-red-500, .text-red-600, [class*="red"]').first()).toBeVisible({ timeout: 10000 });
  });
});

test.describe('Admin FAQs CRUD', () => {
  test('AF-01: FAQs index page loads', async ({ page }) => {
    await loginAdmin(page);
    await page.goto('/admin/faqs');
    await expect(page).toHaveTitle(/faq/i);
    await expect(page.getByText('Daftar FAQ')).toBeVisible();
  });

  test('AF-02: create FAQ with valid data', async ({ page }) => {
    await loginAdmin(page);
    await page.goto('/admin/faqs/create');

    const question = uniqueName('E2E-Pertanyaan');
    await page.fill('input[name="question"]', question);
    await page.fill('textarea[name="answer"]', 'Ini adalah jawaban E2E test');
    await page.getByRole('button', { name: 'Simpan FAQ' }).click();

    await page.waitForURL('**/admin/faqs', { timeout: 10000 });
    await expect(page.getByText(question)).toBeVisible({ timeout: 10000 });
  });
});
