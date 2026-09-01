<?php $__env->startSection('title', 'Kelola Testimoni - Perfu.me Admin'); ?>
<?php $__env->startSection('page-title', 'Manajemen Ulasan & Testimoni Pelanggan'); ?>

<?php $__env->startSection('content'); ?>
<!-- CUSTOM LUXURY TOAST NOTIFICATION CONTAINER -->
<div id="testi-toast-container" style="position: fixed; top: 24px; right: 24px; z-index: 9999; display: flex; flex-direction: column; gap: 0.75rem; pointer-events: none;"></div>

<div style="font-family: 'Manrope', sans-serif; display: flex; flex-direction: column; gap: 2rem;">
    
    <!-- BAGIAN ATAS: FORM TAMBAH TESTIMONI (MELEBAR & ELEGAN) -->
    <div style="background: #FFFFFF; padding: 2rem 2.5rem; border-radius: 16px; border: 1px solid #EAEAEA; box-shadow: 0 4px 20px rgba(0,0,0,0.03);">
        <div style="margin-bottom: 1.5rem; border-bottom: 1px solid #F3F4F6; padding-bottom: 1rem;">
            <h3 style="margin: 0; font-size: 1.35rem; font-weight: 700; color: #111827; font-family: 'Manrope', sans-serif;">+ Tambah Ulasan & Testimoni Baru</h3>
            <p style="margin: 0.35rem 0 0; font-size: 0.88rem; color: #6B7280; font-weight: 500;">Isi formulir di bawah ini untuk menambahkan testimoni pelanggan ke tampilan website.</p>
        </div>
        
        <form id="form-add-testimonial" style="display: flex; flex-direction: column; gap: 1.5rem;">
            <!-- Baris 1: Nama Pelanggan, Rating, Terkait Produk -->
            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1.5rem;">
                <div>
                    <label style="font-weight: 700; display: block; margin-bottom: 0.5rem; font-size: 0.85rem; color: #374151; font-family: 'Manrope', sans-serif;">Nama Pelanggan *</label>
                    <input type="text" id="name" required placeholder="Contoh: Sarah Aulia" style="width: 100%; padding: 12px 14px; border: 1px solid #D1D5DB; border-radius: 8px; font-size: 0.9rem; font-family: 'Manrope', sans-serif; box-sizing: border-box; outline: none; transition: border 0.2s;">
                </div>
                
                <div>
                    <label style="font-weight: 700; display: block; margin-bottom: 0.5rem; font-size: 0.85rem; color: #374151; font-family: 'Manrope', sans-serif;">Rating Bintang (1-5) *</label>
                    <input type="hidden" id="rating" value="5">
                    <div class="form-select-custom" id="custom-select-rating">
                        <div class="form-select-trigger">
                            <span class="trigger-label">★★★★★ (5 Bintang - Sempurna)</span>
                            <svg class="form-select-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </div>
                        <div class="form-select-options">
                            <div class="form-select-option selected" data-value="5" data-display="★★★★★ (5 Bintang - Sempurna)">
                                <span>★★★★★ (5 Bintang - Sempurna)</span><span class="opt-check">✔</span>
                            </div>
                            <div class="form-select-option" data-value="4" data-display="★★★★☆ (4 Bintang - Bagus)">
                                <span>★★★★☆ (4 Bintang - Bagus)</span><span class="opt-check">✔</span>
                            </div>
                            <div class="form-select-option" data-value="3" data-display="★★★☆☆ (3 Bintang - Cukup)">
                                <span>★★★☆☆ (3 Bintang - Cukup)</span><span class="opt-check">✔</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <label style="font-weight: 700; display: block; margin-bottom: 0.5rem; font-size: 0.85rem; color: #374151; font-family: 'Manrope', sans-serif;">Terkait Produk (Opsional)</label>
                    <input type="hidden" id="product_id" value="">
                    <div class="form-select-custom" id="custom-select-product">
                        <div class="form-select-trigger">
                            <span class="trigger-label">-- Umum / Tanpa Produk Khusus --</span>
                            <svg class="form-select-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </div>
                        <div class="form-select-options" style="max-height: 240px; overflow-y: auto;">
                            <div class="form-select-option selected" data-value="" data-display="-- Umum / Tanpa Produk Khusus --">
                                <span>-- Umum / Tanpa Produk Khusus --</span><span class="opt-check">✔</span>
                            </div>
                            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="form-select-option" data-value="<?php echo e($product->id); ?>" data-display="<?php echo e($product->name); ?>">
                                    <span><?php echo e($product->name); ?></span><span class="opt-check">✔</span>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Baris 2: Isi Ulasan Testimoni (Melebar Full Width) -->
            <div>
                <label style="font-weight: 700; display: block; margin-bottom: 0.5rem; font-size: 0.85rem; color: #374151; font-family: 'Manrope', sans-serif;">Isi Ulasan Testimoni *</label>
                <textarea id="text" rows="3" required placeholder="Tuliskan pengalaman pelanggan... contoh: Wanginya tahan lama dan sangat elegan!" style="width: 100%; padding: 12px 14px; border: 1px solid #D1D5DB; border-radius: 8px; font-size: 0.9rem; font-family: 'Manrope', sans-serif; resize: vertical; box-sizing: border-box; outline: none; transition: border 0.2s;"></textarea>
            </div>

            <!-- Baris 3: Tombol Simpan -->
            <div style="display: flex; justify-content: flex-end;">
                <button type="submit" id="btn-submit" style="padding: 12px 28px; background: #0D0D0D; color: #FFFFFF; border: none; border-radius: 8px; cursor: pointer; font-weight: 700; font-size: 0.92rem; font-family: 'Manrope', sans-serif; transition: all 0.2s; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                    Simpan Testimoni
                </button>
            </div>
        </form>
    </div>

    <!-- BAGIAN BAWAH: DAFTAR TESTIMONI DENGAN GRID MELEBAR -->
    <div style="background: #FFFFFF; padding: 2rem 2.5rem; border-radius: 16px; border: 1px solid #EAEAEA; box-shadow: 0 4px 20px rgba(0,0,0,0.03);">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.75rem;">
            <div>
                <h3 style="margin: 0; font-size: 1.35rem; font-weight: 700; color: #111827; font-family: 'Manrope', sans-serif;">Daftar Testimoni Aktif</h3>
                <p style="margin: 0.25rem 0 0; font-size: 0.85rem; color: #6B7280; font-weight: 500;">Daftar ulasan yang sedang tampil di slider halaman depan website.</p>
            </div>
            <span style="background: #F3F4F6; padding: 0.35rem 0.9rem; border-radius: 20px; font-size: 0.82rem; font-weight: 700; color: #374151; font-family: 'Manrope', sans-serif;" id="total-testi-count"><?php echo e(count($testimonials ?? [])); ?> Ulasan</span>
        </div>

        <div id="testimonials-list-container" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 1.25rem;">
            <?php /** @var \App\Models\Testimonial $testi */ ?>
            <?php $__empty_1 = true; $__currentLoopData = $testimonials ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $testi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div style="padding: 1.35rem; border: 1px solid #E5E7EB; border-radius: 12px; background: #FAFAFA; display: flex; flex-direction: column; justify-content: space-between; gap: 0.75rem; transition: border 0.2s;">
                    <div>
                        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 0.35rem;">
                            <div>
                                <strong style="font-size: 0.98rem; font-weight: 700; color: #111827; font-family: 'Manrope', sans-serif;"><?php echo e($testi->name); ?></strong>
                                <div style="color: #D97706; font-size: 0.85rem; margin-top: 0.15rem;">
                                    <?php echo str_repeat('★', $testi->rating); ?><?php echo str_repeat('☆', 5 - $testi->rating); ?>

                                </div>
                            </div>
                            <button onclick="deleteTestimonial(<?php echo e($testi->id); ?>)" style="background: #FEF2F2; border: 1px solid #FCA5A5; color: #DC2626; padding: 0.3rem 0.75rem; border-radius: 6px; cursor: pointer; font-size: 0.78rem; font-weight: 700; font-family: 'Manrope', sans-serif; transition: all 0.2s;">Hapus</button>
                        </div>
                        <p style="margin: 0.5rem 0 0 0; color: #4B5563; font-size: 0.9rem; line-height: 1.5; font-family: 'Manrope', sans-serif;">"<?php echo e($testi->text); ?>"</p>
                    </div>

                    <?php if($testi->product): ?>
                        <div style="font-size: 0.75rem; font-weight: 700; color: #6B7280; border-top: 1px border-dashed #E5E7EB; padding-top: 0.5rem; margin-top: 0.25rem;">
                            Produk: <span style="color: #111827;"><?php echo e($testi->product->name); ?></span>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div style="grid-column: 1 / -1; text-align: center; padding: 3.5rem 1rem; color: #9CA3AF; font-size: 0.92rem; font-family: 'Manrope', sans-serif;">
                    Belum ada data testimoni tersimpan di database.
                </div>
            <?php endif; ?>
        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
