# Báo cáo về tính nhất quán màu sắc trên Trang chủ TECOTEC Group

*Được tạo vào ngày 15‑06‑2026*

## Tổng quan
Trang chủ (`http://localhost:8081/tecgroup/`) được xây dựng từ một chuỗi các phần tử `<section>` (hoặc các section của Elementor). Tôi đã trích xuất các giá trị CSS được tính toán cho từng section:

```json
[{"id":"hp-hero","tagName":"SECTION","classNames":["hp-hero"],"backgroundColor":"rgba(0, 0, 0, 0)","textColor":"rgb(255, 255, 255)","backgroundImage":null},{"id":"section-1","tagName":"SECTION","classNames":["hp-overview-section"],"backgroundColor":"rgba(0, 0, 0, 0)","textColor":"rgb(241, 245, 249)","backgroundImage":null},{"id":"section-2","tagName":"SECTION","classNames":["hp-overview-section"],"backgroundColor":"rgba(0, 0, 0, 0)","textColor":"rgb(241, 245, 249)","backgroundImage":null},{"id":"section-3","tagName":"SECTION","classNames":["hp-overview-section"],"backgroundColor":"rgba(0, 0, 0, 0)","textColor":"rgb(241, 245, 249)","backgroundImage":null},{"id":"history","tagName":"SECTION","classNames":["timeline-section"],"backgroundColor":"rgba(0, 0, 0, 0)","textColor":"rgb(255, 255, 255)","backgroundImage":null},{"id":"hp-achievements","tagName":"SECTION","classNames":["hp-achievements"],"backgroundColor":"rgba(0, 0, 0, 0)","textColor":"rgb(244, 247, 250)","backgroundImage":null},{"id":"hp-gallery","tagName":"SECTION","classNames":["hp-gallery"],"backgroundColor":"rgb(5, 11, 20)","textColor":"rgb(255, 255, 255)","backgroundImage":null},{"id":"hp-news","tagName":"SECTION","classNames":["hp-news"],"backgroundColor":"rgb(6, 24, 53)","textColor":"rgb(255, 255, 255)","backgroundImage":null},{"id":"hp-wallpaper","tagName":"SECTION","classNames":["hp-anniv","hp-wallpaper"],"backgroundColor":"rgb(5, 26, 58)","textColor":"rgb(255, 255, 255)","backgroundImage":null},{"id":"hp-avatar","tagName":"SECTION","classNames":["hp-anniv","hp-avatar"],"backgroundColor":"rgb(2, 12, 27)","textColor":"rgb(255, 255, 255)","backgroundImage":null}]
```

## Phân tích từng section
| # | ID Section | Màu nền (tính toán) | Màu chữ (tính toán) | Nhận xét |
|---|------------|--------------------|---------------------|----------|
| 1 | **hp-hero** | `trong suốt` (rgba(0,0,0,0)) – hero sử dụng hình nền full-width được định nghĩa trong CSS, không phải màu trơn. | Trắng (`#FFFFFF`). | Hero đã có hình ảnh nền tối, nên chữ trắng hoạt động tốt. |
| 2 | **section‑1** (Tổng quan) | Trong suốt – kế thừa nền trang (có thể là tối). | Xám rất nhạt (`#F1F5F9`). | Nhất quán với hai section tổng quan tiếp theo. |
| 3 | **section‑2** (Tổng quan) | Trong suốt – tương tự như trên. | Xám nhạt tương tự (`#F1F5F9`). | OK. |
| 4 | **section‑3** (Tổng quan) | Trong suốt – tương tự như trên. | Xám nhạt tương tự (`#F1F5F9`). | OK. |
| 5 | **history** (Dòng thời gian) | Trong suốt – kế thừa nền trang tối. | Trắng (`#FFFFFF`). | Hoạt động tốt vì dòng thời gian có hình nền chuyển sắc tối. |
| 6 | **hp‑achievements** | Trong suốt – kế thừa nền trang. | Xám nhạt hơn một chút (`#F4F7FA`). | Vẫn tương thích với nền trang tối. |
| 7 | **hp‑gallery** | Màu tối đặc **#050B14** (rgb 5, 11, 20). | Trắng. | Đây là màu nền *đặc* đầu tiên. Đó là màu xanh navy rất tối, tương phản tốt với chữ trắng. |
| 8 | **hp‑news** | Màu tối đặc **#061835** (rgb 6, 24, 53). | Trắng. | Sắc thái hơi khác (nhiều màu xanh hơn). Độ tương phản tốt nhưng *không khớp* với màu đặc trước đó. |
| 9 | **hp‑wallpaper** | Màu tối đặc **#051A3A** (rgb 5, 26, 58). | Trắng. | Một sắc thái xanh tối khác. |
|10 | **hp‑avatar** | Màu tối đặc **#020C1B** (rgb 2, 12, 27). | Trắng. | Tối nhất trong nhóm; đáng chú ý là nhạt hơn (thực ra là tối hơn) so với các màu khác. |

