import { test, expect } from '@playwright/test';
import { loginAdmin } from './helpers';

test.describe('Error and Empty States', () => {
  test('ES-02: admin product index shows empty state', async ({ page }) => {
    await loginAdmin(page);
    await page.goto('/admin/products');
    await expect(page.locator('text=Belum ada produk').first()).toBeVisible({ timeout: 5000 });
  });

  test('ES-03: nonexistent product returns 404', async ({ page }) => {
    const response = await page.goto('/menu/nonexistent-product-12345');
    expect(response?.status()).toBe(404);
  });
});
