@extends('layouts.admin')

@section('title', 'Kelola Testimoni - Perfu.me Admin')
@section('page-title', 'Manajemen Ulasan & Testimoni Pelanggan')

@section('content')
<div style="display: grid; grid-template-columns: 380px 1fr; gap: 2rem; align-items: start;">
    
    <!-- KOLOM KIRI: FORM TAMBAH TESTIMONI -->
    <div style="background: #FFFFFF; padding: 2rem; border-radius: 12px; border: 1px solid #EAEAEA; box-shadow: 0 4px 12px rgba(0,0,0,0.02);">
        <h3 style="margin-top: 0; margin-bottom: 1.25rem; font-size: 1.25rem; color: #111; font-family: 'Cormorant Garamond', serif;">+ Tambah Testimoni Baru</h3>
        
        <form id="form-add-testimonial" style="display: flex; flex-direction: column; gap: 1rem;">
            <div>
                <label style="font-weight: 600; display: block; margin-bottom: 0.4rem; font-size: 0.85rem; color: #374151;">Nama Pelanggan *</label>
                <input type="text" id="name" required placeholder="Contoh: Sarah Aulia" style="width: 100%; padding: 10px 12px; border: 1px solid #D1D5DB; border-radius: 6px; font-size: 0.9rem;">
            </div>
            
            <div>
                <label style="font-weight: 600; display: block; margin-bottom: 0.4rem; font-size: 0.85rem; color: #374151;">Isi Ulasan Testimoni *</label>
                <textarea id="text" rows="3" required placeholder="Wanginya tahan lama dan elegan banget..." style="width: 100%; padding: 10px 12px; border: 1px solid #D1D5DB; border-radius: 6px; font-size: 0.9rem; resize: vertical;"></textarea>
            </div>
            
            <div>
                <label style="font-weight: 600; display: block; margin-bottom: 0.4rem; font-size: 0.85rem; color: #374151;">Rating Bintang (1-5) *</label>
                <select id="rating" style="width: 100%; padding: 10px 12px; border: 1px solid #D1D5DB; border-radius: 6px; font-size: 0.9rem; background: #fff;">
                    <option value="5">★★★★★ (5 Bintang - Sempurna)</option>
                    <option value="4">★★★★☆ (4 Bintang - Bagus)</option>
                    <option value="3">★★★☆☆ (3 Bintang - Cukup)</option>
                </select>
            </div>

            <div>
                <label style="font-weight: 600; display: block; margin-bottom: 0.4rem; font-size: 0.85rem; color: #374151;">Terkait Produk (Opsional)</label>
                <select id="product_id" style="width: 100%; padding: 10px 12px; border: 1px solid #D1D5DB; border-radius: 6px; font-size: 0.9rem; background: #fff;">
                    <option value="">-- Umum / Tanpa Produk Khusus --</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" id="btn-submit" style="padding: 12px; background: #0D0D0D; color: #FFFFFF; border: none; border-radius: 6px; cursor: pointer; font-weight: 600; font-size: 0.95rem; margin-top: 0.5rem; transition: background 0.2s;">
                Simpan Testimoni
            </button>
        </form>
    </div>

    <!-- KOLOM KANAN: DAFTAR TESTIMONI YANG SUDAH ADA -->
    <div style="background: #FFFFFF; padding: 2rem; border-radius: 12px; border: 1px solid #EAEAEA; box-shadow: 0 4px 12px rgba(0,0,0,0.02);">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
            <h3 style="margin: 0; font-size: 1.25rem; color: #111; font-family: 'Cormorant Garamond', serif;">Daftar Testimoni Aktif</h3>
            <span style="background: #F3F4F6; padding: 0.25rem 0.75rem; border-radius: 20px; font-size: 0.8rem; font-weight: 600; color: #4B5563;" id="total-testi-count">{{ count($testimonials ?? []) }} Ulasan</span>
        </div>

        <div id="testimonials-list-container" style="display: flex; flex-direction: column; gap: 1rem;">
            @php /** @var \App\Models\Testimonial $testi */ @endphp
            @forelse($testimonials ?? [] as $testi)
                <div style="padding: 1.25rem; border: 1px solid #E5E7EB; border-radius: 8px; background: #FAFAFA; display: flex; flex-direction: column; gap: 0.5rem;">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                        <div>
                            <strong style="font-size: 0.95rem; color: #111;">{{ $testi->name }}</strong>
                            <div style="color: #D97706; font-size: 0.85rem; margin-top: 0.1rem;">
                                {!! str_repeat('★', $testi->rating) !!}{!! str_repeat('☆', 5 - $testi->rating) !!}
                            </div>
                        </div>
                        <button onclick="deleteTestimonial({{ $testi->id }})" style="background: transparent; border: none; color: #EF4444; cursor: pointer; font-size: 0.85rem; font-weight: 600;">Hapus</button>
                    </div>
                    <p style="margin: 0.25rem 0 0 0; color: #4B5563; font-size: 0.9rem; line-height: 1.4;">"{{ $testi->text }}"</p>
                </div>
            @empty
                <div style="text-align: center; padding: 3rem 1rem; color: #9CA3AF; font-size: 0.9rem;">
                    Belum ada data testimoni tersimpan di database.
                </div>
            @endforelse
        </div>
    </div>

</div>
@endsection

@section('scripts')
<script>
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
            alert('Testimoni berhasil ditambahkan!');
            location.reload();
        } else {
            console.error('Validation Errors:', data.errors);
            let errorMsg = data.message || 'Gagal menyimpan testimoni.';
            if (data.errors) {
                const firstKey = Object.keys(data.errors)[0];
                if (firstKey) errorMsg += '\n- ' + data.errors[firstKey][0];
            }
            alert(errorMsg);
        }
    } catch (err) {
        console.error(err);
        alert('Terjadi kesalahan jaringan.');
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
</script>
@endsection