<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cơ sở dữ liệu Play Together</title>
    <style>
        :root {
            --bg-color: #f8fafc;
            --panel-bg: #ffffff;
            --border-color: #e2e8f0;
            --text-main: #0f172a;
            --text-muted: #64748b;
            --tag-bg: #f1f5f9;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        }

        body {
            background-color: var(--bg-color);
            color: var(--text-main);
            min-height: 100vh;
            padding: 16px;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 800px;
            margin: 0 auto 20px auto;
            padding: 10px 0;
            border-bottom: 1px solid var(--border-color);
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .app-icon {
            background: #111;
            color: #fff;
            padding: 8px;
            border-radius: 10px;
            font-size: 1.1rem;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropbtn {
            background: var(--tag-bg);
            color: var(--text-main);
            padding: 8px 14px;
            font-size: 0.95rem;
            font-weight: 600;
            border: 1px solid var(--border-color);
            border-radius: 20px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            left: 0;
            top: calc(100% + 8px);
            background: var(--panel-bg);
            min-width: 260px;
            border: 1px solid var(--border-color);
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            overflow: hidden;
        }

        .dropdown-content.show {
            display: block;
        }

        .dropdown-content a {
            color: var(--text-main);
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            font-size: 0.9rem;
            border-bottom: 1px solid var(--border-color);
        }

        .dropdown-content a:last-child {
            border-bottom: none;
        }

        .dropdown-content a:hover {
            background: var(--tag-bg);
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
        }

        .tab-section {
            display: none;
            animation: fadeIn 0.3s ease;
        }

        .tab-section.active {
            display: block;
        }

        .section-title {
            font-size: 1.6rem;
            font-weight: 800;
            margin-bottom: 8px;
        }

        .section-desc {
            color: var(--text-muted);
            font-size: 0.95rem;
            margin-bottom: 20px;
        }

        .search-box {
            position: relative;
            margin-bottom: 14px;
        }

        .search-box input {
            width: 100%;
            padding: 12px 16px 12px 42px;
            border-radius: 12px;
            border: 1px solid var(--border-color);
            background: var(--panel-bg);
            font-size: 0.95rem;
            outline: none;
        }

        .search-box span {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
        }

        .filter-pills {
            display: flex;
            gap: 8px;
            overflow-x: auto;
            padding-bottom: 8px;
            margin-bottom: 14px;
        }

        .pill {
            background: var(--panel-bg);
            border: 1px solid var(--border-color);
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 0.85rem;
            white-space: nowrap;
            cursor: pointer;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .pill.active {
            background: var(--text-main);
            color: #fff;
            border-color: var(--text-main);
        }

        .pill-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
        }

        .action-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
            font-size: 0.9rem;
            color: var(--text-muted);
            flex-wrap: wrap;
            gap: 10px;
        }

        .action-group {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .select-btn, .filter-btn {
            background: var(--panel-bg);
            border: 1px solid var(--border-color);
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 0.85rem;
            color: var(--text-main);
            cursor: pointer;
        }

        .cards-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .item-card {
            background: var(--panel-bg);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            padding: 16px;
            display: flex;
            gap: 16px;
            align-items: flex-start;
        }

        .item-thumb {
            width: 70px;
            height: 70px;
            background: #f3e8ff;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            flex-shrink: 0;
        }

        .item-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .item-info {
            flex-grow: 1;
        }

        .item-name {
            font-weight: 700;
            font-size: 1.05rem;
            margin-bottom: 6px;
        }

        .badge-row {
            display: flex;
            gap: 8px;
            align-items: center;
            margin-bottom: 8px;
            flex-wrap: wrap;
        }

        .badge {
            font-size: 0.75rem;
            padding: 2px 8px;
            border-radius: 6px;
            font-weight: 600;
        }

        .badge.legendary { background: #f3e8ff; color: #7e22ce; }
        .badge.event { background: #f1f5f9; color: var(--text-muted); font-weight: normal; }
        .badge.package { background: #f1f5f9; color: var(--text-muted); font-weight: normal; }

        .item-details-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 6px 12px;
            font-size: 0.85rem;
            color: var(--text-muted);
            margin-bottom: 10px;
            background: #f8fafc;
            padding: 10px;
            border-radius: 8px;
        }

        .item-details-grid span strong {
            color: var(--text-main);
        }

        .item-meta {
            display: flex;
            justify-content: space-between;
            font-size: 0.85rem;
            color: var(--text-muted);
            border-top: 1px solid var(--border-color);
            padding-top: 8px;
            flex-wrap: wrap;
            gap: 6px;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(4px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

    <header>
        <div class="header-left">
            <div class="app-icon">📦</div>
            <div class="dropdown" id="dropdownMenu">
                <button class="dropbtn" onclick="toggleDropdown()">
                    <span id="currentTitle">Cơ sở dữ liệu phương tiện</span>
                    <span>▼</span>
                </button>
                <div class="dropdown-content">
                    <a href="#" onclick="switchTab('vehicles', 'Cơ sở dữ liệu phương tiện')">🚗 Cơ sở dữ liệu phương tiện</a>
                    <a href="#" onclick="switchTab('items', 'Cơ sở dữ liệu vật phẩm')">📦 Cơ sở dữ liệu vật phẩm</a>
                    <a href="#" onclick="switchTab('packages', 'Cơ sở dữ liệu gói sản phẩm')">🎁 Cơ sở dữ liệu gói sản phẩm</a>
                    <a href="#" onclick="switchTab('gacha', 'Cơ sở dữ liệu hộp bốc thăm')">🎲 Cơ sở dữ liệu hộp bốc thăm</a>
                    <a href="#" onclick="switchTab('events', 'Cơ sở dữ liệu sự kiện')">🎉 Cơ sở dữ liệu sự kiện</a>
                    <a href="#" onclick="switchTab('vippass', 'Cơ sở dữ liệu VIP Pass')">⭐ Cơ sở dữ liệu VIP Pass</a>
                </div>
            </div>
        </div>
    </header>

    <div class="container">
        <!-- Tab 1: Phương tiện -->
        <div id="vehicles" class="tab-section active">
            <h1 class="section-title">Cơ sở dữ liệu phương tiện</h1>
            <p class="section-desc">Mọi phương tiện trong Play Together: cách nhận, số chỗ ngồi và tốc độ.</p>
            
            <div class="search-box">
                <span>🔍</span>
                <input type="text" placeholder="Tìm phương tiện">
            </div>

            <div class="filter-pills">
                <div class="pill active">Mọi độ hiếm</div>
                <div class="pill"><span class="pill-dot" style="background: #cbd5e1;"></span> Thường</div>
                <div class="pill"><span class="pill-dot" style="background: #22c55e;"></span> Cao cấp</div>
                <div class="pill"><span class="pill-dot" style="background: #0ea5e9;"></span> Hiếm</div>
            </div>

            <div class="action-row">
                <div class="action-group">
                    <span>Cách nhận</span>
                    <select class="select-btn"><option>Mọi nơi</option></select>
                </div>
                <button class="filter-btn">⚙️ Bộ lọc</button>
            </div>

            <div class="action-row">
                <span>2 trên 2</span>
                <div class="action-group">
                    <span>Sắp xếp</span>
                    <select class="select-btn"><option>Tên</option></select>
                </div>
            </div>

            <div class="cards-list">
                <!-- Xe 1: Ba Gác Máy (Từ ảnh 4) -->
                <div class="item-card">
                    <div class="item-thumb">
                        <img src="https://cdn.upanhlaylink.com/i/uCVSY96n.webp" alt="Ba Gác Máy">
                    </div>
                    <div class="item-info">
                        <div class="item-name">Ba Gác Máy</div>
                        <div class="badge-row">
                            <span class="badge legendary">Huyền thoại</span>
                            <span class="badge event">Sản phẩm sự kiện</span>
                        </div>
                        <div style="font-size: 0.85rem; color: var(--text-muted); margin-bottom: 8px;">
                            Chiếc xe ba bánh quen thuộc mang theo âm thanh rộn ràng của phố xá
                        </div>
                        <div class="badge-row" style="margin-bottom: 10px;">
                            <span class="badge" style="background: #e2e8f0; color: #334155;">👥 2 chỗ</span>
                            <span class="badge" style="background: #e2e8f0; color: #334155;">🐶 Thú cưng có thể đi cùng</span>
                            <span class="badge" style="background: #e2e8f0; color: #334155;">👶 Em bé có thể đi cùng</span>
                        </div>
                        <div class="item-details-grid">
                            <span>Cách nhận: <strong>Sản phẩm sự kiện</strong></span>
                            <span>Độ hiếm: <strong>Huyền thoại</strong></span>
                            <span>Tốc độ: <strong>5</strong></span>
                            <span>Tăng cường: <strong>8</strong></span>
                            <span>Độ gia tốc: <strong>3.0</strong></span>
                            <span>Nơi di chuyển: <strong>Mặt đất</strong></span>
                        </div>
                    </div>
                </div>

                <!-- Xe 2: Rắn Lục Hồng (Từ ảnh 2) -->
                <div class="item-card">
                    <div class="item-thumb">
                        <img src="https://cdn.upanhlaylink.com/i/NnZOSpcj.webp" alt="Rắn Lục Hồng">
                    </div>
                    <div class="item-info">
                        <div class="item-name">Rắn Lục Hồng</div>
                        <div class="badge-row">
                            <span class="badge legendary">Truyền thuyết</span>
                            <span class="badge package">Gói sản phẩm</span>
                        </div>
                        <div class="badge-row" style="margin-bottom: 10px;">
                            <span class="badge" style="background: #e2e8f0; color: #334155;">👥 2 chỗ</span>
                        </div>
                        <div class="item-details-grid">
                            <span>Cách nhận: <strong>Gói sản phẩm</strong></span>
                            <span>Độ hiếm: <strong>Truyền thuyết</strong></span>
                            <span>Tốc độ: <strong>8</strong></span>
                            <span>Tăng cường: <strong>12</strong></span>
                            <span>Độ gia tốc: <strong>4.0</strong></span>
                            <span>Nơi di chuyển: <strong>Mặt đất</strong></span>
                        </div>
                        <div class="item-meta">
                            <span>Gói sản phẩm: Rắn lục hồng</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tab 2: Vật phẩm -->
        <div id="items" class="tab-section">
            <h1 class="section-title">Cơ sở dữ liệu vật phẩm</h1>
            <p class="section-desc">Tổng hợp trang phục, nội thất và các vật phẩm tương tác trong game.</p>
            <div class="cards-list">
                <div class="item-card">
                    <div class="item-info" style="text-align: center; color: var(--text-muted); padding: 20px;">
                        Đang cập nhật danh sách vật phẩm...
                    </div>
                </div>
            </div>
        </div>

        <!-- Tab 3: Gói sản phẩm -->
        <div id="packages" class="tab-section">
            <h1 class="section-title">Cơ sở dữ liệu gói sản phẩm</h1>
            <p class="section-desc">Thông tin chi tiết các gói nạp và ưu đãi giới hạn.</p>
            <div class="cards-list">
                <div class="item-card">
                    <div class="item-info" style="text-align: center; color: var(--text-muted); padding: 20px;">
                        Đang cập nhật danh sách gói sản phẩm...
                    </div>
                </div>
            </div>
        </div>

        <!-- Tab 4: Hộp bốc thăm -->
        <div id="gacha" class="tab-section">
            <h1 class="section-title">Cơ sở dữ liệu hộp bốc thăm</h1>
            <p class="section-desc">Danh sách và tỷ lệ phần thưởng từ hộp bốc thăm, trứng.</p>
            <div class="cards-list">
                <div class="item-card">
                    <div class="item-info" style="text-align: center; color: var(--text-muted); padding: 20px;">
                        Đang cập nhật danh sách hộp bốc thăm...
                    </div>
                </div>
            </div>
        </div>

        <!-- Tab 5: Sự kiện -->
        <div id="events" class="tab-section">
            <h1 class="section-title">Cơ sở dữ liệu sự kiện</h1>
            <p class="section-desc">Nhiệm vụ và phần thưởng từ các bản cập nhật sự kiện.</p>
            <div class="cards-list">
                <div class="item-card">
                    <div class="item-info" style="text-align: center; color: var(--text-muted); padding: 20px;">
                        Đang cập nhật danh sách sự kiện...
                    </div>
                </div>
            </div>
        </div>

        <!-- Tab 6: VIP Pass -->
        <div id="vippass" class="tab-section">
            <h1 class="section-title">Cơ sở dữ liệu VIP Pass</h1>
            <p class="section-desc">Phần thưởng độc quyền theo từng cấp độ VIP Pass.</p>
            <div class="cards-list">
                <div class="item-card">
                    <div class="item-info" style="text-align: center; color: var(--text-muted); padding: 20px;">
                        Đang cập nhật danh sách VIP Pass...
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleDropdown() {
            const dropdown = document.getElementById('dropdownMenu');
            dropdown.querySelector('.dropdown-content').classList.toggle('show');
        }

        window.onclick = function(event) {
            if (!event.target.closest('.dropdown')) {
                const dropdowns = document.getElementsByClassName('dropdown-content');
                for (let i = 0; i < dropdowns.length; i++) {
                    let openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }

        function switchTab(tabId, titleText) {
            const sections = document.querySelectorAll('.tab-section');
            sections.forEach(sec => sec.classList.remove('active'));

            const target = document.getElementById(tabId);
            if (target) {
                target.classList.add('active');
            }

            document.getElementById('currentTitle').innerText = titleText;

            const dropdown = document.getElementById('dropdownMenu');
            dropdown.querySelector('.dropdown-content').classList.remove('show');

            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    </script>
</body>
</html>
