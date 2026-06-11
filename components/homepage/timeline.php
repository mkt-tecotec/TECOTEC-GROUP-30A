<?php
/**
 * Timeline Component
 */
if (!defined('ABSPATH')) {
    exit; // Prevent direct access
}
tecotec_enqueue_style('timeline');
tecotec_enqueue_script('timeline', ['jquery', 'gsap', 'gsap-scroll-trigger'], true, 'timeline-js');
?>
<section class="timeline-section" id="history" data-step="15">
    <div class="timeline-stage">
        <div class="timeline-stage-inner" style="width:100%; height:100%;">
            <div class="timeline-wrap-outer"></div>

            <!-- Central Dotted Circle Tunnel (using SVG assets) -->
            <div class="timeline-center-dot">
                <?php
                // Generate random floating particles for the tunnel
                $particles_html = '';
                $colors = ['#FF9900', '#ffffff', '#146EB4'];
                for ($i = 0; $i < 40; $i++) {
                    $top = rand(0, 100);
                    $left = rand(0, 100);
                    $size = rand(2, 5);
                    $opacity = rand(40, 95) / 100; // Tăng độ sáng (opacity cao hơn)
                    $color = $colors[array_rand($colors)];
                    $delay = (rand(0, 50) / 10) . 's';
                    $particles_html .= "<div class='floating-dot' style='top: {$top}%; left: {$left}%; width: {$size}px; height: {$size}px; opacity: {$opacity}; background-color: {$color}; box-shadow: 0 0 12px {$color}; animation-delay: {$delay};'></div>";
                }
                ?>
                <div class="tunnel-circle tc-1">
                    <div class="particles-layer"><?php echo $particles_html; ?></div>
                    <img class="outer-circle" src="<?php echo get_template_directory_uri(); ?>/assets/icons/circle-dots-2.svg" alt="">
                    <img class="inner-circle" src="<?php echo get_template_directory_uri(); ?>/assets/icons/circle-dots-2.svg" alt="">
                </div>
                <div class="tunnel-circle tc-2">
                    <div class="particles-layer"><?php echo $particles_html; ?></div>
                    <img class="outer-circle" src="<?php echo get_template_directory_uri(); ?>/assets/icons/circle-dots-2.svg" alt="">
                    <img class="inner-circle" src="<?php echo get_template_directory_uri(); ?>/assets/icons/circle-dots-2.svg" alt="">
                </div>
            </div>

            <div class="timeline-intro">
                <span class="eyebrow">Hành trình</span>
                <h2>30 năm <span class="accent">TECOTEC</span>.</h2>
                <p>Cuộn xuống — mỗi vòng quay của các chấm là một năm trong câu chuyện ba thập kỷ.</p>
            </div>

            <div class="timeline-wrap">
                <div class="timelinecircle-wrap">
                    <div class="timelinecircle" id="timelineCircle">
                        <div class="timelinecircle-bigdots"></div>

                        <?php
                        $history_items = [
                            ['year' => '1996', 'content' => 'Thành lập Công ty TNHH TDN — tiền thân của TECOTEC Group — khởi đầu trong lĩnh vực công nghệ thông tin.'],
                            ['year' => '1997', 'content' => 'Mở Trung tâm phát triển phần mềm tự học tin học (TDN Software Center), phát hành 5.000 bản phần mềm tự học TDN Version 2.1.'],
                            ['year' => '1998', 'content' => 'Thành lập Phòng Đo lường Điện – Điện tử (Test & Measurement) — bước chân đầu tiên vào lĩnh vực đo lường phục vụ công nghiệp điện.'],
                            ['year' => '1999', 'content' => 'Thực hiện dự án lớn đầu tiên — lắp đặt hệ thống kích thử động đầu tiên tại Việt Nam (Dynamic Jack System) cho Viện KHCN GTVT.'],
                            ['year' => '2000', 'content' => 'Chuyển đổi sang mô hình công ty cổ phần. Ký hợp đồng phân phối độc quyền thiết bị phân tích khoa học của Shimadzu (Nhật) tại Việt Nam. Thành lập Phòng Thử nghiệm & Phân tích Môi trường (ETA).'],
                            ['year' => '2001', 'content' => 'Hơn 40 doanh nghiệp Nhật Bản trở thành đối tác thường xuyên. Toyota, Honda và Yamaha chọn TECOTEC làm nhà cung cấp thiết bị đo kiểm cho phòng quản lý chất lượng.'],
                            ['year' => '2002', 'content' => 'Mở Văn phòng Đại diện tại TP. Hồ Chí Minh — phát triển thị trường phía Nam.'],
                            ['year' => '2003', 'content' => 'Trở thành nhà cung cấp thiết bị kiểm định cho Cục Đăng kiểm Việt Nam; được nhiều hãng quốc tế chọn làm đại diện độc quyền (Iyasaka, Rion – Nhật; E-Instruments – Mỹ; Microsys – Canada).'],
                            ['year' => '2004', 'content' => 'Đại học Đà Nẵng chọn TECOTEC làm nhà cung cấp thiết bị đo lường cho 4 trường thành viên. Cung cấp cho Trung tâm Kỹ thuật TĐC 3 và Hải quan Đà Nẵng.'],
                            ['year' => '2005', 'content' => 'Tham gia và trúng nhiều gói thầu quốc tế do ADB, World Bank, AFD tài trợ — cung cấp thiết bị cho 15 trường dạy nghề.'],
                            ['year' => '2006', 'content' => 'Mở rộng mạnh mẽ lĩnh vực đo lường, hiệu chuẩn môi trường và công nghiệp.'],
                            ['year' => '2007', 'content' => 'Trúng gói thầu thiết bị dạy nghề trị giá 4,2 triệu Euro (vốn Pháp), vượt qua nhiều nhà thầu châu Âu.'],
                            ['year' => '2008', 'content' => 'Mở Văn phòng Đại diện tại Đà Nẵng. Tích hợp giải pháp đo phơi nhiễm điện từ trong viễn thông cùng Rohde & Schwarz (Đức).'],
                            ['year' => '2009', 'content' => 'Thành lập Phòng Vô tuyến & Tích hợp hệ thống (RSI). Cung cấp hơn 100 bộ đo ồn/rung, ~80 hệ thống phân tích khí và hơn 50 máy đo bụi cho các cơ quan quản lý môi trường, y tế.'],
                            ['year' => '2010', 'content' => 'Tái định vị thương hiệu: ra mắt logo và slogan mới. Hoàn thành dự án radar quản lý không lưu (>4 triệu EUR) phối hợp cùng Thales.'],
                            ['year' => '2011', 'content' => 'Khánh thành trụ sở đạt chuẩn quốc tế (620 m²) tại Mễ Trì Thượng; khai trương Trung tâm thể thao TecoSport 2,1 ha tại Tây Hồ.'],
                            ['year' => '2012', 'content' => 'Đạt chứng nhận ISO 9001 (TÜV Rheinland). Trở thành nhà cung cấp giải pháp đo lường/hiệu chuẩn cho các đơn vị thuộc Bộ Quốc phòng. Mở rộng trụ sở lên 1.700 m².'],
                            ['year' => '2013', 'content' => 'Thành lập Văn phòng Đại diện tại Viêng Chăn (Lào); trúng liên tiếp 7 hợp đồng World Bank tại Lào. Bàn giao hệ thống lặn không người lái (ROV) phục vụ đơn vị quốc phòng trong nước.'],
                            ['year' => '2014', 'content' => 'Trung tâm Công nghệ Giáo dục tái cấu trúc thành Công ty Cổ phần TUMIKI — công ty chuyên trách thiết bị đào tạo nghề, tách ra từ TECOTEC Group.'],
                            ['year' => '2015', 'content' => 'Chính thức đổi tên thành CÔNG TY CỔ PHẦN TECOTEC GROUP. Phần mềm quản lý đất đai (e-Land) được UBND TP.HCM lựa chọn.'],
                            ['year' => '2016', 'content' => 'Safran (Pháp) chọn TECOTEC Group làm nhà phân phối độc quyền tại Việt Nam. Cung cấp hơn 10.000 cảm biến hồng ngoại cho đối tác công nghệ trong nước.'],
                            ['year' => '2017', 'content' => 'Tăng trưởng mạnh về doanh thu và quy mô dự án; mở Văn phòng Đại diện tại Buôn Ma Thuột.'],
                            ['year' => '2018', 'content' => 'Bắt đầu tự nghiên cứu phát triển (R&D) và sản xuất. Trúng gói thầu JICA (~140 tỷ VNĐ) cung cấp 700+ thiết bị cho Đại học Cần Thơ.'],
                            ['year' => '2019', 'content' => 'Trúng gói thầu cung cấp hệ thống thiết bị thông tin chuyên dụng phục vụ đơn vị quốc phòng.'],
                            ['year' => '2020', 'content' => 'Phát triển chuyển đổi số & thương mại điện tử; nâng cấp dịch vụ logistics trọn gói.'],
                            ['year' => '2021', 'content' => 'Tăng cường cung cấp thiết bị đo lường cho lĩnh vực quốc phòng, giáo dục và hệ thống chuẩn đo lường quốc gia; đẩy mạnh R&D công nghệ cao.'],
                            ['year' => '2022', 'content' => 'Triển khai giải pháp tích hợp AI–IoT trong thiết bị đo lường; củng cố vai trò nhà cung cấp giải pháp trọn gói cho công nghiệp nặng và an ninh – quốc phòng.'],
                            ['year' => '2023', 'content' => 'Triển khai giải pháp nền tảng kỹ thuật & mô phỏng thủy động lực cho Trung tâm dữ liệu vùng ĐBSCL (MKDC) — dự án World Bank.'],
                            ['year' => '2024', 'content' => 'Phối hợp K&H xây dựng chương trình đào tạo & phòng lab vi mạch (IC design), hướng tới R&D trong lĩnh vực vi mạch và AI.'],
                            ['year' => '2025', 'content' => 'Tham gia sâu vào lĩnh vực bán dẫn và đo lường công nghệ cao: cung cấp hệ thống phân tích phổ và đo lường tần số siêu cao tần cho trung tâm bán dẫn trong nước; tiếp tục cung cấp các hệ thống chuẩn đo lường cấp quốc gia. Mở rộng hợp tác công nghiệp – giáo dục.'],
                            ['year' => '2026', 'content' => 'Kỷ niệm 30 năm thành lập TECOTEC Group (19/7/1996 – 19/7/2026).'],
                        ];
                        foreach ($history_items as $index => $item):
                            $rotate = $index * 15;
                            $active_class = $index === 0 ? ' active' : '';
                        ?>
                            <div class="year-wrap<?php echo $active_class; ?>" data-index="<?php echo $index; ?>" style="transform: rotate(<?php echo $rotate; ?>deg);">
                                <div class="year-number"><?php echo $item['year']; ?></div>
                                <div class="year-content"><?php echo $item['content']; ?></div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="timeline-images" id="timelineImages">
                    <?php
                    $colors = [
                        ['#0a1929', '#146EB4'],
                        ['#0d4f80', '#146EB4'],
                        ['#146EB4', '#2389d6'],
                        ['#0d4f80', '#FF9900'],
                        ['#1a3a52', '#ff7700'],
                        ['#146EB4', '#FF9900'],
                        ['#0a1929', '#2389d6'],
                        ['#146EB4', '#ffb84d'],
                        ['#0d4f80', '#ff7700'],
                        ['#0a1929', '#FF9900'],
                        ['#146EB4', '#ffb84d'],
                        ['#0a1929', '#ff7700'],
                        ['#0d4f80', '#FF9900'],
                        ['#FF9900', '#ffb84d'],
                        ['#146EB4', '#0a1929'],
                    ];
                    $available_images = ['2008', '2013', '2016', '2018', '2021', '2022', '2023', '2024'];
                    foreach ($history_items as $index => $item):
                        $active_class = $index === 0 ? ' active' : '';
                        $color_count = count($colors);
                        $hue1 = $colors[$index % $color_count][0];
                        $hue2 = $colors[$index % $color_count][1];
                    ?>
                        <div class="year-image<?php echo $active_class; ?>" data-index="<?php echo $index; ?>" style="--hue1: <?php echo $hue1; ?>; --hue2: <?php echo $hue2; ?>;">
                            <?php if (in_array($item['year'], $available_images)): ?>
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/image/timeline/dòng thời gian <?php echo $item['year']; ?>.webp" alt="Timeline <?php echo $item['year']; ?>" onclick="if(window.openGlobalImagePopup) window.openGlobalImagePopup(this.src)">
                            <?php else: ?>
                                <span class="img-year"><?php echo $item['year']; ?></span>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>
