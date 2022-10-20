<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>{{$title}}</title>
    <script src="{{BASEPATH}}front_src/dist/bundle.js"></script>  
</head>
<body>
    <header>
      <a href="{{BASEPATH}}"><img src="{{BASEPATH}}src/pics/basepic.jpg" alt="Logo"></a> 
      <nav id="menu"><!--Навигация {{$title}}:-->
        <ul class="menu">
          <li><a href="{{BASEPATH}}">Главная</a></li>
          <li><a href="{{BASEPATH}}catalog">Каталог</a>
            <ul class="submenu">
              @foreach ($categories as $category)
                <li>
                  <a 
                    href="{{BASEPATH}}catalog/category/{{$category['name_eng']}}"
                  >Категория {{$category['category_name']}}</a>
                </li>
              @endforeach
                <li><a href="{{BASEPATH}}catalog/category/VacuumCleaners/id1">Пылесосы артикул "1"</a></li>
                <li><a href="{{BASEPATH}}catalog/id2">Продукт с артикулом "2"</a></li>
              <!--<li><a href="'.BASEPATH.'catalog/search">Поисковая строка в каталоге</a></li>-->
            </ul>
          </li>
          <li><a href="{{BASEPATH}}contacts">Контакты</a></li>
          <li><a href="{{BASEPATH}}delivery">Доставка</a></li>
          <li><a href="{{BASEPATH}}registration-form">Регистрация</a></li>
          <li><a href="{{BASEPATH}}authorization-form">Авторизация</a></li>
          @isset($SESSION)
            @if ($SESSION['role'] === "Admin")
              <li class="penult"><a href="{{BASEPATH}}profile/{{$SESSION['id']}}">Привет, Администатор {{$SESSION['name']}}</a>
                <ul class="submenu">
                  <li>
                    <a 
                      href="{{BASEPATH}}profile/{{$SESSION['id']}}/info"
                    >Информация об администаторе id{{$SESSION['id']}}</a>
                  </li>
                  <li><a href="{{BASEPATH}}profile/{{$SESSION['id']}}/reviews">Отзывы</a></li>
                  <li><a href="{{BASEPATH}}profile/{{$SESSION['id']}}/orders">Заказы</a></li>
                  <li><a href="{{BASEPATH}}profile/{{$SESSION['id']}}/users">Все пользователи</a></li>
                  <li><a href="{{BASEPATH}}profile/{{$SESSION['id']}}/admins">Все администраторы</a></li>
                  <!--<li><a href="{{BASEPATH}}cart/2256665">Корзина пользователя 2256665</a></li>-->
                </ul>
              </li>
            @else
              <li class="penult"><a href="{{BASEPATH}}profile/{{$SESSION['id']}}">Привет, {{$SESSION['name']}}</a>
                <ul class="submenu">
                  <li>
                    <a 
                      href="{{BASEPATH}}profile/{{$SESSION['id']}}/info"
                    >Информация о пользователе id{{$SESSION['id']}}</a>
                  </li>
                  <li>
                    <a 
                      href="{{BASEPATH}}profile/{{$SESSION['id']}}/reviews"
                    >Все отзывы пользователя id{{$SESSION['id']}}</a>
                  </li>
                  <li>
                    <a 
                      href="{{BASEPATH}}profile/{{$SESSION['id']}}/orders"
                    >Все заказы пользователя id{{$SESSION['id']}}</a>
                  </li>
                </ul>
              </li>            
            @endif
              <li><a href="{{BASEPATH}}exit/profile/{{$SESSION['id']}}">Выйти</a></li><br><br>
          @endisset
      </nav>
    </header>
    <main>
        <article>
            @yield('article')
        </article>
    </main>
    <footer>
        <p>This is ProjectShop</p>
        <p>Constructed by Oksi</p>
        <p>Belarus, 2022</p>
    </footer>
</body>
</html>