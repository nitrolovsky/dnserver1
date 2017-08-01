<ul class="nav nav-pills nav-stacked">
    @if (!session()->has('authed'))
        <li class="nav-item {{ Request::is('user/login') ? 'active' : '' }}">
            <a href="/user/login" class="nav-link">Войти</a>
        </li>
        <li class="nav-item {{ Request::is('user/create') ? 'active' : ''}}">
            <a href="/user/create" class="nav-link">Регистрация</a>
        </li>
    @else
        <li class="nav-item {{ Request::is('user/' . Session::get('id')) ? 'active' : '' }}">
            <a href="/user/{{ Session::get('id') }}" class="nav-link">{{ Session::get('login') }}</a>
        </li>
        <li class="nav-item {{ Request::is('user/proposals') ? 'active' : '' }}">
            <a href="{{ action('UserController@proposals') }}" class="nav-link">Мои заявки</a>
        </li>
        <li class="nav-item">
            <a href="/user/logout" class="nav-link">Выйти</a>
        </li>
    @endif
    <hr>
    @if (Session::has('id'))
        <li class="nav-item {{ Request::is('computer-equipment/create') ? 'active' : '' }}">
            <a href="{{ action('ComputerEquipmentController@index') }}" class="nav-link">Компьютерное оборудование</a>
        </li>
        <li class="nav-item">
            <a href="/proposal?status=treated&category=device_o" class="nav-link">Организационный отдел</a>
        </li>
        <li class="nav-item">
            <a href="/proposal?status=treated&category=device_k" class="nav-link">Хозтовары / Канцтовары</a>
        </li>
        <li class="nav-item">
            <a href="/proposal?status=treated&category=rashod" class="nav-link">Расходные материалы</a>
        </li>
        <li class="nav-item">
            <a href="/proposal?status=treated&category=eis" class="nav-link">Информационные системы</a>
        </li>
        <li class="nav-item">
            <a href="/proposal?status=treated&category=vcam" class="nav-link">Видеонаблюдение</a>
        </li>
        <hr>
    @endif
    <li class="nav-item {{ Request::is('tiding') ? 'active' : ''}}">
        <a href="/post" class="nav-link">Новости</a>
    </li>
    @if (Session::get('access') > -1)
        <li class="nav-item">
            <a href="/user" class="nav-link">Сотрудники</a>
        </li>
    @endif
    <li class="nav-item {{ Request::is('user/birthdays') ? 'active' : ''}}">
        <a href="/user/birthdays" class="nav-link">Календарь дней рождения</a>
    </li>
    <li class="nav-item {{ Request::is('eis') ? 'active' : ''}}">
        <a href="/eis" class="nav-link">Документация ЕИС</a>
    </li>
    <li class="nav-item {{ Request::is('medical') ? 'active' : ''}}">
        <a href="/medical" class="nav-link">Медобслуживание</a>
    </li>
    <li class="nav-item {{ Request::is('help') ? 'active' : ''}}">
        <a href="/help" class="nav-link">Помощь по сайту</a>
    </li>
</ul>
