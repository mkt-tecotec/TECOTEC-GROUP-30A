(function () {
    var canvas = document.getElementById('af-canvas');
    if (!canvas) {
        return;
    }

    var ctx = canvas.getContext('2d');
    var uploadInput = document.getElementById('af-upload-input');
    var downloadButton = document.getElementById('af-download');
    var shareButton = document.getElementById('af-share');
    var status = document.getElementById('af-status');

    var frameBasePath = (window.tecotecAvatar && window.tecotecAvatar.assetsBase) || '';
    
    var framePath = frameBasePath + '/frames/Frame1.png';

    var userImage = null;
    var loadedFrame = null;

    var zoomInput = document.getElementById('af-zoom');
    var zoomVal = document.getElementById('af-zoom-val');
    var controlsDiv = document.getElementById('af-controls');
    var userScale = 1;
    var minScale = 1;
    var offsetX = 540;
    var offsetY = 540;
    var isDragging = false;
    var startX = 0, startY = 0;
    var startOffsetX = 0, startOffsetY = 0;

    function loadImage(src) {
        return new Promise(function (resolve, reject) {
            var img = new Image();
            img.crossOrigin = 'anonymous';
            img.onload = function () { resolve(img); };
            img.onerror = function () { reject(new Error('Không thể tải asset: ' + src)); };
            img.src = src;
        });
    }

    function drawBackground() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        ctx.fillStyle = '#ffffff';
        ctx.fillRect(0, 0, canvas.width, canvas.height);

        if (!userImage) {
            ctx.fillStyle = '#f4f6f8';
            ctx.beginPath();
            ctx.arc(540, 540, 540, 0, Math.PI * 2);
            ctx.fill();

            ctx.fillStyle = '#146eb4';
            ctx.font = '700 42px sans-serif';
            ctx.textAlign = 'center';
            ctx.fillText('Tải ảnh để bắt đầu', 540, 540);
        } else {
            // Vẽ nền trắng cho vùng ảnh lọt thỏm nếu có thu nhỏ
            ctx.fillStyle = '#ffffff';
            ctx.beginPath();
            ctx.arc(540, 540, 540, 0, Math.PI * 2);
            ctx.fill();
        }
    }

    function drawUserPhoto() {
        if (!userImage) {
            return;
        }

        var cx = 540;
        var cy = 540;
        var radius = 540;

        var drawW = userImage.width * userScale;
        var drawH = userImage.height * userScale;
        var drawX = offsetX - drawW / 2;
        var drawY = offsetY - drawH / 2;

        ctx.save();
        ctx.beginPath();
        ctx.arc(cx, cy, radius, 0, Math.PI * 2);
        ctx.closePath();
        ctx.clip();
        ctx.drawImage(userImage, drawX, drawY, drawW, drawH);
        ctx.restore();
    }

    function renderCanvas() {
        drawBackground();
        drawUserPhoto();

        if (loadedFrame) {
            ctx.drawImage(loadedFrame, 0, 0, canvas.width, canvas.height);
        }
    }

    function setStatus(message) {
        if (status) {
            status.textContent = message;
        }
    }

    function preloadDecorators() {
        return loadImage(framePath).then(function (img) {
            loadedFrame = img;
        }).catch(function () {
            setStatus('Không thể tải khung avatar.');
        });
    }

    function handleFile(file) {
        if (!file) {
            return;
        }

        if (!['image/jpeg', 'image/png'].includes(file.type)) {
            setStatus('Chỉ hỗ trợ JPG hoặc PNG.');
            return;
        }

        if (file.size > 5 * 1024 * 1024) {
            setStatus('Ảnh vượt quá 5MB.');
            return;
        }

        var reader = new FileReader();
        reader.onload = function (event) {
            loadImage(event.target.result).then(function (img) {
                userImage = img;
                var baseScale = Math.max(1080 / userImage.width, 1080 / userImage.height);
                minScale = baseScale * 0.2; // Cho phép thu nhỏ tối đa xuống còn 20% so với kích thước lấp đầy khung
                userScale = baseScale;
                offsetX = 540;
                offsetY = 540;
                userImage.baseScale = baseScale; // Lưu lại để dùng tính % hiển thị

                if (zoomInput) {
                    zoomInput.min = minScale;
                    zoomInput.max = baseScale * 3;
                    zoomInput.value = userScale;
                    if (zoomVal) zoomVal.textContent = Math.round((userScale / baseScale) * 100) + '%';
                }
                if (controlsDiv) {
                    controlsDiv.style.display = 'block';
                }

                setStatus('Ảnh đã sẵn sàng, bạn có thể điều chỉnh hoặc tải về.');
                renderCanvas();
            }).catch(function () {
                setStatus('Không đọc được ảnh tải lên.');
            });
        };

        reader.readAsDataURL(file);
    }

    uploadInput.addEventListener('change', function (event) {
        handleFile(event.target.files[0]);
    });

    var uploadZone = uploadInput.closest('.af-upload');
    if (uploadZone) {
        uploadZone.addEventListener('dragover', function (event) {
            event.preventDefault();
            uploadZone.classList.add('af-upload--dragging');
        });
        uploadZone.addEventListener('dragleave', function () {
            uploadZone.classList.remove('af-upload--dragging');
        });
        uploadZone.addEventListener('drop', function (event) {
            event.preventDefault();
            uploadZone.classList.remove('af-upload--dragging');
            var files = event.dataTransfer && event.dataTransfer.files;
            if (files && files.length > 0) {
                handleFile(files[0]);
            }
        });
    }

    if (zoomInput) {
        zoomInput.addEventListener('input', function() {
            userScale = parseFloat(this.value);
            var base = userImage && userImage.baseScale ? userImage.baseScale : minScale;
            if (zoomVal) zoomVal.textContent = Math.round((userScale / base) * 100) + '%';
            renderCanvas();
        });
    }

    var btnZoomOut = document.getElementById('af-zoom-out');
    var btnZoomIn = document.getElementById('af-zoom-in');
    
    if (btnZoomOut && btnZoomIn && zoomInput) {
        btnZoomOut.addEventListener('click', function() {
            var step = parseFloat(zoomInput.step) || 0.05;
            var newVal = parseFloat(zoomInput.value) - step * 5; // Tăng bước nhảy cho nút bấm để zoom nhanh hơn
            if (newVal < parseFloat(zoomInput.min)) newVal = parseFloat(zoomInput.min);
            zoomInput.value = newVal;
            userScale = newVal;
            var base = userImage && userImage.baseScale ? userImage.baseScale : minScale;
            if (zoomVal) zoomVal.textContent = Math.round((userScale / base) * 100) + '%';
            renderCanvas();
        });
        
        btnZoomIn.addEventListener('click', function() {
            var step = parseFloat(zoomInput.step) || 0.05;
            var newVal = parseFloat(zoomInput.value) + step * 5;
            if (newVal > parseFloat(zoomInput.max)) newVal = parseFloat(zoomInput.max);
            zoomInput.value = newVal;
            userScale = newVal;
            var base = userImage && userImage.baseScale ? userImage.baseScale : minScale;
            if (zoomVal) zoomVal.textContent = Math.round((userScale / base) * 100) + '%';
            renderCanvas();
        });
    }

    function getCanvasScale() {
        var rect = canvas.getBoundingClientRect();
        return 1080 / rect.width;
    }

    function handleDragStart(x, y) {
        if (!userImage) return;
        isDragging = true;
        startX = x;
        startY = y;
        startOffsetX = offsetX;
        startOffsetY = offsetY;
        canvas.style.cursor = 'grabbing';
    }

    function handleDragMove(x, y) {
        if (!isDragging) return;
        var displayScale = getCanvasScale();
        var dx = (x - startX) * displayScale;
        var dy = (y - startY) * displayScale;
        offsetX = startOffsetX + dx;
        offsetY = startOffsetY + dy;
        renderCanvas();
    }

    function handleDragEnd() {
        isDragging = false;
        if (userImage) canvas.style.cursor = 'grab';
    }

    canvas.addEventListener('mousedown', function(e) {
        handleDragStart(e.clientX, e.clientY);
    });
    window.addEventListener('mousemove', function(e) {
        handleDragMove(e.clientX, e.clientY);
    });
    window.addEventListener('mouseup', handleDragEnd);

    canvas.addEventListener('touchstart', function(e) {
        if (e.touches.length === 1) {
            handleDragStart(e.touches[0].clientX, e.touches[0].clientY);
            if (userImage && e.cancelable) e.preventDefault();
        }
    }, { passive: false });
    window.addEventListener('touchmove', function(e) {
        if (e.touches.length === 1 && isDragging) {
            handleDragMove(e.touches[0].clientX, e.touches[0].clientY);
            if (e.cancelable) e.preventDefault();
        }
    }, { passive: false });
    window.addEventListener('touchend', handleDragEnd);


    downloadButton.addEventListener('click', function () {
        canvas.toBlob(function (blob) {
            if (!blob) {
                setStatus('Không thể xuất file PNG.');
                return;
            }

            var url = URL.createObjectURL(blob);
            var a = document.createElement('a');
            a.href = url;
            a.download = 'tecotec-30-avatar.png';
            a.click();
            URL.revokeObjectURL(url);
        }, 'image/png');
    });

    shareButton.addEventListener('click', function () {
        canvas.toBlob(function (blob) {
            if (!blob) {
                setStatus('Không thể tạo file để chia sẻ.');
                return;
            }

            var file = new File([blob], 'tecotec-30-avatar.png', { type: 'image/png' });

            if (navigator.canShare && navigator.canShare({ files: [file] }) && navigator.share) {
                navigator.share({
                    title: 'Avatar 30 năm TECOTEC Group',
                    text: 'Dấu ấn 30 năm, Hành trình tiếp nối',
                    files: [file]
                }).catch(function () {
                    setStatus('Đã hủy chia sẻ. Bạn có thể dùng nút tải về.');
                });
                return;
            }

            setStatus('Thiết bị chưa hỗ trợ chia sẻ file trực tiếp. Vui lòng tải ảnh về trước.');
        }, 'image/png');
    });

    preloadDecorators().then(function () {
        renderCanvas();
    });
})();
