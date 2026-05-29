@extends('layouts.app')

@section('title', 'Profil Saya - UNDONET')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap');

    :root {
        --undonet-red: #dc2626;
        --undonet-red-dark: #991b1b;
        --undonet-ink: #111827;
        --undonet-muted: #64748b;
        --undonet-soft: #f8fafc;
        --undonet-line: #e5e7eb;
    }

    body {
        background:
            radial-gradient(circle at top left, rgba(220,38,38,.08), transparent 28rem),
            #f8fafc;
        font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    }

    .profile-header {
        position: relative;
        overflow: hidden;
        background:
            linear-gradient(135deg, #111827 0%, #991b1b 58%, #dc2626 100%),
            radial-gradient(circle at 78% 18%, rgba(255,255,255,.22), transparent 18rem);
        padding: 72px 0 118px;
        color: white;
    }

    .profile-header:after {
        content: '';
        position: absolute;
        width: 520px;
        height: 520px;
        right: -150px;
        top: -190px;
        border-radius: 50%;
        background: rgba(255,255,255,.12);
        pointer-events: none;
    }

    .profile-kicker {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 7px 14px;
        border: 1px solid rgba(255,255,255,.22);
        border-radius: 999px;
        background: rgba(255,255,255,.12);
        color: white;
        font-size: 12px;
        font-weight: 800;
        letter-spacing: .08em;
        text-transform: uppercase;
        backdrop-filter: blur(10px);
    }

    .main-wrapper { margin-top: -70px; padding-bottom: 88px; position: relative; z-index: 2; }

    .profile-card {
        background: white;
        border-radius: 28px;
        border: 1px solid rgba(226,232,240,.9);
        box-shadow: 0 18px 55px rgba(15,23,42,.08);
        overflow: hidden;
    }

    .avatar-circle {
        width: 110px;
        height: 110px;
        background: linear-gradient(135deg, #ef4444, #991b1b);
        font-size: 2.5rem;
        border: 4px solid white;
        box-shadow: 0 16px 35px rgba(220,38,38,.20);
    }

    .profile-avatar-wrapper:hover img {
        filter: brightness(85%);
        transition: 0.3s;
    }
    .profile-avatar-wrapper:hover .avatar-circle {
        filter: brightness(90%);
        transition: 0.3s;
    }

    .form-control, .form-select {
        border: 1px solid var(--undonet-line);
        border-radius: 14px;
        padding: 12px 16px;
        transition: 0.3s;
        font-size: 14px;
    }

    .form-control:focus, .form-select:focus {
        border-color: var(--undonet-red);
        box-shadow: 0 0 0 4px rgba(220, 38, 38, 0.10);
    }

    .btn-save {
        background: linear-gradient(135deg, #ef4444, #b91c1c);
        color: white;
        border: none;
        border-radius: 999px;
        padding: 13px 26px;
        font-weight: 800;
        transition: 0.3s;
        box-shadow: 0 14px 32px rgba(220, 38, 38, 0.24);
    }

    .btn-save:hover {
        transform: translateY(-2px);
        box-shadow: 0 18px 38px rgba(220, 38, 38, 0.32);
        color: white;
    }

    .btn-back {
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: white;
        border-radius: 999px;
        padding: 10px 18px;
        backdrop-filter: blur(10px);
        transition: 0.3s;
        text-decoration: none;
        font-weight: 800;
        font-size: 14px;
    }

    .btn-back:hover {
        background: white;
        color: var(--undonet-ink);
    }

    .history-item {
        border: 1px solid var(--undonet-line);
        border-radius: 20px;
        transition: 0.3s;
        background: #fff;
    }

    .history-item:hover {
        border-color: #fecaca;
        background: #fffafa;
        transform: translateY(-2px);
    }

    .badge-status {
        background: #fff1f2;
        color: var(--undonet-red);
        font-weight: 800;
        padding: 7px 12px;
        border-radius: 999px;
    }

    .icon-box {
        width: 38px;
        height: 38px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #fff1f2;
        color: var(--undonet-red);
        border-radius: 12px;
        flex-shrink: 0;
    }

    .section-icon {
        width: 48px;
        height: 48px;
        border-radius: 16px;
        display: grid;
        place-items: center;
        background: #fff1f2;
        color: var(--undonet-red);
    }

    .security-box {
        padding: 18px;
        border-radius: 22px;
        border: 1px solid var(--undonet-line);
        background:
            radial-gradient(circle at top right, rgba(220,38,38,.08), transparent 14rem),
            #f8fafc;
    }

    .text-primary { color: var(--undonet-red) !important; }
    .bg-primary { background-color: var(--undonet-red) !important; }
    .btn-outline-success {
        color: var(--undonet-red);
        border-color: #fecaca;
        font-weight: 800;
    }
    .btn-outline-success:hover {
        color: #fff;
        background: var(--undonet-red);
        border-color: var(--undonet-red);
    }

    @media (max-width: 767.98px) {
        .profile-header { padding: 56px 0 106px; }
        .profile-header .d-flex { align-items: flex-start !important; gap: 18px; }
        .btn-back { width: 100%; justify-content: center; display: inline-flex; }
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<div class="profile-header">
    <div class="container">
        <div class="d-flex flex-wrap justify-content-between align-items-center position-relative" style="z-index:2;">
            <div>
                <span class="profile-kicker"><i class="bi bi-person-badge"></i> UNDONET Customer Portal</span>
                <h1 class="fw-bold mb-2 mt-3" style="font-size:clamp(32px,5vw,52px);letter-spacing:-.04em;">Akun Saya</h1>
                <p class="opacity-75 mb-0">Kelola data pelanggan, keamanan akun, dan riwayat berlangganan UNDONET.</p>
            </div>
            <a href="{{ url('/') }}" class="btn-back">
                <i class="bi bi-arrow-left me-2"></i>Kembali ke Beranda
            </a>
        </div>
    </div>
</div>

<div class="container main-wrapper">
    <div class="row g-4">
        
        {{-- SIDEBAR PROFIL --}}
        <div class="col-lg-4">
            <div class="profile-card p-4 text-center sticky-top" style="top: 100px;">
                
                <div class="d-flex justify-content-center mb-3">
                <div class="position-relative profile-avatar-wrapper" onclick="document.getElementById('fileFotoInput').click();" style="cursor: pointer; width: 110px; height: 110px;" title="Klik untuk ganti foto profil">
                        
                        @if(Auth::user()->foto && file_exists(public_path('uploads/profil/' . Auth::user()->foto)))
                            <img id="avatar-img" src="{{ asset('uploads/profil/' . Auth::user()->foto) }}" 
                                 class="rounded-circle border" 
                                 style="width: 110px; height: 110px; object-fit: cover; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                        @else
                            <div id="avatar-placeholder" class="avatar-circle rounded-circle d-flex align-items-center justify-content-center text-white fw-bold">
                                {{ strtoupper(substr(Auth::user()->nama, 0, 1)) }}
                            </div>
                        @endif

                        <div class="position-absolute bottom-0 end-0 bg-dark text-white rounded-circle d-flex align-items-center justify-content-center" 
                             style="width: 32px; height: 32px; border: 3px solid white; box-shadow: 0 2px 5px rgba(0,0,0,0.2);">
                            <i class="bi bi-camera-fill" style="font-size: 0.85rem;"></i>
                        </div>
                    </div>
                </div>

                <h4 class="fw-bold text-dark mb-1">Hi, {{ Auth::user()->nama }}!</h4>
                
                @if(Auth::user()->bio)
                    <p class="small text-secondary px-3 mb-1"><em>"{{ Auth::user()->bio }}"</em></p>
                @endif
                
                <p class="text-muted mb-3">@ {{ Auth::user()->username }}</p>
                
                <div class="d-flex justify-content-center gap-2">
                    <span class="badge-status small">
                        <i class="bi bi-patch-check-fill me-1"></i> Pelanggan UNDONET
                    </span>
                </div>
                
                <hr class="my-4 opacity-50">

                <div class="text-start">
                    <div class="d-flex align-items-center mb-3">
                        <div class="icon-box me-3"><i class="bi bi-envelope"></i></div>
                        <div class="flex-grow-1 text-truncate">
                            <p class="text-muted small mb-0">Email</p>
                            <p class="fw-bold mb-0 text-truncate" title="{{ Auth::user()->email }}">{{ Auth::user()->email }}</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <div class="icon-box me-3"><i class="bi bi-telephone"></i></div>
                        <div>
                            <p class="text-muted small mb-0">No. Handphone</p>
                            <p class="fw-bold mb-0">{{ Auth::user()->hp ?? '-' }}</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <div class="icon-box me-3"><i class="bi bi-gender-ambiguous"></i></div>
                        <div>
                            <p class="text-muted small mb-0">Jenis Kelamin</p>
                            <p class="fw-bold mb-0">
                                @if(Auth::user()->jenis_kelamin == 'L') Laki-laki 
                                @elseif(Auth::user()->jenis_kelamin == 'P') Perempuan 
                                @else - @endif
                            </p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <div class="icon-box me-3"><i class="bi bi-geo-alt"></i></div>
                        <div>
                            <p class="text-muted small mb-0">Alamat Pemasangan</p>
                            <p class="fw-bold mb-0 small">{{ Auth::user()->alamat ?? '-' }}</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="icon-box me-3"><i class="bi bi-calendar-event"></i></div>
                        <div>
                            <p class="text-muted small mb-0">Bergabung Sejak</p>
                            <p class="fw-bold mb-0">{{ Auth::user()->created_at->format('M Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- CONTENT AREA --}}
        <div class="col-lg-8">
            @if($errors->any())
                <div class="alert alert-danger border-0 shadow-sm rounded-4 mb-4 animate__animated animate__headShake">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ $errors->first() }}
                </div>
            @endif

            {{-- FORM EDIT --}}
            <div class="profile-card p-4 mb-4">
                <div class="d-flex align-items-center mb-4">
                    <div class="section-icon me-3">
                        <i class="bi bi-person-gear fs-4"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-0">Pengaturan Profil</h5>
                        <p class="text-muted small mb-0">Pastikan data pelanggan dan alamat pemasangan selalu terbaru.</p>
                    </div>
                </div>

                <form id="formProfil" action="{{ route('pelanggan.profil.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf 
                    @method('PUT')
                    
                    <input type="file" id="fileFotoInput" name="foto" class="d-none" accept="image/*" onchange="prosesGantiFoto(this)">

                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control" value="{{ Auth::user()->nama }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Username</label>
                            <input type="text" name="username" class="form-control" value="{{ Auth::user()->username }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">No. Handphone</label>
                            <input type="text" name="hp" class="form-control" value="{{ Auth::user()->hp }}" placeholder="Contoh: 08123456789">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-bold">Jenis Kelamin</label>
                            <div class="d-flex gap-4 mt-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="jk_l" value="L" {{ Auth::user()->jenis_kelamin == 'L' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="jk_l">Laki-laki</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="jk_p" value="P" {{ Auth::user()->jenis_kelamin == 'P' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="jk_p">Perempuan</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-bold">Catatan Pelanggan</label>
                            <textarea name="bio" class="form-control" rows="2" placeholder="Contoh: preferensi jadwal teknisi atau catatan layanan...">{{ Auth::user()->bio }}</textarea>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-bold">Alamat Pemasangan</label>
                            <textarea name="alamat" class="form-control" rows="3" placeholder="Tulis alamat pemasangan internet lengkap Anda...">{{ Auth::user()->alamat }}</textarea>
                        </div>
                        
                        <div class="col-12 mt-4">
                            <div class="security-box">
                                <p class="fw-bold mb-3 small text-primary text-uppercase"><i class="bi bi-shield-lock me-1"></i> Ubah Keamanan</p>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Password Baru</label>
                                        <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak ingin diubah">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Konfirmasi Password</label>
                                        <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password baru">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 text-end">
                            <button type="button" class="btn btn-save px-5 mt-2" onclick="konfirmasiSimpan()">
                                Simpan Perubahan
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            {{-- RIWAYAT TRANSAKSI --}}
            <div class="profile-card p-4">
                <div class="d-flex align-items-center mb-4">
                    <div class="section-icon me-3">
                        <i class="bi bi-receipt-cutoff fs-4"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-0">Riwayat Layanan</h5>
                        <p class="text-muted small mb-0">Invoice dan paket yang pernah Anda pilih.</p>
                    </div>
                </div>

                @forelse($transaksi as $t)
                <div class="history-item p-3 mb-3">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                        <div class="d-flex align-items-center">
                        <div class="me-3">
                                <div class="badge p-2 fs-5 rounded-3" style="background:#fff1f2;color:#dc2626;">
                                    <i class="bi bi-receipt"></i>
                                </div>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-0">ID Layanan: #{{ $t->id }}</h6>
                                <p class="text-muted small mb-0">
                                    {{ \Carbon\Carbon::parse($t->tanggal)->format('d F Y') }}
                                    <span class="mx-1">•</span>
                                    {{ $t->durasi_langganan ?? 1 }} bulan
                                </p>
                            </div>
                        </div>
                        <div class="text-md-end">
                            <p class="fw-bold text-primary mb-1">Rp {{ number_format($t->total_harga,0,',','.') }}</p>
                            <a href="{{ route('pelanggan.invoice', $t->id) }}" class="btn btn-sm btn-outline-success rounded-pill" target="_blank">
                                <i class="bi bi-printer me-1"></i> Cetak Invoice
                            </a>
                        </div>
                    </div>
                    <hr class="my-3 opacity-25">
                    <div class="ps-md-5">
                        <p class="small fw-bold text-muted mb-2">Paket layanan:</p>
                        @foreach($t->details as $d)
                        <div class="d-flex justify-content-between mb-1">
                            <span class="small">{{ $d->produk->nama }} <span class="text-primary fw-bold">x{{ $d->jumlah }}</span></span>
                        </div>
                        @endforeach
                    </div>
                </div>
                @empty
                <div class="text-center py-5">
                    <div class="section-icon mx-auto mb-3" style="width:72px;height:72px;font-size:30px;"><i class="bi bi-router"></i></div>
                    <p class="text-muted">Anda belum memiliki riwayat layanan.</p>
                </div>
                @endforelse
            </div>

        </div>
    </div>
</div>

{{-- SCRIPT JAVASCRIPT --}}
<script>
    // Konfigurasi SweetAlert2 Toast Melayang di Atas Kanan
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3500,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });

    // Otomatis tangkap flash message dari Controller setelah refresh halaman
    @if(session('success'))
        Toast.fire({
            icon: 'success',
            title: "{{ session('success') }}"
        });
    @endif

    // Menangani trigger klik foto dan proses pengunggahan otomatis
    function prosesGantiFoto(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            // 1. Eksekusi preview lokal dan berikan efek animasi berputar smooth
            reader.onload = function(e) {
                var imgElement = document.getElementById('avatar-img');
                var placeholderElement = document.getElementById('avatar-placeholder');
                
                if (imgElement) {
                    imgElement.src = e.target.result;
                    imgElement.classList.add('animate__animated', 'animate__rotateIn');
                } else if (placeholderElement) {
                    var newImg = document.createElement('img');
                    newImg.id = 'avatar-img';
                    newImg.src = e.target.result;
                    newImg.className = 'rounded-circle border animate__animated animate__rotateIn';
                    newImg.style = 'width: 110px; height: 110px; object-fit: cover; box-shadow: 0 5px 15px rgba(0,0,0,0.1);';
                    placeholderElement.replaceWith(newImg);
                }
            }
            reader.readAsDataURL(input.files[0]);

            // 2. Tampilkan pop-up loading agar pengguna tahu sistem sedang memproses
            Swal.fire({
                title: 'Mengunggah...',
                text: 'Sedang menyimpan foto profil baru Anda.',
                confirmButtonColor: '#dc2626',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // 3. Submit form secara otomatis
            setTimeout(() => {
                document.getElementById('formProfil').submit();
            }, 800); 
        }
    }

    // Fungsi konfirmasi manual untuk perubahan data teks biasa (Tombol Simpan Perubahan)
    function konfirmasiSimpan() {
        Swal.fire({
            title: 'Simpan Perubahan?',
            text: "Apakah data profil pelanggan UNDONET sudah benar?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#dc2626',
            cancelButtonColor: '#64748b',
            confirmButtonText: 'Ya, Simpan!',
            cancelButtonText: 'Batal',
            showClass: {
                popup: 'animate__animated animate__fadeInUp animate__faster'
            },
            hideClass: {
                popup: 'animate__animated animate__fadeOutDown animate__faster'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('formProfil').submit();
            }
        })
    }
</script>
@endsection
