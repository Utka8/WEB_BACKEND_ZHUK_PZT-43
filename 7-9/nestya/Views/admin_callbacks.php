<?php
// Вспомогательная функция для генерации ссылок сортировки со сменой направления (ASC / DESC)
function getSortLink($field, $currentSortBy, $currentSortDir)
{
    $nextDir = ($currentSortBy === $field && $currentSortDir === 'ASC') ? 'DESC' : 'ASC';

    // Сохраняем текущие параметры поиска и фильтрации при клике на сортировку
    $params = $_GET;
    $params['sort_by'] = $field;
    $params['sort_dir'] = $nextDir;

    return '?' . http_build_query($params);
}

// Иконка направления сортировки
function getSortIcon($field, $currentSortBy, $currentSortDir)
{
    if ($currentSortBy !== $field) return '↕';
    return $currentSortDir === 'ASC' ? '▲' : '▼';
}

$cartCount = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
?>

<header class="header scrolled" id="mainHeader">
    <div class="container header-inner">
        <a href="#" class="logo">
            <img src="icon/icon.svg" alt="SPA&CAMP" class="logo-img">
            <div class="logo-text">
                <span class="logo-name">SPA&amp;CAMP</span>
                <span class="logo-sub">Работаем круглый год</span>
            </div>
            <div class="logo-divider"></div>
            <div class="logo-desc">
                <span>Детский</span>
                <span>оздоровительный лагерь</span>
            </div>
        </a>
        <nav class="header-contacts">
            <a href="#" class="header-address">
                <img src="icon/Huge-icon.svg" alt="" class="icon"> Сочи, ул. Кольцова 17
            </a>
            <a href="tel:74957446599" class="header-phone">
                <img src="icon/telefon.svg" alt="" class="icon"> 7 (495) 744 65 99
            </a>
        </nav>
        <a href="?action=callback" class="btn btn-green header-cta">Заказать звонок</a>
    </div>
</header>