function showToastBanner(message, type = 'success') {
    const container = document.getElementById('testi-toast-container');
    if (!container) return;

    const toast = document.createElement('div');
    const isSuccess = type === 'success';
    
    toast.style.cssText = `
        background: ${isSuccess ? '#10B981' : '#EF4444'};
        color: #FFFFFF;
        padding: 1rem 1.4rem;
        border-radius: 10px;
        font-family: 'Manrope', sans-serif;
        font-size: 0.92rem;
        font-weight: 700;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        display: flex;
        align-items: center;
        gap: 0.65rem;
        opacity: 0;
        transform: translateY(-12px);
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        pointer-events: auto;
    `;

    const iconSvg = isSuccess 
        ? `<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>`
        : `<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>`;

    toast.innerHTML = `${iconSvg}<span>${message}</span>`;
    container.appendChild(toast);

    setTimeout(() => {
        toast.style.opacity = '1';
        toast.style.transform = 'translateY(0)';
    }, 10);

    setTimeout(() => {
        toast.style.opacity = '0';
        toast.style.transform = 'translateY(-12px)';
        setTimeout(() => toast.remove(), 300);
    }, 2800);
}
document.getElementById('form-add-testimonial').addEventListener('submit', async function(e) {
    e.preventDefault();
    const btn = document.getElementById('btn-submit');
    btn.textContent = 'Menyimpan...';
    btn.disabled = true;

    const rawProductId = document.getElementById('product_id').value;

    const payload = {
        name: document.getElementById('name').value,
        text: document.getElementById('text').value,
        rating: document.getElementById('rating').value,
        product_id: rawProductId ? rawProductId : null
    };

    const token = sessionStorage.getItem('admin_token');
    const headers = {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    };
    if (token) {
        headers['Authorization'] = `Bearer ${token}`;
    }

    try {
        const res = await fetch('/api/testimonials', {
            method: 'POST',
            headers: headers,
            body: JSON.stringify(payload)
        });

        const data = await res.json();

        if (res.ok && data.success) {
            showToastBanner('Testimoni berhasil ditambahkan!', 'success');
            setTimeout(() => {
                location.reload();
            }, 1000);
        } else {
            console.error('Validation Errors:', data.errors);
            let errorMsg = data.message || 'Gagal menyimpan testimoni.';
            if (data.errors) {
                const firstKey = Object.keys(data.errors)[0];
                if (firstKey) errorMsg += ': ' + data.errors[firstKey][0];
            }
            showToastBanner(errorMsg, 'error');
        }
    } catch (err) {
        console.error(err);
        showToastBanner('Terjadi kesalahan jaringan.', 'error');
    } finally {
        btn.textContent = 'Simpan Testimoni';
        btn.disabled = false;
    }
});

