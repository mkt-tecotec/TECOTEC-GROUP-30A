(function () {
    var root = document.querySelector('.wl-page');
    if (!root) {
        return;
    }

    var tabs = document.querySelectorAll('.wl-tab');
    var phonePanel = document.querySelector('[data-device-preview="phone"]');
    var desktopPanel = document.querySelector('[data-device-preview="desktop"]');

    var state = {
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

    tabs.forEach(function (tab) {
        tab.addEventListener('click', function () {
            state.device = tab.getAttribute('data-device');
            render();
        });
    });

    render();
})();
