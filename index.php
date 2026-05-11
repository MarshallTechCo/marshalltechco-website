<?php
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
<title>Marshall TechCo — SaaS Products for Malaysian Businesses</title>
<meta name="description" content="Marshall TechCo builds vertical SaaS products for Malaysian SMEs — MarshallERP (B2B), InsureDesk, PropDesk, and more. Affordable, mobile-first, built for Malaysia.">
<meta name="theme-color" content="#F97316">
<meta property="og:title" content="Marshall TechCo — SaaS Products for Malaysian Businesses">
<meta property="og:description" content="MarshallERP + Sofuwara vertical apps. Built for Malaysian SMEs.">
<meta property="og:url" content="<?= htmlspecialchars($appUrl) ?>">
<meta property="og:type" content="website">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/assets/css/style.css">
<style>
/* ── New product-showcase overrides ───────────────────────────── */
.pill-blue { background: #eff6ff; color: #1d4ed8; border-radius: 100px; padding: .3rem .9rem; font-size: .78rem; font-weight: 700; display: inline-block; letter-spacing: .02em; }
.pill-orange { background: var(--accent-light); color: var(--accent2); border-radius: 100px; padding: .3rem .9rem; font-size: .78rem; font-weight: 700; display: inline-block; }

.products-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(290px,1fr)); gap: 24px; }
.product-card {
  background: var(--card); border: 1.5px solid var(--border); border-radius: 20px;
  padding: 28px 24px; display: flex; flex-direction: column; gap: 12px;
  transition: transform .2s, box-shadow .2s;
}
.product-card:hover { transform: translateY(-4px); box-shadow: 0 12px 40px rgba(0,0,0,.08); }
.product-card--featured { border-color: var(--accent); box-shadow: 0 4px 20px var(--accent-glow); }
.product-icon { width: 52px; height: 52px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; }
.product-name { font-size: 1.1rem; font-weight: 800; }
.product-sub  { font-size: .82rem; color: var(--muted); margin-top: -4px; }
.product-desc { font-size: .87rem; line-height: 1.6; color: var(--text2); }
.product-tags { display: flex; flex-wrap: wrap; gap: 6px; margin-top: 4px; }
.tag { background: var(--accent-light); color: var(--accent2); border-radius: 100px; padding: 2px 10px; font-size: .72rem; font-weight: 600; }
.tag-blue { background: #eff6ff; color: #1d4ed8; }
.product-price { font-size: .85rem; font-weight: 700; color: var(--text); margin-top: auto; padding-top: 12px; border-top: 1px solid var(--border); }
.product-price span { font-size: 1.15rem; color: var(--accent); }

.erp-section { background: #0f172a; color: #f8fafc; border-radius: 28px; padding: 60px 48px; }
.erp-section h2 { color: #fff; }
.erp-section p  { color: #94a3b8; }
.erp-modules-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 12px; margin-top: 32px; }
.erp-module { background: rgba(255,255,255,.06); border: 1px solid rgba(255,255,255,.1); border-radius: 12px; padding: 16px 18px; font-size: .85rem; }
.erp-module-ic { font-size: 1.3rem; margin-bottom: 6px; }
.erp-module-name { font-weight: 700; color: #f1f5f9; }
.erp-module-desc { color: #64748b; font-size: .78rem; margin-top: 3px; }

.pricing-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); gap: 20px; }
.pricing-card {
  background: var(--card); border: 1.5px solid var(--border); border-radius: 20px;
  padding: 32px 28px; display: flex; flex-direction: column; gap: 8px;
}
.pricing-card--best { border-color: var(--accent); position: relative; box-shadow: 0 4px 24px var(--accent-glow); }
.pricing-badge { position: absolute; top: -1px; left: 50%; transform: translateX(-50%); background: var(--accent); color: #fff; font-size: .7rem; font-weight: 800; padding: 3px 14px; border-radius: 0 0 10px 10px; letter-spacing: .05em; white-space: nowrap; }
.pricing-tier { font-size: .75rem; font-weight: 700; text-transform: uppercase; letter-spacing: .08em; color: var(--muted); }
.pricing-name { font-size: 1.3rem; font-weight: 800; }
.pricing-amt  { font-size: 2.2rem; font-weight: 900; color: var(--accent); }
.pricing-amt span { font-size: .85rem; font-weight: 500; color: var(--muted); }
.pricing-features { list-style: none; padding: 0; margin: 12px 0; display: flex; flex-direction: column; gap: 8px; }
.pricing-features li { font-size: .85rem; color: var(--text2); }
.pricing-features li::before { content: '✓ '; color: var(--accent); font-weight: 700; }

.two-col { display: grid; grid-template-columns: 1fr 1fr; gap: 40px; align-items: center; }
@media (max-width: 768px) {
  .two-col { grid-template-columns: 1fr; }
  .erp-section { padding: 40px 24px; }
}

.stat-highlight { text-align: center; }
.stat-highlight .num { font-size: 2.4rem; font-weight: 900; color: var(--accent); }
.stat-highlight .lbl { font-size: .82rem; color: var(--muted); margin-top: 2px; }

.highlight-row { display: grid; grid-template-columns: repeat(auto-fill, minmax(140px, 1fr)); gap: 20px; }

.audience-cards { display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 16px; }
.audience-card { background: var(--card); border: 1.5px solid var(--border); border-radius: 16px; padding: 22px 20px; }
.audience-ic { font-size: 1.8rem; margin-bottom: 8px; }
.audience-name { font-weight: 700; font-size: .95rem; }
.audience-desc { font-size: .82rem; color: var(--muted); margin-top: 4px; }
</style>
</head>
<body>

<!-- ── Navigation ──────────────────────────────── -->
<nav>
  <div class="container nav-inner">
    <a href="/" class="nav-logo">
      <div class="mark">M</div>
      Marshall TechCo
    </a>
    <ul class="nav-links">
      <li><a href="#products">Products</a></li>
      <li><a href="#erp">MarshallERP</a></li>
      <li><a href="#sofuwara">Sofuwara Apps</a></li>
      <li><a href="#pricing">Pricing</a></li>
      <li><a href="#contact">Contact</a></li>
    </ul>
    <div class="nav-cta">
      <a href="#contact" class="btn btn-outline">Talk to Us</a>
      <a href="#pricing" class="btn btn-primary">View Plans</a>
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

<!-- Mobile nav -->
<div id="nav-mobile">
  <a href="#products"  onclick="closeMobile()">Products</a>
  <a href="#erp"       onclick="closeMobile()">MarshallERP</a>
  <a href="#sofuwara"  onclick="closeMobile()">Sofuwara Apps</a>
  <a href="#pricing"   onclick="closeMobile()">Pricing</a>
  <a href="#contact"   onclick="closeMobile()">Contact</a>
  <a href="#pricing" class="btn btn-primary" onclick="closeMobile()" style="width:fit-content;margin-top:.5rem">View Plans</a>
</div>

<!-- ── Hero ────────────────────────────────────── -->
<section id="hero">
  <div class="hero-blob-bl"></div>
  <canvas id="hero-canvas"></canvas>
  <div class="container">
    <div class="hero-inner">
      <div class="hero-content">
        <div class="pill">🇲🇾 Built for Malaysian Businesses</div>
        <h1>Products That <span>Grow With</span> Your Business</h1>
        <p>We build affordable, mobile-first SaaS products — from enterprise ERP to vertical tools for insurance agents, property managers, freelancers, and pet owners.</p>
        <div class="hero-actions">
          <a href="#products" class="btn btn-primary">Explore Products →</a>
          <a href="#contact" class="btn btn-outline">Get a Demo</a>
        </div>
        <div class="hero-stats">
          <div class="hero-stat"><div class="num">2</div><div class="label">Product Lines</div></div>
          <div class="hero-stat"><div class="num">6+</div><div class="label">Industry Apps</div></div>
          <div class="hero-stat"><div class="num">RM29</div><div class="label">Starts From / mo</div></div>
        </div>
      </div>
      <div class="hero-visual">
        <div class="hero-card">
          <div class="hero-card-top">
            <div class="hero-card-dot hc-red"></div>
            <div class="hero-card-dot hc-amber"></div>
            <div class="hero-card-dot hc-green"></div>
            <span class="hero-card-label">Our Product Suite</span>
          </div>
          <ul class="hero-card-list">
            <li><span class="hc-ic">🏢</span><strong>MarshallERP</strong> — B2B Enterprise ERP</li>
            <li><span class="hc-ic">🛡️</span><strong>InsureDesk</strong> — Insurance Agent CRM</li>
            <li><span class="hc-ic">🏠</span><strong>PropDesk</strong> — Property Management</li>
            <li><span class="hc-ic">📊</span><strong>Charlie</strong> — Freelancer Finance</li>
            <li><span class="hc-ic">🐾</span><strong>Echo</strong> — Pet Health Tracker</li>
            <li><span class="hc-ic">🛒</span><strong>StoreDesk</strong> — E-Commerce Admin</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ── Two-Product Strategy ─────────────────────── -->
<section id="products" style="padding-top:5rem;padding-bottom:2rem">
  <div class="container">
    <div style="text-align:center;margin-bottom:40px">
      <div class="pill" style="margin-bottom:12px">Two Product Lines</div>
      <h2>One Company, Two Strategies</h2>
      <p style="max-width:580px;margin:12px auto 0;color:var(--muted);font-size:.95rem">MarshallERP targets B2B enterprises. Sofuwara delivers affordable vertical apps for specific industries.</p>
    </div>
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:24px;max-width:860px;margin:0 auto">
      <div class="product-card product-card--featured" style="padding:32px">
        <div class="product-icon" style="background:#0f172a;font-size:1.6rem">🏢</div>
        <div class="product-name" style="font-size:1.4rem">MarshallERP</div>
        <div class="product-sub">B2B Enterprise Resource Planning</div>
        <p class="product-desc">Full-stack ERP for Malaysian SMEs and manufacturers. HR, Inventory, Sales, Finance, Procurement, Renewals, and Manufacturing — all in one platform.</p>
        <div class="product-tags">
          <span class="tag tag-blue">RM 199–799/mo</span>
          <span class="tag tag-blue">SME / Manufacturing</span>
        </div>
        <a href="#erp" class="btn btn-primary" style="margin-top:16px;width:fit-content">Explore MarshallERP →</a>
      </div>
      <div class="product-card">
        <div class="product-icon" style="background:var(--accent-light);font-size:1.6rem">📱</div>
        <div class="product-name" style="font-size:1.4rem">Sofuwara Suite</div>
        <div class="product-sub">Vertical PWA Apps</div>
        <p class="product-desc">Mobile-first Progressive Web Apps for specific industries. Self-signup, instant setup, no IT department required. Runs on any device, offline-capable.</p>
        <div class="product-tags">
          <span class="tag">RM 29–149/mo</span>
          <span class="tag">6 Industry Apps</span>
        </div>
        <a href="#sofuwara" class="btn btn-outline" style="margin-top:16px;width:fit-content">View All Apps →</a>
      </div>
    </div>
  </div>
</section>

<!-- ── MarshallERP Deep Dive ─────────────────────── -->
<section id="erp">
  <div class="container">
    <div class="erp-section">
      <div class="two-col" style="margin-bottom:40px">
        <div>
          <span class="pill-blue">MarshallERP</span>
          <h2 style="margin-top:14px">Enterprise-Grade ERP<br>Built for Malaysian SMEs</h2>
          <p style="margin-top:14px;line-height:1.7">Stop juggling spreadsheets and disconnected tools. MarshallERP brings HR, inventory, procurement, sales, finance, and manufacturing into a single, affordable platform — running on your browser, no installation needed.</p>
          <div style="display:flex;gap:12px;margin-top:24px;flex-wrap:wrap">
            <a href="#erp-pricing" class="btn btn-primary">View ERP Plans</a>
            <a href="#contact" class="btn" style="background:rgba(255,255,255,.1);color:#f1f5f9">Request Demo</a>
          </div>
        </div>
        <div class="highlight-row">
          <?php foreach ([
            ['10+','Modules'],['Real-time','Dashboard'],['Role-based','Permissions'],['Audit','Trail'],
          ] as $s): ?>
          <div class="stat-highlight">
            <div class="num" style="color:#38bdf8"><?= $s[0] ?></div>
            <div class="lbl"><?= $s[1] ?></div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>

      <div class="erp-modules-grid">
        <?php foreach ([
          ['👥','HR & Payroll',       'Employees, departments, leave, claims'],
          ['📦','Inventory',          'Items, warehouses, stock transfers, valuation'],
          ['🛒','Procurement',        'Purchase requests, approval workflows, POs'],
          ['💰','Finance & Sales',    'Deals, payments, commissions, partners'],
          ['🏭','Manufacturing',      'BOM, work orders, QC checks (new!)'],
          ['🔄','Renewals',           'Contract renewals, reminders, history'],
          ['👷','Task Management',    'Staff tasks, site service, scheduling'],
          ['📊','Reports',            'Sales, HR, inventory, procurement exports'],
          ['🔐','Roles & Access',     'Granular module-level permissions'],
          ['🗄️','Master Data',        'Central lookup tables, configurable'],
          ['🔔','Notifications',      'In-app alerts + email (SMTP)'],
          ['📋','Audit Trail',        'Every action logged with timestamp + user'],
        ] as [$ic,$name,$desc]): ?>
        <div class="erp-module">
          <div class="erp-module-ic"><?= $ic ?></div>
          <div class="erp-module-name"><?= $name ?></div>
          <div class="erp-module-desc"><?= $desc ?></div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>

<!-- ── Sofuwara Apps ─────────────────────────────── -->
<section id="sofuwara">
  <div class="container">
    <div style="text-align:center;margin-bottom:40px">
      <div class="pill" style="margin-bottom:12px">Sofuwara — Vertical Apps</div>
      <h2>The Right Tool for Your Industry</h2>
      <p style="max-width:560px;margin:12px auto 0;color:var(--muted);font-size:.95rem">Each app is purpose-built for one industry. No bloat. Just the features you actually use, delivered as a mobile-first PWA.</p>
    </div>
    <div class="products-grid">
      <?php foreach ([
        ['🛡️','InsureDesk','Insurance Agent CRM','For licensed insurance agents. Manage customers, policies, follow-ups, and PDF uploads. Share policy summaries with clients via link.',['Customer CRM','Policy Tracker','Follow-Up Scheduler','PDF Upload & Parse','Client Share Link'],'RM 49–99/mo','#0ea5e9','#e0f2fe'],
        ['🏠','PropDesk','Property Management','Malaysian landlords manage properties, tenants, rental payments, utility bills, and maintenance — with a tenant-facing share portal.', ['Property CRUD','Tenant & Lease Tracking','Utility Bills','Rental Income Reports','Tenant Share Portal'],'RM 49–99/mo','#10b981','#d1fae5'],
        ['📊','Charlie','Freelancer Finance','Personal finance tracker + business invoicing for Malaysian freelancers. Track income, expenses, send invoices (PDF), and manage leads.',['Income & Expense Tracking','Invoice Generator (PDF)','Lead Pipeline','Savings Goals','Multi-currency (MYR)'],'RM 29–59/mo','#8b5cf6','#ede9fe'],
        ['🐾','Echo','Pet Health Tracker','Malaysian pet owners track daily health activities — meals, meds, grooming, vet visits. Community social feed, meal prep batches, push alerts.',['Multi-pet Profiles','Activity Logging & Calendar','Meal Prep Batches','Community Feed & Follows','Push Notifications'],'RM 59–99/yr','#f59e0b','#fef3c7'],
        ['🛒','StoreDesk','E-Commerce Admin','(Coming Soon) Product catalogue, order management, inventory sync, and WhatsApp integration for Malaysian online retailers.',['Product Catalogue','Order Management','Stock Sync','WhatsApp Integration','Analytics'],'RM 99–149/mo','#ef4444','#fee2e2'],
        ['🏢','Aether Pulse','Software House Panel','Internal operations platform — CEO KPI dashboard, agent task management, token usage tracking, and multi-channel communication hub.',['CEO KPI Dashboard','AI Token Tracking','Agent Management','Task Assignment Flow','Slack / WhatsApp Hub'],'Internal','#6366f1','#e0e7ff'],
      ] as [$ic,$name,$sub,$desc,$features,$price,$color,$bg]): ?>
      <div class="product-card <?= $price === 'Internal' ? '' : '' ?>">
        <div class="product-icon" style="background:<?= $bg ?>;color:<?= $color ?>"><?= $ic ?></div>
        <div class="product-name"><?= $name ?></div>
        <div class="product-sub"><?= $sub ?></div>
        <p class="product-desc"><?= $desc ?></p>
        <ul style="list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:5px">
          <?php foreach ($features as $f): ?><li style="font-size:.8rem;color:var(--muted)">✓ <?= $f ?></li><?php endforeach; ?>
        </ul>
        <div class="product-price">
          From <span><?= $price ?></span>
          <?= $price === 'Internal' ? '<span style="font-size:.75rem;color:var(--muted)"> — internal tool</span>' : '' ?>
          <?= str_contains($price,'Coming') ? '<span style="font-size:.75rem;color:var(--muted)"> — waitlist open</span>' : '' ?>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ── Pricing ─────────────────────────────────── -->
<section id="pricing">
  <div class="container">
    <div style="text-align:center;margin-bottom:40px">
      <div class="pill" style="margin-bottom:12px">Pricing</div>
      <h2>Simple, Affordable Plans</h2>
      <p style="max-width:520px;margin:12px auto 0;color:var(--muted);font-size:.95rem">No setup fees. Cancel anytime. Malaysian Ringgit pricing — no currency surprises.</p>
    </div>

    <h3 style="margin-bottom:20px;font-size:1rem;font-weight:700;text-transform:uppercase;letter-spacing:.08em;color:var(--muted)">MarshallERP</h3>
    <div class="pricing-grid" style="margin-bottom:48px">
      <?php foreach ([
        ['Starter','RM 199','/mo','Core modules (HR, Finance, Sales, Dashboard)','For small businesses (≤20 staff)',['HR & Payroll','Inventory','Sales & CRM','Finance','Basic Reports','5 User Seats'],false],
        ['Professional','RM 399','/mo','Full module suite including Procurement & Inventory','For growing SMEs (≤50 staff)',['Everything in Starter','Procurement Workflows','Manufacturing (BOM + WO)','Advanced Reports','Renewals Module','20 User Seats'],true],
        ['Enterprise','RM 799','/mo','Full suite + manufacturing + priority support','Manufacturers & trading companies',['Everything in Professional','Manufacturing + QC Checks','Multi-warehouse','Priority Support','Unlimited Seats','Custom Branding'],false],
      ] as [$tier,$amt,$per,$tagline,$who,$features,$best]): ?>
      <div class="pricing-card <?= $best ? 'pricing-card--best' : '' ?>" style="position:relative">
        <?php if ($best): ?><div class="pricing-badge">MOST POPULAR</div><?php endif; ?>
        <div class="pricing-tier"><?= $tier ?></div>
        <div class="pricing-name">MarshallERP <?= $tier ?></div>
        <div class="pricing-amt"><?= $amt ?><span><?= $per ?></span></div>
        <div style="font-size:.82rem;color:var(--muted)"><?= $tagline ?></div>
        <ul class="pricing-features"><?php foreach ($features as $f): ?><li><?= $f ?></li><?php endforeach; ?></ul>
        <a href="#contact" class="btn <?= $best ? 'btn-primary' : 'btn-outline' ?>" style="text-align:center;margin-top:auto">Get Started</a>
      </div>
      <?php endforeach; ?>
    </div>

    <h3 style="margin-bottom:20px;font-size:1rem;font-weight:700;text-transform:uppercase;letter-spacing:.08em;color:var(--muted)">Sofuwara Apps</h3>
    <div class="pricing-grid">
      <?php foreach ([
        ['InsureDesk','🛡️','RM 49','/mo','Solo Agent',['1 Agent Account','Customer & Policy CRM','Follow-Up Scheduler','PDF Upload','Share Links'],false],
        ['InsureDesk Agency','🛡️','RM 99','/mo','Agency Plan',['Up to 10 Agents','Manager Dashboard','Team Analytics','All Solo features','Priority Support'],true],
        ['PropDesk','🏠','RM 49','/mo','Per Manager',['Unlimited Properties','Tenant Management','Utility Bills','Income Reports','Tenant Share Portal'],false],
        ['Charlie','📊','RM 29','/mo','Freelancer',['Income & Expense','Invoice PDF','Lead Pipeline','Savings Goals','MYR + multi-currency'],false],
        ['Echo Basic','🐾','RM 59','/yr','3 Pets',['3 Pet Profiles','Full Activity Logs','Meal Prep','Community Feed','Push Notifications'],false],
        ['Echo Premium','🐾','RM 99','/yr','Unlimited Pets',['Unlimited Pets','All Basic features','Priority Support','Early Access'],false],
      ] as [$name,$ic,$amt,$per,$tagline,$features,$best]): ?>
      <div class="pricing-card <?= $best ? 'pricing-card--best' : '' ?>" style="position:relative">
        <?php if ($best): ?><div class="pricing-badge">BEST VALUE</div><?php endif; ?>
        <div class="pricing-tier"><?= $ic ?> <?= $name ?></div>
        <div class="pricing-amt"><?= $amt ?><span><?= $per ?></span></div>
        <div style="font-size:.82rem;color:var(--muted)"><?= $tagline ?></div>
        <ul class="pricing-features"><?php foreach ($features as $f): ?><li><?= $f ?></li><?php endforeach; ?></ul>
        <a href="#contact" class="btn <?= $best ? 'btn-primary' : 'btn-outline' ?>" style="text-align:center;margin-top:auto">Get Started</a>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ── Who We Build For ──────────────────────────── -->
<section style="padding:5rem 0">
  <div class="container">
    <div style="text-align:center;margin-bottom:36px">
      <h2>Built for Malaysian Business Owners</h2>
      <p style="color:var(--muted);max-width:500px;margin:10px auto 0;font-size:.95rem">We understand the Malaysian business context — BM/EN bilingual, SST-aware, local payment gateways.</p>
    </div>
    <div class="audience-cards">
      <?php foreach ([
        ['🏭','Manufacturers','Track BOM, work orders, QC — connect to procurement and inventory in one system.'],
        ['🛡️','Insurance Agents','Manage every client, policy, and follow-up from your phone — anywhere, anytime.'],
        ['🏠','Landlords','Track rent, utilities, and maintenance across all your properties with one login.'],
        ['💼','Freelancers','Invoice clients, track cash flow, and manage leads without an accountant.'],
        ['🐾','Pet Owners','Track health, meals, and vet visits for all your pets. Share updates with the community.'],
        ['🏢','SME Owners','Full ERP without the enterprise price tag — HR, inventory, sales, finance, all connected.'],
      ] as [$ic,$who,$what]): ?>
      <div class="audience-card">
        <div class="audience-ic"><?= $ic ?></div>
        <div class="audience-name"><?= $who ?></div>
        <div class="audience-desc"><?= $what ?></div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ── Contact ───────────────────────────────────── -->
<section id="contact">
  <div class="container">
    <div class="contact-inner">
      <div class="contact-text">
        <div class="pill" style="margin-bottom:14px">Get in Touch</div>
        <h2>Ready to get started?</h2>
        <p>Tell us which product interests you — we'll set up a demo and walk you through the features relevant to your business.</p>
        <ul class="contact-points">
          <li>📧 <a href="mailto:marshall@marshalltechco.com">marshall@marshalltechco.com</a></li>
          <li>🇲🇾 Based in Malaysia</li>
          <li>⚡ Response within 1 business day</li>
        </ul>
      </div>
      <form class="contact-form" action="/api/contact.php" method="POST">
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" id="name" name="name" placeholder="Your name" required>
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" placeholder="your@email.com" required>
        </div>
        <div class="form-group">
          <label for="product">Interested In</label>
          <select id="product" name="product">
            <option value="">Select a product…</option>
            <option>MarshallERP</option>
            <option>InsureDesk</option>
            <option>PropDesk</option>
            <option>Charlie</option>
            <option>Echo</option>
            <option>StoreDesk</option>
            <option>General Enquiry</option>
          </select>
        </div>
        <div class="form-group">
          <label for="message">Message</label>
          <textarea id="message" name="message" rows="4" placeholder="Tell us about your business and what you need…"></textarea>
        </div>
        <button type="submit" class="btn btn-primary" style="width:100%">Send Message →</button>
      </form>
    </div>
  </div>
</section>

<!-- ── Footer ────────────────────────────────────── -->
<footer>
  <div class="container">
    <div class="footer-top">
      <div class="footer-brand">
        <div class="nav-logo" style="margin-bottom:10px">
          <div class="mark">M</div> Marshall TechCo
        </div>
        <p>SaaS products for Malaysian businesses. Affordable, mobile-first, built to last.</p>
      </div>
      <div class="footer-links">
        <div>
          <strong>Products</strong>
          <a href="#erp">MarshallERP</a>
          <a href="#sofuwara">InsureDesk</a>
          <a href="#sofuwara">PropDesk</a>
          <a href="#sofuwara">Charlie</a>
          <a href="#sofuwara">Echo</a>
        </div>
        <div>
          <strong>Company</strong>
          <a href="#products">About</a>
          <a href="#pricing">Pricing</a>
          <a href="#contact">Contact</a>
          <a href="mailto:marshall@marshalltechco.com">Support</a>
        </div>
      </div>
    </div>
    <div class="footer-bottom">
      <span>© <?= $year ?> Marshall TechCo. All rights reserved.</span>
      <span>Built in Malaysia 🇲🇾</span>
    </div>
  </div>
</footer>

<script src="/assets/js/hero.js"></script>
<script>
function closeMobile() { document.getElementById('nav-mobile').classList.remove('open'); }
document.getElementById('hamburger')?.addEventListener('click', function() {
  document.getElementById('nav-mobile').classList.toggle('open');
});
document.querySelectorAll('a[href^="#"]').forEach(a => {
  a.addEventListener('click', () => { closeMobile(); });
});
</script>
</body>
</html>
