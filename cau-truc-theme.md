# Tecotec Group - Premium Custom Theme (Performance-First)

Theme được xây dựng với mục tiêu tối ưu hiệu suất (Performance-First), loại bỏ các mã nguồn dư thừa từ page builder (Zero Bloat), và áp dụng kiến trúc Component-Driven.

Đây là tài liệu hướng dẫn (Guideline) dành cho team dev để có thể dễ dàng tiếp cận, cộng tác (vibe code) và đồng bộ trên Github.

## 📋 Mục lục

1. [Cấu trúc Thư mục &amp; File](#1-cấu-trúc-thư-mục--file)
2. Giả lập data post (nếu có woocomerce thì giả lập data product để import và database)
3. [Hướng dẫn cấu hình CSS, JS và Thư viện thứ 3](#2-hướng-dẫn-cấu-hình-css-js-và-thư-viện-thứ-3)
4. [Hướng dẫn thêm Trang mới (Pages &amp; Templates)](#3-hướng-dẫn-thêm-trang-mới-pages--templates)
5. [Cấu trúc chuẩn SEO On-page](#5-cấu-trúc-chuẩn-seo-on-page)
6. [Quy tắc Vibe Code &amp; Code Style](#6-quy-tắc-vibe-code--code-style)
7. [Hướng dẫn Tối ưu Code (Performance &amp; Code Optimization)](#7-hướng-dẫn-tối-ưu-code-performance--code-optimization)

---

## 1. Cấu trúc Thư mục & File

Dưới đây là sơ đồ kiến trúc thư mục của theme và chức năng của từng thành phần:

```text
tecotec-group/
├── assets/                 # Chứa toàn bộ tài nguyên tĩnh (CSS, JS, Images, Fonts, Icon)
│   ├── css/                # Các file CSS tự viết (như custom.css)
│   └── js/                 # Các file JS tự viết (như custom.js, timeline.js)
├── components/             # Chứa các component UI dùng chung để tái sử dụng (hero, slider...)
├── archive.php             # Template hiển thị danh sách bài viết (Chuyên mục, Tag...)
├── footer.php              # Global Footer tĩnh của trang (gọi bằng get_footer())
├── front-page.php          # Template tĩnh cho Trang chủ
├── functions.php           # Nơi khai báo cấu hình theme, enqueue CSS/JS, và thêm thư viện
├── header.php              # Global Header tĩnh (chứa thẻ <head>, nav, và gọi get_header())
├── index.php               # Template mặc định (Fallback routing)
├── single.php              # Template hiển thị chi tiết 1 bài viết (Single Post)
├── taxonomy.php            # Template hiển thị danh sách bài viết của 1 Taxonomy
└── style.css               # File khai báo metadata (tên theme, version) để WP nhận dạng
```

---

## 2. Hướng dẫn cấu hình CSS, JS và Thư viện thứ 3

Mọi khai báo CSS/JS và thư viện ngoài (Third-party libraries) đều phải được thực hiện trong file `functions.php` tại hook `wp_enqueue_scripts` (trong hàm `tecotec_group_scripts()`).

### Quản lý file CSS/JS do team tự viết:

- **CSS Global & Biến (:root):** File `assets/css/main.css` (trước đây là custom.css) là nơi khai báo các biến toàn cục (như `--primary-color`, `--font-main`...) trong pseudo-class `:root`. Các file CSS component thành phần (ví dụ `assets/css/hero.css`, `assets/css/timeline.css`...) hoàn toàn có thể sử dụng lại các biến này, giúp đồng bộ màu sắc và font chữ trên toàn dự án.
- **JS Global:** Viết JS vào `assets/js/custom.js`

### Thêm thư viện bên thứ 3 (Ví dụ GSAP, Swiper, Lenis...):

Tuyệt đối **KHÔNG** nhúng trực tiếp thẻ `<script>` hay `<link>` vào `header.php` hay `footer.php`. Hãy dùng hàm `wp_enqueue_script` và `wp_enqueue_style` trong `functions.php`:

```php
// Ví dụ thêm thư viện GSAP trong functions.php
function tecotec_group_scripts() {
    // 1. Thêm CSS thư viện ngoài
    wp_enqueue_style( 'swiper-css', 'https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css', array(), null );

    // 2. Thêm GSAP Core (Tham số thứ 5 là 'true' để load script dưới footer)
    wp_enqueue_script( 'gsap', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js', array(), '3.12.2', true );
  
    // 3. Thêm GSAP ScrollTrigger (phụ thuộc vào 'gsap')
    wp_enqueue_script( 'gsap-scroll-trigger', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js', array('gsap'), '3.12.2', true );
  
    // 4. Khai báo file custom.js của team (bắt buộc tải sau 'jquery' và 'gsap')
    wp_enqueue_script( 'tecotec-custom', get_template_directory_uri() . '/assets/js/custom.js', array('jquery', 'gsap'), '1.0', true );
}
```

---

## 3. Hướng dẫn thêm Trang mới (Pages & Templates)

Trong WordPress, có 2 cách chính để bạn tạo và khai báo một giao diện trang mới. Tuỳ thuộc vào mục đích sử dụng mà team chọn 1 trong 2 cách sau:

### Cách 1: Tạo Custom Template (Khuyên dùng)

Đây là cách linh hoạt nhất. Người quản trị (Admin) có thể tạo một trang mới trong Dashboard và chủ động chọn giao diện này để áp dụng.

1. **Tạo file PHP mới** ở thư mục gốc của theme (Ví dụ: đặt tên là `template-contact.php`, prefix `template-` giúp team dễ nhận biết).
2. **Khai báo tên Template** bằng một khối comment (PHP docblock) ngay ở đầu file để WordPress nhận diện:
   ```php
   <?php
   /**
    * Template Name: Trang Liên Hệ
    */
   get_header(); ?>

   <main id="primary" class="site-main">
       <!-- Code HTML của trang liên hệ viết ở đây -->
       <h1>Liên hệ với chúng tôi</h1>
   </main>

   <?php get_footer(); ?>
   ```
3. **Cách sử dụng:** Đăng nhập vào trang quản trị WordPress (Admin Dashboard) -> Vào mục **Trang (Pages)** -> **Thêm mới (Add New)** -> Nhìn sang cột bên phải (Sidebar) tìm mục **Page Attributes (Thuộc tính trang)** -> Tại ô **Template (Giao diện)**, bấm sổ xuống và chọn **Trang Liên Hệ**.

### Cách 2: Tạo Page Template theo Slug (Đường dẫn) - [KHÔNG KHUYÊN DÙNG]

Cách này WordPress sẽ tự động map (nối) URL của trang với file PHP mà không cần Admin phải chọn tay trong menu dropdown. Tuy nhiên, **team sẽ KHÔNG tạo file theo cấu trúc `page-{slug}.php` nữa**.

Lý do: Việc fix cứng đường dẫn (slug) vào tên file sẽ làm mất đi tính linh hoạt (dynamic slug). Nếu quản trị viên muốn thay đổi đường dẫn tĩnh, giao diện trang sẽ bị lỗi. Thay vào đó, **luôn luôn sử dụng Cách 1 (Tạo Custom Template)** để quản trị viên có thể tùy ý cấu hình đường dẫn (dynamic slug) mà vẫn áp dụng đúng giao diện từ dropdown Template.

### Tái sử dụng Component (Best Practice)

Khi code file trang mới, nếu có những khối giao diện (như hero banner, form, slider) lặp lại ở nhiều trang khác, hãy bóc tách đoạn HTML đó thành một file PHP nhỏ lưu trong thư mục `/components/`.
Sau đó gọi vào trang bằng hàm:

```php
<?php get_template_part('components/folder/filename'); ?>
```

---

## 5. Cấu trúc chuẩn SEO On-page

Để đảm bảo chuẩn SEO cho trang (thẻ Title, Meta Description, Open Graph cho Facebook/Zalo), file `header.php` cần phải có cấu trúc `<head>` tối ưu.

*Nếu dự án có cài plugin SEO (như Yoast SEO, Rank Math), hàm `<?php wp_head(); ?>` sẽ tự động sinh ra mã SEO. Tuy nhiên, nếu team đang làm HTML thuần và **tự hardcode**, hãy dán đoạn code sau vào `<head>` của `header.php`:*

```php
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  
    <!-- Tiêu đề trang -->
    <title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>

    <!-- Meta Description (Tự động lấy đoạn trích ngắn của bài viết nếu đang ở trang chi tiết) -->
    <meta name="description" content="<?php echo is_single() ? wp_trim_words(get_the_excerpt(), 25) : 'TECOTEC Group - Giải pháp công nghệ đo lường và tự động hóa hàng đầu.'; ?>">
  
    <!-- Meta Robots -->
    <meta name="robots" content="index, follow">

    <!-- Open Graph (Dành cho chia sẻ Facebook/Zalo) -->
    <meta property="og:locale" content="vi_VN" />
    <meta property="og:type" content="<?php echo is_single() ? 'article' : 'website'; ?>" />
    <meta property="og:title" content="<?php echo get_the_title(); ?> - <?php bloginfo('name'); ?>" />
    <meta property="og:description" content="<?php echo is_single() ? wp_trim_words(get_the_excerpt(), 25) : 'TECOTEC Group - Giải pháp công nghệ đo lường và tự động hóa hàng đầu.'; ?>" />
    <meta property="og:url" content="<?php echo esc_url( home_url( $_SERVER['REQUEST_URI'] ) ); ?>" />
    <meta property="og:site_name" content="<?php bloginfo('name'); ?>" />
  
    <!-- Tự động lấy ảnh Featured Image của bài viết làm ảnh thu nhỏ khi chia sẻ -->
    <?php if (has_post_thumbnail()) : ?>
        <meta property="og:image" content="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>" />
    <?php else: ?>
        <!-- Ảnh mặc định khi trang không có thumbnail -->
        <meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/assets/images/default-share.jpg" />
    <?php endif; ?>

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
  
    <!-- BẮT BUỘC ĐỂ WORDPRESS HOẠT ĐỘNG (Load CSS, JS của plugin) -->
    <?php wp_head(); ?> 
</head>
```

---

## 6. Quy tắc Vibe Code & Code Style

- **Semantic HTML5:** Code HTML cần tuân thủ ngữ nghĩa (`<header>`, `<main>`, `<section>`, `<article>`, `<footer>`). Tránh dùng thẻ `<div>` vô tội vạ.
- **CSS Class Naming:** Khuyến khích đặt class theo quy tắc (ví dụ BEM: `card__title`, `card--dark`) hoặc hệ thống utility dễ hiểu.
- **Tránh Inline CSS:** Không sử dụng `style="..."` trực tiếp trong môi trường production. Tất cả style phải chuyển vào `custom.css` để dễ bảo trì.
- **Commit rõ ràng:** Khi commit lên GitHub, hãy viết mô tả rõ ràng. VD: `[Feat] Thêm trang About`, `[Fix] Lỗi responsive menu mobile`.

---

## 7. Hướng dẫn Tối ưu Code (Performance & Code Optimization)

Do đây là theme xây dựng theo tiêu chí **Performance-First** và không phụ thuộc builder (Zero Bloat), team dev cần tuân thủ các nguyên tắc sau để đảm bảo mã nguồn gọn nhẹ và tốc độ tải trang đạt mức tối đa:

### 7.1. Tối ưu Truy vấn Cơ sở dữ liệu (Database Queries)

- **Hạn chế truy vấn lồng nhau:** Không sử dụng `get_posts()` hay `new WP_Query()` nằm bên trong một vòng lặp `while` khác, điều này sẽ tạo ra độ trễ truy xuất dữ liệu cực lớn.
- **Sử dụng Cache (Transient API):** Với những truy vấn phức tạp hoặc ít thay đổi (ví dụ: danh sách bài viết phổ biến, thông tin cấu hình), hãy lưu kết quả tạm thời bằng `set_transient()` và lấy ra bằng `get_transient()`.
- **Tối ưu WP_Query:** Nếu bạn đang lấy một danh sách bài viết nhưng không hiển thị phân trang (pagination), hãy thêm tham số `'no_found_rows' => true` vào `$args`. Việc này giúp hệ thống bỏ qua truy vấn đếm tổng số dòng của MySQL, tiết kiệm đáng kể thời gian xử lý.

### 7.2. Tối ưu Tải tài nguyên (CSS / JavaScript)

- **Chỉ tải khi cần thiết (Conditional Loading):** Trước khi `wp_enqueue_script` một thư viện nặng (ví dụ: Google Maps, Form Validator), hãy sử dụng câu lệnh điều kiện như `if ( is_page('lien-he') )` để thư viện chỉ được gọi trên trang liên hệ, giúp giảm kích thước trang ở những nơi khác.
- **Tối ưu Cache (Cache Busting) với filemtime:** Thay vì khai báo version thủ công (ví dụ `'1.0.0'`) khi dùng `wp_enqueue_style` hoặc `wp_enqueue_script`, hãy sử dụng hàm `filemtime()` để lấy thời gian sửa đổi cuối cùng của file làm version. Việc này giúp trình duyệt tự động cập nhật file mới nhất mỗi khi code có thay đổi mà không cần đổi version bằng tay.
  *Ví dụ:* `wp_enqueue_style('tecotec-main', get_template_directory_uri() . '/assets/css/main.css', array(), filemtime(get_template_directory() . '/assets/css/main.css'));`
- **Ngăn chặn Render-blocking:** Trừ thư viện jQuery (nếu dùng), với tất cả các script tự viết và GSAP, hãy khai báo tham số thứ 5 là `true` trong `wp_enqueue_script` để đẩy `<script>` xuống trước thẻ đóng `</body>`. Ngoài ra, nếu có thể hãy bổ sung thuộc tính `defer` bằng filter `script_loader_tag`.
- **Sử dụng SVG thay vì PNG/JPG:** Đối với icon và các họa tiết (pattern) thiết kế giao diện, hãy ưu tiên sử dụng mã SVG nội tuyến (inline SVG) để tiết kiệm request và giữ chất lượng sắc nét ở mọi độ phân giải.

### 7.3. Tối ưu Hình ảnh (Image Optimization)

- **Sử dụng chuẩn `srcset` của WordPress:** Tránh việc chỉ lấy mỗi URL hình ảnh (`get_the_post_thumbnail_url()`). Hãy ưu tiên dùng `the_post_thumbnail()` hoặc `wp_get_attachment_image()` để hệ thống tự động sinh ra tập hợp ảnh responsive (`srcset`), trình duyệt sẽ tự tải file ảnh phù hợp nhất với thiết bị của user (Mobile/Tablet/Desktop).
- **Thêm kích thước mới thay vì dùng CSS ép lại:** Nếu bạn thiết kế một lưới hiển thị ảnh vuông `300x300`, hãy dùng `add_image_size('square-300', 300, 300, true);` trong `functions.php`. Không lấy ảnh lớn `1000px` rồi dùng CSS resize lại, điều này lãng phí băng thông nghiêm trọng.
- **Bật sẵn Lazy Load:** WordPress 5.5+ hỗ trợ sẵn Lazy Loading. Hãy đảm bảo mọi ảnh in ra đều đi kèm thuộc tính `loading="lazy"` (tự động có nếu dùng hàm chuẩn).
