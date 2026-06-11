(function () {
    var root = document.querySelector('.wl-page');
    if (!root) {
        return;
    }

    var styleInputs = document.querySelectorAll('input[name="wl-style"]');
    var colorInputs = document.querySelectorAll('input[name="wl-color"]');
    var tabs = document.querySelectorAll('.wl-tab');
    var phonePanel = document.querySelector('[data-device-preview="phone"]');
    var desktopPanel = document.querySelector('[data-device-preview="desktop"]');

    var state = {
        style: 'calm',
        color: 'blue',
        device: 'phone'
    };

    function render() {
        // Tạm thời ẩn logic update ảnh theo style/color để dùng demo ảnh thật
        // var assetsBase = (window.tecotecWallpaper && window.tecotecWallpaper.assetsBase) || '';
        // phonePreview.src = ...

        phonePanel.classList.toggle('is-active', state.device === 'phone');
        desktopPanel.classList.toggle('is-active', state.device === 'desktop');

        tabs.forEach(function (tab) {
            var isActive = tab.getAttribute('data-device') === state.device;
            tab.classList.toggle('is-active', isActive);
            tab.setAttribute('aria-selected', isActive ? 'true' : 'false');
        });
    }

    styleInputs.forEach(function (input) {
        input.addEventListener('change', function () {
            state.style = input.value;
            render();
        });
    });

    colorInputs.forEach(function (input) {
        input.addEventListener('change', function () {
            state.color = input.value;
            render();
        });
    });

    tabs.forEach(function (tab) {
        tab.addEventListener('click', function () {
            state.device = tab.getAttribute('data-device');
            render();
        });
    });

    render();
})();