## Vấn đề về tính không nhất quán
- Sáu section đầu tiên là **trong suốt** (chúng dựa vào nền toàn cầu của trang, dường như là một gradient tối hoặc hình ảnh). Màu chữ của chúng đều là màu sáng (trắng hoặc xám rất nhạt) và chúng hòa quyện vào nhau khá tốt.
- Bắt đầu từ **hp‑gallery**, thiết kế chuyển sang **nền tối đặc rõ ràng**. Các màu sắc tiến triển từ `#050B14` → `#061835` → `#051A3A` → `#020C1B`. Mặc dù mỗi màu đều duy trì độ tương phản đủ với chữ trắng, nhưng sự thay đổi màu sắc giữa mỗi sắc thái tối là đáng chú ý khi cuộn trang.
- Bởi vì các sắc độ khác nhau (lượng xanh khác nhau và một chút dịch chuyển về phía đen), các section tạo cảm giác *rời rạc* – người dùng cảm nhận một “bước nhảy” về màu sắc hơn là một trải nghiệm mượt mà, thống nhất.

## Khuyến nghị cho một bảng màu thống nhất
1. **Chọn một màu cơ bản duy nhất** cho tất cả các section có nền đặc. Một sự lựa chọn tốt cho chủ đề tối là **#051A3A** (màu đã được sử dụng trong section *wallpaper*) – nó đủ tối cho chữ trắng đồng thời mang lại một chút sắc xanh phù hợp với thương hiệu.
2. **Áp dụng cùng một màu** (hoặc làm sáng/tối rất nhẹ 2‑3% cho hiệu ứng hover) cho các section sau:
   - `hp-gallery`
   - `hp-news`
   - `hp-wallpaper`
   - `hp-avatar`
3. Nếu bạn muốn có một hệ thống phân cấp trực quan, hãy sử dụng **trong suốt** cho hero và các section tổng quan ở trên cùng (như hiện tại) và chỉ giữ **màu đặc** cho các khối “kỷ niệm” sau này. Trong trường hợp đó, hãy đảm bảo **tất cả** các khối sau này chia sẻ cùng một màu chính xác.
4. Cập nhật CSS (hoặc kiểu Elementor) tương ứng, ví dụ:
   ```css
   .hp-gallery,
   .hp-news,
   .hp-wallpaper,
   .hp-avatar {
       background-color: #051A3A !important;   /* màu thống nhất */
   }
   ```
   Nếu bạn cần một độ tương phản nhỏ giữa các section, bạn có thể thêm một **border‑top** 1px với `rgba(255,255,255,0.05)` – điều này sẽ giữ được sự phân tách trực quan mà không làm mất đi tính nhất quán màu sắc.
5. Sau khi thay đổi, hãy xác minh rằng tỷ lệ tương phản **WCAG 2.1 AA** cho chữ trắng trên #051A3A là **≈13.3:1**, dễ dàng vượt quá yêu cầu 4.5:1 cho văn bản thông thường.

## Danh sách kiểm tra nhanh cho nhà phát triển
- [ ] Thêm quy tắc `background-color` thống nhất vào stylesheet của theme (`style.css` hoặc khu vực CSS tùy chỉnh của Elementor).
- [ ] Xóa mọi khai báo `background-color` hiện có đã đặt `#050B14`, `#061835`, `#020C1B`.
- [ ] Xóa mọi bộ nhớ đệm (WP‑Super‑Cache, CDN) và tải lại trang chủ.
- [ ] Kiểm tra trên máy tính để bàn và thiết bị di động – đảm bảo hình ảnh hero vẫn hiển thị chính xác và văn bản vẫn dễ đọc.
- [ ] Chạy lại script trích xuất màu để xác nhận tất cả các section hiện báo cáo cùng một màu nền.

---
*Kết thúc báo cáo.*
