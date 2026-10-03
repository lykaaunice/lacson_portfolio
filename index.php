<?php
require_once __DIR__ . '/config.php';

$fallbackProjects = [
  [
    'title' => 'DocMatch',
    'category' => 'Doctor Appointment System',
    'year' => '2026',
    'description' => 'A web-based appointment and scheduling system with patient, doctor, and coordinator workflows for booking, queue handling, follow-ups, messaging, and clinic coordination.',
    'tech' => 'PHP, MySQL, JavaScript, HTML, CSS',
    'live_url' => 'https://docmatch.infinityfreeapp.com/',
    'repo_url' => 'https://github.com/lykaaunice/docmatch',
    'sort_order' => 1,
  ],
  [
    'title' => 'GRASYA WORLDWIDE',
    'category' => 'E-Commerce Group Project',
    'year' => '2025',
    'description' => 'A 2025 group e-commerce project that I helped improve, with customer accounts, product browsing, cart and checkout, order flow, reviews, and admin product management.',
    'tech' => 'PHP, MySQL, JavaScript, HTML, CSS',
    'live_url' => 'https://grasya-worldwide.infinityfreeapp.com/index.php',
    'repo_url' => 'https://github.com/lykaaunice/grasya-worldwide',
    'sort_order' => 2,
  ],
  [
    'title' => 'Lyka Lacson Portfolio',
    'category' => 'Personal Portfolio Website',
    'year' => '2026',
    'description' => 'My personal portfolio website presenting my background, networking interests, tools, selected projects, resume, and contact information in a responsive dark and light interface.',
    'tech' => 'PHP, MySQL, JavaScript, HTML, CSS',
    'live_url' => '',
    'repo_url' => '',
    'sort_order' => 3,
  ],
];

$projects = [];
if ($conn) {
  $result = $conn->query("SELECT * FROM projects WHERE title IN ('DocMatch','GRASYA WORLDWIDE','Lyka Lacson Portfolio') ORDER BY sort_order, id");
  if ($result) {
    while ($row = $result->fetch_assoc()) {
      if ($row['title'] === 'GRASYA WORLDWIDE') {
        $row['year'] = '2025';
        $row['category'] = 'E-Commerce Group Project';
        $row['description'] = 'A 2025 group e-commerce project that I helped improve, with customer accounts, product browsing, cart and checkout, order flow, reviews, and admin product management.';
        $row['live_url'] = 'https://grasya-worldwide.infinityfreeapp.com/index.php';
        $row['repo_url'] = 'https://github.com/lykaaunice/grasya-worldwide';
      }
      $projects[] = $row;
    }
  }
}
$existingTitles = array_column($projects, 'title');
foreach ($fallbackProjects as $fallbackProject) {
  if (!in_array($fallbackProject['title'], $existingTitles, true)) {
    $projects[] = $fallbackProject;
  }
}
usort($projects, fn($a, $b) => ((int)$a['sort_order']) <=> ((int)$b['sort_order']));

$projectMedia = [
  'DocMatch' => [
    'cover' => 'assets/projects/docmatch-home.png',
    'gallery' => [
      ['src' => 'assets/projects/docmatch-home.png', 'label' => 'Landing page'],
      ['src' => 'assets/projects/docmatch-patient.png', 'label' => 'Patient booking workspace'],
      ['src' => 'assets/projects/docmatch-doctor.png', 'label' => 'Doctor dashboard'],
      ['src' => 'assets/projects/docmatch-coordinator.png', 'label' => 'Coordinator dashboard'],
    ],
  ],
  'GRASYA WORLDWIDE' => [
    'cover' => 'assets/projects/grasya-home.png',
    'gallery' => [
      ['src' => 'assets/projects/grasya-home.png', 'label' => 'Storefront landing page'],
      ['src' => 'assets/projects/grasya-products.png', 'label' => 'Product collection page'],
      ['src' => 'assets/projects/grasya-admin.png', 'label' => 'Admin product management'],
    ],
  ],
  'Lyka Lacson Portfolio' => [
    'cover' => 'assets/projects/portfolio-home.png',
    'gallery' => [
      ['src' => 'assets/projects/portfolio-home.png', 'label' => 'Portfolio home and profile'],
      ['src' => 'assets/projects/portfolio-about.png', 'label' => 'About, education, experience, and tech stack'],
    ],
  ],
];
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="description" content="Portfolio of Lyka Aunice Lopez Lacson, an aspiring IT and Network Specialist.">
<meta name="theme-color" content="#050706">
<title>Lyka Lacson | Portfolio</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="grain" aria-hidden="true"></div>
<header class="topbar shell">
  <a class="wordmark" href="#home">LYKA LACSON</a>
  <nav aria-label="Primary navigation">
    <a href="#about">ABOUT ME</a>
    <span>/</span>
    <a href="#projects">PROJECTS</a>
    <span>/</span>
    <a href="#contact">CONTACT</a>
  </nav>
  <button id="themeToggle" class="theme-toggle" type="button" aria-label="Switch to light mode" title="Toggle light / dark mode">
    <span class="theme-icon" aria-hidden="true">☾</span>
  </button>
