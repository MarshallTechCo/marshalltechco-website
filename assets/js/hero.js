/* Three.js hero — light theme: dark blue wireframe + particles on light bg */
(function () {
  const canvas = document.getElementById('hero-canvas');
  if (!canvas) return;

  const renderer = new THREE.WebGLRenderer({ canvas, alpha: true, antialias: true });
  renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
  renderer.setClearColor(0x000000, 0); // fully transparent — CSS gradient shows

  const scene = new THREE.Scene();
  const camera = new THREE.PerspectiveCamera(60, 1, 0.1, 1000);
  camera.position.set(0, 0, 5);

  function resize() {
    const w = canvas.clientWidth, h = canvas.clientHeight;
    renderer.setSize(w, h, false);
    camera.aspect = w / h;
    camera.updateProjectionMatrix();
  }
  resize();
  window.addEventListener('resize', resize);

  /* ── Main icosahedron — dark blue for light bg ── */
  const icoGeo = new THREE.IcosahedronGeometry(1.4, 1);
  const icoMat = new THREE.MeshBasicMaterial({
    color: 0x1a56db, wireframe: true, transparent: true, opacity: 0.22
  });
  const ico = new THREE.Mesh(icoGeo, icoMat);
  scene.add(ico);

  /* ── Inner icosahedron — indigo ── */
  const innerGeo = new THREE.IcosahedronGeometry(0.85, 1);
  const innerMat = new THREE.MeshBasicMaterial({
    color: 0x6366f1, wireframe: true, transparent: true, opacity: 0.15
  });
  const inner = new THREE.Mesh(innerGeo, innerMat);
  scene.add(inner);

  /* ── Particle field — dark blue/indigo, visible on white ── */
  const COUNT = 280;
  const positions = new Float32Array(COUNT * 3);
  const velocities = [];
  for (let i = 0; i < COUNT; i++) {
    const r     = 4.5 + Math.random() * 3.5;
    const theta = Math.acos(2 * Math.random() - 1);
    const phi   = Math.random() * Math.PI * 2;
    positions[i * 3]     = r * Math.sin(theta) * Math.cos(phi);
    positions[i * 3 + 1] = r * Math.sin(theta) * Math.sin(phi);
    positions[i * 3 + 2] = r * Math.cos(theta);
    velocities.push({
      speed: 0.003 + Math.random() * 0.004,
      axis: new THREE.Vector3(Math.random() - .5, Math.random() - .5, Math.random() - .5).normalize()
    });
  }
  const pGeo = new THREE.BufferGeometry();
  pGeo.setAttribute('position', new THREE.BufferAttribute(positions, 3));
  const pMat = new THREE.PointsMaterial({
    color: 0x3b5bdb, size: 0.055, transparent: true, opacity: 0.45
  });
  const particles = new THREE.Points(pGeo, pMat);
  scene.add(particles);

  /* ── Mouse tilt ── */
  let mx = 0, my = 0;
  window.addEventListener('mousemove', e => {
    mx = (e.clientX / window.innerWidth  - 0.5) * 2;
    my = (e.clientY / window.innerHeight - 0.5) * 2;
  });

  /* ── Animate ── */
  const clock = new THREE.Clock();
  (function animate() {
    requestAnimationFrame(animate);
    const t = clock.getElapsedTime();

    ico.rotation.x = t * 0.12 + my * 0.15;
    ico.rotation.y = t * 0.18 + mx * 0.15;
    inner.rotation.x = -t * 0.15;
    inner.rotation.y = -t * 0.22;

    particles.rotation.y = t * 0.04 + mx * 0.05;
    particles.rotation.x = my * 0.04;

    renderer.render(scene, camera);
  })();
})();
