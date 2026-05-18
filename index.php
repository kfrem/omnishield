<?php
// ============================================================
// OMNISHIELD SYSTEMS — Main Website
// Contact form → enquiries@omnishield.pro
// WhatsApp / Telegram direct chat links
//
// TO CUSTOMISE: Use Find & Replace to swap:
//   "OmniShield Systems"  → Your final company name
//   "omnishield.pro"                  → Your actual domain
// ============================================================

const SITE_NAME = 'OmniShield Systems';
const SITE_DOMAIN = 'omnishield.pro';
const CONTACT_EMAIL = 'enquiries@omnishield.pro';
const CONTACT_PHONE_E164 = '447939823988';

function field_value(string $key): string
{
    return trim((string) ($_POST[$key] ?? ''));
}

function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

$form_success = false;
$form_error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_enquiry'])) {
    $name = strip_tags(field_value('name'));
    $email_input = field_value('email');
    $email = filter_var($email_input, FILTER_VALIDATE_EMAIL);
    $phone = strip_tags(field_value('phone'));
    $org = strip_tags(field_value('organisation'));
    $service = strip_tags(field_value('service'));
    $msg = strip_tags(field_value('message'));
    $company_website = field_value('company_website');

    if ($company_website !== '') {
        $form_success = true;
    } elseif (!$name || !$email || !$msg) {
        $form_error = 'Please complete all required fields: Name, Email, and Message.';
    } else {
        $to      = CONTACT_EMAIL;
        $subject = 'Website Enquiry | ' . SITE_NAME . ' | ' . $name;
        $body    = "NEW ENQUIRY — OMNISHIELD SYSTEMS WEBSITE\n";
        $body   .= "=================================================\n\n";
        $body   .= "Name:          {$name}\n";
        $body   .= "Email:         {$email}\n";
        $body   .= "Phone:         {$phone}\n";
        $body   .= "Organisation:  {$org}\n";
        $body   .= "Service Area:  {$service}\n\n";
        $body   .= "MESSAGE:\n{$msg}\n\n";
        $body   .= "=================================================\n";
        $body   .= "Sent via: https://" . SITE_DOMAIN;

        $headers  = "From: noreply@" . SITE_DOMAIN . "\r\n";
        $headers .= "Reply-To: {$email}\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";

        if (mail($to, $subject, $body, $headers)) {
            $form_success = true;
        } else {
            $form_error = 'Your message could not be sent at this moment. Please contact us directly via WhatsApp or Telegram below.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e(SITE_NAME) ?> | Integrated Security Solutions</title>
    <meta name="description" content="<?= e(SITE_NAME) ?> delivers advanced software, hardware, and integrated security solutions for corporations, institutions, and governments worldwide.">
    <meta name="keywords" content="cybersecurity, security technology, hardware security, software security, institutional security, government security, access control, threat intelligence, global security">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@700;900&family=Syne:wght@400;600;700;800&family=DM+Sans:ital,wght@0,300;0,400;0,500;0,600;1,300&display=swap" rel="stylesheet">

    <style>
        /* ── RESET & BASE ─────────────────────────────────────── */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg:          #06111f;
            --surface:     #0a1b2e;
            --card:        #0f2438;
            --card-hover:  #15314a;
            --border:      #214661;
            --gold:        #38d5ff;
            --gold-light:  #8be8ff;
            --blue:        #58a6ff;
            --blue-dim:    #164e8a;
            --text:        #eef7fb;
            --text-dim:    #7f9fb6;
            --text-mid:    #b7cbd8;
            --radius:      6px;
            --shadow:      0 4px 32px rgba(0,0,0,0.5);
        }

        html { scroll-behavior: smooth; }

        body {
            background: var(--bg);
            color: var(--text);
            font-family: 'DM Sans', sans-serif;
            font-size: 16px;
            line-height: 1.7;
            overflow-x: hidden;
        }

        h1, h2, h3, h4 {
            font-family: 'Syne', sans-serif;
            line-height: 1.2;
            color: var(--text);
        }

        a { color: inherit; text-decoration: none; }

        img { max-width: 100%; display: block; }

        .container {
            max-width: 1180px;
            margin: 0 auto;
            padding: 0 24px;
        }

        .section { padding: 96px 0; }

        .label {
            display: inline-block;
            font-family: 'Orbitron', monospace;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: var(--gold);
            margin-bottom: 16px;
        }

        .section-title {
            font-size: clamp(28px, 4vw, 42px);
            font-weight: 800;
            margin-bottom: 16px;
        }

        .section-sub {
            font-size: 17px;
            color: var(--text-mid);
            max-width: 600px;
            font-weight: 300;
        }

        .gold { color: var(--gold); }
        .blue { color: var(--blue); }

        /* ── NAVIGATION ───────────────────────────────────────── */
        nav {
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 1000;
            background: rgba(7, 9, 15, 0.85);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border-bottom: 1px solid var(--border);
            transition: background 0.3s;
        }

        .nav-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 72px;
        }

        .nav-logo {
            display: inline-flex;
            align-items: center;
            flex-shrink: 0;
            width: 214px;
            min-height: 48px;
        }

        .nav-logo img {
            width: 100%;
            height: auto;
            display: block;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 36px;
            list-style: none;
        }

        .nav-links a {
            font-size: 13px;
            font-weight: 500;
            color: var(--text-mid);
            letter-spacing: 0.5px;
            transition: color 0.2s;
        }

        .nav-links a:hover { color: var(--gold); }

        .nav-cta {
            background: var(--gold);
            color: #07090f !important;
            font-weight: 600 !important;
            padding: 9px 22px;
            border-radius: var(--radius);
            transition: background 0.2s !important;
        }

        .nav-cta:hover { background: var(--gold-light) !important; }

        .hamburger {
            display: none;
            flex-direction: column;
            gap: 5px;
            cursor: pointer;
            padding: 4px;
        }

        .hamburger span {
            display: block;
            width: 24px;
            height: 2px;
            background: var(--text);
            transition: transform 0.3s, opacity 0.3s;
        }

        .mobile-menu {
            display: none;
            flex-direction: column;
            background: var(--surface);
            border-top: 1px solid var(--border);
            padding: 16px 24px 24px;
            gap: 4px;
        }

        .mobile-menu a {
            display: block;
            padding: 12px 0;
            font-size: 15px;
            color: var(--text-mid);
            border-bottom: 1px solid var(--border);
            transition: color 0.2s;
        }

        .mobile-menu a:hover, .mobile-menu a:last-child { border-color: transparent; }
        .mobile-menu a:hover { color: var(--gold); }

        /* ── HERO ─────────────────────────────────────────────── */
        .hero {
            position: relative;
            min-height: 100vh;
            display: flex;
            align-items: center;
            overflow: hidden;
            padding-top: 72px;
        }

        .hero-bg {
            position: absolute;
            inset: 0;
            background:
                radial-gradient(ellipse 80% 60% at 70% 50%, rgba(88,166,255,0.10) 0%, transparent 60%),
                radial-gradient(ellipse 60% 80% at 10% 80%, rgba(56,213,255,0.08) 0%, transparent 50%),
                var(--bg);
        }

        /* Grid pattern */
        .hero-bg::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(30,45,71,0.4) 1px, transparent 1px),
                linear-gradient(90deg, rgba(30,45,71,0.4) 1px, transparent 1px);
            background-size: 60px 60px;
            mask-image: radial-gradient(ellipse 80% 80% at 50% 50%, black 30%, transparent 100%);
        }

        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 740px;
            animation: heroFadeIn 0.9s ease both;
        }

        @keyframes heroFadeIn {
            from { opacity: 0; transform: translateY(30px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .hero-eyebrow {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 28px;
        }

        .hero-eyebrow::before {
            content: '';
            display: block;
            width: 40px;
            height: 2px;
            background: var(--gold);
        }

        .hero-eyebrow span {
            font-family: 'Orbitron', monospace;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 4px;
            color: var(--gold);
            text-transform: uppercase;
        }

        .hero h1 {
            font-size: clamp(40px, 6vw, 72px);
            font-weight: 800;
            line-height: 1.08;
            margin-bottom: 28px;
        }

        .hero h1 em {
            font-style: normal;
            color: var(--gold);
        }

        .hero-desc {
            font-size: 18px;
            color: var(--text-mid);
            font-weight: 300;
            max-width: 580px;
            margin-bottom: 44px;
            line-height: 1.75;
        }

        .hero-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
            align-items: center;
        }

        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: var(--gold);
            color: #07090f;
            font-family: 'Syne', sans-serif;
            font-weight: 700;
            font-size: 14px;
            letter-spacing: 0.5px;
            padding: 14px 32px;
            border-radius: var(--radius);
            transition: background 0.2s, transform 0.2s;
        }

        .btn-primary:hover {
            background: var(--gold-light);
            transform: translateY(-2px);
        }

        .btn-secondary {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: transparent;
            color: var(--text);
            font-family: 'Syne', sans-serif;
            font-weight: 600;
            font-size: 14px;
            letter-spacing: 0.5px;
            padding: 14px 32px;
            border-radius: var(--radius);
            border: 1px solid var(--border);
            transition: border-color 0.2s, color 0.2s, transform 0.2s;
        }

        .btn-secondary:hover {
            border-color: var(--gold);
            color: var(--gold);
            transform: translateY(-2px);
        }

        .hero-stats {
            display: flex;
            gap: 48px;
            margin-top: 64px;
            padding-top: 40px;
            border-top: 1px solid var(--border);
            flex-wrap: wrap;
        }

        .hero-stat-num {
            font-family: 'Orbitron', monospace;
            font-size: 28px;
            font-weight: 900;
            color: var(--gold);
            line-height: 1;
        }

        .hero-stat-label {
            font-size: 12px;
            color: var(--text-dim);
            margin-top: 6px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* ── MARQUEE STRIP ────────────────────────────────────── */
        .marquee-strip {
            background: var(--gold);
            overflow: hidden;
            padding: 12px 0;
        }

        .marquee-track {
            display: flex;
            gap: 48px;
            animation: marquee 20s linear infinite;
            width: max-content;
        }

        @keyframes marquee {
            from { transform: translateX(0); }
            to   { transform: translateX(-50%); }
        }

        .marquee-item {
            font-family: 'Orbitron', monospace;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: #07090f;
            white-space: nowrap;
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .marquee-dot {
            width: 5px;
            height: 5px;
            background: rgba(7,9,15,0.4);
            border-radius: 50%;
            display: inline-block;
        }

        /* ── SERVICES ─────────────────────────────────────────── */
        .services-bg { background: var(--surface); }

        .services-header { margin-bottom: 56px; }

        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 2px;
        }

        .service-card {
            background: var(--card);
            padding: 40px 36px;
            border: 1px solid var(--border);
            transition: background 0.25s, border-color 0.25s;
            position: relative;
            overflow: hidden;
        }

        .service-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0;
            width: 3px;
            height: 0;
            background: var(--gold);
            transition: height 0.3s;
        }

        .service-card:hover::before { height: 100%; }
        .service-card:hover {
            background: var(--card-hover);
            border-color: var(--blue-dim);
        }

        .service-icon {
            width: 52px;
            height: 52px;
            background: var(--blue-dim);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 24px;
            font-size: 22px;
        }

        .service-card h3 {
            font-size: 19px;
            font-weight: 700;
            margin-bottom: 14px;
        }

        .service-card p {
            font-size: 14px;
            color: var(--text-mid);
            line-height: 1.75;
            font-weight: 300;
        }

        /* ── ABOUT ────────────────────────────────────────────── */
        .about-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 80px;
            align-items: center;
        }

        .about-visual {
            position: relative;
        }

        .about-box {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 4px;
            padding: 48px;
            position: relative;
        }

        .about-box::after {
            content: '';
            position: absolute;
            bottom: -16px;
            right: -16px;
            width: 100%;
            height: 100%;
            border: 1px solid var(--gold);
            border-radius: 4px;
            z-index: -1;
        }

        .about-badge {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 4px;
            padding: 16px 22px;
            margin-top: 24px;
        }

        .badge-icon { font-size: 28px; }

        .badge-label {
            font-family: 'Syne', sans-serif;
            font-weight: 700;
            font-size: 14px;
            color: var(--text);
        }

        .badge-sub {
            font-size: 12px;
            color: var(--text-dim);
        }

        .about-text p {
            font-size: 16px;
            color: var(--text-mid);
            margin-bottom: 16px;
            font-weight: 300;
            line-height: 1.8;
        }

        .about-text p:first-of-type {
            font-size: 18px;
            color: var(--text);
            font-weight: 400;
        }

        /* ── WHY US ───────────────────────────────────────────── */
        .whyus-bg { background: var(--surface); }

        .whyus-header {
            text-align: center;
            margin-bottom: 64px;
        }

        .whyus-header .section-sub { margin: 0 auto; }

        .pillars-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 24px;
        }

        .pillar {
            text-align: center;
            padding: 40px 28px;
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            transition: border-color 0.25s, transform 0.25s;
        }

        .pillar:hover {
            border-color: var(--gold);
            transform: translateY(-6px);
        }

        .pillar-num {
            font-family: 'Orbitron', monospace;
            font-size: 42px;
            font-weight: 900;
            color: var(--gold);
            line-height: 1;
            margin-bottom: 12px;
        }

        .pillar h4 {
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .pillar p {
            font-size: 13px;
            color: var(--text-dim);
            font-weight: 300;
            line-height: 1.7;
        }

        /* ── CONTACT ──────────────────────────────────────────── */
        .contact-grid {
            display: grid;
            grid-template-columns: 1fr 420px;
            gap: 64px;
            align-items: start;
        }

        .contact-header { margin-bottom: 40px; }

        /* Form */
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        .form-group { margin-bottom: 20px; }
        .form-hp { position: absolute; left: -9999px; opacity: 0; pointer-events: none; }

        .form-group label {
            display: block;
            font-size: 12px;
            font-weight: 600;
            color: var(--text-mid);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 8px;
        }

        .form-group label .req { color: var(--gold); }

        .form-control {
            width: 100%;
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            color: var(--text);
            font-family: 'DM Sans', sans-serif;
            font-size: 15px;
            padding: 13px 16px;
            outline: none;
            transition: border-color 0.2s;
        }

        .form-control:focus { border-color: var(--gold); }

        .form-control option { background: var(--card); }

        textarea.form-control {
            resize: vertical;
            min-height: 130px;
            line-height: 1.6;
        }

        .form-submit {
            background: var(--gold);
            color: #07090f;
            font-family: 'Syne', sans-serif;
            font-weight: 700;
            font-size: 15px;
            letter-spacing: 0.5px;
            padding: 15px 40px;
            border: none;
            border-radius: var(--radius);
            cursor: pointer;
            transition: background 0.2s, transform 0.2s;
            width: 100%;
        }

        .form-submit:hover {
            background: var(--gold-light);
            transform: translateY(-2px);
        }

        .form-notice {
            padding: 14px 18px;
            border-radius: var(--radius);
            font-size: 14px;
            margin-bottom: 20px;
        }

        .form-notice.success {
            background: rgba(88,166,255,0.14);
            border: 1px solid var(--blue);
            color: var(--blue);
        }

        .form-notice.error {
            background: rgba(220,60,60,0.1);
            border: 1px solid #dc3c3c;
            color: #e07070;
        }

        /* Sidebar */
        .contact-sidebar { display: flex; flex-direction: column; gap: 16px; }

        .sidebar-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 28px;
        }

        .sidebar-card h4 {
            font-size: 14px;
            font-weight: 700;
            margin-bottom: 20px;
            color: var(--text-dim);
            text-transform: uppercase;
            letter-spacing: 1px;
            font-family: 'Orbitron', monospace;
            font-size: 10px;
        }

        .contact-link {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 16px 18px;
            border-radius: var(--radius);
            border: 1px solid var(--border);
            margin-bottom: 12px;
            font-weight: 500;
            font-size: 15px;
            transition: border-color 0.2s, transform 0.2s;
        }

        .contact-link:last-child { margin-bottom: 0; }

        .contact-link:hover {
            transform: translateY(-2px);
        }

        .contact-link.whatsapp {
            color: #25d366;
            border-color: rgba(37,211,102,0.25);
        }

        .contact-link.whatsapp:hover { border-color: #25d366; }

        .contact-link.telegram {
            color: #58a6ff;
            border-color: rgba(88,166,255,0.25);
        }

        .contact-link.telegram:hover { border-color: #58a6ff; }

        .contact-link.email {
            color: var(--gold);
            border-color: rgba(56,213,255,0.25);
        }

        .contact-link.email:hover { border-color: var(--gold); }

        .contact-link-icon { font-size: 22px; flex-shrink: 0; }

        .contact-link-info { flex: 1; }
        .contact-link-label { font-size: 11px; color: var(--text-dim); text-transform: uppercase; letter-spacing: 1px; display: block; margin-bottom: 2px; }
        .contact-link-val { font-size: 14px; word-break: break-all; }

        .response-time {
            font-size: 13px;
            color: var(--text-dim);
            text-align: center;
            margin-top: 16px;
            font-weight: 300;
        }

        /* ── FOOTER ───────────────────────────────────────────── */
        .legal-section {
            background: var(--surface);
            border-top: 1px solid var(--border);
            border-bottom: 1px solid var(--border);
        }

        .legal-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
        }

        .legal-item {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 24px;
        }

        .legal-item h3 {
            font-size: 18px;
            margin-bottom: 12px;
        }

        .legal-item p {
            color: var(--text-mid);
            font-size: 14px;
            font-weight: 300;
        }

        footer {
            background: #04050a;
            border-top: 1px solid var(--border);
            padding: 56px 0 32px;
        }

        .footer-top {
            display: grid;
            grid-template-columns: 1.8fr 1fr 1fr 1fr;
            gap: 48px;
            margin-bottom: 48px;
        }

        .footer-brand .nav-logo {
            width: 230px;
            margin-bottom: 16px;
        }

        .footer-tagline {
            font-size: 13px;
            color: var(--text-dim);
            font-weight: 300;
            line-height: 1.8;
            margin-bottom: 20px;
        }

        .footer-social {
            display: flex;
            gap: 10px;
        }

        .social-icon {
            width: 36px;
            height: 36px;
            border: 1px solid var(--border);
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            transition: border-color 0.2s, background 0.2s;
        }

        .social-icon:hover {
            border-color: var(--gold);
            background: rgba(56,213,255,0.12);
        }

        .footer-col h5 {
            font-family: 'Orbitron', monospace;
            font-size: 9px;
            font-weight: 700;
            letter-spacing: 3px;
            color: var(--gold);
            text-transform: uppercase;
            margin-bottom: 20px;
        }

        .footer-col ul { list-style: none; }

        .footer-col ul li {
            margin-bottom: 10px;
        }

        .footer-col ul li a {
            font-size: 14px;
            color: var(--text-dim);
            font-weight: 300;
            transition: color 0.2s;
        }

        .footer-col ul li a:hover { color: var(--gold); }

        .footer-bottom {
            border-top: 1px solid var(--border);
            padding-top: 28px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
        }

        .footer-copy {
            font-size: 13px;
            color: var(--text-dim);
            font-weight: 300;
        }

        .footer-legal {
            display: flex;
            gap: 24px;
        }

        .footer-legal a {
            font-size: 12px;
            color: var(--text-dim);
            transition: color 0.2s;
        }

        .footer-legal a:hover { color: var(--gold); }

        /* ── SCROLL REVEAL ────────────────────────────────────── */
        .reveal {
            opacity: 0;
            transform: translateY(28px);
            transition: opacity 0.7s ease, transform 0.7s ease;
        }

        .reveal.visible {
            opacity: 1;
            transform: none;
        }

        /* ── RESPONSIVE ───────────────────────────────────────── */
        @media (max-width: 960px) {
            .nav-links { display: none; }
            .hamburger { display: flex; }

            .about-grid { grid-template-columns: 1fr; gap: 48px; }
            .about-visual { display: none; }

            .contact-grid { grid-template-columns: 1fr; }
            .contact-sidebar { order: -1; }
            .legal-grid { grid-template-columns: 1fr; }

            .footer-top { grid-template-columns: 1fr 1fr; }
        }

        @media (max-width: 640px) {
            .section { padding: 64px 0; }
            .nav-logo { width: 186px; }
            .form-row { grid-template-columns: 1fr; }
            .hero-stats { gap: 28px; }
            .footer-top { grid-template-columns: 1fr; gap: 32px; }
            .footer-bottom { flex-direction: column; text-align: center; }
            .hero-actions { flex-direction: column; align-items: flex-start; }
        }
    </style>
</head>
<body>

<!-- ═══════════════════════════════════════════════════════════ -->
<!-- NAVIGATION -->
<!-- ═══════════════════════════════════════════════════════════ -->
<nav id="navbar">
    <div class="container nav-inner">
        <a href="#home" class="nav-logo">
            <img src="assets/omnishield-logo.svg" alt="OmniShield Technologies">
        </a>

        <ul class="nav-links">
            <li><a href="#services">Services</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#why-us">Why Us</a></li>
            <li><a href="#contact">Contact</a></li>
            <li><a href="#contact" class="nav-cta">Get a Quote</a></li>
        </ul>

        <div class="hamburger" id="hamburger" onclick="toggleMenu()">
            <span></span><span></span><span></span>
        </div>
    </div>

    <div class="mobile-menu" id="mobile-menu">
        <a href="#services" onclick="toggleMenu()">Services</a>
        <a href="#about"    onclick="toggleMenu()">About</a>
        <a href="#why-us"   onclick="toggleMenu()">Why Us</a>
        <a href="#contact"  onclick="toggleMenu()">Contact</a>
        <a href="#contact"  onclick="toggleMenu()" style="color:var(--gold);font-weight:600;">Get a Quote →</a>
    </div>
</nav>


<!-- ═══════════════════════════════════════════════════════════ -->
<!-- HERO -->
<!-- ═══════════════════════════════════════════════════════════ -->
<section class="hero" id="home">
    <div class="hero-bg"></div>
    <div class="container">
        <div class="hero-content">
            <div class="hero-eyebrow">
                <span>Advanced Integrated Security</span>
            </div>

            <h1>
                Protecting What<br>
                <em>Matters Most</em><br>
                To You
            </h1>

            <p class="hero-desc">
                OmniShield Systems delivers end-to-end security solutions — software,
                hardware, and everything between — for corporations, institutions,
                and governments that cannot afford to be compromised.
            </p>

            <div class="hero-actions">
                <a href="#contact" class="btn-primary">
                    &#9658;&nbsp; Request a Security Assessment
                </a>
                <a href="#services" class="btn-secondary">
                    Explore Our Services &rarr;
                </a>
            </div>

            <div class="hero-stats">
                <div>
                    <div class="hero-stat-num">24/7</div>
                    <div class="hero-stat-label">Monitoring & Support</div>
                </div>
                <div>
                    <div class="hero-stat-num">360&deg;</div>
                    <div class="hero-stat-label">Integrated Coverage</div>
                </div>
                <div>
                    <div class="hero-stat-num">ISO</div>
                    <div class="hero-stat-label">Standards Compliant</div>
                </div>
                <div>
                    <div class="hero-stat-num">Global</div>
                    <div class="hero-stat-label">Delivery Network</div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- ═══════════════════════════════════════════════════════════ -->
<!-- MARQUEE -->
<!-- ═══════════════════════════════════════════════════════════ -->
<div class="marquee-strip">
    <div class="marquee-track">
        <?php
        $items = [
            'Cybersecurity Software',
            'Hardware Protection',
            'Access Control Systems',
            'Threat Intelligence',
            'Government Solutions',
            'Network Security',
            'Risk Assessments',
            'CCTV & Surveillance',
            'Incident Response',
            'Compliance Audits',
        ];
        // Double for seamless loop
        $all = array_merge($items, $items);
        foreach ($all as $item) {
            echo '<span class="marquee-item">' . htmlspecialchars($item) . '<span class="marquee-dot"></span></span>';
        }
        ?>
    </div>
</div>


<!-- ═══════════════════════════════════════════════════════════ -->
<!-- SERVICES -->
<!-- ═══════════════════════════════════════════════════════════ -->
<section class="section services-bg" id="services">
    <div class="container">
        <div class="services-header reveal">
            <span class="label">What We Do</span>
            <h2 class="section-title">Comprehensive Security <span class="gold">Solutions</span></h2>
            <p class="section-sub">From protecting your digital infrastructure to securing your physical premises, we provide the full spectrum of integrated security.</p>
        </div>

        <div class="services-grid">

            <div class="service-card reveal">
                <div class="service-icon">&#128737;</div>
                <h3>Cybersecurity Software</h3>
                <p>Advanced threat detection, endpoint protection, SIEM integration, vulnerability management, and real-time intrusion response systems for enterprise environments.</p>
            </div>

            <div class="service-card reveal">
                <div class="service-icon">&#128268;</div>
                <h3>Hardware Security Systems</h3>
                <p>Physical security hardware including biometric readers, encrypted storage devices, tamper-proof hardware modules, and secure communication equipment.</p>
            </div>

            <div class="service-card reveal">
                <div class="service-icon">&#128274;</div>
                <h3>Access Control &amp; Surveillance</h3>
                <p>Multi-layer access control systems, IP CCTV networks, facial recognition integration, perimeter security, and smart building security management.</p>
            </div>

            <div class="service-card reveal">
                <div class="service-icon">&#127963;</div>
                <h3>Government &amp; Institutional Security</h3>
                <p>Bespoke solutions for ministries, embassies, public institutions, defence contractors, and critical national infrastructure requiring the highest security clearance.</p>
            </div>

            <div class="service-card reveal">
                <div class="service-icon">&#128202;</div>
                <h3>Threat Intelligence &amp; Monitoring</h3>
                <p>Continuous threat monitoring, dark web intelligence, penetration testing, red team exercises, and proactive risk reporting tailored to your sector.</p>
            </div>

            <div class="service-card reveal">
                <div class="service-icon">&#9997;</div>
                <h3>Security Consultancy &amp; Audit</h3>
                <p>Independent security audits, gap analysis, ISO 27001 alignment, regulatory compliance reviews, and board-level security advisory for senior leadership.</p>
            </div>

        </div>
    </div>
</section>


<!-- ═══════════════════════════════════════════════════════════ -->
<!-- ABOUT -->
<!-- ═══════════════════════════════════════════════════════════ -->
<section class="section" id="about">
    <div class="container">
        <div class="about-grid">

            <div class="about-visual reveal">
                <div class="about-box">
                    <span class="label">Our Commitment</span>
                    <h3 style="font-size:24px;margin-bottom:16px;">Built for<br>environments<br>where failure is<br><span class="gold">not an option.</span></h3>
                    <p style="font-size:14px;color:var(--text-mid);font-weight:300;line-height:1.8;">
                        Our protocols are designed around the principle that security is not a product you purchase once. It is a discipline you sustain continuously.
                    </p>

                    <div class="about-badge">
                        <span class="badge-icon">&#9989;</span>
                        <div>
                            <div class="badge-label">Standards-Led Delivery</div>
                            <div class="badge-sub">Aligned to recognised global frameworks</div>
                        </div>
                    </div>

                    <div class="about-badge">
                        <span class="badge-icon">&#127760;</span>
                        <div>
                            <div class="badge-label">Global Reach</div>
                            <div class="badge-sub">Cross-border support for complex organisations</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="about-text reveal">
                <span class="label">About OmniShield</span>
                <h2 class="section-title">Security You Can<br><span class="gold">Build Upon</span></h2>

                <p>
                    OmniShield Systems was established to address a critical gap in the market: the absence of truly integrated security providers capable of serving both the digital and physical dimensions of institutional security — under one roof, with one accountable team.
                </p>
                <p>
                    We work with corporations, financial institutions, healthcare organisations, educational establishments, governmental ministries, and international agencies that require security infrastructure they can trust absolutely.
                </p>
                <p>
                    Our approach is always holistic. We do not sell you a product. We design, implement, and maintain a complete security environment — continuously reviewed, regularly tested, and aligned to the evolving threat landscape.
                </p>
                <p>
                    Confidentiality, precision, and accountability are not promises we make. They are the standards to which we hold ourselves, and by which our clients measure us.
                </p>

                <a href="#contact" class="btn-primary" style="margin-top:12px;display:inline-flex;">
                    Talk to Our Team &rarr;
                </a>
            </div>

        </div>
    </div>
</section>


<!-- ═══════════════════════════════════════════════════════════ -->
<!-- WHY US -->
<!-- ═══════════════════════════════════════════════════════════ -->
<section class="section whyus-bg" id="why-us">
    <div class="container">
        <div class="whyus-header reveal">
            <span class="label">Why OmniShield</span>
            <h2 class="section-title">The Standard That <span class="gold">Separates Us</span></h2>
            <p class="section-sub">We are not generalists who added security to a product list. Security is the only thing we do — and we do it with rigour.</p>
        </div>

        <div class="pillars-grid">

            <div class="pillar reveal">
                <div class="pillar-num">01</div>
                <h4>Integrated by Design</h4>
                <p>Software and hardware security designed together, not bolted together. Every component speaks to every other.</p>
            </div>

            <div class="pillar reveal">
                <div class="pillar-num">02</div>
                <h4>Sector-Specific Expertise</h4>
                <p>We understand the specific risk profile of your industry — finance, government, healthcare, infrastructure, or education.</p>
            </div>

            <div class="pillar reveal">
                <div class="pillar-num">03</div>
                <h4>24/7 Response Capability</h4>
                <p>Threats do not follow office hours. Our monitoring and incident response teams operate around the clock.</p>
            </div>

            <div class="pillar reveal">
                <div class="pillar-num">04</div>
                <h4>Absolute Discretion</h4>
                <p>Every engagement is governed by strict confidentiality protocols. Your vulnerabilities never become common knowledge.</p>
            </div>

            <div class="pillar reveal">
                <div class="pillar-num">05</div>
                <h4>Compliance-First Approach</h4>
                <p>Our solutions are aligned to GDPR, ISO 27001, Cyber Essentials, and sector-specific regulatory frameworks.</p>
            </div>

            <div class="pillar reveal">
                <div class="pillar-num">06</div>
                <h4>Scalable for Any Size</h4>
                <p>From a single office to a multinational operation. Our architecture scales with your organisation without compromise.</p>
            </div>

        </div>
    </div>
</section>


<!-- ═══════════════════════════════════════════════════════════ -->
<!-- CONTACT -->
<!-- ═══════════════════════════════════════════════════════════ -->
<section class="section" id="contact">
    <div class="container">
        <div class="contact-grid">

            <!-- FORM -->
            <div>
                <div class="contact-header reveal">
                    <span class="label">Get In Touch</span>
                    <h2 class="section-title">Request a<br><span class="gold">Security Assessment</span></h2>
                    <p class="section-sub" style="margin-bottom:0;">Complete the form and our team will respond within one business day. All enquiries are treated with complete confidentiality.</p>
                </div>

                <?php if ($form_success): ?>
                <div class="form-notice success">
                    &#10003;&nbsp; Thank you. Your enquiry has been received. A member of our team will be in contact with you shortly.
                </div>
                <?php elseif ($form_error): ?>
                <div class="form-notice error">
                    &#9888;&nbsp; <?= e($form_error) ?>
                </div>
                <?php endif; ?>

                <form method="POST" action="#contact" class="reveal">
                    <div class="form-hp" aria-hidden="true">
                        <label>Company website</label>
                        <input type="text" name="company_website" tabindex="-1" autocomplete="off">
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Full Name <span class="req">*</span></label>
                            <input type="text" name="name" class="form-control" placeholder="Your full name" required value="<?= e(field_value('name')) ?>">
                        </div>
                        <div class="form-group">
                            <label>Email Address <span class="req">*</span></label>
                            <input type="email" name="email" class="form-control" placeholder="your@email.com" required value="<?= e(field_value('email')) ?>">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input type="tel" name="phone" class="form-control" placeholder="Preferred contact number" value="<?= e(field_value('phone')) ?>">
                        </div>
                        <div class="form-group">
                            <label>Organisation / Company</label>
                            <input type="text" name="organisation" class="form-control" placeholder="Your organisation" value="<?= e(field_value('organisation')) ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Area of Interest</label>
                        <select name="service" class="form-control">
                            <option value="">-- Please select --</option>
                            <option value="Cybersecurity Software" <?= ($_POST['service'] ?? '') === 'Cybersecurity Software' ? 'selected' : '' ?>>Cybersecurity Software</option>
                            <option value="Hardware Security Systems" <?= ($_POST['service'] ?? '') === 'Hardware Security Systems' ? 'selected' : '' ?>>Hardware Security Systems</option>
                            <option value="Access Control & Surveillance" <?= ($_POST['service'] ?? '') === 'Access Control & Surveillance' ? 'selected' : '' ?>>Access Control &amp; Surveillance</option>
                            <option value="Government & Institutional Security" <?= ($_POST['service'] ?? '') === 'Government & Institutional Security' ? 'selected' : '' ?>>Government &amp; Institutional Security</option>
                            <option value="Threat Intelligence & Monitoring" <?= ($_POST['service'] ?? '') === 'Threat Intelligence & Monitoring' ? 'selected' : '' ?>>Threat Intelligence &amp; Monitoring</option>
                            <option value="Security Consultancy & Audit" <?= ($_POST['service'] ?? '') === 'Security Consultancy & Audit' ? 'selected' : '' ?>>Security Consultancy &amp; Audit</option>
                            <option value="General Enquiry" <?= field_value('service') === 'General Enquiry' ? 'selected' : '' ?>>General Enquiry</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Your Message <span class="req">*</span></label>
                        <textarea name="message" class="form-control" placeholder="Please describe your security requirements or enquiry..." required><?= e(field_value('message')) ?></textarea>
                    </div>

                    <p style="font-size:12px;color:var(--text-dim);margin-bottom:20px;font-weight:300;">
                        By submitting this form you consent to us contacting you regarding your enquiry. We do not share your information with third parties.
                    </p>

                    <button type="submit" name="submit_enquiry" class="form-submit">
                        Send Enquiry &rarr;
                    </button>
                </form>
            </div>

            <!-- SIDEBAR -->
            <div class="contact-sidebar reveal">

                <div class="sidebar-card">
                    <h4>Direct Contact</h4>

                    <a href="https://wa.me/<?= CONTACT_PHONE_E164 ?>?text=Hello%20OmniShield%20Systems%2C%20I%20would%20like%20to%20discuss%20your%20security%20solutions."
                       target="_blank" rel="noopener" class="contact-link whatsapp">
                        <span class="contact-link-icon">&#128241;</span>
                        <div class="contact-link-info">
                            <span class="contact-link-label">WhatsApp</span>
                            <span class="contact-link-val">Start a confidential WhatsApp chat</span>
                        </div>
                        <span style="font-size:12px;opacity:0.6;">&#8599;</span>
                    </a>

                    <a href="https://t.me/+<?= CONTACT_PHONE_E164 ?>"
                       target="_blank" rel="noopener" class="contact-link telegram">
                        <span class="contact-link-icon">&#9992;</span>
                        <div class="contact-link-info">
                            <span class="contact-link-label">Telegram</span>
                            <span class="contact-link-val">Start a confidential Telegram chat</span>
                        </div>
                        <span style="font-size:12px;opacity:0.6;">&#8599;</span>
                    </a>

                    <a href="mailto:<?= e(CONTACT_EMAIL) ?>" class="contact-link email">
                        <span class="contact-link-icon">&#9993;</span>
                        <div class="contact-link-info">
                            <span class="contact-link-label">Email</span>
                            <span class="contact-link-val"><?= e(CONTACT_EMAIL) ?></span>
                        </div>
                        <span style="font-size:12px;opacity:0.6;">&#8599;</span>
                    </a>

                    <p class="response-time">&#128337;&nbsp; We typically respond within 4 business hours</p>
                </div>

                <div class="sidebar-card">
                    <h4>Confidentiality</h4>
                    <p style="font-size:13px;color:var(--text-dim);font-weight:300;line-height:1.8;">
                        Every enquiry is handled under strict confidentiality. Your organisation's security posture, concerns, and vulnerabilities are never disclosed.
                    </p>
                </div>

                <div class="sidebar-card">
                    <h4>International Support</h4>
                    <ul style="list-style:none;font-size:14px;color:var(--text-mid);">
                        <li style="padding:8px 0;border-bottom:1px solid var(--border);">&#127760;&nbsp; Cross-border advisory</li>
                        <li style="padding:8px 0;border-bottom:1px solid var(--border);">&#128737;&nbsp; Enterprise security programmes</li>
                        <li style="padding:8px 0;border-bottom:1px solid var(--border);">&#128274;&nbsp; Digital and physical protection</li>
                        <li style="padding:8px 0;">&#129309;&nbsp; Partner-led local delivery where required</li>
                    </ul>
                </div>

            </div>

        </div>
    </div>
</section>


<!-- ═══════════════════════════════════════════════════════════ -->
<!-- FOOTER -->
<!-- ═══════════════════════════════════════════════════════════ -->
<section class="section legal-section" id="legal">
    <div class="container">
        <div class="legal-grid">
            <article class="legal-item reveal" id="privacy">
                <span class="label">Privacy</span>
                <h3>Privacy Policy</h3>
                <p>Information submitted through this website is used only to respond to enquiries and provide requested services. We do not sell personal data or share enquiry details with third parties except where required to deliver a requested service or comply with law.</p>
            </article>

            <article class="legal-item reveal" id="terms">
                <span class="label">Terms</span>
                <h3>Terms of Service</h3>
                <p>Website content is provided for general information only and does not create a client relationship until an engagement is agreed in writing. Security recommendations, assessments, and implementation work are governed by the specific proposal or contract issued for that engagement.</p>
            </article>

            <article class="legal-item reveal" id="cookies">
                <span class="label">Cookies</span>
                <h3>Cookie Policy</h3>
                <p>This website uses only essential browser functionality for navigation and form submission. If analytics or marketing tools are added later, this policy should be updated before those tools are enabled.</p>
            </article>
        </div>
    </div>
</section>

<footer>
    <div class="container">
        <div class="footer-top">

            <div class="footer-brand">
                <a href="#home" class="nav-logo">
                    <img src="assets/omnishield-logo.svg" alt="OmniShield Technologies">
                </a>
                <p class="footer-tagline">
                    Integrated security solutions for corporations,<br>
                    institutions, and governments.<br>
                    Protecting what matters most.
                </p>
                <div class="footer-social">
                    <a href="https://wa.me/<?= CONTACT_PHONE_E164 ?>" target="_blank" class="social-icon" title="WhatsApp">&#128241;</a>
                    <a href="https://t.me/+<?= CONTACT_PHONE_E164 ?>" target="_blank" class="social-icon" title="Telegram">&#9992;</a>
                    <a href="mailto:<?= e(CONTACT_EMAIL) ?>" class="social-icon" title="Email">&#9993;</a>
                </div>
            </div>

            <div class="footer-col">
                <h5>Services</h5>
                <ul>
                    <li><a href="#services">Cybersecurity Software</a></li>
                    <li><a href="#services">Hardware Security</a></li>
                    <li><a href="#services">Access Control</a></li>
                    <li><a href="#services">Government Solutions</a></li>
                    <li><a href="#services">Threat Intelligence</a></li>
                    <li><a href="#services">Security Audits</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h5>Company</h5>
                <ul>
                    <li><a href="#about">About Us</a></li>
                    <li><a href="#why-us">Why Choose Us</a></li>
                    <li><a href="#contact">Contact</a></li>
                    <li><a href="#contact">Get a Quote</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h5>Contact</h5>
                <ul>
                    <li><a href="mailto:<?= e(CONTACT_EMAIL) ?>"><?= e(CONTACT_EMAIL) ?></a></li>
                    <li><a href="https://wa.me/<?= CONTACT_PHONE_E164 ?>">WhatsApp Us</a></li>
                    <li><a href="https://t.me/+<?= CONTACT_PHONE_E164 ?>">Telegram Us</a></li>
                </ul>
            </div>

        </div>

        <div class="footer-bottom">
            <p class="footer-copy">
                &copy; <?= date('Y') ?> <?= e(SITE_NAME) ?>. All rights reserved.
            </p>
            <div class="footer-legal">
                <a href="#privacy">Privacy Policy</a>
                <a href="#terms">Terms of Service</a>
                <a href="#cookies">Cookie Policy</a>
            </div>
        </div>
    </div>
</footer>


<!-- ═══════════════════════════════════════════════════════════ -->
<!-- JAVASCRIPT -->
<!-- ═══════════════════════════════════════════════════════════ -->
<script>
    // Mobile menu toggle
    function toggleMenu() {
        const menu = document.getElementById('mobile-menu');
        menu.style.display = (menu.style.display === 'flex') ? 'none' : 'flex';
    }

    // Close mobile menu on resize
    window.addEventListener('resize', function () {
        if (window.innerWidth > 960) {
            document.getElementById('mobile-menu').style.display = 'none';
        }
    });

    // Scroll reveal
    const reveals = document.querySelectorAll('.reveal');
    const observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry, i) {
            if (entry.isIntersecting) {
                setTimeout(function () {
                    entry.target.classList.add('visible');
                }, i * 80);
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });

    reveals.forEach(function (el) { observer.observe(el); });

    // Navbar background on scroll
    const navbar = document.getElementById('navbar');
    window.addEventListener('scroll', function () {
        if (window.scrollY > 60) {
            navbar.style.background = 'rgba(7,9,15,0.97)';
        } else {
            navbar.style.background = 'rgba(7,9,15,0.85)';
        }
    });

    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
        anchor.addEventListener('click', function (e) {
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                e.preventDefault();
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });
</script>

</body>
</html>