</header>

<main>
<section id="home" class="hero shell">
  <div class="hero-rail"><span></span>LYKA LACSON&nbsp;&nbsp;||&nbsp;&nbsp;PORTFOLIO 2026</div>

  <button class="portrait-frame" id="portraitToggle" type="button" aria-pressed="false" aria-label="Switch personal photo">
    <img src="assets/profile-solo-crop.jpg" alt="Lyka Aunice Lopez Lacson" class="portrait-layer portrait-primary">
    <img src="assets/profile-couple.jpg" alt="Lyka with her girlfriend" class="portrait-layer portrait-secondary">
  </button>

  <div class="hero-copy">
    <p class="eyebrow">ASPIRING IT &amp; NETWORK SPECIALIST</p>
    <h1>Lyka Aunice<br>Lopez Lacson</h1>
    <p class="hero-meta">⌖ Dasmariñas City, Cavite, Philippines</p>
    <div class="hero-actions">
      <a class="btn solid" href="assets/Lyka_Lacson_Resume.png" target="_blank" rel="noopener">VIEW RESUME</a>
      <a class="btn" href="https://mail.google.com/mail/?view=cm&amp;fs=1&amp;to=lykaaunicelacson@gmail.com&amp;su=Portfolio%20Inquiry" target="_blank" rel="noopener">EMAIL ME</a>
    </div>
    <div class="hero-mini">NCST · BSIT · 3RD YEAR</div>
  </div>
</section>

