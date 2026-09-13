import { type Page, type BrowserContext, expect } from '@playwright/test';

export const BASE_URL = 'http://warung-soto-vokasi.test';

export const CREDS = {
  user: { email: 'test@example.com', password: 'password' },
  admin: { email: 'admin@warung-soto.com', password: 'password123' },
  superadmin: { email: 'superadmin@warung-soto.com', password: 'password123' },
} as const;

export async function loginUser(page: Page, email = CREDS.user.email, password = CREDS.user.password) {
  await page.goto('/login');
  await page.fill('input[name="email"]', email);
  await page.fill('input[name="password"]', password);
  await page.click('button[type="submit"]');
  await page.waitForURL('**/');
}

export async function loginAdmin(page: Page, email = CREDS.admin.email, password = CREDS.admin.password) {
  await page.goto('/admin/login');
  await page.fill('input[name="email"]', email);
  await page.fill('input[name="password"]', password);
  await page.click('button[type="submit"]');
  await page.waitForURL('**/admin/dashboard');
}

export async function logoutUser(page: Page) {
  await page.evaluate(() => {
    fetch('/', { method: 'POST', headers: { 'X-CSRF-TOKEN': (document.querySelector('meta[name="csrf-token"]') as HTMLMetaElement).content } });
  });
}

let uniqueCounter = 0;
export function uniqueName(prefix: string) {
  return `${prefix}-${Date.now()}-${++uniqueCounter}`;
}

export function uniqueEmail(prefix: string) {
  return `${prefix}-${Date.now()}-${uniqueCounter}@test.example.com`;
}

export function formatRupiah(n: number) {
  return `Rp ${n.toLocaleString('id-ID')}`;
}

export async function createTestImage(page: Page): Promise<Buffer> {
  return await page.evaluate(() => {
    const canvas = document.createElement('canvas');
    canvas.width = 100;
    canvas.height = 100;
    const ctx = canvas.getContext('2d')!;
    ctx.fillStyle = '#D98718';
    ctx.fillRect(0, 0, 100, 100);
    return fetch(canvas.toDataURL('image/png'))
      .then(r => r.arrayBuffer())
      .then(buf => new Uint8Array(buf));
  }) as unknown as Buffer;
}
