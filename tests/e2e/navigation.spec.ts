import { test, expect } from '@playwright/test';

const PUBLIC_PAGES = [
  { path: '/', titlePattern: /beranda|warung soto vokasi/i, id: 'N-01' },
  { path: '/about', titlePattern: /tentang kami/i, id: 'N-02' },
  { path: '/menu', titlePattern: /menu/i, id: 'N-03' },
  { path: '/testimonial', titlePattern: /testimoni/i, id: 'N-04' },
  { path: '/faq', titlePattern: /faq/i, id: 'N-05' },
  { path: '/contact', titlePattern: /hubungi kami/i, id: 'N-06' },
];

test.describe('Public Navigation', () => {
  for (const page_def of PUBLIC_PAGES) {
    test(`${page_def.id}: navigate to ${page_def.path}`, async ({ page }) => {
      const response = await page.goto(page_def.path);
      expect(response?.status()).toBe(200);
      await expect(page).toHaveTitle(page_def.titlePattern);
      await expect(page.locator('body')).not.toBeEmpty();
    });
  }

  test('N-07: nav links are visible on desktop', async ({ page }) => {
    await page.setViewportSize({ width: 1280, height: 720 });
    await page.goto('/');

    const desktopNav = page.locator('.hidden.md\\:flex');
    await expect(desktopNav.getByRole('link', { name: 'Home' })).toBeVisible();
    await expect(desktopNav.getByRole('link', { name: 'About Us' })).toBeVisible();
    await expect(desktopNav.getByRole('link', { name: 'Menu' })).toBeVisible();
    await expect(desktopNav.getByRole('link', { name: 'Testimoni' })).toBeVisible();
    await expect(desktopNav.getByRole('link', { name: 'FAQ' })).toBeVisible();
    await expect(desktopNav.getByRole('link', { name: 'Contact' })).toBeVisible();
  });

  test('N-08: nav links resolve to correct pages', async ({ page }) => {
    await page.setViewportSize({ width: 1280, height: 720 });
    await page.goto('/');

    const desktopNav = page.locator('.hidden.md\\:flex');
    await desktopNav.getByRole('link', { name: 'About Us' }).click();
    await expect(page).toHaveURL(/\/about/);

    await page.goto('/');
    await desktopNav.getByRole('link', { name: 'Menu' }).click();
    await expect(page).toHaveURL(/\/menu/);

    await page.goto('/');
    await desktopNav.getByRole('link', { name: 'Contact' }).click();
    await expect(page).toHaveURL(/\/contact/);
  });
});
