# OmniShield Systems Website

Single-page PHP website for OmniShield Systems.

## Local check

```powershell
php -l index.php
php -S 127.0.0.1:8080 index.php
```

Open `http://127.0.0.1:8080`.

## Deployment

The repository includes `.github/workflows/deploy-hostinger.yml`.

Use one of these Hostinger deployment methods:

1. Hostinger Git auto deployment webhook
   - In Hostinger hPanel, open the website, then go to Advanced > Git.
   - Connect this GitHub repository and enable auto deployment for the `main` branch.
   - Copy the Hostinger webhook URL.
   - In GitHub, add repository secret `HOSTINGER_WEBHOOK_URL`.

2. FTP/FTPS deployment through GitHub Actions
   - In Hostinger, create or copy FTP credentials for the site.
   - In GitHub, add these repository secrets:
     - `HOSTINGER_FTP_SERVER`
     - `HOSTINGER_FTP_USERNAME`
     - `HOSTINGER_FTP_PASSWORD`
   - Optional: add `HOSTINGER_FTP_SERVER_DIR` if the deploy path is not `/public_html/`.

Every push to `main` runs PHP linting and then deploys with whichever Hostinger method has secrets configured.
