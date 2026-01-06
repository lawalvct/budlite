# Enable HTTPS in Laragon for Camera Access

## Quick Setup (Recommended)

### 1. Enable SSL in Laragon

1. Right-click Laragon tray icon
2. Go to **Apache** > **SSL** > **Enabled**
3. Laragon will restart Apache automatically

### 2. Access Your Site via HTTPS

-   Instead of: `http://budlite.test`
-   Use: `https://budlite.test`

### 3. Trust the Certificate (First Time Only)

When you visit `https://budlite.test`, your browser will show a security warning:

**Chrome/Edge:**

1. Click "Advanced"
2. Click "Proceed to budlite.test (unsafe)"
3. Done!

**Firefox:**

1. Click "Advanced"
2. Click "Accept the Risk and Continue"
3. Done!

**Mobile (Android/iOS):**

1. Visit `https://budlite.test` on mobile
2. Tap "Advanced" or "Details"
3. Tap "Proceed" or "Visit this website"
4. Camera will now work!

---

## Alternative: Create Virtual Host with Auto-SSL

### Option A: Using Laragon Menu (Easiest)

1. Right-click Laragon tray icon
2. Go to **Apache** > **Sites** > **budlite**
3. Laragon will auto-configure SSL
4. Access via `https://budlite.test`

### Option B: Manual Virtual Host

1. Right-click Laragon tray icon
2. Select **Apache** > **sites-enabled**
3. Create file: `budlite.ngnf`
4. Add this content:

```apache
<VirtualHost *:80>
    DocumentRoot "c:/laragon/www/budlite/public"
    ServerName budlite.test
    ServerAlias *.budlite.test
    <Directory "c:/laragon/www/budlite/public">
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>

<VirtualHost *:443>
    DocumentRoot "c:/laragon/www/budlite/public"
    ServerName budlite.test
    ServerAlias *.budlite.test

    SSLEngine on
    SSLCertificateFile "C:/laragon/etc/ssl/laragon.crt"
    SSLCertificateKeyFile "C:/laragon/etc/ssl/laragon.key"

    <Directory "c:/laragon/www/budlite/public">
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

5. Restart Laragon
6. Access via `https://budlite.test`

---

## Force HTTPS Redirect (Optional)

Add this to your `.htaccess` file in `public/` folder:

```apache
# Force HTTPS
RewriteEngine On
RewriteCond %{HTTPS} off
RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
```

---

## Troubleshooting

### Issue: "SSL not enabled" error

**Solution:** Make sure Apache SSL module is enabled:

1. Laragon Menu > Apache > ssl_module > Enabled

### Issue: Certificate error persists

**Solution:** Clear browser cache and try again

### Issue: Mobile still shows "not secure"

**Solution:**

1. Make sure you're using `https://` in the URL
2. Accept the certificate warning on mobile
3. Refresh the page

### Issue: Can't access from other devices

**Solution:**

1. Find your computer's IP: Open CMD and type `ipconfig`
2. Look for "IPv4 Address" (e.g., 192.168.1.100)
3. On mobile, visit: `https://192.168.1.100/budlite/public`
4. Accept certificate warning

---

## Quick Test

After enabling HTTPS, test if camera works:

1. Visit `https://budlite.test/portal/attendance`
2. Click "Start QR Scanner"
3. Browser should prompt for camera permission
4. Click "Allow"
5. Camera should start!

---

## Need Help?

If camera still doesn't work:

1. Make sure you're using `https://` (not `http://`)
2. Check browser console for errors (F12)
3. Try a different browser (Chrome recommended)
4. Make sure camera is not being used by another app
