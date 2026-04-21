<?php
/* Load .env if present */
if (file_exists(__DIR__ . '/.env')) {
    foreach (file(__DIR__ . '/.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
        if (str_starts_with(trim($line), '#') || !str_contains($line, '=')) continue;
        [$k, $v] = explode('=', $line, 2);
        putenv(trim($k) . '=' . trim($v));
    }
}
$appUrl = getenv('APP_URL') ?: 'https://marshalltechco.com';
$year   = date('Y');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Marshall TechCo — Malaysia's Digital Growth Partner</title>
<meta name="description" content="Marshall TechCo builds professional websites, e-commerce stores, and digital infrastructure for Malaysian businesses. Hosting, SSL, PWA, SEO — all handled.">
<meta name="theme-color" content="#F97316">

<!-- Open Graph -->
<meta property="og:title" content="Marshall TechCo — Malaysia's Digital Growth Partner">
<meta property="og:description" content="Professional web hosting, e-commerce, PWA, SEO, and WhatsApp integration for Malaysian businesses.">
<meta property="og:url" content="<?= htmlspecialchars($appUrl) ?>">
<meta property="og:type" content="website">

<!-- Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<!-- Styles -->
<link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>

<!-- ── Navigation ─────────────────────────────── -->
<nav>
  <div class="container nav-inner">
    <a href="/" class="nav-logo">
      <div class="mark">M</div>
      Marshall TechCo
    </a>
    <ul class="nav-links">
      <li><a href="#services">Services</a></li>
      <li><a href="#pwa">PWA Standard</a></li>
      <li><a href="#how-it-works">How It Works</a></li>
      <li><a href="#why-us">Why Us</a></li>
      <li><a href="#pricing">Pricing</a></li>
      <li><a href="#faq">FAQ</a></li>
    </ul>
    <div class="nav-cta">
      <a href="#contact" class="btn btn-outline">Contact</a>
      <a href="#pricing" class="btn btn-primary">Get Started</a>
    </div>
    <button class="hamburger" id="hamburger" aria-label="Menu">
      <svg width="22" height="22" viewBox="0 0 22 22" fill="none">
        <rect y="4" width="22" height="2" rx="1" fill="currentColor"/>
        <rect y="10" width="22" height="2" rx="1" fill="currentColor"/>
        <rect y="16" width="22" height="2" rx="1" fill="currentColor"/>
      </svg>
    </button>
  </div>
</nav>

<!-- Mobile nav overlay -->
<div id="nav-mobile">
  <a href="#services"     onclick="closeMobile()">Services</a>
  <a href="#pwa"          onclick="closeMobile()">PWA Standard</a>
  <a href="#how-it-works" onclick="closeMobile()">How It Works</a>
  <a href="#why-us"       onclick="closeMobile()">Why Us</a>
  <a href="#pricing"      onclick="closeMobile()">Pricing</a>
  <a href="#faq"          onclick="closeMobile()">FAQ</a>
  <a href="#contact"      onclick="closeMobile()">Contact</a>
  <a href="#pricing" class="btn btn-primary" onclick="closeMobile()" style="width:fit-content;margin-top:.5rem">Get Started</a>
</div>

<!-- ── Hero ─────────────────────────────────────── -->
<section id="hero">
  <div class="hero-blob-bl"></div>
  <canvas id="hero-canvas"></canvas>
  <div class="container">
    <div class="hero-inner">

      <!-- Left: copy -->
      <div class="hero-content">
        <div class="pill">🇲🇾 Malaysia's Digital Growth Partner</div>
        <h1>Your Business Deserves a <span>Proper Website</span></h1>
        <p>We build and manage professional websites, e-commerce stores, and digital infrastructure — so you can focus on running your business, not your tech.</p>
        <div class="hero-actions">
          <a href="#pricing" class="btn btn-primary">View Plans →</a>
          <a href="#contact" class="btn btn-outline">Talk to Us</a>
        </div>
        <div class="hero-stats">
          <div class="hero-stat">
            <div class="num">12+</div>
            <div class="label">Projects Done</div>
          </div>
          <div class="hero-stat">
            <div class="num">3+</div>
            <div class="label">Years Active</div>
          </div>
          <div class="hero-stat">
            <div class="num">100%</div>
            <div class="label">PWA on All Plans</div>
          </div>
        </div>
      </div>

      <!-- Right: visual showcase -->
      <div class="hero-visual">
        <div class="hero-card">
          <div class="hero-card-top">
            <div class="hero-card-dot hc-red"></div>
            <div class="hero-card-dot hc-amber"></div>
            <div class="hero-card-dot hc-green"></div>
            <span class="hero-card-label">What's Included</span>
          </div>
          <div class="hero-feats">
            <div class="hero-feat">
              <div class="hero-feat-icon">🌐</div>
              <div class="hero-feat-title">Managed Hosting</div>
              <div class="hero-feat-sub">99.9% uptime SLA</div>
            </div>
            <div class="hero-feat">
              <div class="hero-feat-icon">📱</div>
              <div class="hero-feat-title">PWA Standard</div>
              <div class="hero-feat-sub">Installable on any device</div>
            </div>
            <div class="hero-feat">
              <div class="hero-feat-icon">🔒</div>
              <div class="hero-feat-title">SSL + Security</div>
              <div class="hero-feat-sub">Free on every plan</div>
            </div>
            <div class="hero-feat">
              <div class="hero-feat-icon">🔍</div>
              <div class="hero-feat-title">SEO Ready</div>
              <div class="hero-feat-sub">Google-optimised</div>
            </div>
          </div>
        </div>
        <div class="hero-badge-row">
          <span class="hero-badge">⚡ 24–72hr Launch</span>
          <span class="hero-badge">💬 WhatsApp Support</span>
          <span class="hero-badge">🇲🇾 Malaysia-Based</span>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- ── Services ───────────────────────────────── -->
<section id="services">
  <div class="container">
    <div class="section-header">
      <div class="pill">What We Do</div>
      <h2>Website as a Service</h2>
      <p>From domain to deployment — we manage the full stack so you don't have to touch a single line of code.</p>
    </div>
    <div class="services-grid">
      <div class="service-card">
        <div class="service-icon">🌐</div>
        <h3>Website Hosting</h3>
        <p>Fast, reliable managed hosting with 99.9% uptime guarantee. Your site stays online — always.</p>
      </div>
      <div class="service-card">
        <div class="service-icon">🛒</div>
        <h3>E-Commerce & Product Management</h3>
        <p>Full-featured online stores with product catalogue, orders, and payment gateway integration.</p>
      </div>
      <div class="service-card">
        <div class="service-icon">🔗</div>
        <h3>Domain Registration & Renewal</h3>
        <p>Register .com.my, .my, .com and more. We handle renewals so you never lose your domain.</p>
      </div>
      <div class="service-card">
        <div class="service-icon">🔒</div>
        <h3>SSL Certificate</h3>
        <p>HTTPS security for your entire site. Builds trust with customers and improves Google ranking.</p>
      </div>
      <div class="service-card">
        <div class="service-icon">📱</div>
        <h3>Progressive Web App (PWA)</h3>
        <p>Turn your website into an app-like experience — installable on mobile, works offline, fast as native.</p>
      </div>
      <div class="service-card">
        <div class="service-icon">🛡️</div>
        <h3>Backup & Uptime Monitoring</h3>
        <p>Daily automated backups and real-time monitoring. We get alerted before your customers do.</p>
      </div>
      <div class="service-card">
        <div class="service-icon">🔍</div>
        <h3>SEO & Google Presence</h3>
        <p>On-page SEO, sitemap, schema markup, and Google Search Console setup to get you found.</p>
      </div>
      <div class="service-card">
        <div class="service-icon">💬</div>
        <h3>WhatsApp Business & Live Chat</h3>
        <p>WhatsApp Business integration with chat widget — let customers reach you in one tap.</p>
      </div>
      <div class="service-card">
        <div class="service-icon">✏️</div>
        <h3>Monthly Content Updates</h3>
        <p>Send us your updates — new products, promotions, announcements — and we'll publish them for you.</p>
      </div>
      <div class="service-card">
        <div class="service-icon">📊</div>
        <h3>Analytics & Monthly Reports</h3>
        <p>Google Analytics 4 + monthly traffic summary report delivered to your inbox.</p>
      </div>
      <div class="service-card">
        <div class="service-icon">📍</div>
        <h3>Google My Business Setup</h3>
        <p>Get your business on Google Maps and local search — essential for walk-in and local customers.</p>
      </div>
    </div>
  </div>
</section>

<!-- ── PWA Standard ────────────────────────────── -->
<section id="pwa">
  <div class="pwa-circle-bl"></div>
  <div class="container">
    <div class="section-header">
      <div class="pill">PWA Standard</div>
      <h2>Progressive Web App — Built Into Every Plan</h2>
      <p>Your website works like a real app — installable on any device, available offline, and blazing fast. No app store needed.</p>
    </div>
    <div class="pwa-grid">
      <div class="pwa-card">
        <div class="pwa-icon">📲</div>
        <h3>Installable on Any Device</h3>
        <p>Customers can add your site to their home screen on Android or iOS — no app store download required.</p>
      </div>
      <div class="pwa-card">
        <div class="pwa-icon">📶</div>
        <h3>Works Offline</h3>
        <p>Service workers cache key pages so your site remains accessible even with no internet connection.</p>
      </div>
      <div class="pwa-card">
        <div class="pwa-icon">⚡</div>
        <h3>Lightning Fast Loading</h3>
        <p>Smart caching delivers your pages instantly — load times under 1 second on repeat visits.</p>
      </div>
      <div class="pwa-card">
        <div class="pwa-icon">🔔</div>
        <h3>Push Notifications</h3>
        <p>Re-engage customers with promotions, order updates, and announcements sent directly to their device.</p>
      </div>
      <div class="pwa-card">
        <div class="pwa-icon">🏠</div>
        <h3>Home Screen Icon</h3>
        <p>Full-screen launch with your own icon and splash screen — indistinguishable from a native app.</p>
      </div>
      <div class="pwa-card">
        <div class="pwa-icon">💰</div>
        <h3>No App Store Fees</h3>
        <p>Skip the RM100+/year developer fees and 30% store commission. Your app, your revenue.</p>
      </div>
    </div>
    <p class="pwa-note">✓ PWA is included as <strong>standard on every plan</strong> — Starter through Enterprise.</p>
  </div>
</section>

<!-- ── How It Works ────────────────────────────── -->
<section id="how-it-works">
  <div class="container">
    <div class="section-header">
      <div class="pill">How It Works</div>
      <h2>From Idea to Live in Days, Not Months</h2>
      <p>A clear, simple process so you always know what's happening and when.</p>
    </div>
    <div class="steps-wrap">
      <div class="step-card">
        <div class="step-num">1</div>
        <h3>Choose Your Plan</h3>
        <p>Pick the plan that fits your business size and budget. Not sure? We'll help you decide.</p>
      </div>
      <div class="step-card">
        <div class="step-num">2</div>
        <h3>Onboarding Call</h3>
        <p>A quick call to understand your business, brand, and goals. No tech knowledge needed.</p>
      </div>
      <div class="step-card">
        <div class="step-num">3</div>
        <h3>Hand Over Your Content</h3>
        <p>Send us your logo, photos, and text via WhatsApp or email. We handle the rest.</p>
      </div>
      <div class="step-card">
        <div class="step-num">4</div>
        <h3>We Build It</h3>
        <p>Our team designs and develops your site. Starter plans go live within 24–72 hours.</p>
      </div>
      <div class="step-card">
        <div class="step-num">5</div>
        <h3>Review & Go Live</h3>
        <p>You review the site, request any changes, and we publish it to your domain. Done.</p>
      </div>
    </div>
  </div>
</section>

<!-- ── Why Us ──────────────────────────────────── -->
<section id="why-us">
  <div class="container">
    <div class="section-header">
      <div class="pill">Why Marshall TechCo</div>
      <h2>Built for Malaysia's Business Owners</h2>
      <p>We're not an agency that disappears after launch. We're your long-term tech partner.</p>
    </div>
    <div class="why-grid">
      <div class="why-card">
        <div class="icon">⚡</div>
        <div>
          <h3>Fast Turnaround</h3>
          <p>Most websites go live within 24–72 hours. We move quickly without cutting corners.</p>
        </div>
      </div>
      <div class="why-card">
        <div class="icon">🇲🇾</div>
        <div>
          <h3>Malaysia-Based Support</h3>
          <p>No overseas call centres. Real support in English and Bahasa Malaysia via WhatsApp.</p>
        </div>
      </div>
      <div class="why-card">
        <div class="icon">🔧</div>
        <div>
          <h3>Fully Managed</h3>
          <p>We handle hosting, updates, security patches, and backups. You just run your business.</p>
        </div>
      </div>
      <div class="why-card">
        <div class="icon">💡</div>
        <div>
          <h3>No Technical Knowledge Needed</h3>
          <p>Built for business owners, not developers. Clear communication, zero jargon.</p>
        </div>
      </div>
      <div class="why-card">
        <div class="icon">📈</div>
        <div>
          <h3>Growth-Ready Stack</h3>
          <p>Start with a simple site, scale to e-commerce, PWA, and custom integrations as you grow.</p>
        </div>
      </div>
      <div class="why-card">
        <div class="icon">🔐</div>
        <div>
          <h3>Security First</h3>
          <p>SSL, firewall rules, brute-force protection, and daily backups on every plan.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ── Pricing ─────────────────────────────────── -->
<section id="pricing">
  <div class="container">
    <div class="section-header">
      <div class="pill">Pricing</div>
      <h2>Market-Researched Pricing</h2>
      <p>All plans include hosting, SSL, PWA, and managed updates. No hidden fees.</p>
    </div>
    <div class="pricing-grid">

      <!-- Starter -->
      <div class="pricing-card">
        <div class="plan">Starter</div>
        <div class="price">RM199<span>/mo</span></div>
        <div class="setup">+ RM500 setup fee</div>
        <hr>
        <ul>
          <li>5-page professional website</li>
          <li>Managed hosting & SSL</li>
          <li>Domain registration</li>
          <li>Google My Business setup</li>
          <li>WhatsApp chat widget</li>
          <li>PWA — installable on mobile</li>
          <li>2 content updates/mo</li>
          <li>Monthly traffic report</li>
          <li class="no">E-Commerce</li>
        </ul>
        <a href="#contact" class="btn btn-outline">Get Started</a>
      </div>

      <!-- Business -->
      <div class="pricing-card">
        <div class="plan">Business</div>
        <div class="price">RM299<span>/mo</span></div>
        <div class="setup">+ RM800 setup fee</div>
        <hr>
        <ul>
          <li>10-page website</li>
          <li>Managed hosting & SSL</li>
          <li>Domain registration</li>
          <li>Google My Business setup</li>
          <li>WhatsApp Business integration</li>
          <li>PWA — installable on mobile</li>
          <li>5 content updates/mo</li>
          <li>SEO on-page optimisation</li>
          <li>Backup & uptime monitoring</li>
          <li class="no">E-Commerce</li>
        </ul>
        <a href="#contact" class="btn btn-outline">Get Started</a>
      </div>

      <!-- Growth (featured) -->
      <div class="pricing-card featured">
        <div class="featured-badge">Most Popular</div>
        <div class="plan">Growth</div>
        <div class="price">RM449<span>/mo</span></div>
        <div class="setup">+ RM1,200 setup fee</div>
        <hr>
        <ul>
          <li>Unlimited pages</li>
          <li>E-Commerce store (up to 100 products)</li>
          <li>Payment gateway integration</li>
          <li>PWA — installable on mobile</li>
          <li>WhatsApp Business integration</li>
          <li>10 content updates/mo</li>
          <li>Full SEO suite</li>
          <li>Analytics & monthly report</li>
          <li>Priority support</li>
        </ul>
        <a href="#contact" class="btn btn-primary">Get Started</a>
      </div>

      <!-- Enterprise -->
      <div class="pricing-card">
        <div class="plan">Enterprise</div>
        <div class="price">RM699<span>/mo</span></div>
        <div class="setup">+ RM2,000 setup fee</div>
        <hr>
        <ul>
          <li>Unlimited pages & products</li>
          <li>Full e-commerce suite</li>
          <li>Custom web application features</li>
          <li>PWA + offline mode</li>
          <li>Dedicated account manager</li>
          <li>Unlimited content updates</li>
          <li>Advanced SEO & reporting</li>
          <li>Multi-channel notifications</li>
          <li>Custom integrations (API)</li>
        </ul>
        <a href="#contact" class="btn btn-outline">Get Started</a>
      </div>

      <!-- Custom -->
      <div class="pricing-card" style="grid-column: 1 / -1; max-width: 480px; margin: 0 auto;">
        <div class="plan">Custom</div>
        <div class="price" style="font-size:1.6rem">B.O.R.</div>
        <div class="setup">Based on requirements</div>
        <hr>
        <ul>
          <li>Fully custom scope & timeline</li>
          <li>System integrations (ERP, CRM, API)</li>
          <li>Multi-site or SaaS platforms</li>
          <li>Dedicated development team</li>
          <li>SLA agreement</li>
        </ul>
        <a href="#contact" class="btn btn-outline">Contact for Quote</a>
      </div>

    </div>
  </div>
</section>

<!-- ── FAQ ────────────────────────────────────── -->
<section id="faq">
  <div class="container">
    <div class="section-header">
      <div class="pill">FAQ</div>
      <h2>Common Questions</h2>
    </div>
    <div class="faq-list">
      <?php
      $faqs = [
        ['Do I need to buy hosting separately?',
         'No. All plans include managed hosting on our servers. However, domain names are registered separately and billed annually — pricing varies by extension (.com.my, .com, .my etc.). We will provide the exact domain cost during onboarding based on your preferred domain name.'],
        ['How long does it take to get my website live?',
         'Starter and Business plans typically go live within 24–72 hours after we receive your content. Growth and Enterprise may take 5–10 business days depending on complexity.'],
        ['Can I upgrade my plan later?',
         'Yes, you can upgrade at any time. We\'ll adjust your plan and only charge the difference from your next billing cycle.'],
        ['Do you support local payment gateways like FPX and eWallet?',
         'Yes. We integrate with Malaysian payment gateways including Billplz, Toyyibpay, Senangpay, and Stripe for international payments.'],
        ['What happens if my website goes down?',
         'We monitor all sites 24/7. If an issue is detected, we\'re notified automatically and begin resolving it — often before you\'re even aware. Critical issues are escalated immediately.'],
        ['Is there a contract or lock-in period?',
         'Plans are month-to-month. However, the setup fee is non-refundable as it covers design and development work completed upfront.'],
        ['Can I provide my own domain?',
         'Yes. If you already own a domain, we\'ll help you point it to our servers at no extra cost.'],
        ['Do you offer website redesigns for existing sites?',
         'Yes. Contact us with your current site and requirements — we\'ll provide a custom quote for the redesign and migration.'],
        ['What is a PWA and why does it matter?',
         'A Progressive Web App (PWA) lets your website behave like a native mobile app — customers can install it to their home screen, use it offline, and receive push notifications. Every Marshall TechCo plan includes PWA at no extra cost, while competitors charge separately for it.'],
      ];
      foreach ($faqs as $i => [$q, $a]): ?>
      <div class="faq-item" id="faq-<?= $i ?>">
        <button class="faq-q" onclick="toggleFaq(<?= $i ?>)">
          <?= htmlspecialchars($q) ?>
          <svg class="chevron" width="18" height="18" viewBox="0 0 18 18" fill="none">
            <path d="M4.5 6.75L9 11.25L13.5 6.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </button>
        <div class="faq-a"><p><?= htmlspecialchars($a) ?></p></div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ── Contact ─────────────────────────────────── -->
<section id="contact">
  <div class="container">
    <div class="contact-wrap">
      <div class="contact-info">
        <div class="pill" style="margin-bottom:1rem">Get in Touch</div>
        <h2>Ready to Grow Your Business Online?</h2>
        <p>Tell us what your business needs. We'll get back to you within 1 business day.</p>
        <div class="contact-links">
          <a href="mailto:marshall@marshalltechco.com" class="contact-link">
            <span class="icon">✉️</span>
            <div>
              <div class="label">Email</div>
              <div class="val">marshall@marshalltechco.com</div>
            </div>
          </a>
          <a href="https://wa.me/60" class="contact-link" target="_blank" rel="noopener">
            <span class="icon">💬</span>
            <div>
              <div class="label">WhatsApp</div>
              <div class="val">Chat with us on WhatsApp</div>
            </div>
          </a>
          <div class="contact-link">
            <span class="icon">🕐</span>
            <div>
              <div class="label">Response Time</div>
              <div class="val">Within 1 business day</div>
            </div>
          </div>
        </div>
      </div>

      <div class="contact-form">
        <div id="form-msg" class="form-msg"></div>
        <div class="form-row">
          <div class="form-group">
            <label for="fname">Your Name *</label>
            <input type="text" id="fname" placeholder="Ahmad Rizal" autocomplete="name">
          </div>
          <div class="form-group">
            <label for="femail">Email Address *</label>
            <input type="email" id="femail" placeholder="you@example.com" autocomplete="email">
          </div>
        </div>
        <div class="form-group">
          <label for="fcompany">Company / Business Name</label>
          <input type="text" id="fcompany" placeholder="Your Business Sdn Bhd">
        </div>
        <div class="form-group">
          <label for="fservice">Interested In</label>
          <select id="fservice">
            <option value="">— Select a service —</option>
            <option>Starter Plan (RM199/mo)</option>
            <option>Business Plan (RM299/mo)</option>
            <option>Growth Plan (RM449/mo)</option>
            <option>Enterprise Plan (RM699/mo)</option>
            <option>Custom Quote</option>
            <option>Website Redesign</option>
            <option>Just have questions</option>
          </select>
        </div>
        <div class="form-group">
          <label for="fmessage">Message *</label>
          <textarea id="fmessage" placeholder="Tell us about your business and what you're looking to build..."></textarea>
        </div>
        <button class="btn btn-primary" onclick="submitForm()" style="width:100%;justify-content:center" id="submit-btn">
          Send Message →
        </button>
        <p class="form-notice" style="margin-top:.75rem">We respect your privacy. No spam, ever.</p>
      </div>
    </div>
  </div>
</section>

<!-- ── Footer ─────────────────────────────────── -->
<footer>
  <div class="container">
    <div class="footer-grid">
      <div class="footer-brand">
        <div class="nav-logo" style="margin-bottom:.75rem">
          <div class="mark">M</div>
          Marshall TechCo
        </div>
        <p>Building proper websites and digital infrastructure for Malaysian businesses. Fast, managed, and always online.</p>
      </div>
      <div class="footer-col">
        <h4>Services</h4>
        <ul>
          <li><a href="#services">Web Hosting</a></li>
          <li><a href="#services">E-Commerce</a></li>
          <li><a href="#pwa">PWA Standard</a></li>
          <li><a href="#services">SEO</a></li>
          <li><a href="#services">WhatsApp Integration</a></li>
        </ul>
      </div>
      <div class="footer-col">
        <h4>Company</h4>
        <ul>
          <li><a href="#how-it-works">How It Works</a></li>
          <li><a href="#why-us">Why Us</a></li>
          <li><a href="#pricing">Pricing</a></li>
          <li><a href="#faq">FAQ</a></li>
          <li><a href="#contact">Contact</a></li>
        </ul>
      </div>
    </div>
    <div class="footer-bottom">
      <span>© <?= $year ?> Marshall TechCo. All rights reserved.</span>
      <span>Made with care in Malaysia 🇲🇾</span>
    </div>
  </div>
</footer>

<!-- Three.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/three@0.162.0/build/three.min.js"></script>
<script src="/assets/js/hero.js"></script>

<script>
/* ── Mobile nav ── */
function closeMobile() { document.getElementById('nav-mobile').classList.remove('open'); }
document.getElementById('hamburger').addEventListener('click', () => {
  document.getElementById('nav-mobile').classList.toggle('open');
});

/* ── FAQ accordion ── */
function toggleFaq(i) {
  const item = document.getElementById('faq-' + i);
  item.classList.toggle('open');
}

/* ── Contact form ── */
async function submitForm() {
  const btn = document.getElementById('submit-btn');
  const msg = document.getElementById('form-msg');
  msg.className = 'form-msg';

  const name    = document.getElementById('fname').value.trim();
  const email   = document.getElementById('femail').value.trim();
  const company = document.getElementById('fcompany').value.trim();
  const service = document.getElementById('fservice').value;
  const message = document.getElementById('fmessage').value.trim();

  if (!name || !email || !message) {
    msg.className = 'form-msg error';
    msg.textContent = 'Please fill in your name, email, and message.';
    return;
  }

  btn.disabled = true;
  btn.textContent = 'Sending…';

  try {
    const res = await fetch('/api/contact', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ name, email, company, service, message })
    });
    const json = await res.json();
    if (json.success) {
      msg.className = 'form-msg success';
      msg.textContent = json.message;
      ['fname','femail','fcompany','fmessage'].forEach(id => document.getElementById(id).value = '');
      document.getElementById('fservice').selectedIndex = 0;
    } else {
      throw new Error(json.error || 'Unknown error');
    }
  } catch (e) {
    msg.className = 'form-msg error';
    msg.textContent = e.message || 'Something went wrong. Please email us directly.';
  }

  btn.disabled = false;
  btn.textContent = 'Send Message →';
}
</script>
</body>
</html>
