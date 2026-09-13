import { test, expect } from '@playwright/test';

test.describe('Smoke Tests', () => {
  test('S-01: homepage loads successfully', async ({ page }) => {
    const response = await page.goto('/');
    expect(response?.status()).toBe(200);
    await expect(page).toHaveTitle(/warung soto vokasi/i);
    await expect(page.locator('body')).not.toBeEmpty();
  });

  test('S-02: homepage returns HTML content', async ({ page }) => {
    const response = await page.goto('/');
    const contentType = response?.headers()['content-type'] || '';
    expect(contentType).toContain('text/html');
  });
});
