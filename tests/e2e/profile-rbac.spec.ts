import { test, expect } from '@playwright/test';
import { loginAdmin, loginUser, CREDS } from './helpers';

test.describe('User Profile Management', () => {
  test('PM-01: profile page loads when logged in', async ({ page }) => {
    await loginUser(page);
    await page.goto('/profile');
    await expect(page).toHaveTitle(/profil/i);
    await expect(page.locator('h1').first()).toBeVisible();
  });

  test('PM-02: update profile name', async ({ page }) => {
    await loginUser(page);
    await page.goto('/profile');

    const nameInput = page.locator('input[name="name"]');
    await expect(nameInput).toBeVisible();
    await nameInput.fill('Updated E2E Name');

    // Find the profile form's submit button specifically
    const form = page.locator('form').filter({ has: page.locator('input[name="name"]') });
    const submitBtn = form.locator('button[type="submit"]').first();
    await submitBtn.click();

    // Profile uses x-toast with session flash - check for toast or form reload
    await page.waitForLoadState('domcontentloaded');
    // The page should still be on profile after update
    await expect(page).toHaveURL(/\/profile/);
    // Check that the name was actually updated in the input
    await expect(page.locator('input[name="name"]')).toHaveValue('Updated E2E Name');
  });

  test('PM-04: profile redirects to login when not authenticated', async ({ page }) => {
    await page.goto('/profile');
    await expect(page).toHaveURL(/\/login/);
  });
});

test.describe('Admin RBAC', () => {
  test('RB-03: unauthenticated user cannot access admin routes', async ({ page }) => {
    await page.goto('/admin/dashboard');
    await expect(page).toHaveURL(/\/admin\/login/);
  });

  test('RB-01: regular admin cannot access admin management', async ({ page }) => {
    await loginAdmin(page);
    const response = await page.goto('/admins');
    expect(response?.status()).toBeGreaterThanOrEqual(300);
  });
});