<div class="divider"><span>ABOUT / EXPERIENCE / EDUCATION / TECH STACK</span></div>
<section id="about" class="shell section profile-grid reference-grid">
  <article class="info-card experience-card">
    <div class="card-topline"><span>EXPERIENCE</span><small>WORK BACKGROUND</small></div>
    <div class="timeline-list">
      <div class="timeline-item current"><span class="timeline-dot"></span><div><b>Independent Online Seller</b><small>2021 — Present</small><p>Managed buy-and-sell transactions through Facebook Marketplace, handled customer inquiries, orders, and deliveries.</p></div></div>
      <div class="timeline-item"><span class="timeline-dot"></span><div><b>Barista · Family Business</b><small>2021 — 2025</small><p>Prepared beverages, assisted customers and orders, and helped maintain basic inventory and cleanliness.</p></div></div>
      <div class="timeline-item"><span class="timeline-dot"></span><div><b>Thrift Purger Company · All-Around Staff</b><small>2021 — 2022</small><p>Supported live selling, order verification, packing, and scheduled shipment preparation.</p></div></div>
    </div>
  </article>

  <article class="info-card about-card">
    <div class="card-topline"><span>ABOUT</span><small>PROFILE</small></div>
    <p>I’m a third-year BS Information Technology student who enjoys learning by building and exploring how systems work.</p>
    <p>Among my subjects, networking is one of the ones I enjoy the most because I like studying structured cabling, cable organization, device connection, and how a network is set up in actual environments.</p>
    <p>Alongside that interest, I also build website projects for school and continue using AI-assisted tools to help me work smarter and faster while still improving my own skills.</p>
  </article>

  <article class="info-card education-card">
    <div class="card-topline"><span>EDUCATION</span><small>BACKGROUND</small></div>
    <div class="education-list">
      <div class="education-item active"><span class="timeline-dot"></span><div><b>National College of Science and Technology</b><small>2024 — Present</small><p>Bachelor of Science in Information Technology · 3rd Year College</p></div></div>
      <div class="education-item"><span class="timeline-dot"></span><div><b>Dasmariñas Integrated High School</b><small>2022 — 2024</small><p>Senior High School</p></div></div>
      <div class="education-item"><span class="timeline-dot"></span><div><b>Dasmariñas East Integrated High School</b><small>2018 — 2022</small><p>Junior High School</p></div></div>
      <div class="education-item"><span class="timeline-dot"></span><div><b>Victoria Reyes Elementary School</b><small>2012 — 2018</small><p>Primary Education</p></div></div>
    </div>
  </article>

  <article class="info-card stack-card">
    <div class="card-topline"><span>TECH STACK</span><small>TOOLS I USE</small></div>
    <div class="stack-sections">
      <div class="stack-row">
        <b>FRONTEND</b>
        <div class="stack-pills">
          <span class="pill frontend">HTML</span>
          <span class="pill frontend">CSS</span>
          <span class="pill frontend">JavaScript</span>
          <span class="pill frontend">TypeScript</span>
          <span class="pill frontend">React</span>
          <span class="pill frontend">Tailwind</span>
          <span class="pill frontend">Bootstrap</span>
          <span class="pill frontend">Next.js</span>
        </div>
      </div>
      <div class="stack-row">
        <b>BACKEND</b>
        <div class="stack-pills">
          <span class="pill backend">Node.js</span>
          <span class="pill backend">MySQL</span>
          <span class="pill backend">PostgreSQL</span>
          <span class="pill backend">ExpressJS</span>
          <span class="pill backend">PHP</span>
        </div>
      </div>
      <div class="stack-row">
        <b>TOOLS</b>
        <div class="stack-pills">
          <span class="pill tools">GitHub</span>
          <span class="pill tools">VS Code</span>
          <span class="pill tools">Figma</span>
          <span class="pill tools">Canva</span>
          <span class="pill tools">Adobe Animate</span>
          <span class="pill tools">XAMPP</span>
        </div>
      </div>
      <div class="stack-row">
        <b>FOCUS</b>
        <div class="stack-pills">
          <span class="pill focus">Networking</span>
          <span class="pill focus">Structured Cabling</span>
          <span class="pill focus">Troubleshooting</span>
          <span class="pill focus">Documentation</span>
        </div>
      </div>
    </div>
  </article>
</section>

<div class="divider"><span>FEATURED PROJECTS</span></div>
<section id="projects" class="shell section projects-section">
  <div class="section-head">
    <div><div class="section-label">SELECTED WORK</div><h2>Projects I’ve worked on.</h2></div>
    <span class="count"><?=str_pad((string)count($projects),2,'0',STR_PAD_LEFT)?> PROJECTS</span>
  </div>

  <div class="project-list">
  <?php foreach ($projects as $p):
    $media = $projectMedia[$p['title']] ?? null;
    $galleryJson = $media ? htmlspecialchars(json_encode($media['gallery'], JSON_UNESCAPED_SLASHES), ENT_QUOTES, 'UTF-8') : '';
  ?>
    <article class="project-row">
      <div class="project-index"><?=str_pad((string)$p['sort_order'],2,'0',STR_PAD_LEFT)?></div>
      <div class="project-preview">
        <?php if ($media): ?>
          <button class="project-shot" type="button" data-gallery="<?=$galleryJson?>" data-title="<?=htmlspecialchars($p['title'])?>" aria-label="Open <?=htmlspecialchars($p['title'])?> screenshots">
            <img src="<?=htmlspecialchars($media['cover'])?>" alt="<?=htmlspecialchars($p['title'])?> screenshot">
            <span class="shot-overlay">VIEW SCREENSHOTS <b>↗</b></span>
          </button>
        <?php endif; ?>
      </div>
      <div class="project-info">
        <div class="project-meta"><?=htmlspecialchars($p['category'])?> / <?=htmlspecialchars($p['year'])?></div>
        <h3><?=htmlspecialchars($p['title'])?></h3>
        <p><?=htmlspecialchars($p['description'])?></p>
        <div class="tags"><?php foreach(explode(',',$p['tech']) as $t): ?><span><?=htmlspecialchars(trim($t))?></span><?php endforeach; ?></div>
        <div class="links">
          <?php if(!empty($p['live_url'])): ?><a href="<?=htmlspecialchars($p['live_url'])?>" target="_blank" rel="noopener">LIVE DEMO ↗</a><?php endif; ?>
          <?php if(!empty($p['repo_url'])): ?><a href="<?=htmlspecialchars($p['repo_url'])?>" target="_blank" rel="noopener">GITHUB REPOSITORY ↗</a><?php endif; ?>
        </div>
      </div>
    </article>
  <?php endforeach; ?>
  </div>
