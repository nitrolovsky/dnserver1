<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Информационный портал Службы государственного строительного надзора и экспертизы Санкт-Петербурга</title>
                <link href='https://fonts.googleapis.com/css?family=Exo+2:400,300,900&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="/vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="/vendor/twbs/bootstrap/dist/css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="/vendor/components/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="/custom.css">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css" />
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
        <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
    </head>
    <body class="body">
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav">
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <span class="fa fa-fw fa-bars"></span>&nbsp;Меню
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li class="{{ Request::is('tiding*') ? 'active' : ''}}">
                                          <a href="/tiding"><span class="fa fa-fw fa-newspaper-o"></span>&nbsp;Новости</a>
                                        </li>
                                        @if (Session::has('id'))
                                          <li class="{{ Request::is('proposal*') ? 'active' : ''}}">
                                              <a href="/proposal"><span class="fa fa-fw fa-folder-open"></span>&nbsp;Заявки</a>
                                          </li>
                                        @endif
                                        @if (!Session::has('access'))
                                          <li class="{{ Request::is('user/login') ? 'active' : '' }}">
                                              <a href="/user/login"><span class="fa fa-fw fa-sign-in"></span>&nbsp;Войти</a>
                                          </li>
                                        @endif
                                        @if (!Session::has('access'))
                                          <li class="{{ Request::is('user/create') ? 'active' : '' }}">
                                              <a href="/user/create"><span class="fa fa-fw fa-user-plus"></span>&nbsp;Регистрация</a>
                                          </li>
                                        @endif
                                        @if (Session::get('access') > -1)
                                          <?php $id = Session::get('id'); ?>
                                          <li class="{{ Request::is("user/$id", "user/$id/edit") ? 'active' : ''}}">
                                              <a href="/user/{{ Session::get('id') }}"><span class="fa fa-fw fa-user"></span>&nbsp;Профиль</a>
                                          </li>
                                        @endif
                                        @if (Session::get('access') > -1)
                                          <li class="{{ Request::is('user', 'user-search') ? 'active' : '' }}">
                                              <a href="/user"><span class="fa fa-fw fa-users"></span>&nbsp;Сотрудники</a>
                                          </li>
                                        @endif
                                        @if (Session::get('access') > -1)
                                          <li class="{{ Request::is('user/logout') ? 'active' : '' }}">
                                              <a href="/user/logout"><span class="fa fa-fw fa-sign-out"></span>&nbsp;Выйти</a>
                                          </li>
                                        @endif
                                        <li class="{{ Request::is('user/birthdays') ? 'active' : ''}}">
                                          <a href="/user/birthdays"><span class="fa fa-fw fa-birthday-cake"></span>&nbsp;Календарь дней рождения</a>
                                        </li>
                                        <li class="{{ Request::is('eis') ? 'active' : '' }}">
                                          <a href="/eis"><span class="fa fa-fw fa-book"></span>&nbsp;Документация ЕИС</a>
                                        </li>
                                        <li class="{{ Request::is('medical') ? 'active' : '' }}">
                                          <a href="/medical"><span class="fa fa-fw fa-medkit"></span>&nbsp;Медобслуживание</a>
                                        </li>
                                        <li class="{{ Request::is('help') ? 'active' : '' }}">
                                          <a href="/help"><span class="fa fa-fw fa-question"></span>&nbsp;Помощь с сайтом</a>
                                        </li>
                                        <li>
                                            <a href="/10-pravil-storitelinga">10 правил сторителлинга</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <span class="fa fa-fw fa-user"></span>&nbsp;Профиль
                                    </a>
                                    <ul class="dropdown-menu">
                                        @if (!Session::has('access'))
                                          <li class="{{ Request::is('user/login') ? 'active' : '' }}">
                                              <a href="/user/login"><span class="fa fa-fw fa-sign-in"></span>&nbsp;Войти</a>
                                          </li>
                                        @endif
                                        @if (!Session::has('access'))
                                          <li class="{{ Request::is('user/create') ? 'active' : '' }}">
                                              <a href="/user/create"><span class="fa fa-fw fa-user-plus"></span>&nbsp;Регистрация</a>
                                          </li>
                                        @endif
                                        @if (Session::get('access') > -1)
                                          <?php $id = Session::get('id'); ?>
                                          <li class="{{ Request::is("user/$id", "user/$id/edit") ? 'active' : ''}}">
                                              <a href="/user/{{ Session::get('id') }}"><span class="fa fa-fw fa-user"></span>&nbsp;Профиль</a>
                                          </li>
                                        @endif
                                        @if (Session::get('access') > -1)
                                          <li class="{{ Request::is('user/logout') ? 'active' : '' }}">
                                              <a href="/user/logout"><span class="fa fa-fw fa-sign-out"></span>&nbsp;Выйти</a>
                                          </li>
                                        @endif
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <br>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <a href="#" class="thumbnail">
                        <img src="/images/avatar.jpg" class="img-responsive center-block" data-toggle="tooltip" data-placement="bottom" title="Просмотр списка статей автора">
                    </a>
                </div>
                <div class="col-lg-9 col-md-9">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td class="col-lg-3 col-md-3">
                                    Автор
                                </td>
                                <td class="col-lg-9 col-md-9">
                                    <a href="#" data-toggle="tooltip" data-placement="bottom" title="Просмотр списка статей автора">
                                        Павел Нитроловский
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Деятельность
                                </td>
                                <td>
                                    Создание мультимедийных лонгридов для бизнеса.
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Телефон
                                </td>
                                <td>
                                    +7 929 116 85 65
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Email
                                </td>
                                <td>
                                    nitrolovsky@gmail.com
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Дата публикации
                                </td>
                                <td>
                                    05.07.2016 11:18
                                </td>
                            </tr>
                            <tr class="tr-border-bottom">
                                <td>
                                    Просмотры
                                </td>
                                <td>
                                    20
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <h1 class="text-center text-uppercase">
                        10 правил сторителлинга
                    </h1>
                    <br>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <img src="/images/10-pravil-storitelinga.jpg" class="img-responsive center-block">
                </div>
            </div>
        </div>
        <div class="container ">
            <div class="row ">
                <div class="col-lg-8 col-md-8 col-lg-offset-2 col-md-offset-2">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <br>
                            <br>
                            <h3>
                                О новом способе рассказывать истории в интернете.
                            </h3>
                            <br>
                            <p>
                                Интернет — это прекрасная среда, которая позволяет очень круто рассказывать и доносить мысли и чувства. Мы все еще учимся жить в ней и осваиваем новые форматы. Я думаю, что <b>скоро настанет новая эпоха — цифрового сторителлинга. Это как золотой век русской литературы — только в интернете.</b> Диджитал сторителлинг — довольно благородный формат, это навык — как красивая, связная речь.
                            </p>
                            <br>
                            <p>
                                Изначально тексты публиковались в интернете по аналоговому принципу: материал помещался на страницу, разбивался на параграфы, снабжался несколькими фотографиями. Поняв, что разбираться в неоформленных простынях никто не хочет, многие редакции отказались от большого формата в пользу небольших новостей. В целом, механика чтения в интернете сильно изменилась. В связи с тем, что увеличился поток информации с появлением социальных сетей, мы научились фильтровать контент и читать избирательно — но мы все еще хотим читать.
                            </p>
                            <br>
                            <p>
                                В конце 2012 года, на волне популярности iPad, редакции стали переосмыслять будущее читательского опыта. У дизайнеров и издателей новой эпохи сформировались свои стандарты, объединенные общим названием Digital Storytelling. Многие экспериментировали со специальными версиями своих изданий для планшетов, но наибольшим успехом оказался новый формат сторителлинга — <a href="http://www.nytimes.com/projects/2012/snow-fall/#/?part=tunnel-creek" target="_blank">интерактивная история Snowfall</a> редакции New York Times совершила революцию в интернет-паблишинге, и создала новый стандарт подачи контента.
                            </p>
                            <br>
                            <p>
                                Мне бы хотелось развивать и обучать этому формату других. Наша задача — создание глобального комьюнити сторителинга. Создавая «Тильду», мы поставили себе цель дать людям простой инструмент, для того, чтобы они могли рассказывать свои истории. Эта платформа помогает создавать контентно-ориентированные проекты и публиковать их в интернете. Работая над собственной платформой и изучая формат, мы сформулировали основные правила, которые помогают в работе над визуальными историями.
                            </p>
                        </div>
                    </div>

                </div>
            </div>
            <br>

            <div class="row">
                <div class="col-lg-8 col-md-8 col-lg-offset-2 col-md-offset-2">
                    <h4 class="text-center">
                        Введите email и узнавайте о новых статьях
                    </h4>
                    <form>
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Email">
                                <span class="input-group-btn">
                                    <button class="btn btn-primary" type="button"><span class="fa fa-fw fa-paper-plane"></span>&nbsp;Подписаться</button>
                                </span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <br>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script src="/vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
        <script>
        $(function () {
          $('[data-toggle="tooltip"]').tooltip()
      });

        </script>
    </body>
</html>
