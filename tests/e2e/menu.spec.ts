import { test, expect } from '@playwright/test';

test.describe('Menu Page', () => {
  test('MP-01: menu page loads', async ({ page }) => {
    await page.goto('/menu');
    await expect(page).toHaveTitle(/menu/i);
    await expect(page.locator('h1')).toContainText('Menu Kami');
    await expect(page.locator('#search-input')).toBeVisible();
  });

  test('MP-02: search input is functional', async ({ page }) => {
    await page.goto('/menu');
    await expect(page.locator('#search-input')).toBeVisible();
    await page.fill('#search-input', 'soto');
    await expect(page.locator('#search-input')).toHaveValue('soto');
  });

  test('MP-03: category filter buttons exist', async ({ page }) => {
    await page.goto('/menu');
    const semuBtn = page.locator('button').filter({ hasText: 'Semua' }).first();
    await expect(semuBtn).toBeVisible();
  });

  test('MP-06: products container exists on page', async ({ page }) => {
    await page.goto('/menu');
    await expect(page.locator('#dynamic-content')).toBeVisible({ timeout: 5000 });
  });
});
