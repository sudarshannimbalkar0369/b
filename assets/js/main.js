document.addEventListener('DOMContentLoaded', () => {
  const cards = [...document.querySelectorAll('.movie-card')];
  const filterButtons = [...document.querySelectorAll('.category-btn')];

  filterButtons.forEach((btn) => {
    btn.addEventListener('click', () => {
      filterButtons.forEach((b) => b.classList.remove('active'));
      btn.classList.add('active');
      const category = btn.dataset.category;
      cards.forEach((card) => {
        const c = card.dataset.category;
        card.style.display = category === 'All' || c === category ? 'block' : 'none';
      });
    });
  });

  const modal = document.querySelector('#teaserModal');
  const iframe = document.querySelector('#teaserFrame');
  document.querySelectorAll('[data-teaser]').forEach((btn) => {
    btn.addEventListener('click', () => {
      iframe.src = btn.dataset.teaser;
      modal.style.display = 'flex';
    });
  });

  document.querySelectorAll('[data-close-modal]').forEach((btn) => {
    btn.addEventListener('click', () => {
      modal.style.display = 'none';
      iframe.src = '';
    });
  });

  window.addEventListener('scroll', () => {
    const y = window.scrollY;
    document.body.style.backgroundPosition = `${y * 0.03}px ${y * 0.02}px`;
  });

  const rightScroll = document.querySelector('#rightScroll');
  if (rightScroll) {
    rightScroll.addEventListener('click', () => {
      window.scrollBy({ left: 420, top: 0, behavior: 'smooth' });
    });
  }
});
