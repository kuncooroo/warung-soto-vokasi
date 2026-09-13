import { test, expect } from '@playwright/test';
import { CREDS, loginUser, uniqueEmail } from './helpers';

test.describe('User Authentication', () => {
  test('UA-01: login page loads with form', async ({ page }) => {
    await page.goto('/login');
    await expect(page).toHaveTitle(/login/i);
    await expect(page.locator('input[name="email"]')).toBeVisible();
    await expect(page.locator('input[name="password"]')).toBeVisible();
    await expect(page.locator('button[type="submit"]')).toBeVisible();
  });

  test('UA-02: successful login redirects to homepage', async ({ page }) => {
    await page.goto('/login');
    await page.fill('input[name="email"]', CREDS.user.email);
    await page.fill('input[name="password"]', CREDS.user.password);
    await Promise.all([
      page.waitForNavigation({ timeout: 10000 }),
      page.click('button[type="submit"]'),
    ]);
    await expect(page).toHaveURL(/warung-soto-vokasi\.test\/?$/);
  });

  test('UA-03: failed login with wrong password shows error', async ({ page }) => {
    await page.goto('/login');
    await page.fill('input[name="email"]', CREDS.user.email);
    await page.fill('input[name="password"]', 'wrongpassword');
    await Promise.all([
      page.waitForNavigation({ timeout: 10000 }),
      page.click('button[type="submit"]'),
    ]);
    await expect(page).toHaveURL(/\/login/);
    await expect(page.getByRole('listitem').filter({ hasText: 'do not match' })).toBeVisible();
  });

  test('UA-04: failed login with nonexistent email shows error', async ({ page }) => {
    await page.goto('/login');
    await page.fill('input[name="email"]', 'nonexistent@example.com');
    await page.fill('input[name="password"]', 'password');
    await Promise.all([
      page.waitForNavigation({ timeout: 10000 }),
      page.click('button[type="submit"]'),
    ]);
    await expect(page).toHaveURL(/\/login/);
    await expect(page.getByRole('listitem').filter({ hasText: 'do not match' })).toBeVisible();
  });

  test('UA-05: register page loads with form', async ({ page }) => {
    await page.goto('/register');
    await expect(page).toHaveTitle(/register/i);
    await expect(page.locator('input[name="name"]')).toBeVisible();
    await expect(page.locator('input[name="email"]')).toBeVisible();
    await expect(page.locator('input[name="password"]')).toBeVisible();
    await expect(page.locator('input[name="password_confirmation"]')).toBeVisible();
  });

  test('UA-06: successful registration creates account and logs in', async ({ page }) => {
    const email = uniqueEmail('e2e-register');
    await page.goto('/register');
    await page.fill('input[name="name"]', 'E2E Test User');
    await page.fill('input[name="email"]', email);
    await page.fill('input[name="password"]', 'Password123!');
    await page.fill('input[name="password_confirmation"]', 'Password123!');
    await Promise.all([
      page.waitForNavigation({ timeout: 10000 }),
      page.click('button[type="submit"]'),
    ]);
    await expect(page).toHaveURL(/warung-soto-vokasi\.test\/?$/);
  });

  test('UA-07: registration with mismatched passwords shows error', async ({ page }) => {
    await page.goto('/register');
    await page.fill('input[name="name"]', 'E2E Test User');
    await page.fill('input[name="email"]', uniqueEmail('e2e-nomatch'));
    await page.fill('input[name="password"]', 'Password123!');
    await page.fill('input[name="password_confirmation"]', 'DifferentPass!');
    await Promise.all([
      page.waitForNavigation({ timeout: 10000 }),
      page.click('button[type="submit"]'),
    ]);
    await expect(page).toHaveURL(/\/register/);
    await expect(page.getByRole('listitem').filter({ hasText: 'does not match' })).toBeVisible();
  });

  test('UA-08: registration with duplicate email shows error', async ({ page }) => {
    await page.goto('/register');
    await page.fill('input[name="name"]', 'E2E Dup User');
    await page.fill('input[name="email"]', CREDS.user.email);
    await page.fill('input[name="password"]', 'Password123!');
    await page.fill('input[name="password_confirmation"]', 'Password123!');
    await Promise.all([
      page.waitForNavigation({ timeout: 10000 }),
      page.click('button[type="submit"]'),
    ]);
    await expect(page).toHaveURL(/\/register/);
    await expect(page.getByRole('listitem').filter({ hasText: 'already been taken' })).toBeVisible();
  });

  test('UA-09: logged-in user cannot see guest nav links', async ({ page }) => {
    await loginUser(page);
    await page.goto('/');
    const desktopNav = page.locator('.hidden.md\\:flex');
    await expect(desktopNav.getByRole('link', { name: 'Login' })).not.toBeVisible();
    await expect(desktopNav.getByRole('link', { name: 'Register' })).not.toBeVisible();
  });

  test('UA-10: logged-in user sees avatar in navbar', async ({ page }) => {
    await loginUser(page);
    await page.goto('/');
    const avatar = page.locator('.hidden.md\\:flex button').first();
    await expect(avatar).toBeVisible();
  });

  test('UA-11: guest sees Login and Register links', async ({ page }) => {
    await page.goto('/');
    const desktopNav = page.locator('.hidden.md\\:flex');
    await expect(desktopNav.getByRole('link', { name: 'Login' })).toBeVisible();
    await expect(desktopNav.getByRole('link', { name: 'Register' })).toBeVisible();
  });
});
