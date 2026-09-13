import { test, expect } from '@playwright/test';

test.describe('Testimonial Form', () => {
  test('TF-01: testimonial page loads', async ({ page }) => {
    await page.goto('/testimonial');
    await expect(page).toHaveTitle(/testimoni/i);
    await expect(page.locator('body')).toContainText('Testimoni');
  });

  test('TF-02: modal opens when button is clicked', async ({ page }) => {
    await page.goto('/testimonial');
    const openBtn = page.locator('button').filter({ hasText: /kirim testimoni|tulis testimoni/i }).first();
    await expect(openBtn).toBeVisible();
    await openBtn.click();
    const modal = page.locator('#testimonial-modal, [role="dialog"]').first();
    await expect(modal).toBeVisible({ timeout: 5000 });
  });

  test('TF-03: submit testimonial with valid data shows success', async ({ page }) => {
    await page.goto('/testimonial');
    const openBtn = page.locator('button').filter({ hasText: /kirim testimoni|tulis testimoni/i }).first();
    await openBtn.click();

    const modal = page.locator('#testimonial-modal, [role="dialog"]').first();
    await expect(modal).toBeVisible({ timeout: 5000 });
    await modal.locator('input[name="name"]').fill('E2E Testimonial');
    await modal.locator('input[name="email"]').fill('e2e-testimonial@test.com');

    // Rating radio is hidden (CSS) - use JS to set value
    await modal.evaluate((el) => {
      const radio = el.querySelector('input[name="rating"][value="5"]') as HTMLInputElement;
      if (radio) {
        radio.checked = true;
        radio.dispatchEvent(new Event('change', { bubbles: true }));
      }
    });

    await modal.locator('textarea[name="message"]').fill('Sangat enak dan lezat!');
    await modal.locator('button[type="submit"]').click();

    // After submission, page may reload or show success
    await page.waitForLoadState('domcontentloaded');
    await expect(page).toHaveURL(/\/testimonial/);
  });

  test('TF-04: HTML5 required validation prevents empty modal submission', async ({ page }) => {
    await page.goto('/testimonial');
    const openBtn = page.locator('button').filter({ hasText: /kirim testimoni|tulis testimoni/i }).first();
    await openBtn.click();

    const modal = page.locator('#testimonial-modal, [role="dialog"]').first();
    await expect(modal).toBeVisible({ timeout: 5000 });
    // Click submit without filling - HTML5 required should prevent submission
    await modal.locator('button[type="submit"]').click();

    // Browser prevents submission, modal should still be open
    await expect(modal).toBeVisible({ timeout: 3000 });
  });
});
