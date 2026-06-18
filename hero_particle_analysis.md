# Hero Particle: Phân tích sự khác biệt giữa JS render vs SVG tham chiếu

## 🔍 Vấn đề chính

Code JS **không vẽ giống** SVG tham chiếu. Dưới đây là phân tích chi tiết:

---

## 1. Dữ liệu JSON đã có đầy đủ thông tin

File `circle_positions.json` chứa **1,188 dots** tổng cộng:
- **84 dots cam** (cr=248, cg=153, cb=29) — tạo hình số "0" (3 vòng đồng tâm)
- **1,104 dots xanh đậm** (cr=17, cg=26, cb=67) — tạo chữ "3" bên cạnh

Mỗi dot đều có thông tin:
- `x`, `y` — vị trí
- `rr` — bán kính (từ 7.3 đến 24.8, **thay đổi theo vị trí trên vòng**)
- `cr`, `cg`, `cb` — màu RGB riêng
- `opacity` — độ trong suốt

## 2. SVG tham chiếu có gì đặc biệt?

SVG tham chiếu cho thấy **3 vòng ellipse đồng tâm** (outer, middle, inner):

| Đặc điểm | Giá trị |
|-----------|---------|
| Vòng ngoài | ~35 dots, bán kính lớn nhất (~31.88px) ở đáy, nhỏ nhất (~11.29px) ở đỉnh |
| Vòng giữa | ~25 dots, tương tự pattern |
| Vòng trong | ~24 dots, nhỏ nhất |
| **Size gradient** | Dots **to dần** khi đi từ đỉnh (12h) xuống đáy (6h), tạo hiệu ứng **perspective 3D** |

> [!IMPORTANT]
> Đây chính là điểm khác biệt quan trọng nhất: các dot có **kích thước thay đổi liên tục** dọc theo vòng, tạo cảm giác chiều sâu 3D.

## 3. Code JS hiện tại bị lỗi gì?

### ❌ Lỗi 1: Bỏ qua màu gốc trong JSON

```javascript
// hero-particle.js dòng 311-315, 347-351
if (c.cr === 255 && c.cg === 255 && c.cb === 255) {
    ctx.fillStyle = `rgba(255, 255, 255, ${c.opacity})`;  // Trắng cho text
} else {
    ctx.fillStyle = `rgba(255, 153, 0, ${c.opacity})`;    // ⚠️ TẤT CẢ còn lại = cam cứng!
}
```

**Vấn đề**: Code dùng màu cam cứng `rgb(255, 153, 0)` cho TẤT CẢ dots không phải trắng. Nhưng JSON có:
- Dots cam: `rgb(248, 153, 29)` — hình số "0"
- Dots xanh đậm: `rgb(17, 26, 67)` — hình số "3"

→ **Kết quả**: Cả số "3" lẫn số "0" đều hiện ra **màu cam**, không có sự phân biệt. Số "3" xanh đậm (gần như ẩn trên nền tối) bị biến thành cam sáng.

### ❌ Lỗi 2: Sai tỷ lệ bán kính

```javascript
// Dòng 236
originalR: (pos.rr || pos.r || avgR) * 0.9,
```

Hệ số `* 0.9` áp dụng đồng đều cho tất cả, không sai logic nhưng cần kiểm tra lại nếu dots nhìn **nhỏ hơn** so với SVG gốc.

## 4. Cách sửa

### Fix chính: Sử dụng màu RGB gốc từ JSON

```diff
// Thay đổi ở cả 2 chỗ (dòng ~311 và ~347):

- if (c.cr === 255 && c.cg === 255 && c.cb === 255) {
-     ctx.fillStyle = `rgba(255, 255, 255, ${c.opacity})`;
- } else {
-     ctx.fillStyle = `rgba(255, 153, 0, ${c.opacity})`;
- }
+ ctx.fillStyle = `rgba(${c.cr}, ${c.cg}, ${c.cb}, ${c.opacity})`;
```

Với fix này:
- Dots cam → hiện **cam** → hình số "0"
- Dots trắng (255, 255, 255) → hiện **trắng** → text "YEARS" và "1996 - 2026"

---

## ⛔ QUY TẮC MÀU SẮC — KHÔNG ĐƯỢC THAY ĐỔI

> [!CAUTION]
> Các quy tắc màu dưới đây đã được xác nhận và **KHÔNG BAO GIỜ được sửa lại**.

| Thành phần | Màu | Ghi chú |
|------------|-----|---------|
| Số **3** (1,104 dots) | `#ff9900` — `rgb(255, 153, 0)` | **KHÔNG ĐƯỢC THAY ĐỔI** — luôn là cam |
| Số **0** (84 dots, 3 vòng đồng tâm) | `#ff9900` — `rgb(255, 153, 0)` | Cam, giống số 3 |
| Text **YEARS** | `rgb(255, 255, 255)` | **Trắng** — đã đúng với code hiện tại |
| Text **1996 - 2026** | `rgb(255, 255, 255)` | **Trắng** — đã đúng với code hiện tại |

> [!IMPORTANT]
> Trong `circle_positions.json`, tất cả dots số "3" và "0" đều đã được cập nhật thành `cr:255, cg:153, cb:0`.
> Code JS (`hero-particle.js`) đọc màu trực tiếp từ JSON: `ctx.fillStyle = rgba(${c.cr}, ${c.cg}, ${c.cb}, ${c.opacity})`.
> **Không cần và không được hardcode màu trong JS.**
