const body = document.body;
const themeToggle = document.getElementById('themeToggle');
const themeIcon = themeToggle.querySelector('.theme-icon');
const savedTheme = localStorage.getItem('lacson-theme');
if (savedTheme === 'light') body.classList.add('light');

function syncThemeToggle(){
  const light = body.classList.contains('light');
  themeIcon.textContent = light ? '☀' : '☾';
  themeToggle.setAttribute('aria-label', light ? 'Switch to dark mode' : 'Switch to light mode');
  themeToggle.setAttribute('title', light ? 'Switch to dark mode' : 'Switch to light mode');
  document.querySelector('meta[name="theme-color"]').setAttribute('content', light ? '#f8f8f5' : '#050706');
}
syncThemeToggle();

function flipTheme(){
  body.classList.toggle('light');
  localStorage.setItem('lacson-theme', body.classList.contains('light') ? 'light' : 'dark');
  syncThemeToggle();
}

themeToggle.addEventListener('click', () => {
  if (!document.startViewTransition) {
    flipTheme();
    return;
  }
  const rect = themeToggle.getBoundingClientRect();
  const x = rect.left + rect.width / 2;
  const y = rect.top + rect.height / 2;
  const radius = Math.hypot(Math.max(x, innerWidth - x), Math.max(y, innerHeight - y));
  const transition = document.startViewTransition(flipTheme);
  transition.ready.then(() => {
    document.documentElement.animate(
      { clipPath: [`circle(0px at ${x}px ${y}px)`, `circle(${radius}px at ${x}px ${y}px)`] },
      { duration: 720, easing: 'cubic-bezier(.22,1,.36,1)', pseudoElement: '::view-transition-new(root)' }
    );
  });
});

function setModalOpen(modal, open){
  modal.classList.toggle('open', open);
  modal.setAttribute('aria-hidden', open ? 'false' : 'true');
  body.classList.toggle('modal-open', open);
}

const portrait = document.getElementById('portraitToggle');
if (portrait) {
  portrait.addEventListener('click', () => {
    portrait.classList.toggle('show-alt');
    portrait.classList.remove('swap-flash');
    void portrait.offsetWidth;
    portrait.classList.add('swap-flash');
    portrait.setAttribute('aria-pressed', portrait.classList.contains('show-alt') ? 'true' : 'false');
  });
  portrait.addEventListener('animationend', () => portrait.classList.remove('swap-flash'));
}

const galleryModal = document.getElementById('galleryModal');
const galleryImage = document.getElementById('galleryImage');
const galleryTitle = document.getElementById('galleryTitle');
const galleryLabel = document.getElementById('galleryLabel');
const galleryCounter = document.getElementById('galleryCounter');
const galleryPrev = document.getElementById('galleryPrev');
const galleryNext = document.getElementById('galleryNext');
let activeGallery = [];
let activeIndex = 0;

function renderGallery(){
  if (!activeGallery.length) return;
  const item = activeGallery[activeIndex];
  galleryImage.src = item.src;
  galleryImage.alt = item.label || 'Project screenshot';
  galleryLabel.textContent = item.label || 'Project screenshot';
  galleryCounter.textContent = `${activeIndex + 1} / ${activeGallery.length}`;
  galleryPrev.disabled = activeGallery.length < 2;
  galleryNext.disabled = activeGallery.length < 2;
}
document.querySelectorAll('.project-shot').forEach(button => {
  button.addEventListener('click', () => {
    try { activeGallery = JSON.parse(button.dataset.gallery || '[]'); }
    catch { activeGallery = []; }
    activeIndex = 0;
    galleryTitle.textContent = button.dataset.title || 'PROJECT';
    renderGallery();
    setModalOpen(galleryModal, true);
  });
});
galleryPrev.addEventListener('click', () => {
  if (!activeGallery.length) return;
  activeIndex = (activeIndex - 1 + activeGallery.length) % activeGallery.length;
  renderGallery();
});
galleryNext.addEventListener('click', () => {
  if (!activeGallery.length) return;
  activeIndex = (activeIndex + 1) % activeGallery.length;
  renderGallery();
});
galleryModal.querySelectorAll('[data-close-gallery]').forEach(el => el.addEventListener('click', () => setModalOpen(galleryModal, false)));

document.addEventListener('keydown', event => {
  if (event.key === 'Escape') {
    if (galleryModal.classList.contains('open')) setModalOpen(galleryModal, false);
  }
  if (galleryModal.classList.contains('open') && activeGallery.length > 1) {
    if (event.key === 'ArrowLeft') galleryPrev.click();
    if (event.key === 'ArrowRight') galleryNext.click();
  }
});
