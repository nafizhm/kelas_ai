<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>Daftar Kelas Gratis</title>
<!-- Meta Pixel Code -->
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window, document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '1790596855268019');
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=1790596855268019&ev=PageView&noscript=1"
/></noscript>
<!-- End Meta Pixel Code -->
 
<link rel="stylesheet" href="assets/style.css">
</head>
<body class="form-page">
<div class="form-shell">
  <a class="brand form-brand" href="<?= base_url() ?>"><img src="assets/logo.svg" alt=""><span>AI APP BUILDER</span></a>
  <div class="registration-card">
    <div class="eyebrow">FORM PENDAFTARAN</div>
    <h1>Daftar Kelas Gratis</h1>
    <p>Isi data dengan benar. Setelah submit, peserta akan diarahkan ke member area.</p>
    <?php if ($this->session->flashdata('success')): ?><div style="background:#0b6b57;padding:14px;border-radius:12px;margin-top:18px"><?= html_escape($this->session->flashdata('success')) ?></div><?php endif; ?>
    <div id="formError" style="display:none;background:#7a2630;padding:14px;border-radius:12px;margin-top:18px"></div>
    <?= validation_errors('<div style="background:#7a2630;padding:14px;border-radius:12px;margin-top:18px">','</div>') ?>
    <?= form_open('daftar/simpan', array('id'=>'leadForm')) ?>
      <label>Nama lengkap<input required name="nama" type="text" placeholder="Nama Anda" value="<?= set_value('nama') ?>"></label>
      <label>No. WhatsApp<input required name="wa" type="tel" placeholder="08xxxxxxxxxx" value="<?= set_value('wa') ?>"></label>
      <label>Email<input required name="email" type="email" placeholder="nama@email.com" value="<?= set_value('email') ?>"></label>
      <label>Profesi Anda
        <select required name="profesi">
          <option value="">Pilih profesi</option><option>Pemilik usaha</option><option>Karyawan / staf</option><option>Guru / tenaga pendidikan</option><option>Mahasiswa / pelajar</option><option>Freelancer</option><option>Programmer</option><option>Lainnya</option>
        </select>
      </label>
      <label>Web / sistem / aplikasi apa yang ingin Anda buat?
        <textarea required name="ide" rows="5" placeholder="Contoh: aplikasi stok barang, sistem booking, website usaha, aplikasi sekolah, dll."></textarea>
      </label>
      <label>Seberapa serius Anda ingin membuatnya?
        <select required name="intent">
          <option value="">Pilih salah satu</option><option>Sekadar ingin belajar</option><option>Punya ide dan ingin mencoba</option><option>Sudah punya kebutuhan nyata</option><option>Sedang membutuhkan sistem sekarang</option>
        </select>
      </label>
      <button class="btn btn-primary btn-xl" type="submit">Masuk ke Member Area</button>
      <small>Data Anda akan disimpan untuk keperluan kelas.</small>
    <?= form_close() ?>
  </div>
</div>
<script>
(function () {
  const form = document.getElementById('leadForm');
  const errorBox = document.getElementById('formError');

  form.addEventListener('submit', async function (event) {
    event.preventDefault();
    if (!form.reportValidity()) return;

    const button = form.querySelector('button[type="submit"]');
    const whatsappTab = window.open('about:blank', '_blank');
    button.disabled = true;
    button.textContent = 'Memproses...';
    errorBox.style.display = 'none';

    try {
      const response = await fetch(form.action, {
        method: 'POST',
        body: new FormData(form),
        credentials: 'same-origin',
        headers: {'X-Requested-With': 'XMLHttpRequest'}
      });
      const result = await response.json();

      if (!response.ok || !result.success) {
        throw new Error(result.message || 'Pendaftaran gagal. Silakan coba kembali.');
      }

      // Registrasi berhasil tersimpan: kirim event Lead ke Meta Pixel.
      if (typeof fbq === 'function') {
        fbq('track', 'Lead');
      }

      if (whatsappTab) {
        whatsappTab.location.href = result.whatsapp_url;
      } else {
        window.open(result.whatsapp_url, '_blank');
      }
      window.location.replace(result.redirect_url);
    } catch (error) {
      if (whatsappTab) whatsappTab.close();
      errorBox.innerHTML = error.message;
      errorBox.style.display = 'block';
      button.disabled = false;
      button.textContent = 'Masuk ke Member Area';
    }
  });
})();
</script>
</body>
</html>
