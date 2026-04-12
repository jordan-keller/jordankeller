document.addEventListener('DOMContentLoaded', function () {
  const link = document.getElementById('random-post-link');
  if (!link) return;

  link.addEventListener('click', function (e) {
    e.preventDefault();
    const posts = JSON.parse(link.dataset.posts);
    const random = posts[Math.floor(Math.random() * posts.length)];
    window.location.href = random;
  });
});