<section class="admin-section" style="padding: 120px 0 80px 0; background-color: #f9f9f9; min-height: 70vh;">
    <div class="container" style="max-width: 1300px; margin: 0 auto; background: #fff; padding: 40px; border-radius: 15px; box-shadow: 0 4px 20px rgba(0,0,0,0.05);">

        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; flex-wrap: wrap; gap: 15px;">
            <div>
                <h1 style="font-size: 2rem; color: #111; font-weight: 700; margin: 0;">Панель управления заявками</h1>
                <p style="color: #666; margin: 5px 0 0 0;">Просмотр, поиск и сортировка обратных звонков</p>
            </div>
        </div>

        <form method="GET" action="" style="background: #f1f3f5; padding: 20px; border-radius: 10px; display: flex; gap: 15px; flex-wrap: wrap; align-items: flex-end; margin-bottom: 25px;">
            <input type="hidden" name="action" value="sort">

            <div style="flex: 2; min-width: 250px; display: flex; flex-direction: column; gap: 5px;">
                <label style="font-weight: 600; color: #444; font-size: 0.9rem;">Поиск по имени или телефону:</label>
                <input type="text" name="search" value="<?= htmlspecialchars($search) ?>" placeholder="Например: Иван или +7..."
                    style="padding: 10px; border: 1px solid #ccc; border-radius: 6px; font-size: 0.95rem;">
            </div>

            <div style="flex: 1; min-width: 150px; display: flex; flex-direction: column; gap: 5px;">
                <label style="font-weight: 600; color: #444; font-size: 0.9rem;">Возраст ребенка:</label>
                <select name="age" style="padding: 10px; border: 1px solid #ccc; border-radius: 6px; font-size: 0.95rem; background: #fff;">
                    <option value="">Все возраста</option>
                    <?php for ($i = 7; $i <= 16; $i++): ?>
                        <option value="<?= $i ?>" <?= $ageFilter == $i ? 'selected' : '' ?>><?= $i ?> лет</option>
                    <?php endfor; ?>
                </select>
            </div>

            <div style="display: flex; gap: 10px;">
                <button type="submit" class="btn btn-green" style="padding: 11px 20px; font-size: 0.95rem; border: none; cursor: pointer; border-radius: 6px; font-weight: 600;">
                    Применить
                </button>
                <?php if (!empty($search) || !empty($ageFilter)): ?>
                    <a href="?action=sort" style="padding: 11px 15px; background: #e2e8f0; color: #4a5568; text-decoration: none; border-radius: 6px; font-size: 0.95rem; font-weight: 600; text-align: center;">
                        Сбросить
                    </a>
                <?php endif; ?>
            </div>
        </form>

        <div style="background: #fff; border: 2px dashed #2d3748; padding: 20px; border-radius: 10px; margin-bottom: 30px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                <h3 style="margin: 0; color: #2d3748; display: flex; align-items: center; gap: 10px;">
                    🛒 Корзина на обработку
                    <span style="background: #e53e3e; color: #fff; font-size: 0.85rem; padding: 2px 8px; border-radius: 10px;"><?= $cartCount ?> шт.</span>
                </h3>
                <?php if ($cartCount > 0): ?>
                    <a href="?action=cart-clear" style="color: #e53e3e; font-size: 0.9rem; font-weight: 600; text-decoration: none;">Очистить всё</a>
                <?php endif; ?>
            </div>

            <?php if ($cartCount === 0): ?>
                <p style="color: #718096; font-style: italic; margin: 0;">Корзина пуста. Добавьте заявки из таблицы ниже, чтобы сформировать список на обзвон.</p>
            <?php else: ?>
                <div style="display: flex; flex-wrap: wrap; gap: 10px;">
                    <?php
                    // Проходим по основной таблице и ищем те строки, ID которых отложены в сессию
                    foreach ($requests as $req) {
                        if (isset($_SESSION['cart'][$req['id']])) {
                            echo "<div style='background: #edf2f7; padding: 8px 12px; border-radius: 6px; font-size: 0.9rem; display: flex; align-items: center; gap: 10px; border: 1px solid #cbd5e0;'>";
                            echo "<strong>#" . $req['id'] . "</strong> " . htmlspecialchars($req['parent_name']);
                            echo " <a href='?action=cart-delete&id=" . $req['id'] . "' style='color: #e53e3e; text-decoration: none; font-weight: bold; margin-left: 5px;'>&times;</a>";
                            echo "</div>";
                        }
                    }
                    ?>
                </div>
            <?php endif; ?>
        </div>

        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.95rem;">
                <thead>
                    <tr style="background-color: #2d3748; color: #fff;">
                        <th style="padding: 15px; border-top-left-radius: 8px; border-bottom-left-radius: 8px;">
                            <a href="<?= getSortLink('id', $sortBy, $sortDir) ?>" style="color: #fff; text-decoration: none; font-weight: 600;">
                                ID <?= getSortIcon('id', $sortBy, $sortDir) ?>
                            </a>
                        </th>
                        <th style="padding: 15px;">
                            <a href="<?= getSortLink('parent_name', $sortBy, $sortDir) ?>" style="color: #fff; text-decoration: none; font-weight: 600;">
                                ФИО Родителя <?= getSortIcon('parent_name', $sortBy, $sortDir) ?>
                            </a>
                        </th>
                        <th style="padding: 15px;">Телефон</th>
                        <th style="padding: 15px;">
                            <a href="<?= getSortLink('child_age', $sortBy, $sortDir) ?>" style="color: #fff; text-decoration: none; font-weight: 600;">
                                Возраст ребенка <?= getSortIcon('child_age', $sortBy, $sortDir) ?>
                            </a>
                        </th>
                        <th style="padding: 15px;">Статус</th>
                        <th style="padding: 15px; border-top-right-radius: 8px; border-bottom-right-radius: 8px;">
                            <a href="<?= getSortLink('created_at', $sortBy, $sortDir) ?>" style="color: #fff; text-decoration: none; font-weight: 600;">
                                Дата заявки <?= getSortIcon('created_at', $sortBy, $sortDir) ?>
                            </a>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($requests)): ?>
                        <tr>
                            <td colspan="6" style="padding: 30px; text-align: center; color: #999; font-style: italic; border-bottom: 1px solid #edf2f7;">
                                Записи, соответствующие условиям фильтра, не найдены.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($requests as $req): ?>
                            <tr style="border-bottom: 1px solid #edf2f7; transition: background 0.2s;" onmouseover="this.style.backgroundColor='#f8fafc'" onmouseout="this.style.backgroundColor='transparent'">
                                <td style="padding: 15px; font-weight: bold; color: #718096;">#<?= $req['id'] ?></td>
                                <td style="padding: 15px; font-weight: 600; color: #1a202c;"><?= htmlspecialchars($req['parent_name']) ?></td>
                                <td style="padding: 15px; color: #4a5568;"><?= htmlspecialchars($req['phone']) ?></td>
                                <td style="padding: 15px; text-align: center;"><span style="background: #edf2f7; padding: 4px 10px; border-radius: 12px; font-size: 0.85rem; font-weight: 600;"><?= $req['child_age'] ?> лет</span></td>
                                <td style="padding: 15px;">
                                    <span style="background: #feebc8; color: #c05621; padding: 4px 8px; border-radius: 4px; font-size: 0.8rem; font-weight: bold;">
                                        <?= htmlspecialchars($req['status']) ?>
                                    </span>
                                </td>
                                <td style="padding: 15px; color: #718096; font-size: 0.85rem;"><?= date('d.m.Y H:i', strtotime($req['created_at'])) ?></td>
                                <td style="padding: 15px;">
                                    <?php
                                    // Формируем параметры для сохранения текущего фильтра, поиска и сортировки
                                    $cartParams = $_GET; // копируем текущие GET параметры (?action=sort, &search=..., &age=...)
                                    $cartParams['id'] = $req['id'];

                                    if (isset($_SESSION['cart'][$req['id']])):
                                        $cartParams['action'] = 'cart-delete'; // меняем экшен на удаление
                                        $backUrl = '?' . http_build_query($cartParams);
                                    ?>
                                        <a href="<?= $backUrl ?>" class="btn" style="background: #e53e3e; color:#fff; padding: 5px 10px; font-size: 0.8rem; text-decoration: none; border-radius: 4px;">Убрать</a>
                                    <?php else:
                                        $cartParams['action'] = 'cart-add'; // меняем экшен на добавление
                                        $backUrl = '?' . http_build_query($cartParams);
                                    ?>
                                        <a href="<?= $backUrl ?>" class="btn btn-green" style="padding: 5px 10px; font-size: 0.8rem; text-decoration: none; border-radius: 4px;">Сохранить</a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </div>
</section>