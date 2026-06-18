# CLAUDE.md — Quy tắc bắt buộc cho dự án TECOTEC GROUP A30

Mọi thao tác trên repo này PHẢI tuân thủ tuyệt đối các quy tắc dưới đây. Không có ngoại lệ.

---

## 1. Git Workflow

### Cấu trúc nhánh (3 nhánh cố định)

- `main`: Production. Đã bật Branch Protection — KHÔNG ĐƯỢC push trực tiếp.
- `dev-nghiep` / `nghiep2k3`: Nhánh cá nhân của Nghiep.
- `dev-tuyen`: Nhánh cá nhân của Tuyen.

### Quy trình bắt buộc

1. **Trước khi code:** Đồng bộ từ main về nhánh cá nhân.
   ```
   git checkout main && git pull origin main
   git checkout <nhanh-ca-nhan>
   git merge main
   ```
2. **Commit:** Mô tả rõ ràng, dùng prefix: `[Feat]`, `[Fix]`, `[Refactor]`, `[Style]`, `[Docs]`.
3. **Đưa code vào main:** BẮT BUỘC qua Pull Request. Phải có ít nhất 1 Approve từ người khác.
4. **Sau khi merge PR:** Về máy chạy `git checkout main && git pull origin main`.

### Tuyệt đối cấm

- Push trực tiếp lên `main`.
- Merge PR khi chưa có Approve.
- Quên pull main sau khi PR được merge.
- Sửa cùng 1 file với người khác cùng lúc — phải báo trước khi đụng file dùng chung (`functions.php`, `custom.css`, `header.php`, `footer.php`).

---

## 2. Kiến trúc Theme (Performance-First, Zero-Bloat)

### Cấu trúc thư mục

```
tecotec-group/
├── assets/css/custom.css      # CSS tự viết — TẤT CẢ style phải vào đây
├── assets/js/custom.js        # JS tự viết
├── components/                # Component UI tái sử dụng (hero, slider, card...)
├── inc/
│   ├── CPT/                   # Modular CPT registrations & ACF JSON
│   └── package.php            # Backend logic
├── functions.php              # Enqueue CSS/JS, cấu hình theme
├── header.php                 # Global header (get_header())
├── footer.php                 # Global footer (get_footer())
├── front-page.php             # Trang chủ
├── single.php                 # Chi tiết bài viết
├── archive.php                # Danh sách bài viết
├── style.css                  # Metadata theme (KHÔNG viết CSS ở đây)
```

### Quy tắc CSS/JS

- MỌI CSS/JS và thư viện ngoài PHẢI enqueue qua `functions.php` trong hook `wp_enqueue_scripts`.
- CẤM nhúng `<script>` hoặc `<link>` trực tiếp vào `header.php` / `footer.php`.
- CẤM dùng `style="..."` inline trong code production. Tất cả style phải vào `assets/css/main.css`.
- Script tự viết và thư viện (trừ jQuery): tham số thứ 5 = `true` để load ở footer.
- Chỉ enqueue thư viện nặng khi cần (`if (is_page('slug'))` — conditional loading).

### Component

- Tách HTML lặp lại (hero, card, slider...) thành file PHP trong `components/`.
- Gọi bằng: `<?php get_template_part('components/folder/filename'); ?>`

### Tạo trang mới

- **Cách 1 (khuyên dùng):** Custom Template — file `template-ten-trang.php` với docblock `Template Name:` ở đầu.
- **Cách 2:** Theo slug — file `page-{slug}.php`, không cần docblock.

### Tối ưu hiệu suất

- Không `get_posts()` / `new WP_Query()` lồng trong vòng lặp.
- Dùng `'no_found_rows' => true` khi không cần pagination.
- Dùng `set_transient()` / `get_transient()` cho query phức tạp ít thay đổi.
- Dùng `the_post_thumbnail()` hoặc `wp_get_attachment_image()` để có `srcset` responsive — không lấy ảnh lớn rồi CSS resize.
- Dùng `add_image_size()` cho kích thước custom.
- Ưu tiên inline SVG cho icon thay vì PNG/JPG.

---

## 3. Design System

### Bảng màu (BẮT BUỘC dùng đúng)

| Token            | Hex                       | Dùng cho                                |
| ---------------- | ------------------------- | ---------------------------------------- |
| Canvas Off-White | `#F4F6F8`               | Background chính                        |
| Pure Surface     | `#FFFFFF`               | Card, container                          |
| Deep Blue        | `#146EB4`               | Header, link, text phụ                  |
| Charcoal Ink     | `#18181B`               | Body text chính                         |
| Muted Steel      | `#71717A`               | Metadata, mô tả phụ                   |
| Whisper Border   | `rgba(226,232,240,0.5)` | Border card, đường kẻ                |
| Highlight Orange | `#FF9900`               | CTA chính, accent, headline quan trọng |

