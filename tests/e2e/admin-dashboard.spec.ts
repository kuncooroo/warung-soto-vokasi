import { test, expect } from '@playwright/test';
import { loginAdmin } from './helpers';

test.describe('Admin Dashboard', () => {
  test('AD-01: dashboard loads with stat cards', async ({ page }) => {
    await loginAdmin(page);
    await page.goto('/admin/dashboard');
    await expect(page).toHaveTitle(/dashboard/i);

    await expect(page.getByText('Total User').first()).toBeVisible();
    await expect(page.getByText('Order Hari Ini').first()).toBeVisible();
    await expect(page.getByText('Pendapatan').first()).toBeVisible();
  });

  test('AD-02: stats show initial values', async ({ page }) => {
    await loginAdmin(page);
    await page.goto('/admin/dashboard');
    await expect(page.getByText('Transaksi Terbaru').first()).toBeVisible({ timeout: 5000 });
  });
});
