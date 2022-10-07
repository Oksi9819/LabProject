<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>{{$title}}</title>
</head>
<body>
    <header>
      <img src="/src/pics/basicpic.jpg" width="50" height="50" alt="Logo">
      <nav id="menu">Навигация {{$title}}:
        <ul>
          <li><a href="{{BASEPATH}}">Главная</a></li>
          <li><a href="{{BASEPATH}}catalog">Каталог</a>
            <ul>
            @foreach ($categories as $category)
                <li><a href="{{BASEPATH}}catalog/category/{{$category['name_eng']}}">Категория {{$category['category_name']}}</a></li>
            @endforeach
                <li><a href="{{BASEPATH}}catalog/category/VacuumCleaners/id1">Пылесосы артикул "1"</a></li>
                <li><a href="{{BASEPATH}}catalog/id2">Продукт с артикулом "2"</a></li>
              <!--<li><a href="'.BASEPATH.'catalog/search">Поисковая строка в каталоге</a></li>-->
            </ul>
          </li>
          <li><a href="{{BASEPATH}}contacts">Контакты</a>
            <ul>
              <li><a href="{{BASEPATH}}contacts/contact-form">Форма обратной связи</a></li>
            </ul>
          </li>
          <li><a href="{{BASEPATH}}delivery">Доставка</a></li>
          <li><a href="{{BASEPATH}}registration-form">Регистрация</a></li>
          <li><a href="{{BASEPATH}}authorization-form">Авторизация</a></li>
          @isset($SESSION)
            @if ($SESSION['role'] === "Admin")
              <li><a href="{{BASEPATH}}profile/{{$SESSION['id']}}">Привет, Администатор {{$SESSION['name']}}</a>
              <ul>
                <li><a href="{{BASEPATH}}profile/{{$SESSION['id']}}/info">Информация об администаторе id{{$SESSION['id']}}</a></li>
                <li><a href="{{BASEPATH}}profile/{{$SESSION['id']}}/reviews">Отзывы</a></li>
                <li><a href="{{BASEPATH}}profile/{{$SESSION['id']}}/orders">Заказы</a></li>
                <li><a href="{{BASEPATH}}profile/{{$SESSION['id']}}/users">Все пользователи</a></li>
                <li><a href="{{BASEPATH}}profile/{{$SESSION['id']}}/admins">Все администраторы</a></li>
                <!--<li><a href="{{BASEPATH}}cart/2256665">Корзина пользователя 2256665</a></li>-->
              </ul>
            </li><br><br>
            @else
              <li><a href="{{BASEPATH}}profile/{{$SESSION['id']}}">Привет, {{$SESSION['name']}}</a>
              <ul>
                <li><a href="{{BASEPATH}}profile/{{$SESSION['id']}}/info">Информация о пользователе id{{$SESSION['id']}}</a></li>
                <li><a href="{{BASEPATH}}profile/{{$SESSION['id']}}/reviews">Все отзывы пользователя id{{$SESSION['id']}}</a></li>
                <li><a href="{{BASEPATH}}profile/{{$SESSION['id']}}/orders">Все заказы пользователя id{{$SESSION['id']}}</a></li>
                <!--<li><a href="{{BASEPATH}}profile/cart/{{$SESSION['id']}}">Корзина пользователя {{$SESSION['id']}}</a></li>-->
              </ul>
            </li><br><br>            
            @endif
          @endisset
      </nav>
    </header>
    <main>
        <article>
            @yield('article')
        </article>
    </main>
    <footer>
        <p><br><br>This is ProjectShop</p>
        <p>Constructed by Oksi</p>
        <p>Belarus, 2022</p>
    </footer>
</body>
</html>