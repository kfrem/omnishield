# Hostinger automatic deployment setup

This project is ready for automatic deployment from GitHub to Hostinger.

## Recommended setup: Hostinger Git auto deployment

1. Open Hostinger hPanel.
2. Select the website/domain that should serve OmniShield.
3. Go to Advanced > Git.
4. Connect the GitHub repository.
5. Select the `main` branch.
6. Set the deployment directory to the website public folder, usually `public_html`.
7. Enable auto deployment and copy the webhook URL.
8. In GitHub, open the repository settings.
9. Go to Secrets and variables > Actions.
10. Add a repository secret named `HOSTINGER_WEBHOOK_URL` with the webhook URL.

After this, every push to `main` validates `index.php` and triggers Hostinger deployment.

## Alternative setup: FTP/FTPS

Add these GitHub Actions repository secrets:

- `HOSTINGER_FTP_SERVER`
- `HOSTINGER_FTP_USERNAME`
- `HOSTINGER_FTP_PASSWORD`
- `HOSTINGER_FTP_SERVER_DIR` if needed, for example `/domains/example.com/public_html/`

Do not commit FTP passwords or Hostinger credentials into the repository.