async function deleteTestimonial(id) {
    if (!confirm('Yakin ingin menghapus testimoni ini?')) return;
    try {
        const token = sessionStorage.getItem('admin_token');
        const headers = {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json'
        };
        if (token) {
            headers['Authorization'] = `Bearer ${token}`;
        }

        const res = await fetch(`/api/testimonials/${id}`, {
            method: 'DELETE',
            headers: headers
        });
        
        if (res.ok) {
            location.reload();
        } else {
            alert('Gagal menghapus data.');
        }
    } catch (e) {
        alert('Terjadi kesalahan.');
    }
}

// Initializer for Custom Select Dropdowns (Matching Admin Dashboard style)
function initCustomSelects() {
    document.querySelectorAll('.form-select-custom').forEach(customSelect => {
        const trigger = customSelect.querySelector('.form-select-trigger');
        const hiddenInput = customSelect.querySelector('input[type="hidden"]');
        const label = customSelect.querySelector('.trigger-label');
        const options = customSelect.querySelectorAll('.form-select-option');

        if (!trigger) return;

        trigger.addEventListener('click', (e) => {
            e.stopPropagation();
            document.querySelectorAll('.form-select-custom').forEach(cs => {
                if (cs !== customSelect) cs.classList.remove('open');
            });
            customSelect.classList.toggle('open');
        });

        options.forEach(option => {
            option.addEventListener('click', (e) => {
                e.stopPropagation();
                const val = option.getAttribute('data-value');
                const display = option.getAttribute('data-display') || option.textContent.trim();

                if (hiddenInput) hiddenInput.value = val;
                if (label) label.textContent = display;

                options.forEach(o => o.classList.remove('selected'));
                option.classList.add('selected');
                customSelect.classList.remove('open');
            });
        });
    });

    document.addEventListener('click', () => {
        document.querySelectorAll('.form-select-custom').forEach(cs => cs.classList.remove('open'));
    });
}

document.addEventListener('DOMContentLoaded', initCustomSelects);
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Perfu.me\resources\views/admin/testimoni.blade.php ENDPATH**/ ?>