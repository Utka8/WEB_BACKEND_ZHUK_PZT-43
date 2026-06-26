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

<section class="callback-section" style="padding: 120px 0 80px 0; background-color: #f9f9f9;">
    <div class="container" style="max-width: 600px; margin: 0 auto; background: #fff; padding: 40px; border-radius: 15px; box-shadow: 0 4px 20px rgba(0,0,0,0.05);">

        <h1 style="font-size: 2rem; color: #111; margin-bottom: 10px; font-weight: 700; text-align: center;">Заказ обратного звонка</h1>
        <p style="color: #666; text-align: center; margin-bottom: 30px;">Оставьте заявку, и наш менеджер проконсультирует вас по поводу отдыха в лагере</p>

        <?php if (!empty($errors)): ?>
            <div style="background-color: #f8d7da; color: #721c24; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
                <ul style="margin: 0; padding-left: 20px;">
                    <?php foreach ($errors as $error): ?>
                        <li><?= htmlspecialchars($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div style="background-color: #d4edda; color: #155724; padding: 20px; border-radius: 8px; text-align: center; margin-bottom: 20px;">
                <h3 style="margin-top: 0;">Заявка успешно принята!</h3>
                <p style="margin-bottom: 0;">Мы свяжемся с вами в ближайшее время.</p>
                <a href="?action=index" class="btn btn-green" style="display: inline-block; margin-top: 15px; text-decoration: none;">На главную</a>
            </div>
        <?php else: ?>
            <form action="?action=callback" method="POST" style="display: flex; flex-direction: column; gap: 20px;">

                <div style="display: flex; flex-direction: column; gap: 8px;">
                    <label style="font-weight: 600; color: #333;">Ваше имя (родителя):</label>
                    <input type="text" name="parent_name" value="<?= htmlspecialchars($_POST['parent_name'] ?? '') ?>" required
                        style="padding: 12px 15px; border: 1px solid #ccc; border-radius: 8px; font-size: 1rem; width: 100%; box-sizing: border-box;">
                </div>

                <div style="display: flex; flex-direction: column; gap: 8px;">
                    <label style="font-weight: 600; color: #333;">Номер телефона:</label>
                    <input type="tel" name="phone" placeholder="+375 (__) ___-__-__" value="<?= htmlspecialchars($_POST['phone'] ?? '') ?>" required
                        style="padding: 12px 15px; border: 1px solid #ccc; border-radius: 8px; font-size: 1rem; width: 100%; box-sizing: border-box;">
                </div>

                <div style="display: flex; flex-direction: column; gap: 8px;">
                    <label style="font-weight: 600; color: #333;">Возраст ребенка (для подбора смены):</label>
                    <input type="number" name="child_age" min="7" max="16" placeholder="От 7 до 16 лет" value="<?= htmlspecialchars($_POST['child_age'] ?? '') ?>" required
                        style="padding: 12px 15px; border: 1px solid #ccc; border-radius: 8px; font-size: 1rem; width: 100%; box-sizing: border-box;">
                </div>

                <button type="submit" class="btn btn-green" style="padding: 15px; font-size: 1.1rem; border: none; cursor: pointer; border-radius: 8px; width: 100%; font-weight: bold; margin-top: 10px;">
                    Заказать звонок
                </button>
            </form>
        <?php endif; ?>

    </div>
</section>