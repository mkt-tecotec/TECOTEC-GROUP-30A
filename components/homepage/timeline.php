<?php
/**
 * Timeline Component
 */
tecotec_enqueue_style('timeline');
tecotec_enqueue_script('timeline', ['jquery', 'gsap', 'gsap-scroll-trigger'], true, 'timeline-js');
?>
<section class="timeline-section" id="history" data-step="15">
    <div class="timeline-stage">
        <div class="timeline-stage-inner" style="width:100%; height:100%;">
            <div class="timeline-wrap-outer"></div>

            <!-- Central Dotted Circle SVG -->
            <div class="timeline-center-dot">
                <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                    <!-- Outer dotted circle -->
                    <circle cx="100" cy="100" r="98" fill="none" stroke="rgba(255, 255, 255, 0.15)" stroke-width="1" stroke-dasharray="4 6" />
                    <!-- Inner decorative circle -->
                    <circle cx="100" cy="100" r="60" fill="none" stroke="rgba(255, 153, 0, 0.2)" stroke-width="1" stroke-dasharray="2 4" />
                    <!-- Center dot -->
                    <circle cx="100" cy="100" r="4" fill="#FF9900" opacity="0.8"/>
                </svg>
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
                            ['year' => '1996', 'content' => 'Thành lập Công ty TNHH TDN – tiền thân của TECOTEC Group – vào tháng 9/1996, ban đầu định hướng vào lĩnh vực công nghệ thông tin'],
                            ['year' => '1997', 'content' => 'Mở trung tâm phát triển phần mềm tự học tin học (TDN Software Center), phát hành 5.000 bản sản phẩm tự học TDN Version 2.1 ra thị trường'],
                            ['year' => '1998', 'content' => 'Thành lập Phòng Đo lường Điện – Điện tử (Test & Measurement), đánh dấu bước chân đầu tiên vào lĩnh vực công nghệ đo lường phục vụ công nghiệp điện'],
                            ['year' => '1999', 'content' => 'Thực hiện dự án lớn đầu tiên – lắp đặt hệ thống kích thử động đầu tiên tại Việt Nam (Dynamic Jack System) cho Viện KHCN GTVT (IBST)'],
                            ['year' => '2000', 'content' => 'Chuyển đổi sang mô hình công ty cổ phần. Ký kết với Shimadzu (Nhật) hợp đồng độc quyền phân phối thiết bị phân tích khoa học tại Việt Nam. Thành lập Phòng Thử nghiệm & Phân tích Môi trường (ETA)'],
                            ['year' => '2001', 'content' => 'Hơn 40 công ty Nhật Bản trở thành khách hàng thường xuyên. Toyota, Honda và Yamaha chính thức chọn TECOTEC làm nhà cung cấp thiết bị đo kiểm cho phòng quản lý chất lượng'],
                            ['year' => '2002', 'content' => 'Mở văn phòng đại diện tại TP. Hồ Chí Minh — bắt đầu phát triển thị trường phía Nam'],
                            ['year' => '2003', 'content' => 'Trở thành nhà cung cấp thiết bị kiểm định cho Cục Đăng kiểm Việt Nam. Được nhiều hãng quốc tế chọn làm đại diện độc quyền: Iyasaka'],
                            ['year' => '2004', 'content' => 'Đại học Đà Nẵng chọn TECOTEC làm nhà cung cấp thiết bị đo lường cho 4 trường thành viên. Cung cấp cho Trung tâm TĐC Chất lượng 3 và Hải quan Đà Nẵng'],
                            ['year' => '2005', 'content' => 'Tham gia và thắng thầu loạt dự án quốc tế do ADB, World Bank, AFD tài trợ. Liên tục trúng 3 gói thầu ADB cung cấp thiết bị cho 15 trường dạy nghề'],
                            ['year' => '2006', 'content' => 'Mở rộng mạnh mẽ lĩnh vực đo lường, hiệu chuẩn môi trường và công nghiệp'],
                            ['year' => '2007', 'content' => 'Thắng gói thầu thiết bị dạy nghề trị giá 4,2 triệu Euro (vốn Pháp) trước các đối thủ từ Pháp, Ý, Đức'],
                            ['year' => '2008', 'content' => 'Mở Văn phòng Đại diện tại Đà Nẵng. Tích hợp giải pháp đo phơi nhiễm điện từ trong viễn thông cùng Rohde & Schwarz (Đức)'],
                            ['year' => '2009', 'content' => 'Thành lập phòng Vô tuyến & Tích hợp hệ thống (RSI). Bán hơn 100 bộ đo ồn/rung, ~80 hệ thống phân tích khí, hơn 50 máy đo bụi cho Bộ TN-MT, Bộ Y tế, Cục CSMT'],
                            ['year' => '2010', 'content' => 'Tái định vị thương hiệu: ra mắt logo mới, slogan mới. Hoàn thành dự án radar quản lý không lưu hơn 4 triệu EUR phối hợp cùng Thales'],
                            ['year' => '2011', 'content' => 'Khánh thành trụ sở tiêu chuẩn quốc tế (620 m²) tại Mễ Trì Thượng. Khai trương Trung tâm thể thao TecoSport 2,1 ha tại Tây Hồ'],
                            ['year' => '2012', 'content' => 'Đạt ISO 9001:2008 (TUV Rheinland). Được công nhận là nhà thầu uy tín nhất cung cấp giải pháp đo lường/hiệu chuẩn cho Bộ Quốc phòng. Mở rộng trụ sở lên 1.700 m²'],
                            ['year' => '2013', 'content' => 'Thành lập Văn phòng Đại diện tại Viêng Chăn, Lào. Thắng liên tục 7 hợp đồng World Bank tại Lào tổng giá trị >5 triệu USD. Bàn giao robot lặn ROV 300m đầu tiên cho Hải quân VN'],
                            ['year' => '2014', 'content' => 'Trung tâm Công nghệ Giáo dục tái cấu trúc thành Công ty Cổ phần TUMIKI — công ty chuyên trách thiết bị đào tạo nghề tách ra từ TECOTEC Group'],
                            ['year' => '2015', 'content' => 'Chính thức đổi tên thành CÔNG TY CỔ PHẦN TECOTEC GROUP. Phần mềm quản lý đất đai (e-Land) được UBND TP.HCM lựa chọn'],
                            ['year' => '2016', 'content' => 'Safran (Pháp) ký hợp đồng chọn TECOTEC Group làm nhà phân phối độc quyền tại Việt Nam. Cung cấp hơn 10.000 cảm biến hồng ngoại cho Viettel'],
                            ['year' => '2017', 'content' => 'Đạt doanh thu 1.400 tỷ VNĐ (~70 triệu USD), tăng trưởng >30%/năm. Mở Văn phòng Đại diện tại Buôn Ma Thuột'],
                            ['year' => '2018', 'content' => 'Bắt đầu tự R&D và sản xuất. Thắng gói thầu JICA ~140 tỷ VNĐ cung cấp 700+ thiết bị cho Đại học Cần Thơ'],
                            ['year' => '2019', 'content' => 'Thắng gói thầu hệ thống máy thông tin quân sự Elbit (Israel) cho Hải quân, >15 triệu USD'],
                            ['year' => '2020', 'content' => 'Phát triển chuyển đổi số & thương mại điện tử. Nâng cấp dịch vụ logistics trọn gói'],
                            ['year' => '2021', 'content' => 'Tăng cường cung cấp thiết bị đo lường cho quốc phòng, giáo dục và tiêu chuẩn đo lường quốc gia. Mở rộng R&D công nghệ cao với Bộ Quốc phòng'],
                            ['year' => '2022', 'content' => 'Triển khai giải pháp tích hợp AI–IoT trong thiết bị đo lường. Củng cố vai trò nhà cung cấp giải pháp trọn gói công nghiệp nặng, an ninh–quốc phòng'],
                            ['year' => '2023', 'content' => 'Triển khai giải pháp nền tảng kỹ thuật & mô phỏng thủy động lực cho Trung Tâm dữ liệu vùng ĐBSCL (MKDC) — dự án World Bank'],
                            ['year' => '2024', 'content' => 'Phối hợp K&H xây dựng chương trình đào tạo & phòng lab vi mạch (IC design), hướng tới R&D trong lĩnh vực vi mạch và AI'],
                            ['year' => '2026', 'content' => 'Kỷ niệm 30 năm thành lập TECOTEC Group (19/7/1996 – 19/7/2026)'],
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
                    foreach ($history_items as $index => $item):
                        $active_class = $index === 0 ? ' active' : '';
                        $color_count = count($colors);
                        $hue1 = $colors[$index % $color_count][0];
                        $hue2 = $colors[$index % $color_count][1];
                    ?>
                        <div class="year-image<?php echo $active_class; ?>" data-index="<?php echo $index; ?>" style="--hue1: <?php echo $hue1; ?>; --hue2: <?php echo $hue2; ?>;">
                            <span class="img-year"><?php echo $item['year']; ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>
