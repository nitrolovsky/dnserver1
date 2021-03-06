@extends('layouts.app')

@section('breadcrumb')
    <nav class="breadcrumb">
        <span class="breadcrumb-item active">Помощь по сайту</span>
    </nav>
@endsection

@section('content')
    <h2>
        Подача заявки
    </h2>
    <br>
    <p>
        Для подачи заявки необходимо войти под своим логином или зарегистрироваться на портале. После успешной аутентификации на портале вам будут доступна функция подачи заявки.
    </p>
    <br>
    <p>
      Устранение неисправности связанной с компьютерами, принтерами, телефонами, факсами и т.д. в раздел "Отдел информатизации и связи". Заказать картриджы, тонеры и барабаны в раздел "Заказ расходных материалов для ПК". Ремонт сантехники, мебели, замену лампочек, ремонт электротехники и т.д. в разделе "Организационный отдел". Приобретение нового оборудования или программного обеспечения в разделе "Заказ нового оборудования (Отдел ИТ)".
    </p>
    <br>
    <h2>
        Заполнение полей формы подачи заявки
    </h2>
    <br>
    <p>
        В разделе "Отдел информатизации и связи". Выберите из выпадающего списка устройство с которым у вас возникли проблемы и заполните поле "Описание неисправности". После заполнения всех полей нажмите "Сохранить".
    </p>
    <br>
    <p>
        В разделе "Заказ расходных материалов для ПК". Выберите из списка "Тип расходных материалов". Если вы неуверены в правильности своего выбора относительно "типа расходных материалов", свяжитесь с сотрудником отдела информатизации и связи. Введите данные в поле "Модель принтера". Пример: HP 3015. Если вы используете цветной принтер, укажите ЦВЕТ необходимого картриджа. Пример: HP 5550 желтый. Если вам одновременно необходио более 1 картриджа, закажите каждый картридж ОТДЕЛЬНО, а не в одной заявке. Это необходимо для правильного построения отчета об использовании расходных материалов. После заполнения всех полей нажмите "Сохранить".
    </p>
    <br>
    <p>
        В разделе "Организационный отдел". Выберите "Тип неисправности". Пример: Ремонт, Сантехника, Электрооборудование. После заполнения всех полей нажмите "Сохранить".
    </p>
    <br>
    <p>
        В разделе "Заказ нового оборудования (Отдел ИТ)". Выберите "устройство". Пример: Принтер, Компьютер и т.д. В поле "Примечание" можно внести какие либо особые пожелания, комментарии. После заполнения всех полей нажмите "Сохранить".
    </p>
    <br>
    <h2>
        Контактная информация
    </h2>
    <br>
    <p>
        Со всеми возникающим вопросами, жалобами и предложениями обращайтесь к Будникову Константину Сергеевичу, тел. 576-15-15. <a href="mailto:budnikov@expertiza.spb.ru">budnikov@expertiza.spb.ru</a>
    </p>
@endsection