</section>

<div class="divider"><span>SOCIALS / GET IN TOUCH</span></div>
<section id="contact" class="shell section contact-grid">
  <div class="panel contact-panel">
    <div class="section-label">FIND ME ON</div>
    <div class="link-stack">
      <a class="contact-link-card" href="https://github.com/lykaaunice" target="_blank" rel="noopener"><span class="contact-icon">GH</span><span class="contact-copy"><b>GitHub</b><small>@lykaaunice</small></span><span class="contact-arrow">↗</span></a>
      <a class="contact-link-card" href="https://www.instagram.com/ilykamatcha" target="_blank" rel="noopener"><span class="contact-icon">IG</span><span class="contact-copy"><b>Instagram</b><small>@ilykamatcha</small></span><span class="contact-arrow">↗</span></a>
      <a class="contact-link-card" href="https://www.facebook.com/share/19aRmqHbTb/?mibextid=wwXIfr" target="_blank" rel="noopener"><span class="contact-icon">FB</span><span class="contact-copy"><b>Facebook</b><small>Connect with me</small></span><span class="contact-arrow">↗</span></a>
    </div>
  </div>
  <div class="panel contact-panel">
    <div class="section-label">GET IN TOUCH</div>
    <div class="link-stack">
      <a class="contact-link-card" href="https://mail.google.com/mail/?view=cm&amp;fs=1&amp;to=lykaaunicelacson@gmail.com&amp;su=Portfolio%20Inquiry" target="_blank" rel="noopener"><span class="contact-icon">@</span><span class="contact-copy"><b>Email</b><small>lykaaunicelacson@gmail.com</small></span><span class="contact-arrow">↗</span></a>
      <a class="contact-link-card" href="tel:+639610947249"><span class="contact-icon">PH</span><span class="contact-copy"><b>Reach me</b><small>0961 094 7249</small></span><span class="contact-arrow">↗</span></a>
    </div>
  </div>
</section>
</main>

<footer class="shell"><span>© <?=date('Y')?> LYKA AUNICE LOPEZ LACSON</span><span>NETWORKING · IT · WEB SYSTEMS</span></footer>

<div class="modal" id="galleryModal" aria-hidden="true">
  <div class="modal-backdrop" data-close-gallery></div>
  <div class="modal-card gallery-modal-card" role="dialog" aria-modal="true" aria-label="Project screenshots">
    <button class="modal-close" type="button" data-close-gallery aria-label="Close">×</button>
    <div class="gallery-top"><div><span class="section-label" id="galleryTitle">PROJECT</span><p id="galleryLabel">Screenshot</p></div><span id="galleryCounter">1 / 1</span></div>
    <div class="gallery-stage"><img id="galleryImage" src="" alt="Project screenshot"></div>
    <div class="gallery-controls"><button id="galleryPrev" type="button">← PREVIOUS</button><button id="galleryNext" type="button">NEXT →</button></div>
  </div>
</div>

<script src="script.js"></script>
</body>
</html>
