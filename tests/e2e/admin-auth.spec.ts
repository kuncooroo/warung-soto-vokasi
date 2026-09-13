import { test, expect } from '@playwright/test';
import { loginAdmin } from './helpers';

test.describe('Admin Authentication', () => {
  test('AA-01: admin login page loads', async ({ page }) => {
    await page.goto('/admin/login');
    await expect(page).toHaveTitle(/login admin/i);
    await expect(page.locator('input[name="email"]')).toBeVisible();
    await expect(page.locator('input[name="password"]')).toBeVisible();
    await expect(page.locator('button[type="submit"]')).toBeVisible();
  });

  test('AA-02: successful admin login redirects to dashboard', async ({ page }) => {
    await page.goto('/admin/login');
    await page.fill('input[name="email"]', 'admin@warung-soto.com');
    await page.fill('input[name="password"]', 'password123');
    await Promise.all([
      page.waitForNavigation({ timeout: 10000 }),
      page.click('button[type="submit"]'),
    ]);
    await expect(page).toHaveTitle(/dashboard/i);
  });

  test('AA-03: failed admin login shows error', async ({ page }) => {
    await page.goto('/admin/login');
    await page.fill('input[name="email"]', 'admin@warung-soto.com');
    await page.fill('input[name="password"]', 'wrongpassword');
    await Promise.all([
      page.waitForNavigation({ timeout: 10000 }),
      page.click('button[type="submit"]'),
    ]);
    await expect(page).toHaveURL(/\/admin\/login/);
    await expect(page.getByText('Email atau password salah').first()).toBeVisible();
  });

  test('AA-04: admin logout flushes session', async ({ page }) => {
    await loginAdmin(page);
    await page.goto('/admin/dashboard');
    await expect(page).toHaveTitle(/dashboard/i);

    // Logout form is in the sidebar - use JS to submit it since it may be hidden
    await page.evaluate(() => {
      const form = document.querySelector('form[action*="admin/logout"]') as HTMLFormElement;
      if (form) form.submit();
    });
    await page.waitForURL('**/admin/login', { timeout: 10000 });
    await expect(page).toHaveTitle(/login admin/i);
  });

  test('AA-05: unauthenticated admin access redirects to login', async ({ page }) => {
    await page.goto('/admin/dashboard');
    await expect(page).toHaveURL(/\/admin\/login/);
  });
});