### Typography (BẮT BUỘC)

- Display + Body: **Geist** (track-tight, weight-driven hierarchy).
- Mono (số liệu, specs, code): **Geist Mono**.
- CẤM dùng: Inter, Arial, Times New Roman, serif font.

### Component styling

- Button: Flat, không outer glow. Active state: `-1px translateY`. Primary = Highlight Orange fill. Secondary = ghost/outline Deep Blue.
- Card: Rounded `0.25rem–0.5rem`. Diffused shadow. KHÔNG dùng 3-column equal card layout.
- Loader: Skeletal shimmer đúng kích thước layout. KHÔNG dùng spinner tròn.
- Empty state: Illustration chuyên nghiệp hoặc hướng dẫn populate data — không chỉ "No data".

### Layout

- Grid-first responsive (CSS Grid, KHÔNG dùng flexbox percentage math).
- Max-width containment ~1400px centered.
- Single-column collapse dưới 768px.
- Mỗi element có spatial zone riêng — KHÔNG overlap text/image.

### Motion

- Spring physics: stiffness 100, damping 20.
- Chỉ dùng `opacity` và `transform` (hardware-accelerated).
- KHÔNG dùng bouncy/excessive animation.

### CẤM tuyệt đối trong design

- Emoji.
- Pure black `#000000`.
- Neon glow, oversaturated gradient.
- 3-column equal card layout (dùng asymmetric, 2-column zig-zag, hoặc list).
- AI-cliché: "Elevate", "Seamless", "Next-Gen", "Revolutionary".
- Superlative không có bằng chứng: "số 1", "tốt nhất".
- Số liệu bịa, placeholder number.
- "Lorem Ipsum", tên giả ("John Doe", "Acme").

---

## 4. HTML & Code Style

- Semantic HTML5: `<header>`, `<main>`, `<section>`, `<article>`, `<footer>`. Hạn chế `<div>` vô nghĩa.
- CSS class naming: BEM (`card__title`, `card--dark`) hoặc utility rõ ràng.
- SEO: `<head>` phải có title, meta description, Open Graph, Twitter Card (xem `cau-truc-theme.md` mục 5).
- Hình ảnh: luôn có `loading="lazy"`, dùng hàm chuẩn WP để tự sinh.

---

## 5. Kiến trúc Module cho Custom Post Type (CPT) & ACF

### Cấu trúc thư mục chuẩn
Mỗi CPT phải được đóng gói thành một module độc lập trong thư mục `inc/CPT/{cpt_name}/` theo cấu trúc:
```
inc/CPT/{cpt_name}/
├── acf-json/               # Lưu file JSON cấu hình ACF Field Groups
└── register/               # Chứa logic đăng ký CPT và Taxonomy
    └── register.php        # File khai báo code register_post_type & register_taxonomy
```

### Đăng ký CPT
- **KHÔNG ĐƯỢC** khai báo hàm `register_post_type` hay `register_taxonomy` trực tiếp bên trong `functions.php`.
- Viết code đăng ký vào file `inc/CPT/{cpt_name}/register/register.php` và hook vào `init`.
- Trong `functions.php`, chỉ gọi file bằng 1 dòng duy nhất: 
  `require_once get_template_directory() . '/inc/CPT/{cpt_name}/register/register.php';`
- Slug CPT dùng tiếng Việt không dấu, viết thường, cách nhau bằng dấu gạch dưới (VD: `tin_tuc`). Rewrite slug dùng dấu gạch ngang (VD: `'rewrite' => array('slug' => 'tin-tuc')`).
- Nếu CPT cần phân loại, tạo Custom Taxonomy riêng biệt (VD: `danh_muc_tin_tuc`), KHÔNG dùng chung categories mặc định của bài viết blog.

### ACF Fields
- File cấu hình nhóm trường ACF **BẮT BUỘC** lưu dạng JSON trong thư mục `inc/CPT/{cpt_name}/acf-json/` của module tương ứng.
- **KHÔNG** đăng ký bằng code PHP (`acf_add_local_field_group()`).
- Bắt buộc cập nhật filter trong `functions.php` để ACF tự động nhận diện (load) và lưu (save) vào đúng thư mục của module:
  ```php
  add_filter('acf/settings/load_json', function ($paths) {
      $paths[] = get_template_directory() . '/inc/CPT/{cpt_name}/acf-json';
      return $paths;
  });
  add_filter('acf/settings/save_json', function ($path) {
      return get_template_directory() . '/inc/CPT/{cpt_name}/acf-json';
  });
  ```
- Khi lấy giá trị ACF ngoài frontend dùng `get_field('field_name', $post_id)` — KHÔNG dùng `get_post_meta()`.
