<?php include ROOT.'/views/layouts/header.php';?>
    <div>
        <form id="form" method="post">
        <div class="card-body">
                <input type="text" name="title" required minlength="2" maxlength="255" id="title" class="form-control" placeholder="Hазвание" value="<?php echo $conferenceItem['title'];?>"></br>
                <div class="form-row">
                    <div class="col">
                        <input type="date" id="date" class="form-control" name="date" max="2032-12-31" value="<?php echo $conferenceItem['date'];?>">
                    </div>
                    <div class="col">
                        <input type="time" name="time" class="form-control" value="<?php echo $conferenceItem['time'];?>">
                    </div>
                    <div class="col">
                        <select class="form-control" name="country" id="select">
                             <?php
                        $countries = ["Япония", "Абхазия", "Австралия", "Австрия", "Азербайджан", "Албания", "Алжир", "Ангола", "Ангуилья", "Андорра", "Антигуа и Барбуда", "Антильские острова", "Аргентина", "Армения", "Афганистан", "Багамские острова", "Бангладеш", "Барбадос", "Бахрейн", "Беларусь", "Белиз", "Бельгия", "Бенин", "Бермуды", "Болгария", "Боливия", "Босния/Герцеговина", "Ботсвана", "Бразилия", "Британские Виргинские о-ва", "Бруней", "Буркина Фасо", "Бурунди", "Бутан", "Вануату", "Ватикан", "Великобритания", "Венгрия", "Венесуэла", "Вьетнам", "Габон", "Гаити", "Гайана", "Гамбия", "Гана", "Гваделупа", "Гватемала", "Гвинея", "Гвинея-Бисау", "Германия", "Гернси остров", "Гибралтар", "Гондурас", "Гонконг", "Государство Палестина", "Гренада", "Гренландия", "Греция", "Грузия", "ДР Конго", "Дания", "Джерси остров", "Джибути", "Доминиканская Республика", "Египет", "Замбия", "Западная Сахара", "Зимбабве", "Израиль", "Индия", "Индонезия", "Иордания", "Ирак", "Иран", "Ирландия", "Исландия", "Испания", "Италия", "Йемен", "Кабо-Верде", "Казахстан", "Камбоджа", "Камерун", "Канада", "Катар", "Кения", "Кипр", "Китай", "Колумбия", "Коста-Рика", "Кот-д'Ивуар", "Куба", "Кувейт", "Кука острова", "Кыргызстан", "Лаос", "Латвия", "Лесото", "Либерия", "Ливан", "Ливия", "Литва", "Лихтенштейн", "Люксембург", "Маврикий", "Мавритания", "Мадагаскар", "Македония", "Малайзия", "Мали", "Мальдивские острова", "Мальта", "Марокко", "Мексика", "Мозамбик", "Молдова", "Монако", "Монголия", "Мьянма (Бирма)", "Мэн о-в", "Намибия", "Непал", "Нигер", "Нигерия", "Нидерланды (Голландия)", "Никарагуа", "Новая Зеландия", "Новая Каледония", "Норвегия", "О.А.Э.", "Оман", "Пакистан", "Палау", "Панама", "Папуа Новая Гвинея", "Парагвай", "Перу", "Питкэрн остров", "Польша", "Португалия", "Пуэрто Рико", "Республика Конго", "Реюньон", "Руанда", "Румыния", "США", "Сальвадор", "Самоа", "Сан-Марино", "Сан-Томе и Принсипи", "Саудовская Аравия", "Свазиленд", "Святая Люсия", "Северная Корея", "Сейшеллы", "Сен-Пьер и Микелон", "Сенегал", "Сент Китс и Невис", "Сент-Винсент и Гренадины", "Сербия", "Сингапур", "Сирия", "Словакия", "Словения", "Соломоновы острова", "Сомали", "Судан", "Суринам", "Сьерра-Леоне", "Таджикистан", "Таиланд", "Тайвань", "Танзания", "Того", "Токелау острова", "Тонга", "Тринидад и Тобаго", "Тувалу", "Тунис", "Туркменистан", "Туркс и Кейкос", "Турция", "Уганда", "Узбекистан", "Украина", "Уоллис и Футуна острова", "Уругвай", "Фарерские острова", "Фиджи", "Филиппины", "Финляндия", "Франция", "Французская Полинезия", "Хорватия", "Чад", "Черногория", "Чехия", "Чили", "Швейцария", "Швеция", "Шри-Ланка", "Эквадор", "Экваториальная Гвинея", "Эритрея", "Эстония", "Эфиопия", "ЮАР", "Южная Корея", "Южная Осетия", "Ямайка", "Россия"];
                        $country = 0;
                        for ($a = 0; $a < count($countries); $a++) {
                            if ($countries[$a] == $conferenceItem['country']) {
                                $country = $countries[0];
                                $countries[0] = $countries[$a];
                                $countries[$a] = $country;
                                break;
                            }
                        }
                        foreach ($countries as $country) : ?>
                            <option value="<?= $country ?>"><?= $country ?></option>
                        <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <br>
                <div id="map" style="width:100%;height:400px;"></div>
                <br>
                <button type="submit" class="btn btn-outline-success">Сохранить</button>
                <a href="/conference/<?php echo $conferenceItem['id'];?>/delete"><button type="button" class="btn btn-outline-danger">Удалить</button></a>
                <a href="/conference"><button type="button" class="btn btn-outline-dark">Назад</button></a> 
            </div>
            <br>
            <input type="text" id="lat" name="address_lat" style="display:none;" value="<?php echo $conferenceItem['address_lat'];?>">
            <input type="text" id="lon" name="address_lon" style="display:none;" value="<?php echo $conferenceItem['address_lon'];?>">
        </form>
    </div>
    <script type="module" src="../../template/js/view.js"></script>
    <script type="module" src="../../template/js/validation.js"></script>
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyADFcoScfphWuAx3ClT8PdJL3w_iQ9Q5gU&callback=initMap&v=weekly"
      defer
    ></script>
    <?php include ROOT.'/views/layouts/footer.php';?>
